<?php
abstract class User
{
	var $id;
	public function User()
	{
	}
	
	public function getId(){
		return $this->id;
	}
	
	abstract public function getFirstScreen();
	
	abstract public function getBrowseCourseActionPage();
}
?>