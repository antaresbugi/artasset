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
        
			<header><h3 class="tabs_involved">Asset Detail</h3>
            <ul class="tabs">
   			<li><a href="#tab1">Info</a></li>
    		<li><a href="#tab2">Depreciation</a></li>
            <li><a href="#tab3">History</a></li>
            </ul>
            </header>
            <div class="tab_container">
                <div id="tab1" class="tab_content">
                <div class="module_content">
                        <?php $this->load->view('/aset/content/asetDetailInfo'); ?>	
                </div>
                </div><!-- end of #tab1 -->
                
                <div id="tab2" class="tab_content">
                        <?php $this->load->view('/aset/content/tab1Dep'); ?>
                </div><!-- end of #tab2 -->
                <div id="tab3" class="tab_content">
                        <?php $this->load->view('/aset/content/tab2Dep'); ?>
                </div><!-- end of #tab2 -->
                
            </div><!-- end of .tab_container -->
            <footer>
            <div class="submit_link">
            <form name="buttonmenu" id="buttonmenu" method="post" action="<?php echo site_url('aset/adminFunc/menu_detil');?>">
            	<?php foreach($data as $d): ?>	
                <?php if($d->statusAset!=3):?>
            	<input type="hidden" name="idmas" id="idmas" value="<?php echo $d->idAset ?>" />
				<button name="detailas" class="detil" type="submit" value="edit">Edit</button>
				<button name="detailas" id="serpis" class="detil" type="submit" value="serpis">Service / Maintenance</button>
                <button name="detailas" id="dispos" class="detil" type="submit" value="dispos">Disposal</button>
                <?php endif; ?>
                <?php endforeach ?>
            </form>
            
			</div>
            </footer>
		</article>
        
        <div id="form_up" name="form_up" title="Upload Asset Photo">
        <?php foreach($data as $d): ?>			
        <form id='formup' name='formup' method='post' action='<?php echo site_url('aset/adminFunc/aupload');?>' enctype="multipart/form-data">
                <fieldset>
                <input type="hidden" id="namafile" name="namafile" value="<?php echo $d->idAset; ?>.jpg">
                <input type="hidden" id="idd" name="idd" value="<?php echo $d->idAset; ?>">
                <label style="width:150px;">Select File</label>
                <?php echo form_upload('userfile');?>
                </fieldset>
            <input type="submit" name="upload" id="upload" value="Upload" class="alt_btn" style="float:right">
            </form>
            <?php endforeach ?>
        </div> 
        
        <article class="module width_full">
        <header><h3>Last Updated</h3>
        </header>
        	<div class="module_content">
            <?php foreach($data as $d): ?>			
			<?php 
				$tgl_baru = date("M jS, Y", strtotime($d->tgl_updateAset));
				$updater = $d->fullName;
				echo "on <strong>".$tgl_baru."</strong> by <strong>".$updater."</strong>.";
			?>
            <?php endforeach ?>
            </div>
        </article>

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
				if($("#purcos").val()<$( "#salval").val()){
					$( "#erorboy").dialog( "open" );
					return false;
				}
			});
			
			$(".edit").live("click",function(){
				var id = $(this).attr("kode");
		
				$('#id').val(id);
				
				$( "#form_up" ).dialog( "open" );
				
				return false;
			});	
	
		</script>  