<?php

class Mlogin extends CI_Model{
	
	 function __construct(){
        parent::__construct();
    }
	
	public function checkdb($user, $pass){
		$this->db->where('nomorKaryawan', $user);
		$this->db->where('password', $pass);
		$this->db->join('sess','user.sessionid=sess.sessionid');
		$que = $this->db->get('user');
		if($que->num_rows == 1)
		{
			return $que->result();
		}		
		
	}
}

?>