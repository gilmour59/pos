//Local Storage Variables
if(localStorage.getItem('capture_date_range_sale_report') != null){
    
    var date_range = JSON.parse(localStorage.getItem('capture_date_range_sale_report'));

    $('#btn-sale-report-daterange span').html(date_range['text']);   

}else{
    $('#btn-sale-report-daterange span').html('<i class="fa fa-calendar" style="padding-right:7px;"></i>Date Range:');
}

//Date range as a button (SALES DATETIME PICKER)
$('#btn-sale-report-daterange').daterangepicker(
    {
      ranges   : {
        'All'    : [moment('1970-01-01'), moment()],
        'Today'       : [moment(), moment()],
        'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month'  : [moment().startOf('month'), moment().endOf('month')],
        'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      startDate: getInitialDate(),
      endDate  : getFinalDate()
      
    },
    function (start, end) {
        if(start.format('MMMM D, YYYY') == moment('1970-01-01').format('MMMM D, YYYY') && end.format('MMMM D, YYYY') == moment().format('MMMM D, YYYY')){
            $('#btn-sale-report-daterange span').html('All');
        }else{
            $('#btn-sale-report-daterange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }

        var initial_date = start.format('YYYY-MM-DD');
        var final_date = end.format('YYYY-MM-DD');

        var capture_date_text = $('#btn-sale-report-daterange span').html();

        var capture_date_range_sale_report = {'initial_date' : start.format('MM/DD/YYYY'), 'final_date' : end.format('MM/DD/YYYY'), 'text' : capture_date_text};

        localStorage.setItem('capture_date_range_sale_report', JSON.stringify(capture_date_range_sale_report));

        window.location ="index.php?route=sales-report&initial-date=" + initial_date + "&final-date=" + final_date;
    }
);

function getInitialDate(){
    if(localStorage.getItem('capture_date_range_sale_report') != null){
        
        var date = JSON.parse(localStorage.getItem('capture_date_range_sale_report'));
        var initial_date = date['initial_date'];

        return initial_date;
    }else{
        
        return moment('1970-01-01');
    }
}

function getFinalDate(){
    if(localStorage.getItem('capture_date_range_sale_report') != null){
        
        var date = JSON.parse(localStorage.getItem('capture_date_range_sale_report'));
        var final_date = date['final_date'];

        return final_date;
    }else{
        
        return moment();
    }
}

//Clear Date Range (SALES DATETIME PICKER) with .opensright class to avoid conflict with the sales daterangepicker
$('.daterangepicker.opensright .range_inputs .cancelBtn').on('click', function(){
    
    localStorage.removeItem('capture_date_range_sale_report');
    window.location = "sales-report";
});