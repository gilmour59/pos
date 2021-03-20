<?php 
  session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Inventory System</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
  <!-- Icon -->
  <link rel="icon" href="/views/img/template/icono-negro.png">

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="/views/bower_components/bootstrap/dist/css/bootstrap.min.css">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/views/bower_components/font-awesome/css/font-awesome.min.css">
  
  <!-- Ionicons -->
  <link rel="stylesheet" href="/views/bower_components/Ionicons/css/ionicons.min.css">
  
  <!-- Theme style -->
  <link rel="stylesheet" href="/views/dist/css/AdminLTE.css">
  
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="/views/dist/css/skins/_all-skins.min.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- DataTables -->
  <link rel="stylesheet" href="/views/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="/views/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">

  <!-- iCheck -->
  <link rel="stylesheet" href="/views/plugins/iCheck/all.css">

  <!-- Date Range Picker -->
  <link rel="stylesheet" href="/views/bower_components/bootstrap-daterangepicker/daterangepicker.css">

  <!-- Morris.js -->
  <link rel="stylesheet" href="/views/bower_components/morris.js/morris.css">

  <!-- jQuery 3 -->
  <script src="/views/bower_components/jquery/dist/jquery.min.js"></script>

  <!-- Bootstrap 3.3.7 -->
  <script src="/views/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

  <!-- SlimScroll -->
  <script src="/views/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>

  <!-- FastClick -->
  <script src="/views/bower_components/fastclick/lib/fastclick.js"></script>

  <!-- AdminLTE App -->
  <script src="/views/dist/js/adminlte.min.js"></script>

  <!-- DataTables -->
  <script src="/views/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="/views/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="/views/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
  <script src="/views/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>

  <!-- SweetAlert -->
  <script src="/views/js/sweetalert2@10.js"></script>

  <!-- iCheck -->
  <script src="/views/plugins/iCheck/icheck.min.js"></script>

  <!-- InputMask -->
  <script src="/views/plugins/input-mask/jquery.inputmask.js"></script>
  <script src="/views/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="/views/plugins/input-mask/jquery.inputmask.extensions.js"></script>

  <!-- JQuery Number -->
  <script src="/views/js/jquery.number.js"></script>
  
  <!-- Date Range Picker -->
  <script src="/views/bower_components/moment/min/moment.min.js"></script>
  <script src="/views/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

  <!-- Morris.js -->
  <script src="/views/bower_components/raphael/raphael.min.js"></script>
  <script src="/views/bower_components/morris.js/morris.min.js"></script>
  
</head>

<body class="hold-transition skin-blue sidebar-collapse sidebar-mini login-page">

  <?php
    //if Logged in
    if(isset($_SESSION["initialSession"]) && $_SESSION["initialSession"] == "ok"){

      echo '<!-- Site wrapper -->';
      echo '<div class="wrapper">';

      //header
      include "modules/header.php";

      //menu
      include "modules/menu.php";

      //Routes .htaccess
      if(isset($_GET["route"])){
        if($_GET["route"] == "home" ||
            $_GET["route"] == "users" ||
            $_GET["route"] == "categories" ||
            $_GET["route"] == "products" ||
            $_GET["route"] == "clients" ||
            $_GET["route"] == "sales" ||
            $_GET["route"] == "sales-create" ||
            $_GET["route"] == "sales-edit" ||
            $_GET["route"] == "sales-report" ||
            $_GET["route"] == "logout"){

          include "modules/" . $_GET["route"] .".php";
        }else{
          //404
          include "modules/404.php";
        }
      }else{
        //home
        include "modules/home.php";
      }

      //footer
      include "modules/footer.php";

      echo '</div>';
      echo '<!-- ./wrapper -->';
    }else{
      //login module
      include "modules/login.php";
    }
  ?>

<script src="/views/js/template.js"></script>
<script src="/views/js/users.js"></script>
<script src="/views/js/categories.js"></script>
<script src="/views/js/products.js"></script>
<script src="/views/js/clients.js"></script>
<script src="/views/js/sales.js"></script>
<script src="/views/js/sales-report.js"></script>
</body>
</html>
