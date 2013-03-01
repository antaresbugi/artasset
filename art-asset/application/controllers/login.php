<?php 

class Login extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('mlogin');
		
		$this->load->library('encrypt');
	}
	
	public function checkin(){
		$this->load->model('aset/muser');
		$user = $this->input->post('user');
		$pass = $this->input->post('pass');
		$hasil = $this->mlogin->checkdb($user, $pass);
			
		if($hasil == true){
			foreach ($hasil as $h):
			if($h->status==0){
				$this->session->set_flashdata('message', "<h4 class='alert_error'><blink>Your Account is Inactive</blink></h4>");
				redirect(base_url());
			}else{
				$data=array(
							'nomorKaryawan' => $user,
							'nama' => $h->fullName,
							'sessionuser' => $h->sessionname,
							'sessioniduser' => $h->sessionid,
							'url' => $h->sessiondir,
							'logged_in'=>true
						);
				$this->session->set_userdata($data);
				redirect('/aset'+$data['url']);
			}
			endforeach;
		}else{
			$this->session->set_flashdata('message', "<h4 class='alert_error'><blink>Wrong User ID and Password combination.</blink></h4>");
			redirect(base_url());	
		}
	}
	
	function logout(){
			$this->session->unset_userdata(array('nama' => '','nomorKaryawan' => '','sessionuser' => '','url' => '','logged_in' => '','aset' => '','sma' => '','dis' => '','typ' => '','loca' => '','vend' => '','user' => '','role' => ''));
			redirect(base_url());
	}
	
		
	public function index(){
		$jabatAset = $this->session->userdata('logged_in');
		if ($jabatAset == true){
			redirect('/aset/admin');
		}else{
			//cari source pemberitahuan kl username/password salah
			$this->load->view('vlogin');
			}
	}
}