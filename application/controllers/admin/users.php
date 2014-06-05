<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct() {
		parent::__construct();

		if ( !$this->session->userdata("id") ) {
			redirect(base_url()."admin");
			exit;
		}
		$this->load->model("admin/User_Model");
		$this->load->helper("url");
        $this->load->library("pagination");
		

	}

	public function index() {

		$this->manage_users();

	}

	public function manage_users() {
	
		if ( !$this->session->userdata("id") ) {
			redirect(base_url()."admin");
			exit;
		}

		$params["top_link_active"] = "MANAGE_USERS";

		$params["nums"] = $this->User_Model->num_users();
		$num_rows = count($params["nums"]);
		//debug($num_rows);die;
		$config = array();
        $config["base_url"] = base_url() . "admin/users/manage_users";
        $config["total_rows"] = $num_rows;
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
 
        $this->pagination->initialize($config);
 
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		//debug($page);die;
		$params["users"] = $this->User_Model->get_all_users($config["per_page"], $page);
        $params["links"] = $this->pagination->create_links();

		$params["page_title"] = "Manage Users";
		$this->load->view('admin/includes/header',$params);
		$this->load->view("admin/user/manage_users");
		$this->load->view('admin/includes/footer');

	}

	public function edit_users()
	{
		if ( !$this->session->userdata("id") ) {
			redirect(base_url()."admin");
			exit;
		}

		if($this->uri->segment(5)){
			$u_id = $this->uri->segment(5);
			$data['title'] = "Edit User";
			$data['user_info'] = $this->User_Model->get_user_info($u_id);
		}else{
			$data['title'] = "Add User";
		}

		
		$data['top_link_active'] = "MY_PROFILE";
		
	
		$data['country'] = $this->User_Model->pull_all_countries();
		
		$this->load->view('admin/includes/header',$data);
		$this->load->view("admin/user/edit_users");
		$this->load->view('admin/includes/footer');

	}
	
	/**
	 * Users check duplicate email with ajax.
	 *
	 */

    
	public function edit_save_users() {
	
			if ( !$this->session->userdata("id") ) {
							redirect(base_url()."admin");
							exit;
						}

		$params["top_link_active"] = "MANAGE_USERS";
	
	$language = get_cookie('language');
				
		if($this->input->post('user_id')){
		
				$user_id = $this->input->post('user_id');
				
				$u_array = array(
				
									"f_name " 					=> $this->input->post('first_name'),
									"l_name" 					=> $this->input->post('last_name'),
									"business_name" 	=> $this->input->post('busnesname'),
									"email" 						=> $this->input->post('useremail'),
									//"password" 				=> md5($this->input->post('password')),
									"country" 					=> $this->input->post('country'),
									"state" 						=> $this->input->post('state'),
									"city" 							=> $this->input->post('city'),
									"address" 					=> $this->input->post('address'),
									"zip_code" 				=> $this->input->post('zip'),
									"phone" 						=> $this->input->post('phn'),
									"vat_id" 						=> $this->input->post('vat_id'),
									//"status" 						=> '1'
																											
								);
				
				$update_user = $this->User_Model->update_user_info($user_id,$u_array);	
				if ( $update_user ) {
					$this->session->set_userdata("success_message", "User has been Updated successfully!");
				}
				else {
					$this->session->set_userdata("success_message", "Error in updating users");
				}

				redirect( base_url().$language . "/admin/users" );

		}else{
		
			$u_array = array(
				
									"f_name " 					=> $this->input->post('first_name'),
									"l_name" 					=> $this->input->post('last_name'),
									"business_name" 	=> $this->input->post('busnesname'),
									"email" 						=> $this->input->post('useremail'),
									"password" 				=> md5($this->input->post('password')),
									"country" 					=> $this->input->post('country'),
									"state" 						=> $this->input->post('state'),
									"city" 							=> $this->input->post('city'),
									"address" 					=> $this->input->post('address'),
									"zip_code" 				=> $this->input->post('zip'),
									"phone" 						=> $this->input->post('phn'),
									"vat_id" 						=> $this->input->post('vat_id'),
									"status" 						=> '1'
														
									
								);
				//debug($u_array);die;
				$inserted_user = $this->User_Model->save_user_info($u_array);	
				
				if ( $inserted_user ) {
					$this->session->set_userdata("success_message", "User  has been saved!");
				}
				else {
					$this->session->set_userdata("success_message", "Error saving  users");
				}

				redirect( base_url().$language . "/admin/users" );
		
		}

	}
	public function delete_users() {
	
		if ( !$this->session->userdata("id") ) {
			redirect(base_url()."admin");
			exit;
		}
		$language = get_cookie('language');
		$u_id = $this->uri->segment(5);

		$status = (int) $this->User_Model->delete_users($u_id);

		if ( $status ) {
			$this->session->set_userdata("success_message", "User has been deleted!");
		}
		else {
			$this->session->set_userdata("success_message", "Error deleting User");
		}

		redirect( base_url() .$language. "/admin/users" );

	}
	
	


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
