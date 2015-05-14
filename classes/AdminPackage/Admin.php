<?php
set_include_path(get_include_path() . PATH_SEPARATOR . 'C:\xampp\htdocs\CS308-CourseRegistration\classes');

//include_once 'Courses.php';
//include_once 'RequestPackage\Request.php';
//include_once 'ProfessorPackage\Professor.php';
//include_once 'StudentPackage\Student.php';
include_once 'User.php';
include_once 'DBFunctions.php';

class Admin extends User
{	
	


	
	public function AddUser($User)
	{
		$AdminController;
		//DB li bişiler çözcez
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
		//need to delete course from student also
	}
	
	public function ModifyUserInfo()
	{
		//Nasıl yapcaımızı konuşmamız lazım.
	}
	
	public function deleteCourseCourse($courseCNR, $term)
	{
		$query = "DELETE FROM schedule.courses$term WHERE cnr = '$courseCNR';";
		$resultSet = mysql_query($query);
	}
	
	public function deleteCourseStudents($courseCNR, $term)
	{
		$con = new DBFunctions;
		$con->SetRemoteConnection();
		
		$query = "SELECT * FROM schedule.student;";//select all students
		$resultSet = mysql_query($query);
		
		
		while($student = mysql_fetch_array($resultSet))//row by row
		{
			$registeredCourseArray = $student['registered_courses'];//get json of courses
			$registeredCourseArray = json_decode($registeredCourseArray, true);

			if(in_array($courseCNR, $registeredCourseArray[(int)$term]))//if array has the cnr in wanted term
			{
				$key = array_search($courseCNR, $registeredCourseArray[(int)$term]);//find the key of the cnr code in term
				unset($registeredCourseArray[(int)$term][$key]);//unset the cnr
				$newCourse = json_encode($registeredCourseArray);//encode and write it to db
				
				$updateQuery = "UPDATE schedule.student SET registered_courses = '$newCourse' WHERE stu_id = ".$student['stu_id'].";";
				mysql_query($updateQuery);
			}
		}
	}
	
	
	public function DeleteProf($userId)
	{
		$con = new DBFunctions;
		$con->SetRemoteConnection();
		
		$query = "SELECT * FROM schedule.professor WHERE prof_id = '$userId';";
		$prof = mysql_fetch_array(mysql_query($query));
		$coursesArray = json_decode($prof['courses'], true);
		
		
		$terms = array("201402", "201401", "201302", "201301", "201202", "201201", "201102", "201101", "201002", "201001");
		foreach($terms as&$term)//search cnrs for each term
		{
			echo '<br><br>TERM:'.$term.'<br>';
			
			if(sizeof($coursesArray[$term]) > 0)//if term has no cnr in it
			{
				foreach($coursesArray[$term] as&$courseCNR)//for each cnr
				{
					$query = "DELETE FROM schedule.courses$term WHERE cnr = '$courseCNR';";
					mysql_query($query);
					$this->deleteCourseStudents($courseCNR, $term);//delete the course from all students
					$this->deleteCourseCourse($courseCNR, $term);//delete the course from course table
				}
			}
		}
		//delete from other tables
		$query = "DELETE FROM schedule.professor WHERE prof_id = '$userId';";
		mysql_query($query);
		$query = "DELETE FROM schedule.personalinfo WHERE user_id = '$userId';";
		mysql_query($query);
		$query = "DELETE FROM schedule.user WHERE user_id = '$userId';";
		mysql_query($query);
	}
	
	
	
	public function DeleteUserById($userIdArray)
	{
		
		$userInfoArray = array();//empty array
		foreach($userIdArray as&$userId)
		{
			$query = "SELECT * FROM schedule.user WHERE user_id = $userId;";//every user have unique id
			$checkUser = mysql_fetch_array(mysql_query($query));
			if($checkUser['type'] == "P")
			{
				DeleteProf($checkUser['user_id']);
			}
			else if($checkUser['type'] == "S")
			{
				
			}
			else if($checkUser['type'] == "A")
			{
				
			}
			
		}
	}
	
	
	public function GetUserInfoById($userId, $resultSet)
	{
		$userInfoArray = array();//empty array
		if(isset($userId))//single user info wanted
		{
			$query = "SELECT type FROM schedule.user WHERE user_id = $row[0];";
			$checkTypeOfUser = mysql_fetch_array(mysql_query($query))[0];
			if($checkTypeOfUser == "P" || $checkTypeOfUser == "S")
			{
				$query = "SELECT * FROM schedule.personalinfo WHERE user_id = $row[0];";
				$dummyArray = mysql_fetch_array(mysql_query($query));
				//array_push($personalInfoArray, mysql_fetch_array(mysql_query($query)));//add row to array
				$personalInfoArray[$dummyArray['user_id']] = $dummyArray;
				
			}
			
			return $personalInfoArray;//returns single user array
			
		}
		return null;
	}
	
