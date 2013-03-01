<?php
foreach (array_keys($sesyen) as $sad){
	foreach ($sesyen[$sad] as $sadd){
		if($sadd['idPermisi'] == 1) $stat1 = $sadd['stat'];
		if($sadd['idPermisi'] == 2) $stat2 = $sadd['stat'];
		if($sadd['idPermisi'] == 3) $stat3 = $sadd['stat'];
		if($sadd['idPermisi'] == 4) $stat4 = $sadd['stat'];
		if($sadd['idPermisi'] == 5) $stat5 = $sadd['stat'];
		if($sadd['idPermisi'] == 6) $stat6 = $sadd['stat'];
		if($sadd['idPermisi'] == 7) $stat7 = $sadd['stat'];
		if($sadd['idPermisi'] == 8) $stat8 = $sadd['stat'];
		if($sadd['idPermisi'] == 9) $stat9 = $sadd['stat'];
	}
}
?>
<aside id="sidebar" class="column">
		<form class="quick_search" action="<?php echo site_url('aset/adminFunc/quicka/')?>" method="post"> 
			<input name="quickac" id="quickac" type="text" value="Quick Access" onFocus="if(!this._haschanged){this.value=''};" onblur="if(!this._haschanged){this.value='Quick Access'};" onkeyup="submitT(this,this.form)">
		</form>
		<hr/>
        <?php if($stat1=='yes' || $stat2=='yes' || $stat3=='yes'):?>
		<h3><a href="<?php echo base_url();?>aset/admin/frontasset">Asset</a></h3>
		<ul class="toggle">
			<!--<li class="icn_new_article"><a href="<?php echo base_url();?>aset/admin/frontpurreq">Purchase Request</a></li>-->
            <!-- bagian aset -->
            <?php if($stat1=='yes'):?>
            <li class="icn_new_article"><a href="<?php echo base_url();?>aset/admin/newasset">New Asset</a></li>
			<li class="icn_asset"><a href="<?php echo base_url();?>aset/admin/asset">Assets</a></li>
            <?php endif; ?>
            <!-- bagian sm -->
            <?php if($stat2=='yes'):?>
            <li class="icn_service"><a href="<?php echo base_url();?>aset/admin/homeservice">Service / Maintenance</a></li>
            <?php endif; ?>
            <!-- bagian disposal -->
            <?php if($stat3=='yes'):?>
            <li class="icn_jump_back"><a href="<?php echo base_url();?>aset/admin/homedisposal">Disposal</a></li>
            <?php endif; ?>
		</ul>
         <?php endif; ?>
         <?php if($stat4=='yes' || $stat5=='yes' || $stat6=='yes'):?>
        <h3>Support Data</h3>
		<ul class="toggle">
        	<!-- bagian tipe  -->
            <?php if($stat4=='yes'):?>
	        <li class="icn_categories"><a href="<?php echo base_url();?>aset/admin/listklas">Type</a></li>
            <?php endif; ?>
            <!-- bagian location -->
            <?php if($stat5=='yes'):?>
			<li class="icn_tags"><a href="<?php echo base_url();?>aset/admin/listloc">Location</a></li>
            <?php endif; ?>
            <!-- bagian vendor -->
            <?php if($stat6=='yes'):?>
			<li class="icn_new_article"><a href="<?php echo base_url();?>aset/admin/vendor">New Vendor</a></li>
			<li class="icn_vendor"><a href="<?php echo base_url();?>aset/admin/listvendor">View Vendors</a></li>
            <?php endif; ?>
		</ul>
        <?php endif; ?>
        <?php if($stat9=='yes'):?>
        <h3>Reports</h3>
        <ul class="toggle">
	        <li class="icn_report"><a href="<?php echo base_url();?>aset/admin/report">Asset Reports</a></li>
		</ul>
        <?php endif; ?>
        <h3>Users</h3>
		<ul class="toggle">
        	<!-- bagian user -->
            <?php if($stat7=='yes'):?>
			<li class="icn_add_user"><a href="<?php echo base_url();?>aset/admin/user">New User</a></li>
			<li class="icn_view_users"><a href="<?php echo base_url();?>aset/admin/listuser">View Users</a></li>
            <?php endif; ?>
			<li class="icn_profile"><a href="<?php echo base_url();?>aset/admin/profile">Your Profile</a></li>
		</ul>
        <!-- bagian admin -->
        <?php if($stat8=='yes'):?>
		<h3>Admin</h3>
		<ul class="toggle">
			<li class="icn_security"><a href="<?php echo base_url();?>aset/admin/role">Manage Role</a></li>
		</ul>
        <?php endif; ?>
		<footer>
			
			<p><strong>Copyright &copy; 2011 <a href="http://www.medialoot.com">MediaLoot</a></strong></p>
            <p>Modified by <strong>Antares Bugi</strong></p>
		</footer>
	</aside><!-- end of sidebar -->
    
    <script type="text/javascript">
		var x=11;//nr characters
			function submitT(t,f){
			if(t.value.length==x){
			f.submit()
		}
		} 
	
	    $(this).ready( function() {
    		$("#quickac").autocomplete({
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
					window.location.href = "<?php echo site_url('aset/admin/itemasset/')?>"+"/"+ui.item.value;
         		},		
    		});
	    });
   </script>