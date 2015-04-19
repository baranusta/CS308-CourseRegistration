<?php
include 'PersonalInfo.php';
include 'Courses.php';
include 'Request.php';

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
	
	public function AddTakenCourse($Course,$Grade)
	{
		$this->TakenCourses['$Course->id'] = $Grade;
	}
	
	public function RegisterCourse($Course)
	{
		array_push($this->RegisteredCourses, '$Course->id');
	}
	
	public function SendRequest($req)
	{
		//Buraları nası yapsak bilemedim. Sıkıntılar mevcudğğ.
	}
	
}
?>