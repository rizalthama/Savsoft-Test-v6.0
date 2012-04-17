<?php
class login extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('member_model');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('session');
	}
	public function index($msg='')
	{	
	// if already login redirect to index page
	if(($this->session->userdata('logged_in'))=='TRUE')
	{
	redirect( 'index' );
	}
		// declare failed message
		if($msg=="failed")
		{
		$data['msg']="Authentication failed!<br/>"; 
		}
		
		$data['title']="Login";
		$this->load->view('header',$data);
		$this->load->view('login',$data);
		$this->load->view('footer');
	}
	public function loginCheck()
	{	
	
	// count number of row of given email and password 
	// zero rows get status value as FALSE else get array of required information as status
		if(isset($_POST['email']) && isset($_POST['password']))
		{
		$status=$this->member_model->count_row($_POST['email'],$_POST['password']);
		
		if($status=="FALSE")
		{
		$this->index('failed');
		}
		else
		{
		
		// check status active or deactive
		if($status['status']=='0'){
		$this->index('failed');
		return;
		}
		// create session	
		$user_id	=	$status['uid'];
		$superUser	=	$status['su'];
		$newdata = array(
                   'uid'  => $user_id,
                   'su'  => $superUser,
                   'email'     => $_POST['email'],
                   'logged_in' => TRUE
               );

	$this->session->set_userdata($newdata);
	redirect( 'index' );
		}
		}
	}
	
	
}

// NOTE: comments on repeating function or code are missing.
		// To get help review previous similar functions or code in same or another files
?>
