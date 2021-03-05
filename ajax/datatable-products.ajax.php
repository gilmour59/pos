<?php 

    require_once "../controllers/products.controller.php";
    require_once "../models/products.model.php";

    require_once "../controllers/categories.controller.php";
    require_once "../models/categories.model.php";

    //Ajax Dynamic Datatables for products 
    class ProductsTable{

        public function showProductsTable(){

            $item = null;
            $value = null;

            $products = ProductController::ctrShowProducts($item, $value);
            
            $buttons = "<div class='btn-group'><button class='btn btn-warning btn-edit-product' data-product-id='1' data-toggle='modal' data-target='#modalEditProduct'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btn-delete-product' data-product-id='2'><i class='fa fa-times'></i></button></div>";

            $json_data = '{
                "data": [';
                for($i = 0; $i < count($products); $i++){

                    $image = "<img src='" . $products[$i]["image"] . "' width='40px'>" ;

                    $json_data .= '[
                    "1",
                    "' . $image . '",
                    "' . $products[$i]["code"] . '",
                    "' . $products[$i]["description"] . '",
                    "cat",
                    "' . $products[$i]["stock"] . '",
                    "' . $products[$i]["sell_price"] . '",
                    "' . $products[$i]["buy_price"] . '",
                    "' . $products[$i]["date"] . '",
                    "' . $buttons . '"
                    ],';
                }     

            //To remove the last comma
            $json_data = substr($json_data, 0, -1);

            $json_data .= ']
                        }';
                        
            echo $json_data;
            return;
        }
    }

    //Activate Products Table
    $activateProducts = new ProductsTable();
    $activateProducts->showProductsTable();
?>