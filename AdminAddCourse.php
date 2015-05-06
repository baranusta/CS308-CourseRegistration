<?php
set_include_path(get_include_path() . PATH_SEPARATOR . 'C:\xampp\htdocs\CS308-CourseRegistration\classes');
include_once 'CourseController.php';

if(isset($_POST["cName"]) && isset($_POST["cCode"]) && isset($_POST["cCRN"]) && isset($_POST["cFaculty"]) 
	&& isset($_POST["cSection"]) && isset($_POST["cInstructorName"])
	 && isset($_POST["cInstructorLastname"])&& isset($_POST["cCapacity"]) && isset($_POST["credits"]) && isset($_POST["cSchedule"]))
{
	
	$params = $_POST;
	$CController = new CoursesController();
	$CController->ControlCourse($params);

}
else
{
	echo "Please fill all the required information";
}

?>