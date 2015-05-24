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
	
<<<<<<< HEAD
	public function __construct($persInf)
=======
/* 	public function __construct($persInf, $fac = null, $major = null)
>>>>>>> 969dd098439105cbfcf933289b2c67def48445d8
	{
		$this->PersonalInf = $persInf;
		$this->RegisteredCourses = array ();
		$this->GivenCourses = array();
		$this->Requests = array();
<<<<<<< HEAD
	}
	
	public function getFirstScreen()
	{}
	public function getBrowseCourseActionPage()
	{}
=======
	} */

	public function getFirstScreen(){}
	public function getBrowseCourseActionPage(){}
	
>>>>>>> 969dd098439105cbfcf933289b2c67def48445d8
}
?>