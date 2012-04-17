<?php
class qbank extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('qbank_model');
		$this->load->model('subject_model');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->library('javascript');
		$this->load->library('session');
	// if not logged in redirect
		if(($this->session->userdata('logged_in'))!='TRUE'){ redirect('login'); }
	}
	public function index($limit = 0)
	{	
	// if logged in ser is not admin redirect
			if(($this->session->userdata('su'))!='1'){
			redirect('index');
			}
		// get questions list as array
		$data['questionBank'] = $this->qbank_model->get_question('0',$limit);
		$data['title']='Question Bank';
		$data['limit']=$limit;
		$this->load->view('header',$data);
		$this->load->view('qbank',$data);
		$this->load->view('footer');
	}
	public function search($str)
	{	
			if(($this->session->userdata('su'))!='1'){
			redirect('index');
			}
	// getting questions list related to search string (str)
		$data['questionBank'] = $this->qbank_model->search_question($str);
		$data['title']='Question Bank';
		$this->load->view('header',$data);
		$this->load->view('qbank',$data);
		$this->load->view('footer');
	}
	
	public function del($qid)
	{
	// delete question by question id (qid)
			if(($this->session->userdata('su'))!='1'){
			redirect('index');
			}
		$this->qbank_model->del_question($qid);
		$data['questionBank'] = $this->qbank_model->get_question('0','0');
		$data['title']='Question Bank';
		$this->load->view('header',$data);
		$this->load->view('qbank',$data);
		$this->load->view('footer');
	}
	
	public function view($qid)
	{	
			if(($this->session->userdata('su'))!='1'){
			redirect('index');
			}
	// view question detail
		$data['questionBank'] = $this->qbank_model->get_question($qid,'0');
		$data['title']='Question';
		$this->load->view('header',$data);
		$this->load->view('question',$data);
		$this->load->view('footer');
	}
	public function edit($qid)
	{  
	
			if(($this->session->userdata('su'))!='1'){
			redirect('index');
			}
	// edit question
		$this->load->library('form_validation');
		$data['questionBank'] = $this->qbank_model->get_question($qid,'0');
		$data['subjectName'] = $this->subject_model->get_subject();
		$data['title']='Edit Question';
		$this->load->view('header',$data);
		$this->load->view('editquestion',$data);
		$this->load->view('footer');
	}
	
	public function newq()
	{ 	
	// new question
			if(($this->session->userdata('su'))!='1'){
			redirect('index');
			}
		$this->load->library('form_validation');
		$data['subjectName'] = $this->subject_model->get_subject();
		$data['title']='Add New Question';
		$this->load->view('header',$data);
		$this->load->view('newquestion',$data);
		$this->load->view('footer');
	}
	
	public function update($qid)
	{
	// update question row
			if(($this->session->userdata('su'))!='1'){
			redirect('index');
			}
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('question', 'question', 'required');
		//$this->form_validation->set_rules('option[]', 'option', 'required');
		$this->form_validation->set_rules('answer', 'answer', 'required');
		if ($this->form_validation->run() == FALSE)
		{
		$data['questionBank'] = $this->qbank_model->get_question($qid,'0');
		$data['subjectName'] = $this->subject_model->get_subject();
		$data['title']='Question';
		$this->load->view('header',$data);
		$this->load->view('editquestion',$data);
		$this->load->view('footer');
		}
		else
		{
		
		$this->qbank_model->update_question($qid);
		$data['questionBank'] = $this->qbank_model->get_question($qid,'0');
		$data['title']='Question';
		$this->load->view('header',$data);
		$this->load->view('question',$data);
		$this->load->view('footer');
		}
	
	
	}
	
	
	
	
	
	public function add()
	{
	// insert new question or row	
			if(($this->session->userdata('su'))!='1'){
			redirect('index');
			}
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('question', 'question', 'required');
		//$this->form_validation->set_rules('option[]', 'option', 'required');
		$this->form_validation->set_rules('answer', 'answer', 'required');
		if ($this->form_validation->run() == FALSE)
		{
		$data['subjectName'] = $this->subject_model->get_subject();
		$data['title']='Question';
		$this->load->view('header',$data);
		$this->load->view('newquestion',$data);
		$this->load->view('footer');
		}
		else
		{
		
		$this->qbank_model->add_question();
		$data['questionBank'] = $this->qbank_model->get_question('0','0');
		$data['title']='Question Bank';
		$this->load->view('header',$data);
		$this->load->view('qbank',$data);
		$this->load->view('footer');
		}
	
	
	}
	
}

// NOTE: comments on repeating function or code are missing.
		// To get help review previous similar functions or code in same or another files
?>
