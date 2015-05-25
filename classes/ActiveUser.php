<?php
set_include_path(get_include_path() . PATH_SEPARATOR . 'C:\xampp\htdocs\CS308-CourseRegistration\classes');
include_once 'CoursePackage\CourseController.php';
include_once 'PersonalInfoPackage\PersonalInfo.php';
include_once 'User.php';
abstract class ActiveUser extends User
{
	private $CoursesTaken;//All course Objects
	private $scheduleArr;
	private $PersonalInfo;
	
	
	public function __construct($id)
	{
		parent::__construct($id);
		$PersonalInfo = new PersonalInfo($id);
	}
	
	public function GetAllCourses($RegisteredCourses){
		$Terms = array();
		$CourseRetriever = new CoursesController();
		foreach($RegisteredCourses as $key => $value)
		{
			$Courses = array();
			$table= $key;
			foreach($value as $cnr=> $grade)
			{
				$sqlwhere ="WHERE cnr =".$cnr;
				echo $table." ".$cnr."<br>";
				$Courses[$cnr] = $CourseRetriever->GetSearchedCourses($table,$sqlwhere);
			}
			$Terms[$table] = $Courses;
		}
		return $Terms;
	}
	
	public getPersonalInfo(){
		return $PersonalInfo;
	}
	
	public function retrieveCourses($RegisteredCourses){
		$this->CoursesTaken = $this->GetAllCourses($RegisteredCourses);
	}
	
	public function AddCourse($term,$cnr){
		$CourseRetriever = new CoursesController();
		$sqlwhere ="WHERE cnr =".$cnr;
		$this->CoursesTaken[$term][$cnr] = $CourseRetriever->GetSearchedCourses($term,$sqlwhere);
		
	}
	
	public function RemoveCourse($term,$cnr){
		$CourseRemover = new CoursesController();
		$CourseRemover->removeStudentFromCourse($this->CoursesTaken[$term][$cnr][$cnr."cnr"],$this->id);
		unset($this->CoursesTaken[$term][$cnr]);
	}
	
	public function formSchedule($term){
		if(isset($this->CoursesTaken[$term]))
		{
			$Courses = $this->CoursesTaken[$term];
			if(count($Courses)==0){
				return false;
			}
			foreach($Courses as $key=>$value)
			{
				$schedule = $value[$key."cnr"]->getSchedule();
				$courseName = $value[$key."cnr"]->getShortName();
				$this->fillSchedule($schedule,$courseName);
			}
			return true;
		}
		else
			return false;
		
	}
	
		
	public function getTakenCoursesInfo($term){
		$CoursesNames = array();
		foreach($this->CoursesTaken as $key=> $var)
		{
			if($key == $term){
				foreach($var as $cnr => $Obj)
				{
					array_push($CoursesNames,array($Obj[$cnr."cnr"]->getShortName(),$Obj[$cnr."cnr"]->getLongName(),$Obj[$cnr."cnr"]->getSchedule(),$Obj[$cnr."cnr"]->getCNR(),$Obj[$cnr."cnr"]->getCorequisites()));
				}
				return $CoursesNames;
			}
		}
	}
	
	private function fillSchedule($schedule,$cName)
	{
		foreach($schedule as $eachDay)
		{
			$times = explode("-",$eachDay["time"]);
			if(count($times)>1){
				$start = explode(":",$times[0]);
				$end = explode(":",$times[1]);
				$startInd = intval($start[0])-8;
				if($startInd<0)
				{
					$startInd += 12;
				}
				$endInd = intval($end[0])-8;
				if($endInd<0)
				{
					$endInd += 12;
				}
				for($i = $startInd; $i<$endInd ; $i++)
				{
					$this->scheduleArr[$eachDay["day"]][$i] = $eachDay["place"].",".$cName;
				}
			}
		}
	}
	
	public function getCourseLongName($term,$cnr){
			if(isset($this->CoursesTaken[$term][$cnr][$cnr."cnr"])){
				return $this->CoursesTaken[$term][$cnr][$cnr."cnr"]->getLongName();
			}
			return "Course Name not known";
	}
	
	public function getCourseCredit($term,$cnr){
		if(isset($this->CoursesTaken[$term][$cnr][$cnr."cnr"])){
			return $this->CoursesTaken[$term][$cnr][$cnr."cnr"]->getCredit();
		}
		return "Course Name not known";
	}
	
	public function getSchedule($desiredTerm){
		// var_dump($this->CoursesTaken);
		unset($this->scheduleArr);
		if($this->formSchedule($desiredTerm))
		{
			return $this->scheduleArr;
		}
		return array();
	}
}

?>