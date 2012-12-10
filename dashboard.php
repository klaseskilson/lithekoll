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
		<h2>Lägg till transaktion</h2>

		<?php transform(); ?>
	</div>
		<div class = "contentwrapper wrapper-50 fright">
			<h2><?php echo date('m Y'); ?></h2>

			<script type="text/javascript" src="https://www.google.com/jsapi"></script>
			<script type="text/javascript">
				google.load("visualization", "1", {packages:["corechart"]});
				google.setOnLoadCallback(drawChart);
				function drawChart() {
					var data = google.visualization.arrayToDataTable([
						['Kategori', 'Pengar'],
						<?php
							foreach (get_categories() as $key => $value) {
								echo '[\''.$value.'\', '.get_sumbycatid($key).'],';
							}
						?>
					]);

					var options = {
						colors: [<?php
							foreach ($colors as $color) {
								echo '\''.$color.'\', ';
							}
						?>]
					};

					var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
					chart.draw(data, options);
				}
			</script>

     <div id="chart_div" style="width: 100%;"></div>

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
