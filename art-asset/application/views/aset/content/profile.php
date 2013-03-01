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
			<header><h3>My Profile</h3></header>
				<div class="module_content">	
                <?php $this->load->view('/aset/content/profiledata'); ?>
                		<div class="clear"></div>
				</div>
                
			<footer>
				<div class="submit_link">
					<!--<input type="submit" value="Save" class="alt_btn">
					<input type="reset" value="Reset">-->
				</div>
			</footer></form>
            
<div id="form_up" name="form_up" title="Upload Photo">
<form id='formup' name='formup' method='post' action='<?php echo site_url('aset/adminFunc/cupload');?>' enctype="multipart/form-data">
        <fieldset>
        <input type="hidden" id="namafile" name="namafile" value="<?php echo $this->session->userdata('nomorKaryawan'); ?>.jpg">
        <label style="width:150px;">Select File</label>
    	<?php echo form_upload('userfile');?>
        </fieldset>
    <input type="submit" name="upload" id="upload" value="Upload" class="alt_btn" style="float:right">
    </form>
</div> 

		</article><!-- end of post new article -->
				
        <script type="text/javascript" charset="utf-8">
	$(function() {

		$( "#dialog:ui-dialog" ).dialog( "destroy" );
		
		$( "#form_up" ).dialog({
			autoOpen: false,
			height: 150,
			width: 400,
			modal: true,
			hide: 'Slide',
			close: function() {
					$('#id').val('');
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

		$('#id').val(id);
        
        $( "#form_up" ).dialog( "open" );
        
        return false;
	});	
	
	</script>
        
		<div class="spacer"></div>