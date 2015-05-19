<?php
include_once 'ProfessorPackage/Professor.php';
include_once 'StudentPackage/Student.php';
include_once 'RequestController.php';

class Request
{	
	/* private $reqId;
	private $term;
	private $stuId;
	private $profId;
	private $cnr;
	private $reqType;
	private $answer;
	private $profMsg;
	private $stuMsg;

	
	//public function __construct($Message, $Term, $CourseId, $RequestType, $StudentID, $ProfessorID)
	public function __construct($term, $profId, $stuId, $cnr, $reqType, $answer="Pending...", $profMsg=null, $stuMsg=null)
	{
		$term	= $term;//
		$stuId = $stuId;//
		$profId = $profId;//
		$cnr = $cnr;//
		$reqType = $reqType;//
		$answer = $answer;//
		$profMsg = $profMsg;//
		$stuMsg = $stuMsg;//
	} */
	
	
	public function stuAddRequest($term, $profId, $stuId, $cnr, $reqType, $stuMsg=null)
	{
		
		
		$answer="Pending...";
		$controlRequest = new RequestController;
		
		if($controlRequest->checkRequest($stuId,$profId, $term, $cnr))
		{
			
			DBFunctions::SetRemoteConnection();
			$query = "INSERT INTO `schedule`.`request` (`term`, `prof_id`, `stu_id`, `cnr`, `type_request`, `answer`, `message_stu`) VALUES ('$term', '$profId', '$stuId', '$cnr', '$reqType', '$answer', '$stuMsg');";
			mysql_query($query);
			$reqId = mysql_insert_id();

			$this->addRequestToStu($stuId, $reqId);
			$this->addRequestToProf($profId, $reqId);
			DBFunctions::CloseConnection();
		
		
		}
		else
		{
			return false;
		}
		
	}
	
	
	//can apply to student too
	public function profGetListRequest($prof_id)
	{
		DBFunctions::SetRemoteConnection();
		$query = "SELECT * FROM schedule.professor WHERE prof_id = '$prof_id';";
		$row = mysql_fetch_array(mysql_query($query));
		
		$requestArray = json_decode($row['requests']);
		
		$requestInformation = array();
		
		foreach ($requestArray as &$requestId)
		{
			$query = "SELECT * FROM schedule.request WHERE request_id = '$requestId';";
			$row = mysql_fetch_array(mysql_query($query));
			$requestInformation[$requestId] = $row;
		}
		DBFunctions::CloseConnection();
		return $requestInformation;
		
	}
	
	
	public function stuGetListRequest($stu_id)
	{
		DBFunctions::SetRemoteConnection();
		$query = "SELECT * FROM schedule.student WHERE stu_id = '$stu_id';";
		$row = mysql_fetch_array(mysql_query($query));
		
		$requestArray = json_decode($row['request']);
		
		$requestInformation = array();
		
		foreach ($requestArray as &$requestId)
		{
			$query = "SELECT * FROM schedule.request WHERE request_id = '$requestId';";
			$row = mysql_fetch_array(mysql_query($query));
			$requestInformation[$requestId] = $row;
		}
		DBFunctions::CloseConnection();
		return $requestInformation;
		
	}
	
	
	public function profResponseRequest($reqId, $answer, $profMsg)
	{
		//all of the inputs might come as array
		DBFunctions::SetRemoteConnection();
		
		for($i = 0; $i<sizeof($reqId) ; $i++)
		{
			$query = "UPDATE `schedule`.`request` SET `answer`='$answer[$i]', `message_prof`='$profMsg[$i]' WHERE `request_id`='$reqId[$i]';";
			mysql_query($query);
		}
		DBFunctions::CloseConnection();
		
	}
	
	
	private function addRequestToStu($stuId, $reqId)
	{
		$query= "SELECT * FROM schedule.student WHERE stu_id = '$stuId';";
		$resultSet = mysql_query($query);
		$row = mysql_fetch_array($resultSet);
		
		$requestArray = json_decode($row['request'], true);

		//if the value is empty
		$requestArray = $row['request'];
		if($requestArray  == NULL)
		{
			$requestArray = array();
		}

		//add value to the array
		array_push($requestArray, $reqId);
		$requestArray = json_encode($requestArray, JSON_FORCE_OBJECT);
		
		//update
		$query = "UPDATE `schedule`.`student` SET `request`='$requestArray' WHERE `stu_id`='$stuId';";
		mysql_query($query);
		
	}
	
	private function addRequestToProf($profId, $reqId)
	{
		
		$query= "SELECT * FROM schedule.professor WHERE prof_id = '$profId';";
		$resultSet = mysql_query($query);
		$row = mysql_fetch_array($resultSet);

		$requestArray = json_encode($row['requests'], true);

		$requestArray = $row['requests'];

		//if the value is empty
		if($requestArray  == NULL)
		{
			$requestArray = array();
		}
		

		//add value to the array
		array_push($requestArray, $reqId);
		$requestArray = json_encode($requestArray, JSON_FORCE_OBJECT);

		//update
		$query = "UPDATE `schedule`.`professor` SET `requests`='$requestArray' WHERE `prof_id`='$profId';";
		mysql_query($query);
		
	}
	
	
	
	
	
	

	
}
?>