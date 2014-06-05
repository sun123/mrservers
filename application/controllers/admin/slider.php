<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Slider extends CI_Controller {	
	public function __construct() {
			parent::__construct();
			$this->load->model('admin/slider_model');
			$this->load->model('admin/admin_model');			
			if($this->session->userdata('admin_id')!='admin')
			{
			redirect(base_url()."admin/admin");
			}
			$this->load->library("pagination");
	}	
	public function manage_slider()	{
		$extraparams = "&" . $_SERVER["QUERY_STRING"];
		$extraparams = explode("&", $extraparams);
		foreach( $extraparams as $key => $pp ) {
			$temp = explode("=", $pp);
			if ($temp[0] == "page") {
			  unset($extraparams[$key]);
			}
		}
		$extraparams = implode($extraparams, "&");
		$limit_start = $this->uri->segment(3);
		$page = isset( $_GET["page"] ) ? $_GET["page"] : 1;
		if (empty($limit_start)) {
		$limit_start = 0;
		}
		$tot_count=$this->slider_model->get_rows("tbl_slider");
		$data['sliders']=$this->slider_model->get_data("tbl_slider",PAGINATION_PER_PAGE,($page - 1)*PAGINATION_PER_PAGE);
		$data["total_rows"] = $tot_count;
		$data["url"] = base_url() ."admin/slider/manage_slider";
		$data["limit"] = PAGINATION_PER_PAGE;
		$data["page"] = $page;
		$data["extraparams"] = $extraparams;
		$data['title']="Manage Slider";
		$this->load->view("admin/includes/header", $data);
		$this->load->view("admin/slider/manage_slider");
		$this->load->view("admin/includes/footer");
	}	
	public function add_slider()	{
		$data['menu_title']="Manage Slider";
		$data['title']="Add Slider";
		$this->load->view("admin/includes/header", $data);
		$this->load->view("admin/slider/add_slider");
		$this->load->view("admin/includes/footer");
	}
	public function save_slider()	{
		$img=$_FILES['slider_image'];
        $data=array(
                    'slider_title'=>$this->input->post('slider_title'),
                    'slider_image'=>$img['name'],
					'slider_page'=>$this->input->post('slider_page'),
                    'slider_link'=>$this->input->post('slider_link'),
                    'status'=>1,
                    ); 
		$slider_id=$this->slider_model->save("tbl_slider",$data);
        if($slider_id)
        {
            if ($img["error"] == UPLOAD_ERR_OK ) 
				{
				if( !file_exists('uploads') ) {
					mkdir("uploads" , DIR_WRITE_MODE);			
					}
					@chmod("uploads" , DIR_WRITE_MODE);

			    if( !file_exists('uploads/slider/') ) {
				    mkdir("uploads/slider/" , DIR_WRITE_MODE);
					}
					@chmod("uploads/slider/" , DIR_WRITE_MODE);
			    
	            if( !file_exists('uploads/slider/'.$slider_id) ) {
				    mkdir("uploads/slider/".$slider_id , DIR_WRITE_MODE);
					}
					@chmod("uploads/slider/".$slider_id , DIR_WRITE_MODE);
				if( !file_exists('uploads/slider/'.$slider_id.'/thumbs') ) {
				    mkdir("uploads/slider/".$slider_id.'/thumbs' , DIR_WRITE_MODE);
					}
					@chmod("uploads/slider/".$slider_id.'/thumbs' , DIR_WRITE_MODE);
				$dir='uploads/slider/'.$slider_id;
				$img_path=$dir."/".$img['name'];
				move_uploaded_file($img['tmp_name'],$img_path);
				$this->load->library('image_lib');
				$config = array(
						'image_library'     => 'gd2',
						'source_image'      => $img_path, 
						'new_image'         => $dir .'/'. $img['name'], 
						'create_thumb' 	    =>FALSE,
						'maintain_ratio'    => FALSE,
						'width'             =>1273,
						'height'            => 373
					);
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->clear();
				$config = array(
						'image_library'     => 'gd2',
						'source_image'      => $img_path, 
						'new_image'         => $dir .'/thumbs/'. $img['name'], 
						'create_thumb' 	    =>FALSE,
						'maintain_ratio'    => FALSE,
						'width'             => 100,
						'height'            => 100
					);
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->clear();
				$this->session->set_userdata('success_message','Slider save Successfully.');
			}
			else
			{
				$this->session->set_userdata('success_message','Error Occured in upload Slider image.');
			}
		}
		else
		{
		  $this->session->set_userdata('error_message','Error Occured!');
		}
		redirect(base_url().'admin/slider/manage_slider');	 
	}	
	public function edit_slider()	{
		$slider_id=$this->uri->segment(4);
		$data['menu_title']="Manage Slider";
		$data['title']="Edit Slider";
		$data['slider']=$this->slider_model->get_data_by_id("tbl_slider", "slider_id" ,$slider_id);
		$this->load->view("admin/includes/header", $data);
		$this->load->view("admin/slider/edit_slider");
		$this->load->view("admin/includes/footer");
	}	
	public function update_slider(){
        $img=$_FILES['slider_image'];
        $slider_id=$this->input->post('slider_id');
        if($img['name']=='')
        {
			$data=array(
                    'slider_page'=>$this->input->post('slider_page'),
					'slider_title'=>$this->input->post('slider_title'),
                    'slider_link'=>$this->input->post('slider_link'),
                    );
        }
        else
        {
			$data=array(
                    'slider_page'=>$this->input->post('slider_page'),
                    'slider_title'=>$this->input->post('slider_title'),
                    'slider_image'=>$img['name'],
                    'slider_link'=>$this->input->post('slider_link'),
                    );
                if ($img["error"] == UPLOAD_ERR_OK ) 
				{   
				    $image_dir =glob("uploads/slider/".$slider_id."/*");
		            foreach ($image_dir as $file) 
		            {
			            if ( is_dir($file) )
			            {
				            $dir_content = glob($file."/*");
				            foreach($dir_content as $dir_file) 
				            {
					            chmod($dir_file, DIR_WRITE_MODE);
					            @unlink($dir_file);
				            }
			            }
			            else {
				            chmod($file, DIR_WRITE_MODE);
				            @unlink($file);
			            }
			            @rmdir($file);
		            }
		            @rmdir("uploads/slider/".$slider_id);					
					if( !file_exists('uploads') ) {
					  mkdir("uploads" , DIR_WRITE_MODE);			
				    }
				    @chmod("uploads" , DIR_WRITE_MODE);					
			        if( !file_exists('uploads/slider/') ) {
				    mkdir("uploads/slider/" , DIR_WRITE_MODE);
			        }
			        @chmod("uploads/slider/" , DIR_WRITE_MODE);
					if( !file_exists('uploads/slider/'.$slider_id) ) {
				    mkdir("uploads/slider/".$slider_id , DIR_WRITE_MODE);
			        }
			        @chmod("uploads/slider/".$slider_id , DIR_WRITE_MODE);					
					if( !file_exists('uploads/slider/'.$slider_id.'/thumbs') ) {
				    mkdir("uploads/slider/".$slider_id.'/thumbs' , DIR_WRITE_MODE);
					}
					@chmod("uploads/slider/".$slider_id.'/thumbs' , DIR_WRITE_MODE);
			        $dir='uploads/slider/'.$slider_id;
	                $img_path=$dir."/".$img['name'];
					move_uploaded_file($img['tmp_name'],$img_path);
					$this->load->library('image_lib');
					$config = array(
						        'image_library'     => 'gd2',
						        'source_image'      => $img_path, 
						        'new_image'         => $dir .'/'. $img['name'], 
						        'create_thumb' 	    =>FALSE,
						        'maintain_ratio'    => FALSE,
						        'width'             => 960,
						        'height'            => 326
					            );
				    $this->image_lib->initialize($config);
				    $this->image_lib->resize();
				    $this->image_lib->clear();
					$config = array(
								'image_library'     => 'gd2',
								'source_image'      => $img_path, 
								'new_image'         => $dir .'/thumbs/'. $img['name'], 
								'create_thumb' 	    =>FALSE,
								'maintain_ratio'    => FALSE,
								'width'             => 100,
								'height'            => 100
							);
					$this->image_lib->initialize($config);
					$this->image_lib->resize();
					$this->image_lib->clear();
					$this->session->set_userdata('success_message','Slider Updated Successfully.');
				}
        }  
        $update=$this->slider_model->update("tbl_slider",$data,"slider_id",$slider_id);
        if($update)
        {
           $this->session->set_userdata('success_message','slider Updated Successfully.'); 
		}
		else
		{
		  $this->session->set_userdata('error_message','ERROR OCCURED!');
		}
		redirect(base_url().'admin/slider/manage_slider');	 
    }
	public function delete_slider(){
        $slider_id=$this->uri->segment(4);
        $delete=$this->slider_model->delete("tbl_slider","slider_id",$slider_id);
        if($delete)
        {
            $image_dir =glob("uploads/slider/".$slider_id."/*");
		            foreach ($image_dir as $file) 
		            {
			            if ( is_dir($file) )
			            {
				            $dir_content = glob($file."/*");
				            foreach($dir_content as $dir_file) 
				            {
					            chmod($dir_file, DIR_WRITE_MODE);
					            @unlink($dir_file);
				            }
			            }
			            else {
				            chmod($file, DIR_WRITE_MODE);
				            @unlink($file);
			            }
			            @rmdir($file);
		            }
		            @rmdir("uploads/slider/".$slider_id);
            $this->session->set_userdata('success_message','Slider Deleted Successfully.'); 
        }
        else
		{
		  $this->session->set_userdata('error_message','ERROR OCCURED!');
		}
		redirect(base_url().'admin/slider/manage_slider');
    }
}
