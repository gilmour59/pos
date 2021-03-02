<?php

class UserController{
    
    //login
    public function ctrUserLogin(){

        if(isset($_POST["username"])){
            if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["username"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["password"])){

                    $table = "users";
                    $item = "username";
                    $value = $_POST['username'];

                    //Blowfish salt
                    $encryption = crypt($_POST["password"], '$2a$07$K3k123lMaO54LtYstringforsalt$');

                    $result = UserModel::mdlShowUsers($table, $item, $value);

                    if($result["username"] == $_POST["username"] &&
                        $result["password"] == $encryption){

                            $_SESSION["initialSession"] = 'ok';
                            $_SESSION["id"] = $result["id"];
                            $_SESSION["name"] = $result["name"];
                            $_SESSION["username"] = $result["username"];
                            $_SESSION["picture"] = $result["picture"];
                            $_SESSION["role"] = $result["role"];

                            echo '<script>
                                    window.location = "home";
                                </script>';
                    }else{
                        echo '<br><div class="alert alert-danger">Wrong Username or Password!</div>';
                    }
            }
        }
    }

    //show users
    static public function ctrShowUsers($item, $value){

        $table = "users";
        
        $result = UserModel::mdlShowUsers($table, $item, $value);

        return $result;
    }

    //create user
    public function ctrCreateUser(){
        
        if(isset($_POST["addName"])){
            if(preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["addName"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["addUsername"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["addPassword"])){    
                    
                    $route = "";

                    //Validate Image
                    if($_FILES["addPicture"]["error"] != 4){

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

                        if($_FILES["addPicture"]["type"] == "image/png"){

                            $rando = mt_rand(100, 999);

                            //don't add "/" before the directory
                            $route = "views/img/users/" . $_POST["addName"] . "/" . $rando . ".png";

                            $source = imagecreatefrompng($_FILES["addPicture"]["tmp_name"]);
                            $destination = imagecreatetruecolor($newWidth, $newHeight);

                            imagecopyresized($destination, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

                            imagepng($destination, $route);
                        }
                    }

                    $table = "users";

                    //Blowfish salt
                    $encryption = crypt($_POST["addPassword"], '$2a$07$K3k123lMaO54LtYstringforsalt$');

                    $data = array("name" => $_POST["addName"],
                                    "username" => $_POST["addUsername"],
                                    "password" => $encryption,
                                    "role" => $_POST["addRole"],
                                    "picture" => $route);

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