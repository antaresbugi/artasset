<?php
class Muser extends CI_Model{

	function __construct() {
		parent::__construct();
		//$this->CI =& get_instance();
	}
	
	//baca tabel semua
	
	function get_user(){
		$this->db->select('*');
		$this->db->join('sess','user.sessionid=sess.sessionid');
		
		$hasil=$this->db->get('user')->result();
		return $hasil;	
		
		//SELECT nomorKaryawan, fullname, phone, email, sessionname, status FROM user join sess on user.sessionid=sess.sessionid
	}
	
	function get_vendor(){
		$this->db->select('*');		
		$hasil=$this->db->get('vendor')->result();
		return $hasil;	
	}
	
	function get_permis(){
		$this->db->select('*');		
		$hasil=$this->db->get('permission')->result();
		return $hasil;	
	}
	
	function get_sess(){
		$this->db->select('*');		
		$hasil=$this->db->get('sess')->result();
		return $hasil;	
	}
	
	function get_itper(){
		$this->db->select('*');		
		$hasil=$this->db->get('itemperbaik')->result();
		return $hasil;	
	}
	
	function get_perbaik(){
		$this->db->select('*');		
		$this->db->join('itemperbaik','perbaikaset.itemPerbaikID=itemperbaik.itemPerbaikID');
		$hasil=$this->db->get('perbaikaset')->result();
		return $hasil;	
	}
	
	function get_dispose(){
		$this->db->select('*');		
		$hasil=$this->db->get('disposal')->result();
		return $hasil;	
	}
	
	function get_dep(){
		$this->db->select('*');		
		$hasil=$this->db->get('depasset')->result();
		return $hasil;	
	}
	
	function get_klas(){
		$this->db->select('*');	
		$this->db->join('user','klasaset.employee=user.nomorKaryawan','left');	
		$hasil=$this->db->get('klasaset')->result();
		return $hasil;	
	}
	
	function get_loc(){
		$this->db->select('*');	
		$this->db->join('user','lokasidept.employee=user.nomorKaryawan','left');	
		$hasil=$this->db->get('lokasidept')->result();
		return $hasil;	
	}
	
	function get_purreq(){
		$this->db->select('*, purreq.keterangan as keteranganPR');	
		$this->db->join('klasaset','klasaset.klasID=purreq.klasID');
		$this->db->join('vendor','vendor.vendorID=purreq.vendorID');
		$this->db->where('status', 0);	
		$this->db->or_where('status', 2);	
		$this->db->order_by('idPR','desc');
		$hasil=$this->db->get('purreq')->result();
		return $hasil;	
	}
	
	function get_asetdata(){
		$this->db->select('*');
		$this->db->join('user','itemaset.nomorKaryawan=user.nomorKaryawan','left');
		$this->db->join('lokasidept','itemaset.idDept=lokasidept.idDept','left');
		$this->db->join('vendor','itemaset.vendorID=vendor.vendorID');
		$this->db->join('klasaset','itemaset.klasID=klasaset.klasID','left');
		$this->db->join('depasset','itemaset.idDepresiasi=depasset.idDepresiasi','left');
		$this->db->order_by('idAset','asc');
		$hasil=$this->db->get('itemaset')->result();
		return $hasil;
	}
	
