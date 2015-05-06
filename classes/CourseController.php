<?php
//include_once 'PersonalInfoPackage/PersonalInfo.php';
//include_once 'Courses.php';
//include_once 'RequestPackage/Request.php';
include_once 'DBFunctions.php';
include_once 'Course.php';

class CoursesController
{	
	//First, obtains all suitable courses
	//Then gets all the page items
	public function GetSearchedCoursesItems($term,$where){
		$AllCourses = $this->GetSearchedCourses($term,$where);
		$wholeString = "";
		foreach($AllCourses as $Course)
		{
			$wholeString .= $Course->GetPageItem();
		}
		return $wholeString;
	}
	
	//takes term and required where statemnt for sql
	//returns all the suitable courses
	private function GetSearchedCourses($term, $where){
		DBFunctions::SetRemoteConnection();
		$AllCourses = array();
		$sql="SELECT * FROM schedule.courses".$term." ".$where;
		$result=mysql_query($sql);
		if($result)
		{
			while($row = mysql_fetch_assoc($result)) {
				array_push($AllCourses,new Course($row,$term));
			   //echo "<pre>"; print_r($row); echo "</pre>";
			}
		}
		DBFunctions::CloseConnection();
		return $AllCourses;
	}
	
	
}
?>