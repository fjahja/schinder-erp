<?php $_GET['mdl'] = (isset($_GET['mdl']) ? $_GET['mdl'] : null); ?>

<?php require('snippets/html_head.php'); ?>

<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <img src="logo.png" class="img-responsive">
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">

    <form action="login-processor.php?v=admin-login" method="post">
      <div class="form-group has-feedback">
        <input type="text" name="Form[username]" autofocus="" class="form-control" placeholder="Username">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="Form[password]" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>

      <?php if ($_GET['mdl'] == 'wrong_cred'): ?>
        <div class="row mt-sm text-center">
          <div class="col-xs-12">
            <p style="color:red;">Your username/password is wrong.</p>
          </div>
        </div>
      <?php endif ?>

      <?php if ($_GET['mdl'] == 'logout_success'): ?>
        <div class="row mt-sm text-center">
          <div class="col-xs-12">
            <p style="color:red;">You have been logged out.</p>
          </div>
        </div>
      <?php endif ?>

      <?php if ($_GET['mdl'] == 'access_denied'): ?>
        <div class="row mt-sm text-center">
          <div class="col-xs-12">
            <p style="color:red;">Your access has been denied.</p>
          </div>
        </div>
      <?php endif ?>

    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->



<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>