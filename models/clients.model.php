<?php
require_once "connection.php";

class ClientModel{

    //show clients
    static public function mdlShowClients($table, $item, $value){

        if($item != null){

            $stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE $item = :$item");
        
            //PDO::PARAM_STR for string
            $stmt->bindParam(":" . $item, $value, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();
        }else{

            $stmt = Connection::connect()->prepare("SELECT * FROM $table");

            $stmt->execute();

            return $stmt->fetchAll();
        }            

        //Close the connection
        $stmt = null;
    }
    
    //add client
    static public function mdlAddClient($table, $data){

        $stmt = Connection::connect()->prepare("INSERT INTO $table (name, document_id, email, phone, address, birthdate) VALUES (:name, :document_id, :email, :phone, :address, :birthdate)");

        $stmt->bindParam(":name", $data["name"], PDO::PARAM_STR);
        $stmt->bindParam(":document_id", $data["document_id"], PDO::PARAM_INT);
        $stmt->bindParam(":email", $data["email"], PDO::PARAM_STR);
        $stmt->bindParam(":phone", $data["phone"], PDO::PARAM_STR);
        $stmt->bindParam(":address", $data["address"], PDO::PARAM_STR);
        $stmt->bindParam(":birthdate", $data["birthdate"], PDO::PARAM_STR);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt = null;
    }

    //edit client
    static public function mdlEditClient($table, $data){

        $stmt = Connection::connect()->prepare("UPDATE $table SET name = :name, document_id = :document_id, email = :email, phone = :phone, address = :address, birthdate = :birthdate WHERE id = :id");

        $stmt->bindParam(":name", $data["name"], PDO::PARAM_STR);
        $stmt->bindParam(":document_id", $data["document_id"], PDO::PARAM_INT);
        $stmt->bindParam(":email", $data["email"], PDO::PARAM_STR);
        $stmt->bindParam(":phone", $data["phone"], PDO::PARAM_STR);
        $stmt->bindParam(":address", $data["address"], PDO::PARAM_STR);
        $stmt->bindParam(":birthdate", $data["birthdate"], PDO::PARAM_STR);
        $stmt->bindParam(":id", $data["id"], PDO::PARAM_STR);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt = null;
    }
    
    //update client
    static public function mdlUpdateClient($table, $item, $value, $id){

        $stmt = Connection::connect()->prepare("UPDATE $table SET $item = :$item WHERE id = :id");

        $stmt->bindParam(":" . $item, $value, PDO::PARAM_STR);            
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt = null;
    }

    //delete client
    static public function mdlDeleteClient($table, $data){

        $stmt = Connection::connect()->prepare("DELETE FROM $table WHERE id = :id");

        $stmt->bindParam(":id", $data, PDO::PARAM_STR);                        

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt = null;
    }
}
?>