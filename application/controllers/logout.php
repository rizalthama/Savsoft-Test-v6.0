<?php
class logout extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->library('session');
	}
	public function index()
	{	
	// unsel all created session
		$this->session->unset_userdata('uid');
		$this->session->unset_userdata('su');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('logged_in');
	// redirect to login page
		redirect( 'login' );
	}
	
	
}

// NOTE: comments on repeating function or code are missing.
		// To get help review previous similar functions or code in same or another files
?>
