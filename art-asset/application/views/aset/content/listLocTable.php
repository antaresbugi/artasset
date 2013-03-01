<!-- buat tabel cihuy -->    
<table width="100%" border="0" id="datatable" name="datatable" class="display"  >
 <thead> 
  <tr>
    <td width="2%">No</td>
    <td width="10%">Location Name</td>
    <td width="10%">Last Update</td>
    <td width="10%">Updated By</td>
    <td width="5%"></td>
  </tr>
  </thead>
  <tbody>
  
  <?php  
  $i = 1;
  foreach ($data as $lo) {
	 	  $tgl_baru = date("M jS, Y H:i:s", strtotime($lo->tgl_update));
		  echo "<tr >";
		  echo  "<td>$i</td>";
		  echo  "<td>$lo->namaDept</td>";
		  echo  "<td>$tgl_baru</td>";
		  echo  "<td>$lo->fullName</td>";
		  //ini dia kuncinya
		  
		  echo  "<td align='center'>
					 <a href=\"#\" class=\"edit\" kode=\"$lo->idDept\" nama=\"$lo->namaDept\" karya=\"$lo->employee\" deks=\"$lo->keterangan\" tgl=\"$tgl_baru\">
					 <img src='". base_url()."images/icn_edit.png' hspace='10' vspace='3' title='Detail / Edit'>
					 </a>
					 <a href=\"#\" class=\"delbutton\" kode=\"$lo->idDept\">
					 <img src='". base_url()."images/icn_trash.png' hspace='10' vspace='3' title='Delete'>
					 </a>
			</td>";
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