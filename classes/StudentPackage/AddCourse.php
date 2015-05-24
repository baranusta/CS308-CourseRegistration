<?php
set_include_path(get_include_path() . PATH_SEPARATOR . 'C:\xampp\htdocs\CS308-CourseRegistration\classes');
include_once 'CoursePackage\CourseController.php';
include_once 'StudentPackage\Student.php';
if(!empty($_POST['cnr']))
{
	foreach($_POST['cnr'] as $course) {
		if(!isset($_SESSION)){
			session_start();
		}
		$name = $_SESSION["AllCourses"][$course.'cnr']->getShortName();
		$isCoreq = true; 
		
		// foreach($_POST['cnr'] as $corCheck){
			// if($_SESSION["AllCourses"][$corCheck.'cnr']->getCorequisites() == $name)
				// $isCoreq |= true;
		// }
		$_SESSION['myUser']->registerToCourse($_SESSION['term'],$name,$course,$isCoreq);
		$_SESSION["AllCourses"][$course."cnr"]->registerStudent($_SESSION['myUser']->getId());
    }
	$_SESSION['myUser']->UpdateRegisteredCourseDB();
	header("location:StudentAddDropPage.php");
}
else{
}

?>