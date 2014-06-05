<?php
class welcome_model extends CI_Model {
	public function get_content($cond="")
	{		
		$this->db->select('*');
		$this->db->where($cond);
		$res	=	$this->db->get('tbl_site_content');
		return $res->row();
	}
	public function get_data()
	{
		$sql= "select * from tbl_news";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
}



