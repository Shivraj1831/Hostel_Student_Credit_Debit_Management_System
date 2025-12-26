<?php
include("header.php");
if(isset($_POST['submit']))
{
	$sql ="UPDATE staff set staff_name='$_POST[staff_name]', staff_type='$_POST[staff_type]', staff_login_id='$_POST[staff_login_id]' where staff_id='" . $_SESSION['staff_id'] . "'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
	echo "<script>alert('Profile Updated successfully...');</script>";
	echo "<script>window.location='staffprofile.php';</script>";
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
                <h3 class="card-title">Staff Profile <small>Update Your Profile</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form name="frmform" id="frmform" method="post" action="">
                <div class="card-body">
				
                  <div class="form-group">
                    <label for="inputstaff_name">Staff Name</label>
                    <input type="text" name="staff_name" class="form-control" id="staff_name" placeholder="Enter Staff Name" value="<?php echo $rsstaffprofile['staff_name']; ?>">
                  </div>
				  
                  <div class="form-group">
                    <label for="inputstaff_type">Staff Type</label>
                    <select name="staff_type" class="form-control" id="staff_type">
						<option value="">Select Staff Type</option>
						<?php
							if($rsstaffprofile[0] == 1)
							{
							$arr = array("Admin");
							}
							else
							{
							$arr = array("Admin","Staff");
							}
							foreach($arr as $val)
							{
								if($val == $rsstaffprofile['staff_type'])
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
                    <input type="text" name="staff_login_id" class="form-control" id="staff_login_id" placeholder="Enter Login ID" value="<?php echo $rsstaffprofile['staff_login_id']; ?>">
                  </div>
				  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="submit"  id="submit" class="btn btn-success">Update Profile</button>
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
      }
    },
    messages: {
      staff_name: {
        required: "Enter Staff Name.."
      },
      staff_type: {
        required: "Staff Type Should not be empty.."
      },
      staff_login_id: {
        required: "Login ID should not be empty..."
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