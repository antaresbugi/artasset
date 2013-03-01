<?php 
$i = 0;
foreach($data as $d):
?>
<article class="module width_full">
<div class="module_content">	
<table width="100%" border="0">
    <tr><td>
        <table width="100%" border="0" class="rerep">
            <tr><td>
            	<table width="100%" border="0" class="rerep">
                    <tr>
                        <td width="30%" align="right">
                        <img src='<?php echo base_url() ?>images/logoseadanya.png' >
                        </td>
                        <td style="padding:0 10px 0 10px;">
                        <h3>PT. Artistika Inkernas</h3>
                        <p>
                        Pondok Cipta i/45.<br />
                        17134.<br />
                        021-8852742.
                        </p>
                        </td>
                    </tr>
                </table>
            </td></tr>
        </table>
    </td></tr>
</table> 
<table width="100%" border="0">
<?php
//kondisi atau status dengan hasilnya :)
		  $statuscek = $d->statusAset;
		  $kondisicek = $d->kondisiAset;
		  
		  if($statuscek==0){
		  	$status = 'In Store';
		  } else if($statuscek==1){
			$status = 'In Use';
		  } else if($statuscek==2){
			$status = 'In Repair';
		  } else if($statuscek==3){
			$status = 'Disposed';
		  }
		  
		  if($kondisicek==0){
		  	$kondisi = 'New';
		  } else if($kondisicek==1){
			$kondisi = 'Good';
		  } else if($kondisicek==2){
			$kondisi = 'Fair';
		  } else if($kondisicek==3){
			$kondisi = 'Poor';
		  }
?>
  <tr>
    <td><table width="100%" border="1" class="rerep">
      <tr>
        <td width="90%" valign="top" class="rerep"><table width="100%" border="0" style="padding: 2px 2px 2px 2px;" >
          <tr>
            <td width="20%" height="25" bgcolor="#ddffdd"><strong>Asset ID</strong></td>
            <td width="10" bgcolor="#ddffdd"><strong>:</strong></td>
            <td bgcolor="#ddffdd"><strong><?php echo  $d->idAset ?></strong></td>
          </tr>
          <tr>
            <td height="25">Asset Name</td>
            <td>:</td>
            <td><?php echo $d->namaAset ?></td>
          </tr>
          <tr>
            <td height="25">Location</td>
            <td>:</td>
            <td><?php echo $d->namaDept ?></td>
          </tr>
          <tr>
            <td height="25">Type</td>
            <td>:</td>
            <td><?php echo $d->klasName ?></td>
          </tr>
          <tr>
            <td height="25">Vendor</td>
            <td>:</td>
            <td><?php echo $d->vendorNama ?></td>
          </tr>
          <tr>
            <td height="25">Condition</td>
            <td>:</td>
            <td><?php echo $kondisi ?></td>
          </tr>
          <tr>
            <td height="25">Status</td>
            <td>:</td>
            <td><?php echo $status;
				if($statuscek==1)echo ' and Assigned to '.$d->petugasAset;
				?>
			</td>
          </tr>
          <tr>
            <td height="25">Purchase Cost</td>
            <td>:</td>
            <td><?php echo number_format($d->hargaBeli,2) ?></td>
          </tr>
          <tr>
            <td height="25">Acquisition Date</td>
            <td>:</td>
            <td><?php 
			$tgl = date("M jS, Y", strtotime($d->tgl_beli));
			echo  $tgl ?></td>
          </tr>
          
          <tr>
            <td height="25">Cost</td>
            <td>:</td>
            <td><?php echo number_format($d->assetcost,2) ?></td>
          </tr>
          
          <tr>
            <td height="25">&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          
          <tr>
            <td height="25" valign="baseline">Description</td>
            <td valign="baseline">:</td>
            <td>
		<textarea name="desk" class="desk" id="desk" rows="12" cols="70%" readonly="readonly" style="
                    border: 0px solid #BBBBBB;
                    overflow:scroll,
                    padding-left: 10px;
                    padding-top:1px;
                    padding-bottom:1px;
                    color: #666666;
                    width: 96%;
                    font-family:'Helvetica Neue', Helvetica, Arial, Verdana, sans-serif;
                    font-size: 12px;
                    resize:none;
            "><?php echo $d->keteranganAset ?></textarea>  
            </td>
          </tr>
        </table></td>
        <td width="10%" valign="baseline" class="rerep"><table width="100%" border="0" >
          <tr>
            <td align="center"><div id="barcodepic<?php echo $i ?>"></div></td>
            <script type="text/javascript" charset="utf-8">
			var settings = {
							  output:"bmp",
							  bgColor:"#FFFFFF",
							  color:"#000000",
							  barWidth:"1",
							  barHeight:"50"
							};
			    $("#barcodepic<?php echo $i ?>").html("").barcode("<?php echo $d->idAset ?>", "code128",settings);     
			</script>
          </tr>
          <tr>
            <td align="center"><fieldset style="width:20%; margin-right: 3%;">
                           <?php
						   echo "<img src='".base_url()."treasure/img/$d->assetpic' height='240' width='180'>";
						   ?>
			</fieldset></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table> 
</div>
</article><!-- end of stats article -->
<?php 
$i++;
endforeach; ?>