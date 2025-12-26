  <footer class="main-footer">
    <strong>Copyright &copy; <?php echo date("Y"); ?>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b><?php echo $projecttitle; ?></b>
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<?php
  if(basename($_SERVER['PHP_SELF']) == "staff.php" || basename($_SERVER['PHP_SELF']) == "staffprofile.php" || basename($_SERVER['PHP_SELF']) == "changestaffpassword.php" || basename($_SERVER['PHP_SELF']) == "course.php" || basename($_SERVER['PHP_SELF']) == "student.php" || basename($_SERVER['PHP_SELF']) == "crentry.php" || basename($_SERVER['PHP_SELF']) == "drentry.php" || basename($_SERVER['PHP_SELF']) == "studentprofile.php" || basename($_SERVER['PHP_SELF']) == "changestudentpassword.php" || basename($_SERVER['PHP_SELF']) == "invoice.php" || basename($_SERVER['PHP_SELF']) == "drentry.php" )
  {
?>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jquery-validation -->
<script src="plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="plugins/jquery-validation/additional-methods.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->
<?php
  }
  else if(basename($_SERVER['PHP_SELF']) == "viewstaff.php" || basename($_SERVER['PHP_SELF']) == "viewcourse.php" || basename($_SERVER['PHP_SELF']) == "viewstudent.php" || basename($_SERVER['PHP_SELF']) == "viewstudentacreport.php" || basename($_SERVER['PHP_SELF']) == "viewstudentsingleacrpt.php" || basename($_SERVER['PHP_SELF']) == "viewtransactionreport.php" || basename($_SERVER['PHP_SELF']) == "viewcrdrentry.php" || basename($_SERVER['PHP_SELF']) == "viewcredtransreport.php" || basename($_SERVER['PHP_SELF']) == "viewdebttransreport.php" || basename($_SERVER['PHP_SELF']) == "viewstudentsingleacrpt_std.php" || basename($_SERVER['PHP_SELF']) == "viewcredtransreport_student.php" || basename($_SERVER['PHP_SELF']) == "viewdebttransreport_student.php" || basename($_SERVER['PHP_SELF']) == "viewtransactionreport_student.php")
  {
?>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
	<?php
  }
  else
  {
  ?>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
  <?php
  }
  ?>
</body>
</html>
