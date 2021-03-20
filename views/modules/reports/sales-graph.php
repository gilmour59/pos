<?php 

if(isset($_GET['initial-date']) && isset($_GET['final-date'])){

    $initial_date = $_GET['initial-date'];
    $final_date = $_GET['final-date'];
}else{

    $initial_date = null;
    $final_date = null;
}            

$result = SaleController::ctrShowSalesDateRange($initial_date, $final_date);

foreach($result as $key => $value){

}

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
        { y: '2011 Q1', sales: 2666 },
        { y: '2011 Q2', sales: 2778 },
        { y: '2011 Q3', sales: 4912 },
        { y: '2011 Q4', sales: 3767 },
        { y: '2012 Q1', sales: 6810 },
        { y: '2012 Q2', sales: 5670 },
        { y: '2012 Q3', sales: 4820 },
        { y: '2012 Q4', sales: 15073 },
        { y: '2013 Q1', sales: 10687 },
        { y: '2013 Q2', sales: 8432 }
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