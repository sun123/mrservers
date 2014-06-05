<?php
class User_Model extends CI_Model {
	
	
	
	   //  check for duplicate email
	public function chk_duplicate_email($user_mail,$user_id) {
		$this->db->select('*');
		$this->db->where(array('user_email' => $user_mail, "user_id != " => $user_id));
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
	
	public function save_user_info( $data ) {

		$this->db->insert('tbl_users',$data);
		return true;
	}
	
	public function update_user_info( $user_id,$data ) {
		
		$this->db->where('id',$user_id);
		$this->db->update('tbl_users',$data);
	//	echo $this->db->last_query();die;
		return true;
	}


	public function get_all_users($limit, $start) {
	
        $query = $this->db->query("Select * from tbl_users LIMIT $start, $limit");
		
		//echo $this->db->last_query();die;
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
   
   public function num_users() {
		
		$sql = " SELECT * FROM tbl_users";
		$result = $this->db->query($sql);
		return $result->result();

	}
	
	public function get_user_info($u_id)
	{
		$sql = " SELECT * FROM tbl_users WHERE id = '$u_id' ";
		$query = $this->db->query($sql);
		return $query->row_array();
	}
 //  pull all countries
	public function pull_all_countries() {
		$sql = " SELECT * FROM tbl_countries ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function delete_users($user_id = 0) {

		$sql = "DELETE FROM tbl_users WHERE id='$user_id'";

		$result = $this->db->query($sql);

		return (boolean) $result;

	}

	public function change_user_status($user_id = 0) {

		$sql = " UPDATE tbl_users 
				 SET `user_status` = IF ( `user_status` = 1, 0, 1 ) 
				 WHERE user_id = '$user_id' ";

		$result = $this->db->query($sql);

		return (boolean) $result;

	}
	
public function get_states($id ){

		$sql = "SELECT * FROM tbl_states WHERE country_id = '$id'";
	
		$query = $this->db->query($sql);

		return $query->result();

	}

	
	


}
