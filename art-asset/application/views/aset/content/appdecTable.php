<!-- buat tabel cihuy -->    
<table width="100%" border="0" id="datatable" name="datatable" class="display"  >
 <thead> 
  <tr>
    <td width="2%">No</td>
    <td width="10%">Name</td>
    <td width="10%">Type</td>
    <td width="10%">Vendor</td>
    <td width="10%">Price</td>
    <td width="3%">Status</td>
  </tr>
  </thead>
  <tbody>
  
  <?php  
  $i = 1;
  foreach ($data as $pr) {
	  if ($pr->status==1){
		  echo "<tr class='gradeA'>";
	  } else {
		  echo "<tr class='gradeX'>";
	  }
		  
		  echo  "<td height='25'>$i</td>";
		  echo  "<td>$pr->namaBarang</td>";
		  echo  "<td>$pr->klasName</td>";
		  echo  "<td>$pr->vendorNama</td>";
		  echo  "<td align='right'>$pr->hargaPred</td>";
		  if ($pr->status==0){
		  	$status = 'Open';
		  } else if ($pr->status==1){
			$status = 'Approved';
		  } else if ($pr->status==2){
			$status = 'Closed';
		  } else if ($pr->status==3){
			$status = 'Declined';
		  }
		  echo  "<td>$status</td>";
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