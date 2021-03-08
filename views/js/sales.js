//Load Dynamic Datatable
$('#products_sales_table').DataTable({
    "ajax" : "ajax/datatable-sales.ajax.php",
    "deferRender" : true,
    "retrieve" : true,
    "processing" : true
});