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

          if($_SESSION['role'] == "administrator"){

            include "home/top-box.php";
          }          

        ?>

      </div>
      <div class="row">
        <div class="col-lg-12">
          
          <?php
          
            if($_SESSION['role'] == "administrator"){
            
              include "reports/sales-graph.php";
            }

          ?>

        </div>
        <div class="col-lg-6">
          
          <?php

            if($_SESSION['role'] == "administrator"){

              include "reports/sales-best-seller-graph.php";
            }

          ?>

        </div>
        <div class="col-lg-6">
          
          <?php
          
            if($_SESSION['role'] == "administrator"){

              include "home/recent-products.php";
            }

          ?>

        </div>
        <div class="col-lg-12">
            
            <?php

              if($_SESSION['role'] == "special" || $_SESSION['role'] == "seller"){

                echo '<div class="box box-success">
                        <div class="box-header">
                          <h1>Welcome ' . $_SESSION['name'] . '</h1>
                        </div>
                      </div>';
              }

            ?>

        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->