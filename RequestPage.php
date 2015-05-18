<html>
<head>
    <title>Prof & Stu - Send and See Request</title>
    <meta charset="utf-8" /> 
	
</head>
<body>
<?php
$_SESSION['term']   =  '201402';
$term = $_SESSION['term'];
$_SESSION['userId'] = '487';
$stuId = $_SESSION['userId'];

$formUpperHtml = <<<EOF
<form action="RequestPage.php" method="POST">
    <br>
    <table border="0" width="400">
        <tbody>
            <tr>
                <td><b>Ders</b>
                    <br><i>Course</i></td>
                <td>
			<select name="courseArray" size="5" width="200">
EOF;

$formLowerHtml = <<<EOF
</select>       
	</td>
    </tr>
            <tr>
                <td colspan="5">&nbsp;</td>
            </tr>
            <input type="hidden" name="term_code" value="$term">
            <tr>
                <td><b>İzin Türü </b>
                    <br><i>Override Type</i></td>
                <td>
                    <select name="typeRequest" size="1" width="200">
                        <option value="">-
                        </option>
						<option value="Illegal Operation">Illegal Operation
                        </option>
                        <option value="Time Conflict">Time Conflict
                        </option>
						<option value="Special Approval">Special Approval
                        </option>
						<option value="Monkey Business">Monkey Business
                        </option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="5">&nbsp;</td>
            </tr>
            <tr>
                <td><b>İsteğinizi acıklayınız</b>
                    <br><i>Explain Your Request</i></td>
                <td colspan="5">
                    <textarea name="studentMessage" rows="3" cols="50"></textarea>
                </td>
                <td><b>Acıklamanız 255 karakteri gecmemelidir.</b>
                    <br>Your request explanation not exceed 255 characters.</td>
            </tr>
        </tbody>
    </table>
    <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

    <input type="submit" value="Submit">

</form>
EOF;

set_include_path(get_include_path() . PATH_SEPARATOR . 'C:\xampp\htdocs\CS308-CourseRegistration\classes');
include_once 'classes/CourseController.php';
include_once 'classes/RequestPackage/RequestModel.php';


if(isset($_POST['courseArray']))
{
	var_dump($_POST);
	$dummyArray = explode("-",$_POST['courseArray']);
	$courseCNR = $dummyArray[0];
	$profId = $dummyArray[1];
	$typeRequest = $_POST['typeRequest'];
	$message = $_POST['studentMessage'];
	
	
	$newReq = new Request;
	$newReq->stuAddRequest($term, $profId, $stuId, $courseCNR, $typeRequest, $message);
	
	unset($_POST['courseArray']);
	echo "REQUEST SENT!!!!!!!!!!<BR>";
}

session_start();


$_SESSION['type'] = "S";
//$_SESSION['type'] = "P";


if($_SESSION['type'] == "S")
{
	echo $formUpperHtml;
		
		$courseController = new CoursesController;
		$courses = $courseController->getTermCoursesArray($term);
		//var_dump($courses);
		
		
		foreach($courses as&$course)
		{
				echo '<option value="'.$course[0].'-'.$course[1].'">'.$course[0].'-'.$course[3].'.'.$course[4].'-'.$course[2].' - '.$course[7].'</option>';             
		}         

	echo $formLowerHtml;

	

}
//end of if($_SESSION['type'] == "S")






?>
</body>
</html>