<?php
class setting extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->library('session');
		if(($this->session->userdata('logged_in'))!='TRUE'){ redirect('login'); }
	}
	public function index()
	{	
		$data['title']='Setting';
		$this->load->view('header',$data);
		$this->load->view('setting');
		$this->load->view('footer');
	}
	
	
}

// NOTE: comments on repeating function or code are missing.
		// To get help review previous similar functions or code in same or another files
?>
