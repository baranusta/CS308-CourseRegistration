<?php
set_include_path(get_include_path() . PATH_SEPARATOR . 'C:\xampp\htdocs\CS308-CourseRegistration\classes');
include_once 'CourseController.php';

$sqlwhere = "";
$courseNum = "";

if(isset($_POST["sel_subj"]))
{
	$courseCode = $_POST["sel_subj"];
}
if(isset($_POST["sel_crse"]))
{
	$courseNum = $_POST["sel_crse"];
	if(strlen($courseNum))
		$sqlwhere ="WHERE cnr =".$courseNum;
}

//required where statement is constructed accordingly
if($courseCode != "*")
{
	$code =  "classCode LIKE '".$courseCode."%'";
	if(strlen($sqlwhere) > 0)
		$sqlwhere.= " AND ".$code;
	else
		$sqlwhere = "WHERE ".$code;
}
$term = $_POST["p_term"];
$CController = new CoursesController();
$wholeString = $CController->GetSearchedCoursesItems($term,$sqlwhere);

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
	echo 	"<form action=\"demo_form.asp\" method=\"get\">"
			.$wholeString
			."<button type=\"submit\" value=\"Submit\">Submit</button>
			</form>";
}
?>