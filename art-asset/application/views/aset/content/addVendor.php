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
        <form action="<?php echo base_url();?>aset/adminFunc/input_vendor" method="post" name="addVendor">
			<header><h3>New Vendor</h3></header>
				<div class="module_content">
                		<fieldset>
							<label>Vendor ID</label>
							<input type="text" id="id" name="id" value="<?php echo $data; ?>" disabled="disabled">
                            <input type="hidden" id="id1" name="id1" value="<?php echo $data; ?>">
						</fieldset>
						<fieldset>
							<label>Company Name <font color="#fe0000">*</font></label>
							<input type="text" name="nama" id="nama" required>
							<label>Company Address</label>
							<textarea name="alamat" id="alamat" rows="12"></textarea>
						</fieldset>
						<fieldset style="width:48%; float:left; margin-right: 3%;">
							<label>Telephone Number</label>
							<input type="text" name="phone" id="phone" style="width:92%;" pattern="[0-9]+-[0-9]+" placeholder="Example : 021-1234567">
						</fieldset>
						<fieldset style="width:48%; float:right;">
							<label>Email</label>
							<input type="email" name="email" id="email" class="email" style="width:92%;" placeholder="Example : yourname@website.com">
						</fieldset>
                        <fieldset>
							<label>Company Website</label>
							<input type="email" name="situs" id="situs" placeholder="Example : http://yourwebsite.com">
						</fieldset>
                        <fieldset style="width:48%; float:left; margin-right: 3%;">
                        <label>Contact Name <font color="#fe0000">*</font></label>
							<input type="text" name="kontakNam" id="kontakNam" style="width:92%;" required>
						</fieldset>
						<fieldset style="width:48%; float:right;">
							<label>Contact Number <font color="#fe0000">*</font></label>
							<input type="text" name="kontakNo" id="kontakNo" style="width:92%;" required pattern="[0-9]+-[0-9]+" placeholder="Example : 021-1234567">
						</fieldset>
                		<div class="clear"></div>
				</div>
			<footer>
				<div class="submit_link">
					<input type="submit" value="Save" class="alt_btn">
					<input type="reset" value="Reset">
				</div>
			</footer></form>
		</article><!-- end of post new article -->
				
		<div class="spacer"></div>