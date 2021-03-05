<?php

class ProductController{

    //show products
    static public function ctrShowProducts($item, $value){

        $table = "products";
        
        $result = ProductModel::mdlShowProducts($table, $item, $value);

        return $result;
    }

    public function ctrCreateProduct(){

        if(isset($_POST["productAdd"])){
            if(preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["addDescription"]) &&
                preg_match('/^[0-9]+$/', $_POST["addStock"]) &&
                preg_match('/^[0-9.]+$/', $_POST["addBuyPrice"]) &&
                preg_match('/^[0-9.]+$/', $_POST["addSellPrice"])){

                $table = "products";
                $data = array("category_id" => $_POST["addCategoryProduct"],
                                "code" => $_POST["addCode"],
                                "description" => $_POST["addDescription"],
                                "stock" => $_POST["addStock"],
                                "buy_price" => $_POST["addBuyPrice"],
                                "sell_price" => $_POST["addSellPrice"],
                                "image" => $_POST["addImage"]);

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
}

?>