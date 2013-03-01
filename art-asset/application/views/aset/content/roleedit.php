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
<header><h3>Edit Role</h3>
</header>
<form action="<?php echo base_url();?>aset/adminFunc/editrole/<?php echo $this->uri->segment(4)?>" method="post" name="roleelor">
<div class="module_content">
<?php 
foreach($rolee as $rr):
?>
		<fieldset>
			<label>Name <font color="#fe0000">*</font></label>
		  <input type="text" name="nama" id="nama" value="<?php echo $rr->sessionname ?>" required>
		</fieldset>
        <fieldset>
        <?php 
		$i=0;
		foreach (array_keys($data) as $ad):
		foreach ($data[$ad] as $add):
		?>
          <p>
          <label class="cekk">
            <input type="checkbox" value="<?php echo $add['idPermisi']?>" name="cek<?php echo $i?>" id="cek<?php echo $i?>" <?php if($add['stat']=='yes') echo 'checked';?>>
           <?php echo $add['namaPermisi']?></label>
          </p>
            <?php 
			$i++;
			endforeach;
			endforeach; ?>
        </fieldset>
<?php 
endforeach; ?>
<div class="clear"></div>
</div>
<footer>
	<div class="submit_link">
	<input type="submit" name="upload" id="upload" value="Save" class="alt_btn">
	</div>
</footer>
</form>
</article><!-- end of post new article -->				
<div class="spacer"></div>