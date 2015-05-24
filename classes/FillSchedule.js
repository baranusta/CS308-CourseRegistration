var scheduleTable;

	$( document ).ready(function() {
		scheduleTable = document.getElementById('schedule').rows;
		console.log(Schedule);
		for (var day in Schedule) {
			if (Schedule.hasOwnProperty(day)) {
				fillSchedule(scheduleTable,ReturnIndexOfDay(day),Schedule[day]);
			}
		}
	});
	
	function fillSchedule(table,columnInd,day){
		if(withLocation)
		{
			for (var hour in day) {
				if (day.hasOwnProperty(hour)) {
					var Info = day[hour].split(",");
					table[parseInt(hour)+1].cells[columnInd].innerHTML  = Info[1] + "\n\r" + Info[0];
				}
			}
		}
		else{
			for (var hour in day) {
				if (day.hasOwnProperty(hour)) {
					table[parseInt(hour)+1].cells[columnInd].innerHTML  = day[hour].split(",")[1];
				}
			}
		}
	}
	
	function ReturnIndexOfDay(day){
		switch(day){
			case 'M':
				return 0;
			case 'T':
				return 1;
			case 'W':
				return 2;
			case 'R':
				return 3;
			case 'F':
				return 4;
			default:
			break;
		}
	}