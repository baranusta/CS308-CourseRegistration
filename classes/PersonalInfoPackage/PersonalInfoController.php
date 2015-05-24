<?php
class PersonalInfoController
{
	public function GetInfos()
	{
		$PersonalInfo;
	}
		public function GetPersonalInfoById($id)
	{
		$sql = "SELECT * FROM schedule.personalinfo WHERE user_id ='".$id."';";
		DBFunctions::SetRemoteConnection();
		$resultSet = mysql_query($sql);
		DBFunctions::CloseConnection();
		$user = mysql_fetch_array($resultSet);
		return $user;
		
	}
	public function setAdress($adress)
	{
		$PersonalInfo;
	}
	
	public function setPhoneNum($Num)
	{
		$PersonalInfo;
	}
}
?>