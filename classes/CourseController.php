<?php
//include_once 'PersonalInfoPackage/PersonalInfo.php';
//include_once 'Courses.php';
//include_once 'RequestPackage/Request.php';
include_once 'DBFunctions.php';
include_once 'Course.php';

class CoursesController
{	
	//First, obtains all suitable courses
	//Then gets all the page items
	public function GetSearchedCoursesItems($term,$where){
		$AllCourses = $this->GetSearchedCourses($term,$where);
		$wholeString = "";
		foreach($AllCourses as $Course)
		{
			$wholeString .= $Course->GetPageItem();
		}
		return $wholeString;
	}
	
	public function ControlCourse($params)
	{
		///KREDİ SINIRLAMASI
		if($params["credits"] >= 0 && $params["credits"] <=4)
		{
			////CAPACITY SINIRLAMASI
			if($params["cCapacity"] >= 0 && $params["cCapacity"] < 201)
			{		
				$prof_id = 	$this->ControlProfessor($params["cInstructorName"],$params["cInstructorLastname"]);	
				if($prof_id >=0)
				{
					$course = new Course();
					$courseToBeAdded = array(
					"cnr" => $params['cCRN'], 
					"profID" => $prof_id, 
					"longName" => $params['cName'], 
					"classCode" => $params['cCode'],  
					"section" => $params['cSection'], 
					"faculty" => $params['cFaculty'], 
					"schedule" => $params['cSchedule'], 
					"instructors" => $params['cInstructorName']." ".$params['cInstructorLastname'], 
					"capacity" => $params['cCapacity']	,
					"cTerm" => $params['p_term']
					);
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

	private function ControlProfessor($profName, $profLastname)
	{
		DBFunctions::SetRemoteConnection();
		$allPeople = array();
		$sql="SELECT pro.prof_id From schedule.personalinfo pi, schedule.professor 
				pro where pi.user_id = pro.prof_id AND pi.name ='".$profName."' AND pi.surname='".$profLastname."';";
		$result = mysql_query($sql);
		$profID;
		if ($row = mysql_fetch_assoc($result)) {
			echo $row['prof_id'];
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
	
	//takes term and required where statemnt for sql
	//returns all the suitable courses
	private function GetSearchedCourses($term, $where){
		DBFunctions::SetRemoteConnection();
		$AllCourses = array();
		$sql="SELECT * FROM schedule.courses".$term." ".$where;
		$result=mysql_query($sql);
		if($result)
		{
			while($row = mysql_fetch_assoc($result)) {
				array_push($AllCourses,new Course($row,$term));
			   //echo "<pre>"; print_r($row); echo "</pre>";
			}
		}
		DBFunctions::CloseConnection();
		return $AllCourses;
	}
	
	
}
?>