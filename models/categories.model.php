<?php
require_once "connection.php";

class CategoryModel{

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
}
?>