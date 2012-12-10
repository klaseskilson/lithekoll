<?php

ini_set('error_reporting', E_ALL);

include("includes/start.php");

build_header();
?>
<div id="content">
	<div class="wrapper contentwrapper">
		<h1>Kontrollpanel</h1>
		<p>
			Här kan det vara nåt
		</p>
	</div>
	<div class="wrapper">
		<div class = "contentwrapper wrapper-50 fleft">
		<h2>Transaktioner</h2>

		<?php transactions(); ?>
	</div>
		<div class = "contentwrapper wrapper-50 fright">
			<h2><?php echo date('Y - m'); ?></h2>

			<script type="text/javascript" src="https://www.google.com/jsapi"></script>
			<script type="text/javascript">
				google.load("visualization", "1", {packages:["corechart"]});
				google.setOnLoadCallback(drawChart);
				function drawChart() {
					var data = google.visualization.arrayToDataTable([
						['Kategori', 'Pengar'],
						['Work',     11],
						['Eat',      2],
						['Commute',  2],
						['Watch TV', 2],
						['Sleep',    7]
					]);

					var options = {
						title: 'Hejhej!'
					};

					var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
					chart.draw(data, options);
				}
			</script>

     <div id="chart_div" style="width: 100%; height: 300px;"></div>

	</div>
	</div>
		<div class="wrapper contentwrapper">
		<h2>Översikt</h2>

	<p>
	hefjwfwe
	</p>

	</div>
</div>


<?php

build_footer(true);
?>
