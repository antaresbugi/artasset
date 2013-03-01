<?php 

class AdminFunc extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('encrypt');
		$this->load->model('aset/muser');
		
		//cek
		$oke = $this->session->userdata('logged_in');
		if($oke!=true) redirect(base_url());
	}

	//manage user
	function input_user(){
				$kode = $this->input->post('id1');
				$nama = $this->input->post('nama');
				$phone = $this->input->post('phone');
				$email = $this->input->post('email');
				$position = $this->input->post('position');
				$status = $this->input->post('status');
				$password = $this->input->post('pass');
				$data = array(
						  'nomorKaryawan'=>$kode,
						  'fullName'=>$nama,
						  'sessionid'=>$position,
						  'phone'=>$phone,
						  'email'=>$email,
						  'password'=>$password,
						  'status'=>$status);
				$this->muser->input_user($data);		  
				
				$this->session->set_flashdata('message', '<h4>Data Added Successfully</h4>');
				redirect('aset/admin/user');
	}
	
	function edit_user(){
				$id = $this->input->post('id1');
				$nama = $this->input->post('nama');
				$pass = $this->input->post('pass');
				$phone = $this->input->post('phone');
				$email = $this->input->post('email');
				$position = $this->input->post('position');
				$status = $this->input->post('status');
				//password gimana ya?
				$data = array(
						  'fullName'=>$nama,
						  'sessionid'=>$position,
						  'password'=>$pass,
						  'phone'=>$phone,
						  'email'=>$email,
						  'status'=>$status);
				$this->muser->update_user($id,$data);
				$this->session->set_flashdata('message', '<h4>Data Updated Successfully</h4>');
				redirect('aset/admin/listUser');
	}
	
	function delete_u() {
		$id = $this->input->post('kode');
		$this->muser->delete_user($id);
		//ambil data
		$siteweb['data'] = $this->muser->get_user();
		$this->load->view('aset/content/listUserTable',$siteweb);
	}
	
	function cupload(){
		$this->load->model('mupload');
		$gambar = $this->input->post('upload');
		
		//masuk database?
		$putu = $this->input->post('namafile');
		$id = $this->session->userdata('nomorKaryawan');
		$data = array('pic'=>$putu);
		$this->muser->update_user($id,$data);
		
		if($gambar){
			$this->mupload->do_upload();
			//$this->session->set_flashdata('message', '<h4>Data Uploaded</h4>');
		}else{
			//$this->session->set_flashdata('message', '<h4>No Data Uploaded</h4>');
		};
		redirect('aset/admin/profile');
	}
	
	function aupload(){
		//upload
		$this->load->model('mupload');
		$gambar = $this->input->post('upload');
		
		//masuk database?
		$putu = $this->input->post('namafile');
		$idd = $this->input->post('idd');
		$data = array('assetpic'=>$putu);
		$this->muser->update_as($idd,$data);
		
		if($gambar){
			$this->mupload->asset_upload($putu);
			//$this->session->set_flashdata('message', '<h4>Data Uploaded</h4>');
		}else{
			//$this->session->set_flashdata('message', '<h4>No Data Uploaded</h4>');
		};
		redirect('aset/admin/itemasset/'.$idd);
	}
	
	//manage vendor
	
	function input_vendor(){
				$id = $this->input->post('id1');
				$nama = $this->input->post('nama');
				$alamat = $this->input->post('alamat');
				$phone = $this->input->post('phone');
				$email = $this->input->post('email');
				$situs = $this->input->post('situs');
				$kontakNam = $this->input->post('kontakNam');
				$kontakNo = $this->input->post('kontakNo');
				$data = array(
						  'vendorID'=>$id,
						  'vendorNama'=>$nama,
						  'alamat'=>$alamat,
						  'nomorTelp'=>$phone,
						  'email'=>$email,
						  'website'=>$situs,
						  'contactName'=>$kontakNam,
						  'contactNo'=>$kontakNo);
				$this->muser->input_vendor($data);		  
				
				$this->session->set_flashdata('message', '<h4>Data Added Successfully</h4>');
				redirect('aset/admin/vendor');
	}
	
	function edit_vendor(){
				$id = $this->input->post('id1');
				$nama = $this->input->post('nama');
				$alamat = $this->input->post('alamat');
				$phone = $this->input->post('phone');
				$email = $this->input->post('email');
				$situs = $this->input->post('situs');
				$kontakNam = $this->input->post('kontakNam');
				$kontakNo = $this->input->post('kontakNo');
				$data = array(
						  'vendorNama'=>$nama,
						  'alamat'=>$alamat,
						  'nomorTelp'=>$phone,
						  'email'=>$email,
						  'website'=>$situs,
						  'contactName'=>$kontakNam,
						  'contactNo'=>$kontakNo);
				$this->muser->update_vendor($id,$data);
				
				$this->session->set_flashdata('message', '<h4>Data Updated Successfully</h4>');
				redirect('aset/admin/listVendor');
	}
	
	function delete_v() {
		$id = $this->input->post('kode');
		$this->muser->delete_vendor($id);
		//ambil data
		$siteweb['data'] = $this->muser->get_vendor();
		$this->load->view('aset/content/listVendorTable',$siteweb);
	}
	
	//manage klasifikasi / type
	
	function input_klas(){
				$nama = $this->input->post('nama');
				$deks = $this->input->post('deks');
				$karya = $this->session->userdata('nomorKaryawan');
				$data = array(
						  'klasID'=>'',
						  'klasName'=>$nama,
						  'tgl_update'=>date('Y-m-d H:i:s'),
						  'keterangan'=>$deks,
						  'employee'=>$karya);
				$this->muser->input_klas($data);		
				$this->session->set_flashdata('message', '<h4>Data Added Successfully</h4>');  
				redirect('aset/admin/listklas');
	}
	
	function edit_klas(){
				$id = $this->input->post('id');
				$nama = $this->input->post('nama');
				$deks = $this->input->post('deks');
				$karya = $this->session->userdata('nomorKaryawan');
				$data = array(
						  'klasName'=>$nama,
						  'tgl_update'=>date('Y-m-d H:i:s'),
						  'keterangan'=>$deks,
						  'employee'=>$karya);
				$this->muser->update_klas($id,$data);
				$this->session->set_flashdata('message', '<h4>Data Updated Successfully</h4>');
				redirect('aset/admin/listklas');
	}
	
	function delete_k() {
		$id = $this->input->post('kode');
		$this->muser->delete_klas($id);
		//ambil data
		$siteweb['data'] = $this->muser->get_klas();
		$this->load->view('aset/content/listKlasTable',$siteweb);
	}
	
	//manage location
	
	function input_loc(){
				$nama = $this->input->post('nama');
				$deks = $this->input->post('deks');
				$karya = $this->session->userdata('nomorKaryawan');
				$data = array(
						  'idDept'=>'',
						  'namaDept'=>$nama,
						  'tgl_update'=>date('Y-m-d H:i:s'),
						  'keterangan'=>$deks,
						  'employee'=>$karya);
				$this->muser->input_loc($data);		
				$this->session->set_flashdata('message', '<h4>Data Added Successfully</h4>');  
				redirect('aset/admin/listloc');
	}
	
	function edit_loc(){
				$id = $this->input->post('id');
				$nama = $this->input->post('nama');
				$deks = $this->input->post('deks');
				$karya = $this->session->userdata('nomorKaryawan');
				$data = array(
						  'namaDept'=>$nama,
						  'tgl_update'=>date('Y-m-d H:i:s'),
						  'keterangan'=>$deks,
						  'employee'=>$karya);
				$this->muser->update_loc($id,$data);
				$this->session->set_flashdata('message', '<h4>Data Updated Successfully</h4>');
				redirect('aset/admin/listloc');
	}
	
	function delete_l() {
		$id = $this->input->post('kode');
		$this->muser->delete_loc($id);
		//ambil data lagi
		$siteweb['data'] = $this->muser->get_loc();
		$this->load->view('aset/content/listLocTable',$siteweb);
	}
	
	//manage purreq
	
	function input_purreq(){
				$nama = $this->input->post('nama');
				$tipe = $this->input->post('tipe');
				$deks = $this->input->post('deks');
				$vendor = $this->input->post('vendor');
				$harga = $this->input->post('harga');
				$data = array(
						  'idPR'=>'',
						  'namaBarang'=>$nama,
						  'klasID'=>$tipe,
						  'vendorID'=>$vendor,
						  'hargaPred'=>$harga,
						  'keterangan'=>$deks,);
				$this->muser->input_pr($data);		
				$this->session->set_flashdata('message', '<h4>Data Added Successfully</h4>');  
				redirect('aset/admin/purreq');
	}
	
	function edit_purreq(){
				$id = $this->input->post('id');
				$nama = $this->input->post('nama');
				$tipe = $this->input->post('tipe');
				$deks = $this->input->post('deks');
				$unread = $this->input->post('unread');
				$vendor = $this->input->post('vendor');
				$harga = $this->input->post('harga');
				
				$data = array(
						  'namaBarang'=>$nama,
						  'status'=>'0',
						  'klasID'=>$tipe,
						  'vendorID'=>$vendor,
						  'hargaPred'=>$harga,
						  'keterangan'=>$deks,
						  'unread'=>$unread);
				$this->muser->update_pr($id,$data);
				$this->session->set_flashdata('message', '<h4>Data Updated Successfully</h4>');
				redirect('aset/admin/purreq');
	}
	
	function delete_pr() {
		$id = $this->input->post('kode');
		$this->muser->delete_pr($id);
		//ambil data lagi
		$siteweb['data'] = $this->muser->get_purreq();
		$this->load->view('aset/content/listPurreqTable',$siteweb);
	}
	
	function app_pr(){
				$id = $this->input->post('kode');
				
				$data = array(
						  'status'=>'1',
						  'unread'=>'0');
				$this->muser->update_pr($id,$data);
				
				$siteweb['data'] = $this->muser->get_purreq_when();
				$this->load->view('aset/content/approvalTable',$siteweb);
	}
	
	function dec_pr(){
				$id = $this->input->post('kode');
				
				$data = array(
						  'status'=>'3',
						  'unread'=>'0');
				$this->muser->update_pr($id,$data);
				
				$siteweb['data'] = $this->muser->get_purreq_when();
				$this->load->view('aset/content/approvalTable',$siteweb);
	}
	
	function menu_pr(){
		$pilihan = $this->input->post('menu');
		if($pilihan=='data'){
			redirect('aset/admin/purreq');
		}else if($pilihan=='appdec'){
			redirect('aset/admin/appdec');
		}else if($pilihan=='approval'){
			redirect('aset/admin/approval');
		}else if($pilihan=='toasset'){
			redirect('aset/admin/toasset');
		}
	}
	
	//pr to asset
	function to_asset(){
		//cek dulu lah wee
				$cekec = $this->input->post('deprecheck');
				if($cekec==1){
					$depas = $this->input->post('depas');
					$uslif = $this->input->post('uslif');
					$salval = $this->input->post('salval');
				} else {
					$depas = '';
					$uslif = '';
					$salval = '';
				}
		//inisialisasi
				$nama = $this->input->post('nama');
				$vendor = $this->input->post('vendor');
				$tipe = $this->input->post('tipe');
				$loc = $this->input->post('loc');
				$purcos = $this->input->post('purcos');
				$tgl = $this->input->post('tgl');
				$kondisi = $this->input->post('kondisi');
				$status = $this->input->post('resourceState');
				$tanjaw = $this->input->post('tanjaw');
				$deks = $this->input->post('desk');
				// hasil upload file belum
				$karya = $this->session->userdata('nomorKaryawan');
				
		//generate id
				$taun = date('Y');
				$query = $this->muser->asset_id($taun, $vendor);
				$akhir = $query->terakhir;
				$angka = substr($akhir, 16, 4);
				$angkatt = $angka +1;
				$next = $vendor.$taun.sprintf('%04s', $angkatt);
				
		//upload
				$this->load->model('mupload');
				$gambar = $this->input->post('upload');
				$cekputu = $this->input->post('userfile');
				
				//masuk database?			
				if($gambar){
					$this->mupload->asset_upload($next);
				}
				
				if($cekputu=='') $putu = 'default.png'; else $putu = $next.'.jpg';
				
				$data = array(
						  'idAset'=>$next,
						  'namaAset'=>$nama,
						  'keteranganAset'=>$deks,
						  'tgl_beli'=>$tgl,
						  'hargaBeli'=>$purcos,
						  'umurEkonom'=>$uslif,
						  'CurVal'=>'', //gimana ngisinya ya? lupa euy
						  'nomorKaryawan'=>$karya,
						  'idDept'=>$loc,
						  'vendorID'=>$vendor,
						  'klasID'=>$tipe,
						  'statusAset'=>$status,
						  'idDepresiasi'=>$depas,
						  'kondisiAset'=>$kondisi,
						  'tgl_updateAset'=>date('Y-m-d H:i:s'),
						  'petugasAset'=>$tanjaw,
						  'nilaiSisa'=>$salval,
						  'assetcost'=>$purcos,
						  'assetpic'=>$putu);
				$this->muser->input_asset($data);	
				
				//update pr nya
				$idpr = $this->input->post('idPRnya');
				$prasset = array(
					'status'=>'2'
				);
				$this->muser->update_pr($idpr,$prasset);	
				
				//log nya bung
				if($status==0){
					$statuslog = 'In Store';
					$ubahan = '<p>1. State is set as '.$statuslog.'</p>';
				  } else if($status==1){
					$statuslog = 'In Use';
					$ubahan = '<p>1.State is set as '.$statuslog.'</p><p>2. Assigned to '.$tanjaw.'</p>';
				  }
				
				$datalog = array (
					'idAsetLog'=>$next,
					'waktu_update'=>date('Y-m-d H:i:s'),
					'perubahan' => $ubahan
				);
				$this->muser->input_log($datalog);	
				
				$this->session->set_flashdata('message', '<h4>PR to Asset Added Successfully</h4>');  
				redirect('aset/admin/toasset');
	}
	
	//manage asset dan kawan-kawan
	function menu_asset(){
		$pilihan = $this->input->post('menu');
		if($pilihan=='newdata'){
			redirect('aset/admin/newasset');
		}else if($pilihan=='data'){
			redirect('aset/admin/asset');
		}else if($pilihan=='service'){
			redirect('aset/admin/homeservice');
		}else if($pilihan=='disposal'){
			redirect('aset/admin/disposal');
		}
	}
	
	function menu_detil(){
		$idmen = $this->input->post('idmas');
		$pilihan = $this->input->post('detailas');
		if($pilihan=='edit'){
			redirect('aset/admin/editasset/'.$idmen);
		}else if($pilihan=='serpis'){
			redirect('aset/admin/service/'.$idmen);
		}else if($pilihan=='dispos'){
			redirect('aset/admin/disposal/'.$idmen);
		}
	}
	
	function input_asset(){
		//cek dulu lah wee
				$cekec = $this->input->post('deprecheck');
				if($cekec==1){
					$depas = $this->input->post('depas');
					$uslif = $this->input->post('uslif');
					$salval = $this->input->post('salval');
				} else {
					$depas = '';
					$uslif = '';
					$salval = '';
				}
		//inisialisasi
				$nama = $this->input->post('nama');
				$vendor = $this->input->post('vendor');
				$tipe = $this->input->post('tipe');
				$loc = $this->input->post('loc');
				$purcos = $this->input->post('purcos');
				$tgl = $this->input->post('tgl');
				$kondisi = $this->input->post('kondisi');
				$status = $this->input->post('resourceState');
				$tanjaw = $this->input->post('tanjaw');
				$deks = $this->input->post('desk');
				// hasil upload file belum
				$karya = $this->session->userdata('nomorKaryawan');
				
		//generate id
				$taun = date('Y');
				$query = $this->muser->asset_id($taun);
				$akhir = $query->terakhir;
				$angka = substr($akhir, 7, 4);
				$angkatt = $angka +1;
				$next = 'AST'.$taun.sprintf('%04s', $angkatt);
				
				$data = array(
						  'idAset'=>$next,
						  'namaAset'=>$nama,
						  'keteranganAset'=>$deks,
						  'tgl_beli'=>$tgl,
						  'hargaBeli'=>$purcos,
						  'umurEkonom'=>$uslif,
						  'CurVal'=>'', //gimana ngisinya ya? lupa euy
						  'nomorKaryawan'=>$karya,
						  'idDept'=>$loc,
						  'vendorID'=>$vendor,
						  'klasID'=>$tipe,
						  'statusAset'=>$status,
						  'idDepresiasi'=>$depas,
						  'kondisiAset'=>$kondisi,
						  'tgl_updateAset'=>date('Y-m-d H:i:s'),
						  'petugasAset'=>$tanjaw,
						  'nilaiSisa'=>$salval,
						  'assetcost'=>$purcos);
				$this->muser->input_asset($data);	
				
				$ambilloc = $this->muser->get1_loc($loc);
				$tempat = $ambilloc->namaDept;
				
				//log nya bung
				if($status==0){
					$statuslog = 'In Store';
					$ubahan = '<p>State is set as '.$statuslog.'</p>
							   <p>Location is set to '.$tempat.'</p>';
				  } else if($status==1){
					$statuslog = 'In Use';
					$ubahan = '<p>State is set as '.$statuslog.'</p>
							   <p>Assigned to '.$tanjaw.'</p>
							   <p>Location is set to '.$tempat.'</p>';
				  }
				
				$datalog = array (
					'idAsetLog'=>$next,
					'waktu_update'=>date('Y-m-d H:i:s'),
					'perubahan' => $ubahan
				);
				$this->muser->input_log($datalog);	
					
				$this->session->set_flashdata('message', '<h4>Asset Added Successfully</h4>');  
				redirect('aset/admin/newasset');
	}
	
	function edit_asset(){
		//inisialisasi
				$id = $this->input->post('id');
				$nama = $this->input->post('nama');
				$vendor = $this->input->post('vendor');
				$tipe = $this->input->post('tipe');
				$loc = $this->input->post('loc');
				$lockir = $this->input->post('lockir');
				$purcos = $this->input->post('purcos');
				$purcoskir = $this->input->post('purcoskir');
				$tgl = $this->input->post('tgl');
				$kondisi = $this->input->post('kondisi');
				$tanjaw = $this->input->post('tanjaw');
				$deks = $this->input->post('desk');
				$stata = $this->input->post('status');
				$statb = $this->input->post('statas');
				// hasil upload file belum
				$karya = $this->session->userdata('nomorKaryawan');
				
		//cek depresiasi
				$cekec = $this->input->post('deprecheck');
				if($cekec==1){
					$depas = $this->input->post('depas');
					$uslif = $this->input->post('uslif');
					$salval = $this->input->post('salval');
					
					$datadep = array(
						  'umurEkonom'=>$uslif,
						  'idDepresiasi'=>$depas,
						  'nilaiSisa'=>$salval);
				  	$this->muser->update_as($id,$datadep);
				}
		
		//main status
				if($statb==1 || $statb==0){
					$datastat = array(
						'statusAset'=>$stata
					);
					
					$this->muser->update_as($id,$datastat);
				}
					
		//asset cost
		//'assetcost'=>$purcos
				$itemc = $this->muser->asset_cost($id);
				$cakhir = $itemc->terakhir;
				$nextc = $cakhir - $purcoskir + $purcos;
				$datac = array(
						'assetcost' => $nextc
				);
				$this->muser->update_as($id,$datac);
				
				
				$data = array(
				 	'namaAset'=>$nama,
					'keteranganAset'=>$deks,
					'tgl_beli'=>$tgl,
					'hargaBeli'=>$purcos,
					'CurVal'=>'', //gimana ngisinya ya? lupa euy
					'nomorKaryawan'=>$karya,
					'idDept'=>$loc,
					'vendorID'=>$vendor,
					'klasID'=>$tipe,
					'kondisiAset'=>$kondisi,
					'tgl_updateAset'=>date('Y-m-d H:i:s'),
					'petugasAset'=>$tanjaw,
				);
				
				$this->muser->update_as($id,$data);	
				
				//daerah mainan log
				//berubah kalau lokasi dan status berubah
				$ubahan = "";
				$ubahlok = "";
				if($stata!=$statb){
					if($statb==0) $statusawal = 'In Store';
					else $statusawal = 'In Use';
					if($stata==0) $statusakhir = 'In Store';
					else $statusakhir = 'In Use';
					
					if($stata==1){
						//saat jadi In Use
						$ubahan = "<p>State changed from ".$statusawal." to ".$statusakhir."</p>
								   <p>Assigned to ".$tanjaw."</p>";
					} else {
						//kalau status barunya In Store
						$ubahan = "<p>State changed from ".$statusawal." to ".$statusakhir."</p>";
					}				
				}
				
				if($loc!=$lockir){
					$ambilaw = $this->muser->get1_loc($loc);
					$lokasiaw = $ambilaw->namaDept;
					$ambilak = $this->muser->get1_loc($lockir);
					$lokasiak = $ambilak->namaDept;
					
					if($ubahan!=""){
						if($stata==1)
							$ubahlok = "<p>Location changed from ".$lokasiak." to ".$lokasiaw."</p>";
						else
							$ubahlok = "<p>Location changed from ".$lokasiak." to ".$lokasiaw."</p>";
					}else{
						//kalau status tetap
						$ubahlok = "<p>Location changed from ".$lokasiak." to ".$lokasiaw."</p>";
					}
				}
				
				if($ubahan!="" || $ubahlok!=""){
					$datalog = array (
							'idAsetLog'=>$id,
							'waktu_update'=>date('Y-m-d H:i:s'),
							'perubahan' => $ubahan.$ubahlok
						);
					$this->muser->input_log($datalog);
				}
					
				$this->session->set_flashdata('message', '<h4>Asset Edited Successfully</h4>');  
				redirect('aset/admin/itemasset/'.$id);
	}
	
	function input_service(){
				$id = $this->input->post('id1');
				$tgl = $this->input->post('tgl');
				$biaya = $this->input->post('biayacost');
				$deks = $this->input->post('desk');
				$cekek = $this->input->post('newitem');
				
				$nekstgl = $this->input->post('nekstgl');
				$usage = $this->input->post('usage');
				
				
				//input item baru
				if($cekek==1){
					$query = $this->muser->itemper_id();
					$akhir = $query->terakhir;
					$nextah = $akhir +1;	
					$namabar = $this->input->post('itembaru');
					$dataitem = array(
						'itemPerbaikID' =>'',
						'itemPerbaikNama' => $namabar
					);
					$this->muser->input_itser($dataitem);
					$itemp = $nextah;
				} else {
					$itema = $this->input->post('itemlama');
					$itemp = $itema;				
				}
				
				
				$data = array(
						  'perbaikID'=>'',
						  'tanggal'=>$tgl,
						  'deskripsi'=>$deks,
						  'status'=>'0',
						  'biaya'=>$biaya,
						  'itemPerbaikID'=>$itemp,
						  'nextSerA'=>$nekstgl,
						  'nextSerB'=>$usage,
						  'idAset'=>$id);
				$this->muser->input_ser($data);
				
				//nambah cost
				$itemc = $this->muser->asset_cost($id);
				$cakhir = $itemc->terakhir;
				$nextc = $cakhir + $biaya;
				$datac = array(
						'assetcost' => $nextc,
						'statusAset'=>2
				);
				$this->muser->update_as($id,$datac);
				
				//masuk log
				if($cekek==1){
					$namatam = $namabar;
				}else
				{
					$blabla = $this->muser->get1_itempe($itema);
					$namatam = $blabla->itemPerbaikNama;
				}
				$tgl_tampil = date("M jS, Y", strtotime($tgl));
				$ubahan = '<p>Asset put in Maintenance</p>
						   <p>Item : '.$namatam.'</p>
						   <p>Cost : '.$biaya.'</p>
						   <p>Service Date : '.$tgl_tampil.'</p>';
				
				$query = $this->muser->per_id();
				$idbaru = $query->terakhir;
				$datalog = array (
					'idAsetLog'=>$id,
					'waktu_update'=>date('Y-m-d H:i:s'),
					'perubahan' => $ubahan,
					'perbaikID' => $idbaru
				);
				$this->muser->input_log($datalog);	
				
				$this->session->set_flashdata('message', '<h4>Service Added Successfully</h4>');
				redirect('aset/admin/itemasset/'.$id);
	}
	
	function quicka(){
		$test = $this->input->post('quickac');
		redirect('aset/admin/itemasset/'.$test);
	}
	
	function update_rem(){
		$kondisi = $this->input->post('resourceState');
		$idboy = $this->input->post('id');
		$idset = $this->input->post('idAset');
		$biayanya = $this->input->post('sercos');
		$biayar = $this->input->post('biayar');
		$deks = $this->input->post('deks');
		
		if($kondisi==0){
			//update ke completed
			$statcek = $this->muser->get_count_pas($idset);
			if(($statcek-1)==0) $statusakhir = '0'; else $statusakhir = '2';
			$datacuk = array(
				  'statusAset'=>$statusakhir
				  );
			$this->muser->update_as($idset,$datacuk);
			
			$ubahan = '<p>State changed from In Repair to In Store</p>';
			if(($statcek-1)==0){		
				$datalog = array (
					'idAsetLog'=>$idset,
					'waktu_update'=>date('Y-m-d H:i:s'),
					'perubahan' => $ubahan
				);
				$this->muser->input_log($datalog);
			}
			
			$datacek = array(
				  'status'=>'1'
				  );
			$this->muser->update_pas($idboy,$datacek);
			
			$this->session->set_flashdata('message', '<h4>Service Completed Successfully</h4>');
			redirect('aset/admin/homeservice');
		}
		else if($kondisi==1){
			//edit isi data
			$statcek = $this->muser->get1_asset($idset);
			foreach($statcek as $sc){
				$daridb = $sc->assetcost;
			}
			$hargaakhir = $daridb - $biayar + $biayanya;
			$datacuk = array(
				  'assetcost'=>$hargaakhir
				  );
			$this->muser->update_as($idset,$datacuk);
			
			$datacek = array(
				  'biaya'=>$biayanya,
				  'deskripsi'=>$deks
				  );
			$this->muser->update_pas($idboy,$datacek);
			
			//log edit //otak atik lagi masbro
			$itema = $this->muser->get1_perlog($idboy);
			$blabla = $this->muser->get1_itempe($itema->itemPerbaikID);
			$namatam = $blabla->itemPerbaikNama;
			$tgl_tampil = date("M jS, Y", strtotime($itema->tanggal));
			$ubahan = '<p>Asset put in Maintenance</p>
						<p>Item : '.$namatam.'</p>
						<p>Cost : '.$biayanya.'</p>
						<p>Service Date : '.$tgl_tampil.'</p>';
				
			$datalog = array (
				'idAsetLog'=>$idset,
				'perubahan' => $ubahan
			);
			$this->muser->update_log_perbaik($idboy,$datalog);
			
			$this->session->set_flashdata('message', '<h4>Service Data Edited Successfully</h4>');
			redirect('aset/admin/homeservice');
		}
		else if($kondisi==2){	
			//delete data
			$statceka = $this->muser->get_count_pas($idset);
			if(($statceka-1)==0) $statusakhir = '0'; else $statusakhir = '2';
		
			$statcek = $this->muser->get1_asset($idset);
			foreach($statcek as $sc){
				$daridb = $sc->assetcost;
			}
			$hargaakhir = $daridb - $biayanya;
			$datacuk = array(
				  'assetcost'=>$hargaakhir,
				  'statusAset'=>$statusakhir
				  );
			$this->muser->update_as($idset,$datacuk);
			
				$ubahan = '<p>State changed from In Repair to In Store</p>
						   <p>In case of Maintenance Data deletion</p>';
			if(($statceka-1)==0){		
				$datalog = array (
					'idAsetLog'=>$idset,
					'waktu_update'=>date('Y-m-d H:i:s'),
					'perubahan' => $ubahan
				);
				$this->muser->input_log($datalog);
			}
				
			$this->muser->delete_pas($idboy);
			$this->session->set_flashdata('message', '<h4>Service Data Deleted Successfully</h4>');
			redirect('aset/admin/homeservice');
		};
		
	}
	
	function input_disposal(){
				$id = $this->input->post('id1');
				$discost = $this->input->post('discost');
				$dissell = $this->input->post('dissell');
				$status = $this->input->post('resourceState');
				$statawas = $this->input->post('stata');
				
				if($status==0) $hargamati=$discost;
				else $hargamati=$dissell;
								
				$data = array(
						  'disposalID'=>'',
						  'tanggal'=>date('Y-m-d'),
						  'status'=>$status,
						  'idAset'=>$id,
						  'hasil'=>$hargamati);
				$this->muser->input_disposal($data);
				
				//nambah cost
				if($status==0){
					$statcek = $this->muser->get1_asset($id);
					foreach($statcek as $sc){
						$daridb = $sc->assetcost;
					}
					$hargaakhir = $daridb + $discost;
					
					$datac = array(
							'assetcost' => $hargaakhir,
					);
					$this->muser->update_as($id,$datac);
				}
				
				//update status di aset
				$dataa = array('statusAset'=>'3');
				$this->muser->update_as($id,$dataa);
				
				//masuk log
				if($statawas==0) $statusawal = 'In Store';
				else if($statawas==1) $statusawal = 'In Use';
				else if($statawas==2) $statusawal = 'In Repair';
				else $statusawal = 'Disposed';
				
				$tgl_tampil = date("M jS, Y");
				$ubahan1 = '<p>State changed from '.$statusawal.' to Disposed</p>';
				if($status==0) $ubahan2 = '<p>Disposal Cost : '.$discost.'</p>';
				else $ubahan2 = '<p>Selling Price : '.$dissell.'</p>';
				$ubahan3 = '<p>Disposal Date : '.$tgl_tampil.'</p>';
				
				$datalog = array (
					'idAsetLog'=>$id,
					'waktu_update'=>date('Y-m-d H:i:s'),
					'perubahan' => $ubahan1.$ubahan2.$ubahan3
				);
				$this->muser->input_log($datalog);	
				
				$this->session->set_flashdata('message', '<h4>Disposal Added Successfully</h4>');
				redirect('aset/admin/itemasset/'.$id);
	}
	
	function edit_rem_dis(){
		$kondisi = $this->input->post('resourceState');
		$idboy = $this->input->post('id');
		$idset = $this->input->post('idAset');
		$distat = $this->input->post('diposeState');
		$cost = $this->input->post('discos');
		$sell = $this->input->post('dissell');
		$statusdis = $this->input->post('stadis');
		
		if($kondisi==0){
			if($distat==0) $hasila = $cost;
			else $hasila  =$sell;
			//data edit disini
			$datadis = array(
				'status'=>$distat,
				'hasil'=>$hasila
			);
			$this->muser->update_dis($idboy,$datadis);
			
			//masuk ke log
			$tulis1 = '<p>Disposal Data has been changed</p>
						<p>Disposal Cost : '.$hasila.'</p>';
			$tulis2 = '<p>Disposal Data has been changed</p>
						<p>Selling Price : '.$hasila.'</p>';
			if($distat==0) $ubahan = $tulis1;
			else $ubahan  =$tulis2;		
				
			$datalog = array (
				'idAsetLog'=>$idset,
				'waktu_update'=>date('Y-m-d H:i:s'),
				'perubahan' => $ubahan
			);
			$this->muser->input_log($datalog);
			
			$this->session->set_flashdata('message', '<h4>Disposal Data Edited</h4>');
			redirect('aset/admin/homedisposal');
		}
		else {
			
			//kalau dispose
			if($statusdis==0){
				$statcek = $this->muser->get1_asset($idset);
				foreach($statcek as $sc){
					$daridb = $sc->assetcost;
				}
				$hargaakhir = $daridb - $cost ;
				$datacuk = array(
					  'assetcost'=>$hargaakhir
					  );
				$this->muser->update_as($idset,$datacuk);
			}
			//status aset jadi In Store
			$remas = array(
							'statusAset' => 0
					);
			$this->muser->update_as($idset,$remas);
			
			//masuk ke log
			$ubahan = '<p>State changed from Disposed to In Store</p>
						<p>In case of Disposal Data deletion</p>';
				
			$datalog = array (
				'idAsetLog'=>$idset,
				'waktu_update'=>date('Y-m-d H:i:s'),
				'perubahan' => $ubahan
			);
			$this->muser->input_log($datalog);	
			
			//data disposal di apus
			$this->muser->delete_dis($idboy);
			
			$this->session->set_flashdata('message', '<h4>Disposal Data Removed</h4>');
			redirect('aset/admin/homedisposal');
		};
		
	}
	
	function reporting(){
		//fungsi dari report kesini aja dah
		$pilih = $this->input->post('isitipe');
		$aset1 = $this->input->post('aset');
		$condi = $this->input->post('condi');
		$statu = $this->input->post('statu');
		$tipel = $this->input->post('tipel');
		if($pilih == 0){ //default valuenya 0
			redirect('aset/admin/reportlis/');
		} else if($pilih == 4){
			redirect('aset/admin/reportas/'.$aset1);
		} else if($pilih == 1){
			redirect('aset/admin/reportlis/'.$pilih."/".$condi);
		} else if($pilih == 2){
			redirect('aset/admin/reportlis/'.$pilih."/".$statu);
		} else if($pilih == 3){
			redirect('aset/admin/reportlis/'.$pilih."/".$tipel);
		} else if($pilih == 5){
			redirect('aset/admin/reportlis/'.$pilih);
		}
	}
	
	function editrole(){
		//fungsi dari report kesini aja dah
		$idsession = $this->uri->segment(4);
		$namases = $this->input->post('nama');
		$cek0 = $this->input->post('cek0');
		$cek1 = $this->input->post('cek1');
		$cek2 = $this->input->post('cek2');
		$cek3 = $this->input->post('cek3');
		$cek4 = $this->input->post('cek4');
		$cek5 = $this->input->post('cek5');
		$cek6 = $this->input->post('cek6');
		$cek7 = $this->input->post('cek7');
		$cek8 = $this->input->post('cek8');
		
		//update ke db sess
		$datasess = array(
							'sessionname' => $namases
					);
		$this->muser->update_sess($idsession,$datasess);
		
		if($cek0!='') $stat0 = "yes"; else $stat0 = "no";
		if($cek1!='') $stat1 = "yes"; else $stat1 = "no";
		if($cek2!='') $stat2 = "yes"; else $stat2 = "no";
		if($cek3!='') $stat3 = "yes"; else $stat3 = "no";
		if($cek4!='') $stat4 = "yes"; else $stat4 = "no";
		if($cek5!='') $stat5 = "yes"; else $stat5 = "no";
		if($cek6!='') $stat6 = "yes"; else $stat6 = "no";
		if($cek7!='') $stat7 = "yes"; else $stat7 = "no";
		if($cek8!='') $stat8 = "yes"; else $stat8 = "no";
		
		$data0 = array(
				'stat' => $stat0
			);
		$this->muser->update_sessper($idsession, 1 ,$data0);
		
		$data1 = array(
				'stat' => $stat1
			);
		$this->muser->update_sessper($idsession, 2 ,$data1);
		
		$data2 = array(
				'stat' => $stat2
			);
		$this->muser->update_sessper($idsession,3 ,$data2);
		
		$data3 = array(
				'stat' => $stat3
			);
		$this->muser->update_sessper($idsession, 4 ,$data3);
		
		$data4 = array(
				'stat' => $stat4
			);
		$this->muser->update_sessper($idsession, 5 ,$data4);
		
		$data5 = array(
				'stat' => $stat5
			);
		$this->muser->update_sessper($idsession, 6 ,$data5);
		
		$data6 = array(
				'stat' => $stat6
			);
		$this->muser->update_sessper($idsession, 7 ,$data6);

		$data7 = array(
				'stat' => $stat7
			);
		$this->muser->update_sessper($idsession, 8 ,$data7);
		
		$data8 = array(
				'stat' => $stat8
			);
		$this->muser->update_sessper($idsession, 9 ,$data8);
		
		$this->session->set_flashdata('message', '<h4>User Role Edited</h4>');
		redirect('aset/admin/role');
	}
	
	function inputrole(){
		//fungsi dari report kesini aja dah
		$query = $this->muser->sess_id();
		$akhir = $query->terakhir;
		$nextah = $akhir +1;	
		$idsession = $nextah;
		
		$namases = $this->input->post('nama');
		$cek0 = $this->input->post('cek0');
		$cek1 = $this->input->post('cek1');
		$cek2 = $this->input->post('cek2');
		$cek3 = $this->input->post('cek3');
		$cek4 = $this->input->post('cek4');
		$cek5 = $this->input->post('cek5');
		$cek6 = $this->input->post('cek6');
		$cek7 = $this->input->post('cek7');
		$cek8 = $this->input->post('cek8');
		
		//update ke db sess
		$datasess = array(
							'sessionname' => $namases
					);
		$this->muser->input_sess($datasess);
		
		if($cek0!='') $stat0 = "yes"; else $stat0 = "no";
		if($cek1!='') $stat1 = "yes"; else $stat1 = "no";
		if($cek2!='') $stat2 = "yes"; else $stat2 = "no";
		if($cek3!='') $stat3 = "yes"; else $stat3 = "no";
		if($cek4!='') $stat4 = "yes"; else $stat4 = "no";
		if($cek5!='') $stat5 = "yes"; else $stat5 = "no";
		if($cek6!='') $stat6 = "yes"; else $stat6 = "no";
		if($cek7!='') $stat7 = "yes"; else $stat7 = "no";
		if($cek8!='') $stat8 = "yes"; else $stat8 = "no";
		
		$data0 = array(
				'sess'=> $idsession,
				'permission'=> 1,
				'stat' => $stat0
			);
		$this->muser->input_sessper($data0);
		
		$data1 = array(
				'sess'=> $idsession,
				'permission'=> 2,
				'stat' => $stat1
			);
		$this->muser->input_sessper($data1);
		
		$data2 = array(
				'sess'=> $idsession,
				'permission'=> 3,
				'stat' => $stat2
			);
		$this->muser->input_sessper($data2);
		
		$data3 = array(
				'sess'=> $idsession,
				'permission'=> 4,
				'stat' => $stat3
			);
		$this->muser->input_sessper($data3);
		
		$data4 = array(
				'sess'=> $idsession,
				'permission'=> 5,
				'stat' => $stat4
			);
		$this->muser->input_sessper($data4);
		
		$data5 = array(
				'sess'=> $idsession,
				'permission'=> 6,
				'stat' => $stat5
			);
		$this->muser->input_sessper($data5);
		
		$data6 = array(
				'sess'=> $idsession,
				'permission'=> 7,
				'stat' => $stat6
			);
		$this->muser->input_sessper($data6);

		$data7 = array(
				'sess'=> $idsession,
				'permission'=> 8,
				'stat' => $stat7
			);
		$this->muser->input_sessper($data7);
		
		$data8 = array(
				'sess'=> $idsession,
				'permission'=> 9,
				'stat' => $stat8
			);
		$this->muser->input_sessper($data8);
		
		$this->session->set_flashdata('message', '<h4>Input User Role Successfully</h4>');
		redirect('aset/admin/role');
	}
	
	function roletipu(){
		$pilihan = $this->input->post('rolele');
		if($pilihan=='1'){
			redirect('aset/admin/roleedit/1');
		}else
			redirect('aset/admin/roleedit/2');
	}
	
}