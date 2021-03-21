<?php

$item = null;
$value = null;

$clients = ClientController::ctrShowClients($item, $value);

$array_clients = array();

foreach($clients as $key => $value_clients){

    $total = SaleController::ctrSumClientSales($value_clients['id']);

    if(isset($array_clients[$value_clients['name']])){
        $array_clients[$value_clients['name']] = $total['total'];
    }else{
        $array_clients = array_merge($array_clients, array($value_clients['name'] => ""));
        $array_clients[$value_clients['name']] = $total['total'];
    }
}

?>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Clients</h3>
    </div>
    <div class="box-body">
        <div class="chart-responsive">
            <div class="chart" id="bar-chart-clients" style="height:300px;"></div>
        </div>
    </div>
</div>

<script>
    //BAR CHART
    var bar = new Morris.Bar({
      element: 'bar-chart-clients',
      resize: true,
      data: [
        
        <?php

        foreach($array_clients as $key => $value_clients){

            if($value_clients != null){
                echo "{y: '" . $key . "', a: " . number_format($value_clients, 2, '.', '') . "},";
            }else{
                echo "{y: '" . $key . "', a: 0},";
            }
        }        

        ?>

      ],
      barColors: ['#ff9d5c'],
      xkey: 'y',
      ykeys: ['a'],
      labels: ['sales'],
      hideHover: 'auto',
      preUnits: 'Php '
    });
</script>