<!-- buat tabel cihuy -->    
<table width="100%" border="0" id="datatable" name="datatable" class="display"  >
 <thead> 
  <tr>
    <td width="3%">Asset ID</td>
    <td width="10%">Service Item</td>
    <td width="10%">Service Date</td>
    <td width="10%">Cost</td>
    <td width="10%">Status</td>
    <td width="5%"></td>
  </tr>
  </thead>
  <tbody>
  <?php  foreach ($data as $pa) {
	   	  $tgl_baru = date("M jS, Y", strtotime($pa->tanggal));
		  if($pa->status==0){
		  	$status = 'Ongoing';
		  } else if($pa->status==1){
			$status = 'Completed';
		  }
		  echo "<tr >";
		  echo  "<td>$pa->idAset</td>";
		  echo  "<td>$pa->itemPerbaikNama</td>";
		  echo  "<td>$tgl_baru</td>";
		  echo  "<td align='right'>".number_format($pa->biaya)."</td>";
		  echo  "<td>$status</td>";
		  //ini dia kuncinya
		  echo  "<td align='center'>
					 <a href=\"#\" class=\"edit\" kode=\"$pa->perbaikID\" tgl=\"$pa->tanggal\" status=\"$pa->status\" deks=\"$pa->deskripsi\" cost=\"$pa->biaya\" idItem=\"$pa->itemPerbaikID\" idAset=\"$pa->idAset\">
					 <img src='". base_url()."images/icn_update.png' hspace='10' vspace='3' title='Delete'>
					 </a>
			</td>";
		  echo "</tr>";
  }?>
</tbody>
</table>
<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
               var oTable= $('#datatable').dataTable( {
                    "sPaginationType"    : "full_numbers",
					"aaSorting":[[0, "asc"]],
					"bFilter":false,
					"bJQueryUI":true
					});
			} );			
</script>

<!-- end of buat tabel cihuy -->