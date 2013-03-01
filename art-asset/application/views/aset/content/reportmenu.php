<article class="module width_full">
			<header><h3>Report Menu</h3></header>
            <form action="<?php echo base_url();?>aset/adminFunc/reporting" method="post" name="crerep" enctype="multipart/form-data">
			<div class="module_content">
                 <fieldset style="width:48%; float:left; margin-right: 3%;">
							<label>Type of Report</label>
							<select name="isitipe" onchange="displayRepTo(this.form)" style="width : 95%;" id="isitipe" class="isitipe">
							  <option value="0">Asset List</option>
                              <option value="1">- by Condition</option>
                              <option value="2">- by Status</option>
                              <option value="3">- by Type</option>
   							  <option value="4">Asset Detail</option>
                              <!-- <option value="5">Almost Expired</option> -->
							</select>
					</fieldset>
					<fieldset class="asset" style="width:48%; float:right;">  
							<label>Asset ID</label>
							<input type="text" name="aset" id="aset" style="width:92%;" placeholder="Leave Empty to Create All Data">
					</fieldset>
                     <fieldset style="width:48%; float:right;" class="cond">
							<label>Condition</label>
                            <select name="condi" id="condi" style="width:95%;" >
                            	<option value='0'>New</option>
                                <option value='1'>Good</option>
                                <option value='2'>Fair</option>
                                <option value='3'>Poor</option>
							</select>
					</fieldset>  
                    <fieldset style="width:48%; float:right;" class="stats">
							<label>Status</label>
                            <select name="statu" id="statu" style="width:95%;" >
                            	<option value='0'>In Store</option>
                                <option value='1'>In Use</option>
                                <option value='2'>In Repair</option>
                                <option value='3'>Disposed</option>
							</select>
					</fieldset>  
                    <fieldset style="width:48%; float:right;" class="titip">
							<label>Type</label>
                            <select name="tipel" id="tipel" style="width:95%;" >
                            <?php foreach($typelist as $tl):?>
                            	<option value='<?php echo $tl->klasID ?>'><?php echo $tl->klasName ?></option>
	                        <?php endforeach;?>
							</select>
					</fieldset>  
				<div class="clear"></div>
			</div>
			<footer>
            	<div class="submit_link">
                	<input type="submit" name="upload" id="upload" value="Create Report" class="alt_btn">
                </div>
            </footer>
            </form>
		</article><!-- end of stats article -->
		
		<div class="spacer"></div>
<div class="spacer2"></div>
<script type="text/javascript">
	function displayRepTo(form)
            {
                    var rState = form.isitipe.value;
            
                    //alert ("  rState "+rState+" activeState "+activeState);
                    if (rState == 0) //asset list
                    {
	                    $('fieldset.cond').hide();
						$('fieldset.asset').hide();
						$('fieldset.stats').hide();
						$('fieldset.titip').hide();
                    }
                    else if (rState == 1) //by condition
                    {
                    	$('fieldset.cond').show();
						$('fieldset.asset').hide();
						$('fieldset.stats').hide();
						$('fieldset.titip').hide();
                    }
					else if (rState == 2) //by status
                    {
                    	$('fieldset.cond').hide();
						$('fieldset.asset').hide();
						$('fieldset.stats').show();
						$('fieldset.titip').hide();
                    }
					else if (rState == 3) //by type
                    {
                    	$('fieldset.cond').hide();
						$('fieldset.asset').hide();
						$('fieldset.stats').hide();
						$('fieldset.titip').show();
                    }
					else if (rState == 4) //asset detail
                    {
                    	$('fieldset.cond').hide();
						$('fieldset.asset').show();
						$('fieldset.stats').hide();
						$('fieldset.titip').hide();
                    }
					else if (rState == 5) //expire
                    {
                    	$('fieldset.cond').hide();
						$('fieldset.asset').hide();
						$('fieldset.stats').hide();
						$('fieldset.titip').hide();
                    }
            };
			
			
	$(function () {
			$('fieldset.asset').hide();
			$('fieldset.cond').hide();
			$('fieldset.stats').hide();
			$('fieldset.titip').hide();
		});
			
	$(this).ready( function() {
    		$("#aset").autocomplete({
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
					//entah apa isinya
         		},		
    		});
	    });
</script>