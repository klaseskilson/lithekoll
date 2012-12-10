
(function() {

	$('.knapputgift').click(function(event) {
		event.preventDefault();
		$('.knapputgift').addClass('showutgift');
		$('.utgift').addClass('showutgift');
		$('.utgift').removeClass('hide');
		$('.inkomst').addClass('hide');
	});

	$('.knappinkomst').click(function(event) {
		event.preventDefault();
		$('.knappinkomst').addClass('showinkomst');
		$('.inkomst').addClass('showinkomst');
		$('.inkomst').removeClass('hide');
		$('.utgift').addClass('hide');
	});

})();





