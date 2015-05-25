<?php
abstract class User
{
	private $id;
	public function __construct($ID)
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