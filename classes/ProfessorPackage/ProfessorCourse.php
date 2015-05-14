<?php
class ProfessorCourse
{
	public function __construct(){}
	public function AddCourse($Course)
	{
		$sql = "Select p.courses From schedule.professor p Where p.prof_id = '".$Course['profID']."';";
		$result = mysql_query($sql);
		if ($row = mysql_fetch_array($result)) {
			echo "<br><br>";
			var_dump($row);
		var_dump($row[0]);
		//echo "<br><br>";
		//echo $row[0][		]];
/* 			$arrmodified = json_encode($row[0]);
		var_dump($arrmodified); */
		//echo "<br><br>";			
		$arrmodified = json_decode($row[0], true);
		//var_dump($arrmodified['201402']);
		$intvalue = intval($Course['cnr']);
		array_push($arrmodified[$Course['cTerm']], $intvalue);
		$arrayfinal = json_encode($arrmodified);
		echo "<br><br>";
		//var_dump($arrmodified['201402']);
		
		$sql = "UPDATE `schedule`.`professor` SET `courses`='".$arrayfinal."' WHERE `prof_id`='".$Course['profID']."';";
		if(mysql_query($sql))
		{
			return true;
		}
		return false;
		//var_dump($row);
		}
	}
	public function EnterGrade($Course,$Student,$Grade)
	{
		
	}
		
	public function AnswerRequest($req)
	{
		//Buralarý nasý yapsak bilemedim. Sýkýntýlar mevcudðð.
	}
}
?>

