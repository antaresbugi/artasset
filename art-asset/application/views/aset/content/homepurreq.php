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
    <header><h3>Purchase Request Menu</h3></header>
    <div class="module_content" align="center">
        <form name="buttonmenu" id="buttonmenu" method="post" action="<?php echo site_url('aset/adminFunc/menu_pr');?>">
        <p><button name="menu" type="submit" value="data">Purchase Request Data</button></p>
        <p><button name="menu" type="submit" value="appdec">Approved / Declined</button></p>
        <p><button name="menu" type="submit" value="approval">Approval</button></p>
        <p><button name="menu" type="submit" value="toasset">PR to Asset</button></p>
        </form>
    </div>
</article><!-- end of post new article -->

<div class="spacer"></div>