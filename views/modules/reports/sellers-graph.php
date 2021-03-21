<?php

$item = null;
$value = null;

$sales = SaleController::ctrShowSales($item, $value);
$users = UserController::ctrShowUsers($item, $value);

$array_sellers = array();

foreach($users as $key => $value_users){

    $total = SaleController::ctrSumSellerSales($value_users['id']);

    if(isset($array_sellers[$value_users['name']])){
        $array_sellers[$value_users['name']] = $total['total'];
    }else{
        $array_sellers = array_merge($array_sellers, array($value_users['name'] => ""));
        $array_sellers[$value_users['name']] = $total['total'];
    }
}

var_dump($array_sellers);

?>

<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Sellers</h3>
    </div>
    <div class="box-body">
        <div class="chart-responsive">
            <div class="chart" id="bar-chart-sellers" style="height:300px;"></div>
        </div>
    </div>
</div>

<script>
    //BAR CHART
    var bar = new Morris.Bar({
      element: 'bar-chart-sellers',
      resize: true,
      data: [
        {y: 'Seller 1', a: 100},
        {y: 'Seller 2', a: 75},
        {y: 'Seller 3', a: 50},
      ],
      barColors: ['#0af'],
      xkey: 'y',
      ykeys: ['a'],
      labels: ['sales'],
      hideHover: 'auto',
      preUnits: 'Php'
    });
</script>