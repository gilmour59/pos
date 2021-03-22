<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage Categories
    </h1>
    <ol class="breadcrumb">
      <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Manage Categories</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAddCategory">
          Add Category
        </button>
      </div>
      <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive datatable-user">
          <thead>
            <tr>
              <th style="width:10px;">#</th>
              <th>Category</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            
          <?php

            $item = null;
            $value = null;

            $categories = CategoryController::ctrShowCategories($item, $value);

            foreach($categories as $key => $value){
              echo '<tr>
                      <td>' . $value["id"] . '</td>
                      <td class="text-uppercase">' . $value["category"] . '</td>
                      <td>
                        <div class="btn-group">
                          <button class="btn btn-warning btn-edit-category" data-category-id="' . $value["id"] . '" data-toggle="modal" data-target="#modalEditCategory"><i class="fa fa-pencil"></i></button>';

                          if($_SESSION['role'] == 'administrator'){

                            echo '<button class="btn btn-danger btn-delete-category" data-category-id="' . $value["id"] . '"><i class="fa fa-times"></i></button>';

                          }
                        echo '</div>
                      </td>                      
                    </tr>';  
            }

          ?>

          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Modal Add Category -->
<div id="modalAddCategory" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form role="form" method="post" id="category-add-form">
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Category</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">

            <div class="form-group">
              <label for="addCategory">Category:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" id="addCategory" name="addCategory" class="form-control input-lg" placeholder="Insert Category Here" required>
              </div>
            </div>

          </div>
        </div>
        <div class="modal-footer">        
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
          <button type="submit" id="category-add-submit" class="btn btn-primary">Save Changes</button>
        </div>

        <?php
          //Adding categories 
          $createCategory = new CategoryController();
          $createCategory->ctrAddCategory();

          $deleteCategory = new CategoryController();
          $deleteCategory->ctrDeleteCategory();
        ?>

      </form>
    </div>

  </div>
</div>

<!-- Modal Edit Category -->
<div id="modalEditCategory" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form role="form" method="post" id="category-edit-form">
        <div class="modal-header" style="background:#228C22; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Category</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">

            <div class="form-group">
              <div class="input-group">
                <label for="editCategory">Category:</label>
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" id="editCategory" name="editCategory" class="form-control input-lg" value="" required>
              </div>
            </div>

            <input type="hidden" name="categoryId" id="categoryId">

          </div>
        </div>
        <div class="modal-footer">        
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
          <button type="submit" id="category-edit-submit" class="btn btn-success">Modify Changes</button>
        </div>

        <?php
          //Edit categories 
          $editCategory = new CategoryController();
          $editCategory->ctrEditCategory();
        ?>

      </form>
    </div>

  </div>
</div>