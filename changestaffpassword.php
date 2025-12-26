<?php
include("header.php");
if(isset($_POST['submit']))
{
	$opwd = md5($_POST['staff_opassword']);
	$npwd = md5($_POST['staff_password']);
	$sql ="UPDATE staff SET staff_password='$npwd' where staff_password='$opwd' AND staff_id='" . $_SESSION['staff_id'] . "'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
	echo "<script>alert('Staff Password Updated successfully...');</script>";
	}
	else
	{
		echo "<script>alert('Failed to change password...');</script>";
	}
}
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
	<?php
	/*
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Validation</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Validation</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
	*/
	?>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Staff <small>Add/Edit staff Records</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form name="frmform" id="frmform" method="post" action="">
                <div class="card-body">
				
                  <div class="form-group">
                    <label for="inputstaff_password">Old Password</label>
                    <input type="password" name="staff_opassword" class="form-control" id="staff_opassword" placeholder="Enter Password" >
                  </div>
				  
                  <div class="form-group">
                    <label for="inputstaff_password">Password</label>
                    <input type="password" name="staff_password" class="form-control" id="staff_password" placeholder="Enter Password" >
                  </div>
				  
                  <div class="form-group">
                    <label for="inputstaff_password">Confirm Password</label>
                    <input type="password" name="staff_cpassword" class="form-control" id="staff_cpassword" placeholder="Confirm Password" >
                  </div>
				  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="submit"  id="submit" class="btn btn-success">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php
include("footer.php");
?>
 <script>
$(function () {
  $.validator.setDefaults({
	  /*
    submitHandler: function () {
      alert( "Form successful submitted!" );
    }
	*/
  });
	//staff_name staff_type staff_login_id staff_password staff_password
  $('#frmform').validate({
    rules: {
      staff_opassword: {
        required: true,
      },
      staff_password: {
        required: true,
        minlength: 6
      },
      staff_cpassword: {
        required: true,
		equalTo : "#staff_password",
        minlength: 6
      }
    },
    messages: {
      staff_opassword: {
        required: "Old Password should not be empty.."
      },
      staff_password: {
        required: "Password should not be empty..",
        minlength: "Your password must be at least 6 characters long"
      },
      staff_cpassword: {
        required: "Confirm Password should not be empty..",
        equalTo: "Password and Confirm password should match..",
        minlength: "Your password must be at least 6 characters long"
      }
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
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