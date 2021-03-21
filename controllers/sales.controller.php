<?php

class SaleController{

    //show sales
    static public function ctrShowSales($item, $value){

        $table = "sales";
        
        $result = SaleModel::mdlShowSales($table, $item, $value);

        return $result;
    }

    //show sales
    static public function ctrShowSalesDateRange($inital_date, $final_date){

        $table = "sales";
        
        $result = SaleModel::mdlShowSalesDateRange($table, $inital_date, $final_date);

        return $result;
    }

    //create sale
    public function ctrCreateSale(){

        if(isset($_POST["newSaleCode"])){

            //Update the purchases of client || Reduce Stock || Update Sales            
            $product_list = json_decode($_POST["productList"], true);
            //Purchases Counter
            $total_purchases = array();
            
            //get last login date and time
            date_default_timezone_set('Asia/Manila');
            $date_sale_date = date('Y-m-d');
            $hour_sale_date = date('H:i:s');

            $sale_date = $date_sale_date . ' ' . $hour_sale_date;

            //Adding the sales
            $table_sale = "sales";
            $data = array(
                "code" => $_POST['newSaleCode'],
                "client_id"=> $_POST['selectClient'],
                "seller_id"=> $_POST['idSeller'],
                "products"=> $_POST['productList'],
                "tax"=> $_POST['addPriceTax'],
                "net_price"=> $_POST['addPriceNet'],
                "total_price"=> $_POST['totalSale'],
                "payment_method"=> $_POST['paymentMethodList'],
                "sale_date" => $sale_date
            );
            
            $result = SaleModel::mdlAddSale($table_sale, $data);

            if($result == "ok"){

                foreach($product_list as $key => $value){

                    array_push($total_purchases, $value['quantity']);
                    
                    $table_product = "products";
                    $product_item = "id";
                    $product_id = $value['id'];
                    
                    //Get Product
                    $show_product = ProductModel::mdlShowProducts($table_product, $product_item, $product_id);
    
                    //Update product sales and stocks
                    $product_update_sales_item = "sales";
                    $product_update_sales_value = $value['quantity'] + $show_product['sales']; 
    
                    $update_product_sales = ProductModel::mdlUpdateProduct($table_product, $product_update_sales_item, 
                                                                            $product_update_sales_value, 
                                                                            $product_id);
                    
                    $product_update_stocks_item = "stock";
                    $product_update_stocks_value = $value['stock'];
    
                    $update_product_stock = ProductModel::mdlUpdateProduct($table_product, $product_update_stocks_item, 
                                                                            $product_update_stocks_value, $product_id);
                }
    
                $table_client = "clients";
                $client_item = "id";
                $client_id = $_POST['selectClient'];
    
                //Get Client
                $show_client = ClientModel::mdlShowClients($table_client, $client_item, $client_id);
                
                //Update Client Purchases
                $client_update_purchases_item = "purchases";
                $client_update_purchases_value = array_sum($total_purchases) + $show_client['purchases'];
    
                $client_update_purchases = ClientModel::mdlUpdateClient($table_client, $client_update_purchases_item, 
                                                                        $client_update_purchases_value, $client_id);

                //Update Client Purchases
                $client_update_last_purchase_item = "last_purchase";

                //get last login date and time
                date_default_timezone_set('Asia/Manila');
                $date = date('Y-m-d');
                $hour = date('H:i:s');

                $currentDate = $date . ' ' . $hour;

                $client_update_last_purchase_value = $currentDate;
    
                $client_update_last_purchase = ClientModel::mdlUpdateClient($table_client, $client_update_last_purchase_item, 
                                                                        $client_update_last_purchase_value, $client_id);

                echo "<script>                
                    Swal.fire({
                        icon: 'success',
                        title: 'Sale was saved successfully!',
                        text: 'Hooray!',
                    }).then((result)=>{
                        if(result.value){
                            window.location = 'sales';
                        }
                    });
                </script>";
            }else{
                echo "<script>                
                    Swal.fire({
                        icon: 'error',
                        title: 'Sale creation Error!',
                        text: 'Something went wrong!',
                    }).then((result)=>{
                        if(result.value){
                            window.location = 'sales-create';
                        }
                    });
                </script>"; 
            }
        }
    }

