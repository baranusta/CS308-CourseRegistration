<?php
//include_once 'PersonalInfoPackage/PersonalInfo.php';
//include_once 'Courses.php';
//include_once 'RequestPackage/Request.php';
include_once 'User.php';

class Professor extends User
{
	private $Department;
	private $GivenCourses;
	private $RegisteredCourses;
	private $PersonalInf;
	private $Requests;
	
 	public function __construct($persInf, $fac = null, $major = null)
	{
		$this->PersonalInf = $persInf;
		$this->Faculty = $fac;
		$this->Major = $major;
		$this->GivenCourses = array();
		$this->Requests = array();
	} 

	public function getFirstScreen(){
		header("location:classes/ProfessorPackage/profIndex.php");
	}
	
	public function getBrowseCourseActionPage(){
		return null;
	}
	
}
?>