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
					"cTerm" => $params['p_term']
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