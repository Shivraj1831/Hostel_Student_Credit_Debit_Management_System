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
if(isset($_POST['btnlogin']))
{
	$sql = "SELECT * FROM student WHERE (enrollment_no='$_POST[loginid]' OR admission_no='$_POST[loginid]') AND student_password='" . md5($_POST['password']) . "' AND student_status='Active' ";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_num_rows($qsql) == 1)
	{
		$rslogin = mysqli_fetch_array($qsql);
		$_SESSION['student_id'] = $rslogin['student_id'];
		echo "<script>window.location='studentpanel.php';</script>";
	}
	else
	{
		echo "<script>alert('Login ID and password not valid..');</script>";
		echo "<script>window.location='index.php';</script>";	
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
  <div class="card card-outline card-success">
    <div class="card-header text-center">
      <a href="index.php" class="h1"><img src="<?php echo $logo; ?>" style="width: 100%;"></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          <input type="text" name="loginid" id="loginid" class="form-control" placeholder="Admission No. or Roll No.">
        </div>
        <div class="input-group mb-3">          
			<div class="input-group-append">
				<div class="input-group-text">
					<span class="fas fa-lock"></span>
				</div>
			</div>
          <input type="password" name="password" id="password"  class="form-control" placeholder="Enter Password">
        </div>
      <div class="social-auth-links text-center mt-2 mb-3">
        <button type="submit" name="btnlogin" class="btn btn-success btn-info"><i class="fab fa-creative-commons-by mr-2"></i> Click Here to Login</button>
      </div>
      <!-- /.social-auth-links -->

      <p class="mb-1"><hr>
      </p>
      <p class="mb-0">
        <Center><a href="register.php" class="text-center"><b>New User - Click Here to Register</b></a></center>
      </p>
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
