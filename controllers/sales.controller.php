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

            foreach($product_list as $key => $value){
                
                /* $table_product = "products";
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
                                                                        $product_update_stocks_value, $product_id); */
            }

            $table_client = "clients";
            $client_item = "id";
            $client_value = $_POST['selectClient'];

            //Get Client
            $show_client = ClientModel::mdlShowClients($table_client, $client_item, $client_value);
            
            var_dump($show_client);
        }
    } 
}

?>