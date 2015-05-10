<!DOCTYPE HTML>
<html> 
<body>

<form action="AdminAddCourse.php" method="post">
Course Name: <input type="text" name="cName"><br>
Course Code: <input type="text" name="cCode"><br>
Section: <input type="text" name="cSection"><br>
CRN Code: 	 <input type="text" name="cCRN"><br>
Instructor Name:  <input type="text" name="cInstructorName"><br>
Instructor Last name:  <input type="text" name="cInstructorLastname"><br>
Capacity: 	 <input type="text" name="cCapacity"><br>
Credits:	 <input type="text" name="cCredits"><br>
Schedule: <input type="text" name="cSchedule"><br>
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

</body>
</html>