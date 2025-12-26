<?php
include("webconfig.php");
$sqlst = "SELECT student.*,course.course,(SELECT ifnull(SUM(transaction_amt),0) FROM `transaction` WHERE transaction_type='Credit' AND transaction_status='Active' AND student_id=student.student_id) as creditamt,(SELECT ifnull(SUM(transaction_amt),0) FROM `transaction` WHERE transaction_type='Debit' AND transaction_status='Active' AND student_id=student.student_id) as debitamt FROM student LEFT JOIN course ON student.course_id=course.course_id WHERE student.student_id = '" . $_POST['selstid'] . "' ";
$qresult = mysqli_query($con, $sqlst);
echo mysqli_error($con);	
$rsuser = mysqli_fetch_array($qresult);
$bal = floatval($rsuser['creditamt']) - floatval($rsuser['debitamt']);
//student_id student_name course_title enrollment_no admission_no available_bal
$return_arr[] = array(
						"student_id" => $rsuser['student_id'],
						"student_name" => $rsuser['student_name'],
						"course_title" => $rsuser['course'],
						"enrollment_no" => $rsuser['enrollment_no'],
						"admission_no" => $rsuser['admission_no'],
						"available_bal" => $bal
					);
// Encoding array in JSON format
echo json_encode($return_arr);
?>