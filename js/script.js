
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
