<?php
include("header.php");
$sqltransaction = "SELECT student.*,transaction.*,staff.staff_name FROM transaction LEFT JOIN student ON student.student_id=transaction.student_id LEFT JOIN staff ON staff.staff_id=transaction.staff_id WHERE transaction.transaction_id='" . $_GET['transaction_id'] . "'";
$qsqltransaction = mysqli_query($con,$sqltransaction);
$rstransaction = mysqli_fetch_array($qsqltransaction);
//###################################
$sqlst = "SELECT student.*,course.course,(SELECT ifnull(SUM(transaction_amt),0) FROM `transaction` WHERE transaction_type='Credit' AND transaction_status='Active' AND student_id='$rstransaction[student_id]' AND transaction.transaction_id<'$rstransaction[transaction_id]') as creditamt,(SELECT ifnull(SUM(transaction_amt),0) FROM `transaction` WHERE transaction_type='Debit' AND transaction_status='Active' AND student_id='$rstransaction[student_id]' AND transaction.transaction_id<'$rstransaction[transaction_id]') as debitamt FROM student LEFT JOIN course ON student.course_id=course.course_id WHERE student.student_id = '" . $rstransaction['student_id'] . "' ";
$qresult = mysqli_query($con, $sqlst);
echo mysqli_error($con);	
$rsuser = mysqli_fetch_array($qresult);
$bal = floatval($rsuser['creditamt']) - floatval($rsuser['debitamt']);
//###################################
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Debit Invoice</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Invoice</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <!-- Main content -->
            <div class="invoice p-3 mb-3" id="divprint">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
					<center><img src="<?php echo $logo; ?>" style='width: 250px;' ></center>
					<?php /*
                    <i class="fas fa-globe"></i> AdminLTE, Inc.
                    <small class="float-right">Date: 2/10/2014</small>*/ ?>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  From
                  <address>
                    <strong><?php echo $projecttitle; ?></strong><br>
                    <?php echo $address; ?><br>
                    Phone: <?php echo $email; ?><br>
                    Email: <?php echo $phno; ?><br>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  To
                  <address>
                    <strong><?php echo $rstransaction['student_name']; ?></strong><br>
                    <?php echo $rstransaction['student_address']; ?><br>
                    Phone: <?php echo $rstransaction['student_contact']; ?><br>
                    Email: <?php echo $rstransaction['student_email']; ?>
                  </address>
                </div>	
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Invoice #<?php echo $rstransaction['receipt_no']; ?></b><br>
                  <br>
                  <b>Transaction date:</b> <?php echo date("d-m-Y",strtotime($rstransaction['transaction_date'])); ?><br>
                  <b>Billed by :</b> <?php echo $rstransaction['staff_name']; ?>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                      <th>SL No.</th>
                      <th>Transaction Note</th>
                      <th>Debit Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <td>1</td>
                      <td><?php echo $rstransaction['transaction_note']; ?></td>
                      <td><?php echo $currency . " " . $rstransaction['transaction_amt']; ?></td>
                    </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
				<?php
				/*
                  <p class="lead">Payment Methods:</p>
                  <img src="dist/img/credit/visa.png" alt="Visa">
                  <img src="dist/img/credit/mastercard.png" alt="Mastercard">
                  <img src="dist/img/credit/american-express.png" alt="American Express">
                  <img src="dist/img/credit/paypal2.png" alt="Paypal">

                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
                    plugg
                    dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                  </p>
				*/
				?>
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Previous balance:</th>
                        <td><?php echo $currency . " "; ?> <?php echo $bal ; ?></td>
                      </tr>
                      <tr>
                        <th>Debit Amount:</th>
                        <td><?php echo $currency . " "; ?> <?php echo $rstransaction['transaction_amt']; ?></td>
                      </tr>
                      <tr>
                        <th>Total Balance:</th>
                        <td><?php echo $currency . " "; ?> <?php echo $bal-$rstransaction['transaction_amt']; ?></td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
					<?php
				  /*
                  <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                  <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                    Payment
                  </button>
				  */
				  ?>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
            <div class="invoice p-3 mb-3" style="height: 75px;">
                  <center><button type="button" class="btn btn-default" style="margin-right: 5px;"onclick="PrintElem('divprint')" ><i class="fas fa-print"></i> Click here to Print</button></center>
			</div>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php
include("footer.php");
?>
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