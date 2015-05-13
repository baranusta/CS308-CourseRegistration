<?php
set_include_path(get_include_path() . PATH_SEPARATOR . 'C:\xampp\htdocs\CS308-CourseRegistration\classes');
include_once 'CoursePackage/CourseController.php';
include_once 'StudentPackage/Student.php';

$sqlwhere = "";
$courseNum = "";

if(isset($_POST["sel_subj"]))
{
	$classCode = $_POST["sel_subj"];
}
if(isset($_POST["sel_crse"]))
{
	$courseNum = $_POST["sel_crse"];
	if(strlen($courseNum))
		$sqlwhere ="WHERE cnr =".$courseNum;
}

//required where statement is constructed accordingly
if($classCode != "*")
{
	$code =  "classCode LIKE '".$classCode."%'";
	if(strlen($sqlwhere) > 0)
		$sqlwhere.= " AND ".$code;
	else
		$sqlwhere = "WHERE ".$code;
}
$term = $_POST["p_term"];
	session_start();
	$_SESSION["term"] = $term;
if(isset($_SESSION["AllCourses"]))
	unset($_SESSION["AllCourses"]);
$CController = new CoursesController();
$json = "";
$wholeString = $CController->GetSearchedCoursesItems($term,$sqlwhere,$json);
//if no course found according to the criteria wholeString will be empty 
if($wholeString == "")
{
	echo "No Course Found!!";
}	
else
{
	//if there is any course,
	
	//TO-DO
	//form action part has to be edited.
	$User = $_SESSION['myUser'];
	$action = "..\\".$User->getBrowseCourseActionPage(); 
	//echo $action;
	echo 	"<form action=\"$action\" method=\"post\" onsubmit=\"return valthisform()\">"
			.$wholeString
			."<button type=\"submit\" value=\"Submit\">Submit</button>
			</form>";
}
?>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</head>
<script src="CourseBrowserHelper.js"></script>
<script type="text/javascript">
	
var TakenCourses = <?php echo json_encode($User->GetTakenCourses($term)); ?>;
var Schedule = <?php echo json_encode($User->GetSchedule()); ?>;
var Courses = <?php echo json_encode($json); ?>;
Courses = JSON.parse(Courses);

</script>
	