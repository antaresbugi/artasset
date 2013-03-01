<?php 

class Ujicoba extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('encrypt');
	}
	
	public function tampilan(){
		
	}
	
	public function vendor(){
		//echo 'ini halaman admin';
		
		//load view
		$web['script'] = 'default/script';
		$web['header'] = 'default/header';
		$web['secondbar'] = 'default/secondbar';
		$web['sidebar'] = '/aset/menu/admin_sidebar';
		$web['body'] = '/aset/content/addVendor';
				
		$this->load->view('default/view_base',$web);
		//use default/view_popup to create popup page
	}
}