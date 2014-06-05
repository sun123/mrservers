<?php
class common_model extends CI_Model {
	public function save_contact($contact_array=array()){
		$this->db->insert('tbl_contact',$contact_array);
		return $this->db->insert_id();
	}
	public function get_admin_info(){
		return $this->db->get_where('tbl_admin')->row_array();
	}
}



