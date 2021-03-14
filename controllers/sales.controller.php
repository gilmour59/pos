<?php

class SaleController{

    //show sales
    static public function ctrShowSales($item, $value){

        $table = "sales";
        
        $result = SaleModel::mdlShowSales($table, $item, $value);

        return $result;
    }

    //create sale
    public function ctrCreateSale(){

        if(isset($_POST["newSaleCode"])){

            //Update the purchases of client || Reduce Stock || Update Sales            
            $product_list = json_decode($_POST["productList"], true);
            //Purchases Counter
            $total_purchases = array();            

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
                "payment_method"=> $_POST['paymentMethodList']
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

            //REVERTING Client Purchases
            $client_last_purchase_item = "last_purchase";

            $client_last_purchase_value = null;

            $client_last_purchase = ClientModel::mdlUpdateClient($table_previous_client, $client_last_purchase_item, 
                                                                    $client_last_purchase_value, $client_previous_id);

            //Update the purchases of client || Reduce Stock || Update Sales            
            $product_list = json_decode($_POST["productList"], true);
            //Purchases Counter
            $total_purchases = array();            

            //Editing the sales            
            $data = array(
                "code" => $_POST['editSaleCode'],
                "client_id"=> $_POST['editClient'],
                "seller_id"=> $_POST['idSeller'],
                "products"=> $_POST['productList'],
                "tax"=> $_POST['addPriceTax'],
                "net_price"=> $_POST['addPriceNet'],
                "total_price"=> $_POST['totalSale'],
                "payment_method"=> $_POST['paymentMethodList']
            );
            
            $result = SaleModel::mdlEditSale($table_sale, $data);

            if($result == "ok"){

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

                //Getting Previous Client Purchases
                $client_update_last_purchase_item = "last_purchase";
    
                $client_update_last_purchase_value = $show_previous_client['last_purchase'];

                $client_update_last_purchase = ClientModel::mdlUpdateClient($table_client, $client_update_last_purchase_item, 
                                                                        $client_update_last_purchase_value, $client_id);

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
}

?>