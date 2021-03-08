<?php
require_once "connection.php";

class SaleModel{

    static public function mdlShowSales($table, $item, $value){

        if($item != null){

            $stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE $item = :$item ORDER BY sale_date DESC");
        
            //PDO::PARAM_STR for string
            $stmt->bindParam(":" . $item, $value, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();
        }else{

            $stmt = Connection::connect()->prepare("SELECT * FROM $table ORDER BY sale_date DESC");

            $stmt->execute();

            return $stmt->fetchAll();
        }            

        //Close the connection
        $stmt = null;
    }
}

?>