	public function GetPersonalInfoById($userId, $resultSet)
	{
		$personalInfoArray = array();//empty array
		
		if(isset($resultSet))//find ids by resultSet
		{
			while($row = mysql_fetch_array($resultSet))
			{
				$query = "SELECT * FROM schedule.user WHERE user_id = $row[0];";//every user have unique id
				
				$checkTypeOfUser = mysql_fetch_array(mysql_query($query));
				
				if($checkTypeOfUser['type'] == "P" || $checkTypeOfUser['type'] == "S")
				{
					$query = "SELECT * FROM schedule.personalinfo WHERE user_id = $row[0];";
					$dummyArray = mysql_fetch_array(mysql_query($query));
					//array_push($personalInfoArray, mysql_fetch_array(mysql_query($query)));//add row to array
					$personalInfoArray[$dummyArray['user_id']] =[$dummyArray,$checkTypeOfUser];
					
				}
			}
			//var_dump($personalInfoArray);
			return $personalInfoArray;//returns all matched users info array
		}
		else if(isset($userId))//single user info wanted
		{
			$query = "SELECT * FROM schedule.user WHERE user_id = $row[0];";
			$checkTypeOfUser = mysql_fetch_array(mysql_query($query));
			if($checkTypeOfUser['type'] == "P" || $checkTypeOfUser['type'] == "S")
			{
				$query = "SELECT * FROM schedule.personalinfo WHERE user_id = $row[0];";
				$dummyArray = mysql_fetch_array(mysql_query($query));
				//array_push($personalInfoArray, mysql_fetch_array(mysql_query($query)));//add row to array
				$personalInfoArray[$dummyArray['user_id']] = [$dummyArray,$checkTypeOfUser];
				
			}
			
			return $personalInfoArray;//returns single user array
			
		}
		return null;
		
	}
	
	public function SearchUser($userInfoArray)
	{
		//the array may differ
		//but it must at least contains
		//name:surname:username one of them
		
		$query;
		//echo "IN SearchUser <br>";
		if(isset($userInfoArray['firstname']))
		{
			//echo "FNAME FOUND<br>";
			$firstname = $userInfoArray['firstname'];
		}
		if(isset($userInfoArray['lastname']))
		{
		//	echo "LNAME FOUND<br>";
			$lastname = $userInfoArray['lastname'];
		}
		if(isset($userInfoArray['username']))
		{
		//	echo "UNAME FOUND<br>";
			$username = $userInfoArray['username'];
		}
		
		//	echo "NAME: ".$firstname."<br>";
		
		if(isset($firstname) && !isset($lastname))
		{
		//	echo "ERR1<br>";
			$query = "SELECT * FROM schedule.personalinfo WHERE name = '$firstname';";
		}
		else if(!isset($firstname) && isset($lastname))
		{
			//"ERR1<br>";
			$query = "SELECT * FROM schedule.personalinfo WHERE surname = '$lastname';";
		}
		else if(isset($firstname) && isset($lastname))
		{
		//	"ERR2<br>";
			$query = "SELECT * FROM schedule.personalinfo WHERE name = '$firstname' AND surname = '$lastname';";
		}
		else if(isset($username) )
		{
		//	"ERR3<br>";
			$query = "SELECT * FROM schedule.user WHERE username = '$username';";
		}
		
		
		//echo "QUERY: ".$query."<br>";
		$con = new DBFunctions;
		$con->SetRemoteConnection();
		$resultSet = mysql_query($query);

 		if (!$resultSet) {
			echo 'Could not run query: ' . mysql_error();
			exit;
		} 
		$resultArray = $this->GetPersonalInfoById(null,$resultSet);
		return $resultArray;
		
	}
	
	
	
	
	public function ListAllUsers($type)
	{
		$con = new DBFunctions;
		$con->SetRemoteConnection();
		$resultSet;
		if(!isset($type))
		{
			$resultSet = mysql_query("SELECT * FROM schedule.user");
		}
		else
		{
			$resultSet = mysql_query("SELECT * FROM schedule.user WHERE type = '$type';");
		}
		if (!$resultSet) {
			echo 'Could not run query: ' . mysql_error();
			exit;
		}
		
		$allUserArray = array();
	/* 	while($row = mysql_fetch_array($allUserArray))
		{
			array_push($allUserArray,$row);
		} */
		$allUserArray = GetInfoById(null,$resultSet);
		
		return $allUserArray;
		
	}
}
?>