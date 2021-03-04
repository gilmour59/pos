<?php
require_once "connection.php";

class CategoryModel{

    //show categories
    static public function mdlShowCategories($table, $item, $value){

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
    
    //add category
    static public function mdlAddCategory($table, $data){

        $stmt = Connection::connect()->prepare("INSERT INTO $table (category) VALUES (:category)");

        $stmt->bindParam(":category", $data, PDO::PARAM_STR);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt = null;
    }

    //edit category
    static public function mdlEditCategory($table, $data){

        $stmt = Connection::connect()->prepare("UPDATE $table SET category = :category WHERE id = :id");

        $stmt->bindParam(":category", $data["category"], PDO::PARAM_STR);
        $stmt->bindParam(":id", $data["id"], PDO::PARAM_STR);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt = null;
    }

    //delete category
    static public function mdlDeleteCategory($table, $data){

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