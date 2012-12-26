
(function() {

	$('.utgiftlink').click(function(event) {
		event.preventDefault();
		$('.utgiftlink').addClass('fokus');
		$('.inkomstlink').removeClass('fokus');
		$('.utgift').show();
		$('.inkomst').hide();
		console.log($this);
	});

	$('.inkomstlink').click(function(event) {
		event.preventDefault();
		$('.utgiftlink').removeClass('fokus');
		$('.inkomstlink').addClass('fokus');
		$('.utgift').hide();
		$('.inkomst').show();
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
