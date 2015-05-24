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
	$cTerm = $_SESSION["ActiveTerm"];
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
	$withLocation = false;
	//TO-DO
	
	//form action part has to be edited.
	$User = $_SESSION['myUser'];
	$action = "..\\".$User->getBrowseCourseActionPage($cTerm==$term); 
	//echo $action;
	echo 	"	<div style=\"float:right; width:40%;\">
				<form action=\"$action\" method=\"post\" onsubmit=\"return valthisform()\">"
				.$wholeString
				."<button style=\"top:43; right: 43%; position:fixed;\" type=\"submit\" value=\"Submit\">Submit</button>
				</form></div>";
}
?>
<head>
<style>
th, td {
    border: 1px solid black;
    overflow: hidden;
    width: 100px;
    height: 30px;
}
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="CourseBrowserHelper.js"></script>
<script src="../FillSchedule.js"></script>
<script type="text/javascript">


var RegisteredCourses = <?php echo json_encode($User->getTakenCoursesInfo($cTerm)); ?>;
var TakenCourses = <?php echo json_encode($User->getTakenCoursesGrade()); ?>;
var Schedule = <?php echo json_encode($User->GetSchedule($term)); ?>;
if(Schedule==null)
	Schedule = {};
var withLocation = <?php echo json_encode($withLocation); ?>;
var SubmitAction = <?php echo json_encode($cTerm==$term); ?>;
var CurrentTerm = <?php echo json_encode($cTerm); ?>;
var Courses = <?php echo json_encode($json); ?>;
Courses = JSON.parse(Courses);

</script>
</head>
<body>
<div class="Right_Part" style="float:left; width:50%; ">
<div class="schedule_t" style="position:fixed;">
<table id="schedule" border="1" style="width:100%;border-collapse: collapse; ">
  <tr>
    <td>Monday</td>
    <td>Tuesday</td> 
    <td>Wednesday</td>
    <td>Thursday</td>
    <td>Friday</td> 
  </tr>
  <tr>
    <td></td>
    <td></td> 
    <td></td>
    <td></td>
    <td></td> 
    <td>8:40-9.30 am</td> 
  </tr>
  <tr>
    <td></td>
    <td></td> 
    <td></td>
    <td></td>
    <td></td> 
    <td>9:40-10.30 am</td> 
  </tr>
  <tr>
    <td></td>
    <td></td> 
    <td></td>
    <td></td>
    <td></td> 
    <td>10:40-11.30 am</td> 
  </tr>
  <tr>
    <td></td>
    <td></td> 
    <td></td>
    <td></td>
    <td></td> 
    <td>11:40-12.30 am</td> 
  </tr>
  <tr>
    <td></td>
    <td></td> 
    <td></td>
    <td></td>
    <td></td> 
    <td>12:40 am-1.30 pm</td> 
  </tr>
  <tr>
    <td></td>
    <td></td> 
    <td></td>
    <td></td>
    <td></td>
    <td>1:40-2.30 pm</td>  
  </tr>
  <tr>
    <td></td>
    <td></td> 
    <td></td>
    <td></td>
    <td></td> 
    <td>2:40-3.30 pm</td> 
  </tr>
  <tr>
    <td></td>
    <td></td> 
    <td></td>
    <td></td>
    <td></td> 
    <td>3:40-4.30 pm</td> 
  </tr>
  <tr>
    <td></td>
    <td></td> 
    <td></td>
    <td></td>
    <td></td> 
    <td>4:40-5.30 pm</td> 
  </tr>
  <tr>
    <td></td>
    <td></td> 
    <td></td>
    <td></td>
    <td></td> 
    <td>5:40-6.30 pm</td> 
  </tr>
  <tr>
    <td></td>
    <td></td> 
    <td></td>
    <td></td>
    <td></td>
    <td>6:40-7.30 pm</td>  
  </tr>
</table> 
</div>
</div>
</body>
	