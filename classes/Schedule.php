<?php
include_once 'Courses.php';

class Schedule
{	
	private $time;
	private $place;
	
	public function __construct($Time, $Place)
	{
		$this->time = Time;
		$this->place = Place;
	}
	
	
}
?>