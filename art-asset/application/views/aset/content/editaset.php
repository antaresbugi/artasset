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
		<form action="<?php echo base_url();?>aset/adminFunc/edit_asset" method="post" name="addAsset" enctype="multipart/form-data">
		<article class="module width_full">
			<header><h3>Edit Asset Info</h3></header>
				<div class="module_content">		
                <?php foreach($data as $d): ?>
                <?php
				$statuscek = $d->statusAset;
								  
				  if($statuscek==0){
					$status = 'In Store';
				  } else if($statuscek==1){
					$status = 'In Use';
				  } else if($statuscek==2){
					$status = 'In Repair';
				  } else if($statuscek==3){
					$status = 'Disposed';
				  } 
				?>		
                	<fieldset>
						<label>Asset Name <font color="#fe0000">*</font></label>
						<input type="text" name="nama" id="nama" value="<?php echo $d->namaAset ?>" required >
                        <input type="hidden" name="id" id="id" value="<?php echo $d->idAset ?>" >
					</fieldset>
                    <fieldset style="width:31%; float:left; margin-right: 3%;">
                        <label style="width:150px;">Vendor</label>
                        <select name="vendor" id="vendor" class="required" value="" style="width:90%">
                        <?php foreach($vendorlist as $vl): ?>
                           <?php
						   if($vl->vendorID==$d->vendorID)echo "<option value='$vl->vendorID' selected>$vl->vendorNama</option>";
                           else echo "<option value='$vl->vendorID'>$vl->vendorNama</option>";
						   ?>
                        <?php endforeach ?>
                         </select>
                    </fieldset>
                    <fieldset style="width:31%; float:left; margin-right: 3%;">
                        <label style="width:150px;">Type</label>
                        <select name="tipe" id="tipe" class="required" value="" style="width:90%">
						<?php foreach($tipelist as $tl): ?>
                        	<?php
						   if($tl->klasID==$d->klasID)echo "<option value='$tl->klasID' selected>$tl->klasName</option>";
                           else echo "<option value='$tl->klasID'>$tl->klasName</option>";
						   ?>
                        <?php endforeach ?>
                        </select>
                    </fieldset>
                    <fieldset style="width:31%; float:left;">
                        <label style="width:150px;">Location</label>
                        <input type="hidden" name="lockir" id="lockir"  value="<?php echo  $d->idDept ?>">
                        <select name="loc" id="loc" value="" style="width:90%">
						<?php foreach($loclist as $ll){
						   if($ll->idDept==$d->idDept)echo "<option value='$ll->idDept' selected>$ll->namaDept</option>";
                           else echo "<option value='$ll->idDept'>$ll->namaDept</option>";
						 } ?>
                           
                        </select>
                    </fieldset>
                    <fieldset style="width:48%; float:left; margin-right: 3%;">
							<label>Purchase Cost <font color="#fe0000">*</font></label>
							<input type="text" name="purcos" id="purcos" pattern="[0-9]+" placeholder="Use Only Number" style="width:90%" required="required" value="<?php echo  $d->hargaBeli ?>">
                            <input type="hidden" name="purcoskir" id="purcoskir"  value="<?php echo  $d->hargaBeli ?>">
					</fieldset>
					<fieldset style="width:48%; float:right;">
							<label>Acquisition Date <font color="#fe0000">*</font></label>
							<input type="text" name="tgl" id="tgl" class="tanggal" pattern="[0-9][0-9][0-9][0-9]-[0-9][0-9]-[0-9][0-9]" placeholder="yyyy-mm-dd" style="width:90%" required="required" value="<?php echo  $d->tgl_beli ?>">
					</fieldset>
                    <fieldset style="width:48%; float:left; margin-right: 3%;">
							<label>Condition</label>
							<select name="kondisi" id="kondisi" style="width:95%; height: 24px;">
								<option value="0" <?php if($d->kondisiAset==0) echo 'selected';?>>New</option>
								<option value="1" <?php if($d->kondisiAset==1) echo 'selected';?>>Good</option>
                                <option value="2" <?php if($d->kondisiAset==2) echo 'selected';?>>Fair</option>
								<option value="3" <?php if($d->kondisiAset==3) echo 'selected';?>>Poor</option>
							</select>
					</fieldset>
                    <input type="hidden" name="activeStateId" value="1">
                    <input type="hidden" name="isStateChange" value="">
					<fieldset style="width:48%; float:right;">
							<label>Status</label>
                            <input type="hidden" name="statas" id="statas" value="<?php echo $d->statusAset ?>" >
                            <?php 
							   if($d->statusAset == 0 || $d->statusAset == 1){
								    echo "<select name='status' onchange='displayAssignTo(this.form)' style='width:95%; height:24px;' id='status'>";
								 if($d->statusAset == 0){	
									echo "<option value='0' selected>In Store</option>";
									echo "<option value='1'>In Use</option>";
								 } else {
									echo "<option value='0'>In Store</option>";
									echo "<option value='1' selected>In Use</option>";
								 }
									echo "</select>";
							   } else {
								   	echo "<input type='text' name='statusin' id='statusin' value='$status' disabled style='width:90%'>";
							   }
							?>
					</fieldset>
                    <fieldset id="divassign" name="divassign" class="divassign">
						<label style="width:150px;">Assign to</label>
						<input type="text" name="tanjaw" id="tanjaw"  value="<?php if($d->statusAset==1) echo $d->petugasAset ?>">
					</fieldset>
                    <fieldset>
						<label>Description</label>
						<textarea name="desk" id="desk" rows="12"><?php echo $d->keteranganAset ?></textarea>
					</fieldset>
                    <?php endforeach ?>
				</div>
		</article>
        
		<article class="module width_full">
			<header><h3>Depreciation Detail <input name="deprecheck" type="checkbox" value="1" /> </h3></header>
				<div class="module_content">			
                	<fieldset class="other1">
						<label>Depreciation</label>
						<select name="depas" id="depas" value="" style="width:90%">
						<?php foreach($deplist as $dl){
						   if($dl->idDepresiasi==$d->idDepresiasi)echo "<option value='$dl->idDepresiasi' selected>$dl->namaDepresiasi</option>";
                           else echo "<option value='$dl->idDepresiasi'>$dl->namaDepresiasi</option>";
						 } ?>
                        </select>
					</fieldset>
                    
                    <fieldset style="width:48%; float:left; margin-right: 3%;" class="other1">
							<label>Useful Life (in Years)</label>
							<input type="text" name="uslif" id="uslif" style="width:90%" pattern="[0-9]+" placeholder="Use Only Number" value="<?php echo $d->umurEkonom ?>">
					</fieldset>
					<fieldset style="width:48%; float:right;" class="other1">
							<label>Salvage Value</label>
							<input type="text" name="salval" id="salval" pattern="[0-9]+" placeholder="Use Only Number" style="width:90%" value="<?php echo $d->nilaiSisa  ?>">
					</fieldset>
                    <div class="clear"></div>
				</div>
			<footer>
				<div class="submit_link">
					<input type="submit" name="upload" id="upload" value="Save" class="alt_btn">
					<input type="reset" value="Reset">
				</div>
			</footer>
		</article>
		</form>		
        <div id="erorboy" title="Error Message"> 
            <p>
                <span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
                Salvage Value is always less than the Purchase Cost of asset.</p> 
        </div> 
		<div class="spacer"></div>
        <script type="text/javascript">		
		function displayAssignTo(form)
            {
                    var rState = form.status.value;
                    var activeState = form.activeStateId.value;
            
                    //alert ("  rState "+rState+" activeState "+activeState);
                    if (rState == activeState)
                    {
                    //alert("yes");
                    $('fieldset.divassign').show();
					document.getElementById('tanjaw').setAttribute('required','required');
                    }
                    else
                    {
                    	form.isStateChange.value="true";
                    	$('fieldset.divassign').hide();
						document.getElementById('itembaru').removeAttribute('required','required');
                    }
            };
			
		$(function () {
			$('fieldset.other1').hide();
			<?php if($d->statusAset != 1)
					echo "$('fieldset.divassign').hide();";						  	
			?>
			$('input[name="deprecheck"]').click(function () {
				if (this.checked) {
					$('fieldset.other1').show();
					document.getElementById('uslif').setAttribute('required','required');
					document.getElementById('salval').setAttribute('required','required');
				} else {
					$('fieldset.other1').hide();
					document.getElementById('uslif').removeAttribute('required','required');
					document.getElementById('salval').removeAttribute('required','required');
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
			
			$( "#erorboy" ).dialog({
				autoOpen: false,
				resizable: false,
				height:150,
				width: 450,
				modal: true,
				hide: 'Slide',
				buttons: {
				"Close": function() {
					$( this ).dialog( "close" );
				}
				}				
			});
			
			$( "#upload" )
			.button()
			.click(function() {
				var beli = $("#purcos").val();
				var sisa = $( "#salval").val();
				if(parseInt(beli) < parseInt(sisa)){
					$( "#erorboy").dialog( "open" );
					return false;
				}
			});
	
		</script>  