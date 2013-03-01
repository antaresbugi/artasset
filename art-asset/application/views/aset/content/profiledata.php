<?php foreach($data as $pro): ?>		
                		 <fieldset>
							<label>User ID</label>
							<input type="text" name="userid" id="userid" value="<?php echo $pro->nomorKaryawan; ?>" style="width:95%;" readonly="readonly">
						</fieldset>
                        <fieldset style="width:20%; float:left; margin-right: 3%;">
                           <?php
						   echo "<a href=\"#\" class=\"edit\" kode=\"$pro->nomorKaryawan\">";
						   echo "<img src='".base_url()."treasure/img/$pro->pic' height='240' width='180'>";
						   echo "</a>";
						   ?>
						</fieldset>
                        
						<fieldset style="width:75%; float:right;">
							<label>Name</label>
							<input type="text" name="nama" id="nama" value="<?php echo $pro->fullName; ?>" style="width:95%;" readonly="readonly">
						</fieldset>
						<fieldset style="width:75%; float:right;">
							<label>Telephone Number</label>
							<input type="text" name="phone" id="phone" style="width:92%;" value="<?php echo $pro->phone; ?>" readonly="readonly">
						</fieldset>
                        
						<fieldset style="width:75%; float:right;"> 
							<label>Email</label>
							<input type="email" name="email" id="email" style="width:92%;" value="<?php echo $pro->email; ?>" readonly="readonly">
						</fieldset>
                        <?php endforeach ?>