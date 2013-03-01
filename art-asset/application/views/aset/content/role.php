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
<header><h3>Role List</h3>
<button id="create-daily" style="float:right; margin-bottom:5px; margin-top:1px" title="Add New Type"><img src='<?php echo base_url()?>images/icn_new_article.png'></button>
</header>
<div class="module_content">
    Note:
    <table width="100%" border="0">
      <tr>
        <td width="30%" valign="baseline">
        	<ul>
                <li>A = Manage Asset</li>
                <li>SM = Manage Service / Maintenance</li>
                <li>D = Manage Disposal</li>
                <li>T = Manage Type</li>
                <li>L= Manage Location</li>
            </ul></td>
        <td valign="baseline">
        	<ul>
                <li>V = Manage Vendor</li>
                <li>U = Manage User</li>
                <li>R = Manage Role</li>
                <li>Re = Manage Report</li>
            </ul></td>
      </tr>
    </table>
    
</div>
<div id="tabel_data">
<?php $this->load->view('/aset/content/roleTable'); ?>
</div>

<div id="form_inklas" name="form_inklas" title="Input Role">
<form id='forminklas' name='forminklas' method='post' action='<?php echo site_url('aset/adminFunc/inputrole');?>' >
	<fieldset>
			<label>Name <font color="#fe0000">*</font></label>
		  <input type="text" name="nama" id="nama" style="width:92%"  required>
	</fieldset>
    
    <fieldset>
        <?php 
		$i=0;
		foreach ($inin as $ad):
		?>
          <p>
          <label style="width:92%" >
            <input type="checkbox" value="<?php echo $ad->idPermisi ?>" name="cek<?php echo $i?>" id="cek<?php echo $i?>">
            <?php echo $ad->namaPermisi ?></label>
          </p>
            <?php 
			$i++;
			endforeach; ?>
     </fieldset>
    
    <input type="submit" value="Save" class="alt_btn" style="float:right">
    </form>
</div> 

</article><!-- end of post new article -->				
<div class="spacer"></div>
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
						url : "<?php echo site_url('aset/adminFunc/delete_k')?>",
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
	
	$( "#form_inklas" ).dialog({
			autoOpen: false,
			height: 455,
			width: 500,
			modal: true,
			hide: 'Slide',
			close: function() {
				    $('#nama').val(''),
					$('#deks').val('');
			}
			
		});

	$( "#create-daily" )
			.button()
			.click(function() {
				$( "#form_inklas").dialog( "open" );
				
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
        
        $( "#form_klas" ).dialog( "open" );
        
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