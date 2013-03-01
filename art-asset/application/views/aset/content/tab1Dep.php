<?php foreach($data as $d): ?>	
<div class="module_content">
<table width="100%" border="0">
  <tr>
    <td><table width="100%" border="0">
      <tr>
        <td width="50%" align="center" valign="top"><table width="100%" border="0">
          <tr>
            <td width="120" height="25">Purchase Cost</td>
            <td width="10">:</td>
            <td><?php echo  number_format($d->hargaBeli) ?></td>
          </tr>
          <tr>
            <td height="25">Depreciation Method</td>
            <td>:</td>
            <td><?php if($d->namaDepresiasi=='') echo ' - '; else echo $d->namaDepresiasi ?></td>
          </tr>
          <tr>
            <td height="25">Salvage Value</td>
            <td>:</td>
            <td><?php if($d->nilaiSisa!='0') echo number_format($d->nilaiSisa); else	echo '-'; ?></td>
          </tr>
        </table></td>
        <td width="50%" align="center" valign="baseline"><table width="100%" border="0">
          <tr>
            <td width="120" height="25">Acquisition Date</td>
            <td width="10">:</td>
            <td><?php 
			$tgl = date("M jS, Y", strtotime($d->tgl_beli));
			echo  $tgl ?></td>
          </tr>
          <tr>
            <td height="25">Useful Life</td>
            <td>:</td>
            <td><?php if($d->umurEkonom!='0') echo $d->umurEkonom; else	echo '-'; ?></td>
          </tr>
          <tr>
            <td height="25">&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</div>
