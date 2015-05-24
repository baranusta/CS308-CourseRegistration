<?php


include_once '../PersonalInfoPackage/PersonalInfo.php';
//include_once '../Course.php';
//include_once '../RequestPackage/Request.php';

set_include_path(get_include_path() . PATH_SEPARATOR . 'C:\wamp\www\CS308-CourseRegistration\classes');
include_once '../CoursePackage/CourseController.php';
include_once '../User.php';
// include_once 'PersonalInfo.php';
// include_once 'Courses.php';
set_include_path(get_include_path() . PATH_SEPARATOR . 'C:\xampp\htdocs\CS308-CourseRegistration\classes');
include_once 'CoursePackage\CourseController.php';
include_once 'ActiveUser.php';

class Student extends ActiveUser
{
	private $Major;
	private $EnteredYear;
	private $TakenCourses;//taken courses So far grade is in there

	private $RegisteredCourses;
	private $PersonalInf;
	private $Requests;
	
	public function SetPersonalInfo($PersonalInfo)
	{
		$this->PersonalInf = $persInf;
	}
	
	public function __construct($id)
	{
		parent::__construct($id);
		$row = $this->RetrieveStudentData();
		$this->major = $row['major'];
		$this->gradYear = $row['grad_year'];
		$this->RegisteredCourses = (array)json_decode($row['registered_courses']);
		function cmp($a,$b){
			return strcmp($a,$b);
		}
		ksort($this->RegisteredCourses);
		$this->Requests = json_decode($row['request']);
		$this->retrieveCourses($this->RegisteredCourses);
	}
	
	public function getFirstScreen(){
		header("location:classes\StudentPackage\StudentFirstPage.php");
	}
	
	public function getBrowseCourseActionPage(){
		$currentTerm = func_get_arg(0);
		if($currentTerm)
			return "StudentPackage\AddCourse.php";
		else
			return "StudentPackage\StudentAddDropPage.php";
	}
	
	public function getTakenCoursesGrade(){
		return $this->RegisteredCourses;
	}
	
	public function registerToCourse($term,$name,$cnr,$mode){
		
		if(!$this->RegisteredCourses)
			$this->RegisteredCourses = array();
		if(!isset($this->RegisteredCourses[$term])){
			$this->RegisteredCourses[$term] = new stdClass();
		}
		if($mode)
			$this->RegisteredCourses[$term]->{$cnr} = array("shortName"=>$name,"grade"=>"InProgress");
		else
			$this->RegisteredCourses[$term]->{$cnr} = array("shortName"=>$name,"grade"=>"nope");
		
		$this->AddCourse($term,$cnr);
	}
	
	public function unregisterCourse($term,$cnr){
		if(!$this->RegisteredCourses)
			$this->RegisteredCourses = array();
		if(isset($this->RegisteredCourses, $term)){
			unset($this->RegisteredCourses[$term]->{$cnr});
		}
		$this->RemoveCourse($term,$cnr);
	}
	
	public function UpdateRegisteredCourseDB(){
		$getId = $this->getId();
		$json = json_encode($this->RegisteredCourses);
		$sql = "UPDATE schedule.student SET registered_courses='".$json."' WHERE stu_id='$getId';";
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
		$getId = $this->getId();
		$sql = "SELECT * FROM schedule.student WHERE stu_id='$getId'";
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
	
	public function GetTranscript(){
		$transcript;
		foreach($this->RegisteredCourses as $term=>$courses){
			$transcript[$term] = array();
			foreach($courses as $cnr=>$info){
				echo $term." ".$cnr."<br>";
				var_dump($info);
				$longName = $this->getCourseLongName($term,$cnr);
				$credit = $this->getCourseCredit($term,$cnr);
				$transcript[$term][$cnr] = array($info['shortName'],$longName,$credit,$info['shortName']); 
			}
		}
		return $transcript;
	}
}
?>