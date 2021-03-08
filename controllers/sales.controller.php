<?php

class SaleController{

    //show sales
    static public function ctrShowSales($item, $value){

        $table = "sales";
        
        $result = SaleModel::mdlShowSales($table, $item, $value);

        return $result;
    } 
}

?>