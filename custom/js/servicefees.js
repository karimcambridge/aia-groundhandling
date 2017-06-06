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

	aircraftWeight			= document.getElementById("aircraftWeight").value;
	aircraftTurns			= document.getElementById("aircraftTurns").value;
	wheelchairQuantity		= document.getElementById("quantityWheelchair").value;
	wheelchairTime			= document.getElementById("timeWheelchair").value;
	airbridgeQuantity		= document.getElementById("quantityAirbridge").value;
	airbridgeTime			= document.getElementById("timeAirbridge").value;
	HLQuantity				= document.getElementById("quantityHL").value;
	HLTime					= document.getElementById("timeHL").value;
	quantityGPU				= document.getElementById("quantityGPU").value;
	timeGPU					= document.getElementById("timeGPU").value;
	quantityACU				= document.getElementById("quantityACU").value;
	timeACU					= document.getElementById("timeACU").value;
	quantityBgeBelt			= document.getElementById("quantityBgeBelt").value;
	timeBgeBelt				= document.getElementById("timeBgeBelt").value;
	quantityBgeCart			= document.getElementById("quantityBgeCart").value;
	timeBgeCart				= document.getElementById("timeBgeCart").value;
	quantityTractor			= document.getElementById("quantityTractor").value;
	timeTractor				= document.getElementById("timeTractor").value;
	quantityPaxStairs		= document.getElementById("quantityPaxStairs").value;
	timePaxStairs			= document.getElementById("timePaxStairs").value;
	quantityACMntxEquipment = document.getElementById("quantityACMntxEquipment").value;
	timeACMntxEquipment		= document.getElementById("timeACMntxEquipment").value;
	quantityTurns			= document.getElementById("quantityTurns").value;
	quantityPayload			= document.getElementById("quantityPayload").value;
	quantityTowbar			= document.getElementById("quantityTowbar").value;
	quantityASU				= document.getElementById("quantityASU").value;
	quantitySewage			= document.getElementById("quantitySewage").value;
	quantityPortableWater	= document.getElementById("quantityPortableWater").value;

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
	if(quantityGPU > 0 && timeGPU > 0) {
		aircraftTotalFee += timeGPU * 5;
	}
	if(quantityACU > 0 && timeACU > 0) {
		aircraftTotalFee += timeACU * 5;
	}
	if(quantityBgeBelt > 0 && timeBgeBelt > 0) {
		aircraftTotalFee += timeBgeBelt * 5;
	}
	if(quantityBgeCart > 0 && timeBgeCart > 0) {
		aircraftTotalFee += timeBgeCart * 5;
	}
	if(quantityTractor > 0 && timeTractor > 0) {
		aircraftTotalFee += timeTractor * 5;
	}
	if(quantityPaxStairs > 0 && timePaxStairs > 0) {
		aircraftTotalFee += timePaxStairs * 5;
	}
	if(quantityACMntxEquipment > 0 && timeACMntxEquipment > 0) {
		aircraftTotalFee += timeACMntxEquipment * 5;
	}
	if(quantityTurns > 0) {
		aircraftTotalFee += quantityTurns * 5;
	}
	if(quantityPayload > 0) {
		aircraftTotalFee += quantityPayload * 5;
	}
	if(quantityTowbar > 0) {
		aircraftTotalFee += quantityTowbar * 5;
	}
	if(quantityASU > 0) {
		aircraftTotalFee += quantityASU * 5;
	}
	if(quantitySewage > 0) {
		aircraftTotalFee += quantitySewage * 5;
	}
	if(quantityPortableWater > 0) {
		aircraftTotalFee += quantityPortableWater * 5;
	}
	if(aircraftTotalFee > 0) {
		var servicefeeout = document.getElementById('servicefeeout');
		servicefeeout.innerHTML = "lol " + aircraftTotalFee;
	}
}