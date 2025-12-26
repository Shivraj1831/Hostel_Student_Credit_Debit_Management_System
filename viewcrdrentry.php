<?php
include("header.php");
if(isset($_GET['delid']))
{
	$sqldelete = "UPDATE transaction set transaction_status='Cancelled' WHERE transaction_id  ='" . $_GET['delid'] ."'";
	$qsqldelete = mysqli_query($con,$sqldelete);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Invoice Cancelled successfully..');</script>";
		echo "<script>window.location='viewcrdrentry.php';</script>";
	} 
}
if(isset($_GET['student_id']))
{
$sqlstudentprofile = "SELECT student.*,course.course,(SELECT ifnull(SUM(transaction_amt),0) FROM `transaction` WHERE transaction_type='Credit' AND transaction_status='Active' AND student_id=student.student_id) as creditamt,(SELECT ifnull(SUM(transaction_amt),0) FROM `transaction` WHERE transaction_type='Debit' AND transaction_status='Active' AND student_id=student.student_id) as debitamt FROM student LEFT JOIN course ON student.course_id=course.course_id WHERE student.student_id='" . $_GET['student_id'] . "'";
$qsqlstudentprofile = mysqli_query($con,$sqlstudentprofile);
$rsstudentprofile = mysqli_fetch_array($qsqlstudentprofile);
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
                <h3 class="card-title">View Credit Debit Entries</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body" id="divprint">
				<table id="example1" class="table table-bordered table-striped">
				  <thead>
					  <tr>
						<th>SL<br>No.</th>
						<th>Student</th>
						<th>Registry</th>
						<th>Receipt<br>No.</th>
						<th>Transaction<br>Date</th>
						<th>Transaction Title</th>
						<th style='text-align: right;'>Transaction<bR>Amount</th>
						<th>Status</th>
						<th>Action</th>
					  </tr>
				  </thead>
				  <tbody>
				  <?php
				  $sqltransaction = "SELECT student.*,transaction.*,staff.staff_name, course.course FROM transaction LEFT JOIN student ON student.student_id=transaction.student_id LEFT JOIN staff ON staff.staff_id=transaction.staff_id LEFT JOIN course ON course.course_id=student.course_id  ORDER BY transaction.transaction_id,transaction.receipt_no";
				  $qsqltransaction = mysqli_query($con,$sqltransaction);
				  echo mysqli_error($con);
				  $crdr=0;
				  $slno =1;
				  while($rstransaction = mysqli_fetch_array($qsqltransaction))
				  {
					echo "<tr>
						<td>$slno</td>
						<td>Name - " . $rstransaction['student_name'] . "<br>";
					echo " Course - " . $rstransaction['course'] . "</td>";
					echo "<td>Enrollment No. - " . $rstransaction['enrollment_no'] . "<br>";
					echo " Admission No. - " . $rstransaction['admission_no'];
					echo "</td>
						<td>" . $rstransaction['receipt_no'] . "</td>
						<td>" . date("d-m-Y",strtotime($rstransaction['transaction_date'])) . "</td>
						<td><b>" . $rstransaction['transaction_type'] . "</b><br>". $rstransaction['transaction_note'] . "</td>";
					echo "<td style='text-align: right;'>$currency " . $rstransaction['transaction_amt'] . "</td>";
					$crdr = $crdr + $rstransaction['transaction_amt'];
					echo "<td";
					if($rstransaction['transaction_status'] == "Cancelled")
					{
						echo " style='color: red;' ";
					}
					echo ">" . $rstransaction['transaction_status'] . "</td>";
					echo "<td>";
					if($rstransaction['transaction_type']=="Credit")
					{
					echo "<a href='' class='btn btn-info' target='_blank'>Receipt</a> &nbsp;";
					}
					if($rstransaction['transaction_type']=="Debit")
					{
					echo "<a href='' class='btn btn-info' target='_blank'>Receipt</a> &nbsp;";
					}
					if($rstransaction['transaction_status'] == "Active")
					{
						if($_SESSION['staff_type'] == "Admin")
						{
					echo "<a href='viewcrdrentry.php?delid=$rstransaction[transaction_id]' class='btn btn-danger' onclick='return confirmdelete()'>Cancel</a>";
						}
					}
					echo "</td>";
					echo "</tr>";
					$slno = $slno + 1;
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
  });
</script>
<script>
function confirmdelete()
{
	if(confirm("Cancelled Transaction Entry cannot be recovered.. Are you sure?") == true)
	{
		return true;
	}
	else
	{
		return false;
	}
}
</script>
<script>
function PrintElem(elem)
{
    var mywindow = window.open('', 'PRINT', 'height=400,width=600');

    mywindow.document.write('<html><head><title>' + document.title  + '</title>');
    mywindow.document.write('<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"><link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css"><link rel="stylesheet" href="dist/css/adminlte.min.css">');
    mywindow.document.write('</head><body >');
    mywindow.document.write('<h1>' + document.title  + '</h1>');
    mywindow.document.write(document.getElementById(elem).innerHTML);
    mywindow.document.write('</body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/

    mywindow.print();
    mywindow.close();

    return true;
}
</script>