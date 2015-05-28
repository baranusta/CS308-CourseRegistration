	var CourseIsOk = true;
	var checkedCourses = [];
	
	function valthisform()
	{
		if(SubmitAction){
			var checkboxs=document.getElementsByName("cnr[]");
			var isChecked = checkedCourses.length != 0;
			if(isChecked)	return true;
			else alert("Please check a checkbox");
			return false;
		}
		else
			return true;
		
	}
	
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
	
	function checkPrerequisiteOk(Obj){
		var courseFound = false;
		for (var term in TakenCourses) {
			for(var course in TakenCourses[term]){
				if(Obj['prerequisites'] == course["shortName"])
				{
					if(TakenCourses[term][course]["grade"].length>2){
						alert("Prerequisite is not completed");
						return true;
					}
					else if(TakenCourses[term][course]["grade"].length==1 && TakenCourses[term][course]["grade"]<='D')
					{
						alert("Prerequisite grade is not sufficient");
						return true;	
					}
					courseFound = true;
				}
			}
		}
		//if program comes to that point
		// case1: Course found but not sufficient grade
		// case2: CourseNotFound
		return !courseFound;
	}
	
	function checkCorequisiteOk(Obj){
		//Corequisites should not be checked at that stage. We will check this if user submits
	}
	
	function checkScheduleOk(Obj){
		return iterOverSchedule(Obj,function(day,hour,place,name){
			if(Schedule.hasOwnProperty(day) && Schedule[day].hasOwnProperty(hour))
			{
				scheduleTable[parseInt(hour)+1].cells[ReturnIndexOfDay(day)].style.backgroundColor = "red";
				return false;	
			}
			else
				return true;
		});
	}
	
	function AddToTable(Obj){
		console.log(Schedule);
		iterOverSchedule(Obj,function(day,hour,place,name){
			scheduleTable[parseInt(hour)+1].cells[ReturnIndexOfDay(day)].innerHTML  = name;
			if(!Schedule.hasOwnProperty(day))
				Schedule[day] = {};
			Schedule[day][hour] = place + "," + name;
			return true;
		});
	}
	
	function DeleteFromTable(Obj){
		console.log(Schedule);
		iterOverSchedule(Obj,function(day,hour,place,name){
			scheduleTable[parseInt(hour)+1].cells[ReturnIndexOfDay(day)].innerHTML = "";
			delete Schedule[day][hour];
			return true;
		});
	}
	
	function iterOverSchedule(Obj,whatToDo){
		var courseScheduleOk = true;
		for(var i=0 ; i<Obj.schedule.length ; i++){
			if(Obj.schedule[i]["time"] != "TBA")
			{
			var Time = Obj.schedule[i]["time"].split("-");
			var Day = Obj.schedule[i]["day"];
			//we need to map the pm am to array index
			var StartTime = Time[0].split(":")[0] - 8;
			var EndTime = Time[1].split(":")[0] - 8;
			if(StartTime<0)
				StartTime+=12;
			if(EndTime<0)
				EndTime+=12;
			
				for(var j = StartTime; j<EndTime ;j++){
					courseScheduleOk = whatToDo(Day,j,Obj.schedule[i]["place"],Obj["shortName"]);
				}
			}
		}
		return courseScheduleOk;
	}
	
	