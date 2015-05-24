<?php
class ProfessorController
{
	//it takes two parameters as professor name and lastname and 
	//checks if such user exists in database, if so returns prof id
	//otherwise returns -1
	public function ControlProfessor($profName, $profLastname)
	{
		DBFunctions::SetRemoteConnection();
		$allPeople = array();
		$sql="SELECT pro.prof_id From schedule.personalinfo pi, schedule.professor 
				pro where pi.user_id = pro.prof_id AND pi.name ='".$profName."' AND pi.surname='".$profLastname."';";
		$result = mysql_query($sql);
		$profID;
		if ($row = mysql_fetch_assoc($result)) {
			//echo $row['prof_id'];
			$profID =$row['prof_id'];
			DBFunctions::CloseConnection();
			return $profID;
		}
		else
		{
			DBFunctions::CloseConnection();
			return -1;
		}
		
	}
	public function GetCourses($prof)
	{
		$prof_id = $prof->getID();
		$term = $prof->getCurrentTerm();
		$sql = "SELECT p.courses FROM schedule.professor p WHERE prof_id = '".$prof_id."' ";
		DBFunctions::SetRemoteConnection();
		$result = mysql_query($sql);
		DBFunctions::CloseConnection();
		if ($row = mysql_fetch_array($result)) {
			echo "<br><br>";		
			$arrmodified = json_decode($row[0], true);
			return $arrmodified[$term];
		}
		else
			return null;
	}
	public function ReceiveRequest($req)
	{
		//Buralarý nasý yapsak bilemedim. Sýkýntýlar mevcudðð.
	}
	
}
?>