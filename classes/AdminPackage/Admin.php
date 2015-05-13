<?php
set_include_path(get_include_path() . PATH_SEPARATOR . 'C:\wamp\www\CS308-CourseRegistration\classes\AdminPackage');
//include_path=".;C:\xampp\htdocs\CS308-CourseRegistration\classes";
//include_once 'Courses.php';
//include_once 'RequestPackage/Request.php';
include_once '../ProfessorPackage/Professor.php';
include_once '../StudentPackage/Student.php';
include_once '../PersonalInfoPackage/PersonalInfo.php';
include_once '../User.php';
include_once '../DBFunctions.php';
include_once 'AdminUserController.php';

class Admin extends User
{	
	function returnBack ()
	{
		echo "<br>Click Back to return the previous page";
	
		echo "<html>";
		echo "<form action = \"addUser.php\">";
		echo "<tr><td> <INPUT TYPE = \"Submit\" Name = \"SubmitButton\" VALUE =\"Back\"> </td></tr>";
		echo "</form>";
		echo "</html>";
	}


	public function AddUser()
	{
		if (!empty ($_POST['username'])) //check if the "username" blank is filled, if not gives an error
		{
			$username = $_POST['username']; //gets the username
			
			// query the database for the recently taken username
			// if such an user already exists, further functions are not allowed.
			DBFunctions::SetRemoteConnection();
			$query = "SELECT username FROM schedule.user where schedule.user.username = \"$username\"";
			$result = mysql_query($query);
			$numrows = mysql_num_rows($result); 
			DBFunctions::CloseConnection();
			
			if ($result) 
			{
				if ($numrows != 0) 
				{
					echo "User with the username, ".$username.", already exists";
					returnBack();
				}
				else 
				// if there is no such user takes all the general personal info
				// then based on the type of the user to be added (Admin/Stu/Prof), records the type based relevant info
				{			
					$formType = $_POST['formType'];
					$password = "su1234";
					$name = $_POST['name'];
					$lastname = $_POST['lastname'];
					$address = $_POST['address'];
					$enterYear = $_POST['yearEntered'];
					$telNO = $_POST['telNO'];
					$faculty = $_POST['faculty'];
					
					$user = new User ($username, $password, $formType); //create user
					$personalInfo = new PersonalInfo ($name, $lastname, $enterYear, $address, null, $telNO, $faculty); //create the personal info of the users (only for stu and prof)
					$adminUController = new AdminUserController;
					
					if ($formType == 'A')
					{
						$adminUController->AddUser($user, null, null);
					}
					elseif ($formType == 'P')
					{
						$prof = new Professor ($personalInfo);
						$adminUController->AddUser($user, $personalInfo);
					} 
					elseif ($formType == 'S')
					{
						$major = $_POST['major'];
						$gradYear = $_POST['gradYear'];
						
						$stu = new Student ($personalInfo, $gradYear, $major);
						$adminUController->AddUser($user, $personalInfo, $gradYear, $major);
					}
					
					
				}
			} 
		}
		
		else{
			
			echo "ERROR!!! USERNAME is not entered.";
			returnBack ();
		}
		
	}
	
	public function DeleteUser($User)
	{
		//DB li bişiler çözcez
	}
	
	public function CreateCourse($Course)
	{
		$AdminCourseController;
		//DB li bişiler çözcez
	}
	
	public function ModifyCourse($Course)
	{
		$AdminCourseController;
	}
	
	public function DeleteCourse($Course)
	{
		$AdminCourseController;
		//DB li bişiler çözcez
	}
	
	public function ModifyUserInfo()
	{
		//Nasıl yapcaımızı konuşmamız lazım.
	}
	
	public function GetUserInfo()
	{
		$AdminUController = new AdminUserController;
		$AdminUController->GetUserInfo();				
	}
}
?>