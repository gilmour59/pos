<?php

    require_once "../controllers/categories.controller.php";
    require_once "../models/categories.model.php";
    
    class AjaxCategories{

        //Edit Category
        public $category_id;

        public function ajaxEditCategory(){

            $item = "id";
            $value = $this->category_id;
            $request = CategoryController::ctrShowCategories($item, $value);

            echo json_encode($request);
        }        

        //Check if category is taken
        public $validate_category;

        public function ajaxValidateCategory(){

            $item = "category";
            $value = $this->validate_category;
            $request = CategoryController::ctrShowCategories($item, $value);

            echo json_encode($request);
        }

    }

    //Edit User
    if(isset($_POST["categoryId"])){

        $edit_category = new AjaxCategories();
        $edit_category->category_id = $_POST["categoryId"];
        $edit_category->ajaxEditCategory();
    }    

    //Check if username is taken
    if(isset($_POST["validate_category"])){

        $validate_category = new AjaxCategories();
        $validate_category->validate_category = $_POST["validate_category"];
        $validate_category->ajaxValidateCategory();
    }