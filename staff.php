<?php
include("header.php");
if(isset($_POST['submit']))
{
	if(isset($_GET['editid']))
	{		
		$sqledit = "SELECT * FROM staff WHERE staff_id='" . $_GET['editid'] ."'";
		$qsqledit = mysqli_query($con,$sqledit);
		$rsedit = mysqli_fetch_array($qsqledit);
		$pwd="";
		if($_POST['staff_password'] == $rsedit['staff_password'])
		{
			$pwd = $rsedit['staff_password'];
		}
		else
		{
			$pwd = md5($_POST['staff_password']);
		}
		$sql ="UPDATE staff set staff_name='$_POST[staff_name]', staff_type='$_POST[staff_type]', staff_login_id='$_POST[staff_login_id]', staff_password='$pwd', staff_status='$_POST[staff_status]' where staff_id='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) == 1)
		{
		echo "<script>alert('Staff Account Updated successfully...');</script>";
		}
	}
	else
	{
		$password = md5($_POST['staff_password']);
		$sql ="INSERT INTO staff(staff_name, staff_type, staff_login_id, staff_password, staff_status) values('$_POST[staff_name]','$_POST[staff_type]','$_POST[staff_login_id]','$password','$_POST[staff_status]')";
		$qsql = mysqli_query($con,$sql);
		echo "<script>alert('Staff Account Created successfully...');</script>";
		echo "<script>window.location='viewstaff.php';</script>";
	}
}
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM staff WHERE staff_id='" . $_GET['editid'] ."'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
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
                    <label for="inputstaff_name">Staff Name</label>
                    <input type="text" name="staff_name" class="form-control" id="staff_name" placeholder="Enter Staff Name" value="<?php echo $rsedit['staff_name']; ?>">
                  </div>
				  
                  <div class="form-group">
                    <label for="inputstaff_type">Staff Type</label>
                    <select name="staff_type" class="form-control" id="staff_type">
						<option value="">Select Staff Type</option>
						<?php
							$arr = array("Admin","Staff");
							foreach($arr as $val)
							{
								if($val == $rsedit['staff_type'])
								{
								echo "<option value='$val' selected>$val</option>";
								}
								else
								{
								echo "<option value='$val'>$val</option>";
								}
							}
						?>
					</select>
                  </div>
				  
                  <div class="form-group">
                    <label for="inputstaff_login_id">Login ID</label>
                    <input type="text" name="staff_login_id" class="form-control" id="staff_login_id" placeholder="Enter Login ID" value="<?php echo $rsedit['staff_login_id']; ?>">
                  </div>
				  
                  <div class="form-group">
                    <label for="inputstaff_password">Password</label>
                    <input type="password" name="staff_password" class="form-control" id="staff_password" placeholder="Enter Password"  value="<?php echo $rsedit['staff_password']; ?>">
                  </div>
				  
                  <div class="form-group">
                    <label for="inputstaff_password">Confirm Password</label>
                    <input type="password" name="staff_cpassword" class="form-control" id="staff_cpassword" placeholder="Confirm Password" value="<?php echo $rsedit['staff_password']; ?>">
                  </div>
				  
                  <div class="form-group">
                    <label for="inputstaff_status">Account Status</label>
                    <select name="staff_status" class="form-control" id="staff_status">
						<option value="">Select Account Status</option>
						<?php
							$arr = array("Active","Inactive");
							foreach($arr as $val)
							{
								if($val == $rsedit['staff_status'])
								{
								echo "<option value='$val' selected>$val</option>";
								}
								else
								{
								echo "<option value='$val'>$val</option>";
								}
							}
						?>
					</select>
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
      staff_name: {
        required: true
      },
      staff_type: {
        required: true,
      },
      staff_login_id: {
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
      },
      staff_status: {
        required: true,
      }
    },
    messages: {
      staff_name: {
        required: "Staff Name Should not be empty..."
      },
      staff_type: {
        required: "Kindly select Staff Type.."
      },
      staff_login_id: {
        required: "Login ID should not be empty.."
      },
      staff_password: {
        required: "Password should not be empty..",
        minlength: "Your password must be at least 6 characters long"
      },
      staff_cpassword: {
        required: "Confirm Password should not be empty..",
        equalTo: "Password and Confirm password should match..",
        minlength: "Your password must be at least 6 characters long"
      },
      staff_status: {
        required: "Kindly select the staff account status.."
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