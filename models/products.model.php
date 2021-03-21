<?php
require_once "connection.php";

class ProductModel{

    static public function mdlShowProducts($table, $item, $value, $order = null){

        if($item != null){

            $stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE $item = :$item ORDER BY id DESC");
        
            //PDO::PARAM_STR for string
            $stmt->bindParam(":" . $item, $value, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();

        }else if($order != null){

            $stmt = Connection::connect()->prepare("SELECT * FROM $table ORDER BY $order DESC");

            $stmt->execute();

            return $stmt->fetchAll();
        }else{

            $stmt = Connection::connect()->prepare("SELECT * FROM $table");

            $stmt->execute();

            return $stmt->fetchAll();
        }            

        //Close the connection
        $stmt = null;
    }

    static public function mdlAddProduct($table, $data){

        $stmt = Connection::connect()->prepare("INSERT INTO $table (category_id, code, description, stock, buy_price, sell_price, image) 
                                                VALUES (:category_id, :code, :description, :stock, :buy_price, :sell_price, :image)");

        $stmt->bindParam(":category_id", $data["category_id"], PDO::PARAM_STR);
        $stmt->bindParam(":code", $data["code"], PDO::PARAM_STR);
        $stmt->bindParam(":description", $data["description"], PDO::PARAM_STR);
        $stmt->bindParam(":stock", $data["stock"], PDO::PARAM_STR);
        $stmt->bindParam(":buy_price", $data["buy_price"], PDO::PARAM_STR);
        $stmt->bindParam(":sell_price", $data["sell_price"], PDO::PARAM_STR);
        $stmt->bindParam(":image", $data["image"], PDO::PARAM_STR);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt = null;
    }

    static public function mdlEditProduct($table, $data){

        $stmt = Connection::connect()->prepare("UPDATE $table SET category_id = :category_id, description = :description, stock = :stock, 
                                                buy_price = :buy_price, sell_price = :sell_price, image = :image WHERE code = :code");

        $stmt->bindParam(":category_id", $data["category_id"], PDO::PARAM_STR);
        $stmt->bindParam(":code", $data["code"], PDO::PARAM_STR);
        $stmt->bindParam(":description", $data["description"], PDO::PARAM_STR);
        $stmt->bindParam(":stock", $data["stock"], PDO::PARAM_STR);
        $stmt->bindParam(":buy_price", $data["buy_price"], PDO::PARAM_STR);
        $stmt->bindParam(":sell_price", $data["sell_price"], PDO::PARAM_STR);
        $stmt->bindParam(":image", $data["image"], PDO::PARAM_STR);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt = null;
    }

    static public function mdlUpdateProduct($table, $item, $value, $id){

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

    static public function mdlDeleteProduct($table, $data){

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