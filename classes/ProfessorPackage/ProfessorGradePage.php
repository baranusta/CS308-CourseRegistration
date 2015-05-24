<?php
set_include_path(get_include_path() . PATH_SEPARATOR . 'C:\xampp\htdocs\CS308-CourseRegistration\classes');
include_once 'ProfessorPackage\ProfessorController.php';
include_once 'CoursePackage\CourseController.php';
include_once 'StudentPackage\Student.php';
include_once 'ProfessorPackage\Professor.php';
//echo $term;
if(!isset($_SESSION)){
	session_start();
}
$pc = new ProfessorController();
$ResultSet = $pc->GetCourses($_SESSION['myUser']);
echo "<form id='userInfo' action='ProfessorGradeStudentList.php' method='POST'>";
$cc = new CoursesController();
if($ResultSet != null)
{
	foreach ($ResultSet as $value)
	{
		$term = $_SESSION['myUser']->getCurrentTerm();
		$courseId = $value["cnr"];
		$course = $cc->getCoursebyCNR($value, $term);
		$ccnr = $course["cnr"];
		echo "<input type='radio' name='coursetobegraded' value=$ccnr checked='checked' />";
		echo "Course CNR: ".$course["cnr"]."<br>";
		echo "Course Code: ".$course["classCode"]."<br>";
		echo "Course Name: ".$course["longName"]."<br>";
		echo "Professor: ".$course["instructors"]."<br>";
		echo "Schedule: ".$course["schedule"]."<br>";
		echo "Credits: ".$course["credit"]."<br>";
		echo "------------------------<br>";	
	}
	echo "<input id='userInfo' type='submit'  value='Show Enrolled Students' '>";
	echo "<form id='selectedCourses' action='ProfessorGradeStudentList.php' method='POST'>";
	echo "<input type='text' name='clr' hidden='true'>";
	echo '<input type="submit" value="Go Back"></form>';
}
else
	echo "There are no courses to be graded."
?>


