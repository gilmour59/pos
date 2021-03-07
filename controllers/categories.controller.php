<?php
    
class CategoryController{
    
    //show categories
    static public function ctrShowCategories($item, $value){

        $table = "categories";
        
        $result = CategoryModel::mdlShowCategories($table, $item, $value);

        return $result;
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

    //edit category
    public function ctrEditCategory(){
        
        if(isset($_POST["editCategory"])){
            if(preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["editCategory"])){

                $table = "categories";                            

                $data = array("category" => $_POST["editCategory"],                                
                                "id" => $_POST["categoryId"]);

                $result = CategoryModel::mdlEditCategory($table, $data);

                if($result == "ok"){
                    echo "<script>                
                        Swal.fire({
                            icon: 'success',
                            title: 'Category was modified successfully!',
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
                            title: 'Category modification Error!',
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

    //Delete Category
    public function ctrDeleteCategory(){

        if(isset($_GET["delete-category-id"])){
            
            $table = "categories";
            $data = $_GET["delete-category-id"];            

            $result = CategoryModel::mdlDeleteCategory($table, $data);

            if($result == "ok"){
                echo "<script>
                    Swal.fire(
                        'Deleted!',
                        'Category has been deleted.',
                        'success'
                    ).then((response) => {
                        if (response.isConfirmed){
                            window.location = 'categories';
                        }
                    });
                </script>";
            }
        }
    }
}
?>