<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sales Report
      </h1>
      <ol class="breadcrumb">
        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Sales Report</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <button type="button" class="btn btn-default" id="btn-sale-report-daterange">
            <span>
              <i class="fa fa-calendar" style="padding-right:7px;"></i>Date Range:
            </span>
            <i class="fa fa-caret-down" style="padding-left:7px;"></i>
          </button>
          <div class="box-tools pull-right">
            
          </div>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-xs-12">

              <?php 

                include "reports/sales-graph.php";

              ?>

            </div>
            <div class="col-md-6 col-xs-12">
              <?php

                include "reports/sales-best-seller-graph.php"

              ?>
            </div>
            <div class="col-md-6 col-xs-12">
              <?php

                include "reports/sellers-graph.php"

              ?>
            </div>
            <div class="col-md-6 col-xs-12">
              <?php

                include "reports/clients-graph.php"

              ?>
            </div>
          </div>
        </div>
        <!-- /.box-body -->        
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->