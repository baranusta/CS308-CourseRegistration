<?php
include_once '../PersonalInfoPackage/PersonalInfo.php';
include_once '../User.php';
//include_once '../Course.php';
//include_once '../RequestPackage/Request.php';

class Professor extends User
{
	protected $GivenCourses;
	protected $RegisteredCourses;
	protected $PersonalInf;
	protected $Requests;
	
	public function __construct($persInf)
	{
		$this->PersonalInf = $persInf;
		$this->RegisteredCourses = array ();
		$this->GivenCourses = array();
		$this->Requests = array();
	}
	
	
}
?>