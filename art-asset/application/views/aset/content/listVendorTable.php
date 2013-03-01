<!-- buat tabel cihuy -->    
<table width="100%" border="0" id="datatable" name="datatable" class="display"  >
 <thead> 
  <tr>
    <td width="5%">Vendor ID</td>
    <td width="15%">Company Name</td>
    <td width="5%">Phone</td>
    <td width="10%">Email</td>
	<td width="10%">Contact Name</td>
    <td width="5%">Contact Phone</td>
    <td width="8%"></td>
  </tr>
  </thead>
  <tbody>
  <?php  foreach ($data as $vp) {
		  echo "<tr >";
		  echo  "<td>$vp->vendorID </td>";
		  echo  "<td>$vp->vendorNama </td>";
		  echo  "<td>$vp->nomorTelp </td>";
		  echo  "<td>$vp->email </td>";
		  echo  "<td>$vp->contactName </td>";
		  echo  "<td>$vp->contactNo </td>";
		  //ini dia kuncinya
		  echo  "<td >
					 <a href=\"#\" class=\"edit\" kode=\"$vp->vendorID\" nama=\"$vp->vendorNama\" telpon=\"$vp->nomorTelp\" alamat=\"$vp->alamat\" surel=\"$vp->email\" situs=\"$vp->website\" kontakNam=\"$vp->contactName\" kontakNo=\"$vp->contactNo\">
					 <img src='". base_url()."images/icn_edit.png' hspace='10' vspace='3' title='Detail / Edit'>
					 </a>
					 <a href=\"#\" class=\"delbutton\" kode=\"$vp->vendorID\">
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