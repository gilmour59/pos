<?php

if($_SESSION['role'] != "administrator" && $_SESSION['role'] != "seller"){

  echo '<script>

          window.location = "home";

        </script>';
        return;
}

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage Sales
    </h1>
    <ol class="breadcrumb">
      <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Manage Sales</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <a href="sales-create">
          <button class="btn btn-primary">
            Add Sale
          </button>
        </a>        
        <button type="button" class="btn btn-default pull-right" id="btn-sale-daterange">
          <span>
            <i class="fa fa-calendar" style="padding-right:7px;"></i>Date Range:
          </span>
          <i class="fa fa-caret-down" style="padding-left:7px;"></i>
        </button>
      </div>
      <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive datatable-user">
          <thead>
            <tr>
              <th style="width:10px;">#</th>
              <th>Billing Code</th>
              <th>Client</th>
              <th>Seller</th>
              <th>Form of Payment</th>
              <th>Net Price</th>
              <th>Total Price</th>
              <th>Date</th>              
              <th>Action</th>
            </tr>
          </thead>
          <tbody>

          <?php

            if(isset($_GET['initial-date']) && isset($_GET['final-date'])){

              $initial_date = $_GET['initial-date'];
              $final_date = $_GET['final-date'];
            }else{

              $initial_date = null;
              $final_date = null;
            }            

            $result = SaleController::ctrShowSalesDateRange($initial_date, $final_date);

            foreach($result as $key => $value){
              
              echo '<tr>
                      <td>' . $value['id'] . '</td>
                      <td>' . $value['code'] . '</td>';

                      //Getting Client
                      $client_item = "id";
                      $client_value = $value['client_id'];
                      $client = ClientController::ctrShowClients($client_item, $client_value);

              echo   '<td>' . $client['name'] . '</td>';

                      //Getting Seller
                      $seller_item = "id";
                      $seller_value = $value['seller_id'];
                      $seller = UserController::ctrShowUsers($seller_item, $seller_value);

              echo   '<td>' . $seller['name'] . '</td>

                      <td>' . $value['payment_method'] . '</td>
                      <td>' . number_format($value['net_price'], 2) . '</td>
                      <td>' . number_format($value['total_price'], 2) . '</td>
                      <td>' . $value['sale_date'] . '</td>
                      <td>
                        <button class="btn btn-info btn-print-bill" data-sale-code="' . $value['code'] . '"><i class="fa fa-print"></i></button>';

                        if($_SESSION['role'] == 'administrator'){
                          //add space before the anchor tag
                          echo ' <a href="index.php?route=sales-edit&sale-id='. $value['id'] .'"><button class="btn btn-warning"><i class="fa fa-pencil"></i></button></a>
                                <button class="btn btn-danger btn-delete-sale" data-sale-id="' . $value['id'] . '"><i class="fa fa-times"></i></button>';
                        }
                        
                      echo '</td>
                    </tr>';
            }
          ?>
                      
          </tbody>
        </table>

        <?php 

          $deleteSale = new SaleController();
          $deleteSale->ctrDeleteSale();

        ?>
        
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->