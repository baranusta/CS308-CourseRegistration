<?php
/*
include_once 'RequestPackage/Request.php';
include_once 'ProfessorPackage/Professor.php';
include_once 'StudentPackage/Student.php';
include_once 'User.php';
*/

include_once 'DBFunctions.php';

class AdminUserDB
{	
	public static $lastid = 0;
	
	public function AddUser($User)
	{
		function returnBack3 ()
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
		
		$sql = "INSERT INTO `schedule`.`user` (`username`, `password`, `type`) VALUES ('".$User->getUsername()."', 'su1234', '".$User->getUserType()."')";
		$resultInsert = mysql_query ($sql);
		
		$id = "SELECT * FROM `schedule`.`user` where schedule.user.username = \"".$User->getUsername()."\"";
		$result = mysql_query ($id);
		$row = mysql_fetch_assoc($result);
		self::$lastid = $row['user_id'];
		
		if ($resultInsert)
			echo "<br>User with the username, ".$User->getUsername().", is inserted to the User table.";
		
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
			echo "<br>Professor with the username, ".$User->getUsername().", is added to the Professor table.";
				
			$sql2 = "INSERT INTO `schedule`.`personalinfo` (`user_id`, `name`, `surname`, `address`, `telephone`, `faculty`) 
			VALUES ('".self::$lastid."', '".$personalInfo->getName()."', '".$personalInfo->getLastName()."', '".$personalInfo->getAddress()."', '".$personalInfo->getTelephoneNum()."', '".$personalInfo->getFaculty()."')";
			$result2 = mysql_query($sql2);
			
			if($result2)
			{
				echo "<br>Personal information of the professor, ".$personalInfo->getName()." ".$personalInfo->getLastName().", is added to the PersonalInfo table.";
			}
			else
				echo "<br>Failed!!! Couldn't add the Personal Info of ".$personalInfo->getName()." ".$personalInfo->getLastName();
		}
		else
		{
			echo "Failed!!!";
			
		}
		
