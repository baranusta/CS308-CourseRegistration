	var CourseIsOk = true;
	var checkedCourses = [];
	var CorequisiteArr = {};
	
	function valthisform()
	{
		if(SubmitAction){
			var isChecked = checkedCourses.length != 0;
			if(isChecked){
				//if there is a course that coreq is not taken
				for(var elms in CorequisiteArr){
					var isTaken = false;
					for(var taken in checkedCourses){
						if(CorequisiteArr[elms] == checkedCourses[taken]){
							isTaken = true;
						}
					}
					if(!istaken){
						alert("Corequisite is not taken");
						return false;
					}
				}
				return true;
			}
			else 
				alert("Please check a checkbox");
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
					if(!checkCorequisiteOk(Courses[this.value][0])){
						alert("You need to take " + Courses[this.value][0]["corequisites"] + " before submit.");
						CorequisiteArr[Courses[this.value][0]] = Courses[this.value][0]["corequisites"];
					}
				}
			}
			else{
				
				CourseIsOk &= false;
			}
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
			if(CorequisiteArr.hasOwnProperty(Courses[this.value][0]))
				delete CorequisiteArr[Courses[this.value][0]];
			var index = checkedCourses.indexOf(Courses[this.value][0]);
			if (index > -1) {
				checkedCourses.splice(index, 1);
			}
			DeleteFromTable(Courses[this.value][0]);
		}
    });
	
	function checkCorequisiteOk(Obj){
		if(Obj['corequisites'].length > 0){
			for (var course in RegisteredCourses) {
				if(Obj['corequisites'] == RegisteredCourses[course][0])
				{
					return true;
				}
			}
		}
		else
			return true;
		return false;
	}
	
	function checkPrerequisiteOk(Obj){
		var courseFound = false;
		console.log(Obj);
		if(Obj['prerequisites'].length > 0){
			for(var course in TakenCourses){
				if(CurrentTerm != course){
					for(var cnr in TakenCourses[course]){
				
		console.log(TakenCourses[course][cnr].shortName);
						if(Obj['prerequisites'] == TakenCourses[course][cnr].shortName)
						{
							if(TakenCourses[term][course]["grade"].length>2){
								alert("Prerequisite is not completed");
								courseFound = false;
							}
							else if(TakenCourses[term][course]["grade"]=='F')
							{
								alert("Prerequisite grade is not sufficient");
								courseFound = false;	
							}
						}
					}
				}
			}
		}
		else
			return true;

		alert("Prerequisite has not been taken");
		return false;
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
		iterOverSchedule(Obj,function(day,hour,place,name){
			scheduleTable[parseInt(hour)+1].cells[ReturnIndexOfDay(day)].innerHTML  = name;
			
			if(!Schedule.hasOwnProperty(day))
				Schedule[day] = {};
			Schedule[day][hour] = place + "," + name;
			return true;
		});
	}
	
	function DeleteFromTable(Obj){
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
					courseScheduleOk &= whatToDo(Day,j,Obj.schedule[i]["place"],Obj["shortName"]);
				}
			}
		}
		return courseScheduleOk;
	}
	
	