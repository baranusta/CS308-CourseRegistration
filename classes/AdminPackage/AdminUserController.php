<?php

/* include_once 'Courses.php';

set_include_path(get_include_path() . PATH_SEPARATOR . 'C:\xampp\htdocs\CS308-CourseRegistration\classes');
//include_path=".;C:\xampp\htdocs\CS308-CourseRegistration\classes";
include_once 'Courses.php';

include_once 'RequestPackage/Request.php';
include_once 'ProfessorPackage/Professor.php';
include_once 'StudentPackage/Student.php';
include_once 'User.php';
include_once 'connector.php';
include_once 'Admin.php'; */

include_once 'AdminUserDB.php';
include_once '../User.php';

class AdminUserController
{	
	public function AddUser($User, $personalInfo = null, $grad_year = null, $major = null)
	{
		$adminUDB = new AdminUserDB;
		$adminUDB->AddUser($User); // in every case User is added to the user table
		
		if ($User->getUserType() == null)
		{
			//Do nothing special
		}
		elseif ($User->getUserType() ==  'P')
		{
			$adminUDB->AddProfessor($User, $personalInfo); 
			// after all the checks are done sends the user AdminUserDB to be added to Professor table and PersonalInfo table
		}
		elseif ($User->getUserType() ==  'S')
		{
			$adminUDB->AddStudent($User, $personalInfo, $grad_year, $major);
			// after all the checks are done sends the user AdminUserDB to be added to Students table and PersonalInfo table
		}
	}
	
	
	
	public function DeleteUser($username)
	{
		$AdminUserDb;

		
		
		
		
	}
	
	public function ModifyUserInfo()
	{
		$AdminUserDb = new AdminUserDB;
	}
	
	
}
?>