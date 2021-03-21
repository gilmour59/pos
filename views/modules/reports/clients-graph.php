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
        {y: 'Client 1', a: 100},
        {y: 'Client 2', a: 75},
        {y: 'Client 3', a: 50},
      ],
      barColors: ['#ff9d5c'],
      xkey: 'y',
      ykeys: ['a'],
      labels: ['sales'],
      hideHover: 'auto',
      preUnits: 'Php'
    });
</script>