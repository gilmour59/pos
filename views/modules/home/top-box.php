<?php

$item = null;
$value = null;

$sales = SaleController::ctrSumSales();    

$categories = CategoryController::ctrShowCategories($item, $value);
$clients = ClientController::ctrShowClients($item, $value);
$products = ProductController::ctrShowProducts($item, $value);

$total_categories = count($categories);
$total_clients = count($clients);
$total_products = count($products);

?>

<div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-aqua">
    <div class="inner">
        <h3><?php echo 'Php ' . number_format($sales['total'], 2) ?></h3>

        <p>Sales</p>
    </div>
    <div class="icon">
        <i class="ion ion-social-usd"></i>
    </div>
    <a href="sales" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-green">
    <div class="inner">
        <h3><?php echo $total_categories ?></h3>

        <p>Categories</p>
    </div>
    <div class="icon">
        <i class="ion ion-clipboard"></i>
    </div>
    <a href="categories" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-yellow">
    <div class="inner">
        <h3><?php echo $total_clients ?></h3>

        <p>Clients</p>
    </div>
    <div class="icon">
        <i class="ion ion-person-add"></i>
    </div>
    <a href="clients" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-red">
    <div class="inner">
        <h3><?php echo $total_products ?></h3>

        <p>Products</p>
    </div>
    <div class="icon">
        <i class="ion ion-ios-cart"></i>
    </div>
    <a href="products" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>
<!-- ./col -->