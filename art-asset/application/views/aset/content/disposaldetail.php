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
		<form action="<?php echo base_url();?>aset/adminFunc/input_disposal" method="post" name="addDisposal" enctype="multipart/form-data">
        <article class="module width_full">
        <header><h3>Asset Disposal</h3></header>
        	<div class="module_content">
            <fieldset>
            <?php foreach($data as $d): ?>		
				<label>Asset ID</label>
				<input type="text" id="id" name="id" value="<?php echo $d->idAset; ?>" disabled="disabled">
                <input type="hidden" id="id1" name="id1" value="<?php echo $d->idAset; ?>">
                <label>Asset Name</label>
				<input type="text" id="namaeuy" name="namaeuy" value="<?php echo $d->namaAset; ?>" disabled="disabled">
                <input type="hidden" id="stata" name="stata" value="<?php echo $d->statusAset; ?>">
            <?php endforeach ?>
			</fieldset>
			<fieldset>
				<label>Disposal Status</label>
				<select name="resourceState" onchange="displayAssignTo(this.form)" id="resourceState">
					<option value="0" selected>Disposed</option>
					<option value="1">Sold</option>
				</select>
                <p class="apus1"><label class="apus1">Cost</label></p>
				<input type="text" id="discost" name="discost" class="apus1" pattern="[0-9]+" placeholder="Use Only Number">
                <p class="apus2"><label class="apus2">Selling Price</label></p>
				<input type="text" id="dissell" name="dissell" class="apus2" pattern="[0-9]+" placeholder="Use Only Number">
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
		function displayAssignTo(form)
            {
                    var rState = form.resourceState.value;

                    if (rState == 0)
                    {
                    //alert("yes");
                    	$('.apus1').show();
						$('.apus2').hide();
                    }
                    else
                    {
                    	$('.apus1').hide();
						$('.apus2').show();
                    }
            };
		
        $(function () {
			$('.apus2').hide();
		});
        </script>  