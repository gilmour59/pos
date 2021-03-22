<?php

if($_SESSION['role'] != "administrator" && $_SESSION['role'] != "special"){

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
        <button id="btn-add-product" class="btn btn-primary" data-toggle="modal" data-target="#modalAddProduct">
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
        </table>
        <input type="hidden" id="products-user-role" value="<?php echo $_SESSION['role']; ?>">
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
              <label for="addCategoryProduct">Category:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <select id="addCategoryProduct" name="addCategoryProduct" class="form-control input-lg" required>
                
                <?php 
                  $item = null;
                  $value = null;

                  $categories = CategoryController::ctrShowCategories($item, $value);

                  foreach($categories as $key => $value){
                    echo "<option value='" . $value["id"] ."'>" . $value["category"] ."</option>";
                  }
                ?>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="addCode">Code:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-code"></i></span>
                <input type="text" name="addCode" id="addCode" class="form-control input-lg" required readonly>
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
              <label for="addStock">Stock:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-check"></i></span>
                <input type="number" name="addStock" id="addStock" class="form-control input-lg" min="0" placeholder="Insert Stock Here" required>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-xs-12 col-sm-6">
                <label for="addPurchasePrice">Buy Price:</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
                  <input type="number" step="any" name="addBuyPrice" id="addBuyPrice" class="form-control input-lg" min="0" placeholder="Buy Price Here" required>
                </div>
              </div>
              
              <div class="col-xs-12 col-sm-6">
                <label for="addSalePrice">Sell Price:</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>
                  <input type="number" step="any" name="addSellPrice" id="addSellPrice" class="form-control input-lg" min="0" placeholder="Sell Price Here" required>
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
                  <input type="file" name="addImage" id="addImage" class="picture-validate-products">
                  <p class="help-block">Maximum of 2 MB</p>
                  <img src="/views/img/products/default/anonymous.png" id="imgPreviewAdd" class="img-thumbnail" width="100px">
                </div>
              </div>
            </div>

            <input type="hidden" name="productAdd" id="productAdd" value="productAdd">

          </div>
        </div>
        <div class="modal-footer">        
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>

        <?php

          //Adding products 
          $createProduct = new ProductController();
          $createProduct->ctrCreateProduct();

          $deleteUser = new ProductController();
          $deleteUser->ctrDeleteProduct();
        ?>

      </form>
    </div>

  </div>
</div>

<!-- Modal Edit Product -->
<div id="modalEditProduct" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-header" style="background:#228C22; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Product</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">

          <div class="form-group">
              <label for="editCategoryProduct">Category:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <select name="editCategoryProduct" class="form-control input-lg" required readonly>
                  <option id="editCategoryProduct"></option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="editCode">Code:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-code"></i></span>
                <input type="text" name="editCode" id="editCode" class="form-control input-lg" required readonly>
              </div>
            </div>

            <div class="form-group">
              <label for="editDescription">Description:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                <input type="text" name="editDescription" id="editDescription" class="form-control input-lg" required>
              </div>
            </div>            

            <div class="form-group">
              <label for="editStock">Stock:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-check"></i></span>
                <input type="number" name="editStock" id="editStock" class="form-control input-lg" min="0" required>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-xs-12 col-sm-6">
                <label for="editBuyPrice">Buy Price:</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
                  <input type="number" step="any" name="editBuyPrice" id="editBuyPrice" class="form-control input-lg" min="0" required>
                </div>
              </div>
              
              <div class="col-xs-12 col-sm-6">
                <label for="editSellPrice">Sell Price:</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>
                  <input type="number" step="any" name="editSellPrice" id="editSellPrice" class="form-control input-lg" min="0" required>
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
                <div class="panel-heading">Edit Image</div>
                <div class="panel-body">

                  <input type="hidden" id="currentImage" name="currentImage">

                  <input type="file" name="editImage" id="editImage" class="picture-validate-products">
                  <p class="help-block">Maximum of 2 MB</p>
                  <img id="imgPreviewEdit" class="img-thumbnail" width="100px">
                </div>
              </div>
            </div>

            <input type="hidden" name="productEdit" id="productEdit" value="productEdit">

          </div>
        </div>
        <div class="modal-footer">        
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Save Changes</button>
        </div>

        <?php

          //Edit products 
          $editProduct = new ProductController();
          $editProduct->ctrEditProduct();
        ?>

      </form>
    </div>

  </div>
</div>