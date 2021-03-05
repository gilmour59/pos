<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage Products
    </h1>
    <ol class="breadcrumb">
      <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Manage Products</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAddProduct">
          Add Product
        </button>
      </div>
      <div class="box-body">
        <table id="products_table" class="table table-bordered table-striped dt-responsive">
          <thead>
            <tr>
              <th style="width:10px;">#</th>
              <th>Image</th>
              <th>Code</th>
              <th>Description</th>
              <th>Category</th>
              <th>Stock</th>
              <th>Sell Price</th>
              <th>Buy Price</th>
              <th>Date Added</th>
              <th>Actions</th>
            </tr>
          </thead>
          <!-- <tbody>
            <?php
              /*
              $item = null;
              $value = null;

              $products = ProductController::ctrShowProducts($item, $value);

              foreach($products as $key => $value_prod){
                echo '<tr>
                        <td>' . $value_prod["id"] . '</td>
                        <td><img src="/views/img/products/default/anonymous.png" class="img-thumbnail" width="40px"></td>
                        <td>' . $value_prod["code"] . '</td>
                        <td>' . $value_prod["description"] . '</td>';
                      
                        $item = "id";
                        $value = $value_prod["category_id"];

                        $category = CategoryController::ctrShowCategories($item, $value);
                        
                echo    '<td>' . $category["category"] . '</td>
                        <td>' . $value_prod["stock"] . '</td>
                        <td>' . $value_prod["buy_price"] . '</td>
                        <td>' . $value_prod["sell_price"] . '</td>                        
                        <td>' . $value_prod["date"] . '</td>
                        <td>
                          <div class="btn-group">
                            <button class="btn btn-warning btn-edit-product" data-product-id="' . $value_prod["id"] . '" data-toggle="modal" data-target="#modalEditProduct"><i class="fa fa-pencil"></i></button>
                            <button class="btn btn-danger btn-delete-product" data-product-id="' . $value_prod["id"] . '"><i class="fa fa-times"></i></button>
                          </div>
                        </td>                      
                      </tr>';  
              }
              */
            ?>            
          </tbody> -->
        </table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Modal Add Product -->
<div id="modalAddProduct" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Product</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">

            <div class="form-group">
              <label for="addCode">Code:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-code"></i></span>
                <input type="text" name="addCode" id="addCode" class="form-control input-lg" placeholder="Insert Code Here" required>
              </div>
            </div>

            <div class="form-group">
              <label for="addDescription">Description:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                <input type="text" name="addDescription" id="addDescription" class="form-control input-lg" placeholder="Insert Description Here" required>
              </div>
            </div>

            <div class="form-group">
              <label for="addCategory">Category:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <select name="addCategory" class="form-control input-lg">
                  <option value="category 1">Category 1</option>
                  <option value="category 2">Category 2</option>
                  <option value="category 3">Category 3</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="addStock">Stock:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-check"></i></span>
                <input type="number" name="addStock" id="addStock" class="form-control input-lg" min="0" placeholder="Insert Stock Here" required>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-xs-6">
                <label for="addPurchasePrice">Buy Price:</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
                  <input type="number" name="addBuyPrice" id="addBuyPrice" class="form-control input-lg" min="0" placeholder="Buy Price Here" required>
                </div>
              </div>
              
              <div class="col-xs-6">
                <label for="addSalePrice">Sell Price:</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>
                  <input type="number" name="addSellPrice" id="addSellPrice" class="form-control input-lg" min="0" placeholder="Sell Price Here" required>
                </div>

                <br>              

                <div class="col-xs-6">
                  <div class="form-group">
                    <label>
                      <input type="checkbox" class="minimal percentage" checked>
                      Use Percentage
                    </label>
                  </div>
                </div>

                <div class="col-xs-6" style="padding:0;">
                  <div class="input-group">
                    <input type="number" class="form-control input-lg newPercentage" min="0" value="40" required>
                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="panel panel-default">
                <div class="panel-heading">Add Image</div>
                <div class="panel-body">
                  <input type="file" name="addImage" id="addImage">
                  <p class="help-block">Maximum of 2 MB</p>
                  <img src="/views/img/products/default/anonymous.png" class="img-thumbnail" width="100px">
                </div>
              </div>
            </div>

          </div>
        </div>
        <div class="modal-footer">        
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
      </form>
    </div>

  </div>
</div>