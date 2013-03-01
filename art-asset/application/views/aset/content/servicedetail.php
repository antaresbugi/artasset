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
		<form action="<?php echo base_url();?>aset/adminFunc/input_service" method="post" name="addService" enctype="multipart/form-data">
        <article class="module width_full">
        <header><h3>Asset Service / Maintenance</h3></header>
        	<div class="module_content">
            <fieldset>
            <?php foreach($data as $d): ?>		
				<label>Asset ID</label>
				<input type="text" id="id" name="id" value="<?php echo $d->idAset; ?>" disabled="disabled">
                <input type="hidden" id="id1" name="id1" value="<?php echo $d->idAset; ?>">
                <label>Asset Name</label>
				<input type="text" id="namaeuy" name="namaeuy" value="<?php echo $d->namaAset; ?>" disabled="disabled">
            <?php endforeach ?>
			</fieldset>
			<fieldset>
            	<label>Service Item <font color="#fe0000">*</font></label>New Item?<input name="newitem" type="checkbox" value="1" />
				<input type="text" id="itembaru" name="itembaru" class="itembaru">
                <select name="itemlama" id="itemlama" class="itemlama" value="" style="width:90%">
					<?php foreach($itper as $ip): ?>
                      <option value="<?php echo  $ip->itemPerbaikID?>"><?php echo  $ip->itemPerbaikNama ?></option>
                    <?php endforeach ?>
                </select>
            </fieldset>
            <fieldset style="width:48%; float:left; margin-right: 3%;" class="other1">
				<label>Date <font color="#fe0000">*</font></label>
				<input type="text" name="tgl" id="tgl" class="tanggal" pattern="[0-9][0-9][0-9][0-9]-[0-9][0-9]-[0-9][0-9]" placeholder="yyyy-mm-dd" style="width:90%" required="required">
			</fieldset>
			<fieldset style="width:48%; float:right;" class="other1">
				<label>Cost <font color="#fe0000">*</font></label>
				<input type="text" id="biayacost" name="biayacost" pattern="[0-9]+" placeholder="Use Only Number" required style="width:90%">
			</fieldset>
            
            <fieldset style="width:48%; float:left; margin-right: 3%;" class="other1">
				<label>Next Service by Date </label>
				<input type="text" name="nekstgl" id="nekstgl" class="tanggal" pattern="[0-9][0-9][0-9][0-9]-[0-9][0-9]-[0-9][0-9]" placeholder="yyyy-mm-dd" style="width:90%" >
			</fieldset>
			<fieldset style="width:48%; float:right;" class="other1">
				<label>Next Service by Usage</label>
				<input type="text" id="usage" name="usage" pattern="[0-9]+" placeholder="Use Only Number" style="width:90%">
			</fieldset>
            
            <fieldset>
				<label>Description</label>
				<textarea name="desk" id="desk" rows="12"></textarea>
			</fieldset>
            <div class="clear"></div>
            </div>
            <footer>
            	<div class="submit_link">
               		<input type="submit" value="Save" class="alt_btn">
					<input type="reset" value="Reset">
                </div>
            </footer>
        </article>
        </form>		

		<div class="spacer"></div>
        <script type="text/javascript">
        $(function () {
			$('.itembaru').hide();
			$('input[name="newitem"]').click(function () {
				if (this.checked) {
					$('.itembaru').show();
					$('.itemlama').hide();
					$('.itembaru').attr('required');
					document.getElementById('itembaru').setAttribute('required','required');
				} else {
					$('.itembaru').hide();
					$('.itemlama').show();
					document.getElementById('itembaru').removeAttribute('required','required');
				}
			});
		});
		
		$(document).ready(function() {
				$(".tanggal").datepicker({
					dateFormat:"yy-mm-dd",
					changeMonth:true,
					changeYear:true
				});
				
		});
        </script>  