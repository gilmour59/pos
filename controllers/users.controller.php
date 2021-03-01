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

    public function ctrCreateUser(){
        
        if(isset($_POST["addName"])){
            if(preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["addName"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["addUsername"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["addPassword"])){    
                    
                    $table = "users";
                    $data = array("name" => $_POST["addName"],
                                    "username" => $_POST["addUsername"],
                                    "password" => $_POST["addPassword"],
                                    "role" => $_POST["addRole"]);

                    $result = UserModel::mdlAddUser($table, $data);

                    if($result == "ok"){
                        echo "<script>                
                            Swal.fire({
                                icon: 'success',
                                title: 'User was saved successfully!',
                                text: 'Hooray!',
                            }).then((result)=>{
                                if(result.value){
                                    window.location = 'users';
                                }
                            });
                        </script>";
                    }else{
                        echo "<script>                
                            Swal.fire({
                                icon: 'error',
                                title: 'User creation Error!',
                                text: 'Something went wrong!',
                            }).then((result)=>{
                                if(result.value){
                                    window.location = 'users';
                                }
                            });
                        </script>"; 
                    }

            }else{
                echo "<script>                
                    Swal.fire({
                        icon: 'error',
                        title: 'Special Characters are not allowed',
                        text: 'Something went wrong!',
                    }).then((result)=>{
                        if(result.value){
                            window.location = 'users';
                        }
                    });
                </script>";
            }
        }
    }
}