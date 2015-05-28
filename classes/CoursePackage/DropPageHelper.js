


$( document ).ready(function() {
	console.log(RegisteredCourses);
	for(var Course in RegisteredCourses)
	{
		var myDiv = document.getElementById("takenCourses");
		var checkbox = document.createElement("input"); 
		checkbox.setAttribute("type", "checkbox");
		checkbox.setAttribute("name", "dd");
		checkbox.setAttribute("value", RegisteredCourses[Course][0]);
		myDiv.appendChild(checkbox); 
		var newlabel = document.createElement("Label");
		newlabel.setAttribute("for",RegisteredCourses[Course][0]);
		newlabel.innerHTML = RegisteredCourses[Course][0]+"<br>";
		myDiv.appendChild(newlabel);
		// do this after you append it
		checkbox.checked = false; 
	}
});
	
	
$('input[type=checkbox]').change(
    function(){
        if (this.checked) {
			CourseIsOk = true;
			if(checkPrerequisiteOk(Courses[this.value][0]))
			{
				if(!checkScheduleOk(Courses[this.value][0]))
				{
					CourseIsOk &= false;
					alert("Time Conflict");
					for (var i = 0, row; row = scheduleTable[i]; i++) {
						for (var j = 0, col; col = row.cells[j]; j++) {
							col.style.backgroundColor = "white";
						}  
					}
				}
				else{
					
				}
			}
			else{
				
				CourseIsOk &= false;
			}
			console.log(CourseIsOk);
			if(CourseIsOk)
			{
				checkedCourses.push(Courses[this.value][0]);
				AddToTable(Courses[this.value][0]);
			}
			else
			{	
				this.checked = false;
			}
        }
		else
		{
			var index = checkedCourses.indexOf(Courses[this.value][0]);
			if (index > -1) {
				checkedCourses.splice(index, 1);
			}
			DeleteFromTable(Courses[this.value][0]);
		}
    });