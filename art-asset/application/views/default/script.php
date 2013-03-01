
	<script src="<?php echo base_url();?>js/jquery-1.5.2.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>js/hideshow.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>js/jquery.tablesorter.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/jquery.equalHeight.js"></script>
    <script type="text/javascript" src="<?= base_url();?>js/jquery-barcode.js"></script>
   
    <!-- notif -->
    <script type="text/javascript" src="<?= base_url();?>js/jquery.jgrowl_minimized.js"></script>

    <!-- chart -->
    <script type="text/javascript" src="<?= base_url();?>js/highcharts.js"></script>
    <script type="text/javascript" src="<?= base_url();?>js/exporting.js"></script>
    
	<!-- dari rifqi -->
	<script type="text/javascript" src="<?= base_url();?>js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="<?= base_url();?>js/jquery.dataTables.js"></script>
	<script type="text/javascript" src="<?= base_url();?>js/jvalidate.js"></script>
	<script type="text/javascript" src="<?= base_url();?>js/jquery.dropotron-1.0.js"></script>
	<script type="text/javascript" src="<?= base_url();?>js/init.js"></script>
    <!-- end of dari rifqi -->
    
	<script type="text/javascript">
	$(document).ready(function() 
    	{ 
      	  $(".tablesorter").tablesorter(); 
   	 } 
	);
	$(document).ready(function() {

	//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});

});
    </script>
    <script type="text/javascript">
    $(function(){
        $('.column').equalHeight();
    });
</script>