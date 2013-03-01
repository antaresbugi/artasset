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
        <header><h3>Disposal</h3></header>
        	<div class="module_content">
            <form class="quick_search" action="<?php echo site_url('aset/admin/homedisposal/')?>" method="post"> 
				<input name="disposalac" id="disposalac" type="text" value="Search Disposed Asset by Asset ID" onFocus="if(!this._haschanged){this.value=''};" onblur="if(!this._haschanged){this.value='Search Disposed Asset by Asset ID'};" onkeyup="submitA(this,this.form)">
			</form>
            <div class="clear"></div>
            </div>
        </article>
        <article class="module width_full">
        <header><h3>Datas</h3></header>
            <div id="tabel_data">
            <?php $this->load->view('/aset/content/disposalAll'); ?>
            </div>
        </article>
        
        <div id="updateser" name="updateser" title="Update Disposal Data">
        <form id='update_ser' name='update_ser' method='post' action='<?php echo site_url('aset/adminFunc/edit_rem_dis');?>' >
            <input name="id" id="id" type="hidden" value ="">
            <input name="stadis" id="stadis" type="hidden"  value="" class="stadis">
            <input name="idAset" id="idAset" type="hidden" value ="">
                <fieldset>
                <label style="width:150px;">Action</label>
                <select name="resourceState" onchange="displayUpdateTo(this.form)" style="width : 95%" id="resourceState">
								<option value="0">Edit</option>
                                <option value="1">Remove</option>
				</select>
                </fieldset>
                <fieldset id="fieldup" name="fieldup" class="fieldup">
                	<label style="width:150px;">Disposal Status</label>
                    <select name="disposeState" onchange="displayDisTo(this.form)" style="width : 95%" id="disposeState">
                    
								<option value="0">Disposed</option>
                                <option value="1">Sold</option>
				</select>
                </fieldset>
                <fieldset id="fieldup" name="fieldup" class="fieldup">
        	        <label style="width:150px;" class="discost">Cost</label>
		    	    <input name="discos" id="discos" type="text"  value="" style="width:92%" class="discost">
                    <label style="width:150px;" class="dissell">Selling Price</label>
		    	    <input name="dissell" id="dissell" type="text"  value="" style="width:92%" class="dissell">
                    
                </fieldset>
                <fieldset class="delete_up">
                <div class="module_content">
                	<p>This action cannot be undone. Are You Sure?</p>
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
						$('.fieldup').show();
						$('.delete_up').hide();	
						$( "#updateser" ).dialog({
								height: 300,
								width: 520,
						});
                    }
					else if (rState == 1)
                    {
                    	$('.fieldup').hide();
						$('.delete_up').show();

						document.getElementById('ubahlah').setAttribute('value','Remove');
                    }
            };
			
		function displayDisTo(form)
            {
                    var dState = form.disposeState.value;

                    if (dState == 0)
                    {
						$('.discost').show();
						$('.dissell').hide();	
                    }
					else if (dState == 1)
                    {
                    	$('.discost').hide();
						$('.dissell').show();
                    }
            };
	
	    $(this).ready( function() {
    		$("#disposalac").autocomplete({
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
					//window.location.href = "<?php echo site_url('aset/admin/homedisposal/')?>";
         		},		
    		});
	    });
		
		//untuk div2an
		$(function() {
			$('.delete_up').hide();

			$( "#dialog:ui-dialog" ).dialog( "destroy" );		
			$( "#updateser" ).dialog({
				autoOpen: false,
				height: 300,
				width: 520,
				modal: true,
				hide: 'Slide',
				close: function() {
						$('#id').val(''),
						$('#idAset').val(''),
						$('#discos').val(''),
						$('#dissell').val(''),
						$('#stadis').val(''),
						$('#disposeState').val('')
				}
				
			});
	
		});//penutup dari function()
		
		$(".edit").live("click",function(){
			var id = $(this).attr("kode");
			var idAset = $(this).attr("idAset");
			var discos = $(this).attr("cost");
			var dissell = $(this).attr("cost");
			var statdis= $(this).attr("status");
	
			$('#id').val(id);
			$('#idAset').val(idAset);
			$('#discos').val(discos);
			$('#dissell').val(dissell);
			$('#stadis').val(statdis);
			$('#disposeState').val(statdis);
			
			//saat awal
			$('.dissell').show();
			$('.discost').show();
			
			if(statdis == 0) $('.dissell').hide();
			else $('.discost').hide();
			
			$( "#updateser" ).dialog( "open" );
			
			return false;
		});
		
   </script>