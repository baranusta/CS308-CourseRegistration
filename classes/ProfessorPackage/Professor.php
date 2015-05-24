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
	private $term;
	
	public function __construct($id, $term)
	{
		$this->id = $id;
		$this->term = $term;
		$this->GivenCourses = array();
		$this->Requests = array();
	}
	public function getID()
	{
		return $this->id;
	}
	public function getCurrentTerm()
	{
		return $this->term;
	}
	public function getFirstScreen()
	{
		header("location:classes\ProfessorPackage\ProfessorFirstPage.php");
	}
	
	public function getBrowseCourseActionPage()
	{
		
	}
}
?>