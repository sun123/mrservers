<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct(){
        parent::__construct();   
		$this->load->model("welcome_model");

		
    }

	public function index(){
		$data['title'] = 'Home';
		$this->load->helper('language');		// load language file
		$this->lang->load('header');
		$this->lang->load('top');
		$this->lang->load('nav');
		
		$language = $this->lang->lang();	
		$this->input->set_cookie('language',$language);
		$cond = array(
		
			'lang'	=> $language,
			'slug'	=> 'banner'
		
		);
	
		
		$this->load->view('header',$data);
		$this->load->view('navigation'); 
		$this->load->view('banner');
		$this->load->view('home');  
		$this->load->view('footer'); 
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */