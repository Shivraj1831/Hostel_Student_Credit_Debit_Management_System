<?php
include("webconfig.php");
if(!isset($_SESSION['staff_id']) && !isset($_SESSION['student_id']))
{
	echo "<script>window.location='index.php';</script>";
}
if(isset($_SESSION['staff_id']))
{
	$sqlstaffprofile = "SELECT * FROM staff WHERE staff_id='" . $_SESSION['staff_id'] . "' ";
	$qsqlstaffprofile = mysqli_query($con,$sqlstaffprofile);
	$rsstaffprofile = mysqli_fetch_array($qsqlstaffprofile);
}
if(isset($_SESSION['student_id']))
{
	$sqlstudentprofile = "SELECT * FROM student WHERE student_id='" . $_SESSION['student_id'] . "' ";
	$qsqlstudentprofile = mysqli_query($con,$sqlstudentprofile);
	$rsstudentprofile = mysqli_fetch_array($qsqlstudentprofile);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $projecttitle; ?></title>
  <?php
  //Form Pages
  if(basename($_SERVER['PHP_SELF']) == "staff.php" || basename($_SERVER['PHP_SELF']) == "staffprofile.php" || basename($_SERVER['PHP_SELF']) == "changestaffpassword.php" || basename($_SERVER['PHP_SELF']) == "course.php" || basename($_SERVER['PHP_SELF']) == "student.php" || basename($_SERVER['PHP_SELF']) == "crentry.php" || basename($_SERVER['PHP_SELF']) == "drentry.php" || basename($_SERVER['PHP_SELF']) == "studentprofile.php" || basename($_SERVER['PHP_SELF']) == "changestudentpassword.php" || basename($_SERVER['PHP_SELF']) == "invoice.php" || basename($_SERVER['PHP_SELF']) == "drentry.php" || basename($_SERVER['PHP_SELF']) == "invoice.php")
  {
  ?>
	<!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
	  <?php
  }
  //View pages
  else if(basename($_SERVER['PHP_SELF']) == "viewstaff.php" || basename($_SERVER['PHP_SELF']) == "viewcourse.php" || basename($_SERVER['PHP_SELF']) == "viewstudent.php" || basename($_SERVER['PHP_SELF']) == "viewstudentacreport.php" || basename($_SERVER['PHP_SELF']) == "viewstudentsingleacrpt.php" || basename($_SERVER['PHP_SELF']) == "viewtransactionreport.php" || basename($_SERVER['PHP_SELF']) == "viewcrdrentry.php" || basename($_SERVER['PHP_SELF']) == "viewcredtransreport.php" || basename($_SERVER['PHP_SELF']) == "viewdebttransreport.php" || basename($_SERVER['PHP_SELF']) == "viewstudentsingleacrpt_std.php" || basename($_SERVER['PHP_SELF']) == "viewcredtransreport_student.php" || basename($_SERVER['PHP_SELF']) == "viewdebttransreport_student.php" || basename($_SERVER['PHP_SELF']) == "viewtransactionreport_student.php")
  {
	?>
	  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
	<?php
  }
  else
  {
  ?>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <?php
  }
  ?>  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
	
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
	  <?php
	  /*
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
	  */
	  ?>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link btn btn-success" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i> 
        </a>
	<?php
	if(isset($_SESSION['staff_id']))
	{
	?>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">Hi, <?php echo $rsstaffprofile['staff_name']; ?></span>
          <div class="dropdown-divider"></div>
          <a href="staffprofile.php" class="dropdown-item">
            <i class="fas fa-user mr-2"></i> Update Profile
          </a>
          <div class="dropdown-divider"></div>
          <a href="changestaffpassword.php" class="dropdown-item">
            <i class="fas fa-star mr-2"></i> Change password
          </a>
          <div class="dropdown-divider"></div>
          <a href="logout.php" class="dropdown-item dropdown-footer">Logout</a>
        </div>
	<?php
	}
	else if(isset($_SESSION['student_id']))
	{
	?>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">Hi, <?php echo $rsstudentprofile['student_name']; ?></span>
          <div class="dropdown-divider"></div>
          <a href="studentprofile.php" class="dropdown-item">
            <i class="fas fa-user mr-2"></i> Update Profile
          </a>
          <div class="dropdown-divider"></div>
          <a href="changestudentpassword.php" class="dropdown-item">
            <i class="fas fa-star mr-2"></i> Change password
          </a>
          <div class="dropdown-divider"></div>
          <a href="logout.php" class="dropdown-item dropdown-footer">Logout</a>
        </div>
	<?php
	}
	?>
      </li>
<?php
/*	  
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
*/
?>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-success elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link">
      <img src="<?php echo $minilogo; ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
<?php
if(isset($_SESSION['student_id']))
{
?>	
<span class="brand-text font-weight-light">STUDENT PANEL</span>
<?php
}
if(isset($_SESSION['staff_id']))
{
?>
<span class="brand-text font-weight-light">ADMIN PANEL</span>
<?php
}
?>	
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
	<?php
	if(isset($_SESSION['staff_id']))
	{
	?>
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="images/admin-icon.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $rsstaffprofile['staff_name']; ?></a>
        </div>
      </div>
	<?php
	}
	else if(isset($_SESSION['student_id']))
	{
	?>
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
			<img src='<?php
						if($rsstudentprofile['student_photo'] == "")
						{
						echo "images/default.jpg";
						}
						else if(file_exists("imgstudent/" .$rsstudentprofile['student_photo']))
						{
						echo "imgstudent/" .$rsstudentprofile['student_photo'];
						}
						else
						{
						echo "images/default.jpg";
						}
					?>'  class="img-circle elevation-2" >
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $rsstudentprofile['student_name']; ?></a>
        </div>
      </div>
	<?php
	}
	?>
	<?php
	/*
      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>
	<?php
	*/
	?>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
		<?php
		if(isset($_SESSION['student_id']))
		{
		?>
          <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
          <li class="nav-item  
		<?php
		  if(basename($_SERVER['PHP_SELF']) == "studentpanel.php")
		  {
		  echo " menu-open ";
		  }
		?>">
            <a href="studentpanel.php" class="nav-link   
		<?php
		  if(basename($_SERVER['PHP_SELF']) == "studentpanel.php")
		  {
		  echo " active ";
		  }
		?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Student Panel
              </p>
            </a>
          </li>
		    
		   
          <li class="nav-item 
		<?php
		  if(basename($_SERVER['PHP_SELF']) == "viewstudentsingleacrpt_std.php" || basename($_SERVER['PHP_SELF']) == "viewcredtransreport_student.php" || basename($_SERVER['PHP_SELF']) == "viewdebttransreport_student.php" || basename($_SERVER['PHP_SELF']) == "viewtransactionreport_student.php")
		  {
		  echo " menu-open ";
		  }
		?>">
            <a href="#" class="nav-link 
		<?php
		  if(basename($_SERVER['PHP_SELF']) == "viewstudentsingleacrpt_std.php" || basename($_SERVER['PHP_SELF']) == "viewcredtransreport_student.php" || basename($_SERVER['PHP_SELF']) == "viewdebttransreport_student.php" || basename($_SERVER['PHP_SELF']) == "viewtransactionreport_student.php")
		  {
		  echo " active ";
		  }
		?>">
		<i class="nav-icon fas fa-address-card"></i>
              <p>
                Transaction Report
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="viewstudentsingleacrpt_std.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Student Account Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="viewcredtransreport_student.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Credit Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="viewdebttransreport_student.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Debit Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="viewtransactionreport_student.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Transaction Report</p>
                </a>
              </li>
            </ul>
          </li>  
		  	  
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-address-card"></i>
              <p>
                My Account
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="studentprofile.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update Profile</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="changestudentpassword.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Change password</p>
                </a>
              </li>
            </ul>
          </li>
		  
          <li class="nav-item">
            <a href="logout.php" class="nav-link" onclick="return confirmtoclose()">
              <i class="nav-icon fas fa-window-close"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
		<?php
		}
		if(isset($_SESSION['staff_id']))
		{
		?>
          <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
          <li class="nav-item 
		<?php
		  if(basename($_SERVER['PHP_SELF']) == "dashboard.php")
		  {
		  echo " menu-open ";
		  }
		?>">
            <a href="dashboard.php" class="nav-link 
		<?php
		  if(basename($_SERVER['PHP_SELF']) == "dashboard.php")
		  {
		  echo " active ";
		  }
		?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
		  		 
          <li class="nav-item 
		<?php
		  if(basename($_SERVER['PHP_SELF']) == "crentry.php" || basename($_SERVER['PHP_SELF']) == "drentry.php" || basename($_SERVER['PHP_SELF']) == "viewcrdrentry.php")
		  {
		  echo " menu-open ";
		  }
		?>">
            <a href="#" class="nav-link 
		<?php
		  if(basename($_SERVER['PHP_SELF']) == "crentry.php" || basename($_SERVER['PHP_SELF']) == "drentry.php" || basename($_SERVER['PHP_SELF']) == "viewcrdrentry.php")
		  {
		  echo " active ";
		  }
		?>">
              <i class="nav-icon fas fa-address-card"></i>
              <p>
                Transaction Entry
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="crentry.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Credit Entry</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="drentry.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Debt Entry</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="viewcrdrentry.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Entries</p>
                </a>
              </li>
            </ul>
          </li>  
		   
          <li class="nav-item 
		<?php
		  if(basename($_SERVER['PHP_SELF']) == "viewstudentacreport.php" || basename($_SERVER['PHP_SELF']) == "viewtransactionreport.php" || basename($_SERVER['PHP_SELF']) == "viewcredtransreport.php" || basename($_SERVER['PHP_SELF']) == "viewdebttransreport.php")
		  {
		  echo " menu-open ";
		  }
		?>">
            <a href="#" class="nav-link 
		<?php
		  if(basename($_SERVER['PHP_SELF']) == "viewstudentacreport.php" || basename($_SERVER['PHP_SELF']) == "viewtransactionreport.php" || basename($_SERVER['PHP_SELF']) == "viewcredtransreport.php" || basename($_SERVER['PHP_SELF']) == "viewdebttransreport.php")
		  {
		  echo " active ";
		  }
		?>">
              <i class="nav-icon fas fa-address-card"></i>
              <p>
                Transaction Report
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="viewstudentacreport.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Student Account Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="viewcredtransreport.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Credit Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="viewdebttransreport.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Debit Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="viewtransactionreport.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Transaction Report</p>
                </a>
              </li>
            </ul>
          </li>  
		  	  
          <li class="nav-item 
		<?php
		  if(basename($_SERVER['PHP_SELF']) == "student.php" || basename($_SERVER['PHP_SELF']) == "viewstudent.php")
		  {
			echo " menu-open ";
		  }
		?>">
            <a href="#" class="nav-link 
		<?php
		  if(basename($_SERVER['PHP_SELF']) == "student.php" || basename($_SERVER['PHP_SELF']) == "viewstudent.php")
		  {
		  echo " active ";
		  }
		?>">
              <i class="nav-icon fas fa-address-card"></i>
              <p>
                Student
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="student.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Student</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="viewstudent.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Student<span class="badge badge-info right"><?php
				  $sqlstpen = "SELECT * FROM student WHERE student_status!='Pending'";
				  $qsqlstpen = mysqli_query($con,$sqlstpen);
				  echo mysqli_error($con);
				  echo mysqli_num_rows($qsqlstpen);
				  ?></span></p>
                </a>
              </li>
              <li class="nav-item">
                <a href="viewstudent.php?stst=Pending" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Pending
                <span class="badge badge-info right"><?php
				  $sqlstpen = "SELECT * FROM student WHERE student_status='Pending'";
				  $qsqlstpen = mysqli_query($con,$sqlstpen);
				  echo mysqli_error($con);
				  echo mysqli_num_rows($qsqlstpen);
				  ?></span></p>
                </a>
              </li>
            </ul>
          </li>
		  <?php
		  if($_SESSION['staff_type'] == "Admin")
		  {
		  ?>
          <li class="nav-item 
		<?php
		  if(basename($_SERVER['PHP_SELF']) == "course.php" || basename($_SERVER['PHP_SELF']) == "viewcourse.php")
		  {
			echo " menu-open ";
		  }
		?>">
            <a href="#" class="nav-link 
		<?php
		  if(basename($_SERVER['PHP_SELF']) == "course.php" || basename($_SERVER['PHP_SELF']) == "viewcourse.php")
		  {
		  echo " active ";
		  }
		?>">
              <i class="nav-icon fas fa-address-card"></i>
              <p>
                Course
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="course.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Course</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="viewcourse.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Course</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item 
		<?php
		  if(basename($_SERVER['PHP_SELF']) == "staff.php" || basename($_SERVER['PHP_SELF']) == "viewstaff.php")
		  {
			echo " menu-open ";
		  }
		?>">
            <a href="#" class="nav-link 
		<?php
		  if(basename($_SERVER['PHP_SELF']) == "staff.php" || basename($_SERVER['PHP_SELF']) == "viewstaff.php")
		  {
		  echo " active ";
		  }
		?>">
              <i class="nav-icon fas fa-address-card"></i>
              <p>
                Staff
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="staff.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Staff</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="viewstaff.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Staff</p>
                </a>
              </li>
            </ul>
          </li>
		  <?php
		  }
		  ?>
          <li class="nav-item 
		<?php
		  if(basename($_SERVER['PHP_SELF']) == "staffprofile.php" || basename($_SERVER['PHP_SELF']) == "changestaffpassword.php")
		  {
			echo " menu-open ";
		  }
		?>">
            <a href="#" class="nav-link 
		<?php
		  if(basename($_SERVER['PHP_SELF']) == "staffprofile.php" || basename($_SERVER['PHP_SELF']) == "changestaffpassword.php")
		  {
		  echo " active ";
		  }
		?>">
              <i class="nav-icon fas fa-address-card"></i>
              <p>
                My Account
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="staffprofile.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>My Profile</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="changestaffpassword.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Change Password</p>
                </a>
              </li>
            </ul>
          </li>
		  
          <li class="nav-item">
            <a href="logout.php" class="nav-link" onclick="return confirmtoclose()">
              <i class="nav-icon fas fa-window-close"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
		<?php
		}
		?>
	   </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
<script>
function confirmtoclose()
{
	if(confirm("Are you sure?") == true)
	{
		return true;
	}
	else
	{
		return false;
	}
}
</script>
