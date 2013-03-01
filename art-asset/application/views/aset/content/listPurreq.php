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
<header><h3>Purchase Request Data</h3>
<!--
misalnya suatu saat butuh button tambahan diatas :D
<button id="print" style="position:absolute; margin-left:-40px; margin-bottom:5px; margin-top:1px" title="Print"><img src='<?php echo base_url()?>images/icn_new_article.png'></button>-->
<button id="create-daily" style="float:right; margin-bottom:5px; margin-top:1px;" title="Add New Location"><img src='<?php echo base_url()?>images/icn_new_article.png'></button>
</header>

<div id="tabel_data">
<?php $this->load->view('/aset/content/listPurreqTable'); ?>
</div>

<!-- buat popup edit -->
<div id="form_loc" name="form_loc" title="Detail / Edit Data">
<form id='formloc' name='formloc' method='post' action='<?php echo site_url('aset/adminFunc/edit_purreq');?>' >
<input name="id" id="id" type="hidden" class ="">

    <fieldset>
        <label style="width:150px;">Name <font color="#fe0000">*</font></label>
    	<input name="nama" id="nama" type="text"  value="" required>
    </fieldset>
    <fieldset style="width:48%; float:left; margin-right: 3%;">
        <label style="width:150px;">Type</label>
        <select name="tipe" id="tipe" class="required" value="" style="width:90%">
        <?php foreach($tipelist as $tl): ?>
				<option value="<?php echo  $tl->klasID ?>"><?php echo  $tl->klasName ?></option>
        <?php endforeach ?>
			</select>
            <!-- position means sessionid on user-->
        </fieldset>
        <fieldset style="width:48%; float:right;">
        <label style="width:150px;">Vendor</label>
		<select name="vendor" id="vendor" class="required" value="" style="width:90%">
		<?php foreach($vendorlist as $vl): ?>
				<option value="<?php echo  $vl->vendorID ?>"><?php echo $vl->vendorNama ?></option>
        <?php endforeach ?>
			</select>
		</fieldset>
        <fieldset>
        <label style="width:150px;">Price <font color="#fe0000">*</font></label>
    	<input name="harga" id="harga" type="text"  value="" pattern="[0-9]+" placeholder="Use Only Number" required>
    </fieldset>
    <fieldset>
        <label style="width:150px;">Description</label>
        <textarea name="deks" id="deks" rows="5" value=""></textarea>
        </fieldset>
        
        <!-- bikin manual, hati2-->
        <label style="width:150px; float:left; margin-top:10px">Set Notification</label>
        <input name="unread" id="unread" type="checkbox" value="1" style="margin-top:10px">

	<div class="submit_link">
        <!--<label>Status : </label>
        <select name="status" id="status" class="required" value="">
				<option value="0">Open</option>
				<option value="1">Approved</option>
                <option value="2">Closed</option>
				<option value="3">Declined</option>
			</select>-->
    <input type="submit" value="Save" class="alt_btn">
    </div>
    </form>
</div> 
<!-- end of buat popup edit -->
<div id="dialog-confirm" title="Delete Location"> 
	<p>
		<span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
		<input type="hidden" value='' id="del_id" name="del_id">
		Are You Sure?</p> 
