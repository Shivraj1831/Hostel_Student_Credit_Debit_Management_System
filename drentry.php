<?php
include("header.php");
if(isset($_POST['submit']))
{
	$sqlreceipt_no = "SELECT ifnull(max(receipt_no),0)+1 as maxno FROM transaction WHERE  transaction_status='Active'";
	$qsqlreceipt_no = mysqli_query($con,$sqlreceipt_no);
	echo mysqli_error($con);
	$rsreceipt_no = mysqli_fetch_array($qsqlreceipt_no);
	$sql ="INSERT INTO transaction(student_id, staff_id, receipt_no, transaction_type, transaction_date, transaction_amt, transaction_note, transaction_status) values('$_POST[student_id]','$_SESSION[staff_id]','" . $rsreceipt_no['maxno'] ."','Debit','$_POST[transaction_date]','$_POST[paid_amount]','$_POST[transaction_note]','Active')";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	$insid = mysqli_insert_id($con);
	echo "<script>alert('Transaction Entry done successfully...');</script>";
	echo "<script>window.location='drinvoice.php?transaction_id=$insid';</script>";
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
                <h3 class="card-title">Debit Entry <small>Enter the details</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form name="frmform" id="frmform" method="post" action="">
			  <input type="hidden" name="student_id" class="form-control" id="student_id" readonly value="0">
                <div class="card-body">
				
				<div class="row">
					<div class="col-md-12">
					  <div class="form-group">	
						<label for="inputstaff_name">Enter Student detail</label>
							<input type="text" name="txt_search" class="form-control" id="txt_search" placeholder="Enter Student detail"  onClick="this.select();" autocomplete="off" >
							<div id="txt_search_list"></div>
							<hr>
					  </div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-6">
					    <div class="form-group">
							<label for="inputstudent_name">Student Name</label>
							<input type="text" name="student_name" class="form-control" id="student_name" readonly>
						</div>
						<div class="form-group">
							<label for="inputcourse_title">Course </label>
							<input type="text" name="course_title" class="form-control" id="course_title" readonly>
						</div>
					    <div class="form-group">
							<label for="inputenrollment_no">Enrollment No.</label>
							<input type="text" name="enrollment_no" class="form-control" id="enrollment_no" readonly >
						</div>
					    <div class="form-group">
							<label for="inputadmission_no">Admission No.</label>
							<input type="text" name="admission_no" class="form-control" id="admission_no" readonly >
						</div>
					</div>
					
					<div class="col-md-6">
					  <div class="form-group">
						<label for="inputavailable_bal">Available Balance</label>
						<input type="number" name="available_bal" class="form-control" id="available_bal" placeholder="Available Balance" readonly>
					  </div>
					  <div class="form-group">
						<label for="inputtransaction_date">Transaction Date</label>
						<input type="date" name="transaction_date" class="form-control" id="transaction_date" placeholder="Transaction Date" value="<?php echo date("Y-m-d"); ?>" readonly>
					  </div>
					  <div class="form-group">
						<label for="inputpaid_amount">Paid Amount</label>
						<input type="number" name="paid_amount" class="form-control" id="paid_amount" placeholder="Paid Amount" >
					  </div>
					  <div class="form-group">
						<label for="inputstaff_name">Transaction Note</label>
						<input type="text" name="transaction_note" class="form-control" id="transaction_note" placeholder="Transaction Note">
					  </div>
					</div>
				</div>
				
                </div>
                <!-- /.card-body -->
                <div class="card-footer" style="text-align: right;">
                  <button type="submit" name="submit"  id="submit" class="btn btn-success">Submit Credit Entry</button>
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
<script type="text/javascript">
  $(document).ready(function(){
      $("#txt_search").on("keyup", function(){
        var txt_search = $(this).val();
        if (txt_search !=="") {
          $.ajax({
            url:"ajax-db-search.php",
            type:"POST",
            cache:false,
            data:{txt_search:txt_search},
            success:function(data){
              $("#txt_search_list").html(data);
              $("#txt_search_list").fadeIn();
            }  
          });
        }else{
          $("#txt_search_list").html("");  
          $("#txt_search_list").fadeOut();
        }
      });

      // click one particular txt_search name it's fill in textbox
      $(document).on("click",".varlist", function(){
        $('#txt_search').val($(this).text());
        $('#txt_search_list').fadeOut("fast");
      });
  });
</script>
<script>
function funselrec(selstid)
{
	$.ajax({
        url: 'ajax-selected_rec.php',
        type: 'POST',
		cache:false,
		data:{selstid:selstid},
        dataType: 'JSON',
        success: function(response){
            var len = response.length;
            for(var i=0; i<len; i++){
                //var id = response[i].id;
				//alert(response[i].student_name);
				$("#student_id").val(response[i].student_id);
				$("#student_name").val(response[i].student_name);
				$("#course_title").val(response[i].course_title);
				$("#enrollment_no").val(response[i].enrollment_no);
				$("#admission_no").val(response[i].admission_no);
				$("#available_bal").val(response[i].available_bal);
            }
        }
    });
}
</script>