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
		<form action="<?php echo base_url();?>aset/adminFunc/input_asset" method="post" name="addAsset" enctype="multipart/form-data">
		<article class="module width_full">
			<header><h3>Asset Info</h3></header>
				<div class="module_content">			
                	<fieldset>
						<label>Asset Name <font color="#fe0000">*</font></label>
						<input type="text" name="nama" id="nama" required >
					</fieldset>
                    <fieldset style="width:31%; float:left; margin-right: 3%;">
                        <label style="width:150px;">Vendor</label>
                        <select name="vendor" id="vendor" class="required" value="" style="width:90%">
                        <?php foreach($vendorlist as $vl): ?>
                           <option value="<?php echo  $vl->vendorID ?>"><?php echo $vl->vendorNama ?></option>
                        <?php endforeach ?>
                         </select>
                    </fieldset>
                    <fieldset style="width:31%; float:left; margin-right: 3%;">
                        <label style="width:150px;">Type</label>
                        <select name="tipe" id="tipe" class="required" value="" style="width:90%">
						<?php foreach($tipelist as $tl): ?>
                           <option value="<?php echo  $tl->klasID ?>"><?php echo  $tl->klasName ?></option>
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
							<input type="text" name="purcos" id="purcos" pattern="[0-9]+" placeholder="Use Only Number" style="width:90%" required="required">
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
					<fieldset style="width:48%; float:right;">
							<label>Status</label>
							<select name="resourceState" onchange="displayNewTo(this.form)" style="width : 95%" id="resourceState">
								<option value="0">In Store</option>
								<option value="1">In Use</option>
							</select>
					</fieldset>
                    <fieldset id="divassign" name="divassign" class="divassign">
						<label style="width:150px;">Assign to  <font color="#fe0000">*</font></label>
						<input type="text" name="tanjaw" id="tanjaw">
					</fieldset>
                    <fieldset>
						<label>Description</label>
						<textarea name="desk" id="desk" rows="12"></textarea>
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
							<label>Useful Life (in Years) <font color="#fe0000">*</font></label>
							<input type="text" name="uslif" id="uslif" style="width:90%" pattern="[0-9]+" placeholder="Use Only Number">
					</fieldset>
					<fieldset style="width:48%; float:right;" class="other1">
							<label>Salvage Value <font color="#fe0000">*</font></label>
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
		</form>		
        <div id="erorboy" title="Error Message"> 
            <p>
                <span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
                Salvage Value is always less than the Purchase Cost of asset.</p> 
        </div> 
		<div class="spacer"></div>
        
		<script type="text/javascript">		
		function displayNewTo(form)
            {
                    var rState = form.resourceState.value;
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
                    	$('fieldset.divassign').hide();
						document.getElementById('tanjaw').removeAttribute('required','required');
                    }
            };
			
		$(function () {
			$('fieldset.divassign').hide();
			$('fieldset.other1').hide();
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