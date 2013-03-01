<?php 

class Admin extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('encrypt');
		$this->load->model('aset/muser');
		
		//cek
		$oke = $this->session->userdata('logged_in');
		if($oke!=true)redirect(base_url());
	}
	
	public function index(){
		//echo 'ini halaman admin';
		
		//sessionkah
		$web['sesyen'] = $this->muser->get_roleuser($this->session->userdata('sessioniduser'));
		
		//load view
		$web['title'] = 'Home';
		$web['script'] = 'default/script';
		$web['header'] = 'default/header';
		$web['secondbar'] = 'default/secondbar';
		$web['sidebar'] = '/aset/menu/admin_sidebar';
		
		//isi data
		$web['store'] = $this->muser->get_count_status(0);
		$web['use'] = $this->muser->get_count_status(1);
		$web['repair'] = $this->muser->get_count_status(2);
		$web['dispose'] = $this->muser->get_count_status(3);
		$web['total'] = $this->muser->get_count_total();
		$web['body'] = 'default/body'; /* nanti main disini */
		$web['breadcrumbs'] = '';
		$web['pesan']=$this->muser->get_count_unread();
				
		$this->load->view('default/view_base',$web);
	}
	
	/*function sessionadmin(){
		$jabatAset = $this->session->userdata('sessionuser');
		if ($jabatAset != 'Administrator'){
			$this->load->view('vlogin');	
			return false;
		}
	}*/
	
	public function user(){
		$web['sesyen'] = $this->muser->get_roleuser($this->session->userdata('sessioniduser'));
		//load view
		$web['title'] = 'Add New User';
		$web['script'] = 'default/script';
		$web['header'] = 'default/header';
		$web['secondbar'] = 'default/secondbar';
		$web['sidebar'] = '/aset/menu/admin_sidebar';
		$web['body'] = '/aset/content/addUser';
		$web['breadcrumbs'] = array('User','Add New Users');
		$web['sessien'] = $this->muser->get_sess();
		$web['pesan']=$this->muser->get_count_unread();
		
		//bikin userID otomatis :D
		$taun = date('Y');
		$query = $this->muser->user_id($taun);
		$akhir = $query->terakhir;
		$angka = substr($akhir, 7, 3);
		$angkatt = $angka +1;
		$next = 'KAR'.$taun.sprintf('%03s', $angkatt); 
		$web['data'] = $next;
				
		$this->load->view('default/view_base',$web);
		//use default/view_popup to create popup page
		
	}
	
	function listUser() {
			$web['sesyen'] = $this->muser->get_roleuser($this->session->userdata('sessioniduser'));
			$web['title'] = 'Users List';
			$web['sessien'] = $this->muser->get_sess();
			$web['script'] = 'default/script';
			$web['header'] = 'default/header';
			$web['secondbar'] = 'default/secondbar';
			$web['sidebar'] = 'aset/menu/admin_sidebar';
			$web['body'] = ('aset/content/listUser');
			$web['data'] = $this->muser->get_user();
			$web['breadcrumbs'] = array("User","View Users");
			$web['pesan']=$this->muser->get_count_unread();
			
			$this->load->view('default/view_base',$web);
	}
	
	public function profile(){
		$web['sesyen'] = $this->muser->get_roleuser($this->session->userdata('sessioniduser'));
		//load view
		$web['title'] = 'My Profile Page';
		$web['script'] = 'default/script';
		$web['header'] = 'default/header';
		$web['secondbar'] = 'default/secondbar';
		$web['sidebar'] = '/aset/menu/admin_sidebar';
		$web['body'] = '/aset/content/profile';
		$web['breadcrumbs'] = array("User","My Profile");
		$web['pesan']=$this->muser->get_count_unread();
		
		//baca 1 data
		$karya = $this->session->userdata('nomorKaryawan');
		$web['data'] = $this->muser->get1_user($karya);
				
		$this->load->view('default/view_base',$web);
	}
	
	public function vendor(){
		$web['sesyen'] = $this->muser->get_roleuser($this->session->userdata('sessioniduser'));		
		//load view
		$web['title'] = 'Add New Vendor';
		$web['script'] = 'default/script';
		$web['header'] = 'default/header';
		$web['secondbar'] = 'default/secondbar';
		$web['sidebar'] = '/aset/menu/admin_sidebar';
		$web['body'] = '/aset/content/addVendor';
		$web['breadcrumbs'] = array('Support Data','Add New Vendor');
		$web['pesan']=$this->muser->get_count_unread();
		
		//generate id
		//bikin userID otomatis :D
		$taun = date('Y');
		$query = $this->muser->vendor_id($taun);
		$akhir = $query->terakhir;
		$angka = substr($akhir, 7, 3);
		$angkatt = $angka +1;
		$next = 'VEN'.$taun.sprintf('%03s', $angkatt); 
		$web['data'] = $next;
				
		$this->load->view('default/view_base',$web);
		//use default/view_popup to create popup page
	}
	
	function listVendor() {
		$web['sesyen'] = $this->muser->get_roleuser($this->session->userdata('sessioniduser'));
			$web['title'] = 'Vendors List';
			$web['script'] = 'default/script';
			$web['header'] = 'default/header';
			$web['secondbar'] = 'default/secondbar';
			$web['sidebar'] = 'aset/menu/admin_sidebar';
			$web['body'] = ('aset/content/listvendor');
			$web['data'] = $this->muser->get_vendor();
			$web['breadcrumbs'] = array("Support Data","View Vendors");
			$web['pesan']=$this->muser->get_count_unread();
			
			$this->load->view('default/view_base',$web);
	}
	
	function listKlas() {
		$web['sesyen'] = $this->muser->get_roleuser($this->session->userdata('sessioniduser'));
			$web['title'] = 'Type List';
			$web['script'] = 'default/script';
			$web['header'] = 'default/header';
			$web['secondbar'] = 'default/secondbar';
			$web['sidebar'] = 'aset/menu/admin_sidebar';
			$web['body'] = ('aset/content/listklas');
			$web['data'] = $this->muser->get_klas();
			$web['breadcrumbs'] = array("Support Data","Type");
			$web['pesan']=$this->muser->get_count_unread();
			
			$this->load->view('default/view_base',$web);
	}
	
	function listLoc() {
		$web['sesyen'] = $this->muser->get_roleuser($this->session->userdata('sessioniduser'));
			$web['title'] = 'Location List';
			$web['script'] = 'default/script';
			$web['header'] = 'default/header';
			$web['secondbar'] = 'default/secondbar';
			$web['sidebar'] = 'aset/menu/admin_sidebar';
			$web['body'] = ('aset/content/listloc');
			$web['data'] = $this->muser->get_loc();
			$web['breadcrumbs'] = array("Support Data","Location");
			$web['pesan']=$this->muser->get_count_unread();
			
			$this->load->view('default/view_base',$web);
	}
	
	function purreq() {
		$web['sesyen'] = $this->muser->get_roleuser($this->session->userdata('sessioniduser'));
			$web['title'] = 'Purchase Request';
			$web['script'] = 'default/script';
			$web['header'] = 'default/header';
			$web['secondbar'] = 'default/secondbar';
			$web['sidebar'] = 'aset/menu/admin_sidebar';
			$web['body'] = ('aset/content/listpurreq');
			$web['data'] = $this->muser->get_purreq();
			$web['tipelist'] = $this->muser->get_klas();
			$web['vendorlist'] = $this->muser->get_vendor();
			$web['breadcrumbs'] = array("Asset","Purchase Request","Purchase Request Data");
			$web['pesan']=$this->muser->get_count_unread();
			
			$this->load->view('default/view_base',$web);
	}
	
	function approval() {
		//editable
			$web['sesyen'] = $this->muser->get_roleuser($this->session->userdata('sessioniduser'));
			$web['title'] = 'Approval Page';
			$web['body'] = ('aset/content/approval');
			$web['data'] = $this->muser->get_purreq_when();
			$web['breadcrumbs'] = array("Asset","Purchase Request","Approval");	
			
		//do not edit
			$web['script'] = 'default/script';
			$web['header'] = 'default/header';
			$web['secondbar'] = 'default/secondbar';
			$web['sidebar'] = 'aset/menu/admin_sidebar';
			$web['pesan']=$this->muser->get_count_unread();
			
			$this->load->view('default/view_base',$web);
	}
	
	function frontpurreq() {
		//editable
			$web['sesyen'] = $this->muser->get_roleuser($this->session->userdata('sessioniduser'));
			$web['title'] = 'Purchase Request Menu';
			$web['body'] = ('aset/content/homepurreq');
			$web['breadcrumbs'] = array("Asset","Purchase Request");	
			
		//do not edit
			$web['script'] = 'default/script';
			$web['header'] = 'default/header';
			$web['secondbar'] = 'default/secondbar';
			$web['sidebar'] = 'aset/menu/admin_sidebar';
			$web['pesan']=$this->muser->get_count_unread();
			
			$this->load->view('default/view_base',$web);
	}
	
	function appdec() {
		//editable
			$web['sesyen'] = $this->muser->get_roleuser($this->session->userdata('sessioniduser'));
			$web['title'] = 'Approved or Declined';
			$web['body'] = ('aset/content/appdec');
			$web['data'] = $this->muser->get_purreq_appdec();
			$web['breadcrumbs'] = array("Asset","Purchase Request","Approved / Declined");	
			
		//do not edit
			$web['script'] = 'default/script';
			$web['header'] = 'default/header';
			$web['secondbar'] = 'default/secondbar';
			$web['sidebar'] = 'aset/menu/admin_sidebar';
			$web['pesan']=$this->muser->get_count_unread();
			
			$this->load->view('default/view_base',$web);
	}
	
	function toasset() {
		//editable
			$web['sesyen'] = $this->muser->get_roleuser($this->session->userdata('sessioniduser'));
			$web['title'] = 'PR To Asset';
			$web['body'] = ('aset/content/toasset');
			$web['data'] = $this->muser->get_purreq_to_asset();
			$web['breadcrumbs'] = array("Asset","Purchase Request","PR To Asset");	
			
		//do not edit
			$web['script'] = 'default/script';
			$web['header'] = 'default/header';
			$web['secondbar'] = 'default/secondbar';
			$web['sidebar'] = 'aset/menu/admin_sidebar';
			$web['pesan']=$this->muser->get_count_unread();
			
			$this->load->view('default/view_base',$web);
	}
	
	function almostasset() {
		//editable
			$web['sesyen'] = $this->muser->get_roleuser($this->session->userdata('sessioniduser'));
			$web['title'] = 'PR To Asset Detail';
			$web['body'] = ('aset/content/almostoasset');
			$web['data'] = $this->muser->get1_purreq($this->uri->segment(4));
			$web['tipelist'] = $this->muser->get_klas();
			$web['vendorlist'] = $this->muser->get_vendor();
			$web['loclist'] = $this->muser->get_loc();
			$web['deplist'] = $this->muser->get_dep();
			$web['breadcrumbs'] = array("Asset","Purchase Request","PR To Asset Detail");	
			
		//do not edit
			$web['script'] = 'default/script';
			$web['header'] = 'default/header';
			$web['secondbar'] = 'default/secondbar';
			$web['sidebar'] = 'aset/menu/admin_sidebar';
			$web['pesan']=$this->muser->get_count_unread();
			
			$this->load->view('default/view_base',$web);
	}
	
	function frontasset() {
		//editable
			$web['sesyen'] = $this->muser->get_roleuser($this->session->userdata('sessioniduser'));
			$web['title'] = 'Asset Menu';
			$web['body'] = ('aset/content/homeasset');
			$web['breadcrumbs'] = array("Asset");	
			
		//do not edit
			$web['script'] = 'default/script';
			$web['header'] = 'default/header';
			$web['secondbar'] = 'default/secondbar';
			$web['sidebar'] = 'aset/menu/admin_sidebar';
			$web['pesan']=$this->muser->get_count_unread();
			
			$this->load->view('default/view_base',$web);
	}
	
	function asset() {
		//editable
			$web['sesyen'] = $this->muser->get_roleuser($this->session->userdata('sessioniduser'));
			
			$cek = $this->uri->segment(4);
			if($cek=='')
				$web['data'] = $this->muser->get_asetdata();
			else
				$web['data'] =  $this->muser->get_whereasset($cek);
		
			$web['title'] = 'Asset Data';
			$web['body'] = ('aset/content/asset');
			
			$web['breadcrumbs'] = array("Asset","Asset Data");	
			
		//do not edit
			$web['script'] = 'default/script';
			$web['header'] = 'default/header';
			$web['secondbar'] = 'default/secondbar';
			$web['sidebar'] = 'aset/menu/admin_sidebar';
			$web['pesan']=$this->muser->get_count_unread();
			
			$this->load->view('default/view_base',$web);
	}
	
	function newasset() {
		//editable
			$web['sesyen'] = $this->muser->get_roleuser($this->session->userdata('sessioniduser'));
			$web['title'] = 'New Asset';
			$web['body'] = ('aset/content/newasset');
			$web['tipelist'] = $this->muser->get_klas();
			$web['vendorlist'] = $this->muser->get_vendor();
			$web['loclist'] = $this->muser->get_loc();
			$web['deplist'] = $this->muser->get_dep();
			$web['breadcrumbs'] = array("Asset","New Asset");	
			
		//do not edit
			$web['script'] = 'default/script';
			$web['header'] = 'default/header';
			$web['secondbar'] = 'default/secondbar';
			$web['sidebar'] = 'aset/menu/admin_sidebar';
			$web['pesan']=$this->muser->get_count_unread();
			
			$this->load->view('default/view_base',$web);
	}
	
	function itemasset() {
		//editable
			$web['sesyen'] = $this->muser->get_roleuser($this->session->userdata('sessioniduser'));
			$web['title'] = 'Asset Detail';
			$web['data'] =  $this->muser->get1_asset($this->uri->segment(4));
			$tangkap = $this->muser->get1_asset($this->uri->segment(4));
			$web['logg'] = $this->muser->get1_log($this->uri->segment(4));
			$web['breadcrumbs'] = array("Asset","Asset Data","Asset Detail");
			if(($tangkap) == '') $web['body'] = ('default/body');	
			else $web['body'] = ('aset/content/detailasset');	
			
		//do not edit
			$web['script'] = 'default/script';
			$web['header'] = 'default/header';
			$web['secondbar'] = 'default/secondbar';
			$web['sidebar'] = 'aset/menu/admin_sidebar';
			$web['pesan']=$this->muser->get_count_unread();
			
			$this->load->view('default/view_base',$web);
	}
	
	function service() {
		//editable
			$web['sesyen'] = $this->muser->get_roleuser($this->session->userdata('sessioniduser'));
			$web['title'] = 'Asset Service / Maintenance';
			$web['body'] = ('aset/content/servicedetail');
			$web['data'] =  $this->muser->get1_asset($this->uri->segment(4));
			$web['itper'] = $this->muser->get_itper();
			$web['breadcrumbs'] = array("Asset","Asset Data","Asset Detail","Service / Maintenance Detail");	
			
		//do not edit
			$web['script'] = 'default/script';
			$web['header'] = 'default/header';
			$web['secondbar'] = 'default/secondbar';
			$web['sidebar'] = 'aset/menu/admin_sidebar';
			$web['pesan']=$this->muser->get_count_unread();
			
			$this->load->view('default/view_base',$web);
	}
	
	function disposal() {
		//editable
			$web['sesyen'] = $this->muser->get_roleuser($this->session->userdata('sessioniduser'));
			$web['title'] = 'Asset Disposal';
			$web['body'] = ('aset/content/disposaldetail');
			$web['data'] =  $this->muser->get1_asset($this->uri->segment(4));
			$web['breadcrumbs'] = array("Asset","Asset Data","Asset Detail","Disposal");	
			
		//do not edit
			$web['script'] = 'default/script';
			$web['header'] = 'default/header';
			$web['secondbar'] = 'default/secondbar';
			$web['sidebar'] = 'aset/menu/admin_sidebar';
			$web['pesan']=$this->muser->get_count_unread();
			
			$this->load->view('default/view_base',$web);
	}
	
	function editasset() {
		//editable
			$web['sesyen'] = $this->muser->get_roleuser($this->session->userdata('sessioniduser'));
			$web['title'] = 'Edit Asset Detail';
			$web['data'] =  $this->muser->get1_asset($this->uri->segment(4));
			$web['logg'] = $this->muser->get1_log($this->uri->segment(4));
			$web['tipelist'] = $this->muser->get_klas();
			$web['vendorlist'] = $this->muser->get_vendor();
			$web['loclist'] = $this->muser->get_loc();
			$web['deplist'] = $this->muser->get_dep();
			$web['breadcrumbs'] = array("Asset","Asset Data","Edit Asset Detail");
			$web['body'] = ('aset/content/editaset');	
			
		//do not edit
			$web['script'] = 'default/script';
			$web['header'] = 'default/header';
			$web['secondbar'] = 'default/secondbar';
			$web['sidebar'] = 'aset/menu/admin_sidebar';
			$web['pesan']=$this->muser->get_count_unread();
			
			$this->load->view('default/view_base',$web);
	}
	
	function homeservice() {
		//editable
		$web['sesyen'] = $this->muser->get_roleuser($this->session->userdata('sessioniduser'));
		$cek = $this->input->post('serviceac');;
			$web['title'] = 'Service / Maintenance Page';
			$web['body'] = ('aset/content/servicehome');
		if($cek=='')
			$web['data'] =  $this->muser->get_perbaik();
		else
			$web['data'] =  $this->muser->get_whereperbaik($cek);
			$web['breadcrumbs'] = array("Asset","Service / Maintenance Page");	
			
		//do not edit
			$web['script'] = 'default/script';
			$web['header'] = 'default/header';
			$web['secondbar'] = 'default/secondbar';
			$web['sidebar'] = 'aset/menu/admin_sidebar';
			$web['pesan']=$this->muser->get_count_unread();
			
			$this->load->view('default/view_base',$web);
	}
	
	function homedisposal() {
		//editable
			$web['sesyen'] = $this->muser->get_roleuser($this->session->userdata('sessioniduser'));
		$cek = $this->input->post('disposalac');
			$web['title'] = 'Disposal Page';
			$web['body'] = ('aset/content/disposalhome');
		if($cek=='')
			$web['data'] =  $this->muser->get_dispose();
		else
			$web['data'] =  $this->muser->get_wheredispose($cek);
			$web['breadcrumbs'] = array("Asset","Disposal Page");	
			
		//do not edit
			$web['script'] = 'default/script';
			$web['header'] = 'default/header';
			$web['secondbar'] = 'default/secondbar';
			$web['sidebar'] = 'aset/menu/admin_sidebar';
			$web['pesan']=$this->muser->get_count_unread();
			
			$this->load->view('default/view_base',$web);
	}
	
	function report() {
		//editable
			$web['sesyen'] = $this->muser->get_roleuser($this->session->userdata('sessioniduser'));
			$web['title'] = 'Report Page';
			$web['body'] = ('aset/content/reportmenu');
			$web['typelist'] = $this->muser->get_klas();
			$web['breadcrumbs'] = array("Reports","Asset Reports");	
			
		//do not edit
			$web['script'] = 'default/script';
			$web['header'] = 'default/header';
			$web['secondbar'] = 'default/secondbar';
			$web['sidebar'] = 'aset/menu/admin_sidebar';
			$web['pesan']=$this->muser->get_count_unread();
			
			$this->load->view('default/view_base',$web);
	}
	
	function reportlis(){
		//editable
		
		//catatan 1 = kondisi. 2 = status. 3 = tipe
		$cekek = $this->uri->segment(4);
		$daleman = $this->uri->segment(5);
		if($cekek == 1) $web['data'] = $this->muser->get_condiasset($daleman);
		if($cekek == 2) $web['data'] = $this->muser->get_whereasset($daleman);
		if($cekek == 3) $web['data'] = $this->muser->get_tipeasset($daleman);
		if($cekek == "") $web['data'] = $this->muser->get_asetdata();
		
			$web['title'] = 'Asset List';
			$web['body'] = 'aset/content/replist';
			
		//do not edit
			$web['script'] = 'default/script';
			
			$this->load->view('default/view_rep',$web);
	}
	
	function reportas(){
		//editable
			$web['title'] = 'Asset Detail Report';
			$web['body'] = 'aset/content/repasset';
			$web['data'] =  $this->muser->get1_asset($this->uri->segment(4));
			
		//do not edit
			$web['script'] = 'default/script';
			
			$this->load->view('default/view_rep',$web);
	}
	
	function role() {
		//editable
			$web['sesyen'] = $this->muser->get_roleuser($this->session->userdata('sessioniduser'));
			$web['title'] = 'Manage Role';
			$web['data'] = $this->muser->get_role();
			$web['inin'] = $this->muser->get_permis();
			$web['body'] = ('aset/content/role');
			$web['breadcrumbs'] = array("Admin","Manage Role");	
			
		//do not edit
			$web['script'] = 'default/script';
			$web['header'] = 'default/header';
			$web['secondbar'] = 'default/secondbar';
			$web['sidebar'] = 'aset/menu/admin_sidebar';
			$web['pesan']=$this->muser->get_count_unread();
			
			$this->load->view('default/view_base',$web);
	}
	
	function roleedit() {
		//editable
			$web['sesyen'] = $this->muser->get_roleuser($this->session->userdata('sessioniduser'));
			$web['title'] = 'Edit Role';
			$web['rolee'] = $this->muser->get_namerole($this->uri->segment(4));
			$web['data'] = $this->muser->get_roleuser($this->uri->segment(4));
			$web['body'] = ('aset/content/roleedit');
			$web['breadcrumbs'] = array("Admin","Manage Role");	
			
		//do not edit
			$web['script'] = 'default/script';
			$web['header'] = 'default/header';
			$web['secondbar'] = 'default/secondbar';
			$web['sidebar'] = 'aset/menu/admin_sidebar';
			$web['pesan']=$this->muser->get_count_unread();
			
			$this->load->view('default/view_base',$web);
	}
	
	//coba itung2 yuk :)
	function straightline($tahunbeli,$hargabelinya,$sisanya,$masaidupnya){
		$tahun = date("Y", strtotime($tahunbeli));
		$depres = ($hargabelinya-$sisanya)/$masaidupnya;
		$akul = 0;
		$i = 0;
		while($masaidupnya>=$i){
			$tahuntampil = $tahun + $i;
			$bukfelue = $hargabelinya-$akul;
			$shop[1][$i]=$tahuntampil;
			$shop[2][$i]=$depres;
			$shop[3][$i]=$akul;
			$shop[4][$i]=$bukfelue;
		}
		$akul = $akul+$depres; 
		$i++;
	}
	
	//autocomplete
	function quick_access(){
		// process posted form data (the requested items like province)
        $keyword = $this->input->post('term');
        $data['response'] = 'false'; //Set default response
        $query = $this->muser->mquick_access($keyword); //Search DB
        if( ! empty($query) )
        {
            $data['response'] = 'true'; //Set response
            $data['message'] = array(); //Create array
            foreach( $query as $row )
            {
                $data['message'][] = array( 
                                        'id'=>$row->idAset,
                                        'value' => $row->idAset,
                                        ''
                                     );  //Add a row to array
            }
        }
        if('IS_AJAX')
        {
            echo json_encode($data); //echo json string if ajax request
            
        }
        else
        {
            //$this->load->view('autocomplete/index',$data); //Load html view of search results
        }
	}
}