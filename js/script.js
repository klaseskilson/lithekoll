
(function() {

	$('.utgiftlink').click(function(event) {
		event.preventDefault();
		$('.utgiftlink').addClass('fokus');
		$('.inkomstlink').removeClass('fokus');
		$('.utgift').show();
		$('.inkomst').hide();
		$('#errorlist').empty();
		console.log($this);
	});

	$('.inkomstlink').click(function(event) {
		event.preventDefault();
		$('.utgiftlink').removeClass('fokus');
		$('.inkomstlink').addClass('fokus');
		$('.utgift').hide();
		$('.inkomst').show();
		$('#errorlist').empty();
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
	$(".transform").validate({
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
				required: "Skriv in en summa",
				positiveNumber: "Skriv in en positiv summa"
			},
			isum: {
				required: "Skriv in en summa",
				positiveNumber: "Skriv in en positiv summa"
			}
		},
		

		

        errorPlacement: function(error, element) {
        error.appendTo('#errorlist');
    },


	
	});
});
