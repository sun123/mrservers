<?php
class customer_model extends CI_Model {
	
	public function get_data($tbl,$field=0,$value=0,$order=0)
	{
		if(!empty($field))
		{
			$this->db->where($field,$value);
		}
		$this->db->order_by($order, "asc"); 
		return $this->db->get($tbl)->result_array();
	}
	
	public function update($tbl,$data,$field,$value)
	{
		$this->db->where($field,$value);
		return $this->db->update($tbl,$data);
	}
	
	public function get_rows($tbl,$field1=0,$value1=0,$field2=0,$value2=0)
	{
		if(!empty($field1))
		{
			$this->db->where($field1,$value1);
		}
		if(!empty($field2))
		{
			$this->db->where($field2,$value2);
		}
		return $this->db->get($tbl)->num_rows();
	}
	
	public function save($tbl,$data)
	{
		$this->db->insert($tbl,$data);
		return $this->db->insert_id();
	}
	
	public function get_data_by_id($tbl,$field=0,$value=0,$field1=0,$value1=0)
	{
		if(!empty($field))
		{
			$this->db->where($field,$value);
		}
		if(!empty($field1))
		{
			$this->db->where($field1,$value1);
		}
		return $this->db->get($tbl)->row_array();
	}
	
	public function get_customer_info($u_id){
		return $this->db->get_where('tbl_users',array('u_id'=>$u_id))->row_array();
	}
	
	public function does_email_exists($email, $u_id) {	
		$result = $this->db->get_where( "tbl_users", array(
													"email" => $this->db->escape_str($email), 
													"u_id != " => $u_id
												)
					);
		return ( $result->num_rows() > 0 );
	}
	public function update_user($email, $update_data)	{
			$this->db->where('email', $email);
			$this->db->update('tbl_users', $update_data); 
	}
	public function login($email, $password) {	
		$result = $this->db->get_where( "tbl_users", array(
													"email" => $this->db->escape_str($email), 
													"password" => md5($password)
												)
					);
		return $result->row_array();
	}
	
}



