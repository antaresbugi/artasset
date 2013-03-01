		
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
        <form action="<?php echo base_url();?>aset/adminFunc/input_user" method="post" name="addUser">
			<header><h3>New User</h3></header>
				<div class="module_content">			
                		<fieldset>
							<label>User ID</label>
							<input type="text" id="id" name="id" value="<?php echo $data; ?>" disabled="disabled">
                            <input type="hidden" id="id1" name="id1" value="<?php echo $data; ?>">
							<label>Password <font color="#fe0000">*</font></label>
							<input type="password" name="pass" id="pass" required>
						</fieldset>
						<fieldset>
							<label>Name <font color="#fe0000">*</font></label>
							<input type="text" name="nama" id="nama" required>
						</fieldset>
                        
						<fieldset style="width:48%; float:left; margin-right: 3%;">
							<label>Telephone Number</label>
							<input type="text" name="phone" id="phone" style="width:92%;" pattern="[0-9]+-[0-9]+" placeholder="Example : 021-1234567">
						</fieldset>
                        
						<fieldset style="width:48%; float:right;"> 
							<label>Email</label>
							<input type="email" name="email" id="email" style="width:92%;" placeholder="Example : yourname@website.com">
						</fieldset>
                        <fieldset style="width:48%; float:left; margin-right: 3%;">
							<label>Position/Role</label>
							<select name="position" id="position">
                            <?php foreach($sessien as $ss): ?>
								<option value="<?php echo $ss->sessionid ?>"><?php echo $ss->sessionname ?></option>
                            <?php endforeach ?>
							</select>
						</fieldset>
                        <fieldset style="width:48%; float:right;">
							<label>Status</label>
							<select name="status" id="status">
								<option value="1">Active</option>
								<option value="0">Inactive</option>
							</select>
						</fieldset>
                		<div class="clear"></div>
				</div>
			<footer>
				<div class="submit_link">
					<input type="submit" value="Save" class="alt_btn">
					<input type="reset" value="Reset">
				</div>
			</footer></form>
		</article><!-- end of post new article -->
				
		<div class="spacer"></div>