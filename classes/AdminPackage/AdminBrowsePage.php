<?php
set_include_path(get_include_path() . PATH_SEPARATOR . 'C:\xampp\htdocs\CS308-CourseRegistration\classes');
include_once 'CoursePackage\CourseController.php';
include_once 'StudentPackage\Student.php';
$term = $_POST["p_term"];
//echo $term;
$cc = new CoursesController();
$sqlResultSet = $cc->returnCourses($_POST, $term);
echo "<form id='userInfo' action='AdminDeleteCourse.php' method='POST'>";
while($resultSet = mysql_fetch_array($sqlResultSet))
{
	//var_dump($resultSet);
	$value = $resultSet;
	//var_dump($value);
	$courseId = $value["cnr"];
	echo "<input type='checkbox' name='deleteIds[]' value=$term,$courseId />";
	echo "Course CNR: ".$value["cnr"]."<br>";
	echo "Course Code: ".$value["classCode"]."<br>";
	echo "Course Name: ".$value["longName"]."<br>";
	echo "Professor: ".$value["instructors"]."<br>";
	echo "Schedule: ".$value["schedule"]."<br>";
	echo "Credits: ".$value["credit"]."<br>";
	echo "------------------------<br>";
	//echo "id: ".$value[0]."---firstname: ".$value[1]."---lastname: ".$value[2]."<br>";	
}
echo "<input id='userInfo' type='submit'  value='Delete' '>";
echo "<form id='selectedCourses' action='AdminDeleteCourse.php' method='POST'>";
echo "<input type='text' name='clr' hidden='true'>";
echo '<input type="submit" value="Go Back"></form>';
?>