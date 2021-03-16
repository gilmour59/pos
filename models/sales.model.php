<?php
require_once "connection.php";

class SaleModel{

    static public function mdlShowSales($table, $item, $value){

        if($item != null){

            $stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE $item = :$item ORDER BY id ASC");
        
            //PDO::PARAM_STR for string
            $stmt->bindParam(":" . $item, $value, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();
        }else{

            $stmt = Connection::connect()->prepare("SELECT * FROM $table ORDER BY id ASC");

            $stmt->execute();

            return $stmt->fetchAll();
        }            

        //Close the connection
        $stmt = null;
    }

    //Getting latest last purchase
    static public function mdlShowLastPurchaseSales($table, $client_id){

        $stmt = Connection::connect()->prepare("SELECT sale_date FROM $table WHERE client_id = :client_id ORDER BY sale_date DESC");

        $stmt->bindParam(":client_id", $client_id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll();
                 
        //Close the connection
        $stmt = null;
    }

    //add sale
    static public function mdlAddSale($table, $data){

        $stmt = Connection::connect()->prepare("INSERT INTO $table (code, client_id, seller_id, products, tax, net_price, total_price, payment_method, sale_date) VALUES (:code, :client_id, :seller_id, :products, :tax, :net_price, :total_price, :payment_method, :sale_date)");

        $stmt->bindParam(":code", $data["code"], PDO::PARAM_STR);
        $stmt->bindParam(":client_id", $data["client_id"], PDO::PARAM_INT);
        $stmt->bindParam(":seller_id", $data["seller_id"], PDO::PARAM_INT);
        $stmt->bindParam(":products", $data["products"], PDO::PARAM_STR);
        $stmt->bindParam(":tax", $data["tax"], PDO::PARAM_STR);
        $stmt->bindParam(":net_price", $data["net_price"], PDO::PARAM_STR);
        $stmt->bindParam(":total_price", $data["total_price"], PDO::PARAM_STR);
        $stmt->bindParam(":payment_method", $data["payment_method"], PDO::PARAM_STR);
        $stmt->bindParam(":sale_date", $data["sale_date"], PDO::PARAM_STR);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt = null;
    }

    //edit sale
    static public function mdlEditSale($table, $data){

        $stmt = Connection::connect()->prepare("UPDATE $table SET client_id = :client_id, seller_id = :seller_id, products = :products, tax = :tax, 
                                                net_price = :net_price, total_price = :total_price, payment_method = :payment_method WHERE code = :code");

        $stmt->bindParam(":code", $data["code"], PDO::PARAM_STR);
        $stmt->bindParam(":client_id", $data["client_id"], PDO::PARAM_INT);
        $stmt->bindParam(":seller_id", $data["seller_id"], PDO::PARAM_INT);
        $stmt->bindParam(":products", $data["products"], PDO::PARAM_STR);
        $stmt->bindParam(":tax", $data["tax"], PDO::PARAM_STR);
        $stmt->bindParam(":net_price", $data["net_price"], PDO::PARAM_STR);
        $stmt->bindParam(":total_price", $data["total_price"], PDO::PARAM_STR);
        $stmt->bindParam(":payment_method", $data["payment_method"], PDO::PARAM_STR);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt = null;
    }

    //delete sale
    static public function mdlDeleteSale($table, $data){

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