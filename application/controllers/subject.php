<?php
class subject extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('subject_model');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->library('javascript');
		$this->load->library('session');
	// if not logged in redirect
		if(($this->session->userdata('logged_in'))!='TRUE'){ redirect('login'); }
	}
	public function index()
	{	
	// getting subjects list
		$data['subject'] = $this->subject_model->get_subject();
		$data['title']='Subject';
		$this->load->view('header',$data);
		if(($this->session->userdata('su'))=='1'){
		$this->load->view('subject',$data);
		}
		else
		{
		$this->load->view('restricted',$data);
		}
		$this->load->view('footer');
	}
	public function search($str)
	{	
// getting searched subjects list
		$data['subject'] = $this->subject_model->search_subject($str);
		$data['title']='Subject';
		$this->load->view('header',$data);
		if(($this->session->userdata('su'))=='1'){
		$this->load->view('subject',$data);
		}
		else
		{
		$this->load->view('restricted',$data);
		}
		$this->load->view('footer');
	}
	
	public function del($sid)
	{
// delete subject
		if(($this->session->userdata('su'))=='1'){
		$this->subject_model->del_subject($sid);
		}
		$this->index($limit = 0);
	}
	
	
	public function edit($sid)
	{ 
	// edit subject
	
	 $this->load->library('form_validation');
		$this->load->model('subject_model');
		$data['subjectname'] = $this->subject_model->get_subject($sid);
		$data['title']='Edit Subject';
		$this->load->view('header',$data);
		if(($this->session->userdata('su'))=='1'){
		$this->load->view('editsubject',$data);
		}
		else
		{
		$this->load->view('restricted',$data);
		}
		$this->load->view('footer');
	}
	
	public function newsubject()
	{ 
	// add new subject
		$this->load->library('form_validation');
		$data['title']='Add New Subject';
		$this->load->view('header',$data);
		if(($this->session->userdata('su'))=='1'){
		$this->load->view('newsubject',$data);
		}
		else
		{
		$this->load->view('restricted',$data);
		}
		$this->load->view('footer');
	}

	
	
	
		public function update($sid)
	{
	// up date subject row
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('subject_Name', 'Subject Name', 'required');
		if ($this->form_validation->run() == FALSE)
		{
		$this->edit($sid);
		}
		else
		{
		if(($this->session->userdata('su'))=='1'){
		$tid=$this->subject_model->update_subject($sid);
		}
		$this->index();
		}
	
	}
	
	
	
	public function add()
	{
	// insert subject row
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('subject_Name', 'Subject Name', 'required');
		if ($this->form_validation->run() == FALSE)
		{
		$this->newsubject();
		}
		else
		{
		if(($this->session->userdata('su'))=='1'){
		$tid=$this->subject_model->add_subject();
		}
		$this->index();
	}
	
	
	}
	
}

// NOTE: comments on repeating function or code are missing.
		// To get help review previous similar functions or code in same or another files
?>
