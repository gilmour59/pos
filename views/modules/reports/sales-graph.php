<?php 

if(isset($_GET['initial-date']) && isset($_GET['final-date'])){

    $initial_date = $_GET['initial-date'];
    $final_date = $_GET['final-date'];
}else{

    $initial_date = null;
    $final_date = null;
}            

$result = SaleController::ctrShowSalesDateRange($initial_date, $final_date);

//Sales array to pass on the graph
$date_array = array();
$sales_array = array();

foreach($result as $key => $value){

    //Get date (month and year)
    $date = substr($value['sale_date'], 0, 7);

    array_push($date_array, $date);

    //Get total sales
    if(isset($sales_array[$date])){
        $sales_array[$date] += $value['total_price'];
    }else{
        $sales_array = array_merge($sales_array, array($date => 0));
        $sales_array[$date] += $value['total_price'];
    }
}

var_dump($sales_array);

?>

<!-- Sales Graph -->
<div class="box box-solid bg-teal-gradient">
    <div class="box-header">
        <i class="fa fa-th"></i>
        <h3 class="box-title">Sales Graph</h3>
    </div>
    <div class="box-body border-radius-none newSalesGraph">
        <div class="chart" id="line-sales-chart" style="height: 250px;"></div>
    </div>
</div>

<script>
    //Sales Graph Morris line chart
    var line = new Morris.Line({
        element          : 'line-sales-chart',
        resize           : true,
        data             : [

        <?php

            foreach($date_array as $key => $value){
                echo "{ y: '2011 Q1', sales: 2666 },";
            }

                echo "{ y: '2013 Q2', sales: 8432 }";

        ?>
        
        ],
        xkey             : 'y',
        ykeys            : ['sales'],
        labels           : ['Sales'],
        lineColors       : ['#efefef'],
        lineWidth        : 2,
        hideHover        : 'auto',
        gridTextColor    : '#fff',
        gridStrokeWidth  : 0.4,
        pointSize        : 4,
        pointStrokeColors: ['#efefef'],
        gridLineColor    : '#efefef',
        gridTextFamily   : 'Open Sans',
        gridTextSize     : 10,
        preUnits         : 'Php '
    });
</script>