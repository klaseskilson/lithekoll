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
		<h1>Transaktioner</h1>
		
		<?php transactions(); ?>
	</div>
		<div class = "contentwrapper wrapper-50 fright">
			<h1>Diagram</h1>
		   
    <script type="text/javascript">
    if(document.readyState === "complete")
    {
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Work',     11],
          ['Eat',      2],
          ['Commute',  2],
          ['Watch TV', 2],
          ['Sleep',    7]
        ]);

        var options = {
          title: 'My Daily Activities'
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
  }
		 </script>
		  <div id="chart_div" style="width: 390px; height: 100;"></div>
	</div>
	</div>
		<div class="wrapper contentwrapper">
		<h1>Översikt</h1>

	<p>
	hefjwfwe
	</p>	

	</div>
</div>


<?php

build_footer(true);
?>
