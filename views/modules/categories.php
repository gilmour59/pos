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
            <tr>
              <td></td>
              <td></td>
              <td></td>
            </tr>
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
      <form role="form" method="post">
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Category</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" id="addCategory" name="addCategory" class="form-control input-lg" placeholder="Insert Category Here" required>
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