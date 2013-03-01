<!-- buat tabel cihuy -->    
<table width="100%" border="0" id="datatable" name="datatable" class="display"  >
 <thead> 
  <tr>
    <td width="3%">User ID</td>
    <td width="15%">Name</td>
    <td width="8%">Phone</td>
    <td width="10%">Email</td>
    <td width="10%">Position</td>
	<td width="5%">Status</td>
    <td width="8%"></td>
  </tr>
  </thead>
  <tbody>
  <?php  foreach ($data as $bt) {
		  echo "<tr >";
		  echo  "<td>$bt->nomorKaryawan </td>";
		  echo  "<td>$bt->fullName </td>";
		  echo  "<td>$bt->phone </td>";
		  echo  "<td>$bt->email </td>";
		  echo  "<td>$bt->sessionname </td>";
		  if ($bt->status==1){
		  	$status = 'Active';
		  } else {
			$status = 'Inactive';
		  }
		  echo  "<td>$status</td>";
		  //ini dia kuncinya
		  echo  "<td >
					 <a href=\"#\" class=\"edit\" kode=\"$bt->nomorKaryawan\" pass=\"$bt->password\" nama=\"$bt->fullName\" telpon=\"$bt->phone\" surel=\"$bt->email\" jabat=\"$bt->sessionid\" status=\"$bt->status\">
					 <img src='". base_url()."images/icn_edit.png' hspace='10' vspace='3' title='Edit'>
					 </a>
					 <a href=\"#\" class=\"delbutton\" kode=\"$bt->nomorKaryawan\">
					 <img src='". base_url()."images/icn_trash.png' hspace='10' vspace='3' title='Delete'>
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
					"bJQueryUI":true
					});
			} );			
</script>

<!-- end of buat tabel cihuy -->