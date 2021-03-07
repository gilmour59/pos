<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage Clients
    </h1>
    <ol class="breadcrumb">
      <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Manage Clients</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAddClient">
          Add Client
        </button>
      </div>
      <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive datatable-user">
          <thead>
            <tr>
              <th style="width:10px;">#</th>
              <th>Name</th>
              <th>Document ID</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Address</th>
              <th>Birthdate</th>
              <th>Total Purchases</th>
              <th>Last Purchase</th>
              <th>Last Login</th>
              <th>Action</th>
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