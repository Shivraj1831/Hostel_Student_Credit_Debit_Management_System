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
if(isset($_POST['submit']))
{
	$password = md5($_POST['student_password']);
	$sql ="INSERT INTO student( course_id, enrollment_no, admission_no, student_name, student_dob, student_gender, student_address, student_state, student_contact, student_email, student_password, student_bankdetail, student_note, student_pan, student_photo, student_idproof, student_addressproof, student_status) values('$_POST[course_id]','$_POST[enrollment_no]','$_POST[admission_no]','$_POST[student_name]','$_POST[student_dob]','$_POST[student_gender]','$_POST[student_address]','$_POST[student_state]','$_POST[student_contact]','$_POST[student_email]','$password','$_POST[student_bankdetail]','$_POST[student_note]','$_POST[student_pan]','$_POST[student_photo]','$_POST[student_idproof]','$_POST[student_addressproof]','Pending')";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
	echo "<script>alert('Student Account Created successfully.. Admin will verify your account..');</script>";
	echo "<script>window.location='index.php';</script>";
	}
	else
	{
	echo "<script>alert('Failed to Register :- Admission No. / Enrollment No. already exists...');</script>";
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
<body class="hold-transition register-page">
<div class="register-box">
  <div class="card">
    <div class="card-header text-center">
      <a href="index.php" class="h1"><img src="<?php echo $logo; ?>" style="width: 100%;"></a>
    </div>
    <div class="card-body register-card-body">
      <p class="login-box-msg"><b>Register a new Membership</b></p>

      <form  name="frmform" id="frmform" method="post" action="">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Full name" name="student_name" id="student_name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
			<select class="form-control" id="course_id" name="course_id" >
				<option value="">Select Course</option>
				<?php
					$sqlcourse = "SELECT * FROM course WHERE course_status='Active'";
					$qsqlcourse = mysqli_query($con,$sqlcourse);
					while($rscourse = mysqli_fetch_array($qsqlcourse))
					{
						echo "<option value='$rscourse[course_id]'>$rscourse[course]</option>";
					}
				?>
			</select>
			<div class="input-group-append">
				<div class="input-group-text">
				  <span class="fas fa-graduation-cap"></span>
				</div>
			</div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Enrollment No." name="enrollment_no" id="enrollment_no">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-id-card-alt"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Admission No." name="admission_no" id="admission_no">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-laptop-code"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="student_password" id="student_password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Retype password" name="student_c_password" id="student_c_password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="student_email" id="student_email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Mobile No." name="student_contact" id="student_contact">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone-square"></span>
            </div>
          </div>
        </div>

      <div class="social-auth-links text-center">
        <button type="submit" name="submit"  id="submit" class="btn btn-block btn-primary"><i class="fas fa-address-card"></i> Click here to Register </button>  	
      </div>

      </form>
	  <hr>
      <centeR><a href="index.php" class="text-center"><b>Already Registered? Click here to Login</b></a></center>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jquery-validation -->
<script src="plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="plugins/jquery-validation/additional-methods.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
<script>
$(function () {
  $.validator.setDefaults({
	  /*
    submitHandler: function () {
      alert( "Form successful submitted!" );
    }
	*/
  });
	//student_name course_id enrollment_no admission_no student_password student_c_password student_email student_contact d
  $('#frmform').validate({
    rules: {
      student_name: {
        required: true
      },
      course_id: {
        required: true
      },
      enrollment_no: {
        required: true
      },
      admission_no: {
        required: true
      },
      student_password: {
        required: true,
        minlength: 6
      },
      student_c_password: {
        required: true,
		equalTo : "#student_password",
        minlength: 6
      },
      student_email: {
        required: true
      },
      student_contact: {
        required: true
      }
    },
    messages: {
      student_name: {
        required: "Student Name should not be empty.."
      },
      course_id: {
        required: "Kindly select the course.."
      },
      enrollment_no: {
        required: "Enrollment Number should not be empty.."
      },
      admission_no: {
        required: "Admission Number should not be empty.."
      },
      student_password: {
        required: "Password should not be empty..",
        minlength: "Password should contain more than 6 digits"
      },
      student_c_password: {
        required: "Confirm Password should not be empty..",
        equalTo: "Password and Confirm password should match..",
        minlength: "Your password must be at least 6 characters long"
      },
      student_email: {
        required: "Email ID should not be empty"
      },
      student_contact: {
        required: "Contact Number should not be empty.."
      }
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.input-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>