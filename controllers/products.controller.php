<?php

class ProductController{

    //show products
    static public function ctrShowProducts($item, $value){

        $table = "products";
        
        $result = ProductModel::mdlShowProducts($table, $item, $value);

        return $result;
    }
}

?>