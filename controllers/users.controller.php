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
                    
                    //Validate Image
                    if(isset($_FILES["addPicture"]["tmp_name"])){

                        list($width, $height) = getimagesize($_FILES["addPicture"]["tmp_name"]);
                        
                        $newWidth = 500;
                        $newHeight = 500;

                        //don't add "/" before the directory
                        $directory = "views/img/users/" . $_POST["addName"];

                        mkdir($directory, 0755);

                        if($_FILES["addPicture"]["type"] == "image/jpeg"){

                            $rando = mt_rand(100, 999);

                            //don't add "/" before the directory
                            $route = "views/img/users/" . $_POST["addName"] . "/" . $rando . ".jpeg";

                            $source = imagecreatefromjpeg($_FILES["addPicture"]["tmp_name"]);
                            $destination = imagecreatetruecolor($newWidth, $newHeight);

                            imagecopyresized($destination, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

                            imagejpeg($destination, $route);
                        }
                    }

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