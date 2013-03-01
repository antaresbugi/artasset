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
<header><h3>Asset Data</h3>
</header>

<div id="tabel_data">
<?php $this->load->view('/aset/content/assetTable'); ?>
</div>

<div id="dialog-approve" title="Confirmation"> 
	<p>
		<input type="hidden" value='' id="del_id" name="del_id">
		<img src='<?php echo base_url()?>images/icn_alert_success.png'> Are You Sure to <strong>Approve</strong>?</p> 
</div> 

</article><!-- end of post new article -->

<!-- script popup edit/delete -->
<script type="text/javascript" charset="utf-8">
	$(function() {

		$( "#dialog:ui-dialog" ).dialog( "destroy" );
		$( "#dialog-approve" ).dialog({
			autoOpen: false,			
			resizable: false,
			height:150,
			modal: true,
			hide: 'Slide',
			buttons: {
				Approve: function() {
					var del_id = {kode : $("#del_id").val()};
					$.ajax({
						type: "POST",
						url : "<?php echo site_url('aset/adminFunc/app_pr')?>",
						data: del_id,
						success: function(msg){
							$('#tabel_data').html(msg);
							$('#notif').html(msg);
							$.jGrowl("<h4>Purchase Request Approved</h4>");	
							$('#dialog-approve' ).dialog( "close" );
						}
				  	});

					},
				Close: function() {
					$( this ).dialog( "close" );
				}
			}
		});

	$( "#create-daily" )
			.button()
			.click(function() {
				$( this ).dialog( "open" );				
			});
	
	});
	
	
	$(".del-approve").live("click",function(){
    	var kode = $(this).attr("kode");
    	var info = 'kode=' + kode;
    	$('#del_id').val(kode);
		
    	$( "#dialog-approve" ).dialog( "open" );

    	return false;
 	});	
	
	</script>
<!-- end of script popup edit -->  
				
<div class="spacer"></div>