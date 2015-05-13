<!DOCTYPE HTML>
<html> 
<body>

<form action="AdminAddCourse.php" method="post" onsubmit="return a();">
Course Name: <input type="text" name="cName"><br>
Course Code: <input type="text" name="cCode"><br>
Section: <input type="text" name="cSection"><br>
CRN Code: 	 <input type="text" name="cCRN"><br>
Instructor Name:  <input type="text" name="cInstructorName"><br>
Instructor Surname:  <input type="text" name="cInstructorLastname"><br>
Capacity: 	 <input type="text" name="cCapacity"><br>
Credits:	 <input type="text" name="cCredits"><br>
Schedule: <input type="text" name="cSchedule"><br>
Prerequisite: <input type="text" name="prerequest"><br>
Corequisite: <input type="text" name="corerequest"><br>
<td class="delabel" scope="row"><label for="term">
<span class="fieldlabeltext">Term: </span></label>
<select name="p_term" size="1" id="term_input_id">
<option value="201403">Summer 2014-2015
</option><option value="201402">Spring 2014-2015 (View only)
</option><option value="201401">Fall 2014-2015 (View only)
</option><option value="201303">Summer 2013-2014 (View only)
</option><option value="201302">Spring 2013-2014 (View only)
</option><option value="201301">Fall 2013-2014 (View only)
</option><option value="201203">Summer 2012-2013 (View only)
</option><option value="201202">Spring 2012-2013 (View only)
</option><option value="201201">Fall 2012-2013 (View only)
</option><option value="201103">Summer 2011-2012 (View only)
</option><option value="201102">Spring 2011-2012 (View only)
</option><option value="201101">Fall 2011-2012 (View only)
</option><option value="201003">Summer 2010-2011 (View only)
</option><option value="201002">Spring 2010-2011 (View only)
</option><option value="201001">Fall 2010-2011 (View only)
</option></select>
</td>
<input type="submit">
</form>

<script>
function a()
{
    var n1=document.getElementsByName("cName")[0].value;
	var n2=document.getElementsByName("cCode")[0].value;
	var n3=document.getElementsByName("cSection")[0].value;
	var n4=document.getElementsByName("cCRN")[0].value;
	var n5=document.getElementsByName("cInstructorName")[0].value;
	var n6=document.getElementsByName("cInstructorLastname")[0].value;
	var n7=document.getElementsByName("cCapacity")[0].value;
	var n8=document.getElementsByName("cCredits")[0].value;
	var n9=document.getElementsByName("cSchedule")[0].value;
	
    if (n1.length < 1)
    {
        alert("Course name can not be blank");
        return false;
    }
	else if (n2.length < 1)
    {
        alert("Course code can not be blank");
        return false;
    }
	else if (n3.length < 1)
    {
        alert("Course section can not be blank");
        return false;
    }
	else if (n4.length < 1)
    {
        alert("Course CRN can not be blank");
        return false;
    }
	else if (n5.length < 1)
    {
        alert("Instructor name can not be blank");
        return false;
    }
	else if (n6.length < 1)
    {
        alert("Instructor surname can not be blank");
        return false;
    }
	else if (n7.length < 1)
    {
        alert("Course capacity can not be blank");
        return false;
    }
	else if (n8.length < 1)
    {
        alert("Credits can not be blank");
        return false;
    }
	else if (n9.length < 1)
    {
        alert("Schedule can not be blank");
        return false;
    }
	else{
		return true;
	}
}

</script>
</body>
</html>