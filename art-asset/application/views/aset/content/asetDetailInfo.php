<?php foreach($data as $d): ?>			
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
    <td><table width="100%" border="0">
      <tr>
        <td width="90%" valign="top"><table width="100%" border="0">
          <tr>
            <td width="100" height="25"><strong>Asset ID</strong></td>
            <td width="10"><strong>:</strong></td>
            <td><strong><?php echo  $d->idAset ?></strong></td>
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
            <td height="25">Cost</td>
            <td>:</td>
            <td><?php echo number_format($d->assetcost) ?></td>
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
        <td width="10%" valign="baseline"><table width="100%" border="0">
          <tr>
            <td align="center"><div id="barcodepic"></div></td>
            <script type="text/javascript" charset="utf-8">
			var settings = {
							  output:"bmp",
							  bgColor:"#FFFFFF",
							  color:"#000000",
							  barWidth:"1",
							  barHeight:"50"
							};
			    $("#barcodepic").html("").barcode("<?php echo $d->idAset ?>", "code128",settings);     
			</script>
          </tr>
          <tr>
            <td align="center"><fieldset style="width:20%; margin-right: 3%;">
                           <?php
						   echo "<a href=\"#\" class=\"edit\" kode=\"$d->idAset\">";
						   echo "<img src='".base_url()."treasure/img/$d->assetpic' height='240' width='180'>";
						   echo "</a>";
						   ?>
			</fieldset></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table> 
<?php endforeach ?>