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
    <header><h3>Asset</h3></header>
    <div class="module_content" align="center">
        <form name="buttonmenu" id="buttonmenu" method="post" action="<?php echo site_url('aset/adminFunc/menu_asset');?>">
        <p>
        	<button name="menu" type="submit" value="newdata">New Asset</button>
            <button name="menu" type="submit" value="service">Service / Maintenance</button>
        </p>
        <p>
        	<button name="menu" type="submit" value="data">Asset Data</button>
        	<button name="menu" type="submit" value="disposal">Disposal</button>
        </p>
        </form>
    </div>
</article><!-- end of post new article -->

<div class="spacer"></div>