<?php
include("header.php");
if(isset($_POST['submit']))
{
	$student_photo = rand() .$_FILES['student_photo']['name'];
	move_uploaded_file($_FILES['student_photo']['tmp_name'],"imgstudent/".$student_photo);
	$student_idproof = rand() . $_FILES['student_idproof']['name'];
	move_uploaded_file($_FILES['student_idproof']['tmp_name'],"imgidproof/".$student_idproof);
	if(isset($_GET['editid']))
	{		
		$sqledit = "SELECT * FROM student WHERE student_id ='" . $_GET['editid'] ."'";
		$qsqledit = mysqli_query($con,$sqledit);
		$rsedit = mysqli_fetch_array($qsqledit);
		$pwd="";
		if($_POST['student_password'] == $rsedit['student_password'])
		{
			$pwd = $rsedit['student_password'];
		}
		else
		{
			$pwd = md5($_POST['student_password']);
		}
		$sql ="UPDATE student set course_id='$_POST[course_id]',enrollment_no='$_POST[enrollment_no]',admission_no='$_POST[admission_no]',student_name='$_POST[student_name]',student_dob='$_POST[student_dob]',student_gender='$_POST[student_gender]',student_address='$_POST[student_address]',student_state='$_POST[student_state]',student_contact='$_POST[student_contact]',student_email='$_POST[student_email]',student_password='$pwd',student_bankdetail='$_POST[student_bankdetail]',student_note='$_POST[student_note]',student_pan='$_POST[student_pan]'";
		if($_FILES['student_photo']['name'] !="")
		{
		$sql =$sql . ",student_photo='$student_photo'";
		}
		if($_FILES['student_idproof']['name'] !="")
		{
		$sql =$sql . ",student_idproof='$student_idproof'";
		}
		$sql =$sql . ",student_status='$_POST[student_status]' where student_id='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) == 1)
		{
		echo "<script>alert('Student Account Updated successfully...');</script>";
		}
	}
	else
	{
		$password = md5($_POST['student_password']);
		$sql ="INSERT INTO student( course_id, enrollment_no, admission_no, student_name, student_dob, student_gender, student_address, student_state, student_contact, student_email, student_password, student_bankdetail, student_note, student_pan, student_photo, student_idproof, student_addressproof, student_status) VALUES ('$_POST[course_id]','$_POST[enrollment_no]','$_POST[admission_no]','$_POST[student_name]','$_POST[student_dob]','$_POST[student_gender]','$_POST[student_address]','$_POST[student_state]','$_POST[student_contact]','$_POST[student_email]','$password','$_POST[student_bankdetail]','$_POST[student_note]','$_POST[student_pan]','$student_photo','$student_idproof','$_POST[student_addressproof]','$_POST[student_status]')";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
		echo "<script>alert('Student Account Created successfully...');</script>";
		echo "<script>window.location='viewstudent.php';</script>";
		}
		else
		{		
		echo "<script>alert('Failed to Register :- Admission No. / Enrollment No. already exists...');</script>";
		echo "<script>window.location='viewstudent.php';</script>";
		}
	}
} 
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM student where student_id='$_GET[editid]'";
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
                <h3 class="card-title">Student <small>Add/Edit Student Records</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form name="frmform" id="frmform" method="post" action="" enctype="multipart/form-data">
                <div class="card-body row">
				
                  <div class="form-group col-md-6">
                    <label for="inputcourse_id">Course Name</label>
					<select class="form-control" id="course_id" name="course_id" >
						<option value="">Select Course</option>
						<?php
							$sqlcourse = "SELECT * FROM course WHERE course_status='Active'";
							$qsqlcourse = mysqli_query($con,$sqlcourse);
							while($rscourse = mysqli_fetch_array($qsqlcourse))
							{
								if($rscourse['course_id'] == $rsedit['course_id'])
								{
								echo "<option value='$rscourse[course_id]' selected>$rscourse[course]</option>";
								}
								else
								{
								echo "<option value='$rscourse[course_id]'>$rscourse[course]</option>";
								}
							}
						?>
					</select>
                  </div>
				  				
                  <div class="form-group col-md-6">
                    <label for="inputstudent_name">Student Name</label>
                    <input type="text" name="student_name" class="form-control" id="student_name" placeholder="Enter Student Name" value="<?php echo $rsedit['student_name']; ?>">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputenrollment_no">Enrollment No.</label>
                    <input type="text" name="enrollment_no" class="form-control" id="enrollment_no" placeholder="Enter Enrollment No." value="<?php echo $rsedit['enrollment_no']; ?>">
                  </div>
				  	
                  <div class="form-group col-md-6">
                    <label for="inputadmission_no">Admission No.</label>
                    <input type="text" name="admission_no" class="form-control" id="admission_no" placeholder="Enter Admission No." value="<?php echo $rsedit['admission_no']; ?>">
                  </div>
				  	
				  	
                  <div class="form-group col-md-6">
                    <label for="inputsstudent_password">Password</label>
                    <input type="password" name="student_password" class="form-control" id="student_password" placeholder="Enter Password"  value="<?php echo $rsedit['student_password']; ?>">
                  </div>
				   
                  <div class="form-group col-md-6">
                    <label for="inputstudent_cpassword">Confirm Password</label>
                    <input type="password" name="student_cpassword" class="form-control" id="student_cpassword" placeholder="Confirm Password" value="<?php echo $rsedit['student_password']; ?>">
                  </div>
				  
                  <div class="form-group col-md-6">
                    <label for="inputstudent_dob">Date of Birth</label>
                    <input type="date" name="student_dob" class="form-control" id="student_dob" placeholder="Enter Date of Birth" value="<?php echo $rsedit['student_dob']; ?>">
                  </div>
				  
                  <div class="form-group col-md-6">
                    <label for="inputstudent_gender">Gender</label>
                    <select name="student_gender" class="form-control" id="student_gender">
						<option value="">Select Gender</option>
						<?php
							$arr = array("Male","Female");
							foreach($arr as $val)
							{
								if($val == $rsedit['student_gender'])
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
				  
                  <div class="form-group col-md-12">
                    <label for="inputstudent_address">Address</label>
                    <textarea name="student_address" class="form-control" id="student_address" placeholder="Enter Address" ><?php echo $rsedit['student_address']; ?></textarea>
                  </div>
				  	
                  <div class="form-group col-md-6">
                    <label for="inputstudent_contact">Contact No.</label>
                    <input type="text" name="student_contact" class="form-control" id="student_contact" placeholder="Enter Contact No." value="<?php echo $rsedit['student_contact']; ?>">
                  </div>
				  
                  <div class="form-group col-md-6">
                    <label for="inputstudent_email">Email ID</label>
                    <input type="text" name="student_email" class="form-control" id="student_email" placeholder="Enter Email ID" value="<?php echo $rsedit['student_email']; ?>">
                  </div>
				  
                  <div class="form-group col-md-6">
                    <label for="inputstudent_photo">Profile Image</label>
                    <input type="file" name="student_photo" class="form-control" id="student_photo" placeholder="Upload Profile Image" >
					<?php
					if(isset($_GET['editid']))
					{
						echo "<img src='";
						if($rsedit['student_photo'] == "")
						{
						echo "images/default.jpg";
						}
						else if(file_exists("imgstudent/" .$rsedit['student_photo']))
						{
						echo "imgstudent/" .$rsedit['student_photo'];
						}
						else
						{
						echo "images/default.jpg";
						}
						echo "' style='width:75px;height:75px;' >";
					}
					?>					
                  </div>
				  
                  <div class="form-group col-md-6">
                    <label for="inputstudent_idproof">ID Proof</label>
                    <input type="file" name="student_idproof" class="form-control" id="student_idproof" placeholder="Enter ID Proof">
					<?php
					if(isset($_GET['editid']))
					{
						echo "<img src='";
						if($rsedit['student_idproof'] == "")
						{
						echo "images/noimage.jpg";
						}
						else if(file_exists("imgidproof/" .$rsedit['student_idproof']))
						{
						echo "imgidproof/" .$rsedit['student_idproof'];
						}
						else
						{
						echo "images/noimage.jpg";
						}
						echo "' style='width:120px;height:75px;' >";
					}
					?>					
                  </div>
				  
				  
                  <div class="form-group col-md-6">
                    <label for="inputstudent_bankdetail">Bank Account Detail</label>
                    <textarea name="student_bankdetail" class="form-control" id="student_bankdetail" placeholder="Enter Bank Account Detail" ><?php echo $rsedit['student_bankdetail']; ?></textarea>
                  </div>
				  	
                  <div class="form-group col-md-6">
                    <label for="inputstudent_note">Any Notes</label>
                    <textarea name="student_note" class="form-control" id="student_note" placeholder="Enter Any Notes" ><?php echo $rsedit['student_note']; ?></textarea>
                  </div>
				  	
                  <div class="form-group col-md-6">
                    <label for="inputstudent_status">Account Status</label>
                    <select name="student_status" class="form-control" id="student_status">
						<option value="">Select Account Status</option>
						<?php
							$arr = array("Active","Inactive");
							foreach($arr as $val)
							{
								if($val == $rsedit['student_status'])
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
      course_id: {
        required: true
      },
      student_name: {
        required: true,
      },
      enrollment_no: {
        required: true,
      },
      admission_no: {
        required: true,
      },
      student_password: {
        required: true,
        minlength: 6
      },
      student_cpassword: {
        required: true,
		equalTo : "#student_password",
        minlength: 6
      },
      student_status: {
        required: true,
      }
    },
    messages: {
      course_id: {
        required: "Kindly select the course"
      },
      student_name: {
        required: "Student name should not be empty.."
      },
      enrollment_no: {
        required: "Enrollment Number should not be empty"
      },
      admission_no: {
        required: "Admission Number should not be empty"
      },
      student_password: {
        required: "Student password should not be empty",
        minlength: "Password should contain more than 6 characters.."
      },
      student_cpassword: {
        required: "Confirm Password should not be empty",
		equalTo : "Password and confirm password not matching",
        minlength: "Confirm Password should contain more than 6 digits"
      },
      student_status: {
        required: "Kindly select the status"
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