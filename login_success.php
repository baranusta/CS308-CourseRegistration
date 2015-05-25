<?php
set_include_path(get_include_path() . PATH_SEPARATOR . 'C:\xampp\htdocs\CS308-CourseRegistration\classes');
set_include_path(get_include_path() . PATH_SEPARATOR . 'C:\xampp\htdocs\CS308-CourseRegistration');
include_once 'StudentPackage/Student.php';
include_once 'ProfessorPackage/Professor.php';
include_once 'AdminPackage/Admin.php';

session_start();
	if(!isset($_SESSION['userName'])){
		echo 'Login Failed';
	}
	else{
		$_SESSION['myUser']->getFirstScreen(); 
	}
?>

<html>
<body>
Login Successful
</body>
</html>