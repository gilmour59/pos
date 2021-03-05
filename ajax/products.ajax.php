<?php

    require_once "../controllers/products.controller.php";
    require_once "../models/products.model.php";
    
    class AjaxProducts{

        //Edit Product
        public $product_id;

        public function ajaxEditProduct(){

            $item = "id";
            $value = $this->product_id;
            $request = ProductController::ctrShowProducts($item, $value);

            echo json_encode($request);
        }        

        //Generate Code
        public $category_id;

        public function ajaxCreateProductCode(){

            $item = "category";
            $value = $this->validate_category;
            $request = UserController::ctrShowUsers($item, $value);

            echo json_encode($request);
        }

    }

    //Edit User
    if(isset($_POST["categoryId"])){

        $edit_category = new AjaxCategories();
        $edit_category->category_id = $_POST["categoryId"];
        $edit_category->ajaxEditCategory();
    }    

    //Generate Code
    if(isset($_POST["category_id"])){

        $generate_code = new AjaxProducts();
        $generate_code->category_id = $_POST["category_id"];
        $generate_code->ajaxCreateProductCode();
    }