<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invoice extends CI_Controller {
	public function __construct(){
        parent::__construct();   
		$this->load->model("invoice_model");		
    }
	public function index(){
		$data['title'] = 'Home';
		$data['invo_pdf'] = $this->invoice_model->get_rows();
		$this->load->view('header',$data);
		$this->load->view('navigation'); 
		$this->load->view('pdf');  
		$this->load->view('footer'); 
	}
	public function download_pdf(){
		$fullPath = base_url().'uploads/pdf/leave_management_wireframe.pdf';
		$id =  $this->uri->segment(4);
		$get_data = $this->invoice_model->get_row_by_id($id);
		 $fullPath = base_url().'uploads/pdf/'.$get_data->id.'/'.$get_data->invoice_pdf;	
		if ($fd = fopen ($fullPath, "r")) {
			$fsize = filesize($fullPath);
			$path_parts = pathinfo($fullPath);
			$ext = strtolower($path_parts["extension"]);
			switch ($ext) {
				case "pdf":
				header("Content-type: application/pdf"); 
				header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\""); 
				break;
				default;
				header("Content-type: application/octet-stream");
				header("Content-Disposition: filename=\"".$path_parts["basename"]."\"");
			}
			header("Content-length: $fsize");
			header("Cache-control: private"); 
			while(!feof($fd)){
				$buffer = fread($fd, 2048);
				echo $buffer;
			}
		}
		fclose ($fd);
		exit;
	}
}
