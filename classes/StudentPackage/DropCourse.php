<?php
set_include_path(get_include_path() . PATH_SEPARATOR . 'C:\xampp\htdocs\CS308-CourseRegistration\classes');
include_once 'CoursePackage\CourseController.php';
include_once 'StudentPackage\Student.php';
if(!empty($_POST['cnr']))
{
	$_POST['cnr'];
	foreach($_POST['cnr'] as $course) {
		if(!isset($_SESSION)){
			session_start();
		}
		$cnr = explode(",",$course)[1];
		$_SESSION['myUser']->unregisterCourse($_SESSION['ActiveTerm'],$cnr);
    }
	$_SESSION['myUser']->UpdateRegisteredCourseDB();
}
header("location:StudentAddDropPage.php");
?>