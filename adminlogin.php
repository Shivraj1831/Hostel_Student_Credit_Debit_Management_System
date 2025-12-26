<?php
include("webconfig.php");
if(isset($_SESSION['staff_id']))
{
	echo "<script>window.location='dashboard.php';</script>";
}
if(isset($_SESSION['student_id']))
{
	echo "<script>window.location='studentpanel.php';</script>";
}
//btnlogin loginid password
if(isset($_POST['btnlogin']))
{
	$sql = "SELECT * FROM staff WHERE staff_login_id='$_POST[loginid]' AND staff_password='" . md5($_POST['password']) . "' AND staff_status='Active' ";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_num_rows($qsql) == 1)
	{
		$rslogin = mysqli_fetch_array($qsql);
		$_SESSION['staff_id'] = $rslogin['staff_id'];
		$_SESSION['staff_type'] = $rslogin['staff_type'];
		echo "<script>window.location='dashboard.php';</script>";
	}
	else
	{
		echo "<script>alert('Login ID and password not valid..');</script>";
		echo "<script>window.location='adminlogin.php';</script>";	
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>	
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $projecttitle; ?> - <?php echo $projectsubtitle; ?></title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="index.php" class="h1"><img src="<?php echo $logo; ?>" style="width: 100%;"></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg"><B style="color: red;">ADMIN LOGIN PANEL</B></p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="text" name="loginid" id="loginid" class="form-control" placeholder="Login ID">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" id="password"  class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

      <div class="social-auth-links text-center mt-2 mb-3">
        <button type="submit" name="btnlogin" class="btn btn-block btn-danger"><i class="fab fa-creative-commons-by mr-2"></i> Login to Admin Panel</button>
      </div>
      <!-- /.social-auth-links -->

      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
