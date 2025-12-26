<?php
include("header.php");
if(isset($_POST['submit']))
{
	if(isset($_GET['editid']))
	{
		$sql ="UPDATE course set course='$_POST[course]', description='$_POST[description]', course_status='$_POST[course_status]' where course_id ='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) == 1)
		{
		echo "<script>alert('Course Record Updated successfully...');</script>";
		}
	}
	else
	{
		$sql ="INSERT INTO course(course, description, course_status) values('$_POST[course]','$_POST[description]','$_POST[course_status]')";
		$qsql = mysqli_query($con,$sql);
		echo "<script>alert('Course Record inserted successfully...');</script>";
		echo "<script>window.location='viewcourse.php';</script>";
	}
}
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM course WHERE course_id='" . $_GET['editid'] ."'";
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
                <h3 class="card-title">Course <small>Add/Edit Course Records</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form name="frmform" id="frmform" method="post" action="">
                <div class="card-body">
				
                  <div class="form-group">
                    <label for="inputcourse">Course title</label>
                    <input type="text" name="course" class="form-control" id="course" placeholder="Enter course title" value="<?php echo $rsedit['course']; ?>">
                  </div>
				  
				  
                  <div class="form-group">
                    <label for="inputdescription">Course Description</label>
                    <textarea name="description" class="form-control" id="description" placeholder="Enter description" ><?php echo $rsedit['description']; ?></textarea>
                  </div>
				  
                  <div class="form-group">
                    <label for="inputcourse_status">Course Status</label>
                    <select name="course_status" class="form-control" id="course_status">
						<option value="">Select Course Status</option>
						<?php
							$arr = array("Active","Inactive");
							foreach($arr as $val)
							{
								if($val == $rsedit['course_status'])
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
	//  
  $('#frmform').validate({
    rules: {
      course: {
        required: true
      },
      course_status: {
        required: true,
      }
    },
    messages: {
      course: {
        required: "Course Should not be empty..."
      },
      course_status: {
        required: "Kindly select the course status.."
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