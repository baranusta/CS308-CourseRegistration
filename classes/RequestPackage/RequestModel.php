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
		echo "ERR1<br>";
		
		$answer="Pending...";
		$controlRequest = new RequestController;
		
		if($controlRequest->checkRequest($stuId,$profId, $term, $cnr))
		{
			echo "ERR2<br>";
			DBFunctions::SetRemoteConnection();
			$query = "INSERT INTO `schedule`.`request` (`term`, `prof_id`, `stu_id`, `cnr`, `type_request`, `answer`, `message_stu`) VALUES ('$term', '$profId', '$stuId', '$cnr', '$reqType', '$answer', '$stuMsg');";
			mysql_query($query);
			$reqId = array(mysql_insert_id());

			$this->addRequestToStu($stuId, $reqId);
			$this->addRequestToProf($profId, $reqId);
			DBFunctions::CloseConnection();
		
		
		}
		else
		{
			return false;
		}
		
	}
	
	public function profResponseRequest($reqId, $answer, $profMsg)
	{
		
		
	}
	
	
	private function addRequestToStu($stuId, $reqId)
	{
		$query= "SELECT * FROM schedule.student WHERE stu_id = '$stuId';";
		$resultSet = mysql_query($query);
		$row = mysql_fetch_array($resultSet);
		
		$requestArray = json_decode($row['request'], true);
echo "<br>AFTER<br>";
		var_dump($row);
		
		$requestArray = $row['request'];
		if($requestArray  == NULL)
		{
			$requestArray = array();
		}
		var_dump($reqId);

		
		array_push($requestArray, $reqId);
		var_dump($requestArray);
		
		$requestArray = json_encode($requestArray);
		var_dump($requestArray);
		

		
		$query = "UPDATE `schedule`.`student` SET `request`='$requestArray' WHERE `stu_id`='$stuId';";
		
		mysql_query($query);
		
	}
	
	private function addRequestToProf($profId, $reqId)
	{
		$query= "SELECT * FROM schedule.professor WHERE prof_id = '$profId';";
		$resultSet = mysql_query($query);
		$row = mysql_fetch_array($resultSet);

		$requestArray = json_encode($row['requests'], true);

		echo "Prof-requests".$row['requests'];
		echo "<br>";
		echo "Here:";
		var_dump($requestArray);
		echo "<br>";
		//$requestArray = $row['requests'];
		$requestArray = $row['requests'];
		echo "<br>";
		echo "Here:";
		var_dump($requestArray);
		if($requestArray  == NULL)
		{
			$requestArray = array();
		}
		
		$reqId = (int) $reqId;
		
		array_push($requestArray, $reqId);
		$requestArray = json_encode($requestArray);
		echo "AFTER<br>";
		var_dump($requestArray);
		
		$query = "UPDATE `schedule`.`professor` SET `requests`='$requestArray' WHERE `prof_id`='$profId';";
		mysql_query($query);
		
	}
	
	
	
	
	
	

	
}
?>