    //edit sale
    public function ctrEditSale(){

        if(isset($_POST["editSaleCode"])){
            
            //REVERTING Products and Clients table
            $table_sale = "sales";
            $table_product = "products";
            
            $sale_item = "code";
            $sale_value = $_POST["editSaleCode"];

            $show_sale = SaleModel::mdlShowSales($table_sale, $sale_item, $sale_value);

            //Check if productList is not empty || check if user changed the products
            $product_changed = false;

            if($_POST['productList'] == ""){

                $previous_product_list = $show_sale['products'];
                //Product list hasn't been touched
                //To make sure that only if the user changes something and 
                //the listProducts() is executed. Is when the changes in db is validated
                //if listProducts() is not executed. It will try to revert the stock from the products data in sales table
                $product_changed = false;
            }else{
                
                $previous_product_list = $_POST['productList'];
                $product_changed = true;
            }

            if($product_changed){            

                $previous_products = json_decode($show_sale['products'], true);

                //Purchases Counter
                $total_previous_purchases = array();  

                foreach($previous_products as $key => $previous_value){

                    array_push($total_previous_purchases, $previous_value['quantity']);
                    
                    $table_previous_product = "products";
                    $product_previous_item = "id";
                    $product_previous_id = $previous_value["id"];

                    $show_previous_product = ProductModel::mdlShowProducts($table_previous_product, $product_previous_item, $product_previous_id);

                    //Update product sales and stocks
                    $product_sales_item = "sales";
                    $product_sales_value = $show_previous_product['sales'] - $previous_value['quantity']; 

                    $update_sales = ProductModel::mdlUpdateProduct($table_product, $product_sales_item, $product_sales_value, $product_previous_id);

                    $product_stocks_item = "stock";
                    $product_stocks_value = $previous_value['quantity'] + $show_previous_product['stock'];

                    $update_stock = ProductModel::mdlUpdateProduct($table_product, $product_stocks_item, $product_stocks_value, $product_previous_id);
                }

                $table_previous_client = "clients";
                $client_previous_item = "id";
                $client_previous_id = $_POST['previousClient'];

                //Get Client
                $show_previous_client = ClientModel::mdlShowClients($table_previous_client, $client_previous_item, $client_previous_id);
                
                //REVERTING Client Purchases
                $client_purchases_item = "purchases";
                $client_purchases_value = $show_previous_client['purchases'] - array_sum($total_previous_purchases);

                $client_purchases = ClientModel::mdlUpdateClient($table_previous_client, $client_purchases_item, $client_purchases_value, $client_previous_id);                

                //Update the purchases of client || Reduce Stock || Update Sales            
                $product_list = json_decode($previous_product_list, true);
                //Purchases Counter
                $total_purchases = array();           
                
                foreach($product_list as $key => $value){

                    array_push($total_purchases, $value['quantity']);
                                        
                    $product_item = "id";
                    $product_id = $value['id'];
                    
                    //Get Product
                    $show_product = ProductModel::mdlShowProducts($table_product, $product_item, $product_id);

                    //Update product sales and stocks
                    $product_update_sales_item = "sales";
                    $product_update_sales_value = $value['quantity'] + $show_product['sales']; 

                    $update_product_sales = ProductModel::mdlUpdateProduct($table_product, $product_update_sales_item, 
                                                                            $product_update_sales_value, 
                                                                            $product_id);
                    
                    //This stock has a problem when it receives the previous product list
                    $product_update_stocks_item = "stock";
                    $product_update_stocks_value = $value['stock'];

                    $update_product_stock = ProductModel::mdlUpdateProduct($table_product, $product_update_stocks_item, 
                                                                            $product_update_stocks_value, $product_id);
                }

                $table_client = "clients";
                $client_item = "id";
                $client_id = $_POST['editClient'];

                //Get Client
                $show_client = ClientModel::mdlShowClients($table_client, $client_item, $client_id);
                
                //Update Client Purchases
                $client_update_purchases_item = "purchases";
                $client_update_purchases_value = array_sum($total_purchases) + $show_client['purchases'];

                $client_update_purchases = ClientModel::mdlUpdateClient($table_client, $client_update_purchases_item, 
                                                                        $client_update_purchases_value, $client_id);                
            }

            //Editing the sales            
            $data = array(
                "code" => $_POST['editSaleCode'],
                "client_id"=> $_POST['editClient'],
                "seller_id"=> $_POST['idSeller'],
                "products"=> $previous_product_list,
                "tax"=> $_POST['addPriceTax'],
                "net_price"=> $_POST['addPriceNet'],
                "total_price"=> $_POST['totalSale'],
                "payment_method"=> $_POST['paymentMethodList']
            );
            
            $result = SaleModel::mdlEditSale($table_sale, $data);

            if($result == "ok"){       

                    $table_client = "clients";
                    
                    //Get client's last purchase date time
                    $client_last_purchase_date = SaleModel::mdlShowLastPurchaseSales($table_sale, $_POST['editClient']);

                    //Get previous client's last purchase date time
                    $client_previous_last_purchase_date = SaleModel::mdlShowLastPurchaseSales($table_sale, $_POST['previousClient']);

                    //Getting Previous Client Purchases
                    $client_update_last_purchase_item = "last_purchase";

                    //Getting the latest purchase of the client
                    $client_update_last_purchase_value = $client_last_purchase_date[0]['sale_date'];

                    $client_update_last_purchase = ClientModel::mdlUpdateClient($table_client, $client_update_last_purchase_item, 
                                                                            $client_update_last_purchase_value, $_POST['editClient']);

                    //Getting the latest purchase of the previous client
                    if($client_previous_last_purchase_date != null){
                        
                        $client_previous_update_last_purchase_value = $client_previous_last_purchase_date[0]['sale_date'];

                        $client_previous_update_last_purchase = ClientModel::mdlUpdateClient($table_client, $client_update_last_purchase_item, 
                                                                            $client_previous_update_last_purchase_value, $_POST['previousClient']);
                    }else{
                        $client_previous_update_last_purchase = ClientModel::mdlUpdateClient($table_client, $client_update_last_purchase_item, 
                                                                            null, $_POST['previousClient']);
                    }             

                echo "<script>                
                    Swal.fire({
                        icon: 'success',
                        title: 'Sale was modified successfully!',
                        text: 'Hooray!',
                    }).then((result)=>{
                        if(result.value){
                            window.location = 'sales';
                        }
                    });
                </script>";
            }else{
                echo "<script>                
                    Swal.fire({
                        icon: 'error',
                        title: 'Sale Modification Error!',
                        text: 'Something went wrong!',
                    }).then((result)=>{
                        if(result.value){
                            window.location = 'index.php?route=sales-edit&sale-id=". $show_sale['id'] ."';
                        }
                    });
                </script>"; 
            }
        }
    }
    
