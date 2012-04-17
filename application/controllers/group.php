<?php
class group extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('group_model');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->library('javascript');
		$this->load->library('session');
	// if not logged in redirect
		if(($this->session->userdata('logged_in'))!='TRUE'){ redirect('login'); }
	}
	public function index()
	{	
	// getting group data
		$data['group'] = $this->group_model->get_group();
	// declare title of page
		$data['title']='Group';
	// load header
		$this->load->view('header',$data);
	// if logged in user administrator 
		if(($this->session->userdata('su'))=='1'){
		//load group page
		$this->load->view('group',$data);
		}
		else
		{
		$this->load->view('restricted',$data);
		}
	// footer page
		$this->load->view('footer');
	}
	public function search($str)
	{	
	// getting group data
		$data['group'] = $this->group_model->search_group($str);
	// declare title of page
		$data['title']='Group';
	// load header
		$this->load->view('header',$data);
	// if logged in user administrator 
		if(($this->session->userdata('su'))=='1'){
		$this->load->view('group',$data);
		}
		else
		{
		$this->load->view('restricted',$data);
		}
		$this->load->view('footer');
	}
	
	public function del($gid)
	{
	// if logged in user administrator 
		if(($this->session->userdata('su'))=='1'){
		// delete
		$this->group_model->del_group($gid);
		}
		$this->index($limit = 0);
	}
	
	
	public function edit($gid)
	{  
	// edit group
		$this->load->library('form_validation');
		$this->load->model('group_model');
	// getting group data	
		$data['group'] = $this->group_model->get_group($gid);
	// title
		$data['title']='Edit Group';
	// load header
		$this->load->view('header',$data);
	// if logged in user administrator 
		if(($this->session->userdata('su'))=='1'){
		$this->load->view('editgroup',$data);
		}
		else
		{
		$this->load->view('restricted',$data);
		}
		$this->load->view('footer');
	}
	
	public function newgroup()
	{ 	
	// new group
	// load form validation library
		$this->load->library('form_validation');
		$data['title']='Add New Group';
		$this->load->view('header',$data);
		if(($this->session->userdata('su'))=='1'){
		$this->load->view('newgroup',$data);
		}
		else
		{
		$this->load->view('restricted',$data);
		}
		$this->load->view('footer');
	}

	
	
	
		public function update($gid)
	{
	// update group row function
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('group_name', 'Group Name', 'required');
		// if form validation failed
		if ($this->form_validation->run() == FALSE)
		{
		// load edit function
		$this->edit($gid);
		}
		else
		{
		if(($this->session->userdata('su'))=='1'){
		// else update
		$tid=$this->group_model->update_group($gid);
		}
		// go to index
		$this->index();
		}
	
	}
	
	
	
	public function add()
	{
	// to insert new group row
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('group_name', 'Group Name', 'required');
		if ($this->form_validation->run() == FALSE)
		{
		$this->newgroup();
		}
		else
		{
		if(($this->session->userdata('su'))=='1'){
		$tid=$this->group_model->add_group();
		}
		$this->index();
	}
	
	
	}
	
}

// NOTE: comments on repeating function or code are missing.
		// To get help review previous similar functions or code in same or another files
?>
