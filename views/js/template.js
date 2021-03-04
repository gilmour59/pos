//Sidebar menu
$(document).ready(function () {
    $('.sidebar-menu').tree()
})

//Datatable for User  
$('.datatable-user').DataTable();

//iCheck for checkbox and radio inputs
$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
    checkboxClass: 'icheckbox_minimal-blue',
    radioClass   : 'iradio_minimal-blue'
  })


