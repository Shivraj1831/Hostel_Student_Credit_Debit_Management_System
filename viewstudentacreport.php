<?php
include("header.php");
if(isset($_GET['delid']))
{
	$sqldelete = "UPDATE student set student_status='Deleted' WHERE student_id ='" . $_GET['delid'] ."'";
	$qsqldelete = mysqli_query($con,$sqldelete);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Student Record deleted successfully..');</script>";
		echo "<script>window.location='viewstudent.php';</script>";
	} 
}
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
		<?php
		/*
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DataTables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
		*/
		?>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
	
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">View Student Account Report</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body" id="divprint">
				<table id="example1" class="table table-bordered table-striped">
				  <thead>
					  <tr>
						<th>Image</th>
						<th>Course</th>
						<th>Student Name</th>
						<th>Enrollment No.</th>
						<th>Admission No.</th>
						<th style='text-align: right;'>Credited</th>
						<th style="text-align: right;">Debited</th>
						<th style="text-align: right;">Balance</th>
						<th>Action</th>
					  </tr>
				  </thead>
				  <tbody>
				  <?php
				  $sqlstudent = "SELECT student.*,course.course,(SELECT ifnull(SUM(transaction_amt),0) FROM `transaction` WHERE transaction_type='Credit' AND transaction_status='Active' AND student_id=student.student_id) as creditamt,(SELECT ifnull(SUM(transaction_amt),0) FROM `transaction` WHERE transaction_type='Debit' AND transaction_status='Active' AND student_id=student.student_id) as debitamt FROM student LEFT JOIN course ON student.course_id=course.course_id WHERE student.student_status!='Deleted'";
				  if(isset($_GET['stst']))
				  {
					  $sqlstudent = $sqlstudent . " AND student.student_status='Pending'";
				  }
				  $qsqlstudent = mysqli_query($con,$sqlstudent);
				  while($rsstudent = mysqli_fetch_array($qsqlstudent))
				  {
					$bal = floatval($rsstudent['creditamt']) - floatval($rsstudent['debitamt']);
					echo "<tr>
						<td><img src='";
						if($rsstudent['student_photo'] == "")
						{
						echo "images/default.jpg";
						}
						else if(file_exists("imgstudent/" .$rsstudent['student_photo']))
						{
						echo "imgstudent/" .$rsstudent['student_photo'];
						}
						else
						{
						echo "images/default.jpg";
						}
					echo "' style='width:75px;height:75px;' ></td>
						<td>$rsstudent[course]</td>
						<td>$rsstudent[student_name]</td>
						<td>$rsstudent[enrollment_no]</td>
						<td>$rsstudent[admission_no]</td>
						<td style='text-align: right;'>$currency $rsstudent[creditamt]</td>
						<td style='text-align: right;'>$currency $rsstudent[debitamt]</td>
						<td style='text-align: right;'>$currency ";
					echo $bal;
					echo "</td>
						<td><center><a href='viewstudentsingleacrpt.php?student_id=$rsstudent[0]' class='btn btn-info' ><i class='fas fa-table'></i><br>View Report</a></center><br>";
					echo "</td></tr>";
				  }
				  ?>
				  </tbody>
				  <?php
				  /*
				  <tfoot>
					  <tr>
						<th>Rendering engine</th>
						<th>Browser</th>
						<th>Platform(s)</th>
						<th>Engine version</th>
						<th>CSS grade</th>
					  </tr>
				  </tfoot>
				 */
				 ?>
				</table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<?php
include("footer.php");
?>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<script>
function confirmdelete()
{
	if(confirm("Are you sure want to delete this record?") == true)
	{
		return true;
	}
	else
	{
		return false;
	}
}
</script>