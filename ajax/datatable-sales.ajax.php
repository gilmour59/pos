<?php 

    require_once "../controllers/products.controller.php";
    require_once "../models/products.model.php";

    //Ajax Dynamic Datatables for sales 
    class ProductSalesTable{

        public function showProductSalesTable(){

            $item = null;
            $value = null;

            $products = ProductController::ctrShowProducts($item, $value);                        

            $json_data = '{
                "data": [';
                for($i = 0; $i < count($products); $i++){                    

                    $image = "<img src='" . $products[$i]["image"] . "' width='40px'>" ;

                    if($products[$i]["stock"] <= 10){
                        $stock = "<button class='btn btn-danger'>" . $products[$i]["stock"] . "</button>";
                    }else if($products[$i]["stock"] > 11 && $products[$i]["stock"] <= 15){
                        $stock = "<button class='btn btn-warning'>" . $products[$i]["stock"] . "</button>";
                    }else{
                        $stock = "<button class='btn btn-success'>" . $products[$i]["stock"] . "</button>";
                    }                    

                    $buttons = "<div class='btn-group'><button class='btn btn-primary addProduct recoverProduct' data-product-id='" . $products[$i]["id"] . "'>Add</button></div>";

                    $json_data .= '[
                    "' . $products[$i]["id"] . '",
                    "' . $image . '",
                    "' . $products[$i]["code"] . '",
                    "' . $products[$i]["description"] . '",
                    "' . $stock . '",
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

    //Activate Products Sales Table
    $activateProductSales = new ProductSalesTable();
    $activateProductSales->showProductSalesTable();
?>