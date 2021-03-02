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

          <?php

            $item = null;
            $value = null;

            $users = UserController::ctrShowUsers($item, $value);

            foreach($users as $key => $value){
              echo '<tr>
                      <td>' . $value["id"] . '</td>
                      <td>' . $value["name"] . '</td>
                      <td>' . $value["username"] . '</td>';

                      if($value["picture"] != ""){
                        echo '<td><img src="' . $value["picture"] . '" class="img-thumbnail" width="40px"></td>';
                      }else{
                        echo '<td><img src="views/img/users/default/anonymous.png" class="img-thumbnail" width="40px"></td>';
                      }

              echo   '<td>' . $value["role"] . '</td>
                      <td><button class="btn btn-success btn-xs">Activated</button></td>
                      <td>' . $value["last_login"] . '</td>
                      <td>
                        <div class="btn-group">
                          <button class="btn btn-warning" data-toggle="modal" data-target="#modalEditUser"><i class="fa fa-pencil"></i></button>
                          <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                        </div>
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
              <label for="addname">Name:</label>
              <div class="input-group">                
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" id="addName" name="addName" class="form-control input-lg" placeholder="Insert Name Here" required>
              </div>
            </div>

            <div class="form-group">
              <label for="addUsername">Username:</label>
              <div class="input-group">                
                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="text" id="addUsername" name="addUsername" class="form-control input-lg" placeholder="Insert Username Here" required>
              </div>
            </div>

            <div class="form-group">
              <label for="addPassword">Password:</label>
              <div class="input-group">                
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" id="addPassword" name="addPassword" class="form-control input-lg" placeholder="Insert Password Here" required>
              </div>
            </div>

            <div class="form-group">
              <label for="addRole">Role:</label>
              <div class="input-group">                
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <select id="addRole" name="addRole" class="form-control input-lg">                  
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
                  <input type="file" name="addPicture" id="addPicture" class="picture-validate">
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

<!-- Modal Edit User -->
<div id="modalEditUser" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-header" style="background:#228C22; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit User</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">

            <div class="form-group">
              <label for="editname">Edit Name:</label>
              <div class="input-group">                
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" id="editName" name="editName" class="form-control input-lg" value="" required>
              </div>
            </div>

            <div class="form-group">
              <label for="editUsername">Edit Username:</label>
              <div class="input-group">                
                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="text" id="editUsername" name="editUsername" class="form-control input-lg" value="" required>
              </div>
            </div>            

            <div class="form-group">
              <label for="editPassword">Edit Password:</label>
              <div class="input-group">                
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" id="editPassword" name="editPassword" class="form-control input-lg" placeholder="Edit Password Here" required>
              </div>
            </div>

            <div class="form-group">
              <label for="editRole">Edit Role:</label>
              <div class="input-group">                
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <select id="editRole" name="editRole" class="form-control input-lg">                  
                  <option value="administrator">Administrator</option>
                  <option value="special">Special</option>
                  <option value="seller">Seller</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <div class="panel panel-default">
                <div class="panel-heading">Edit Picture</div>
                <div class="panel-body">
                  <input type="file" name="editPicture" id="editPicture" class="picture-validate">
                  <p class="help-block">Maximum of 2 MB</p>
                  <img src="/views/img/users/default/anonymous.png" id="imgPreview" class="img-thumbnail" width="100px">
                </div>
              </div>
            </div>

          </div>
        </div>
        <div class="modal-footer">        
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Modify Changes</button>
        </div>

        <?php
          //Adding users 
          //$createUser = new UserController();
          //$createUser->ctrCreateUser();
        ?>

      </form>
    </div>

  </div>
</div>