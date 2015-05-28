<?php
set_include_path(get_include_path() . PATH_SEPARATOR . 'C:\xampp\htdocs\CS308-CourseRegistration\classes');
include_once 'DBFunctions.php';

class RequestController
{
	public function checkRequest($stuId,$profId, $term, $cnr)
	{
		//echo "ERR3<br>";
		
		if($this->profInfoCheck($profId, $term, $cnr) && $this->isStudentExists($stuId))
		{
			//echo "ERR4<br>";
			return true;
		}
		
		return false;
	}
	
	private function  profInfoCheck($profId, $term, $cnr)
	{
		DBFunctions::SetRemoteConnection();
		$query = "SELECT * FROM schedule.professor WHERE prof_id = '$profId';";
		$resultSet = mysql_query($query);
		
		if(mysql_num_rows($resultSet) == 0)//there must be a result
		{
			DBFunctions::CloseConnection();
			return false;
		}
		$row = mysql_fetch_array($resultSet);
		$profCourses = json_decode($row['courses'], true);
		
		//var_dump($profCourses);
		
		if($this->isCnrExistsInTerm($profCourses, $term, $cnr))//correct entries
		{
			
	 		$profRequestArray;
			$profRequestsString = $row['requests'];
			
		/* 	if(strlen($profRequestsString) == 0)//if there were no request
			{
				$profRequestArray = array();//new array
				$jsonArray =  json_encode($profRequestArray, true);
				$query = "UPDATE `schedule`.`professor` SET `requests`=$jsonArray WHERE `prof_id`='$row[2]';";
				mysql_query($query);
			} */
/* 			else
			{
				$profRequestArray = json_decode($row['requests'], true);
			} */
			DBFunctions::CloseConnection();
			return true;
		}
		else
		{
			DBFunctions::CloseConnection();
			return false;
		}
		

		
	}
	
	private function  isStudentExists($stuId)
	{
		DBFunctions::SetRemoteConnection();
		$query = "SELECT * FROM schedule.student WHERE stu_id = '$stuId';";
		$resultSet = mysql_query($query);
		
		if(mysql_num_rows($resultSet) == 0)
		{
			return false;
		}
		$row = mysql_fetch_array($resultSet);
		
		$stuRequestArray;
		$stuRequestsString = $row['request'];
		
/* 		if(strlen($stuRequestsString) == 0 || $stuRequestsString == "null")//if there were no requests
		{
			$stuRequestArray = array();//new array
			$jsonArray =  json_encode($stuRequestArray, true);
			$query = "UPDATE `schedule`.`student` SET `request`=$jsonArray WHERE `stu_id`='$row[0]';";
			mysql_query($query);
		} */
/* 		else
		{
			$profRequestArray = json_decode($row['requests'], true);
		} */
		DBFunctions::CloseConnection();
		return true;
		

	}
	
	
	private function isCnrExistsInTerm($array, $term, $cnr)
	{
		/* echo "TERM:".$term."<br>";
		echo "CNR:".$cnr."<br>";
		var_dump($array); */
		if(in_array( $cnr, $array[$term]))
		{
			//echo "ERR12";
			return true;
		}
		else
		{
			//echo "ERR13";
			return false;
		}
		
	}
}
?>