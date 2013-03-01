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
<header><h3>User List</h3></header>

<div id="tabel_data">
<?php $this->load->view('/aset/content/listUserTable'); ?>
</div>

<!-- buat popup edit -->
<div id="form_user" name="form_user" title="Edit Data">
<form id='formuser' name='formuser' method='post' action='<?php echo site_url('aset/adminFunc/edit_user');?>' >
	<input name="id1" id="id1" type="hidden" class ="">
    <fieldset>
        <label style="width:150px;">User ID</label>
    	<input name="id" id="id" type="text"  value="" required>
        <label style="width:150px;">Password<font color="#fe0000">*</font></label>
        <input name="pass" id="pass" type="password"  value="" required>
		</fieldset>
        <fieldset>
        <label style="width:150px;">Name <font color="#fe0000">*</font></label>
    	<input name="nama" id="nama" type="text"  value="" required>
        </fieldset>
        <fieldset style="width:48%; float:left; margin-right: 3%;">
        <label style="width:150px;">Phone</label>
    	<input  name="phone" id="phone" type="text"  value="" style="width:90%" pattern="[0-9]+-[0-9]+" placeholder="Example : 021-1234567">
        </fieldset>
        <fieldset style="width:48%; float:right;">
        <label style="width:150px;">E-Mail</label>
        <input name="email" id="email" type="email"  value="" class="email" style="width:90%" placeholder="Example : yourname@website.com">
        </fieldset>
        <fieldset style="width:48%; float:left; margin-right: 3%;">
        <label style="width:150px;">Position</label>
        <select name="position" id="position" class="required" value="" style="width:90%">
        <?php foreach($sessien as $se): ?>
				<option value="<?php echo $se->sessionid ?>"><?php echo $se->sessionname ?></option>
        <?php endforeach ?>
			</select>
            <!-- position means sessionid on user-->
        </fieldset>
        <fieldset style="width:48%; float:right;">
        <label style="width:150px;">Status</label>
		<select name="status" id="status" class="required" value="" style="width:90%">
				<option value="1">Active</option>
				<option value="0">Inactive</option>
			</select>
		</fieldset>
    <input type="submit" value="Save" class="alt_btn" style="float:right">
    </form>
</div> 
<!-- end of buat popup edit -->

<div id="dialog-confirm" title="Delete User"> 
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
		//$("#formuser").validate();
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
						url : "<?php echo site_url('aset/adminFunc/delete_u')?>",
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
		
		$( "#form_user" ).dialog({
			autoOpen: false,
			height: 460,
			width: 700,
			modal: true,
			hide: 'Slide',
			close: function() {
				    $('#id').val(''),
					$('#id1').val(''),
					$('#pass').val(''),
					$('#nama').val(''),
					$('#phone').val(''),
					$('#email').val(''),
					$('#position').val(''),
					$('#status').val(''),
					$('#id').attr("disabled",false);
			}
			
		});
	

	$( "#create-daily" )
			.button()
			.click(function() {
				$( "#form_user").dialog( "open" );
				
			});
	
	});
	
	$(".edit").live("click",function(){
		var id = $(this).attr("kode");
		var pass = $(this).attr("pass");
		var nama = $(this).attr("nama");
		var phone= $(this).attr("telpon");
		var email = $(this).attr("surel");
		var position = $(this).attr("jabat");
		var status = $(this).attr("status");

		$('#id').val(id);
		$('#id1').val(id);
		$('#pass').val(pass);
        $('#nama').val(nama);
		$('#phone').val(phone);
		$('#email').val(email);
        $('#position').val(position);
		$('#status').val(status),
		$('#id').attr("disabled",true);
        
        $( "#form_user" ).dialog( "open" );
        
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