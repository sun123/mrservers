<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_404 extends CI_Controller {

	public function __construct(){
        parent::__construct();   
    }

	public function index(){
		$this->output->set_status_header('404');
		$data['title'] = 'Page Not Found';
		$data['content_page'] = 'page_not_found';
		$this->load->view('includes/template', $data);  
	}
	
}

/* End of file My_404.php */
/* Location: ./application/controllers/welcome.php */
