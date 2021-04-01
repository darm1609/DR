<?php
$requestMethod = $_SERVER["REQUEST_METHOD"];
include('../class/Student.php');
$student = new Student();
switch($requestMethod) {
	case 'GET':
		$studentID = '';	
		if($_GET['id']) {
			$studentID = $_GET['id'];
			$student->setStudentID($studentID);
			$studentInfo = $student->getStudent();
		} else {
			$studentInfo = $student->getAllStudent();
		}
		if(!empty($studentInfo)) {
	      $js_encode = json_encode(array('status'=>TRUE, 'studentInfo'=>$studentInfo), true);
        } else {
            $js_encode = json_encode(array('status'=>FALSE, 'message'=>'There is no record yet.'), true);
        }
		header('Content-Type: application/json');
		echo $js_encode;
		break;
	default:
	header("HTTP/1.0 405 Method Not Allowed");
	break;
}
?>