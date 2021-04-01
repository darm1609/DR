<?php
$requestMethod = $_SERVER["REQUEST_METHOD"];
include('../class/Student.php');
$student = new Student();
switch($requestMethod) {	
	case 'POST':
		$studentID = $_POST['id'];
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$roll_no = $_POST['roll_no'];
		$class = $_POST['class'];
		$age = $_POST['age'];
		$address = $_POST['address'];
		$status = $_POST['status'];

		$student->setStudentID($studentID);
	    $student->setFirstName($first_name);
	    $student->setLastName($last_name);
	    $student->setRollNo($roll_no);
	    $student->setClassName($class);
	    $student->setAge($age);
	    $student->setAddress($address);
		$studentInfo = $student->updateStudent();
		if(!empty($studentInfo)) {
	      $js_encode = json_encode(array('status'=>TRUE, 'message'=>'Student updated Successfully'), true);
        } else {
            $js_encode = json_encode(array('status'=>FALSE, 'message'=>'Student updation failed.'), true);
        }
		header('Content-Type: application/json');
		echo $js_encode;
	default:
	header("HTTP/1.0 405 Method Not Allowed");
	break;
}
?>