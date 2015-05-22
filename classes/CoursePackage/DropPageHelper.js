

	var CorequisiteArr = {};
	var checkedCourses = [];
	function valthisform(){
		for(var elms in CorequisiteArr){
					var isDropped = false;
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
	}
	
$( document ).ready(function() {
	console.log(RegisteredCourses);
	for(var Course in RegisteredCourses)
	{
		var myDiv = document.getElementById("takenCourses");
		var checkbox = document.createElement("input"); 
		checkbox.setAttribute("type", "checkbox");
		checkbox.setAttribute("name", "cnr[]");
		checkbox.setAttribute("value", RegisteredCourses[Course][3]);
		myDiv.appendChild(checkbox); 
		var newlabel = document.createElement("Label");
		newlabel.setAttribute("for",RegisteredCourses[Course][3]);
		var schedule = "";
		for(var each in RegisteredCourses[Course][2]){
			schedule += RegisteredCourses[Course][2][each].day + ": " + RegisteredCourses[Course][2][each].time + " ";
		}
		newlabel.innerHTML = RegisteredCourses[Course][0] +"  " + RegisteredCourses[Course][1]+"<br>" + schedule +  "<br><br>";
		myDiv.appendChild(newlabel);
		// do this after you append it
		checkbox.checked = false; 
	}
});
	
	
$('input[type=checkbox]').change(
    function(){
		console.log("up");
        if (this.checked) {
			if(!checkCorequisiteOk(Courses[this.value][0]))
			{
				alert("Please drop also" + Courses[this.value][0]["corequisites"] + "of that course");
				CorequisiteArr[Courses[this.value][0]] = Courses[this.value][0]["corequisites"];
				checkedCourses.push(Courses[this.value][0]);
			}
        }
		else
		{
			checkedCourses.push(Courses[this.value][0]);
			if(CorequisiteArr.hasOwnProperty(Courses[this.value][0]))
				delete CorequisiteArr[Courses[this.value][0]];
		}
    });
	
	
	function checkCorequisiteOk(Obj){
		if(Obj['corequisites'].length > 0){
			for (var course in RegisteredCourses) {
				console.log(RegisteredCourses[course]);
				
				console.log(Obj['corequisites']);
				if(Obj['corequisites'] == RegisteredCourses[course][0])
				{
					return false;
				}
			}
		}
		else
			return true;
		return false;
	}
	