<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("USER_MODEL");	
		$language = $this->lang->lang();	
	}
	
		public function index()
	{
		if(!$this->session->userdata("user_id"))
		{
			redirect(base_url()."users/login");
			die;
		}		
		redirect(base_url());
	}
	

	
	public function register() {
	 	$cook_email = $this->input->post('cook_email');
		$cook_pswd = $this->input->post('cook_pswd');
		$this->session->set_userdata('u_email',$cook_email);
		$this->session->set_userdata('u_password',$cook_pswd);
		$id = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
		$params['country'] = $this->USER_MODEL->pull_all_countries();
		
		$params['user_id'] = base64_decode($id); 
		$params['title'] = "Register";	
		$this->load->view("header",$params);
		$this->load->view('navigation'); 
		$this->load->view("register");
		$this->load->view("footer");
	}
	
	/**
	 * Users check duplicate email with ajax.
	 *
	 */

    public function check_duplicate_email()
	{		
			/* RECEIVE VALUE */
			$validateValue=$_REQUEST['fieldValue'];
			$validateId=$_REQUEST['fieldId'];
			$user_id=$_REQUEST['user_id'];

			$count = $this->USER_MODEL->chk_duplicate_email($validateValue,$user_id);
			/* RETURN VALUE */
			$arrayToJs = array();
			$arrayToJs[0] = $validateId;

			if($count>=1){

				$arrayToJs[1] = false;
				echo json_encode($arrayToJs);

				} else {

				for($x=0;$x<1000000;$x++){
				if($x == 990000){
					$arrayToJs[1] = true;
					echo json_encode($arrayToJs);
					}
				}
		}
	
	}
	
	 public function check_duplicate_username()
	{
		
		
			/* RECEIVE VALUE */
			$validateValue=$_REQUEST['fieldValue'];
			$validateId=$_REQUEST['fieldId'];
			$user_id=$_REQUEST['user_id'];

			$count = $this->USER_MODEL->chk_duplicate_user($validateValue,$user_id);
			/* RETURN VALUE */
			$arrayToJs = array();
			$arrayToJs[0] = $validateId;

			if($count>=1){

				$arrayToJs[1] = false;
				echo json_encode($arrayToJs);

				} else {

				for($x=0;$x<1000000;$x++){
				if($x == 990000){
					$arrayToJs[1] = true;
					echo json_encode($arrayToJs);
					}
				}

		}
		
	}
	
	/**
	* Function:save_user
	* params:
	* usage:used to save new user
	*/
	
	public function save_user()
	{	     
		$password	 =	md5($this->input->post('password'));
		$tbl = 'tbl_users';	
		$data=array(
			"f_name"				=>	 $this->input->post('f_name'),
			"l_name"				=>	 $this->input->post('l_name'),
			"business_name"	=>	 $this->input->post('business_name'),
			"country"					=>	 $this->input->post('country'),
			"address"				=>	 $this->input->post('address'),
			"city"						=>	 $this->input->post('city'),
			"state"					=>	 $this->input->post('state'),
			"zip_code"				=>	 $this->input->post('zip_code'),
			"phone"					=>	 $this->input->post('phone'),
			"email"					=>	 $this->input->post('email'),
			"password"			=>	 md5($this->input->post('password')),
			"vat_id"					=>	 $this->input->post('vat_id'),
			"status"					=>	 1
		);
		$res = $this->USER_MODEL->save_user($tbl,$data);
		if($res>0){
		$this->session->set_flashdata("suc_message","You have been registered successfully.");
		}else{
		$this->session->set_flashdata("suc_message","Error! user are not registered.");
		}
		redirect(base_url());
	}
	
	/**
	 * Users Log In.
	 *
	 */
	public function check_login(){

		$email=$this->input->post('email');
		$password=md5($this->input->post('password'));
		$check=$this->USER_MODEL->get_rows("tbl_users","email",$email,"password",$password);
	
		if($check>0)
		{
			$user_info=$this->USER_MODEL->get_data_by_id("tbl_users","email",$email);
			$u_id=$user_info['id'];
			$u_email=$user_info['email'];
			$u_name = $user_info['f_name'].' '.$user_info['l_name'];
			$this->session->set_userdata("user_id",$u_id);
			$this->session->set_userdata("user_email",$u_email);
			$this->session->set_userdata("user_name",$u_name);
			redirect(base_url().$language);
		}
		else
		{
			$this->session->set_userdata("error_message","Username Or Password does not match");
			redirect(base_url().$language);
		}
	}
	
	
	public function logout()
	{		
		if($this->session->userdata("user_id"))
		{			
			$this->session->unset_userdata($this->session->all_userdata());
			$this->session->sess_destroy();
			redirect(base_url());
		}
	}
	
	public function my_account()
	{
		if(!$this->session->userdata("user_id"))
		{
			redirect(base_url().$language);
		}
		$data['title'] = "My Account";
		$user_id = $this->session->userdata("user_id");
		$data['country'] = $this->USER_MODEL->pull_all_countries();
		$data['user_info']=$this->USER_MODEL->get_data_by_id("tbl_users","id",$user_id);
	
		$this->load->view('header', $data);
		$this->load->view('navigation'); 
		$this->load->view("my_account");
		$this->load->view('footer');
	}
	
	public function update_user()
	{
		$language = $this->lang->lang();
		if(!$this->session->userdata("user_id"))
		{
			redirect(base_url().$language);
			die;
		}
		$email = $this->input->post('email');
		$user_id = $this->session->userdata("user_id");
		
		$data = array(								
					"f_name"				=>	 $this->input->post('f_name'),
					"l_name"				=>	 $this->input->post('l_name'),
					"business_name"	=>	 $this->input->post('business_name'),
					"country"					=>	 $this->input->post('country'),
					"address"				=>	 $this->input->post('address'),
					"city"						=>	 $this->input->post('city'),
					"state"					=>	 $this->input->post('state'),
					"zip_code"				=>	 $this->input->post('zip_code'),
					"phone"					=>	 $this->input->post('phone'),
					"email"					=>	 $this->input->post('email'),
					"password"			=>	 md5($this->input->post('password')),
					"vat_id"					=>	 $this->input->post('vat_id'),
					"status"					=>	 1
			);
			// debug($data);die;
		$check_email=$this->USER_MODEL->get_rows("tbl_users","email",$email, "id !=", $user_id);
		if($check_email>0 )
		{
			$this->session->set_userdata("error_message","Email id already Exists");
			// echo base_url().$language.'/users/my_account';
			redirect(base_url().$language.'/users/my_account');
		}
		else if($check_email==0)
		{
			$update=$this->USER_MODEL->update("tbl_users",$data, "id", $user_id);
			if($update)
			{
				$this->session->set_userdata("success_message","Account is updated successfully.");
				// echo base_url().$language.'/users/my_account';
				redirect(base_url().$language."/users/my_account");
			}
			else
			{
				$this->session->set_userdata("error_message","Error Occurred, Try again after sometime");
				// echo base_url().$language.'/users/my_account';
				redirect(base_url().$language."/users/my_account");
				
			}
		}

	}
		
	
	public function forgot_password()
	{
		
		$this->load->view('header');
		$this->load->view("forgot_password");
		$this->load->view('footer');
	}
	
	 public function check_email_fpassword()
	{
		
		
			/* RECEIVE VALUE */
			$validateValue=$_REQUEST['fieldValue'];
			$validateId=$_REQUEST['fieldId'];

			$count = $this->USER_MODEL->check_email_fpassword($validateValue);
			/* RETURN VALUE */
			$arrayToJs = array();
			$arrayToJs[0] = $validateId;

			if($count>=1){

				$arrayToJs[1] = true;
				echo json_encode($arrayToJs);

				} else {

				for($x=0;$x<1000000;$x++){
				if($x == 990000){
					$arrayToJs[1] = false;
					echo json_encode($arrayToJs);
					}
				}

		}
		
	}
	
	public function send_password()	{
	
		$email = $this->input->post("email");

		$this->load->helper("common_helper");

		$new_password = random_str(8);

		$update_status = $this->USER_MODEL->change_password($email, $new_password);

		$image_path = base_url()."images/logo1.png";

		//$update_status = true;

		if ( $update_status === true ) {

				$admin_email = $this->USER_MODEL->get_admin_email();

				$this->load->library('email');

				$config['mailtype'] = 'html';

				$this->email->initialize($config);

				$this->email->from( $admin_email, "MitusBitExchange" );

				$this->email->to( $email );

				$this->email->subject("MitusBitExchange -  Forgot Password.");

				$message = @file_get_contents("template/forgot_password.html");

				$message = str_replace("[IMAGE_PATH]", $image_path, $message);

				$message = str_replace("[USERNAME]", $email, $message);

				$message = str_replace("[PASSWORD]", $new_password, $message);

				$login_url = base_url('users/login');

				$message = str_replace("[CUSTOMER_LOGIN_URL]", $login_url, $message);

				$this->email->message($message);

				//debug($message);die;

				$mail = $this->email->send();

				if($mail){

						$this->session->set_userdata("success_message","Email Send Successfully.");

				}
				else
				{

						$this->session->set_userdata("success_message","Error occurred during sending mail.");

				}

				redirect(base_url()."users/forget_password");

	}

	
	}

	public function profile(){
	
		if(!$this->session->userdata("user_id"))
		{
			redirect(base_url()."users/login");
		}
		
		$user_id = $this->uri->segment(3,0);
		
		if(empty($user_id)){
		
				$user_id = $this->session->userdata("user_id");
		
		}

		$data['profile_info'] = $this->USER_MODEL->get_user_info($user_id);
		
		$this->load->view('header', $data);
		$this->load->view("profile");
		$this->load->view('footer');
		
	}
	
		public function check_users_password(){
	
		$validateValue=$_REQUEST['fieldValue'];
		$validateId=$_REQUEST['fieldId'];
		
		if(!empty($validateValue))
		{
			$validateValue = hash('md5',$validateValue);
		}
		
		$is_login = $this->USER_MODEL->check_users_password($validateValue);
	//	echo $is_login;
		$arrayToJs = array();
		$arrayToJs[0] = $validateId;

		if($is_login){

			$arrayToJs[1] = true;
			echo json_encode($arrayToJs);

			} else {

			for($x=0;$x<1000000;$x++){
				if($x == 990000){
					$arrayToJs[1] = false;
					echo json_encode($arrayToJs);
				}
			}

		}
	}
	
	public function forget_password() {
		
		$params['title'] = "Forget Password";	

		$this->load->view("header",$params);
		$this->load->view("forget_password");
		$this->load->view("footer");

	}
	
	public function invite_friend() {
	
		if(!$this->session->userdata("user_id"))
		{
			redirect(base_url()."users/login");
		}
		
		$params['title'] = "Invite Friend";	

		$this->load->view("header",$params);
		$this->load->view("invite_friend");
		$this->load->view("footer");

	}
	
	public function send_invite_friends(){
	
				$user_id = $this->session->userdata("user_id");
				$user_email = $this->session->userdata("email"); 
	
				$email = $this->input->post("email");
				$a_user_email = explode(',',$email);
				$decode_user_id =  base64_encode($user_id); 
				$user_login_url = base_url()."users/register/".$decode_user_id;
				
		foreach($a_user_email as $another_user_email) 
		{
				//debug($val);die;
				$image_path = base_url()."images/logo1.png";

				$this->load->library('email');
				$config['mailtype'] = 'html';
				$this->email->initialize($config);
				$this->email->from( $user_email, "MitusBitExchange" );
				$this->email->to( $another_user_email );
				$this->email->subject("MitusBitExchange -  Invite Friends.");
				$message = @file_get_contents("template/invite_friends.html");
				$message = str_replace("[IMAGE_PATH]", $image_path, $message);
				$message = str_replace("[USERNAME]", $another_user_email, $message);
				$message = str_replace("[CUSTOMER_LOGIN_URL]", $user_login_url, $message);
				$this->email->message($message);

				//debug($message);die;

				$mail = $this->email->send();
		}

				if($mail)
				{

						$this->session->set_userdata("success_message","Email Send Successfully.");

				}
				else
				{

						$this->session->set_userdata("success_message","Error occurred during sending mail.");

				}

				redirect(base_url()."users/invite_friend");

	
	}
	

	public function change_coin_status()
	{
		$id = $this->input->post('id');
		$status = $this->input->post('status');
		if($status=='1')
		{
		$status = 0;
		}
		else
		{
		$status = 1;
		}
		
		$update_user = $this->USER_MODEL->change_coin_status($id,$status);
		//echo $update_user;
		if($update_user=='1')
		{
		echo "1";
		}
		else
		{
		echo "0";
		}
		
	}
	
	
	public function support()
	{
		
		$email = $this->input->post('email');
		$subject = $this->input->post('subject');
		$message1 = $this->input->post('message');
		$type = $this->input->post('type');
		$username = $this->input->post('username');
		$coin = $this->input->post('coin');
		$image_path = base_url()."images/logo1.png";
		$admin_data = $this->USER_MODEL->get_admin_email();
		$admin_name = $admin_data['setting_name'];
		$admin_email = $admin_data['setting_value'];

				$this->load->library('email');

				$config['mailtype'] = 'html';

				$this->email->initialize($config);

				$this->email->from( $email, "MitusBitExchange" );

				$this->email->to( $admin_email );

				$this->email->subject("MitusBitExchange -  Support.");

				$message = @file_get_contents("template/support.html");

				$message = str_replace("[IMAGE_PATH]", $image_path, $message);
				$message = str_replace("[ADMIN_NAME]", $admin_name, $message);
				$message = str_replace("[USERNAME]", $username, $message);
				$message = str_replace("[EMAIL]", $email, $message);
				$message = str_replace("[SUBJECT]", $subject, $message);
				$message = str_replace("[MESSAGE]", $message1, $message);
				$message = str_replace("[TYPE]", $type, $message);
				$message = str_replace("[COIN]", $coin, $message);

				$this->email->message($message);

				//debug($message);die;

				$mail = $this->email->send();

				if($mail){

						$this->session->set_userdata("success_message","Thank you for submitting a feedback.");

				}
				else
				{

						$this->session->set_userdata("success_message","Error occurred during submit a feedback.");

				}

				redirect(base_url());
		
	}
	
		public function check_email_exists() {
		
		$email = $this->input->post("email");

		$user_id = $this->input->post("user_id");

		if ( $user_id === false ) {
			$user_id = 0;
		}

		
		echo (int) $this->USER_MODEL->does_email_exists($email, $user_id);

	}
	
		public function fetch_states() {

    	$cntry_id = $this->input->post('cntry_code');

		$user_id = $this->session->userdata("user_id");

		if ( $user_id === false ) {
			$user_id = 0;
		}
		
		
		$data = $this->USER_MODEL->get_states($cntry_id);
// debug($data);die;
		$result = "";
		
		$result .= '<option value = "">Select State</option>';
		
		foreach($data as $key => $val){

		$result .= '<option value = "'.$val->state_id.'">'.$val->state_name.'</option>';

		}

		echo $result;
	}
	
	public function changepass(){
 
			$oldpass=$this->input->post('oldpass'); 
			$newpass=$this->input->post('newpass');
			$user_id=$this->session->userdata("user_id");
			$user_info=$this->USER_MODEL->chngpass($user_id,$oldpass);

			if(empty($user_info))
			 {
				echo 0;
				return;
			 }
			 
			  $info=$this->USER_MODEL->chng_pass($user_id,$newpass);
			 
			 if($info)
			 {
				echo 1;
			 }
			 else{
			 
			 echo 2;
			 
			 }
			
			
			}	
 
 
	}
	


