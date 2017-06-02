function onCalculateServiceFees() {
	var
		aircraftTotalFee = 0,
		aircraftWeight,
		aircraftTurns,
		wheelchairQuantity,
		wheelchairTime,
		airbridgeQuantity,
		airbridgeTime,
		HLQuantity,
		HLTime
	;

	aircraftWeight = document.getElementById("aircraftWeight").value;
	aircraftTurns = document.getElementById("aircraftTurns").value;
	wheelchairQuantity = document.getElementById("quantityWheelchair").value;
	wheelchairTime = document.getElementById("timeWheelchair").value;
	airbridgeQuantity = document.getElementById("quantityAirbridge").value;
	airbridgeTime = document.getElementById("timeAirbridge").value;
	HLQuantity = document.getElementById("quantityHL").value;
	HLTime = document.getElementById("timeHL").value;

	if(aircraftWeight !== "" && aircraftTurns !== "" && aircraftTurns >= 1) {
		if(aircraftWeight < 5000) {
			aircraftTotalFee += 313 * aircraftTurns;
		}
		else if(aircraftWeight >= 5000 && aircraftWeight < 10000) {
			aircraftTotalFee += 600 * aircraftTurns;
		}
		else if(aircraftWeight >= 10000) {
			aircraftTotalFee += 1300 * aircraftTurns;
		}
	}
	if(wheelchairQuantity > 0 && wheelchairTime > 0) {
		aircraftTotalFee += wheelchairTime * 5;
	}
	if(airbridgeQuantity > 0 && airbridgeTime > 0) {
		aircraftTotalFee += airbridgeTime * 5;
	}
	if(HLQuantity > 0 && HLTime > 0) {
		aircraftTotalFee += HLTime * 350;
	}
	if(aircraftTotalFee > 0) {
		window.alert("aircraftTotalFee: " + aircraftTotalFee);
	}
}