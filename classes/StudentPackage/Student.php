<?php
// include_once 'PersonalInfo.php';
// include_once 'Courses.php';
set_include_path(get_include_path() . PATH_SEPARATOR . 'C:\xampp\htdocs\CS308-CourseRegistration\classes');
include_once 'CoursePackage\CourseController.php';
include_once 'User.php';

class Student extends User
{
	private $Major;
	private $EnteredYear;
	private $TakenCourses;
	private $RegisteredCourses;
	private $PersonalInf;
	private $Requests;
	private $CoursesTakenInfo;
	private $scheduleMatrix;
	
	public function __construct($id,$currentTerm)
	{
		$this->id = $id;
		$row = $this->RetrieveStudentData();
		$this->major = $row['major'];
		$this->gradYear = $row['grad_year'];
		$this->RegisteredCourses = json_decode($row['registered_courses']);
		$this->Requests = json_decode($row['request']);
		$this->CoursesTakenInfo = $this->GetAllCoursesInfo();
		// $scheduleMatrix = $this->formSchedule($currentTerm);
	}
	 
	public function GetAllCoursesInfo(){
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
	
	private function initSchedule(){
		$this->scheduleMatrix = array();
		$this->scheduleMatrix['M'] = array("0","0","0","0","0","0","0","0","0","0","0");
		$this->scheduleMatrix['T'] = array("0","0","0","0","0","0","0","0","0","0","0");
		$this->scheduleMatrix['W'] = array("0","0","0","0","0","0","0","0","0","0","0");
		$this->scheduleMatrix['R'] = array("0","0","0","0","0","0","0","0","0","0","0");
		$this->scheduleMatrix['F'] = array("0","0","0","0","0","0","0","0","0","0","0");
	}
	
	public function formSchedule($term){
		$this->initSchedule();
		if(array_key_exists($term,$this->CoursesTakenInfo))
		{
			$Courses = $this->CoursesTakenInfo[$term];
			foreach($Courses as $key=>$value)
			{
				$schedule = $value[$key."cnr"]->getSchedule();
				$this->fillSchedule($schedule);
			}
		}
		else
			echo $term."There is not any course taken for this term";
		
	}
	
	private function fillSchedule($schedule)
	{
		foreach($schedule as $eachDay)
		{
			$times = explode($eachDay["time"],"-");
			$start = explode($times[0],":");
			$end = explode($times[1],":");
			$this->scheduleMatrix[$eachDay["day"]][intval($start[0])] = $eachDay["place"]; 
		}
	}
	
	public function getFirstScreen(){
		header("location:classes\StudentPackage\StudentFirstPage.php");
	}
	
	public function getBrowseCourseActionPage(){
		return "StudentPackage\AddCourse.php";
	}
	
	public function getTakenCourses($term){
		if(property_exists($this->RegisteredCourses, $term))
			return $this->RegisteredCourses->{$term};
		return $this->RegisteredCourses->{$term};
	}
	
	public function registerToCourse($term,$cnr){
		if(!$this->RegisteredCourses)
			$this->RegisteredCourses = new stdClass();
		if(property_exists($this->RegisteredCourses, $term)){
			var_dump($this->RegisteredCourses->{$term});
			$this->RegisteredCourses->{$term}[$cnr] = 'InProgress';
		}
		else
		{
			$this->RegisteredCourses->{$term} = new stdClass();
			$this->RegisteredCourses->{$term}[$cnr] = 'InProgress';
		}
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
	public function GetSchedule()
	{
		
	}

}
?>