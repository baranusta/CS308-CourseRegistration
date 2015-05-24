<!DOCTYPE html>
<html>
<head>
	<title>MODIFY USER</title>
	
</head>
<body>

	<h2><strong>MODIFY USER INFO:</strong></h2>
	
<?php
include_once ('DBFunctions.php');
if (!empty ($_POST['userid'])) //check if any "userid" is entered
{
	$userid = $_POST['userid']; //gets the userid
}
else 
{
	return;
}

DBFunctions::SetRemoteConnection();
$query = "SELECT * FROM schedule.personalinfo where schedule.personalinfo.user_id = \"$userid\"";
$result = mysql_query($query);
$row = mysql_fetch_assoc($result);
DBFunctions::CloseConnection();

if (mysql_num_rows($result) == 0)
{	
	header ("location: NotFound.php");
}
else
{
DBFunctions::SetRemoteConnection();
$query2 = "SELECT * FROM schedule.user where schedule.user.user_id = \"$userid\"";
$result2 = mysql_query($query2);
$row2 = mysql_fetch_assoc($result2);

DBFunctions::CloseConnection();
$name = $row['name'];
$surname = $row['surname'];
$address = $row['address'];
$telephone = $row['telephone'];
$faculty = $row['faculty'];

$type = $row2['type'];
$username = $row2['username'];
if ($type == 'S') // if the user student major and graduation year are taken separately
{
	DBFunctions::SetRemoteConnection();
	$query3 = "SELECT * FROM schedule.student where schedule.student.stu_id = \"$userid\"";
	$result3 = mysql_query($query3);
	$row3 = mysql_fetch_assoc($result3);
	DBFunctions::CloseConnection();
	
	$major = $row3['major'];
	$gradYear = $row3['grad_year'];
}
elseif ($type == 'P') // if the user is professor there is no major and graduation year
{
	$major = null;
	$gradYear = null;
}	
else // if the user selected is admin
{
	return;
}
}
?>
	
	
	<table>
	<FORM name = "UserForm" METHOD = "POST" ACTION = "tempModifyUser.php">
	<p>
	1. Fill in the blanks with the updates of the user (ID and username cannot be changed)</br>
	2. Click on the UPDATE button to submit changes
	
	<tr>
		<td><label>User ID:</label></td>
		<td align = center><INPUT TYPE = "TEXT" VALUE = "<?php echo $userid ?>" readonly NAME = "uid"></td>
		</tr>
	
	<tr>
		<td><label>Username:</label></td>
		<td align = center><INPUT TYPE = "TEXT" VALUE = "<?php echo $username ?>" readonly NAME = "uname"></td>
	</tr>
	
	<tr>
		<td><label>Name:</label></td>
		<td align = center><INPUT TYPE = "TEXT" VALUE = "<?php echo $name ?>" readonly NAME = "stableName"></td>
		<td align = center><INPUT TYPE = "TEXT" NAME = "name"></td>
	</tr>
	
	<tr>
		<td><label>Last Name:</label></td>
		<td align = center><INPUT TYPE = "TEXT" VALUE = "<?php echo $surname ?>" readonly NAME = "stableLastname"></td>
		<td align = center><INPUT TYPE = "TEXT" NAME = "lastname"></td>
	</tr>
	
	<tr>
		<td><label>Address:</label></td>
		<td align = center width = 100><INPUT TYPE = "TEXT" VALUE = "<?php echo $address ?>" readonly NAME = "stableAddress"></td>
		<td align = center><INPUT TYPE = "TEXT" NAME = "address"></td>
	</tr>
	
	<tr>
		<td><label>Telephone Number:</label></td>
		<td align = center><INPUT TYPE = "TEXT" VALUE = "<?php echo $telephone ?>" readonly NAME = "stableTelNO"></td>
		<td align = center><INPUT TYPE = "TEXT" NAME = "telNO"></td>
	</tr>
	
	<tr>
		<td><label>Faculty:</label></td>
		<td align = center><INPUT TYPE = "TEXT" VALUE = "<?php echo $faculty ?>" readonly NAME = "stableFaculty"></td>
		<td align = center><INPUT TYPE = "TEXT" NAME = "faculty"></td>
	</tr>
	
	<tr>
		<td><label>Major:</label></td>
		<td align = center><INPUT TYPE = "TEXT" VALUE = "<?php echo $major ?>" readonly NAME = "stableMajor"></td>
		<td align = center><INPUT TYPE = "TEXT" NAME = "major"></td>
	</tr>
	
	<tr>
		<td><label>Grad. Year:</label></td>
		<td align = center><INPUT TYPE = "TEXT" VALUE = "<?php echo $gradYear ?>" NAME = "stableGradYear"></td>
		<td align = center><INPUT TYPE = "TEXT" NAME = "gradYear"></td>
	</tr>
		
	<tr>
		<td colspan = 3 align = right> <INPUT TYPE = "Submit" Name = "SubmitButton" VALUE ="UPDATE"> </td>
	</tr>
	</FORM>
	<FORM action = "../../../homePage.html">
		<td colspan = 3 align = right> <INPUT TYPE = "Submit" Name = "SubmitButton" VALUE ="HOME PAGE"> </td>
	</FORM>
	</table>
	
	
		

</body>
</html>