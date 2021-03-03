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

        //Activate User
        public $user_active_id;
        public $user_active_status;

        public function ajaxActivateUser(){
            
            $table = "users";
            $item1 = "status";
            $value1 = $this->user_active_status;
            $item2 = "id";
            $value2 = $this->user_active_id;

            $result = UserModel::mdlUpdateUser($table, $item1, $value1, $item2, $value2);
        }

        //Check is username is taken
        public $validate_username;

        public function ajaxValidateUsername(){

            $item = "username";
            $value = $this->validate_username;
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

    //Activate User
    if(isset($_POST["user_active_id"])){

        $activate_user = new AjaxUsers();
        $activate_user->user_active_id = $_POST["user_active_id"];
        $activate_user->user_active_status = $_POST["user_active_status"];
        $activate_user->ajaxActivateUser();
    }

    //Check if username is taken
    if(isset($_POST["validate_username"])){

        $validate_username = new AjaxUsers();
        $validate_username->validate_username = $_POST["validate_username"];
        $validate_username->ajaxValidateUsername();
    }