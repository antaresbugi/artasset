<?php if ($this->session->flashdata('message') != ''): ?>
	<script type="text/javascript">
	<!--
	<?php $pesan = $this->session->flashdata('message') ?>
	$(document).ready(function() {	
		$.jGrowl('<?php echo "$pesan" ?>');	
	});
	//-->				
	</script>
<?php endif; ?>
<article class="module width_full">
<header><h3>Approved / Declined</h3>
</header>

<div id="tabel_data">
<?php $this->load->view('/aset/content/appdecTable'); ?>
</div>
</div> 

<!-- end of buat popup input -->
</article><!-- end of post new article -->

				
<div class="spacer"></div>