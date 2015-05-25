<?php
// include_once 'PersonalInfo.php';
// include_once 'Courses.php';
set_include_path(get_include_path() . PATH_SEPARATOR . 'C:\xampp\htdocs\CS308-CourseRegistration\classes');
include_once 'CoursePackage\CourseController.php';
include_once 'User.php';
/* include_once 'PersonalInfo.php';
include_once 'Courses.php';
include_once 'Request.php'; */

class Student extends User
{
	private $Major;
	private $EnteredYear;
	private $TakenCourses;
	private $RegisteredCourses;
	private $PersonalInf;
	private $Requests;
	private $CoursesTaken;
	private $scheduleArr;
	
	
	
	
	
	public function __construct($id,$currentTerm)
	{
		$this->id = $id;
		$row = $this->RetrieveStudentData();
		$this->major = $row['major'];
		$this->gradYear = $row['grad_year'];
		$this->RegisteredCourses = json_decode($row['registered_courses']);
		$this->Requests = json_decode($row['request']);
		$this->CoursesTaken = $this->GetAllCourses();
		// foreach($this->CoursesTaken['201402'] as $key=> $var)
		// {
			// var_dump($key);
			// echo '<br>';
			// var_dump($var);
		// }
		
	}
	

	public function GetAllCourses(){
		$Terms = array();
		$CourseRetriever = new CoursesController();
		foreach($this->RegisteredCourses as $key => $value)
		{
			$Courses = array();
			$table= $key;
			foreach($value as $cnr=> $grade)
			{
				$sqlwhere ="WHERE cnr =".$cnr;
				$Courses[$cnr] = $CourseRetriever->GetSearchedCourses($table,$sqlwhere);
			}
			$Terms[$table] = $Courses;
		}
		return $Terms;
	}
	
	public function formSchedule($term){
		if(array_key_exists($term,$this->CoursesTaken))
		{
			$Courses = $this->CoursesTaken[$term];
			foreach($Courses as $key=>$value)
			{
				$schedule = $value[$key."cnr"]->getSchedule();
				$courseName = $value[$key."cnr"]->getShortName();
				$this->fillSchedule($schedule,$courseName);
			}
		}
		else
			echo $term."There is no course taken for this term";
		
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
	
	public function getFirstScreen(){
		//header("location:classes/StudentPackage/StudentFirstPage.php");
		header("location:classes/StudentPackage/stuIndex.php");
	}
	
	public function getBrowseCourseActionPage(){
		$currentTerm = func_get_arg(0);
		if($currentTerm)
			return "StudentPackage/AddCourse.php";
		else
			return "StudentPackage/StudentAddDropPage.php";
	}
	
	public function getSchedule($desiredTerm){
		
		$this->formSchedule($desiredTerm);
		return $this->scheduleArr;
	}
	
	public function getRegisteredCourses($term){
		$CoursesNames = array();
		foreach($this->CoursesTaken as $key=> $var)
		{
			if($key == $term){
				foreach($var as $cnr => $Obj)
				{
					array_push($CoursesNames,array($Obj[$cnr."cnr"]->getShortName(),$Obj[$cnr."cnr"]->getCorequisites()));
				}
				return $CoursesNames;
			}
		}
		
	}
	
	public function getTakenCourses(){
		$CoursesNames = array();
		foreach($this->CoursesTaken as $key=> $var)
		{
			foreach($var as $cnr => $Obj)
			{
				array_push($CoursesNames,array($Obj[$cnr."cnr"]->getShortName()=>$Obj[$cnr."cnr"]->getGrade()));
			}
		}
		return $CoursesNames;
	}
	
	public function registerToCourse($term,$cnr){
		if(!$this->RegisteredCourses)
			$this->RegisteredCourses = new stdClass();
		if(property_exists($this->RegisteredCourses, $term)){
			$this->RegisteredCourses->{$term}->{$cnr} = 'InProgress';
		}
		else
		{
			$this->RegisteredCourses->{$term} = new stdClass();
			$this->RegisteredCourses->{$term}->{$cnr} = 'InProgress';
		}
		
		$CourseRetriever = new CoursesController();
		
		$sqlwhere ="WHERE cnr =".$cnr;
		$this->CoursesTaken[$term][$cnr] = $CourseRetriever->GetSearchedCourses($term,$sqlwhere);
	}
	
	public function removeCourse($term,$cnr){
		if(!$this->RegisteredCourses)
			$this->RegisteredCourses = new stdClass();
		if(property_exists($this->RegisteredCourses, $term)){
			unset($this->RegisteredCourses->{$term}->{$cnr});
		}
		unset($this->CoursesTaken[$term][$cnr]);
	}
	
	public function UpdateRegisteredCourseDB()
	{
		
		$json = json_encode($this->RegisteredCourses);
		
		$sql = "UPDATE schedule.student SET registered_courses='".$json."' WHERE stu_id='$this->id';";
		DBFunctions::SetRemoteConnection();
		$result=mysql_query($sql);
		DBFunctions::CloseConnection();
		if($result)
		{
			echo "Successfuly Added to Student";
		}
		else
			echo "Something went wrong";
		
	}
	
	private function RetrieveStudentData(){
		$sql = "SELECT * FROM schedule.student WHERE stu_id='$this->id';";
		DBFunctions::SetRemoteConnection();	DBFunctions::SetRemoteConnection();
		$result=mysql_query($sql);
		DBFunctions::CloseConnection();
		$count=mysql_num_rows($result);
		
		if($result)
		{
			if($count==1){
				while($row = mysql_fetch_assoc($result)) {
					return $row;
				}
			}
			else
				throw new Exception("Multiple Results Found");
		}
		else
			throw new Exception("Student not found");;
	}

}
?>