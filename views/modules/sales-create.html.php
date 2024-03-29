<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Create Sales
      </h1>
      <ol class="breadcrumb">
        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Create Sales</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- The Form -->
        <div class="col-lg-5 col-xs-12">
          <div class="box box-success">
            <div class="box-header with-border"></div>
            <form role="form" method="post">
              <div class="box-body">              
                <div class="box">

                  <div class="form-group">
                    <label for="newSeller">Seller:</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="text" class="form-control" id="newSeller" name="newSeller" value="User Administrator" readonly>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="newSeller">Sale:</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-key"></i></span>
                      <input type="text" class="form-control" id="newSale" name="newSale" value="10002343" readonly>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="selectClient">Select Customer:</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-users"></i></span>
                      <select name="selectClient" id="selectClient" class="form-control" required>
                        <option value="">Select Client</option>
                      </select>
                      <span class="input-group-addon">
                        <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAddClient" data-dismiss="modal">
                          Select Client
                        </button>
                      </span>
                    </div>
                  </div>

                  <label>Product:</label>
                  <div class="form-group row newProduct">
                    <div class="col-xs-6" style="padding-right:0px;">
                      <div class="input-group">

                        <span class="input-group-addon">
                          <button type="button" class="btn btn-danger btn-xs">
                            <i class="fa fa-times"></i>
                          </button>
                        </span>

                        <input type="text" class="form-control" id="addProduct" name="addProduct" placeholder="Description of Product" required>
                      </div>
                    </div>

                    <div class="col-xs-3">
                      <input type="number" class="form-control" id="addProductQuantity" name="addProductQuantity" min="1" placeholder="0" required>
                    </div>

                    <div class="col-xs-3" style="padding-left:0px;">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                        <input type="number" class="form-control" id="addProductPrice" name="addProductPrice" min="1" placeholder="000000" readonly required>                        
                      </div>
                    </div>
                  </div>

                  <!-- Button Hidden on large screens -->
                  <button type="button" class="btn btn-default hidden-lg">Add Product</button>
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
                                <input type="number" class="form-control" min="0" id="addSaleTax" name="addSaleTax" placeholder="0" required>
                                <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                              </div>
                            </td>
                            <td style="width: 50%;">
                              <div class="input-group">
                                <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                                <input type="number" class="form-control" min="1" id="addSaleTotal" name="addSaleTotal" placeholder="00000" readonly required>
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
                    <div class="col-xs-6" style="padding-right:0px;">
                      <div class="input-group">                                     
                        <select name="addPaymentMethod" id="addPaymentMethod" class="form-control" required>
                          <option value="cash">Cash</option>
                          <option value="creditcard">Credit Card</option>
                          <option value="debitcard">Debit Card</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-xs-6" style="padding-left:0px;">
                      <div class="input-group">
                        <input type="text" class="form-control" id="addTransactionCode" name="addTransactionCode" placeholder="Transaction Code" required>
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                      </div>
                    </div>
                  </div> 
                  <br>                 
                </div>                
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right">Save Changes</button>
              </div>
            </form>
          </div>
        </div>
        <!-- The Products Table -->
        <div class="col-lg-7 hidden-md hidden-sm hidden-xs">
          <div class="box box-warning">
            <div class="box-header with-border"></div>
            <div class="box-body">
              <table class="table table-bordered table-striped dt-responsive datatable-user">
                <thead>
                  <tr>
                    <th style="width:10px;">#</th>
                    <th>Image</th>
                    <th>Code</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Stock</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td><img src="/views/img/products/default/anonymous.png" class="img-thumbnail" width="40px"></td>
                    <td>00123</td>
                    <td>Desc</td>
                    <td>category</td>
                    <td>stock</td>
                    <td>
                      <div class="btn-group">                        
                        <button type="button" class="btn btn-primary">Add</button>
                      </div>
                    </td>
                  </tr>
                </tbody>
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

          $deleteClient = new ClientController();
          $deleteClient->ctrDeleteClient();
        ?>
        
      </form>
    </div>

  </div>
</div>