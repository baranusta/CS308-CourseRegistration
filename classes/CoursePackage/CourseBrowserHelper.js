	var CourseIsOk = true;
	var checkedCourses = [];
	function valthisform()
	{
		if(CourseIsOk)
		{
			var checkboxs=document.getElementsByName("cnr[]");
			console.log(User);
			var isChecked = checkedCourses.length != 0;
			if(isChecked)	return true;
			else alert("Please check a checkbox");
			return false;
		}
		else
			return false;
	}
	
	$('input[type=checkbox]').change(
    function(){
        if (this.checked) {
			CourseIsOk = true;
			if(!checkPrerequisiteOk(Courses[this.value][0]))
			{
				CourseIsOk &= false;
				alert("Prerequisite is not completed");
			}
			if(!checkCorequisiteOk(Courses[this.value][0]))
			{
				CourseIsOk &= false;
				alert("Corequisite is not currently taken");
			}
			if(!checkScheduleOk(Courses[this.value][0]))
			{
				CourseIsOk &= false;
				alert("Time Conflict");
			}
			if(CourseIsOk)
				checkedCourses.push(Courses[this.value][0]);
			else
				this.checked = false;
        }
		else
		{
			var index = checkedCourses.indexOf(Courses[this.value][0]);
			if (index > -1) {
				checkedCourses.splice(index, 1);
			}
		}
		
            console.log(checkedCourses[0]);
    });
	
	function checkPrerequisiteOk(Obj){
		return true;
	}
	
	function checkCorequisiteOk(Obj){
		return true;
	}
	
	function checkScheduleOk(Obj){
		return true;
	}