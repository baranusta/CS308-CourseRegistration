<?php
include_once 'Schedule.php';
include_once 'Professor.php';
include_once 'Student.php';


class Courses
{	
	private $id;
	private $schedules;
	private $title;
	private $faculty;
	private $capacity;
	private $term;
	private $credits;
	private $prerequisites;
	private $professor;
	private $students;
	private $grades;
	
	public function __construct($Title, $Capacity, $Term, $Faculty, $Id, $Credits)
	{
		$this->id = ID;
		$this->title = Title;
		$this->capacity = Capacity;
		$this->credits = Credits;
		$this->term = Term;
		$this->faculty = Faculty;
		$this->schedules = array();
		$this->students = array();
		$this->prerequisites = array();
		$this->professor = array();
		$this->grades = array(
			'id', 'grade'
		)
		
	}
	
	
}
?>