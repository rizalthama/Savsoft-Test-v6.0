<?php
class answer extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('result_model');
		$this->load->model('attempt_model');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->library('session');
	// if not logged in redirect
		if(($this->session->userdata('logged_in'))!='TRUE'){ redirect('login'); }
		
	}
	
	
	public function index($resultid = 0)
	{	
	
	// getting result data through result id
		$data['result']= $this->result_model->get_result($resultid,'0');
	// getting questions data which was assigned in test through question ids given by data[result] array
		$data['questions']= $this->attempt_model->get_questions($data['result']['question_ids']);
	// declare title of page
		$data['title']='Answers';
	// load header file
		$this->load->view('header',$data);
	// if user is authorised to view this page  
		if(((($this->session->userdata('su'))=='1') || (($this->session->userdata('uid'))==($data['result']['uid']))) && ($this->config->item('view_answer')=="yes")){
		$this->load->view('answer',$data);
		}
		else
		{
		// load restricted message page
		$this->load->view('restricted',$data);
		}
	// load footer	
		$this->load->view('footer');
	}
}
?>
