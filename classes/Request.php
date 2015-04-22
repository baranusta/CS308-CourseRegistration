<?php
include 'Student.php';
include 'Professor.php';

class Request
{	
	private $studentID;
	private $professorID;
	private $message;
	private $isApproved;
	private $term;
	private $courseID;
	private $requestType;
	private $student;
	private $professor;
	
	public function __construct($Message, $Term, $CourseId, $RequestType, $StudentID, $ProfessorID)
	{
		$this->message = Message;
		$this->term = Term;
		$this->courseID = CourseId;
		$this->requestType = RequestType;
		$this->studentID = StudentID;
		$this->professorID	= ProfessorID;
		
	}
	
	
}
?>