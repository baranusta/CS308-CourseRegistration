<?php
include_once '../PersonalInfoPackage/PersonalInfo.php';
include_once '../User.php';
//include_once '../Course.php';
//include_once '../RequestPackage/Request.php';

class Student extends User
{
	protected $Faculty;
	protected $Major;
	protected $GradYear;
	protected $TakenCourses;
	protected $RegisteredCourses;
	protected $PersonalInf;
	protected $Requests;
	
	
	public function __construct($persInf, $gradYear = null, $major = null)
	{
		$this->PersonalInf = $persInf;
		$this->GradYear = $gradYear;
		$this->Major = $major;
		$this->RegisteredCourses = array();
		$this->TakenCourses = array();
		$this->Requests = array();
	}
	

}
?>