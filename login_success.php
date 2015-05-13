<?php
set_include_path(get_include_path() . PATH_SEPARATOR . 'C:\xampp\htdocs\CS308-CourseRegistration\classes');
set_include_path(get_include_path() . PATH_SEPARATOR . 'C:\xampp\htdocs\CS308-CourseRegistration');
include_once 'StudentPackage/Student.php';
session_start();

	echo $_SESSION['userName'];
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