    public function ctrDeleteSale(){

        if(isset($_GET['delete-sale-id'])){

            $table_sale = "sales";
            $table_client = "clients";
            $table_product = "products";
            
            $sale_item = "id";
            $sale_value = $_GET["delete-sale-id"];            

            $show_sale = SaleModel::mdlShowSales($table_sale, $sale_item, $sale_value);
            
            $previous_products = json_decode($show_sale['products'], true);

            //Purchases Counter
            $total_previous_purchases = array();  

            foreach($previous_products as $key => $previous_value){

                array_push($total_previous_purchases, $previous_value['quantity']);
                                
                $product_previous_item = "id";
                $product_previous_id = $previous_value["id"];

                $show_previous_product = ProductModel::mdlShowProducts($table_product, $product_previous_item, $product_previous_id);

                //Update product sales and stocks
                $product_sales_item = "sales";
                $product_sales_value = $show_previous_product['sales'] - $previous_value['quantity']; 

                $update_sales = ProductModel::mdlUpdateProduct($table_product, $product_sales_item, $product_sales_value, $product_previous_id);

                $product_stocks_item = "stock";
                $product_stocks_value = $previous_value['quantity'] + $show_previous_product['stock'];

                $update_stock = ProductModel::mdlUpdateProduct($table_product, $product_stocks_item, $product_stocks_value, $product_previous_id);
            }

            $client_previous_item = "id";
            $client_previous_id = $show_sale['client_id'];

            //Get Client
            $show_previous_client = ClientModel::mdlShowClients($table_client, $client_previous_item, $client_previous_id);
            
            //REVERTING Client Purchases
            $client_purchases_item = "purchases";
            $client_purchases_value = $show_previous_client['purchases'] - array_sum($total_previous_purchases);

            $client_purchases = ClientModel::mdlUpdateClient($table_client, $client_purchases_item, $client_purchases_value, $client_previous_id);
            
            //DELETE SALE
            $result = SaleModel::mdlDeleteSale($table_sale, $sale_value);

            if($result == "ok"){

                //Update the last purchase of client (Do this after deleting the sale)
                $client_id = $show_sale['client_id'];
                
                $get_dates = SaleModel::mdlShowLastPurchaseSales($table_sale, $client_id);

                $client_item = "last_purchase";            

                if(count($get_dates) > 1 && $get_dates != null){

                    $client_value = $get_dates[0]['sale_date'];
                    $client = ClientModel::mdlUpdateClient($table_client, $client_item, $client_value, $client_id);
                }else{
                    
                    $client_value = null;
                    $client = ClientModel::mdlUpdateClient($table_client, $client_item, $client_value, $client_id);
                }

                echo "<script>
                    Swal.fire(
                        'Deleted!',
                        'Sale has been deleted.',
                        'success'
                    ).then((response) => {
                        if (response.isConfirmed){
                            window.location = 'sales';
                        }
                    });
                </script>";
            }                        
        }
    }

