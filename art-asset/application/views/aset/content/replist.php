
<article class="module width_full">
<div class="module_content">	
<table width="100%" border="0">
    <tr><td>
        <table width="100%" border="0" class="rerep">
            <tr><td>
            	<table width="100%" border="0" class="rerep">
                    <tr>
                        <td width="30%" align="right">
                        <img src='<?php echo base_url() ?>images/logoseadanya.png' >
                        </td>
                        <td style="padding:0 10px 0 10px;">
                        <h3>PT. Artistika Inkernas</h3>
                        <p>
                        Pondok Cipta i/45.<br />
                        17134.<br />
                        021-8852742.
                        </p>
                        </td>
                    </tr>
                </table>
            </td></tr>
        </table>
    </td></tr>
</table> 
<table width="100%" border="0">
  <tr>
    <td>
    
<table width="100%" border="1" class="repot">
<thead>
  <tr align="center">
    <td><strong>ID</strong></td>
    <td><strong>Name</strong></td>
    <td><strong>Type</strong></td>
    <td><strong>Vendor</strong></td>
    <td><strong>Location</strong></td>
    <td><strong>Price</strong></td>
    <td><strong>Cost</strong></td>
    <td><strong>Current Value</strong></td>
    <td><strong>Status</strong></td>
    <td><strong>Condition</strong></td>
  </tr>
</thead>
<?php 
$i = 0;
$total_beli = 0;
$total_cost = 0;
$total_current = 0;
foreach($data as $dada):
?>
<tbody>
<?php
//kondisi atau status dengan hasilnya :)
		 $statuscek = $dada->statusAset;
		  $kondisicek = $dada->kondisiAset;
		  
		  if($statuscek==0){
		  	$status = 'In Store';
		  } else if($statuscek==1){
			$status = 'In Use';
		  } else if($statuscek==2){
			$status = 'In Repair';
		  } else if($statuscek==3){
			$status = 'Disposed';
		  }
		  
		  if($kondisicek==0){
		  	$kondisi = 'New';
		  } else if($kondisicek==1){
			$kondisi = 'Good';
		  } else if($kondisicek==2){
			$kondisi = 'Fair';
		  } else if($kondisicek==3){
			$kondisi = 'Poor';
		  }
		  
		  $i = 0;
  $akul = 0;
  $hargaprint = 0;
  $tahun = date("Y", strtotime($dada->tgl_beli));
  $bulan = date("m", strtotime($dada->tgl_beli));
  $bandingbulan = (12-$bulan+1)/12;
  $bukfelue = $dada->hargaBeli;
	  if($dada->idDepresiasi==1){
		  //inisialisasi data
		  $straightcode = ($dada->hargaBeli-$dada->nilaiSisa)/$dada->umurEkonom;
		  $straightl = $straightcode;
		  while($dada->umurEkonom>=($i)){
			  $tahuntampil = $tahun + $i - 1;
			  $bukfelue = $dada->hargaBeli-$akul;
			  if($i==0){
			  //do nothing
			  }else{
				if($i==1) $straightl = $bandingbulan*$straightcode;
				else $straightl = $straightcode;
				
				if($tahuntampil==date("Y")) $hargaprint = $bukfelue;
			  }
			  
			  $akul = $akul+$straightl;
			  $i++;
		  }
		  if(($bukfelue-$straightl)<0){
			  $tahuntampil = $tahuntampil+1;
			  $straightl = $bukfelue - $dada->nilaiSisa;
			  $bukfelue = $bukfelue-$straightl;
			  $akul = ($akul - ($straightcode-$straightl));
			  if($tahuntampil==date("Y")) $hargaprint = $bukfelue;
		  }
		 } //end id depresiasi 1
		 else if($dada->idDepresiasi==2){
			//inisialisasi data
		  $persen = 1/$dada->umurEkonom;
		  while($dada->umurEkonom>$i){  
			  $tahuntampil = $tahun + $i;
			  
			  $declicode = ($persen*$bukfelue);	
			  $decli = $declicode;
			  	  
			  if($i==0) $decli = ($bandingbulan*$declicode);
				else $decli = $declicode;
			  $akul = ($akul+$decli);
			  $bukfelue = ($dada->hargaBeli-$akul);
			  
			  if($tahuntampil==date("Y")) $hargaprint = $bukfelue;	 
			  
			  if(($bukfelue-$decli)<$dada->nilaiSisa) break; 
			  $i++;
			  
		  }
		  if(($bukfelue-$decli)<$dada->nilaiSisa){
			  $tahuntampil = $tahuntampil+1;
			  $decli = ($bukfelue - $dada->nilaiSisa);
			  $bukfelue = $bukfelue-$decli;
			  $akul = ($akul - ($declicode-$decli));
			  if($tahuntampil==date("Y")) $hargaprint = $bukfelue;

		  }
		  }//end id depresiasi 2
		  else if($dada->idDepresiasi==3){
			//inisialisasi data
		  $persen = 2*(1/$dada->umurEkonom);
		  while($dada->umurEkonom>$i){  
			  $tahuntampil = $tahun + $i;
			  
			  $declicode = ($persen*$bukfelue);	
			  $decli = $declicode;
			  	  
			  if($i==0) $decli = ($bandingbulan*$declicode);
				else $decli = $declicode;
			  $akul = ($akul+$decli);
			  $bukfelue = ($dada->hargaBeli-$akul);
			  
			  if($tahuntampil==date("Y")) $hargaprint = $bukfelue;	 
			  
			  if(($bukfelue-$decli)<$dada->nilaiSisa) break; 
			  $i++;
			  
		  }
		  if(($bukfelue-$decli)<$dada->nilaiSisa){
			  $tahuntampil = $tahuntampil+1;
			  $decli = ($bukfelue - $dada->nilaiSisa);
			  $bukfelue = $bukfelue-$decli;
			  $akul = ($akul - ($declicode-$decli));
			  if($tahuntampil==date("Y")) $hargaprint = $bukfelue;

		  }
		  }//end id depresiasi 3
		  else{
		  }
		  
?>
  <tr>
    <td align="center"><?php echo $dada->idAset?></td>
    <td><?php echo $dada->namaAset?></td>
    <td><?php echo $dada->klasName?></td>
    <td><?php echo $dada->vendorNama?></td>
    <td><?php echo $dada->namaDept?></td>
    <td align="right"><?php echo number_format($dada->hargaBeli,2) ?></td>
    <td align="right"><?php echo number_format($dada->assetcost,2) ?></td>
    <td align="right"><?php echo number_format($hargaprint ,2) ?></td>
    <td><?php echo $status?></td>
    <td><?php echo $kondisi?></td>
  </tr>
  
<?php 
$total_beli = $total_beli + $dada->hargaBeli;
$total_cost = $total_cost + $dada->assetcost;
$total_current = $total_current + $hargaprint;

$i++;
endforeach;
?>
  <tr>
  	<td colspan="5"><strong>Total</strong></td>
    <td align="right"><strong><?php echo number_format($total_beli,2) ?></strong></td>
    <td align="right"><strong><?php echo number_format($total_cost,2) ?></strong></td>
    <td align="right"><strong><?php echo number_format($total_current,2) ?></strong></td>
    <td colspan="2"></td>
  </tr>
</tbody>

</table>

</td>
      </tr>
    </table></td>
  </tr>
</table> 
</div>
</article><!-- end of stats article -->
