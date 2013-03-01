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
        <header><h3>Service / Maintenance</h3></header>
        	<div class="module_content">
            <form class="quick_search" action="<?php echo site_url('aset/admin/homeservice/')?>" method="post"> 
				<input name="serviceac" id="serviceac" type="text" value="Search Service by Asset ID" onFocus="if(!this._haschanged){this.value=''};" onblur="if(!this._haschanged){this.value='Search Service by Asset ID'};" onkeyup="submitA(this,this.form)">
			</form>
            <div class="clear"></div>
            </div>
        </article>
        <article class="module width_full">
        <header><h3>Datas</h3></header>
            <div id="tabel_data">
            <?php $this->load->view('/aset/content/serviceAll'); ?>
            </div>
        </article>
        
        <div id="updateser" name="updateser" title="Update Service Data">
        <form id='update_ser' name='update_ser' method='post' action='<?php echo site_url('aset/adminFunc/update_rem');?>' >
            <input name="id" id="id" type="hidden" value ="">
            <input name="idAset" id="idAset" type="hidden" value ="">
            <input name="biayar" id="biayar" type="hidden" value ="">
                <fieldset>
                <label style="width:150px;">Action</label>
                <select name="resourceState" onchange="displayUpdateTo(this.form)" style="width : 95%" id="resourceState">
								<option value="0">Update</option>
								<option value="1">Edit</option>
                                <option value="2">Remove</option>
							</select>
                </fieldset>
                <fieldset id="fieldup" name="fieldup" class="fieldup">
                	<label style="width:150px;">Service Cost</label>
			    	<input name="sercos" id="sercos" type="text"  value="" style="width:92%">
                </fieldset>
                <fieldset id="fieldup" name="fieldup" class="fieldup">
        	        <label style="width:150px;">Description</label>
		    	    <textarea name="deks" id="deks" type="text" rows="5" value="" style="width:92%"></textarea>
                </fieldset>
                <fieldset class="delete_up">
                <div class="module_content">
                	<p>This action cannot be undone. Are You Sure?</p>
                </div>
                </fieldset>
                <fieldset class="update_com">
                <div class="module_content update_com">
                	<p>This Service is Completed.</p>
                </div>
                </fieldset>
            <input type="submit" id="ubahlah" value="Save" class="alt_btn" style="float:right">
            </form>
        </div> 
        
        
        <script type="text/javascript">
		var x=11;//nr characters
		function submitA(t,f){
			if(t.value.length==x){
				f.submit()
			}
		} 
		
		function displayUpdateTo(form)
            {
                    var rState = form.resourceState.value;
					//default value
					document.getElementById('ubahlah').setAttribute('value','Save');
					$( "#updateser" ).dialog({
								height: 220,
								width: 520,
					});
                    if (rState == 0)
                    {
						$('.fieldup').hide();
						$('.delete_up').hide();
						$('.update_com').show();		
                    }
                    else if (rState == 1)
                    {
                    	$('.fieldup').show();
						$('.delete_up').hide();
						$('.update_com').hide();
						$( "#updateser" ).dialog({
								height: 380,
								width: 520,
						});
						
                    }
					else if (rState == 2)
                    {
                    	$('.fieldup').hide();
						$('.delete_up').show();
						$('.update_com').hide();
						document.getElementById('ubahlah').setAttribute('value','Remove');
                    }
            };
	
	    $(this).ready( function() {
    		$("#serviceac").autocomplete({
      			minLength: 1,
      			source: 
        		function(req, add){
          			$.ajax({
		        		url: "<?php echo site_url('aset/admin/quick_access')?>",
		          		dataType: 'json',
		          		type: 'POST',
		          		data: req,
		          		success:    
		            	function(data){
		              		if(data.response =="true"){
		                 		add(data.message);
		              		}
		            	},
              		});
         		},
         	select: 
         		function(event, ui) {
					//window.location.href = "<?php echo site_url('aset/admin/homeservice/')?>";
         		},		
    		});
	    });
		
		//untuk div2an
		$(function() {
			$('.fieldup').hide();
			$('.delete_up').hide();
			$( "#dialog:ui-dialog" ).dialog( "destroy" );		
			$( "#updateser" ).dialog({
				autoOpen: false,
				height: 220,
				width: 520,
				modal: true,
				hide: 'Slide',
				close: function() {
						$('#id').val(''),
						$('#idAset').val(''),
						$('#sercos').val(''),
						$('#biayar').val(''),
						$('#deks').val('')
				}
				
			});
	
		});//penutup dari function()
		
		$(".edit").live("click",function(){
			var id = $(this).attr("kode");
			var idAset = $(this).attr("idAset");
			var sercost = $(this).attr("cost");
			var biayar = $(this).attr("cost");
			var deks= $(this).attr("deks");
	
			$('#id').val(id);
			$('#idAset').val(idAset);
			$('#sercos').val(sercost);
			$('#biayar').val(biayar);
			$('#deks').val(deks);
			
			$( "#updateser" ).dialog( "open" );
			
			return false;
		});
		
   </script>