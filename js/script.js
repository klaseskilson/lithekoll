
(function() {

	$('.knapputgift').click(function(event) {
		event.preventDefault();
		$('.knapputgift').addClass('showutgift');
		$('.utgift').addClass('showutgift');
		$('.utgift').removeClass('hide');
		$('.inkomst').addClass('hide');
		$('#submitu').attr("name", "submitu");
		console.log($this);
	});

	$('.knappinkomst').click(function(event) {
		event.preventDefault();
		$('.knappinkomst').addClass('showinkomst');
		$('.inkomst').addClass('showinkomst');
		$('.inkomst').removeClass('hide');
		$('.utgift').addClass('hide');
		$('#submitu').attr("name", "submiti");
	});

})();

jQuery.validator.addMethod(
	'positiveNumber',
	function(value) {
		return Number(value) > 0;
	},
	'Enter a positive number.'
);

$(document).ready(function() { 
	$("#inputform").validate({
// Hantera felmeddelanden
/*
		errorLabelContainer: "#transaktionsError",
		wrapper: "li",
*/
		rules: { 
			usum: {
				required: true,
				positiveNumber: true
			},
			isum: {
				required: true,
				positiveNumber: true
			},
		}, 
		messages: { 
			usum: {
				required: "Skrifv in något.",
				positiveNumber: "Skrifv ett positivt nummer."
			},
			isum: {
				required: "Skrifv in något.",
				positiveNumber: "Skrifv ett positivt nummer."
			}
		} 
	});
});