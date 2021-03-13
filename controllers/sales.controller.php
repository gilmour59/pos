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
            
            var_dump($show_client);
            
            //Update Client Purchases
            $client_update_purchases_item = "purchases";
            $client_update_purchases_value = array_sum($total_purchases) + $show_client['purchases'];

            $client_update_purchases = ClientModel::mdlUpdateClient($table_client, $client_update_purchases_item, 
                                                                    $client_update_purchases_value, $client_id);

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
                echo "<script>                
                    Swal.fire({
                        icon: 'success',
                        title: 'Sale was saved successfully!',
                        text: 'Hooray!',
                    }).then((result)=>{
                        if(result.value){
                            window.location = 'sales-create';
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
}

?>