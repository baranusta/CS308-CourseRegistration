<?php
set_include_path(get_include_path() . PATH_SEPARATOR . 'C:\xampp\htdocs\CS308-CourseRegistration\classes');
//include_path=".;C:\xampp\htdocs\CS308-CourseRegistration\classes";
include_once 'Courses.php';
include_once 'RequestPackage/Request.php';
include_once 'ProfessorPackage/Professor.php';
include_once 'StudentPackage/Student.php';
include_once 'User.php';
include_once 'DBFunctions.php';


class AdminUserController
{	
	SetRemoteConnection();

	public function AddUser($username, $password, $type, $name, $surname)
	{
		if(CheckUserName($username) == 1)//user exist
		{
			
		}
		else//user not exists
		{
			
		}
		$AdminUserDb;
		//DB li bişiler çözcez
	}
	
	public function CheckUserName($username)
	{
		SetRemoteConnection();
		$resultSet = mysql_query("SELECT * FROM user WHERE username = '$username';");
		
		$resultSetSize = 0; //initial 0 rows
		
		while( mysql_fetch_assoc($resultSet))
		{
			$resultSetSize++;//increase size
		}
		
		return $resultSetSize; // the username found
			
		
		
	
	}
	
	
	
	public function DeleteUser($username)
	{
		$AdminUserDb;

		
		
		
		
	}
	
	public function ModifyUserInfo()
	{
		$AdminUserDb;
		//Nasıl yapcaımızı konuşmamız lazım.
	}
	
	public function GetUserInfo()
	{
		$AdminUserDb;
	}
}
?>