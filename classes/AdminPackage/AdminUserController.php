<?php
/* include_once 'Courses.php';
include_once 'RequestPackage/Request.php';
include_once 'ProfessorPackage/Professor.php';
include_once 'StudentPackage/Student.php';
include_once 'User.php';
include_once 'connector.php';
include_once 'Admin.php'; */

include_once 'AdminUserDB.php';
include_once '../User.php';

class AdminUserController extends User
{	
	public function AddUser($User, $personalInfo = null, $grad_year = null, $major = null)
	{
		$adminUDB = new AdminUserDB;
		$adminUDB->AddUser($User); // in every case User is added to the user table
		
		if ($User->userType == null)
		{
			//Do nothing special
		}
		elseif ($User->userType ==  'P')
		{
			$adminUDB->AddProfessor($User, $personalInfo); 
			// after all the checks are done sends the user AdminUserDB to be added to Professor table and PersonalInfo table
		}
		elseif ($User->userType ==  'S')
		{
			$adminUDB->AddStudent($User, $personalInfo, $grad_year, $major);
			// after all the checks are done sends the user AdminUserDB to be added to Students table and PersonalInfo table
		}
	}
	
	public function DeleteUser($User)
	{
		$AdminUserDb;
		//DB li bişiler çözcez
	}
	
	public function ModifyUserInfo()
	{
		$AdminUserDb;
		//Nasıl yapcaımızı konuşmamız lazım.
	}
	
	public function GetUserInfo()
	{
		function returnBack ()
		{
			echo "<br>Click Back to return the previous page";
		
			echo "<html>";
			echo "<form action = \"getUser.php\">";
			echo "<tr><td> <INPUT TYPE = \"Submit\" Name = \"SubmitButton\" VALUE =\"Back\"> </td></tr>";
			echo "</form>";
			echo "<tr></tr>";
			echo "<form action = \"../../../homePage.html\">";
			echo "<tr><td> <INPUT TYPE = \"Submit\" Name = \"SubmitButton\" VALUE =\"Home Page\"></td></tr>";
			echo "</form>";
			echo "</html>";
		}

		
		if (!empty ($_POST['username'])) //check if the "username" blank is filled, if not gives an error
		{
			$username = $_POST['username']; //gets the username
			$type = $_POST['formType'];
			
			// query the database for the recently taken username
			// if such an user already exists, further functions are not allowed.
			DBFunctions::SetRemoteConnection();
			$query = "SELECT * FROM schedule.user where schedule.user.username = \"$username\"";
			$result = mysql_query($query);
			$numrows = mysql_num_rows($result); 
			$row = mysql_fetch_array($result);
						
			if ($result) 
			{
				if ($numrows == 0) 
				{
					echo "User with the username, ".$username.", does not exist in the database.";
					returnBack();
				}
				else
				{
					if ($type != $row['type'])
					{
						echo "ERROR!!! ".$username." does not match with the type, (".$type.") you have entered.";
						returnBack();
					}
					else
					{
						$adminUDB = new AdminUserDB;
						$adminUDB->GetUserInfo($username, $type);
					}					
				}
			}	
		}
		else{
			
			echo "ERROR!!! USERNAME is not entered.";
			returnBack ();
		}
		
		DBFunctions::CloseConnection();

	}		
}
?>