var carrier = <?php echo json_encode($carrier);?>;
console.log(carrier);

if(carrier) {
	var mySelect = document.getElementById('cargoEntryCarrier');

	for(var i, j = 0; i = mySelect.options[j]; j++) {
		console.log(i.value);
	    if(i.value == carrier) {
	        mySelect.selectedIndex = j;
	        break;
	    }
	}
}