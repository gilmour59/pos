<?php
    
class CategoryController{
    
    //show categories
    static public function ctrShowCategories(){

    }

    //create categories
    public function ctrAddCategory(){

        if(isset($_POST["addCategory"])){
            if(preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["addCategory"])){

                $table = "categories";
                $data = $_POST["addCategory"];

                $result = CategoryModel::mdlAddCategory($table, $data);
                
                if($result == "ok"){
                    echo "<script>                
                        Swal.fire({
                            icon: 'success',
                            title: 'Category was saved successfully!',
                            text: 'Hooray!',
                        }).then((result)=>{
                            if(result.value){
                                window.location = 'categories';
                            }
                        });
                    </script>";
                }else{
                    echo "<script>                
                        Swal.fire({
                            icon: 'error',
                            title: 'Category creation Error!',
                            text: 'Something went wrong!',
                        }).then((result)=>{
                            if(result.value){
                                window.location = 'categories';
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
                            window.location = 'categories';
                        }
                    });
                </script>";
            }
        }
    }
}
?>