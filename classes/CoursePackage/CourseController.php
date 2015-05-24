<?php
//include_once 'PersonalInfoPackage/PersonalInfo.php';
//include_once 'Courses.php';
//include_once 'RequestPackage/Request.php';
include_once 'DBFunctions.php';
include_once 'Course.php';
include_once 'ProfessorPackage/ProfessorController.php';

class CoursesController
{	
	//First, obtains all suitable courses
	//Then gets all the page items
	public function GetSearchedCoursesItems($term,$where,&$json = null){
		$AllCourses = $this->GetSearchedCourses($term,$where);
		if(!isset($_SESSION)){
			session_start();
		}
		$_SESSION["AllCourses"] = $AllCourses;
		$wholeString = "";
		$AllJSON ="";
		foreach($AllCourses as $Course)
		{
			$wholeString .= $Course->GetPageItem($_SESSION["ActiveTerm"]==$term);
			$AllJSON.= "\"".$Course->getCNR()."\":".$Course->getJSON().",";
		}
		$json = $AllJSON;
		$json = substr($json, 0, -1);
		$json = "{".$json."}";
		return $wholeString;
	}
	
	public function ControlCourse($params)
	{
		///KREDİ SINIRLAMASI
		if($params["cCredits"] >= 0 && $params["cCredits"] <=4)
		{
			////CAPACITY SINIRLAMASI
			if($params["cCapacity"] >= 0 && $params["cCapacity"] < 201)
			{	$profController = new ProfessorController();
				$prof_id = 	$profController->ControlProfessor($params["cInstructorName"],$params["cInstructorLastname"]);	
				echo $prof_id;
				if($prof_id >=0)
				{
					$courseToBeAdded = array(
					"cnr" => $params['cCRN'], 
					"profID" => $prof_id, 
					"longName" => $params['cName'], 
					"classCode" => $params['cCode'],  
					"section" => $params['cSection'], 
					"credits" => $params['cCredits'], 
					"schedule" => $params['cSchedule'], 
					"instructors" => $params['cInstructorName']." ".$params['cInstructorLastname'], 
					"capacity" => $params['cCapacity']	,
					"cTerm" => $params['p_term'],
					"prerequest" => $params['prerequest'],
					"corerequest" => $params['corerequest']
					);
					$course = new Course($courseToBeAdded, $params['p_term']);
					$course->addCourse($courseToBeAdded);
					return true;
				}
				else
				{
					echo"No such professor exists in professor database.";
				}	
			}
			else
			{
				echo"Course capacity can not be less than 0.";
			}	
		}
		else
		{
			echo"Course credit can not be less than 0.";
		}
		return false;
	}
	//private function ControlSchedule($schedule){}

	
	//takes term and required where statemnt for sql
	//returns all the suitable courses
	public function GetSearchedCourses($term, $where){
		DBFunctions::SetRemoteConnection();
		$AllCourses = array();
		//we may erase this
		mysql_query('SET CHARACTER SET utf8');
		$sql="SELECT * FROM schedule.courses".$term." ".$where;
		$result=mysql_query($sql);
		DBFunctions::CloseConnection();
		if($result)
		{
			while($row = mysql_fetch_assoc($result)) {
				$AllCourses[$row['cnr']."cnr"] = new Course($row,$term);
			   //echo "<pre>"; print_r($row); echo "</pre>";
			}
		}
		
		return $AllCourses;
	}
	public function getEnrolledStudents($term, $cnr)
	{
		$sql = "SELECT registeredStudents FROM schedule.courses".$term." WHERE cnr = '".$cnr."';";
		DBFunctions::SetRemoteConnection();
		$resultSet = mysql_query($sql);
		DBFunctions::CloseConnection();
		return $resultSet;
	}
	public function returnCourses($values, $term)
	{
		$sql = "";
		$courseNum = "";
		$classCode = "";

		if(isset($values["sel_subj"]))
		{
			$classCode = $values["sel_subj"];
		}
		if(isset($values["sel_crse"]))
		{
			$courseNum = $values["sel_crse"];
			
		}
		if(strlen($courseNum) && ($classCode != "*"))
		{
			$sql = "SELECT * From schedule.courses".$term." WHERE classCode LIKE '".$classCode."%' AND cnr ='".$courseNum."';";
		}
		else if (strlen($courseNum))
		{
			$sql = "SELECT * From schedule.courses".$term." WHERE cnr = '".$courseNum."';";
		}
		else if ($classCode != "*")
		{
			$sql = "SELECT * From schedule.courses".$term." WHERE classCode LIKE '".$classCode."%';";
		}
		else
		{
			$sql = "SELECT * From schedule.courses".$term.";";
		}
		DBFunctions::SetRemoteConnection();
		$resultSet = mysql_query($sql);
		DBFunctions::CloseConnection();
		return $resultSet;
	}
	
	public function DeleteCourse($array)
	{
		DBFunctions::SetRemoteConnection();
		$sql = "DELETE FROM `schedule`.`courses".$array[0]."` WHERE `cnr`='".$array[1]."';";
		$result = mysql_query($sql);
		DBFunctions::CloseConnection();
		return $result;
	}
	public function UpdateGrade($array, $id)
	{
		$decoded = json_encode($array);
		DBFunctions::SetRemoteConnection();
		$sql = "UPDATE schedule.student SET `registered_courses`='".$decoded."' WHERE `stu_id`='".$id."';";
		$result = mysql_query($sql);
		DBFunctions::CloseConnection();
	}
	//retrieves all courses as array from wanted term
	public function getTermCoursesArray($term)
	{
		DBFunctions::SetRemoteConnection();	
		$query = "SELECT * FROM schedule.courses$term;";		
		$resultSet = mysql_query($query);
		$courses = array();
		
		while($row = mysql_fetch_array($resultSet))
		{
			array_push($courses, $row);
		}
		
		DBFunctions::CloseConnection();
		
		return $courses;
	}
	
	public function removeStudentFromCourse($Course,$StuId){
		if($Course->stuIsRegistered($StuId))
			$Course->removeStudent($StuId);
	}
	public function getCoursebyCNR($cnr, $term)
	{
		$sql = "SELECT * From schedule.courses".$term." WHERE cnr ='".$cnr."';";
		DBFunctions::SetRemoteConnection();
		$resultSet = mysql_query($sql);
		DBFunctions::CloseConnection();
		$result = mysql_fetch_array($resultSet);
		return $result;
	}
}
?>