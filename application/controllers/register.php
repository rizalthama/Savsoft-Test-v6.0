<?php
class register extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('member_model');
		$this->load->model('group_model');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->library('javascript');
		$this->load->library('session');
		
	}
	
	public function index($msg='')
	{ 
	
		$this->load->library('form_validation');
		$data['groupName'] = $this->group_model->get_group();
		$data['title']='Register new account';
		if($msg!=''){
		$data['msg']=$msg;
		}
		$this->load->view('header',$data);
	// if admin allow external registration of user in config file
		if($this->config->item('registration')=="yes"){
		$this->load->view('register',$data);
		}
		else
		{
		$this->load->view('restricted',$data);
		}
		$this->load->view('footer');
	}
	
	
	
	
		
	public function add()
	{
	
	// add new user
		$this->load->helper('form');
		$this->load->library('form_validation');
	// validate form
		$this->form_validation->set_rules('first_name', 'First Name', 'required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
	// if admin does not require confirmation of email address validate password also
		if($this->config->item('email_confirm')!="yes"){ 
		$this->form_validation->set_rules('password', 'Password', 'required');
		}
		$this->form_validation->set_rules('country', 'Country', 'required');
	// if form validation failed
		if ($this->form_validation->run() == FALSE)
		{
		$this->index($msg='');
		}
		else
		{
	// else first check existance of email address
		if(($this->member_model->count_email_row($_POST['email']))!='0')
		{
		$msg="Email id already exist!<br>";
		$this->index($msg);
		return;
		}
		
		if($this->config->item('registration')=="yes"){
		if($this->config->item('email_confirm')=="yes"){
	// if admin require email confirmation then send password to email
		$email_subject="Account login information";
		$email_msg="Dear [last_name],\n\n";
		$email_msg.="Your password is [randomily_generated]\n\n";
		$email_msg.="Thanks,\n\n";
		}else{
		$email_subject="";
		$email_msg="";
		}
	// finally insert member information in database
		$this->member_model->add_member($email_subject,$email_msg);
		$msg="Account registered successfully.<br>";
		if($this->config->item('email_confirm')=="yes"){
		$msg.="An email sent with password to your registered email id.<br>";
		}
		
		$this->index($msg);
		}
	}
	
	}
	
	
	
}

// NOTE: comments on repeating function or code are missing.
		// To get help review previous similar functions or code in same or another files
	?>
