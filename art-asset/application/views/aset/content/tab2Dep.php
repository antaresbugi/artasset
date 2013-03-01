
<table class="tablesorter" id="dodol" cellspacing="0" width="100%"> 
    <thead> 
      <tr>
      	<td width="50px">No. </td>
        <td>History Datas</td>
      </tr>
 	 </thead>
	<tbody> 
    <?php
	$i=1;
    foreach($logg as $ll){
		//inisialisasi
		$tgl_log = date("M jS, Y H:m:s", strtotime($ll->waktu_update));
		echo "<tr >";
		echo "<td class='odd'>$i</td>";
		echo  "<td class='odd'>$tgl_log</td>";
		echo "</tr>";
		$i++;
		echo "<tr >";
		echo "<td>$i</td>";
		echo  "<td>$ll->perubahan</td>";
		echo "</tr>";
		$i++;
	}
	
	 ?>	
	</tbody> 
</table>
<div class="spacer"></div>
<div class="spacer2"></div>

<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
               var oTable= $('#dodol').dataTable( {
                    "sPaginationType"    : "full_numbers",
					//"bPaginate":false,
					"aaSortingFixed":[[0, "asc"]],
					"bFilter":false,
					"iDisplayLength":4,
					"bLengthChange":false
					});
			} );			
</script>