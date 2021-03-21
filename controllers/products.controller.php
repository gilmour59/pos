<?php

class ProductController{

    //show products
    static public function ctrShowProducts($item, $value, $order = null){

        $table = "products";
        
        $result = ProductModel::mdlShowProducts($table, $item, $value, $order);

        return $result;
    }

    public function ctrCreateProduct(){

        if(isset($_POST["productAdd"])){
            if(preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["addDescription"]) &&
                preg_match('/^[0-9]+$/', $_POST["addStock"]) &&
                preg_match('/^[0-9.]+$/', $_POST["addBuyPrice"]) &&
                preg_match('/^[0-9.]+$/', $_POST["addSellPrice"])){

                $route = "views/img/products/default/anonymous.png";

                //Validate Image
                if(isset($_FILES["addImage"]["tmp_name"]) && $_FILES["addImage"]["error"] != 4){

                    list($width, $height) = getimagesize($_FILES["addImage"]["tmp_name"]);
                    
                    $newWidth = 500;
                    $newHeight = 500;

                    //don't add "/" before the directory
                    $directory = "views/img/products/" . $_POST["addCode"];

                    mkdir($directory, 0755);

                    if($_FILES["addImage"]["type"] == "image/jpeg"){

                        $rando = mt_rand(100, 999);

                        //don't add "/" before the directory
                        $route = "views/img/products/" . $_POST["addCode"] . "/" . $rando . ".jpeg";

                        $source = imagecreatefromjpeg($_FILES["addImage"]["tmp_name"]);
                        $destination = imagecreatetruecolor($newWidth, $newHeight);

                        imagecopyresized($destination, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

                        imagejpeg($destination, $route);
                    }

                    if($_FILES["addImage"]["type"] == "image/png"){

                        $rando = mt_rand(100, 999);

                        //don't add "/" before the directory
                        $route = "views/img/products/" . $_POST["addCode"] . "/" . $rando . ".png";

                        $source = imagecreatefrompng($_FILES["addImage"]["tmp_name"]);
                        $destination = imagecreatetruecolor($newWidth, $newHeight);

                        imagecopyresized($destination, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

                        imagepng($destination, $route);
                    }
                }

                $table = "products";
                
                $data = array("category_id" => $_POST["addCategoryProduct"],
                                "code" => $_POST["addCode"],
                                "description" => $_POST["addDescription"],
                                "stock" => $_POST["addStock"],
                                "buy_price" => $_POST["addBuyPrice"],
                                "sell_price" => $_POST["addSellPrice"],
                                "image" => $route);

                $result = ProductModel::mdlAddProduct($table, $data);
                
                if($result == "ok"){
                    echo "<script>                
                        Swal.fire({
                            icon: 'success',
                            title: 'Product was saved successfully!',
                            text: 'Hooray!',
                        }).then((result)=>{
                            if(result.value){
                                window.location = 'products';
                            }
                        });
                    </script>";
                }else{
                    echo "<script>                
                        Swal.fire({
                            icon: 'error',
                            title: 'Product creation Error!',
                            text: 'Something went wrong!',
                        }).then((result)=>{
                            if(result.value){
                                window.location = 'products';
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
                            window.location = 'products';
                        }
                    });
                </script>";
            }
        }
    }

    //Edit Product
    public function ctrEditProduct(){

        if(isset($_POST["productEdit"])){
            if(preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["editDescription"]) &&
                preg_match('/^[0-9]+$/', $_POST["editStock"]) &&
                preg_match('/^[0-9.]+$/', $_POST["editBuyPrice"]) &&
                preg_match('/^[0-9.]+$/', $_POST["editSellPrice"])){

                $route = $_POST["currentImage"];

                //Validate Image
                if(isset($_FILES["editImage"]["tmp_name"]) && $_FILES["editImage"]["error"] != 4){

                    list($width, $height) = getimagesize($_FILES["editImage"]["tmp_name"]);
                    
                    $newWidth = 500;
                    $newHeight = 500;

                    //don't add "/" before the directory
                    $directory = "views/img/products/" . $_POST["editCode"];

                    //check if product already has an image
                    if(!empty($_POST['currentImage']) && $_POST['currentImage'] != "views/img/products/default/anonymous.png"){

                        unlink($_POST['currentImage']);
                    }else{

                        mkdir($directory, 0755);
                    }

                    if($_FILES["editImage"]["type"] == "image/jpeg"){

                        $rando = mt_rand(100, 999);

                        //don't add "/" before the directory
                        $route = "views/img/products/" . $_POST["editCode"] . "/" . $rando . ".jpeg";

                        $source = imagecreatefromjpeg($_FILES["editImage"]["tmp_name"]);
                        $destination = imagecreatetruecolor($newWidth, $newHeight);

                        imagecopyresized($destination, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

                        imagejpeg($destination, $route);
                    }

                    if($_FILES["editImage"]["type"] == "image/png"){

                        $rando = mt_rand(100, 999);

                        //don't add "/" before the directory
                        $route = "views/img/products/" . $_POST["editCode"] . "/" . $rando . ".png";

                        $source = imagecreatefrompng($_FILES["editImage"]["tmp_name"]);
                        $destination = imagecreatetruecolor($newWidth, $newHeight);

                        imagecopyresized($destination, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

                        imagepng($destination, $route);
                    }
                }

                $table = "products";
                
                $data = array("category_id" => $_POST["editCategoryProduct"],
                                "code" => $_POST["editCode"],
                                "description" => $_POST["editDescription"],
                                "stock" => $_POST["editStock"],
                                "buy_price" => $_POST["editBuyPrice"],
                                "sell_price" => $_POST["editSellPrice"],
                                "image" => $route);

                $result = ProductModel::mdlEditProduct($table, $data);
                
                if($result == "ok"){
                    echo "<script>                
                        Swal.fire({
                            icon: 'success',
                            title: 'Product was modified successfully!',
                            text: 'Hooray!',
                        }).then((result)=>{
                            if(result.value){
                                window.location = 'products';
                            }
                        });
                    </script>";
                }else{
                    echo "<script>                
                        Swal.fire({
                            icon: 'error',
                            title: 'Product modification Error!',
                            text: 'Something went wrong!',
                        }).then((result)=>{
                            if(result.value){
                                window.location = 'products';
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
                            window.location = 'products';
                        }
                    });
                </script>";
            }
        }
    }
    
    //Delete User
    public function ctrDeleteProduct(){

        if(isset($_GET["delete-product-id"])){
            
            $table = "products";
            $data = $_GET["delete-product-id"];

            if($_GET["product-image"] != "" && $_GET["product-image"] != "views/img/products/default/anonymous.png"){
                unlink($_GET["product-image"]);
                rmdir('views/img/products/' . $_GET["product-code"]);
            }

            $result = ProductModel::mdlDeleteProduct($table, $data);

            if($result == "ok"){
                echo "<script>
                    Swal.fire(
                        'Deleted!',
                        'Product has been deleted.',
                        'success'
                    ).then((response) => {
                        if (response.isConfirmed){
                            window.location = 'products';
                        }
                    });
                </script>";
            }
        }
    }

    //Get Sum of All Sales
    static public function ctrSumProductSales(){

        $table = "products";

        $result = ProductModel::mdlSumProductSales($table);

        return $result;
    }
}

?>