function onCalculateServiceFees() {
	var
		aircraftTotalFee = 0,
		unscheduled,
		overtimeRate = 1.0,
		aircraftType,
		aircraftTypeStr,
		aircraftWeight,
		wheelchairQuantity,
		wheelchairTime,
		HLQuantity,
		HLTime,
		quantityGPU,
		timeGPU,
		quantityACU,
		timeACU,
		quantityBgeBelt,
		timeBgeBelt,
		quantityBgeCart,
		timeBgeCart,
		quantityTractor,
		timeTractor,
		quantityPaxStairs,
		timePaxStairs,
		quantityACMntxEquipment,
		timeACMntxEquipment,
		quantityTurns,
		quantityPayload,
		quantityTowbar,
		quantityASU,
		quantitySewage,
		quantityPortableWater
	;

	aircraftWeight			=	document.getElementById("aircraftWeight").value;
	wheelchairQuantity		=	document.getElementById("quantityWheelchair").value;
	wheelchairTime			=	document.getElementById("timeWheelchair").value;
	HLQuantity				=	document.getElementById("quantityHL").value;
	HLTime					=	document.getElementById("timeHL").value;
	quantityGPU				=	document.getElementById("quantityGPU").value;
	timeGPU					=	document.getElementById("timeGPU").value;
	quantityACU				=	document.getElementById("quantityACU").value;
	timeACU					=	document.getElementById("timeACU").value;
	quantityBgeBelt			=	document.getElementById("quantityBgeBelt").value;
	timeBgeBelt				=	document.getElementById("timeBgeBelt").value;
	quantityBgeCart			=	document.getElementById("quantityBgeCart").value;
	timeBgeCart				=	document.getElementById("timeBgeCart").value;
	quantityTractor			=	document.getElementById("quantityTractor").value;
	timeTractor				=	document.getElementById("timeTractor").value;
	quantityPaxStairs		=	document.getElementById("quantityPaxStairs").value;
	timePaxStairs			=	document.getElementById("timePaxStairs").value;
	quantityACMntxEquipment =	document.getElementById("quantityACMntxEquipment").value;
	timeACMntxEquipment		=	document.getElementById("timeACMntxEquipment").value;
	quantityTurns			=	document.getElementById("quantityTurns").value;
	quantityPayload			=	document.getElementById("quantityPayload").value;
	quantityTowbar			=	document.getElementById("quantityTowbar").value;
	quantityASU				=	document.getElementById("quantityASU").value;
	quantitySewage			=	document.getElementById("quantitySewage").value;
	quantityPortableWater	=	document.getElementById("quantityPortableWater").value;
	unscheduled				=	document.getElementById('unscheduled').checked;
	aircraftType			=	document.getElementById("aircraftType");
	aircraftTypeStr			=	aircraftType.options[aircraftType.selectedIndex].text;

	if(wheelchairQuantity > 0 && wheelchairTime > 0) {
		aircraftTotalFee += (wheelchairTime * 5) * overtimeRate;
	}
	if(HLQuantity > 0 && HLTime > 0) {
		aircraftTotalFee += (HLTime * 350) * overtimeRate;
	}
	if(quantityGPU > 0 && timeGPU > 0) {
		aircraftTotalFee += (timeGPU * 145) * overtimeRate;
	}
	if(quantityACU > 0 && timeACU > 0) {
		aircraftTotalFee += (timeACU * 174) * overtimeRate;
	}
	if(quantityBgeBelt > 0 && timeBgeBelt > 0) {
		aircraftTotalFee += (timeBgeBelt * 126) * overtimeRate;
	}
	if(quantityBgeCart > 0 && timeBgeCart > 0) {
		aircraftTotalFee += (timeBgeCart * 39) * overtimeRate;
	}
	if(quantityTractor > 0 && timeTractor > 0) {
		aircraftTotalFee += (timeTractor * 140) * overtimeRate;
	}
	if(quantityPaxStairs > 0 && timePaxStairs > 0) {
		aircraftTotalFee += (timePaxStairs * 318) * overtimeRate;
	}
	if(quantityACMntxEquipment > 0 && timeACMntxEquipment > 0) {
		aircraftTotalFee += (timeACMntxEquipment * 176) * overtimeRate;
	}
	if(quantityTurns > 0) {
		if(unscheduled == true) {
			aircraftTotalFee += (quantityTurns * ((aircraftTypeStr === "Narrow Body") ? 1850 : 2000)) * overtimeRate;
		} else {
			if(aircraftWeight === 0 || aircraftWeight === "" || aircraftWeight == undefined) {
				alert("Please enter the aircrafts' weight.")
			} else {
				if(aircraftWeight < 5000) {
					aircraftTotalFee += (313 * quantityTurns) * overtimeRate;
				}
				else if(aircraftWeight >= 5000 && aircraftWeight < 10000) {
					aircraftTotalFee += (600 * quantityTurns) * overtimeRate;
				}
				else if(aircraftWeight >= 10000) {
					aircraftTotalFee += (1300 * quantityTurns) * overtimeRate;
				}
			}
		}
	}
	if(quantityPayload > 0) {
		aircraftTotalFee += (quantityPayload * 328) * overtimeRate;
	}
	if(quantityTowbar > 0) {
		aircraftTotalFee += (quantityTowbar * 55) * overtimeRate;
	}
	if(quantityASU > 0) {
		aircraftTotalFee += (quantityASU * 360) * overtimeRate;
	}
	if(quantitySewage > 0) {
		aircraftTotalFee += (quantitySewage * 180) * overtimeRate;
	}
	if(quantityPortableWater > 0) {
		aircraftTotalFee += (quantityPortableWater * 178) * overtimeRate;
	}
	if(aircraftTotalFee > 0) {
		var servicefeeout = document.getElementById('servicefeeout');
		if(servicefeeout != null) {
			servicefeeout.innerHTML = "Total Service Fee: <font color='red'>$" + aircraftTotalFee.toFixed(2) + "</font>";
		}
	}
}