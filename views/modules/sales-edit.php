<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Sales
      </h1>
      <ol class="breadcrumb">
        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Sales</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- The Form -->
        <div class="col-lg-5 col-xs-12">
          <div class="box box-success">
            <div class="box-header with-border"></div>
            <form role="form" method="post" id="sale-add-form">
              <div class="box-body">              
                <div class="box">
                
                <?php

                  $item = "id";
                  $value = $_GET['sale-id'];
                  
                  $sales = SaleController::ctrShowSales($item, $value);

                  //Getting tax percentage
                  $tax_percentage = $sales['tax'] * 100 / $sales['net_price'];

                  var_dump($sales);

                  $user_item = "id";
                  $user_value = $sales["seller_id"];

                  $user = UserController::ctrShowUsers($user_item, $user_value);

                  $client_item = "id";
                  $client_value = $sales["client_id"];

                  $client = ClientController::ctrShowClients($client_item, $client_value);
                  
                ?>

                  <div class="form-group">
                    <label for="editSeller">Seller:</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="text" class="form-control" id="editSeller" value="<?php echo $user["name"]; ?>" readonly>
                      
                      <input type="hidden" name="idSeller" value="<?php echo $user["id"]; ?>">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="editSaleCode">Sale:</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-key"></i></span>
                      <input type="text" class="form-control" id="editSaleCode" name="editSaleCode" value="<?php echo $sales['code']; ?>" readonly>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="editClient">Select Client:</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-users"></i></span>
                      <select name="editClient" id="editClient" class="form-control" required>
                        <option value="<?php echo $client['id']; ?>"><?php echo $client['name']; ?></option>

                        <?php

                          $item = null;
                          $value = null;

                          $clients = ClientController::ctrShowClients($item, $value);
                          
                          foreach($clients as $key => $value_client){
                            
                            if($client['id'] != $value_client['id']){

                              echo '<option value="' . $value_client['id'] . '">' . $value_client['name'] . '</option>';
                            }                            
                          }
                        ?>

                      </select>
                      <span class="input-group-addon">
                        <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAddClient" data-dismiss="modal">
                          Add Client
                        </button>
                      </span>
                    </div>
                  </div>

                  <label>Product:</label>
                  <div class="form-group row newProduct">
                    
                    <?php

                      $product_list = json_decode($sales['products'], true);

                      var_dump($product_list);
                      foreach($product_list as $key => $value_products){

                        $product_item = "id";
                        $product_value = $value_products['id'];

                        $result = ProductController::ctrShowProducts($product_item, $product_value);

                        $previous_stock = $value_products['quantity'] + $result['stock'];

                      echo  '<div class="row" style="padding:5px 15px">

                                <div class="col-xs-6" style="padding-right:0px;">
                                    <div class="input-group">

                                        <span class="input-group-addon">
                                            <button type="button" class="btn btn-danger btn-xs removeProduct" data-product-id="' . $value_products['id'] . '">
                                            <i class="fa fa-times"></i>
                                            </button>
                                        </span>

                                        <input type="text" class="form-control addProductDescription" data-product-id="' . $value_products['id'] . '" name="addProductDescription" value="' . $value_products['description'] . '" required readonly>
                                    </div>
                                </div>

                                <div class="col-xs-3 parentProductQuantity">
                                    <input type="number" class="form-control addProductQuantity" name="addProductQuantity" min="1" value="' . $value_products['quantity'] . '" data-product-stock="' . $previous_stock . '" data-product-new-stock="' . $value_products['stock'] . '" required>
                                </div>

                                <div class="col-xs-3 parentProductPrice" style="padding-left:0px;">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                                        <input type="text" class="form-control addProductPrice" name="addProductPrice" data-product-price="' . $value_products['net_price'] . '" value="' . $value_products['total_price'] . '" readonly required>
                                    </div>
                                </div>
                            </div>';
                      }                          
                    ?>
                    
                  </div>
                  <input type="hidden" id="productList" name="productList">
                  <!-- Button Hidden on large screens -->
                  <button id="btn-add-product-mobile" type="button" class="btn btn-default hidden-lg">Add Product</button>
                  <hr>
                  <div class="row">
                    <div class="col-xs-8 pull-right">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Tax</th>
                            <th>Total</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td style="width: 50%;">
                              <div class="input-group">
                                <input type="number" class="form-control input-lg" min="0" id="addSaleTax" name="addSaleTax" value="<?php echo $tax_percentage; ?>" required>

                                <input type="hidden" name="addPriceTax" id="addPriceTax" value="<?php echo $sales['tax']; ?>" required>
                                <input type="hidden" name="addPriceNet" id="addPriceNet" value="<?php echo $sales['net_price']; ?>" required>

                                <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                              </div>
                            </td>
                            <td style="width: 50%;">
                              <div class="input-group">
                                <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                                <input type="text" class="form-control input-lg" id="addSaleTotal" name="addSaleTotal" value="<?php echo $sales['total_price']; ?>" data-sale-total readonly required>

                                <!-- Getting the Total without the format -->
                                <input type="hidden" name="totalSale" id="totalSale" value="<?php echo $sales['total_price']; ?>">
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <hr>
                  <label>Payment Method:</label>     
                  <div class="form-group row">
                    <div class="col-xs-4" style="padding-right:0px;">
                      <div class="input-group">                                     
                        <select name="addPaymentMethod" id="addPaymentMethod" class="form-control" required>
                          <option value="cash">Cash</option>
                          <option value="cc">Credit Card</option>
                          <option value="dc">Debit Card</option>
                        </select>
                      </div>
                    </div>
                    <div class="methodPaymentBoxes">
                      <div class="col-xs-4">
                          <div class="input-group">
                              <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                              <input type="text" class="form-control addCashValue" id="addCashValue" placeholder="0000.00" required>
                          </div>
                      </div>
                      <div class="col-xs-4 cashChange" style="padding-left: 0px;">
                          <div class="input-group">
                              <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                              <input type="text" class="form-control addCashChange" name="addCashChange" id="addCashChange" placeholder="0000.00" readonly required>
                          </div>
                      </div>
                    </div>
                    <input type="hidden" name="paymentMethodList" id="paymentMethodList" value="cash">
                  </div> 
                  <br>                 
                </div>                
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right">Modify Changes</button>
              </div>

              <?php

                //Editing sales
                $editSale = new SaleController();
                $editSale->ctrEditSale();

              ?>

            </form>
          </div>
        </div>
        <!-- The Products Table -->
        <div class="col-lg-7 hidden-md hidden-sm hidden-xs">
          <div class="box box-warning">
            <div class="box-header with-border"></div>
            <div class="box-body">
              <table id="products-sales-table" class="table table-bordered table-striped dt-responsive">
                <thead>
                  <tr>
                    <th style="width:10px;">#</th>
                    <th>Image</th>
                    <th>Code</th>
                    <th>Description</th>
                    <th>Stock</th>
                    <th>Actions</th>
                  </tr>
                </thead>                
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Modal Add Client -->
<div id="modalAddClient" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form role="form" method="post">
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Client</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">

            <div class="form-group">
              <label for="addName">Name:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" id="addName" name="addName" class="form-control input-lg" placeholder="Insert Name Here" required>
              </div>
            </div>

            <div class="form-group">
              <label for="addDocumentId">Document ID:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="number" min="0" id="addDocumentId" name="addDocumentId" class="form-control input-lg" placeholder="Insert Document ID Here" required>
              </div>
            </div>

            <div class="form-group">
              <label for="addEmail">Email:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input type="email" id="addEmail" name="addEmail" class="form-control input-lg" placeholder="Insert Email Here" required>
              </div>
            </div>

            <div class="form-group">
              <label for="addPhone">Phone:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                <input type="text" id="addPhone" name="addPhone" class="form-control input-lg" data-inputmask="'mask':'(99-999999999)'" data-mask placeholder="Insert Phone Here" required>
              </div>
            </div>

            <div class="form-group">
              <label for="addAddress">Address:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                <input type="text" id="addAddress" name="addAddress" class="form-control input-lg" placeholder="Insert Address Here" required>
              </div>
            </div>

            <div class="form-group">
              <label for="addBirthdate">Birth Date:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="text" id="addBirthdate" name="addBirthdate" class="form-control input-lg" placeholder="Insert Birthdate Here" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask required>
              </div>
            </div>

            <input type="hidden" name="clientAdd" id="clientAdd">
            <input type="hidden" name="clientAddSale" id="clientAddSale">

          </div>
        </div>
        <div class="modal-footer">        
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>

        <?php
          //Adding clients 
          $createClient = new ClientController();
          $createClient->ctrAddClient();
        ?>
        
      </form>
    </div>

  </div>
</div>