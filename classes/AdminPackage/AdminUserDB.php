<?php
/*
include_once 'RequestPackage/Request.php';
include_once 'ProfessorPackage/Professor.php';
include_once 'StudentPackage/Student.php';
include_once 'User.php';
*/

include_once '../DBFunctions.php';

class AdminUserDB extends PersonalInfo
{	
	public static $lastid = 0;
	
	public function AddUser($User)
	{
		function returnBack ()
		{
			echo "<html>";
			echo "<form action = \"addUser.php\">";
			echo "<tr><td> <INPUT TYPE = \"Submit\" Name = \"SubmitButton\" VALUE =\"Add another user\"> </td></tr>";
			echo "</form>";
			echo "<form action = \"../../../homePage.html\">";
			echo "<tr><td> <INPUT TYPE = \"Submit\" Name = \"SubmitButton\" VALUE =\"Home Page\"></td></tr>";
			echo "</form>";
			echo "</html>";
		}
		
		DBFunctions::SetRemoteConnection();
		
		$sql = "INSERT INTO `schedule`.`user` (`username`, `password`, `type`) VALUES ('".$User->username."', 'su1234', '".$User->userType."')";
		$resultInsert = mysql_query ($sql);
		
		$id = "SELECT * FROM `schedule`.`user` where schedule.user.username = \"".$User->username."\"";
		$result = mysql_query ($id);
		$row = mysql_fetch_assoc($result);
		self::$lastid = $row['user_id'];
		
		if ($resultInsert)
			echo "<br>User with the username, ".$User->username.", is inserted to the User table.";
		
		else
		{
			echo "Failed";
			exit;
		} 
		
		DBFunctions::CloseConnection();
	}
	
	public function AddProfessor($User, $personalInfo)
	{
		DBFunctions::SetRemoteConnection();
		
		$sql = "INSERT INTO `schedule`.`professor` (`prof_id`) VALUES ('".self::$lastid."')";
		$result = mysql_query($sql);
		
		if ($result)
		{
			echo "<br>Professor with the username, ".$User->username.", is added to the Professor table.";
				
			$sql2 = "INSERT INTO `schedule`.`personalinfo` (`user_id`, `name`, `surname`, `address`, `telephone`, `faculty`) 
			VALUES ('".self::$lastid."', '".$personalInfo->Name."', '".$personalInfo->LastName."', '".$personalInfo->Address."', '".$personalInfo->TelephoneNum."', '".$personalInfo->Faculty."')";
			$result2 = mysql_query($sql2);
			
			if($result2)
			{
				echo "<br>Personal information of the professor, ".$personalInfo->Name." ".$personalInfo->LastName.", is added to the PersonalInfo table.";
			}
			else
				echo "<br>Failed!!! Couldn't add the Personal Info of ".$personalInfo->Name." ".$personalInfo->LastName;
		}
		else
		{
			echo "Failed!!!";
			
		}
		
		DBFunctions::CloseConnection();
		returnBack();
	}
	
	public function AddStudent($User, $personalInfo, $gradYear, $major)
	{
		DBFunctions::SetRemoteConnection();
				
		$sql = "INSERT INTO `schedule`.`student` (`stu_id`, `major`, `grad_year`) 
		VALUES ('".self::$lastid."', '".$major."', '".$gradYear."');";
		$result = mysql_query($sql);
		
		if ($result)
		{
			echo "<br>Student with the username, ".$User->username." is added to the Students table.";
				
			$sql2 = "INSERT INTO `schedule`.`personalinfo` (`user_id`, `name`, `surname`, `address`, `telephone`, `faculty`) 
			VALUES ('".self::$lastid."', '".$personalInfo->Name."', '".$personalInfo->LastName."', '".$personalInfo->Address."', '".$personalInfo->TelephoneNum."', '".$personalInfo->Faculty."')";
			$result2 = mysql_query($sql2);
			
			if($result2)
			{
				echo "<br>Personal information of the student, ".$personalInfo->Name." ".$personalInfo->LastName.", is added to the PersonalInfo table.";
			}
			else
				echo "<br>Failed!!! Couldn't add the Personal Info of ".$personalInfo->Name." ".$personalInfo->LastName;
		}
		else
			echo "Failed!!!";
		
		DBFunctions::CloseConnection();
		returnBack();
	}	


	public function DeleteUser($User)
	{
		//DB li bişiler çözcez
	}
	
	public function ModifyUserInfo()
	{
		//Nasıl yapcaımızı konuşmamız lazım.
	}
	
	public function GetUserInfo($username, $formType)
	{
		DBFunctions::SetRemoteConnection();
		$query = "SELECT * FROM schedule.user, schedule.personalinfo WHERE user.username = \"$username\" and user.user_id = personalinfo.user_id;";
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		
		/* function returnBack ()
		{
			echo "<html>";
			echo "<form action = \"getUser.php\">";
			echo "<tr><td> <INPUT TYPE = \"Submit\" Name = \"SubmitButton\" VALUE =\"Get another user info\"> </td></tr>";
			echo "</form>";
			echo "<form action = \"../../../homePage.html\">";
			echo "<tr><td> <INPUT TYPE = \"Submit\" Name = \"SubmitButton\" VALUE =\"Home Page\"></td></tr>";
			echo "</form>";
			echo "</html>";
		} */
		
		$id = $row['user_id'];
		$Name = $row['name'];
		$Lastname = $row['surname'];
		$address = $row['address'];
		$telNO = $row['telephone'];
		$fac = $row['faculty'];
		
		echo "<br>Student ID: ".$id;
		echo "<br>Student Name: ".$Name;
		echo "<br>Student Lastname: ".$Lastname;
		echo "<br>Student Address: ".$address;
		echo "<br>Student Telephone Number: ".$telNO;
		echo "<br>Student Faculty: ".$fac;
		
		if ($formType == 'S')
		{
			$query = "SELECT * FROM `schedule`.`student`, schedule.user WHERE user.username = \"$username\" and student.stu_id = user.user_id;";
			$result = mysql_query ($query);
			$row2 = mysql_fetch_assoc($result);
			
			$major = $row2['major'];
			$gradYear = $row2['grad_year'];
			$reg_courses = $row2['registered_courses'];
			$requests = $row2['request'];
			
			echo "<br>Student Major: ".$major;
			echo "<br>Student Graduation Year: ".$gradYear;
			echo "<br>Student Registered Courses: ".$reg_courses;
			echo "<br>Student Requests: ".$requests;
		}
		elseif($formType == 'P')
		{
			$query = "SELECT * FROM `schedule`.`professor`, schedule.user WHERE user.username = \"$username\" and professor.prof_id = user.user_id;";
			$result = mysql_query ($query);
			$row2 = mysql_fetch_assoc($result);
			
			
			$reg_courses = $row2['registered_courses'];
			$requests = $row2['request'];
			
			echo "<br>Student Registered Courses: ".$reg_courses;
			echo "<br>Student Requests: ".$requests;	
		}
		DBFunctions::CloseConnection();
		returnBack(); 
	}
}
?>