<!-- buat tabel cihuy -->    
<table width="100%" border="0" id="datatable" name="datatable" class="display"  >
 <thead> 
  <tr>
    <td width="10%">Type Name</td>
    <td width="10%">Last Update</td>
    <td width="10%">Updated By</td>
    <td width="5%"></td>
  </tr>
  </thead>
  <tbody>
  <?php  foreach ($data as $kl) {
	   	  $tgl_baru = date("M jS, Y", strtotime($kl->tgl_update));
		  echo "<tr >";
		  echo  "<td>$kl->klasName</td>";
		  echo  "<td>$tgl_baru</td>";
		  echo  "<td>$kl->fullName</td>";
		  //ini dia kuncinya
		  echo  "<td align='center'>
					 <a href=\"#\" class=\"edit\" kode=\"$kl->klasID\" nama=\"$kl->klasName\" karya=\"$kl->employee\" deks=\"$kl->keterangan\" tgl=\"$tgl_baru\">
					 <img src='". base_url()."images/icn_edit.png' hspace='10' vspace='3' title='Detail / Edit'>
					 </a>
					 <a href=\"#\" class=\"delbutton\" kode=\"$kl->klasID\">
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