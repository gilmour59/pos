<?php
    require_once "connection.php";

    class UserModel{

        //to call with ::
        static public function mdlShowUser($table, $item, $value){
            $stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE $item = :$item");
            
            //PDO::PARAM_STR for string
            $stmt->bindParam(":" . $item, $value, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();
        }
    }
?>