// jobba bara om allt på sidan är laddat
$(document).ready(function()
{
	//Döljer och visar divar när man klickar på utgiftflik
	$('.utgiftlink').click(function(event) {
		event.preventDefault();
		$('.utgiftlink').addClass('fokus');
		$('.inkomstlink').removeClass('fokus');
		$('.utgift').show();
		$('.inkomst').hide();
		$('.errorlist').empty();
		console.log($this);
	});
//Döljer och visar divar när man klickar på inkomstflik
	$('.inkomstlink').click(function(event)
	{
		event.preventDefault();
		$('.utgiftlink').removeClass('fokus');
		$('.inkomstlink').addClass('fokus');
		$('.utgift').hide();
		$('.inkomst').show();
		$('.errorlist').empty();
	});

	// validering för om man skickar ett transaktionsformulär
	$(".inkomst").submit(function()
	{
		var val = $("#isum").val();

		// kolla så att det är en positiv siffra
		if(isNaN(val) || val < 0)
		{
			// lägg till error-class på rutan
			$("#isum").addClass('error');
			// skriv ut meddelande
			$(".ierrorlist").html('Skriv ett positivt heltal!');
			// skicka inte formuläret
			return false;
		}
	});
	$(".utgift").submit(function()
	{
		var val = $("#usum").val();

		// kolla så att det är en positiv siffra
		if(isNaN(val) || val < 0)
		{
			// lägg till error-class på rutan
			$("#usum").addClass('error');
			// skriv ut meddelande
			$(".uerrorlist").html('Skriv ett positivt heltal!');
			// skicka inte formuläret
			return false;
		}
	});
});
