<?php
set_include_path(get_include_path() . PATH_SEPARATOR . 'C:\xampp\htdocs\CS308-CourseRegistration\classes');
include_once 'Schedule.php';
include_once 'ProfessorPackage/ProfessorCourse.php';
//include_once 'StudentPackage/Student.php';

include_once 'DBFunctions.php';

class Course
{	
	private $cnr;
	private $shortName;
	private $longName;
	private $schedules;
	private $faculty;
	private $capacity;
	private $actual;
	private $term;
	private $credits;
	private $prerequisites;
	private $corerequest;
	private $professor;
	private $students;
	private $studentArr;
	private $grades;
	
	public function __construct($row,$Term )
	{
		$this->cnr = $row["cnr"];
		$this->longName = $row["longName"];
		$this->shortName = $row["classCode"];
		$this->capacity = $row["capacity"];
		$this->actual = 0;
		$this->credits = $row["credit"];
		$this->section = $row["section"];
		$this->term = $Term;
		//$this->prerequisites = $row["prereq"];
		$this->corerequest = $row["corerequest"];
		//$this->schedules = $row["schedule"];
		//$this->faculty = $row["faculty"];
		$scheduleArr = $row["schedule"];
		$scheduleArr = substr($scheduleArr, 1, -1);
		$Arr = explode(",",$scheduleArr);
		$this->schedules = array();
		foreach($Arr as $elm){
			if($elm)
			{
				$day = explode(";",$elm);
				try{
					$schedule["time"] = $day[0];
					$schedule["day"] = $day[1];
					$schedule["place"] = $day[2];
				}
				catch(Exception $e){
					echo $elm;
					echo $day ;
				}
				// echo implode(" ",$schedule);
				array_push($this->schedules,$schedule);
			}
		}
		if(isset($row["registeredStudents"]))
		{
			$this->studenteArr = json_decode($row["registeredStudents"]);
		}
		
		if(isset($row["prerequest"]))
		{
			$Requisites = $row["prerequest"];
			$Arr = explode(",",$Requisites);
			$this->prerequisites = array();
			foreach($Arr as $elm){
				if($elm)
					array_push($this->prerequisites,$elm);
			}
		}
		
		$this->professor = array();
		$insNames = $row["instructors"];
		$ins = explode(",",$insNames);
		foreach($ins as $insName)
		{
			array_push($this->professor,$insName);
		}
		$this->grades = array("id" => 0, "grade" => "wow"); 
	}
	public function addCourse($course)
	{
		DBFunctions::SetRemoteConnection();	
		
		/* echo "INSERT INTO `schedule`.`courses".$course['cTerm']."` 
		(`cnr`, `profID`, `longName`, `classCode`, `section`, `schedule`, 
		`instructors`, `capacity`) 
		VALUES ('".$course['cnr']."', '".$course['profID']."', '".$course['longName']."', '".$course['classCode']."', 
		'".$course['section']."', '".$course['schedule']."', '".$course['instructors']."', 
		'".$course['capacity']."');"; */
		
		$sql="INSERT INTO `schedule`.`courses".$course['cTerm']."` 
		(`cnr`, `profID`, `longName`, `classCode`, `section`, `schedule`, 
		`instructors`, `capacity`, `corerequest`, `prerequest`) 
		VALUES ('".$course['cnr']."', '".$course['profID']."', '".$course['longName']."', '".$course['classCode']."', 
		'".$course['section']."', '".json_encode($course['schedule'])."', '".$course['instructors']."', 
		'".$course['capacity']."', '".$course['corerequest']."', '".json_encode($course['prerequest'])."');";

		
		if(mysql_query($sql))
		{
			echo "Course added to the courses database.<br>";
			$pc = new ProfessorCourse();
			if($pc->AddCourse($course))
			{
				echo "Course added to the professor's course list in database.<br>";
			}
					
		}
		else
			echo "FAIL!!";
		DBFunctions::CloseConnection();
	}

	/*public function getFaculty()
	{
		return $faculty;
	}*/
	
	public function getProfessor()
	{
		return $professor;
	}
	
	/*
	This function is responsible to generate all html item
	for only one course.
	Result of the function is the html Item
	*/
	public function GetPageItem($chekboxEnabled)
	{
		$wholeItem = "";
		if($chekboxEnabled)
		{
		$wholeItem = "	<input type=\"checkbox\" name=\"cnr[]\" value=\"".$this->cnr."\">
						";
		}
		$wholeItem .=	"<tr>
						<a >".$this->longName."</a>&nbsp;&nbsp;
						<th class=\"ddlabel\" scope=\"row\">
						</tr>
						<br>
						<td class=\"dddefault\">
						<span class=\"fieldlabeltext\">Faculty: </span>Course Offered by ".$this->faculty.
						"<br><span class=\"fieldlabeltext\">Instructors: </span>";
		if(count($this->professor)>0)
			$wholeItem .= $this->professor[0]/*."(<abbr title=\"Primary\">P</abbr>)"*/;
		//commented part puts(P) next to the instructor name.
		//however, it is not necessary becuase we keep the first instructor name with (p) in out database.
		//it is not part of the loop because we may want to put another string next to the primary instructor later.
		for($iter=1; $iter<count($this->professor) ; $iter++) 
		{
			$wholeItem .= ", ".$this->professor[$iter];
		}
		
		$wholeItem .="	<br><br>
						".$this->credits." Credits
						<br>";
		
		return $wholeItem."____________________________________________________________<br><br>";
	}
	
	public function GetJSON()
	{
		return "   [{\"cnr\" : \"$this->cnr\", 
					\"shortName\" : ".json_encode($this->shortName).",
					\"schedule\" : ".json_encode($this->schedules).",
					\"prerequisites\" : ".json_encode($this->prerequisites)."}]"
					/*\"students\" : ".json_encode($this->students).",
					\"professor\" : \"$this->cnr\"}]"*/;
	}
	
	public function registerStudent($stuId){
		$this->studentArr[$stuId] = "InProgress";
		$sql =	"UPDATE schedule.courses".$this->term."
				 SET registeredStudents = '".json_encode($this->studentArr)."'
				 WHERE cnr='$this->cnr'";
				 
		echo $sql;
		DBFunctions::SetRemoteConnection();	
		if(mysql_query($sql))
		{
			echo"SUCCESS!!";
		}
		else
			echo"FAIL!!";
		DBFunctions::CloseConnection();
	}
	
	public function getSchedule()
	{
		return $this->schedules;
	}
	
	public function getShortName()
	{
		return $this->shortName;
	}
	
	public function getLongName()
	{
		return $this->longName;
	}
	
	public function getInstructor()
	{
		return $this->professor;
	}
	
	public function getCNR(){
		return $this->cnr;
	}
	
	public function getGrade(){
		return $this->grades;
	}
	
	public function getCorequisites(){
		return $this->corerequest;
	}
	
}
?>