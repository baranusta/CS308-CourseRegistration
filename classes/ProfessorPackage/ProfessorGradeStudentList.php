<?php
set_include_path(get_include_path() . PATH_SEPARATOR . 'C:\xampp\htdocs\CS308-CourseRegistration\classes');
include_once 'ProfessorPackage\ProfessorController.php';
include_once 'CoursePackage\CourseController.php';
include_once 'PersonalInfoPackage\PersonalInfoController.php';
include_once 'StudentPackage\Student.php';
include_once 'StudentPackage\StudentCourseController.php';
include_once 'ProfessorPackage\Professor.php';
//echo $term;
if(!isset($_SESSION)){
	session_start();
}
$cc = new CoursesController();
$cnr = $_POST['coursetobegraded'];
$term = $_SESSION['myUser']->getCurrentTerm();
$students = $cc->getEnrolledStudents($term, $cnr);
$arr = mysql_fetch_array($students);
$array = json_decode($arr[0]);
$scc = new PersonalInfoController();
echo "<form id='userInfo' action='ProfessorGiveGrades.php' method='POST'>";
if($array != NULL)
foreach($array as $key => $value)
{
	$isThereStudents = true;
	$student = $scc->getPersonalInfoById($key);
	echo "";
	echo "Student Name: ".$student["name"]."<br>";
	echo "Student Surname: ".$student["surname"]."<br>";
	echo "Student Number: ".$student["user_id"]."<br>";
	echo "Current Grade: ".$value."<br>";
	echo "Grade: <input type='text' name='".$student["user_id"].",".$cnr."' /><br>";
	echo "------------------------<br>";	
}
else
{
	echo "There are no enrolled students in this course.<br>";
}
echo "<input id='userInfo' type='submit'  value='Give Grades' '>";
echo "<form id='selectedCourses' action='ProfessorGiveGrades.php' method='POST'>";
//echo "<input type='text' name='clr' hidden='true'>";
//echo '<input type="submit" value="Go Back"></form>';

?>


