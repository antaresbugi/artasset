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
		<form action="<?php echo base_url();?>aset/adminFunc/to_asset" method="post" name="addAsset" enctype="multipart/form-data">
		<article class="module width_full">
        <?php foreach($data as $pta): ?>
			<header><h3>PR To Asset Info</h3></header>
				<div class="module_content">			
                	<fieldset>
						<label>Asset Name <font color="#fe0000">*</font></label>
						<input type="text" name="nama" id="nama" required value="<?php echo  $pta->namaBarang ;?>">
                        <input type="hidden" name="idPRnya" id="idPRnya" required value="<?php echo  $pta->idPR ;?>">
					</fieldset>
                    <fieldset style="width:31%; float:left; margin-right: 3%;">
                        <label style="width:150px;">Vendor</label>
                        <select name="vendor" id="vendor" class="required" value="" style="width:90%">
                        <?php foreach($vendorlist as $vl): ?>
                           <option value="<?php echo  $vl->vendorID ?>" <?php if($vl->vendorID==$pta->vendorID) echo 'selected' ?>><?php echo $vl->vendorNama ?></option>
                        <?php endforeach ?>
                         </select>
                    </fieldset>
                    <fieldset style="width:31%; float:left; margin-right: 3%;">
                        <label style="width:150px;">Type</label>
                        <select name="tipe" id="tipe" class="required" value="" style="width:90%">
						<?php foreach($tipelist as $tl): ?>
                           <option value="<?php echo  $tl->klasID ?>" <?php if($tl->klasID==$pta->klasID) echo 'selected' ?>><?php echo  $tl->klasName ?></option>
                        <?php endforeach ?>
                        </select>
                    </fieldset>
                    <fieldset style="width:31%; float:left;">
                        <label style="width:150px;">Location</label>
                        <select name="loc" id="loc" value="" style="width:90%">
						<?php foreach($loclist as $ll): ?>
                           <option value="<?php echo  $ll->idDept ?>"><?php echo  $ll->namaDept ?></option>
                        <?php endforeach ?>
                        </select>
                    </fieldset>
                    <fieldset style="width:48%; float:left; margin-right: 3%;">
							<label>Purchase Cost <font color="#fe0000">*</font></label>
							<input type="text" name="purcos" id="purcos" pattern="[0-9]+" placeholder="Use Only Number" style="width:90%" required="required" value="<?php echo  $pta->hargaPred ;?>">
					</fieldset>
					<fieldset style="width:48%; float:right;">
							<label>Acquisition Date <font color="#fe0000">*</font></label>
							<input type="text" name="tgl" id="tgl" class="tanggal" pattern="[0-9][0-9][0-9][0-9]-[0-9][0-9]-[0-9][0-9]" placeholder="yyyy-mm-dd" style="width:90%" required="required">
					</fieldset>
                    <fieldset style="width:48%; float:left; margin-right: 3%;">
							<label>Condition</label>
							<select name="kondisi" id="kondisi" style="width:95%">
								<option value="0">New</option>
								<option value="1">Good</option>
                                <option value="2">Fair</option>
								<option value="3">Poor</option>
							</select>
					</fieldset>
                    <input type="hidden" name="activeStateId" value="1">
                    <input type="hidden" name="isStateChange" value="">
					<fieldset style="width:48%; float:right;">
							<label>Status</label>
							<select name="resourceState" onchange="displayAssignTo(this.form)" style="width : 95%" id="resourceState">
								<option value="0">In Store</option>
								<option value="1">In Use</option>
							</select>
					</fieldset>
                    <fieldset id="divassign" name="divassign" class="divassign">
						<label style="width:150px;">Assign to</label>
						<input type="text" name="tanjaw" id="tanjaw">
					</fieldset>
                    <fieldset>
						<label>Description</label>
						<textarea name="desk" id="desk" rows="12"></textarea>
					</fieldset>
                    <fieldset>
						<label>Asset Picture</label>
						<?php echo form_upload('userfile');?>
					</fieldset>
				</div>
		</article>
        
		<article class="module width_full">
			<header><h3>Depreciation Detail <input name="deprecheck" type="checkbox" value="1" /> </h3></header>
				<div class="module_content">			
                	<fieldset class="other1">
						<label>Depreciation</label>
						<select name="depas" id="depas" value="" style="width:90%">
						<?php foreach($deplist as $dl): ?>
                           <option value="<?php echo  $dl->idDepresiasi ?>"><?php echo  $dl->namaDepresiasi ?></option>
                        <?php endforeach ?>
                        </select>
					</fieldset>
                    
                    <fieldset style="width:48%; float:left; margin-right: 3%;" class="other1">
							<label>Useful Life (in Years)</label>
							<input type="text" name="uslif" id="uslif" style="width:90%">
					</fieldset>
					<fieldset style="width:48%; float:right;" class="other1">
							<label>Salvage Value</label>
							<input type="text" name="salval" id="salval" pattern="[0-9]+" placeholder="Use Only Number" style="width:90%">
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
        <?php endforeach ?>
		</form>		
		<div class="spacer"></div>
        <script type="text/javascript">
		function displayAssignTo(form)
            {
                    var rState = form.resourceState.value;
                    var activeState = form.activeStateId.value;
            
                    //alert ("  rState "+rState+" activeState "+activeState);
                    if (rState == activeState)
                    {
                    //alert("yes");
                    $('fieldset.divassign').show();

                    }
                    else
                    {
                    form.isStateChange.value="true";
                    $('fieldset.divassign').hide();
                    }
            }
			
		$(function () {
			$('fieldset.divassign').hide();
			$('fieldset.other1').hide();
			$('input[name="deprecheck"]').click(function () {
				if (this.checked) {
					$('fieldset.other1').show();
				} else {
					$('fieldset.other1').hide();
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