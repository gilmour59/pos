<?php

class UserController{
    
    public function ctrUserLogin(){

        if(isset($_POST["username"])){
            if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["username"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["password"])){

                    $table = "users";
                    $item = "username";
                    $value = $_POST['username'];

                    $result = UserModel::mdlShowUser($table, $item, $value);

                    if($result["username"] == $_POST["username"] &&
                        $result["password"] == $_POST["password"]){

                            $_SESSION["initialSession"] = 'ok';

                            echo '<script>
                                    window.location = "home";
                                </script>';
                    }else{
                        echo '<br><div class="alert alert-danger">Wrong Username or Password!</div>';
                    }
            }
        }
    }
}