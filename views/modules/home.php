<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        <?php

          include "home/top-box.php";

        ?>

      </div>
      <div class="row">
        <div class="col-lg-12">
          
          <?php
          
            include "reports/sales-graph.php";

          ?>

        </div>
        <div class="col-lg-6">
          
          <?php
          
            include "reports/sales-best-seller-graph.php";

          ?>

        </div>
        <div class="col-lg-6">
          
          <?php
          
            include "home/recent-products.php";

          ?>

        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->