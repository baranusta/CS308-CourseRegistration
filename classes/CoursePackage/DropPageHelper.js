

	var CorequisiteArr = {};
	var checkedCourses = [];
	function valthisform(){
		for(var elms in CorequisiteArr){
					var isDropped = false;
					for(var taken in checkedCourses){
						if(CorequisiteArr[elms] == checkedCourses[taken]){
							isDropped = true;
						}
					}
					console.log(checkedCourses);
					console.log(CorequisiteArr);
					if(!isDropped){
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
		checkbox.setAttribute("value", Course + "," + RegisteredCourses[Course][3]);
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
	$('input[type=checkbox]').change(
    function(){
			var val = this.value.split(",")[0];
        if (this.checked) {
			if(!checkCorequisiteOk(RegisteredCourses[val]))
			{
				alert("Please drop also" + RegisteredCourses[val][4] + "of that course");
				CorequisiteArr[RegisteredCourses[val][0]] = RegisteredCourses[val][4];
				checkedCourses.push(RegisteredCourses[val][0]);
			}
        }
		else
		{
			var index = checkedCourses.indexOf(RegisteredCourses[val][0]);
			if (index > -1) {
				checkedCourses.splice(index, 1);
			}
			if(CorequisiteArr.hasOwnProperty(RegisteredCourses[val][0]))
				delete CorequisiteArr[RegisteredCourses[val][0]];
		}
    });
});
	
	

	
	
	function checkCorequisiteOk(Obj){
		console.log(Obj);
		if(Obj[0].length > 0){
			for (var course in RegisteredCourses) {
				if(Obj[0] == RegisteredCourses[course][4])
				{
					return false;
				}
			}
		}
		else
			return true;
		return false;
	}
	