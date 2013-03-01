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
<header><h3>Vendor List</h3></header>

<div id="tabel_data">
<?php $this->load->view('/aset/content/listVendorTable'); ?>
</div>

<!-- buat popup edit -->
<div id="form_vendor" name="form_vendor" title="Detail / Edit Data">
<form id='formvendor' name='formvendor' method='post' action='<?php echo site_url('aset/adminFunc/edit_vendor');?>' >
	<input name="id1" id="id1" type="hidden" class ="">
    <fieldset>
        <label style="width:150px;">Vendor ID</label>
        <input name="id" id="id" type="text"  value="" >
		</fieldset>
        <fieldset>
        <label style="width:150px;">Company Name <font color="#fe0000">*</font></label>
        <input name="nama" id="nama" type="text"  value="" required>
  		</fieldset>
        <fieldset>
        <label style="width:150px;">Company Address</label>
        <textarea name="alamat" id="alamat" type="text"  value="" ></textarea>
  		</fieldset>
        <fieldset style="width:48%; float:left; margin-right: 3%;">
        <label style="width:150px;">Phone</label>
        <input name="phone" id="phone" type="text"  value="" style="width:90%" pattern="[0-9]+-[0-9]+" placeholder="Example : 021-1234567">
  		</fieldset>
        <fieldset style="width:48%; float:right;">
        <label style="width:150px;">E-Mail</label>
        <input name="email" id="email" type="email"  value="" style="width:90%" placeholder="Example : yourname@website.com">
        </fieldset>
        <fieldset>
        <label style="width:150px;">Website</label>
        <input name="situs" id="situs" type="url"  value="" placeholder="Example : http://yourwebsite.com">
        </fieldset>
        <fieldset style="width:48%; float:left; margin-right: 3%;">
        <label style="width:150px;">Contact Name <font color="#fe0000">*</font></label>
        <input name="kontakNam" id="kontakNam" type="text"  value="" style="width:90%" required>
        </fieldset>
        <fieldset style="width:48%; float:right;">
        <label style="width:150px;">Contact Phone <font color="#fe0000">*</font></label>
        <input name="kontakNo" id="kontakNo" type="text"  value="" style="width:90%" required pattern="[0-9]+-[0-9]+" placeholder="Example : 021-1234567">
        </fieldset>
    <input type="submit" value="Save" class="alt_btn" style="float:right">
    </form>
</div> 
<!-- end of buat popup edit -->

<div id="dialog-confirm" title="Delete Vendor"> 
	<p>
		<span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
		<input type="hidden" value='' id="del_id" name="del_id">
		Are You Sure?</p> 
</div> 

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
						url : "<?php echo site_url('aset/adminFunc/delete_v')?>",
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
		
		$( "#form_vendor" ).dialog({
			autoOpen: false,
			height: 600,
			width: 700,
			modal: true,
			hide: 'Slide',
			close: function() {
				    $('#id').val(''),
					$('#id1').val(''),
					$('#nama').val(''),
					$('#alamat').val(''),
					$('#phone').val(''),
					$('#email').val(''),
					$('#situs').val(''),
					$('#kontakNam').val(''),
					$('#kontakNo').val(''),
					$('#id').attr("disabled",false);
			}
			
		});
	

	$( "#create-daily" )
			.button()
			.click(function() {
				$( "#form_vendor").dialog( "open" );
				
			});
	});
	
	$(".edit").live("click",function(){
		var id = $(this).attr("kode");
		var nama = $(this).attr("nama");
		var alamat = $(this).attr("alamat");
		var phone= $(this).attr("telpon");
		var email = $(this).attr("surel");
		var situs = $(this).attr("situs");
		var kontakNam = $(this).attr("kontakNam");
		var kontakNo = $(this).attr("kontakNo");

		$('#id').val(id);
		$('#id1').val(id);
        $('#nama').val(nama);
		$('#alamat').val(alamat);
		$('#phone').val(phone);
		$('#email').val(email);
        $('#situs').val(situs);
		$('#kontakNam').val(kontakNam);
		$('#kontakNo').val(kontakNo);
		$('#id').attr("disabled",true);
        
        $( "#form_vendor" ).dialog( "open" );
        
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