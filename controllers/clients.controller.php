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
                
                if($result == "ok" && isset($_POST['clientAddSale'])){
                    echo "<script>                
                        Swal.fire({
                            icon: 'success',
                            title: 'Client was saved successfully!',
                            text: 'Hooray!',
                        }).then((result)=>{
                            if(result.value){
                                window.location = 'sales-create';
                            }
                        });
                    </script>";
                }else if($result == "ok"){
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

    //edit client
    public function ctrEditClient(){
        
        if(isset($_POST["clientEdit"])){
            if(preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["editName"]) &&
                preg_match('/^[0-9]+$/', $_POST["editDocumentId"]) &&
                filter_var($_POST["editEmail"], FILTER_VALIDATE_EMAIL) &&
                preg_match('/^[()\-0-9]+$/', $_POST["editPhone"]) &&
                preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["editAddress"])){

                $table = "clients";
                $data = array("name" => $_POST["editName"],
                                "document_id" => $_POST["editDocumentId"],
                                "email" => $_POST["editEmail"],
                                "phone" => $_POST["editPhone"],
                                "address" => $_POST["editAddress"],
                                "birthdate" => $_POST["editBirthdate"],
                                "id" => $_POST["clientId"]);

                $result = ClientModel::mdlEditClient($table, $data);
                
                if($result == "ok"){
                    echo "<script>                
                        Swal.fire({
                            icon: 'success',
                            title: 'Client was modified successfully!',
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
                            title: 'Client modification Error!',
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

    //Delete Client
    public function ctrDeleteClient(){

        if(isset($_GET["delete-client-id"])){
            
            $table = "clients";
            $data = $_GET["delete-client-id"];            

            $result = ClientModel::mdlDeleteClient($table, $data);

            if($result == "ok"){
                echo "<script>
                    Swal.fire(
                        'Deleted!',
                        'Client has been deleted.',
                        'success'
                    ).then((response) => {
                        if (response.isConfirmed){
                            window.location = 'clients';
                        }
                    });
                </script>";
            }
        }
    }
}
?>