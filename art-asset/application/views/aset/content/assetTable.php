<!-- buat tabel cihuy -->    
<table border="0" id="datatable" name="datatable" class="display"  >
 <thead> 
  <tr>
    <td width="3%">ID</td>
    <td width="20%">Name</td>
    <td width="15%">Department</td>
    <td width="15%">Price</td>
    <td width="15%">Cost</td>
    <td width="15%">Charge to</td>
    <td width="10%">Status</td>
  </tr>
  </thead>
  <tbody>

  <?php  
  $i = 1;
  foreach ($data as $ad) {
		  echo "<tr >";
		  echo  "<td height='25'><a href='".base_url()."aset/admin/itemasset/$ad->idAset' style='text-decoration:underline; color:#000'>$ad->idAset</a></td>";
		  echo  "<td><a href='".base_url()."aset/admin/itemasset/$ad->idAset' style='text-decoration:underline; color:#000'>$ad->namaAset</a></td>";
		  echo  "<td>$ad->namaDept</td>";
		  echo  "<td align='right'>".number_format($ad->hargaBeli)."</td>";
	  	  echo  "<td align='right'>".number_format($ad->assetcost)."</td>";
		  $printa = ' - ';
		  
		  if($ad->statusAset==0){
		  	$status = 'In Store';
		  } else if($ad->statusAset==1){
			$status = 'In Use';
			$printa = $ad->petugasAset;
		  } else if($ad->statusAset==2){
			$status = 'In Repair';
		  } else if($ad->statusAset==3){
			$status = 'Disposed';
		  }
		  echo  "<td>$printa</td>";
		  echo "<td>$status</td>";
			
		  echo "</tr>";
		  $i++;
  }?>
</tbody>
</table>
<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
               var oTable= $('#datatable').dataTable( {
                    "sPaginationType"    : "full_numbers",
					"aaSorting":[[0, "asc"]],
					"bJQueryUI":true
					});
			} );			
</script>

<!-- end of buat tabel cihuy -->