function onCalculateServiceFees() {
	var
		aircraftTotalFee = 0,
		aircraftWeight,
		aircraftTurns
	;

	aircraftWeight = document.getElementById("aircraftWeight").value;
	aircraftTurns = document.getElementById("aircraftTurns").value;

	if(aircraftWeight !== "" && aircraftTurns !== "" && aircraftTurns >= 1) {
		if(aircraftWeight < 5000) {
			aircraftTotalFee += 313 * aircraftTurns;
		}
		else if(aircraftWeight >= 5000 && aircraftWeight < 10000) {
			aircraftTotalFee += 600 * aircraftTurns;
		}
		else  if(aircraftWeight >= 10000) {
			aircraftTotalFee += 1300 * aircraftTurns;
		}
	}
	if(aircraftTotalFee > 0) {
		window.alert("aircraftTotalFee: " + aircraftTotalFee + " olo " + aircraftWeight);
	}
}