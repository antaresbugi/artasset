		<h4 class="alert_info">Welcome to Asset Management Information System Dashboard</h4>
		
		<article class="module width_full">
			<header><h3>Asset Status</h3></header>
			<div class="module_content">
				<article class="stats_graph">
					<div id="container" align="center" style="width: 500px; height: 400px; margin: 0 auto"></div>
				</article>
                <article class="stats_overview">
					<div class="overview_today">
						<p class="overview_day">In Store</p>
						<p class="overview_count"><a href="<?php echo base_url();?>aset/admin/asset/0"><?php echo $store ?></a></p>
						<p class="overview_day">In Use</p>
						<p class="overview_count"><a href="<?php echo base_url();?>aset/admin/asset/1"><?php echo $use ?></a></p>
                        <p class="overview_type"></p>
					</div>
					<div class="overview_previous">
						<p class="overview_day">In Repair</p>
						<p class="overview_count"><a href="<?php echo base_url();?>aset/admin/asset/2"><?php echo $repair ?></a></p>
						<p class="overview_day">Disposed</p>
						<p class="overview_count"><a href="<?php echo base_url();?>aset/admin/asset/3"><?php echo $dispose ?></a></p>
						<p class="overview_type"></p>
					</div>
				</article>
				<div class="clear"></div>
			</div>
		</article><!-- end of stats article -->
		
		<div class="spacer"></div>
<div class="spacer2"></div>
<script type="text/javascript">
$(function () {
    var chart;
    
    $(document).ready(function () {
    	
    	// Build the chart
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container',
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: false
            },
            tooltip: {
        	    pointFormat: '{series.name}: <b>{point.percentage}%</b>',
            	percentageDecimals: 1
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    showInLegend: false
                }
            },	
			credits: {
				enabled: false
			},
			navigation: {
				buttonOptions: {
					enabled: false
				}
			},
            series: [{
                type: 'pie',
                name: 'Asset share',
                data: [
				//bikin php
				<?php 
					$storechart = ($store/$total)*100;
					$usechart = ($use/$total)*100;
					$repairchart = ($repair/$total)*100;
					$disposechart = ($dispose/$total)*100;
				?>
                    ['In Store',   <?php echo $storechart ?>],
                    ['In Use',     <?php echo $usechart ?>],
                    ['In Repair', <?php echo $repairchart ?>],
                    ['Disposed',   <?php echo $disposechart ?>]
				//end of bikin php
                ]
            }]
        });
    });
    
});
		</script>