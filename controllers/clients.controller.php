<?php
    
class ClientController{
    
    //show clients
    static public function ctrShowClients($item, $value){

        $table = "clients";
        
        $result = ClientModel::mdlShowClients($table, $item, $value);

        return $result;
    }

    //create clients
    public function ctrAddClient(){

        if(isset($_POST["clientAdd"])){
            if(preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["addName"]) &&
                preg_match('/^[0-9]+$/', $_POST["addDocumentId"]) &&
                filter_var($_POST["addEmail"], FILTER_VALIDATE_EMAIL) &&
                preg_match('/^[()\-0-9]+$/', $_POST["addPhone"]) &&
                preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["addAddress"])){

                $table = "clients";
                $data = array("name" => $_POST["addName"],
                                "document_id" => $_POST["addDocumentId"],
                                "email" => $_POST["addEmail"],
                                "phone" => $_POST["addPhone"],
                                "address" => $_POST["addAddress"],
                                "birthdate" => $_POST["addBirthdate"]);

                $result = ClientModel::mdlAddClient($table, $data);
                
                if($result == "ok"){
                    echo "<script>                
                        Swal.fire({
                            icon: 'success',
                            title: 'Client was saved successfully!',
                            text: 'Hooray!',
                        }).then((result)=>{
                            if(result.value){
                                window.location = 'clients';
                            }
                        });
                    </script>";
                }else{
                    echo "<script>                
                        Swal.fire({
                            icon: 'error',
                            title: 'Client creation Error!',
                            text: 'Something went wrong!',
                        }).then((result)=>{
                            if(result.value){
                                window.location = 'clients';
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
                            window.location = 'clients';
                        }
                    });
                </script>";
            }
        }
    }

    //edit category
    public function ctrEditcategory(){
        
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