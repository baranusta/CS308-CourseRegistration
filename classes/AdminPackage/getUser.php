<!DOCTYPE html>
<html>
<head>
	<title>ADD STUDENT</title>
	
</head>
<body>

	<BR>
	
	<FORM name = "UserForm" METHOD = "POST" ACTION = "tempGetUser.php">
	<table>
	<tr>
		<td><label>Username:</label></td>
		<td align = center><INPUT TYPE = "TEXT" placeholder = "Enter the username" NAME = "username" ></td>
	</tr>
		
	<tr>
		<td><label for = 'formType'>Type:</label></td>
		<td>
		<select name = "formType">
			<option value ="A">Admin</option>
			<option value ="P">Professor</option>
			<option value ="S">Student</option>
		</select></td>
	</tr>	
		
	<tr>
		<td colspan = 2 align = right> <INPUT TYPE = "Submit" Name = "SubmitButton" VALUE ="Submit"> </td>
	</tr>
	</table>
	</FORM>
		

</body>
</html>
