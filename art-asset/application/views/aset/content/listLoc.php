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
<header><h3>Location List</h3>
<!--
misalnya suatu saat butuh button tambahan diatas :D
<button id="print" style="position:absolute; margin-left:-40px; margin-bottom:5px; margin-top:1px" title="Print"><img src='<?php echo base_url()?>images/icn_new_article.png'></button>-->
<button id="create-daily" style="float:right; margin-bottom:5px; margin-top:1px;" title="Add New Location"><img src='<?php echo base_url()?>images/icn_new_article.png'></button>
</header>

<div id="tabel_data">
<?php $this->load->view('/aset/content/listLocTable'); ?>
</div>

<!-- buat popup edit -->
<div id="form_loc" name="form_loc" title="Detail / Edit Data">
<form id='formloc' name='formloc' method='post' action='<?php echo site_url('aset/adminFunc/edit_loc');?>' >
    <input name="id" id="id" type="hidden" class ="">
        <fieldset>
        <label style="width:150px;">Location Name <font color="#fe0000">*</font></label>
    	<input name="nama" id="nama" type="text"  value="" style="width:92%" required>
        </fieldset>
        <fieldset>
        <label style="width:150px;">Description</label>
        <textarea name="deks" id="deks" type="text" rows="5" value="" style="width:92%"></textarea>
        </fieldset>
        <fieldset>
        <label style="width:150px;">Last Update</label>
        <input name="tgl" id="tgl" type="text"  value="" style="width:92%">
        </fieldset>
    <input type="submit" value="Save" class="alt_btn" style="float:right">
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
<form id='forminloc' name='forminloc' method='post' action='<?php echo site_url('aset/adminFunc/input_loc');?>' >
	<fieldset>
        <label style="width:150px;">Location Name <font color="#fe0000">*</font></label>
    	<input name="nama" id="nama" type="text"  value="" style="width:92%" required>
    </fieldset>
    <fieldset>
        <label style="width:150px;">Description</label>
        <textarea name="deks" id="deks" type="text" rows="5" value="" style="width:92%"></textarea>
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
						url : "<?php echo site_url('aset/adminFunc/delete_l')?>",
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
			height: 400,
			width: 520,
			modal: true,
			hide: 'Slide',
			close: function() {
					$('#id').val(''),
					$('#nama').val(''),
					$('#deks').val(''),
					$('#tgl').val(''),
					$('#tgl').attr("disabled",false);
			}
			
		});
	
	$( "#form_inloc" ).dialog({
			autoOpen: false,
			height: 300,
			width: 520,
			modal: true,
			hide: 'Slide',
			buttons: {
			}, 
			close: function() {
				    $('#nama').val(''),
					$('#deks').val('');
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
		var deks= $(this).attr("deks");
		var tgl = $(this).attr("tgl");

		$('#id').val(id);
        $('#nama').val(nama);
		$('#deks').val(deks);
		$('#tgl').val(tgl);
		$('#tgl').attr("disabled",true);
        
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