    //Get Sum of All Sales
    static public function ctrSumSellerSales($seller_id){

        $table = "sales";

        $result = SaleModel::mdlSumSellerSales($table, $seller_id);

        return $result;
    }

    //Get Sum of All Sales
    static public function ctrSumClientSales($client_id){

        $table = "sales";

        $result = SaleModel::mdlSumClientSales($table, $client_id);

        return $result;
    }

    //Get Sum of All Sales
    static public function ctrSumSales(){

        $table = "sales";

        $result = SaleModel::mdlSumSales($table);

        return $result;
    }

    //Export to Excel
    public function ctrDownloadReport(){

        if(isset($_GET['report'])){

            $table = 'sales';

            if(isset($_GET['initial-date']) && isset($_GET['final-date'])){

                $sales = SaleModel::mdlShowSalesDateRange($table, $_GET['initial-date'], $_GET['final-date']);
            }else{

                $sales = SaleModel::mdlShowSalesDateRange($table);
            }

            //Create the excel file

            //get last login date and time
            date_default_timezone_set('Asia/Manila');
            $date = date('Y-m-d');
            $hour = date('H:i:s');
            $add_to_name = $date . '' . $hour;
            
            $name = $_GET['report'] . '' . $add_to_name . '.xls';

            header('Expires: 0');
            header('Cache-control: private');
            header("Content-type: application/vnd.ms-excel");
            header("Cache-Control: cache, must-revalidate");
            header('Content-Description: File Transfer');
            header('Last-Modified: ' . date('D, d M Y H:i:s'));
            header("Pragma: public");
            header('Content-Disposition:; filename="' . $name . '"');
            header("Content-Transfer-Encoding: binary");

            echo utf8_decode("<table border='0'> 

					<tr> 
					<td style='font-weight:bold; border:1px solid #eee;'>Code</td> 
					<td style='font-weight:bold; border:1px solid #eee;'>Client</td>
					<td style='font-weight:bold; border:1px solid #eee;'>Seller</td>
					<td style='font-weight:bold; border:1px solid #eee;'>Quantity</td>
					<td style='font-weight:bold; border:1px solid #eee;'>Products</td>
					<td style='font-weight:bold; border:1px solid #eee;'>Tax</td>
					<td style='font-weight:bold; border:1px solid #eee;'>Net Price</td>		
					<td style='font-weight:bold; border:1px solid #eee;'>Total</td>		
					<td style='font-weight:bold; border:1px solid #eee;'>Method of Payment</td	
					<td style='font-weight:bold; border:1px solid #eee;'>Date</td>		
					</tr>");

			foreach ($sales as $row => $item){

				$client = ClientController::ctrShowClients("id", $item["client_id"]);
				$seller = UserController::ctrShowUsers("id", $item["seller_id"]);

            echo utf8_decode("<tr>
                    <td style='border:1px solid #eee;'>" . $item["code"] . "</td> 
                    <td style='border:1px solid #eee;'>" . $client["name"] . "</td>
                    <td style='border:1px solid #eee;'>" . $seller["name"] . "</td>
                    <td style='border:1px solid #eee;'>");

            $products =  json_decode($item["products"], true);

            foreach ($products as $key => $value_products) {
                    
                    echo utf8_decode($value_products["quantity"]."<br>");
                }

            echo utf8_decode("</td><td style='border:1px solid #eee;'>");	

            foreach ($products as $key => $value_products) {
                    
                echo utf8_decode($value_products["description"]."<br>");
            
            }

            echo utf8_decode("</td>
                <td style='border:1px solid #eee;'>Php " . number_format($item["tax"], 2) . "</td>
                <td style='border:1px solid #eee;'>Php " . number_format($item["net_price"], 2) . "</td>	
                <td style='border:1px solid #eee;'>Php " . number_format($item["total_price"], 2) . "</td>
                <td style='border:1px solid #eee;'>" . $item["payment_method"] . "</td>
                <td style='border:1px solid #eee;'>" . substr($item["sale_date"], 0, 10) . "</td>		
                </tr>");

            }


            echo "</table>";

        }
    }
}

?>