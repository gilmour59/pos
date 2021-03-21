<?php

$item = null;
$value = null;

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

        <?php

        foreach($array_sellers as $key => $value_sellers){

            if($value_sellers != null){
                echo "{y: '" . $key . "', a: " . number_format($value_sellers, 2, '.', '') . "},";
            }else{
                echo "{y: '" . $key . "', a: 0},";
            }
        }        

        ?>
        
      ],
      barColors: ['#0af'],
      xkey: 'y',
      ykeys: ['a'],
      labels: ['Sales'],
      hideHover: 'auto',
      preUnits: 'Php '
    });
</script>