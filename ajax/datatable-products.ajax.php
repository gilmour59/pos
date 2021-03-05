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

            $json_data = '{
                "data": [';
                for($i = 0; $i < count($products); $i++){

                    $item = "id";
                    $value = $products[$i]["category_id"];

                    $category = CategoryController::ctrShowCategories($item, $value);

                    $image = "<img src='" . $products[$i]["image"] . "' width='40px'>" ;

                    if($products[$i]["stock"] <= 10){
                        $stock = "<button class='btn btn-danger'>" . $products[$i]["stock"] . "</button>";
                    }else if($products[$i]["stock"] > 11 && $products[$i]["stock"] <= 15){
                        $stock = "<button class='btn btn-warning'>" . $products[$i]["stock"] . "</button>";
                    }else{
                        $stock = "<button class='btn btn-success'>" . $products[$i]["stock"] . "</button>";
                    }                    

                    $buttons = "<div class='btn-group'><button class='btn btn-warning btn-edit-product' data-product-id='" . $products[$i]["id"] . "' data-toggle='modal' data-target='#modalEditProduct'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btn-delete-product' data-product-id='" . $products[$i]["id"] . "' data-product-code='" . $products[$i]["code"] . "' data-product-image='" . $products[$i]["image"] . "'><i class='fa fa-times'></i></button></div>";

                    $json_data .= '[
                    "' . $products[$i]["id"] . '",
                    "' . $image . '",
                    "' . $products[$i]["code"] . '",
                    "' . $products[$i]["description"] . '",
                    "' . $category["category"] . '",
                    "' . $stock . '",
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