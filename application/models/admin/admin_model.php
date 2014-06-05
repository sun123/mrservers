<?php class Admin_Model extends CI_Model {
	public function check_user($username,$password) {
		$sql = $this->db->query("SELECT * FROM tbl_admin WHERE username='$username' and password='$password'");
		return $sql->row_array();
	}
	public function check_admin_password($password)	{	
		$sql = $this->db->query("SELECT * FROM tbl_admin WHERE password='$password'");
		$tot_rows = $sql->num_rows();
		if($tot_rows>0)
		{
			return true;
		}
		else
		{
			return '0';
		}
	}
	public function chngpass($admin_name,$oldpass)
	{
				$qry="select * from tbl_admin where username='".$this->db->escape_str($admin_name)."' and password =md5('".$this->db->escape_str($oldpass)."') ";
				$res=$this->db->query($qry);
				return $res->row();				
	}			
	public function chng_pass($admin_name,$newpass)
	{
		$qry="update tbl_admin set password=md5('".$this->db->escape_str($newpass)."')  where username='".$this->db->escape_str($admin_name)."'   ";
		$res=$this->db->query($qry);
		return $res;
	}
		
	public function get_settings()
	{
			$this->db->select('*');	
			$result = $this->db->get('tbl_site_setting');		
			return $result->result();			
	}
	public function save_settings($setting_id, $setting_value)
	{
		$sql = " UPDATE tbl_site_setting 
				 SET setting_value = '".$this->db->escape_str($setting_value)."'
				 WHERE setting_id = '$setting_id' ";
		$result = $this->db->query($sql);
		return (boolean) $result;
	}
	public function num_of_records($table) 
	{	
		$sql = " SELECT * FROM $table";
		$result = $this->db->query($sql);
		return $result->result();
	}
	public function manage($limit,$start,$table,$field) 
	{	
		$sql = "select * from $table ORDER BY $field DESC LIMIT $start, $limit";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;	
	}
	public function save($data,$table)
	{
		$this->db->insert($table,$data);
		return $this->db->insert_id();
	}
	public function edit($field,$tbl_name,$id)		
	{
		$sql = " SELECT * FROM $tbl_name where $field= '$id' ";
		$result = $this->db->query($sql);
		return $result->row_array();
	}
	public function update($field,$tbl_name,$id,$data)
	{	
	$qry = $this->db->where($field,$id);
	$qry = $this->db->update($tbl_name,$data);
	return (boolean) $qry;
	}
	public function delete_record($field,$tbl_name,$id)
	{
	$qry = $this->db->query("delete from $tbl_name where $field='$id'");
	return true;
	}
	public function get_style()		
	{
		$sql = "SELECT * FROM tbl_style";
		$result = $this->db->query($sql);
		return $result->result_array();
	}
	public function get_size()		
	{
		$sql = " SELECT * FROM tbl_size";
		$result = $this->db->query($sql);
		return $result->result_array();
	}
	public function get_color()		
	{
		$sql = " SELECT * FROM tbl_color";
		$result = $this->db->query($sql);
		return $result->result_array();
	}
	public function get_product_style_by_id($p_id)		
	{
		$sql = "SELECT * FROM tbl_product_style where p_id='$p_id' ";
		$result = $this->db->query($sql);
		return $result->result_array();
	}
	public function get_product_size_by_id($p_id)		
	{
		$sql = "SELECT * FROM tbl_product_size where p_id='$p_id' ";
		$result = $this->db->query($sql);
		return $result->result_array();
	}
	public function get_product_color_by_id($p_id)		
	{
		$sql = "SELECT * FROM tbl_product_color where p_id='$p_id' ";
		$result = $this->db->query($sql);
		return $result->result_array();
	}
}
