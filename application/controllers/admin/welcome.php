<?php
class Welcome extends CI_Controller {
	public function index() {
		$params['title']	=	'login';
		$this->load->view('admin/login/login');
	}
	public function home() {
		$params['title']	=	'Home';
		$this->load->view('admin/includes/header',$params);
		$this->load->view('admin/login/home');
		$this->load->view('admin/includes/footer');
	}	
}
