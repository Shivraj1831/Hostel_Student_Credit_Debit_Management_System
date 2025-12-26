<?php
include("header.php");
if(isset($_GET['delid']))
{
	$sqldelete = "UPDATE course set course_status='Deleted' WHERE course_id ='" . $_GET['delid'] ."'";
	$qsqldelete = mysqli_query($con,$sqldelete);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Course Record deleted successfully..');</script>";
		echo "<script>window.location='viewcourse.php';</script>";
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
                <h3 class="card-title">View Staffs</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
				<table id="example1" class="table table-bordered table-striped">
				  <thead>
					  <tr>
						<th>Course</th>
						<th>Course description</th>
						<th>Status</th>
						<th>Action</th>
					  </tr>
				  </thead>
				  <tbody>
				  <?php
				  $sqlcourse = "SELECT * FROM course WHERE course_status!='Deleted'";
				  $qsqlcourse = mysqli_query($con,$sqlcourse);
				  while($rscourse = mysqli_fetch_array($qsqlcourse))
				  {
					echo "<tr>
						<td>$rscourse[course]</td>
						<td>$rscourse[description]</td>
						<td>$rscourse[course_status]</td>
						<td><a href='course.php?editid=$rscourse[0]' class='btn btn-info'>Edit</a> ";
						if($rsstaff['staff_id'] != 1)
						{
					echo "<a href='viewcourse.php?delid=$rscourse[0]' class='btn btn-danger' onclick='return confirmdelete()'>Delete</a>";
						}
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