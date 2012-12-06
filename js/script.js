
(function() {
$('.focus').click(function() {
	console.log(this);
	$('.focus').removeClass('show');
		$('.ofokus').addClass('show');


});
})();



(function() {
$('.ofokus').click(function() {
	console.log(this);
	$('.ofokus').removeClass('show');
		$('.focus').addClass('show');
	

});
})();