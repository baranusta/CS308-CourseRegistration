<!DOCTYPE html>
<html>
<head>
	<title>ADD STUDENT</title>
	
</head>
<body>

	<BR>
	
	<FORM name = "UserForm" METHOD = "POST" ACTION = "tempAddUser.php">
	<table>
	<tr>
		<td><label>Username:</label></td>
		<td align = center><INPUT TYPE = "TEXT" placeholder = "Enter the username" NAME = "username" ></td>
		
	</tr>
	
	<tr>
		<td><label>Password:</label></td>
		<td align = center><INPUT TYPE = "TEXT" VALUE = "su1234" disabled NAME = "password"></td>
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
		<td><label>Name:</label></td>
		<td align = center><INPUT TYPE = "TEXT" placeholder = "Enter the name" NAME = "name"></td>
	</tr>
	
	<tr>
		<td><label>Last Name:</label></td>
		<td align = center><INPUT TYPE = "TEXT" placeholder = "Enter the last name" NAME = "lastname"></td>
	</tr>
	
	<tr>
		<td><label>Address:</label></td>
		<td align = center width = 100><INPUT TYPE = "TEXT" placeholder = "Enter the address" NAME = "address"></td>
	</tr>
	
	<tr>
		<td><label>Telephone Number:</label></td>
		<td align = center><INPUT TYPE = "TEXT" placeholder = "Enter the telephone number" NAME = "telNO"></td>
	</tr>
	
	<tr>
		<td><label>Faculty:</label></td>
		<td align = center><INPUT TYPE = "TEXT" placeholder = "Enter the faculty" NAME = "faculty"></td>
	</tr>
	
	<tr>
		<td><label>Major(for students only):</label></td>
		<td align = center><INPUT TYPE = "TEXT" placeholder = "Enter the major" NAME = "major"></td>
	</tr>
	
	<tr>
		<td><label>Grad. Year(for students only):</label></td>
		<td align = center><INPUT TYPE = "TEXT" placeholder = "Enter the graduation year" NAME = "gradYear"></td>
	</tr>
	
	<tr>
		<td><label>Year Entered:</label></td>
		<td align = center><INPUT TYPE = "TEXT" placeholder = "Enter the entry year" NAME = "yearEntered"></td>
	</tr>
	
	<tr>
		<td><label>Courses (for professors only):</label></td>
		<td align = center><INPUT TYPE = "TEXT" VALUE = "NULL" disabled NAME = "courses"></td>
	</tr>
	
	<tr>
		<td><label>Requests (for professors only):</label></td>
		<td align = center><INPUT TYPE = "TEXT" VALUE = "NULL" disabled NAME = "requestsProf"></td>
	</tr>
	
	<tr>
		<td><label>Registered Courses (for students only):</label></td>
		<td align = center><INPUT TYPE = "TEXT" VALUE = "NULL" disabled NAME = "regCourses"></td>
	</tr>
	
	<tr>
		<td><label>Request (for students only):</label></td>
		<td align = center><INPUT TYPE = "TEXT" VALUE = "NULL" disabled NAME = "requestsStu"></td>
	</tr>
	
		
	<tr>
		<td colspan = 2 align = right> <INPUT TYPE = "Submit" Name = "SubmitButton" VALUE ="Submit"> </td>
	</tr>
	</table>
	</FORM>
		

</body>
</html>
