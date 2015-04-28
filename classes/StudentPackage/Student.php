<?php
include_once 'PersonalInfo.php';
include_once 'Courses.php';
include_once 'Request.php';

class Student extends User
{
	private $Faculty;
	private $Major;
	private $EnteredYear;
	private $TakenCourses;
	private $RegisteredCourses;
	private $PersonalInf;
	private $Requests;
	
	public function __construct($persInf, $fac = null, $major = null)
	{
		$this->PersonalInf = $persInf;
		$this->Faculty = $fac;
		$this->Major = $major;
		$this->RegisteredCourses = array();
		$this->TakenCourses = array();
		$this->Requests = array();
	}
	

}
?>