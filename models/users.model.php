<?php
    require_once "connection.php";

    class UserModel{

        //to call with ::
        static public function mdlShowUsers($table, $item, $value){

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

        static public function mdlAddUser($table, $data){

            $stmt = Connection::connect()->prepare("INSERT INTO $table (name, username, password, role, picture) 
                                                    VALUES (:name, :username, :password, :role, :picture)");

            $stmt->bindParam(":name", $data["name"], PDO::PARAM_STR);
            $stmt->bindParam(":username", $data["username"], PDO::PARAM_STR);
            $stmt->bindParam(":password", $data["password"], PDO::PARAM_STR);
            $stmt->bindParam(":role", $data["role"], PDO::PARAM_STR);
            $stmt->bindParam(":picture", $data["picture"], PDO::PARAM_STR);

            if($stmt->execute()){
                return "ok";
            }else{
                return "error";
            }

            $stmt = null;
        }

        static public function mdlEditUser($table, $data){

            $stmt = Connection::connect()->prepare("UPDATE $table SET name = :name, password = :password, 
                                                    role = :role, picture = :picture WHERE id = :id");

            $stmt->bindParam(":name", $data["name"], PDO::PARAM_STR);
            $stmt->bindParam(":password", $data["password"], PDO::PARAM_STR);
            $stmt->bindParam(":role", $data["role"], PDO::PARAM_STR);
            $stmt->bindParam(":picture", $data["picture"], PDO::PARAM_STR);
            $stmt->bindParam(":id", $data["id"], PDO::PARAM_STR);

            if($stmt->execute()){
                return "ok";
            }else{
                return "error";
            }

            $stmt = null;
        }
    }
?>