<?php

    require_once "../controllers/products.controller.php";
    require_once "../models/products.model.php";
    
    class AjaxProducts{

        //Generate Code
        public $category_id;

        public function ajaxCreateProductCode(){

            $item = "category_id";
            $value = $this->category_id;
            $request = ProductController::ctrShowProducts($item, $value);

            echo json_encode($request);
        }

        //Edit Product
        public $product_id;

        public function ajaxEditProduct(){

            $item = "id";
            $value = $this->product_id;
            $request = ProductController::ctrShowProducts($item, $value);

            echo json_encode($request);
        }                
    }

    //Generate Code
    if(isset($_POST["category_id"])){

        $generate_code = new AjaxProducts();
        $generate_code->category_id = $_POST["category_id"];
        $generate_code->ajaxCreateProductCode();
    }

    //Edit User
    if(isset($_POST["productId"])){

        $edit_product = new AjaxProducts();
        $edit_product->product_id = $_POST["productId"];
        $edit_product->ajaxEditProduct();
    }    

    