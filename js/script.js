
(function() {

	$('.knapputgift').click(function(event) {
		event.preventDefault();
		$('.knapputgift').addClass('showknapputgiftaktiv');
		$('.knappinkomst').removeClass('showknappinkomstaktiv');
		$('.utgift').addClass('showutgift');
		$('.utgift').removeClass('hide');
		$('.inkomst').addClass('hide');
		console.log($this);
	});

	$('.knappinkomst').click(function(event) {
		event.preventDefault();
		$('.knappinkomst').addClass('showknappinkomstaktiv');
		$('.knapputgift').removeClass('showknapputgiftaktiv');
		$('.inkomst').addClass('showinkomst');
		$('.inkomst').removeClass('hide');
		$('.utgift').addClass('hide');
	});

})();
<<<<<<< HEAD

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
=======
>>>>>>> 1aac83de4f09a446ed1457301cc7ed913e8f7fdc
