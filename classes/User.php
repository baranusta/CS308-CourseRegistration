<?php
abstract class User
{
	protected $username;
	protected $password;
	protected $userType;
	var $id;
	
	public function __construct($Username=null, $Password=null, $type=null)
	{
		$this->username = $Username;
		$this->password = $Password;
		$this->userType = $type;
	}
	
	public function getId(){
		return $this->id;
	}
	
	abstract public function getFirstScreen();
	
	abstract public function getBrowseCourseActionPage();
}
?>