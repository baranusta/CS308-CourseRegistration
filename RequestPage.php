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
$userId = $_SESSION['userId'];

$formUpperHtmlStu = <<<EOF
<form action="RequestPage.php" method="POST">
    <br>
    <table border="0" width="400">
        <tbody>
            <tr>
                <td><b>Ders</b>
                    <br><i>Course</i></td>
                <td>
			<select name="studentReq" size="5" width="200">
EOF;

$formLowerHtmlStu = <<<EOF
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
	<br>
	<form action="RequestPage.php" method="POST">
	<input type="hidden" name="seeRequest">
	<input type="submit" value="See Request Responses">

</form>
EOF;

$tableUpProf = <<<EOF
<form action="RequestPage.php" method="POST">
<table >
<tbody style="font-size: 12px;
  white-space: normal !important;
  padding: 2px;
  border: 1px solid #555;">
    <tr>
        <td colspan="8"><b>Donem / Term :$term</b></td>
    </tr>
    <tr>
        <td nowrap="" style="border: 1px solid #555;"><b>Course </b></td>
        <td nowrap="" style="border: 1px solid #555;"><b>Override Type</b></td>
        <td nowrap="" style="border: 1px solid #555;"><b>Request Explanation</b></td>
        <td nowrap="" style="border: 1px solid #555;"><b>Pr.Instructor</b></td>
        <td nowrap="" style="border: 1px solid #555;"><b>Instructor Msg</b></td>
        <td nowrap="" style="border: 1px solid #555;"><b>Response</b></td>
        <!--<td nowrap="" style="border: 1px solid #555;"><b>Onay Durumu/<br>Approval Status</b></td>
        <td nowrap="" style="border: 1px solid #555;"><b>Öğretim Elemanı Yanıtı/<br>Instructor Response</b></td>--->
		
    </tr>

EOF;





set_include_path(get_include_path() . PATH_SEPARATOR . 'C:\xampp\htdocs\CS308-CourseRegistration\classes');
include_once 'classes/CourseController.php';
include_once 'classes/RequestPackage/RequestModel.php';
include_once 'classes/Course.php';

if(isset($_POST['studentReq']))
{
	$dummyArray = explode("-",$_POST['studentReq']);
	$courseCNR = $dummyArray[0];
	$profId = $dummyArray[1];
	$typeRequest = $_POST['typeRequest'];
	$message = $_POST['studentMessage'];
	
	
	$newReq = new Request;
	$newReq->stuAddRequest($term, $profId, $userId, $courseCNR, $typeRequest, $message);
	
	unset($_POST['studentReq']);
	unset($_POST['typeRequest']);
	unset($_POST['studentMessage']);
	echo "REQUEST SENT!!!!!!!!!!<BR>";
}
else if(isset($_POST['response']))
{
	$requestIds = $_POST['response'];
	$profMsgs = $_POST['message_prof'];
	$answers = $_POST['answer'];
	
	$newReq = new Request;
	$newReq->profResponseRequest($requestIds, $answers, $profMsgs);
	
	
	unset($_POST['response']);
	unset($_POST['message_prof']);
	unset($_POST['answer']);
	
}

session_start();


$_SESSION['type'] = "S";



if($_SESSION['type'] == "S")
{
	
	if(isset($_POST['seeRequest']))
	{
		//get profs all requests as array
		$requestModel = new Request;
		$requestArray = $requestModel->stuGetListRequest($userId);
		
		echo $tableUpProf;//html code
		
		$courseObject = new Course();//with empty constructor
		
		foreach ($requestArray as &$request)
		{
			//returns the row the course
			$courseInfo = $courseObject->getCourseByTerm($request['term'], $request['cnr']);
			$requestId = $request['request_id'];
			$courseCNR = $courseInfo['cnr'];
			$courseClassCode = $courseInfo['classCode'];
			$courseSection = $courseInfo['section'];
			$courseLongName = $courseInfo['longName'];
			$courseInstructor = $courseInfo['instructors'];
			$requestType = $request['type_request'];
			$requestStuMsg = $request['message_stu'];
			$requestProfMsg = $request['message_prof'];
			$requestAnswer = $request['answer'];
		
			
			
				echo <<<EOF
			<tr>
				<input type="hidden" name="response[]" value="$requestId">
				<td nowrap="" style="border: 1px solid #555;">$courseCNR-$courseClassCode.$courseSection-$courseLongName</td>
				<td nowrap="" style="border: 1px solid #555;">$requestType</td>
				<td nowrap="" style="border: 1px solid #555;">$requestStuMsg</td>
				<td nowrap="" style="border: 1px solid #555;">$courseInstructor</td>
				<td nowrap="" style="border: 1px solid #555;">$requestProfMsg</td>
				<td nowrap="" style="border: 1px solid #555;">$requestAnswer</td>
				</td>
			   
			</tr>
EOF;
			
		}
		echo "</tbody></table>";
	}
	else
	{
		
	
		echo $formUpperHtmlStu;
			
			$courseController = new CoursesController;
			$courses = $courseController->getTermCoursesArray($term);

			
			
			foreach($courses as&$course)
			{
					echo '<option value="'.$course[0].'-'.$course[1].'">'.$course[0].'-'.$course[3].'.'.$course[4].'-'.$course[2].' - '.$course[7].'</option>';             
			}         

		echo $formLowerHtmlStu;
	}
	

}//end of if($_SESSION['type'] == "S")
else if($_SESSION['type'] == "P")
{
	//get profs all requests as array
	$requestModel = new Request;
	$requestArray = $requestModel->profGetListRequest($userId);
	
	echo $tableUpProf;//html code
	
	$courseObject = new Course();//with empty constructor
	
	foreach ($requestArray as &$request)
	{
		//returns the row the course
		$courseInfo = $courseObject->getCourseByTerm($request['term'], $request['cnr']);
		$requestId = $request['request_id'];
		$courseCNR = $courseInfo['cnr'];
		$courseClassCode = $courseInfo['classCode'];
		$courseSection = $courseInfo['section'];
		$courseLongName = $courseInfo['longName'];
		$courseInstructor = $courseInfo['instructors'];
		$requestType = $request['type_request'];
		$requestStuMsg = $request['message_stu'];
		$requestProfMsg = $request['message_prof'];
	
		if($request['answer'] == "Pending...")
		{
		
			echo <<<EOF
		<tr>
			<input type="hidden" name="response[]" value="$requestId">
			<td nowrap="" style="border: 1px solid #555;">$courseCNR-$courseClassCode.$courseSection-$courseLongName</td>
			<td nowrap="" style="border: 1px solid #555;">$requestType</td>
			<td nowrap="" style="border: 1px solid #555;">$requestStuMsg</td>
			<td nowrap="" style="border: 1px solid #555;">$courseInstructor</td>
			<td nowrap="" style="border: 1px solid #555;">
			Instructor Message:<input type="text" name="message_prof[]" style="border: 1px solid #555;">
			</td>
			<td nowrap="" style="border: 1px solid #555;">
			<select name="answer[]">
			  <option value="Approved">Approved</option>
			  <option value="Rejected">Rejected</option>
			</select>		
			</td>
		   
		</tr>
EOF;
		}
		
	}
	
	
	echo "</tbody></table>";
	echo '<tr><input type="submit" value="Done!"></tr>';
	
}







?>
</body>
</html>