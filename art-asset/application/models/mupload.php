<?php
class Mupload extends CI_Model{
	var $gallerypath;
	var $gallery_path_url;
	
	function  __construct(){
		parent::__construct();
		$this->gallerypath = realpath(APPPATH . '../treasure/img/');
		$this->gallery_path_url = base_url().'treasure/img/';
	}
	
	function do_upload() {
		$konfigurasi = array(
			'overwrite' => true,
		 	'file_name'=>$this->session->userdata('nomorKaryawan').'.jpg',
			'allowed_types' =>'jpg|jpeg|gif|png|bmp',
			'upload_path' => $this->gallerypath
		);
		$this->load->library('upload', $konfigurasi);
		$this->upload->do_upload();
	}
	
	function asset_upload($namafilenya) {
		$konfigurasi = array(
			'overwrite' => true,
		 	'file_name'=>$namafilenya,
			'allowed_types' =>'jpg|jpeg|gif|png|bmp',
			'upload_path' => $this->gallerypath
		);
		$this->load->library('upload', $konfigurasi);
		$this->upload->do_upload();
	}
}
?>