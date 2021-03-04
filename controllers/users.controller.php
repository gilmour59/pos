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

                            //Check if user is activated!
                            if($result["status"] == 1){

                                $_SESSION["initialSession"] = 'ok';
                                $_SESSION["id"] = $result["id"];
                                $_SESSION["name"] = $result["name"];
                                $_SESSION["username"] = $result["username"];
                                $_SESSION["picture"] = $result["picture"];
                                $_SESSION["role"] = $result["role"];

                                //get last login date and time
                                date_default_timezone_set('Asia/Manila');
                                $date = date('Y-m-d');
                                $hour = date('H:i:s');

                                $currentDate = $date . ' ' . $hour;
                                
                                $last_login = UserModel::mdlUpdateUser($table, 'last_login', $currentDate, 'id', $result["id"]);

                                if($last_login == "ok"){
                                    echo '<script>
                                        window.location = "home";
                                    </script>';
                                }else{
                                    echo '<br><div class="alert alert-danger">last login datetime Error!</div>';
                                }
                                
                            }else{
                                echo '<br><div class="alert alert-danger">User is not activated!</div>';        
                            }                            
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
                        $directory = "views/img/users/" . $_POST["addUsername"];

                        mkdir($directory, 0755);

                        if($_FILES["addPicture"]["type"] == "image/jpeg"){

                            $rando = mt_rand(100, 999);

                            //don't add "/" before the directory
                            $route = "views/img/users/" . $_POST["addUsername"] . "/" . $rando . ".jpeg";

                            $source = imagecreatefromjpeg($_FILES["addPicture"]["tmp_name"]);
                            $destination = imagecreatetruecolor($newWidth, $newHeight);

                            imagecopyresized($destination, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

                            imagejpeg($destination, $route);
                        }

                        if($_FILES["addPicture"]["type"] == "image/png"){

                            $rando = mt_rand(100, 999);

                            //don't add "/" before the directory
                            $route = "views/img/users/" . $_POST["addUsername"] . "/" . $rando . ".png";

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

    //edit user
    public function ctrEditUser(){
        
        if(isset($_POST["editName"])){
            if(preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["editName"])){

                $route = $_POST['currentPicture'];

                //Validate Image
                if($_FILES["editPicture"]["error"] != 4){

                    list($width, $height) = getimagesize($_FILES["editPicture"]["tmp_name"]);
                    
                    $newWidth = 500;
                    $newHeight = 500;

                    //don't add "/" before the directory
                    $directory = "views/img/users/" . $_POST["editUsername"];

                    //check if user already has an image
                    if(!empty($_POST['currentPicture'])){

                        unlink($_POST['currentPicture']);
                    }else{

                        mkdir($directory, 0755);
                    }                    

                    if($_FILES["editPicture"]["type"] == "image/jpeg"){

                        $rando = mt_rand(100, 999);

                        //don't add "/" before the directory
                        $route = "views/img/users/" . $_POST["editUsername"] . "/" . $rando . ".jpeg";

                        $source = imagecreatefromjpeg($_FILES["editPicture"]["tmp_name"]);
                        $destination = imagecreatetruecolor($newWidth, $newHeight);

                        imagecopyresized($destination, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

                        imagejpeg($destination, $route);
                    }

                    if($_FILES["editPicture"]["type"] == "image/png"){

                        $rando = mt_rand(100, 999);

                        //don't add "/" before the directory
                        $route = "views/img/users/" . $_POST["editUsername"] . "/" . $rando . ".png";

                        $source = imagecreatefrompng($_FILES["editPicture"]["tmp_name"]);
                        $destination = imagecreatetruecolor($newWidth, $newHeight);

                        imagecopyresized($destination, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

                        imagepng($destination, $route);
                    }
                }

                $table = "users";
                
                if($_POST['editPassword'] != ""){

                    if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editPassword"])){
                        
                        //Blowfish salt
                        $encryption = crypt($_POST["editPassword"], '$2a$07$K3k123lMaO54LtYstringforsalt$');
                    }else{
                        
                        echo "<script>                
                            Swal.fire({
                                icon: 'error',
                                title: 'Password can't have special characters!',
                                text: 'Something went wrong!',
                            }).then((result)=>{
                                if(result.value){
                                    window.location = 'users';
                                }
                            });
                        </script>";
                    }                                        
                }else{
                    $encryption = $_POST['currentPassword'];
                }

                $data = array("name" => $_POST["editName"],
                                "username" => $_POST["editUsername"],
                                "password" => $encryption,
                                "role" => $_POST["editRole"],
                                "picture" => $route,
                                "id" => $_POST["userId"]);

                $result = UserModel::mdlEditUser($table, $data);

                if($result == "ok"){
                    echo "<script>                
                        Swal.fire({
                            icon: 'success',
                            title: 'User was modified successfully!',
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
                            title: 'User modification Error!',
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

    //Delete User
    public function ctrDeleteUser(){

        if(isset($_GET["delete-user-id"])){
            
            $table = "users";
            $data = $_GET["delete-user-id"];

            if($_GET["user-picture"] != ""){
                unlink($_GET["user-picture"]);
                rmdir('views/img/users/' . $_GET["user-username"]);
            }

            $result = UserModel::mdlDeleteUser($table, $data);

            if($result == "ok"){
                echo "<script>
                    Swal.fire(
                        'Deleted!',
                        'User has been deleted.',
                        'success'
                    ).then((response) => {
                        if (response.isConfirmed){
                            window.location = 'users';
                        }
                    });
                </script>";
            }
        }
    }
}