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
		$_SESSION['myUser']->removeCourse($_SESSION['ActiveTerm'],$course);
		// $_SESSION["AllCourses"][$course."cnr"]->registerStudent($_SESSION['myUser']->getId());
    }
	$_SESSION['myUser']->UpdateRegisteredCourseDB();
}
header("location:StudentAddDropPage.php");
?>