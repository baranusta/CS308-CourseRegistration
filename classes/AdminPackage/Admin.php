<?php
set_include_path(get_include_path() . PATH_SEPARATOR . 'C:\xampp\htdocs\CS308-CourseRegistration\classes');
//include_path=".;C:\xampp\htdocs\CS308-CourseRegistration\classes";
include_once 'Courses.php';
include_once 'RequestPackage/Request.php';
include_once 'ProfessorPackage/Professor.php';
include_once 'StudentPackage/Student.php';
include_once 'User.php';

class Admin extends User
{	
	
	public function AddUser($User)
	{
		$AdminController;
		//DB li bişiler çözcez
	}
	
	public function DeleteUser($User)
	{
		//DB li bişiler çözcez
	}
	
	public function CreateCourse($Course)
	{
		$AdminCourseController;
		//DB li bişiler çözcez
	}
	
	public function ModifyCourse($Course)
	{
		$AdminCourseController;
	}
	
	public function DeleteCourse($Course)
	{
		$AdminCourseController;
		//DB li bişiler çözcez
	}
	
	public function ModifyUserInfo()
	{
		//Nasıl yapcaımızı konuşmamız lazım.
	}
	
	public function GetUserInfo()
	{
		$AdminController;
	}
}
?>