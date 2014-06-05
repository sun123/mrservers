<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class admin extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('admin/admin_model');
		$this->load->helper("url");
		$this->load->library("pagination");
	}
	public function login() {
		$language = $this->lang->lang();
		$username = $this->input->post("username");
		$password = $this->input->post("password");
		$this->load->model("admin/admin_Model");
		$this->load->library("session");
		$admin_info = $this->admin_Model->login($username, $password);
		if ( !empty($admin_info) ) {
			$this->session->set_userdata("admin_id", $admin_info->admin_id);
			$this->session->set_userdata("admin_username", $admin_info->username);
			$this->load->view('admin/home');
		}
		else {
			redirect( base_url().$language . "/admin/login" );
		}
	}
	public function check_user()	{
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
		$this->load->model('admin/admin_model');
		$data=$this->admin_model->check_user($username,$password);
		$admin_data=array(
			'id'=>$data['admin_id'],	
			'name'=>$data['username'],	
		);
		 if($data) {
			$this->session->set_userdata($admin_data);
			echo 1;	 
		}else{
			echo 0 ;
		}
	}
	public function logout(){
		$this->session->unset_userdata();
		redirect(base_url()."admin/welcome");
	}
	public function change_pass(){
		if ( !$this->session->userdata("id") ) {
			redirect(base_url()."admin");
			exit;
		}
		$params['title']	=	'Change Password';
		$this->load->view('admin/includes/header',$params);
		$this->load->view('admin/login/change_password');
		$this->load->view('admin/includes/footer');
	}
	public function changepass(){
		if ( !$this->session->userdata("id") ) {
			redirect(base_url()."admin");
			exit;
		}
		$old_password=$this->input->post('old_password');
		$new_password=$this->input->post('new_password');
		$admin_name=$this->session->userdata('name');
		$admin_info=$this->admin_model->chngpass($admin_name,$old_password);
		if(empty($admin_info)){
			$this->session->set_userdata("success_message", "Old Password Does't Match"); 
			redirect( base_url() . "admin/admin/change_pass" );
		}else{	 
			$result=$this->admin_model->chng_pass($admin_name,$new_password);
		 	if ($result) {
				$this->session->set_userdata("success_message", "Password Change Successully"); 
			}else {
				$this->session->set_userdata("success_message", "Password Can't Change "); 
			}		
			redirect( base_url() . "admin/admin/change_pass" );
		}
	}
	public function settings(){
		if ( !$this->session->userdata("id") ) {
			redirect(base_url()."admin");
			exit;
		}
		$params['site_settings'] =$this->admin_model->get_settings();
		$params['title']	=	'Settings';
		$this->load->view('admin/includes/header',$params);
		$this->load->view('admin/login/admin_settings');
		$this->load->view('admin/includes/footer');
	}
	public function save_settings(){
		if ( !$this->session->userdata("id") ) {
			redirect(base_url()."admin");
			exit;
		}
		foreach ( $this->input->post() as $field_name => $setting_value) {
			$temp = explode("_", $field_name);
			if ( $temp[0] == "setting") {
				$setting_id = $temp[1];
				$status = $this->admin_model->save_settings($setting_id, $setting_value);
			}
		}
		if($status==1){
				$this->session->set_flashdata("suc_message","Admin settings updated successfully.");
		}else{
		$this->session->set_flashdata("suc_message","Error occur.");
		}
		redirect(base_url().'admin/admin/settings');
	}
}
