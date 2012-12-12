<?php

ini_set('error_reporting', E_ALL);

include("includes/start.php");

if(!loginstatus())
	header('Location: login.php?loginfirst');

build_header();
?>
<div id="content">
	<div class="wrapper contentwrapper">
		<h1>Välkommen, <?php echo $_SESSION['LiTHekoll_login_fname']; ?></h1>
		<p>
			Här kan det stå något trevligt...
		</p>
	</div>
	<div class="wrapper contentwrapper">
		<h2>Just nu</h2>
		<div class="sumboxcont">
			<div class="sumbox" id="plus">
				<h3>Inkomster</h3>
				<p>
					<?php
						echo get_inksum();
					?>
				</p>
			</div><!-- .sumbox#plus -->
			<p class="divider">
				&ndash;<!-- minus ju -->
			</p>
			<div class="sumbox" id="minus">
				<h3>Utgifter</h3>
				<p>
					<?php
						echo get_utgsum();
					?>
				</p>
			</div><!-- .sumbox#minus -->
			<p class="divider">
				&#61; <!-- likhetstecken -->
			</p>
			<div class="sumbox" id="sum">
				<h3>Balans</h3>
				<p>
					<?php
						echo (get_inksum()-get_utgsum());
					?>
				</p>
			</div><!-- .sumbox#sum -->
			<div class="clearfix"></div>
		</div><!-- .sumboxcont -->
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
		<table class="transactions" id="dashboard">
			<tr>
				<th>
					<!-- Kategorisymbol -->
				</th>
				<th>
					Transaktion
				</th>
				<th>
					Kategori
				</th>
				<th>
					Belopp
				</th>
				<th>
					Tidpunkt
				</th>
			</tr>
			<?php
				$alltransactions = get_transactions();
				foreach ($alltransactions as $key => $transaction) {
					?>
					<tr>
						<td>
							<?php
								$allcategories = get_categories(2);
								$colorposition = sizeof($colors) % $key;
							?>
							<span class="<?php echo $transaction['minus'] == 0 ? 'plus' : 'minus';?>">
								<?php echo $transaction['minus'] == 0 ? '+' : '&ndash;';?>
							</span>
						</td>
						<td>
							<?php echo $transaction['description']; ?>
						</td>
						<td>
							<?php echo $allcategories[$transaction['catid']]; ?>
						</td>
						<td>
							<?php
								if ($transaction['minus'] == 0)
									echo $transaction['plus'];
								else
									echo '&ndash;'.$transaction['minus'];
							?>
						</td>
						<td>
							<?php echo date('Y-m-d H:i', strtotime($transaction['tdate'])); ?>
						</td>
					</tr>
					<?php
				}
			?>
		</table>
	</div>
</div>


<?php

build_footer(true);
?>
