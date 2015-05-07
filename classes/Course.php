<?php
set_include_path(get_include_path() . PATH_SEPARATOR . 'C:\xampp\htdocs\CS308-CourseRegistration\classes');
include_once 'Schedule.php';
//include_once 'ProfessorPackage/Professor.php';
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
	private $professor;
	private $students;
	private $grades;
	
	public function __construct($row,$Term )
	{
		$this->cnr = $row["cnr"];
		$this->longName = $row["longName"];
		$this->shortName = $row["classCode"];
		$this->capacity = $row["capacity"];
		$this->actual = 0;
		$this->credits = 3;
		$this->section = $row["section"];
		$this->term = $Term;
		//$this->faculty = $row["faculty"];
		$this->schedules = $row["schedule"];
		$this->students = array();
		$this->prerequisites = array();
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
		
		echo "INSERT INTO `schedule`.`courses".$course['cTerm']."` 
		(`cnr`, `profID`, `longName`, `classCode`, `section`, `schedule`, 
		`instructors`, `capacity`) 
		VALUES ('".$course['cnr']."', '".$course['profID']."', '".$course['longName']."', '".$course['classCode']."', 
		'".$course['section']."', '".$course['schedule']."', '".$course['instructors']."', 
		'".$course['capacity']."');";
		
		$sql="INSERT INTO `schedule`.`courses".$course['cTerm']."` 
		(`cnr`, `profID`, `longName`, `classCode`, `section`, `schedule`, 
		`instructors`, `capacity`) 
		VALUES ('".$course['cnr']."', '".$course['profID']."', '".$course['longName']."', '".$course['classCode']."', 
		'".$course['section']."', '".$course['schedule']."', '".$course['instructors']."', 
		'".$course['capacity']."');";

		
		if(mysql_query($sql))
		{
			echo"SUCCESS!!";
		}
		else
			echo"FAIL!!";
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
	public function GetPageItem()
	{
		$wholeItem = "	<input type=\"checkbox\" name=\"".$this->cnr."\">
						<tr>
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
		
		return $wholeItem."<br>";
		

		// echo "Ayşe Gül Altınay  
				// <br>
				// <br>
				// Sabancı University Campus Campus
				// <br>
				// Lecture Schedule Type
				// <br>
					   // 3.000 Credits
				// <br>
				// <a href=\"/prod/bwckctlg.p_display_courses?term_in=201402&amp;one_subj=ANTH&amp;sel_crse_strt=214&amp;sel_crse_end=214&amp;sel_subj=&amp;sel_levl=&amp;sel_schd=&amp;sel_coll=&amp;sel_divs=&amp;sel_dept=&amp;sel_attr=\">View Catalog Entry</a>
				// <br>
				// <br>
				// <table class=\"datadisplaytable\" summary=\"This table lists the scheduled meeting times and assigned instructors for this class..\"><caption class=\"captiontext\">Scheduled Meeting Times</caption>
				// <tbody><tr>
				// <th class=\"ddheader\" scope=\"col\">Type</th>
				// <th class=\"ddheader\" scope=\"col\">Time</th>
				// <th class=\"ddheader\" scope=\"col\">Days</th>
				// <th class=\"ddheader\" scope=\"col\">Where</th>
				// <th class=\"ddheader\" scope=\"col\">Date Range</th>
				// <th class=\"ddheader\" scope=\"col\">Schedule Type</th>
				// <th class=\"ddheader\" scope=\"col\">Instructors</th>
				// </tr>
				// <tr>
				// <td class=\"dddefault\">Class</td>
				// <td class=\"dddefault\">10:40 am - 1:30 pm</td>
				// <td class=\"dddefault\">M</td>
				// <td class=\"dddefault\">Fac.of Arts and Social Sci. 1001</td>
				// <td class=\"dddefault\">Feb 02, 2015 - May 15, 2015</td>
				// <td class=\"dddefault\">1st del</td>
				// <td class=\"dddefault\">Ayşe Gül Altınay (<abbr title=\"Primary\">P</abbr>)<a href=\"mailto:altinay@sabanciuniv.edu\" target=\"Ayşe Gül Altınay\"><img src=\"https://suisimg.sabanciuniv.edu/wtlgifs/web_email.gif\" align=\"middle\" alt=\"E-mail\" class=\"headerImg\" title=\"E-mail\" name=\"web_email\" hspace=\"0\" vspace=\"0\" border=\"0\" height=\"28\" width=\"28\"></a></td>
				// </tr>
				// </tbody></table>
				// <br>
				// <br>
				// </td>";

	}
	
}
?>