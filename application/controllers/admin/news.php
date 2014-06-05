<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class News extends CI_Controller {
	
			public function __construct() {
					parent::__construct();

						if ( !$this->session->userdata("id") ) {
							redirect(base_url()."admin");
							exit;
						}
					$this->load->model("admin/News_Model");

			}
			
		
			
			
			public function index(){
					if ( !$this->session->userdata("id") ) {
							redirect(base_url()."admin");
							exit;
						}
					 
					 $params['all_news'] = $this->News_Model->get_news();
					 
					$params['title']	=	'News';
					$this->load->view('admin/includes/header',$params);
					$this->load->view('admin/news/manage_news');
					$this->load->view('admin/includes/footer');
			
			}
			
			public function add_news()
			{
			if ( !$this->session->userdata("id") ) {
							redirect(base_url()."admin");
							exit;
						}
				$this->load->library('ckeditor');
				$this->load->library('ckfinder');

				$this->ckfinder->SetupCKEditor($this->ckeditor, '../../../ckfinder');
				
				//configure base path of ckeditor folder 
				$this->ckeditor->basePath = base_url().'ckeditor/';
				$this->ckeditor->config['toolbar'] = 'Full';
				$this->ckeditor->config['language'] = 'en';
				
			
			$params['title']	=	'Add News';
			$this->load->view('admin/includes/header',$params);
			$this->load->view('admin/news/add_news');
			$this->load->view('admin/includes/footer');
			
				
			}
			
			public function save_news()
			{
				if ( !$this->session->userdata("id") ) {
							redirect(base_url()."admin");
							exit;
						}
				
					$language = get_cookie('language');
					$news_title = $this->input->post("news_title");
					$news_content = strip_tags($this->input->post("news_content"));
					$page_id = $this->input->post("page_id");
					
					$news_data = array(
										
											"news_title"=>$news_title,
											"news_content"=>$news_content,
											"news_status"=>1
					
										);
					
					$status = $this->News_Model->save_news($news_data);
					
					if ( $status==1) {
						$this->session->set_flashdata("suc_message","News Added successfully.");
					}
					else {
						$this->session->set_flashdata("suc_message","Error Occur.");
					}
					redirect(base_url().$language."/admin/news/manage_news");
				
			}
			
			
			public function edit_news()
			{
			if ( !$this->session->userdata("id") ) {
							redirect(base_url()."admin");
							exit;
						}
			
				$this->load->library('ckeditor');
				$this->load->library('ckfinder');

				$this->ckfinder->SetupCKEditor($this->ckeditor, '../../../ckfinder');
				
				//configure base path of ckeditor folder 
				$this->ckeditor->basePath = base_url().'ckeditor/';
				$this->ckeditor->config['toolbar'] = 'Full';
				$this->ckeditor->config['language'] = 'en';
				
				$news_id=$this->uri->segment(5);
				
				$params['news_detail'] = $this->News_Model->edit_news($news_id);
			
			
			$params['title']	=	'Edit News';
			$this->load->view('admin/includes/header',$params);
			$this->load->view('admin/news/edit_news');
			$this->load->view('admin/includes/footer');
				
			}
			
			
			public function update_news()
			{
			if ( !$this->session->userdata("id") ) {
							redirect(base_url()."admin");
							exit;
						}
				 	$language = get_cookie('language');
					$news_title = $this->input->post("news_title");
					$news_content = $this->input->post("news_content");
					$news_id = $this->input->post("news_id");
					
					$news_data = array(
									
											"news_title"=>$news_title,
											"news_content"=>$news_content
					
										);
					
					

					$status = $this->News_Model->update_news($news_id,$news_data);
					
					if ( $status==1) {
						$this->session->set_flashdata("suc_message","News Update successfully.");
					}
					else {
						$this->session->set_flashdata("suc_message","Error In Update Data.");
					}
					redirect(base_url().$language."/admin/news");
				
			}
			
			public function delete_news()
			{
			if ( !$this->session->userdata("id") ) {
							redirect(base_url()."admin");
							exit;
						}
				
			$news_id	= $this->uri->segment(5);
			$language = get_cookie('language');
			$news = $this->News_Model->delete_news($news_id);		
			
				if($news==1){
						$this->session->set_flashdata("suc_message","News deleted successfully.");
				}
				else{
						$this->session->set_flashdata("suc_message","Error Occured.");						
				}
				redirect(base_url().$language."/admin/news");
			}
			
}
