<section id="secondary_bar">
		<div class="user">
			<p>
            	<a href="<?php echo base_url();?>aset/admin/profile">
					<?php echo $this->session->userdata('nama');?>
                </a>
            <?php
				if($pesan>0){
					echo "(<blink><a href='".base_url()."aset/admin/approval'><font color='red'>$pesan Messages</font></a></blink>)</p>";
				}
			?>
		</div>
		<div class="breadcrumbs_container">
			<article class="breadcrumbs">
            <a href="<?php echo base_url();?>">Home</a>
                <?php 
				if($breadcrumbs){
					//echo "<div class='breadcrumb_divider'></div>";
					//echo "<a>gdfgdf</a>";
					for($i=0;$i<(sizeOf($breadcrumbs)-1);$i++){	
						//cari cara baca array
						echo "<div class='breadcrumb_divider'></div>";
						echo "<a>".$breadcrumbs[$i]."</a>";
					}
					echo "<div class='breadcrumb_divider'></div>";
					echo "<a class='current'>".$breadcrumbs[$i]."</a>";
					}
					else
					{
					}
				?>
            </article>
		</div>
</section>