</div> 
<!-- end of buat popup delete -->
<div id="form_inloc" name="form_inkloc" title="Input Data">
<form id='forminloc' name='forminloc' method='post' action='<?php echo site_url('aset/adminFunc/input_purreq');?>' >
	<fieldset>
        <label style="width:150px;">Name <font color="#fe0000">*</font></label>
    	<input name="nama" id="nama" type="text"  value="" required>
    </fieldset>
    <fieldset style="width:48%; float:left; margin-right: 3%;">
        <label style="width:150px;">Type</label>
        <select name="tipe" id="tipe" class="required" value="" style="width:90%">
        <?php foreach($tipelist as $tl): ?>
				<option value="<?php echo  $tl->klasID ?>"><?php echo  $tl->klasName ?></option>
        <?php endforeach ?>
			</select>
            <!-- position means sessionid on user-->
        </fieldset>
        <fieldset style="width:48%; float:right;">
        <label style="width:150px;">Vendor</label>
		<select name="vendor" id="vendor" class="required" value="" style="width:90%">
		<?php foreach($vendorlist as $vl): ?>
				<option value="<?php echo  $vl->vendorID ?>"><?php echo $vl->vendorNama ?></option>
        <?php endforeach ?>
			</select>
		</fieldset>
        <fieldset>
        <label style="width:150px;">Price <font color="#fe0000">*</font></label>
    	<input name="harga" id="harga" type="text"  value="" pattern="[0-9]+" placeholder="Use Only Number" required>
    </fieldset>
    <fieldset>
        <label style="width:150px;">Description</label>
        <textarea name="deks" id="deks" rows="5" value=""></textarea>
        </fieldset>
    <input type="submit" value="Save" class="alt_btn" style="float:right">
    </form>
</table>
</div> 

<!-- end of buat popup input -->
</article><!-- end of post new article -->

<!-- script popup edit/delete -->
<script type="text/javascript" charset="utf-8">
	$(function() {

		$( "#dialog:ui-dialog" ).dialog( "destroy" );
		$( "#dialog-confirm" ).dialog({
			autoOpen: false,
			resizable: false,
			height:150,
			modal: true,
			hide: 'Slide',
			buttons: {
				"Delete": function() {
					var del_id = {kode : $("#del_id").val()};
					$.ajax({
						type: "POST",
						url : "<?php echo site_url('aset/adminFunc/delete_pr')?>",
						data: del_id,
						success: function(msg){
							$('#tabel_data').html(msg);
							$.jGrowl("<h4>Data Deleted</h4>");	
							$('#dialog-confirm' ).dialog( "close" );
						}
				  	});

					},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		
		$( "#form_loc" ).dialog({
			autoOpen: false,
			height: 480,
			width: 700,
			modal: true,
			hide: 'Slide',
			close: function() {
					$('#id').val('');
        			$('#nama').val('');
					$('#tipe').val('');
					$('#deks').val('');
					$('#unread').val('');
					$('#status').val('');
					$('#vendor').val('');
					$('#harga').val('');
			}
			
		});
	
	$( "#form_inloc" ).dialog({
			autoOpen: false,
			height: 480,
			width: 700,
			modal: true,
			hide: 'Slide',
			buttons: {
			}, 
			close: function() {
				    $('#id').val('');
        			$('#nama').val('');
					$('#tipe').val('');
					$('#deks').val('');
					$('#vendor').val('');
					$('#harga').val('');
			}
			
		});

	$( "#create-daily" )
			.button()
			.click(function() {
				$( "#form_inloc").dialog( "open" );				
			});
	
	});
	
	$(".edit").live("click",function(){
		var id = $(this).attr("kode");
		var nama = $(this).attr("nama");
		var tipe = $(this).attr("tipe");
		var deks= $(this).attr("deks");
		var status = $(this).attr("status");
		var vendor = $(this).attr("vendor");
		var harga = $(this).attr("harga");

		$('#id').val(id);
        $('#nama').val(nama);
		$('#tipe').val(tipe);
		$('#deks').val(deks);
        $('#status').val(status);
		$('#vendor').val(vendor);
		$('#harga').val(harga);
        
        $( "#form_loc" ).dialog( "open" );
        
        return false;
	});
	
	$(".delbutton").live("click",function(){
    	var kode = $(this).attr("kode");
    	var info = 'kode=' + kode;
    	$('#del_id').val(kode);
		
    	$( "#dialog-confirm" ).dialog( "open" );

    	return false;
 	});
	
	
	</script>
<!-- end of script popup edit -->  
				
<div class="spacer"></div>