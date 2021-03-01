<div id="back"></div>
<div class="login-box">
  <div class="login-logo">
    <img src="/views/img/template/logo-blanco-bloque.png" class="img-responsive" style="padding:30px 100px 0px 100px">
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Log in here:</p>

    <form method="post">
      <div class="form-group has-feedback">
        <input id="username" type="text" class="form-control" placeholder="username" name="username" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input id="password" type="password" class="form-control" placeholder="password" name="password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>

      <?php 
        $login = new UserController();
        $login->ctrUserLogin();
      ?>

    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->