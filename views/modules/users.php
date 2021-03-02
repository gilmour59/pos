<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage Users
    </h1>
    <ol class="breadcrumb">
      <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Manage Users</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAddUser">
          Add User
        </button>
      </div>
      <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive datatable-user">
          <thead>
            <tr>
              <th style="width:10px;">#</th>
              <th>Name</th>
              <th>Username</th>
              <th>Picture</th>
              <th>Role</th>
              <th>State</th>
              <th>Last Login</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
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

<!-- Modal Add User -->
<div id="modalAddUser" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add User</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" name="addName" class="form-control input-lg" placeholder="Insert Name Here" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="text" name="addUsername" class="form-control input-lg" placeholder="Insert Username Here" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" name="addPassword" class="form-control input-lg" placeholder="Insert Password Here" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <select name="addRole" class="form-control input-lg">
                  <option value="">Select Role</option>
                  <option value="administrator">Administrator</option>
                  <option value="special">Special</option>
                  <option value="seller">Seller</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <div class="panel panel-default">
                <div class="panel-heading">Add Picture</div>
                <div class="panel-body">
                  <input type="file" name="addPicture" id="addPicture">
                  <p class="help-block">Maximum of 2 MB</p>
                  <img src="/views/img/users/default/anonymous.png" id="imgPreview" class="img-thumbnail" width="100px">
                </div>
              </div>
            </div>

          </div>
        </div>
        <div class="modal-footer">        
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>

        <?php
          //Adding users 
          $createUser = new UserController();
          $createUser->ctrCreateUser();
        ?>

      </form>
    </div>

  </div>
</div>