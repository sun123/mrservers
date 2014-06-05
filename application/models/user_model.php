<?php
class USER_MODEL extends CI_Model {
	
	public function save_user($tbl,$data)
	{
		$this->db->insert($tbl,$data);
		return $this->db->insert_id();
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
	
	public function update($tbl,$data,$field,$value)
	{
		$this->db->where($field,$value);
		return $this->db->update($tbl,$data);
	}
   //  pull all countries
	public function pull_all_countries() {
		$sql = " SELECT * FROM tbl_countries ORDER BY  	country_name  ASC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
   
   //  check for duplicate email
	public function chk_duplicate_email($user_mail,$user_id) {
		$this->db->select('*');
		$this->db->where(array('email' => $user_mail, "id != " => $user_id));
		$query = $this->db->get('tbl_users');
		//	echo $this->db->last_query();
		return $tot_rows = $query->num_rows();
	}
	
	//  check for duplicate users
	public function chk_duplicate_user($username,$user_id) {
		$this->db->select('*');
		$this->db->where(array('username' => $username, "user_id != " => $user_id));
		$query = $this->db->get('tbl_users');
		return $tot_rows = $query->num_rows();
	}
	
	//  login	
	public function login_user($email='', $password='') {
		$this->db->select('*');
		$query = $this->db->get_where('tbl_users', array('useremail' => $email,'password' => $password, 'status' => '1' ));
	//	echo $this->db->last_query();
		$tot_rows = $query->num_rows();
		if($tot_rows > 0) {
			$result = $query->row_array();
			$newdata = array(
									'email'  => $result['useremail'],
									'user_id'	=> $result['user_id'],
									'fname'	=> $result['first_name'],
									'username'	=> $result['username'],
									'logged_in' => TRUE
			                     );
			$this->session->set_userdata($newdata);
			//debug($newdata);die;
			
			return true;
		}else{
			return '0';
		}
		
	}
	
	//  register+login	
	public function login_user_after_register($last_user_id=0) {
		$this->db->select('*');
		$query = $this->db->get_where('tbl_users', array('user_id' => $last_user_id));
	//	echo $this->db->last_query();
		$tot_rows = $query->num_rows();
		
		if($tot_rows > 0) {
			$result = $query->row_array();
			$newdata = array(
									'email'  => $result['useremail'],
									'user_id'	=> $result['user_id'],
									'fname'	=> $result['username'],
									'logged_in' => TRUE
			                     );
			$this->session->set_userdata($newdata);
			return true;
		}else{
			return '0';
		}
	}
	

	public function does_email_exists($email, $user_id){
		$result = $this->db->get_where( "tbl_users", array("email" => $this->db->escape_str($email), "id != " => $user_id)	);
		//echo $this->db->last_query();
		return ( $result->num_rows() > 0 );
	}
	
	public function get_user_info($user_id){
		$sql = " SELECT * FROM tbl_users WHERE id = '$user_id' ";
		$query = $this->db->query($sql);
		return $query->row_array();
	}
	
	public function update_user_info($user_id,$data){
		$this->db->where("user_id", $user_id);
		$this->db->update("tbl_users", $data);
	}
	
	public function admininfo(){
		$sql = " SELECT * FROM tbl_site_setting WHERE setting_id = '1' ";
		$query = $this->db->query($sql);
		return $query->row_array();
	}
	
	public function get_userinfo($email){
		$sql = " SELECT * FROM tbl_users WHERE email = '$email' ";
		$query = $this->db->query($sql);
		return $query->row_array();
	}
	
	 public function chk_username($username = ""){
	 
		$query = $this->db->get_where('tbl_users', array('username' => $username));
		$affected_rows = $query->num_rows();
		return $affected_rows;
	 
	 }
	 
	public function get_userId_by_username($username=""){
	
		$query = $this->db->get_where('tbl_users', array('username' => $username));
		$result = $query->row_array();
		$user_id = $result['user_id'];    
		return $user_id;
	}

	
	 public function check_email_fpassword($email = ""){
	 
		$query = $this->db->get_where('tbl_users', array('useremail' => $email));
	//	echo $this->db->last_query();
		$affected_rows = $query->num_rows();
		return $affected_rows;
	 
	 }
	 
	 /** 
	* function used for updating user password
	* @access public
	*  @param string
	* @return bool 
	*/

	public function change_password($email = "", $new_password = "") {
	
		$sql =	"	UPDATE tbl_users SET `password` = '" . md5($new_password) . "' 

					WHERE `useremail` = '$email'";	

		$result = $this->db->query( $sql );

		return ( $this->db->_error_number() === 0 );

	}
	
		public function check_users_password($password=""){
	
		$this->db->select('*');
		$this->db->where('password',$password);
		$query = $this->db->get('tbl_users');
		if($query->num_rows()>0){
			return true;
		}else{
			return '0';
		}
		
	}
		public function get_states($id ){

		$sql = "SELECT * FROM tbl_states WHERE country_id = '$id'";
	
		$query = $this->db->query($sql);

		return $query->result();

	}

	 public function chngpass($user_id,$oldpass)
	{
				$qry="select * from tbl_users where id='$user_id' and password =md5('".$this->db->escape_str($oldpass)."') ";
				$res=$this->db->query($qry);
				return $res->row();				
	}		
			
	public function chng_pass($user_id,$newpass)
	{
		$qry="update tbl_users set password=md5('".$this->db->escape_str($newpass)."')  where id='$user_id' ";
		$res=$this->db->query($qry);
		return $res;
	}

}