	function get_role(){
		$query = $this->db->query("SELECT sess.sessionid, sess.sessionname, permission.idPermisi, permission.namaPermisi, sessper.stat FROM sessper
					join sess on sess.sessionid=sessper.sess
					join permission on permission.idPermisi=sessper.permission
					order by permission.idPermisi");
		$dat = array();
		foreach($query->result_array() as $result)
		{
			$dat[$result['sessionname']][] = array(
				'stat'=>$result['stat'],
				'didid'=>$result['sessionid']
			);
		}
		return ($dat);
	}
	
	function get_namerole($id){
		$this->db->select('*');		
		$hasil=$this->db->get_where('sess',array('sessionid'=>$id))->result();
		return $hasil;
	}
	
	function get_roleuser($id){
		$query = $this->db->query("SELECT sess.sessionid, sess.sessionname, permission.idPermisi, permission.namaPermisi, sessper.stat FROM sessper
					join sess on sess.sessionid=sessper.sess
					join permission on permission.idPermisi=sessper.permission
					where sessper.sess=".$id."
					order by permission.idPermisi");
		$dat = array();
		foreach($query->result_array() as $result)
		{
			$dat[$result['sessionname']][] = array(
				'namaPermisi'=>$result['namaPermisi'],
				'idPermisi'=>$result['idPermisi'],
				'stat'=>$result['stat']
			);
		}
		return ($dat);
		
		/*$this->db->join('sess','sessper.sess=sess.sessionid');
		$this->db->join('permission','sessper.permission=permission.idPermisi');
		$this->db->order_by('idPermisi','asc');
		$hasil=$this->db->get_where('sessper',array('sess'=>$id))->result();
		return ($hasil);	*/
	}
	
	//baca 1 record aja
	
	function get1_user($id){
		$hasil=$this->db->get_where('user',array('nomorKaryawan'=>$id))->result();
		return ($hasil);	
	}
	
	function pic_user($id,$data){
		$this->db->update('user', $data, array('nomorKaryawan'=>$id));
	}
	
	function get1_asset($id){
		$this->db->join('user','itemaset.nomorKaryawan=user.nomorKaryawan','left');
		$this->db->join('lokasidept','itemaset.idDept=lokasidept.idDept','left');
		$this->db->join('vendor','itemaset.vendorID=vendor.vendorID');
		$this->db->join('klasaset','itemaset.klasID=klasaset.klasID','left');
		$this->db->join('depasset','itemaset.idDepresiasi=depasset.idDepresiasi','left');
		$this->db->order_by('idAset','asc');
		$hasil=$this->db->get_where('itemaset',array('idAset'=>$id))->result();
		return ($hasil);	
	}
	
	function get1_log($id){
		$this->db->order_by('waktu_update','desc');
		$hasil=$this->db->get_where('logaset',array('idAsetLog'=>$id))->result();
		return ($hasil);	
	}
	
	function get1_itempe($id){
		$hasil=$this->db->get_where('itemperbaik',array('itemPerbaikID'=>$id))->row();
		return ($hasil);	
	}
	
	function get1_perlog($id){
		$hasil=$this->db->get_where('perbaikaset',array('perbaikID'=>$id))->row();
		return ($hasil);	
	}
	
	function get1_purreq($id){
		$this->db->select('*, purreq.keterangan as keteranganPR');	
		$this->db->join('klasaset','klasaset.klasID=purreq.klasID');
		$this->db->join('vendor','vendor.vendorID=purreq.vendorID');
		$hasil=$this->db->get_where('purreq',array('idPR'=>$id))->result();
		return ($hasil);	
	}
	
	function get1_loc($id){
		$hasil=$this->db->get_where('lokasidept',array('idDept'=>$id));
		return $hasil->row();	
	}
	
	//menghitung  broh
	function get_count_unread(){
		$this->db->like('unread', 1);
		$this->db->like('status', 0);
		$this->db->from('purreq');
		$hasil = $this->db->count_all_results();
		return $hasil;
	}
	
	function get_count_pas($id){
		$this->db->like('idAset', $id);
		$this->db->from('perbaikaset');
		$this->db->where('status','0');
		$hasil = $this->db->count_all_results();
		return $hasil;
	}
	
	function get_count_status($jenis){
		$this->db->like('statusAset', $jenis);
		$this->db->from('itemaset');
		$hasil = $this->db->count_all_results();
		return $hasil;
	}
	
	function get_count_total(){
		$this->db->from('itemaset');
		$hasil = $this->db->count_all_results();
		return $hasil;
	}
	
	//baca dengan kondisi
	function get_purreq_when(){
		$this->db->select('*');	
		$this->db->join('klasaset','klasaset.klasID=purreq.klasID');
		$this->db->join('vendor','vendor.vendorID=purreq.vendorID');	
		$this->db->like('unread', 1);
		$this->db->like('status', 0);
		$this->db->order_by('idPR','desc');
		$hasil=$this->db->get('purreq')->result();
		return $hasil;	
	}
	
	function get_whereperbaik($id){
		$this->db->select('*');		
		$this->db->join('itemperbaik','perbaikaset.itemPerbaikID=itemperbaik.itemPerbaikID');
		$this->db->like('idAset', $id);
		$hasil=$this->db->get('perbaikaset')->result();
		return $hasil;	
	}
	
	function get_whereasset($id){
		$this->db->select('*');
		$this->db->join('user','itemaset.nomorKaryawan=user.nomorKaryawan','left');
		$this->db->join('lokasidept','itemaset.idDept=lokasidept.idDept','left');
		$this->db->join('vendor','itemaset.vendorID=vendor.vendorID');
		$this->db->join('klasaset','itemaset.klasID=klasaset.klasID','left');
		$this->db->join('depasset','itemaset.idDepresiasi=depasset.idDepresiasi','left');
		$this->db->like('statusAset', $id);
		$hasil=$this->db->get('itemaset')->result();
		return $hasil;	
	}
	
	function get_condiasset($id){
		$this->db->select('*');
		$this->db->join('user','itemaset.nomorKaryawan=user.nomorKaryawan','left');
		$this->db->join('lokasidept','itemaset.idDept=lokasidept.idDept','left');
		$this->db->join('vendor','itemaset.vendorID=vendor.vendorID');
		$this->db->join('klasaset','itemaset.klasID=klasaset.klasID','left');
		$this->db->join('depasset','itemaset.idDepresiasi=depasset.idDepresiasi','left');
		$this->db->like('kondisiAset', $id);
		$hasil=$this->db->get('itemaset')->result();
		return $hasil;	
	}
	
	function get_tipeasset($id){
		$this->db->select('*');
		$this->db->join('user','itemaset.nomorKaryawan=user.nomorKaryawan','left');
		$this->db->join('lokasidept','itemaset.idDept=lokasidept.idDept','left');
		$this->db->join('vendor','itemaset.vendorID=vendor.vendorID');
		$this->db->join('klasaset','itemaset.klasID=klasaset.klasID','left');
		$this->db->join('depasset','itemaset.idDepresiasi=depasset.idDepresiasi','left');
		$this->db->like('itemaset.klasID', $id);
		$hasil=$this->db->get('itemaset')->result();
		return $hasil;	
	}
	
	function get_wheredispose($id){
		$this->db->select('*');		
		$this->db->like('idAset', $id);
		$hasil=$this->db->get('disposal')->result();
		return $hasil;	
	}
	
	function get_purreq_to_asset(){
		$this->db->select('*');	
		$this->db->join('klasaset','klasaset.klasID=purreq.klasID');
		$this->db->join('vendor','vendor.vendorID=purreq.vendorID');	
		$this->db->like('status', 1);
		$this->db->order_by('idPR','desc');
		$hasil=$this->db->get('purreq')->result();
		return $hasil;	
	}
	
	function get_purreq_appdec(){
		$this->db->select('*, purreq.keterangan as keteranganPR');	
		$this->db->join('klasaset','klasaset.klasID=purreq.klasID');
		$this->db->join('vendor','vendor.vendorID=purreq.vendorID');
		$this->db->where('status', 1);	
		$this->db->or_where('status',3);	
		$this->db->order_by('idPR','desc');
		$hasil=$this->db->get('purreq')->result();
		return $hasil;	
	}
	
	//input record
	
	function input_user($data){
		$this->db->insert('user', $data);
	}
	
	function input_vendor($data){
		$this->db->insert('vendor', $data);
	}
	
	function input_klas($data){
		$this->db->insert('klasaset', $data);
	}
	
	function input_loc($data){
		$this->db->insert('lokasidept', $data);
	}
	
	function input_pr($data){
		$this->db->insert('purreq', $data);
	}
	
	function input_asset($data){
		$this->db->insert('itemaset', $data);
	}
	
	function input_log($data){
		$this->db->insert('logaset', $data);
	}
	
	function input_ser($data){
		$this->db->insert('perbaikaset', $data);
	}
	
	function input_itser($data){
		$this->db->insert('itemperbaik', $data);
	}
	
	function input_disposal($data){
		$this->db->insert('disposal', $data);
	}
	
	function input_sess($data){
		$this->db->insert('sess', $data);
	}
	
	function input_sessper($data){
		$this->db->insert('sessper', $data);
	}
	
	//update record
	
	function update_user($id,$data){
		$this->db->update('user', $data, array('nomorKaryawan'=>$id));
	}
	
	function update_vendor($id,$data){
		$this->db->update('vendor', $data, array('vendorID'=>$id));
	}
	
	function update_klas($id,$data){
		$this->db->update('klasaset', $data, array('klasID'=>$id));
	}
	
	function update_loc($id,$data){
		$this->db->update('lokasidept', $data, array('idDept'=>$id));
	}
	
	function update_pr($id,$data){
		$this->db->update('purreq', $data, array('idPR'=>$id));
	}
	
	function update_as($id,$data){
		$this->db->update('itemaset', $data, array('idAset'=>$id));
	}
	
	function update_pas($id,$data){
		$this->db->update('perbaikaset', $data, array('perbaikID'=>$id));
	}
	
	function update_dis($id,$data){
		$this->db->update('disposal', $data, array('disposalID'=>$id));
	}
	
	function update_log_perbaik($id,$data){
		$this->db->update('logaset', $data, array('perbaikID'=>$id));
	}
	
	function update_sess($id,$data){
		$this->db->update('sess', $data, array('sessionid'=>$id));
	}
	
	function update_sessper($id1, $id2, $data){
		$this->db->update('sessper', $data, array('sess'=>$id1, 'permission'=>$id2));
	}
	
	//delete record
	
	function delete_user($id) {
		$this->db->where('nomorKaryawan', $id);
		$hasil=$this->db->delete('user');
		return $hasil;
	}
	
	function delete_vendor($id) {
		$this->db->where('vendorID', $id);
		$hasil=$this->db->delete('vendor');
		return $hasil;
	}
	
	function delete_klas($id) {
		$this->db->where('klasID', $id);
		$hasil=$this->db->delete('klasaset');
		return $hasil;
	}
	
	function delete_loc($id) {
		$this->db->where('idDept', $id);
		$hasil=$this->db->delete('lokasidept');
		return $hasil;
	}
	
	function delete_pr($id) {
		$this->db->where('idPR', $id);
		$hasil=$this->db->delete('purreq');
		return $hasil;
	}
	
	function delete_pas($id) {
		$this->db->where('perbaikID', $id);
		$hasil=$this->db->delete('perbaikaset');
		return $hasil;
	}
	
	function delete_dis($id) {
		$this->db->where('disposalID', $id);
		$hasil=$this->db->delete('disposal');
		return $hasil;
	}
	
	function delete_log($id) {
		$this->db->where('perbaikID', $id);
		$hasil=$this->db->delete('logaset');
		return $hasil;
	}
	
	//generate ID
	function user_id ($today) {
		$query = $this->db->query("select max(nomorKaryawan)as terakhir from user where nomorKaryawan like '%".$today."%'");
		return $query->row();
	}
	
	function vendor_id ($today) {
		$query = $this->db->query("select max(vendorID)as terakhir from vendor where vendorID like '%".$today."%'");
		return $query->row();
	}
	
	function asset_id ($today) {
		$query = $this->db->query("select max(idAset)as terakhir from itemaset where idAset like '%".$today."%'");
		return $query->row();
	}
	
	function itemper_id () {
		$query = $this->db->query("select max(itemPerbaikID)as terakhir from itemperbaik");
		return $query->row();
	}
	
	function sess_id () {
		$query = $this->db->query("select max(sessionid)as terakhir from sess");
		return $query->row();
	}
	
	function per_id() {
		$query = $this->db->query("select max(perbaikID)as terakhir from perbaikaset");
		return $query->row();
	}
	
	//itungan cost
	function asset_cost ($today) {
		$query = $this->db->query("select assetcost as terakhir from itemaset where idAset like '".$today."'");
		return $query->row();
	}
	
	//autocomplete
	function mquick_access($keyword){
		$this->db->select('*')->from('itemaset');
        $this->db->like('idAset',$keyword,'after');
        $query = $this->db->get();    
        
        return $query->result();
	}
}
?>