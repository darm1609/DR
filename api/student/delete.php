<?php
$requestMethod = $_SERVER["REQUEST_METHOD"];
include('../class/Student.php');
$student = new Student();
switch($requestMethod) {
	case 'GET':
		$empId = '';	
		if($_GET['id']) {
			$studentID = $_GET['id'];
			$student->setStudentID($studentID);
		}
		$studentInfo = $student->deleteStudent();
		if(!empty($studentInfo)) {
	      $js_encode = json_encode(array('status'=>TRUE, 'message'=>'Student deleted Successfully.'), true);
        } else {
            $js_encode = json_encode(array('status'=>FALSE, 'message'=>'Student delete failed.'), true);
        }
		header('Content-Type: application/json');
		echo $js_encode;
		break;
	default:
	header("HTTP/1.0 405 Method Not Allowed");
	break;
}
?>