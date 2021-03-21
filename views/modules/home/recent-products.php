<?php

$item = null;
$value = null;
$order = 'date';

$products = ProductController::ctrShowProducts($item, $value, $order);

?>

<!-- PRODUCT LIST -->
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Recently Added Products</h3>        
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <ul class="products-list product-list-in-box">
            
            <?php 
            
                for($i = 0; $i < 10; $i++){

                    echo '<li class="item">
                            <div class="product-img">
                                <img src="' . $products[$i]['image'] . '" alt="Product Image">
                            </div>
                            <div class="product-info">
                                <a href="" class="product-title">' . $products[$i]['description'] . '
                                    <span class="label label-warning pull-right">Php ' . $products[$i]['sell_price'] . '</span>
                                </a>                                
                            </div>
                        </li>'; 
                }                           

            ?>     
        </ul>
    </div>
    <!-- /.box-body -->
    <div class="box-footer text-center">
        <a href="products" class="uppercase">View All Products</a>
    </div>
    <!-- /.box-footer -->
</div>
<!-- /.box -->