<?php
include_once 'Student.php';
session_start();
	if(!isset($_SESSION['userName'])){
		header("location:../../main_login.php");
	}
	else{
		$User = $_SESSION['myUser'];
	}
	$withLocation = true;
	$cTerm = $_SESSION['ActiveTerm'];
?>

<head>
<style>
th, td {
    border: 1px solid black;
    overflow: hidden;
    width: 100px;
    height: 30px;
}
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="../FillSchedule.js"></script>
<script type="text/javascript">

var Schedule = <?php echo json_encode($User->GetSchedule($cTerm)); ?>;
var withLocation = <?php echo $withLocation; ?>;

</script>
</head>
<body>
<div class="Right_Part" style="float:left; width:50%; ">
<table id="schedule" border="1" style="width:100%;border-collapse: collapse; ">
  <tr>
    <td>Monday</td>
    <td>Tuesday</td> 
    <td>Wednesday</td>
    <td>Thursday</td>
    <td>Friday</td> 
  </tr>
  <tr>
    <td></td>
    <td></td> 
    <td></td>
    <td></td>
    <td></td> 
    <td>8:40-9.30 am</td> 
  </tr>
  <tr>
    <td></td>
    <td></td> 
    <td></td>
    <td></td>
    <td></td> 
    <td>9:40-10.30 am</td> 
  </tr>
  <tr>
    <td></td>
    <td></td> 
    <td></td>
    <td></td>
    <td></td> 
    <td>10:40-11.30 am</td> 
  </tr>
  <tr>
    <td></td>
    <td></td> 
    <td></td>
    <td></td>
    <td></td> 
    <td>11:40-12.30 am</td> 
  </tr>
  <tr>
    <td></td>
    <td></td> 
    <td></td>
    <td></td>
    <td></td> 
    <td>12:40 am-1.30 pm</td> 
  </tr>
  <tr>
    <td></td>
    <td></td> 
    <td></td>
    <td></td>
    <td></td>
    <td>1:40-2.30 pm</td>  
  </tr>
  <tr>
    <td></td>
    <td></td> 
    <td></td>
    <td></td>
    <td></td> 
    <td>2:40-3.30 pm</td> 
  </tr>
  <tr>
    <td></td>
    <td></td> 
    <td></td>
    <td></td>
    <td></td> 
    <td>3:40-4.30 pm</td> 
  </tr>
  <tr>
    <td></td>
    <td></td> 
    <td></td>
    <td></td>
    <td></td> 
    <td>4:40-5.30 pm</td> 
  </tr>
  <tr>
    <td></td>
    <td></td> 
    <td></td>
    <td></td>
    <td></td> 
    <td>5:40-6.30 pm</td> 
  </tr>
  <tr>
    <td></td>
    <td></td> 
    <td></td>
    <td></td>
    <td></td>
    <td>6:40-7.30 pm</td>  
  </tr>
</table> 
</div>
<form action="StudentFirstPage.php">
    <input type="submit" value="Done">
</form>
</body>