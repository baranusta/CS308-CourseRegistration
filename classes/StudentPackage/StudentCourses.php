<?php
class StudentCourses
{
	public function AddTakenCourse($Course,$Grade)
	{
		$this->TakenCourses['$Course->id'] = $Grade;
	}
	
}
?>