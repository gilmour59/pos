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
          <div class="input-group">
            <button type="button" class="btn btn-default" id="btn-sale-report-daterange">
              <span>
                <i class="fa fa-calendar" style="padding-right:7px;"></i>Date Range:
              </span>
              <i class="fa fa-caret-down" style="padding-left:7px;"></i>
            </button>
          </div>          
          <div class="box-tools pull-right">

          <?php
          if(isset($_GET['initial-date']) && isset($_GET['final-date'])){
            echo '<a href="/views/modules/download-report.php?report=report&initial-date=' . $_GET['initial-date'] . '&final-date=' . $_GET['final-date'] . '">';
          }else{
            echo '<a href="/views/modules/download-report.php?report=report">';
          }
            
          ?>  

              <button class="btn btn-success" style="margin-top:5px">Export to Excel</button>
            </a>            
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