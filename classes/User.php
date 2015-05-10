<?php
abstract class User
{
	var $id;
	public function User($ID)
	{
		$this->id = $ID;
	}
	
	public function getId(){
		return $this->id;
	}
	
	abstract public function getFirstScreen();
	
	abstract public function getBrowseCourseActionPage();
}
?>