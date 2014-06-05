<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Page extends CI_Controller {	
	public function __construct() {
		parent::__construct();
			if ( !$this->session->userdata("id") ) {
				redirect(base_url()."admin");
				exit;
			}
		$this->load->model("admin/Page_Model");
	}
	public function index(){
		if ( !$this->session->userdata("id") ) {
			redirect(base_url()."admin");
			exit;
		}
		 $params['pages'] = $this->Page_Model->get_pages();
		$params['title']	=	'Static Pages';
		$this->load->view('admin/includes/header',$params);
		$this->load->view('admin/static/static_pages');
		$this->load->view('admin/includes/footer');
	}
	public function change_status()	{
		if ( !$this->session->userdata("id") ) {
			redirect(base_url()."admin");
			exit;
		}
		$table = $this->input->post('table');		
		$column = $this->input->post('column');
		$value = $this->input->post('value');
		$uniqueNameCol = $this->input->post('uniqueNameCol');
		$uniqueColValue = $this->input->post('uniqueColValue');	
		$re = $this->Page_Model->change_status($table, $column, $value, $uniqueNameCol, $uniqueColValue);		
	}
	public function delete_page(){
		if ( !$this->session->userdata("id") ) {
			redirect(base_url()."admin");
			exit;
		}
		$page_id	= $this->uri->segment(4);
		$page = $this->Page_Model->delete_page($page_id);		
		if($page==1){
				$this->session->set_flashdata("suc_message","Page deleted successfully.");
		}else{
			$this->session->set_flashdata("suc_message","error Occured.");						
		}
		redirect(base_url()."admin/page");
	}	
	public function edit()	{
		if ( !$this->session->userdata("id") ) {
			redirect(base_url()."admin");
			exit;
		}
		$this->load->library('ckeditor');
		$this->load->library('ckfinder');
		$this->ckfinder->SetupCKEditor($this->ckeditor, '../../../ckfinder');
		$this->ckeditor->basePath = base_url().'ckeditor/';
		$this->ckeditor->config['toolbar'] = 'Full';
		$this->ckeditor->config['language'] = 'en';
		$page_id=$this->uri->segment(4);
		$params['page_detail'] = $this->Page_Model->edit_page($page_id);
		$params['title']	=	'Edit Page';
		$this->load->view('admin/includes/header',$params);
		$this->load->view('admin/static/edit_page');
		$this->load->view('admin/includes/footer');
	}
	public function save_page(){
		if ( !$this->session->userdata("id") ) {
			redirect(base_url()."admin");
			exit;
		}
		$page_name = $this->input->post("page_name");
		$page_title = $this->input->post("page_title");
		$page_description = $this->input->post("page_description");
		$page_id = $this->input->post("page_id");
		$page_data = array(
			"page_name"=>$page_name,
			"page_title"=>$page_title,
			"page_body"=>$page_description
		);
		$status = $this->Page_Model->edit_save_page($page_id,$page_data);
		if ( $status==1) {
			$this->session->set_flashdata("suc_message","Page Update successfully.");
		}
		else {
			$this->session->set_flashdata("suc_message","Pagsdfsafsdfse delefcessfully.");
		}
		redirect(base_url()."admin/page");
	}
	public function add(){
		if ( !$this->session->userdata("id") ) {
			redirect(base_url()."admin");
			exit;
		}
		$this->load->library('ckeditor');
		$this->load->library('ckfinder');
		$this->ckfinder->SetupCKEditor($this->ckeditor, '../../../ckfinder');
		$this->ckeditor->basePath = base_url().'ckeditor/';
		$this->ckeditor->config['toolbar'] = 'Full';
		$this->ckeditor->config['language'] = 'en';
		$params['title']	=	'Add Page';
		$this->load->view('admin/includes/header',$params);
		$this->load->view('admin/static/add_page');
		$this->load->view('admin/includes/footer');
	}
	public function add_page(){
		if ( !$this->session->userdata("id") ) {
			redirect(base_url()."admin");
			exit;
		}
		$page_name = $this->input->post("page_name");
		$page_title = $this->input->post("page_title");
		$page_description = $this->input->post("page_description");
		$page_data = array(
			"page_name"=>$page_name,
			"page_title"=>$page_title,
			"page_description"=>$page_description,
			"page_status"=>1
		);
		$status = $this->Page_Model->add_page($page_data);
		if ( $status==1) {
			$this->session->set_flashdata("suc_message","Page Added successfully.");
		}else {
			$this->session->set_flashdata("suc_message","Error Occur.");
		}
		redirect(base_url()."admin/page");
	}
}
