<?php
set_include_path(get_include_path() . PATH_SEPARATOR . 'C:\xampp\htdocs\CS308-CourseRegistration\classes');
include_once 'CoursePackage\CourseController.php';

	$params = $_POST;
	$CController = new CoursesController();
	$CController->ControlCourse($params);

?>