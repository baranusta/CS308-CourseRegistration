<?php
class User
{
	private $username;
	private $password;
	private $userType;
	var $id;
	
	public function __construct($Username=null, $Password=null, $type=null)
	{
		$this->username = $Username;
		$this->password = $Password;
		$this->userType = $type;
	}
	public function getUsername()
	{
		return $this->username;
	}
	public function getPassword()
	{
		return $this->password;
	}
	public function getUserType()
	{
		return $this->userType;
	}
	
	public function getId(){
		return $this->id;
	}
	
	//abstract public function getFirstScreen();
	
	//abstract public function getBrowseCourseActionPage();
}
?>