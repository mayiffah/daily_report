<?php
if (isset($this->session->userdata['logged_in'])) {

header("location:". base_url() . "index.php/nasional/index");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Login</title>
  <!-- Bootstrap core CSS-->
  <link href="<?php echo base_url('bootstrap/vendor/bootstrap/css/bootstrap.min.css');?>"  rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link type="text/css" href="<?php echo base_url('bootstrap/vendor/font-awesome/css/font-awesome.min.css');?>"  rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="<?php echo base_url('bootstrap/css/sb-admin.css');?>"  rel="stylesheet">
  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url('bootstrap/vendor/jquery/jquery.min.js');?>"></script>
  <script src="<?php echo base_url('bootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url('bootstrap/vendor/jquery-easing/jquery.easing.min.js');?>"></script>
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <?php
        if (isset($logout_message)) {
        echo "<div class='message'>";
        echo $logout_message;
        echo "</div>";
        }
        ?>
        <?php
        if (isset($message_display)) {
        echo "<div class='message'>";
        echo $message_display;
        echo "</div>";
        }
      ?>
      <div class="card-header">Login</div>
      <div class="card-body">
        <?php echo form_open('nasional/login'); ?>
        <?php
        echo "<div class='error_msg'>";
        if (isset($error_message)) {
        echo $error_message;
        }
        echo validation_errors();
        echo "</div>";
        ?>
          <div class="form-group">
            <label>Username</label>
            <input class="form-control" type="text" name="username" id="name" aria-describedby="emailHelp" placeholder="Username">
          </div>
          <div class="form-group">
            <label>Password</label>
            <input class="form-control" name="password" id="password" type="password" placeholder="**********">
          </div>
          <!-- <div class="form-group">
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox"> Remember Password</label>
            </div>
          </div> -->
          <input class="btn btn-primary btn-block" type="submit" value=" Login " name="submit"/><br />
        <?php echo form_close(); ?>
        <!-- <div class="text-center">
          <a class="d-block small mt-3" href="register.html">Register an Account</a>
          <a class="d-block small" href="forgot-password.html">Forgot Password?</a>
        </div> -->
      </div>
    </div>
  </div>
</body>

</html>
