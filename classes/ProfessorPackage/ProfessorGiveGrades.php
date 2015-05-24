<?php
set_include_path(get_include_path() . PATH_SEPARATOR . 'C:\xampp\htdocs\CS308-CourseRegistration\classes');
include_once 'ProfessorPackage\ProfessorController.php';
include_once 'CoursePackage\CourseController.php';
include_once 'PersonalInfoPackage\PersonalInfoController.php';
include_once 'StudentPackage\Student.php';
include_once 'StudentPackage\StudentCourseController.php';
include_once 'ProfessorPackage\Professor.php';
if(!isset($_SESSION)){
			session_start();
}
$term = $_SESSION["ActiveTerm"];
$cc = new CoursesController();
foreach($_POST as $key => $value)
{
	var_dump($key);
	$strarray = explode(",", $key);
	$id = $strarray[0];
	$cnr = $strarray[1];
	$crs = $cc->getCoursebyCNR($cnr, $term);
	$stu = new Student($id, $term);
	$array = $stu->enterGrade($term,$crs['classCode'],$cnr,$value);
	$cc->UpdateGrade($array, $id);
}

?>


