<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class invoice extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('admin/Invoice_Model');
		$this->load->helper("url");
		$this->load->library("pagination");
	}
	
	public function index() {

		$this->manage_invoice();

	}

	public function manage_invoice() {
	
		if ( !$this->session->userdata("id") ) {
			redirect(base_url()."admin");
			exit;
		}

		$params["top_link_active"] = "Manage Invoice";

		$params["nums"] = $this->Invoice_Model->num_invoice();
		$num_rows = count($params["nums"]);
		//debug($num_rows);die;
		$config = array();
        $config["base_url"] = base_url() . "admin/invoice/manage_invoice";
        $config["total_rows"] = $num_rows;
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
 
        $this->pagination->initialize($config);
 
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		//debug($page);die;
		$params["all_info"] = $this->Invoice_Model->get_all_invoice($config["per_page"], $page);
        $params["links"] = $this->pagination->create_links();

		$params["page_title"] = "Manage Invoice";
		$this->load->view('admin/includes/header',$params);
		$this->load->view("admin/invoice/manage_invoice");
		$this->load->view('admin/includes/footer');

	}
	
	public function edit_invoice()
	{
		if ( !$this->session->userdata("id") ) {
			redirect(base_url()."admin");
			exit;
		}

		if($this->uri->segment(5)){
			$id = $this->uri->segment(5);
			$data['title'] = "Edit Invoice";
			$data['info'] = $this->Invoice_Model->get_info($id);
		}else{
			$data['title'] = "Add Invoice";
		}

		$this->load->view('admin/includes/header',$data);
		$this->load->view("admin/invoice/edit_invoice");
		$this->load->view('admin/includes/footer');

	}
	
	public function edit_save_invoice() {
	
			if ( !$this->session->userdata("id") ) {
							redirect(base_url()."admin");
							exit;
						}

	$language = get_cookie('language');
	
	$img=$_FILES["in_pdf"];
		
		$img_name="";
		if($img['error']==UPLOAD_ERR_OK)
		{
			$img_name=clean_filename($img['name']);
			$img_name=time()."_".$img_name;
			
			

			}
				
		if($this->input->post('invoice_id')){
		
				$invoice_id = $this->input->post('invoice_id');
				
				if($img_name){
				$u_array = array(
				
									"pdf_title" 					=> $this->input->post('pdf_title'),
									"invoice_number " 					=> $this->input->post('in_number'),
									"invoice_amount" 					=> $this->input->post('in_amnt'),
									"invoice_pdf " 					=> $img_name
								
								);
								}

					else
					{
					$u_array = array(
				
									"pdf_title" 					=> $this->input->post('pdf_title'),
									"invoice_number " 					=> $this->input->post('in_number'),
									"invoice_amount" 					=> $this->input->post('in_amnt'),
									
								);
				
				}
				$update = $this->Invoice_Model->update_invoice_info($invoice_id,$u_array);	
				
				if( !file_exists('uploads') ) {
					mkdir("uploads" , DIR_WRITE_MODE);			
				}
				@chmod("uploads" , DIR_WRITE_MODE);

			if( !file_exists('uploads/pdf/') ) {
				mkdir("uploads/pdf/" , DIR_WRITE_MODE);
			}
			@chmod("uploads/pdf/" , DIR_WRITE_MODE);
			
			if( !file_exists('uploads/pdf/') ) {
				mkdir("uploads/pdf/" , DIR_WRITE_MODE);
			}
			@chmod("uploads/pdf/" , DIR_WRITE_MODE);
			
			if( !file_exists('uploads/pdf/'.$invoice_id) ) {
				mkdir("uploads/pdf/".$invoice_id , DIR_WRITE_MODE);
			}
			@chmod("uploads/pdf/".$invoice_id , DIR_WRITE_MODE);
	
			
		
		$dir='uploads/pdf/'.$invoice_id;
		$img_path=$dir."/".$img_name;
		move_uploaded_file($img['tmp_name'],$img_path);
		
		$this->load->library('image_lib');
					$config = array(
						'image_library'     => 'gd2',
						'source_image'      => $img_path, 
						'new_image'         => $img_name, 
						'create_thumb' 	    => FALSE,
						'maintain_ratio'    => FALSE,
						
					);
					$this->image_lib->initialize($config);
					$this->image_lib->resize();
					$this->image_lib->clear();
				
				if ( $update) {
					$this->session->set_userdata("success_message", "Record has been Updated successfully!");
				}
				else {
					$this->session->set_userdata("success_message", "Error in updating");
				}

				redirect( base_url().$language . "/admin/invoice" );

		}else{
		
			$u_array = array(
				
									"pdf_title" 					=> $this->input->post('pdf_title'),
									"invoice_number" 					=> $this->input->post('in_number'),
									"invoice_amount" 					=> $this->input->post('in_amnt'),
									"invoice_status" 					=> 'Not Paid',
									"invoice_pdf " 					=> $img_name
														
									
								);
				//debug($u_array);die;
				$insert_id = $this->Invoice_Model->save_invoice_info($u_array);	
				
				if( !file_exists('uploads') ) {
					mkdir("uploads" , DIR_WRITE_MODE);			
				}
				@chmod("uploads" , DIR_WRITE_MODE);

			if( !file_exists('uploads/pdf/') ) {
				mkdir("uploads/pdf/" , DIR_WRITE_MODE);
			}
			@chmod("uploads/pdf/" , DIR_WRITE_MODE);
			
			if( !file_exists('uploads/pdf/') ) {
				mkdir("uploads/pdf/" , DIR_WRITE_MODE);
			}
			@chmod("uploads/pdf/" , DIR_WRITE_MODE);
			
			if( !file_exists('uploads/pdf/'.$insert_id) ) {
				mkdir("uploads/pdf/".$insert_id , DIR_WRITE_MODE);
			}
			@chmod("uploads/pdf/".$insert_id , DIR_WRITE_MODE);
	
			
		
		$dir='uploads/pdf/'.$insert_id;
		$img_path=$dir."/".$img_name;
		move_uploaded_file($img['tmp_name'],$img_path);
		
		$this->load->library('image_lib');
					$config = array(
						'image_library'     => 'gd2',
						'source_image'      => $img_path, 
						'new_image'         => $img_name, 
						'create_thumb' 	    => FALSE,
						'maintain_ratio'    => FALSE,
						
					);
					$this->image_lib->initialize($config);
					$this->image_lib->resize();
					$this->image_lib->clear();
				
				if ( $insert_id ) {
					$this->session->set_userdata("success_message", "Record  has been saved!");
				}
				else {
					$this->session->set_userdata("success_message", "Error saving !!");
				}

				redirect( base_url().$language . "/admin/invoice" );
		
		}
		
		
			

	}
	
	
	
		public function delete_invoice() {
	
		if ( !$this->session->userdata("id") ) {
			redirect(base_url()."admin");
			exit;
		}
		$language = get_cookie('language');
		$u_id = $this->uri->segment(5);

		$status = (int) $this->Invoice_Model->delete_invoice($u_id);

		if ( $status ) {
			$this->session->set_userdata("success_message", "Record has been deleted!");
		}
		else {
			$this->session->set_userdata("success_message", "Error deleting User");
		}

		redirect( base_url() .$language. "/admin/invoice" );

	}
}
