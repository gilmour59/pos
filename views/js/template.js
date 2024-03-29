//Sidebar menu
$(document).ready(function () {
    $('.sidebar-menu').tree()
})

//Datatable for User  
$('.datatable-user').DataTable({
    "order": [[ 1, "desc" ]]
});

//iCheck for checkbox and radio inputs
$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
    checkboxClass: 'icheckbox_minimal-blue',
    radioClass   : 'iradio_minimal-blue'
});

//Datemask dd/mm/yyyy
$('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })

//Datemask2 mm/dd/yyyy
$('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })

//Money Euro
$('[data-mask]').inputmask()