<!-- buat tabel cihuy -->    
<table width="100%" border="0" id="datatable" name="datatable" class="display"  >
 <thead> 
  <tr>
    <td width="10%">Year</td>
    <td width="10%">Depreciation</td>
    <td width="10%">Accumulated Depreciation</td>
    <td width="10%">Book Value</td>
  </tr>
  </thead>
  <tbody>
 <?php  
  $i = 0;
  $akul = 0;
  $tahun = date("Y", strtotime($d->tgl_beli));
  $bulan = date("m", strtotime($d->tgl_beli));
  $bandingbulan = (12-$bulan+1)/12;
  $bukfelue = $d->hargaBeli;
  foreach ($data as $d) {
	  if($d->idDepresiasi==1){
		  //inisialisasi data
		  $straightcode = ($d->hargaBeli-$d->nilaiSisa)/$d->umurEkonom;
		  $straightl = $straightcode;
		  while($d->umurEkonom>=($i)){
			  $tahuntampil = $tahun + $i - 1;
			  $bukfelue = $d->hargaBeli-$akul;
			  if($i==0){
			  //do nothing
			  }else{
				  	if($tahuntampil==date("Y")) echo "<tr class='gradeX' height='25'>";
				  	else echo "<tr height='25'>";
				if($i==1) $straightl = $bandingbulan*$straightcode;
				else $straightl = $straightcode;
				  echo  "<td>$tahuntampil</td>";
				  echo  "<td align='right'>".number_format(($straightl), 2)."</td>";
				  echo  "<td align='right'>".number_format(($akul), 2)."</td>";
				  echo  "<td align='right'>".number_format(($bukfelue), 2)."</td>";
			  }
			  echo "</tr>";
			  
			  $akul = $akul+$straightl;
			  $i++;
		  }
		  if(($bukfelue-$straightl)<0){
			  $tahuntampil = $tahuntampil+1;
			  $straightl = $bukfelue - $d->nilaiSisa;
			  $bukfelue = $bukfelue-$straightl;
			  $akul = ($akul - ($straightcode-$straightl));
			  if($tahuntampil==date("Y")) echo "<tr class='gradeX' height='25'>";
				  	else echo "<tr height='25'>";
				  echo  "<td>$tahuntampil</td>";
				  echo  "<td align='right'>".number_format(($straightl), 2)."</td>";
				  echo  "<td align='right'>".number_format(($akul), 2)."</td>";
				  echo  "<td align='right'>".number_format(($bukfelue), 2)."</td>";
			  echo "</tr>";
		  }
		 } //end id depresiasi 1
		  else if($d->idDepresiasi==2){
			//inisialisasi data
		  $persen = 1/$d->umurEkonom;
		  while($d->umurEkonom>$i){  
			  $tahuntampil = $tahun + $i;
			  
			  $declicode = ($persen*$bukfelue);	
			  $decli = $declicode;
			  	  
			  if($tahuntampil==date("Y")) echo "<tr class='gradeX' height='25'>";
			      else echo "<tr height='25'>";
				  
			  if($i==0) $decli = ($bandingbulan*$declicode);
				else $decli = $declicode;
			  $akul = ($akul+$decli);
			  $bukfelue = ($d->hargaBeli-$akul);	
			  
				  echo  "<td>$tahuntampil</td>";
				  echo  "<td align='right'>".number_format(($decli), 2)."</td>";
				  echo  "<td align='right'>".number_format(($akul), 2)."</td>";
			 	  echo  "<td align='right'>".number_format(($bukfelue), 2)."</td>";
			  echo "</tr>";  
			  
			  if(($bukfelue-$decli)<$d->nilaiSisa) break; 
			  $i++;
			  
		  }
		  if(($bukfelue-$decli)<$d->nilaiSisa){
			  $tahuntampil = $tahuntampil+1;
			  $decli = ($bukfelue - $d->nilaiSisa);
			  $bukfelue = $bukfelue-$decli;
			  $akul = ($akul - ($declicode-$decli));
			  if($tahuntampil==date("Y")) echo "<tr class='gradeX' height='25'>";
				  	else echo "<tr height='25'>";
				  echo  "<td>$tahuntampil</td>";
				  echo  "<td align='right'>".number_format(($decli), 2)."</td>";
				  echo  "<td align='right'>".number_format(($akul), 2)."</td>";
				  echo  "<td align='right'>".number_format(($bukfelue), 2)."</td>";
			  echo "</tr>";
		  }
		  }//end id depresiasi 2
		  else if($d->idDepresiasi==3){
			//inisialisasi data
		  $persen = 2*(1/$d->umurEkonom);
		  while($d->umurEkonom>$i){  
			  $tahuntampil = $tahun + $i;
			  
			  $declicode = ($persen*$bukfelue);	
			  $decli = $declicode;
			  	  
			  if($tahuntampil==date("Y")) echo "<tr class='gradeX' height='25'>";
			      else echo "<tr height='25'>";
				  
			  if($i==0) $decli = ($bandingbulan*$declicode);
				else $decli = $declicode;
			  $akul = ($akul+$decli);
			  $bukfelue = ($d->hargaBeli-$akul);	
			  
				  echo  "<td>$tahuntampil</td>";
				  echo  "<td align='right'>".number_format(($decli), 2)."</td>";
				  echo  "<td align='right'>".number_format(($akul), 2)."</td>";
			 	  echo  "<td align='right'>".number_format(($bukfelue), 2)."</td>";
			  echo "</tr>";  
			  
			  if(($bukfelue-$decli)<$d->nilaiSisa) break; 
			  $i++;
			  
		  }
		  if(($bukfelue-$decli)<$d->nilaiSisa){
			  $tahuntampil = $tahuntampil+1;
			  $decli = ($bukfelue - $d->nilaiSisa);
			  $bukfelue = $bukfelue-$decli;
			  $akul = ($akul - ($declicode-$decli));
			  if($tahuntampil==date("Y")) echo "<tr class='gradeX' height='25'>";
				  	else echo "<tr height='25'>";
				  echo  "<td>$tahuntampil</td>";
				  echo  "<td align='right'>".number_format(($decli), 2)."</td>";
				  echo  "<td align='right'>".number_format(($akul), 2)."</td>";
				  echo  "<td align='right'>".number_format(($bukfelue), 2)."</td>";
			  echo "</tr>";
		  }
		  }//end id depresiasi 3
		  else if($d->idDepresiasi==4){
			//inisialisasi data
		  $JAT = $d->umurEkonom*(($d->umurEkonom+1)/2);
		  $tawal = $tahun-1;
		  $takhir = 12-$tawal;
		  $tahunbalik = 0;
		  $tahunbalikakhir = $d->umurEkonom;
		  $unkcount = $d->hargaBeli*(($d->hargaBeli +1)/2);
		  $nilawal = ($tawal/12)*($tahunbalik/$unkcount)*($d->hargaBeli-$d->nilaiSisa);
		  $nilakhiw = ($takhir/12)*($tahunbalikakhir/$unkcount)*($d->hargaBeli-$d->nilaiSisa);
		  $nyusut =  number_format(($nilakhiw + $nilawal), 2, '.', '');
		  while($d->umurEkonom>=$i){
			  $tahuntampil = $tahun + $i;
			  $bukfelue = number_format(($d->hargaBeli-$akul), 2, '.', '');
			  
			  if($tahuntampil==date("Y")){
			  echo "<tr class='gradeX' height='25'>";
			  } else {
				  echo "<tr height='25'>";
			  }
			  
			  echo  "<td>$tahuntampil</td>";
			  if($i==0){
				  echo  "<td> - </td>";
				  echo  "<td> - </td>";
				  echo  "<td> $bukfelue</td>";
			  }else{
				  echo  "<td>$nyusut</td>";
				  echo  "<td>$akul</td>";
				  echo  "<td>$bukfelue</td>";
			  }
			  echo "</tr>";
			  $tahunbalikakhir = $tahunbalikakhir -1;
			  $akul = number_format(($akul+$nyusut), 2, '.', ''); 
			  $nilawal = ($tawal/12)*($tahunbalik/$unkcount)*($d->hargaBeli-$d->nilaiSisa);
			  $nilakhiw = ($takhir/12)*($tahunbalikakhir/$unkcount)*($d->hargaBeli-$d->nilaiSisa);
			  $nyusut = number_format(($nilakhiw + $nilawal), 2, '.', '');
			  
			  $i++;
		  }
		  }//end id depresiasi 4
  }?>
</tbody>
</table>
<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
               var oTable= $('#datatable').dataTable( {
                    "sPaginationType"    : "full_numbers",
					//"bPaginate":false,
					"aaSorting":[[0, "asc"]],
					"bFilter":false,
					"bJQueryUI":true
					});
			} );			
</script>
<!-- end of buat tabel cihuy -->
<?php endforeach ?>