		DBFunctions::CloseConnection();
		returnBack3();
	}
	
	public function AddStudent($User, $personalInfo, $gradYear, $major)
	{
		DBFunctions::SetRemoteConnection();
				
		$sql = "INSERT INTO `schedule`.`student` (`stu_id`, `major`, `grad_year`) 
		VALUES ('".self::$lastid."', '".$major."', '".$gradYear."');";
		$result = mysql_query($sql);
		
		if ($result)
		{
			echo "<br>Student with the username, ".$User->getUsername()." is added to the Students table.";
				
			$sql2 = "INSERT INTO `schedule`.`personalinfo` (`user_id`, `name`, `surname`, `address`, `telephone`, `faculty`) 
			VALUES ('".self::$lastid."', '".$personalInfo->getName()."', '".$personalInfo->getLastName()."', '".$personalInfo->getAddress()."', '".$personalInfo->getTelephoneNum()."', '".$personalInfo->getFaculty()."')";
			$result2 = mysql_query($sql2);
			
			if($result2)
			{
				echo "<br>Personal information of the student, ".$personalInfo->getName()." ".$personalInfo->getLastName().", is added to the PersonalInfo table.";
			}
			else
				echo "<br>Failed!!! Couldn't add the Personal Info of ".$personalInfo->getName()." ".$personalInfo->getLastName();
		}
		else
			echo "Failed!!!";
		
		DBFunctions::CloseConnection();
		returnBack3();
	}	


	public function DeleteUser($User)
	{
		//DB li bişiler çözcez
	}
	
	public function ModifyUserInfo()
	{	
		DBFunctions::SetRemoteConnection();
		
		$uid = $_POST['uid'];
		$uname = $_POST['uname'];
		$name = $_POST['name'];
		$surname = $_POST['lastname'];
		$address = $_POST['address'];
		$telNO = $_POST['telNO'];
		$faculty = $_POST['faculty'];
		$major = $_POST['major'];
		$gradYear = $_POST['gradYear'];
		
		
		$find = "SELECT * FROM schedule.user where schedule.user.user_id = \"$uid\"";
		$soln = mysql_query($find);
		$line = mysql_fetch_assoc($soln);
		
		$updateQuery = "UPDATE `schedule`.`personalinfo` SET `name`='".$name."', `surname`='".$surname."', `address`='".$address."',
		`telephone`='".$telNO."', `faculty`='".$faculty."' WHERE `user_id`='".$uid."';";
		$result4 = mysql_query($updateQuery);
		DBFunctions::CloseConnection();
		
		if ($line['type'] == 'S') // if the updated user is a student update its major and grad. year values as well
		{
			DBFunctions::SetRemoteConnection();
			$updateQuery2 = "UPDATE `schedule`.`student` SET `major`='".$major."', `grad_year`='".$gradYear."' WHERE `stu_id`='".$uid."'";
			$result5 = mysql_query($updateQuery2);
			DBFunctions::CloseConnection();			
		}
		
		echo "User's info is updated successfuly<br><br>";
	}
	
	public function GetUserInfo($username, $formType)
	{
		function returnBack2 ()
		{
			echo "<html>";
			echo "<form action = \"getUser.php\">";
			echo "<tr><td> <INPUT TYPE = \"Submit\" Name = \"SubmitButton\" VALUE =\"Get another user info\"> </td></tr>";
			echo "</form>";
			echo "<form action = \"../../../homePage.html\">";
			echo "<tr><td> <INPUT TYPE = \"Submit\" Name = \"SubmitButton\" VALUE =\"Home Page\"></td></tr>";
			echo "</form>";
			echo "</html>";
		}
		
		if($formType == 'A')
		{
			DBFunctions::SetRemoteConnection();
			$query = "SELECT * FROM schedule.user WHERE user.username = \"$username\";";
			$result = mysql_query($query);
			$row = mysql_fetch_array($result);
			DBFunctions::CloseConnection(); 
			
			echo "<br><strong>Personal Information: </strong></br>";
			echo "<br>User ID: ".$row['user_id'];
			echo "<br>Username: ".$username;
			echo "<br>";
			returnBack2();
		}
		else
		{
			DBFunctions::SetRemoteConnection();
			$query = "SELECT * FROM schedule.user, schedule.personalinfo WHERE user.username = \"$username\" and user.user_id = personalinfo.user_id;";
			$result = mysql_query($query);
			$row = mysql_fetch_array($result);
			DBFunctions::CloseConnection(); 
			
			$id = $row['user_id'];
			$Name = $row['name'];
			$Lastname = $row['surname'];
			$address = $row['address'];
			$telNO = $row['telephone'];
			$fac = $row['faculty'];
			
			echo "<br><strong>Personal Information: </strong></br>";
			echo "<br>User ID: ".$id;
			echo "<br>Username: ".$username;
			echo "<br>Name: ".$Name;
			echo "<br>Lastname: ".$Lastname;
			echo "<br>Address: ".$address;
			echo "<br>Telephone Number: ".$telNO;
			echo "<br>Faculty: ".$fac;
			
			if ($formType == 'S')
			{
				DBFunctions::SetRemoteConnection();
				$query = "SELECT * FROM `schedule`.`student`, schedule.user WHERE user.username = \"$username\" and student.stu_id = user.user_id;";
				$result = mysql_query ($query);
				$row2 = mysql_fetch_assoc($result);
				DBFunctions::CloseConnection();
				
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
				DBFunctions::SetRemoteConnection();
				$query = "SELECT * FROM `schedule`.`professor`, schedule.user WHERE user.username = \"$username\" and professor.prof_id = user.user_id;";
				$result = mysql_query ($query);
				$row2 = mysql_fetch_assoc($result);
				DBFunctions::CloseConnection();
				
				$reg_courses = $row2['registered_courses'];
				$requests = $row2['request'];
				
				echo "<br>Professor's Registered Courses: ".$reg_courses;
				echo "<br>Professor's Requests: ".$requests;	
				
			}
			
			returnBack2();
		}
	}
}
?>