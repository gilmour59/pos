<?php

    require_once "../controllers/users.controller.php";
    require_once "../models/users.model.php";
    
    class AjaxUsers{

        //Edit User
        public $user_id;

        public function ajaxEditUser(){

            $item = "id";
            $value = $this->user_id;
            $request = UserController::ctrShowUsers($item, $value);

            echo json_encode($request);
        }
    }

    //Edit User
    if(isset($_POST["userId"])){

        $edit_user = new AjaxUsers();
        $edit_user->user_id = $_POST["userId"];
        $edit_user->ajaxEditUser();
    }