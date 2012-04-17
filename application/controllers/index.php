<?php
class index extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->library('session');
	// if not logged in redirect
		if(($this->session->userdata('logged_in'))!='TRUE'){ redirect('login'); }
	}
	public function index()
	{	
	// title of page
		$data['title']='Question Bank';
	// load header file
		$this->load->view('header',$data);
	// load index file
		$this->load->view('index');
	// load footer
		$this->load->view('footer');
	}
	
	
}

// NOTE: comments on repeating function or code are missing.
		// To get help review previous similar functions or code in same or another files
?>
