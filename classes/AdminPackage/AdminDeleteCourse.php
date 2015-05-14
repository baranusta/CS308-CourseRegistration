<?php
set_include_path(get_include_path() . PATH_SEPARATOR . 'C:\xampp\htdocs\CS308-CourseRegistration\classes');
include_once 'CoursePackage/CourseController.php';
include_once 'AdminPackage/Admin.php';

//var_dump($_POST);

$cc = new CoursesController();

$arrToDelete = $_POST["deleteIds"];
foreach($arrToDelete as $value)
{
	$array = explode(",", $value);
	if($cc->DeleteCourse($array))
	{
		$admin = new Admin();
		$admin->deleteCourseStudents($array[1], $array[0]);//delete the course from all students
		$admin->deleteCourseCourse($array[1], $array[0]);
		echo "The course with CNR: ".$array[1]." is deleted in term ".$array[0]."<br>";
	}
}
?>