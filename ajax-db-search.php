<?php
include("dbconnection.php");
if(isset($_POST['txt_search']))
{
	$sqlst = "SELECT student.*,course.course FROM student LEFT JOIN course ON student.course_id=course.course_id WHERE student.student_name LIKE '" . $_POST['txt_search'] . "%' OR enrollment_no='". $_POST['txt_search'] ."' OR admission_no='". $_POST['txt_search'] ."' LIMIT 25";
	$qresult = mysqli_query($con, $sqlst);
	echo mysqli_error($con);
	$output = "<ul class='list-unstyled' style='position:absolute;z-index:100;width: 95%;'>";	
	if(mysqli_num_rows($qresult) > 0) 
	{
		while($rsuser = mysqli_fetch_array($qresult)) 
		{
			$output .= "<li onclick='funselrec(" . $rsuser['student_id'] . ")' class='form-control btn-info varlist' style='cursor: pointer;'>Student: " . ucwords($rsuser['student_name']) . " | Course - " . $rsuser['course'] . " | Enrollment No. - " . $rsuser['enrollment_no'] . " | Admission No. - " . $rsuser['admission_no'] ."</li>";
			//$res[] = $rsuser['student_name'];
		}
	} 
	else 
	{
		$output .= '<li class="form-control" > Record not Found</li>';
	}
	//return json res
	$output .= '</ul>';
	echo $output;
}
?>