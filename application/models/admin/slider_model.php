<?php class slider_model extends CI_Model {
	public function get_data($tbl,$limit=0,$limit_start=0){
		if(!empty($field)){
			$this->db->where($field,$value);
		}
		if(!empty($limit)){
			$this->db->limit($limit, $limit_start);
		}
		return $this->db->get($tbl)->result_array();
	}	
	public function update($tbl,$data,$field,$value){
		$this->db->where($field,$value);
		return $this->db->update($tbl,$data);
	}	
	public function get_rows($tbl,$field=0,$value=0)	{
		if(!empty($field)){
			$this->db->where($field,$value);
		}
		return $this->db->get($tbl)->num_rows();
	}	
	public function get_data_by_id($tbl,$field=0,$value=0){
		if(!empty($field)){
			$this->db->where($field,$value);
		}
		return $this->db->get($tbl)->row_array();
	}	
	public function delete($tbl,$field=0,$value=0)	{
		$this->db->where($field,$value);
		return $this->db->delete($tbl);
	}	
	public function save($tbl,$data)	{
		$this->db->insert($tbl,$data);
		return $this->db->insert_id();
	}
}



