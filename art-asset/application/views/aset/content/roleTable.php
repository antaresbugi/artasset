<!-- buat tabel cihuy -->    
<table border="0" id="datatable" name="datatable" class="display"  >
 <thead> 
  <tr>
    <td width="10%">Role Name</td>
    <td width="5%">A</td>
    <td width="5%">SM</td>
    <td width="5%">D</td>
    <td width="5%">T</td>
    <td width="5%">L</td>
    <td width="5%">V</td>
    <td width="5%">U</td>
    <td width="5%">R</td>
    <td width="5%">Re</td>
    <td width="5%"></td>
  </tr>
  </thead>
  <tbody>

  <?php  
  $i = 1;
  foreach (array_keys($data) as $ad) {
		  echo "<tr >";
		  echo  "<td height='25'>$ad</td>";
	foreach ($data[$ad] as $add) {
		  echo  "<td>$add[stat]</td>";
	}
	$k = 0;
	foreach ($data[$ad] as $edd) {
		if($k == 5){
		  echo  "<td><a href='". base_url()."aset/admin/roleedit/$edd[didid]'><img src='". base_url()."images/icn_edit.png' vspace='3' title='Edit Role'></a></td>";
		}
		  $k++;
	}
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