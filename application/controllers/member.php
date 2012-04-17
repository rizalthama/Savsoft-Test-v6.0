<?php
class member extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('member_model');
		$this->load->model('group_model');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->library('javascript');
		$this->load->library('session');
		// if not logged in redirect
		if(($this->session->userdata('logged_in'))!='TRUE'){ redirect('login'); }
	}
	public function index($limit = 0)
	{	
	// get member array or member rows
		$data['member'] = $this->member_model->get_member('0',$limit);
		$data['title']='Member';
		$data['limit']=$limit;
		$this->load->view('header',$data);
	// only if loged in user is admin
		if(($this->session->userdata('su'))=='1'){
		$this->load->view('member',$data);
		}
		else
		{
		$this->load->view('restricted',$data);
		}
		$this->load->view('footer');
	}
	public function search($str)
	{	
	// search in member rows
		$data['member'] = $this->member_model->search_member($str);
		$data['title']='Member';
		$this->load->view('header',$data);
	// only if logged in user is admin
		if(($this->session->userdata('su'))=='1'){
		$this->load->view('member',$data);
		}else{ 
		$this->load->view('restricted',$data); 
		}
		$this->load->view('footer');
	}
	
	public function del($uid)
	{
	// del any member if logged in user is admin
	if(($this->session->userdata('su'))=='1'){
		$this->member_model->del_member($uid);
		}
		$this->index($limit = 0);
	}
	
	public function view($uid)
	{	
	// view member detail
		$data['title']='Member';
		$this->load->view('header',$data);
	// if user is admin view any user/member detail
		if(($this->session->userdata('su'))=='1'){
		$data['member'] = $this->member_model->get_member($uid,'');
		$this->load->view('viewmember',$data);
		}
		else
		{
	// else only can view own detail
		$data['member'] = $this->member_model->get_member($this->session->userdata('uid'),'');
		$this->load->view('viewmember',$data);
		}
		$this->load->view('footer');
	}
	public function edit($uid)
	{
	// edit member detail
	  $this->load->library('form_validation');
		$data['groupName'] = $this->group_model->get_group();
		$data['title']='Edit Member';
		$this->load->view('header',$data);
		if(($this->session->userdata('su'))=='1'){
		$data['member'] = $this->member_model->get_member($uid,'');
		$this->load->view('editmember',$data);
		}
		else
		{
		$data['member'] = $this->member_model->get_member($this->session->userdata('uid'),'');
		$this->load->view('editmember',$data);
		}
		$this->load->view('footer');
	}
	
	public function newm($msg='')
	{ 	
	// add new member
		$this->load->library('form_validation');
		$data['groupName'] = $this->group_model->get_group();
		$data['title']='Add New Member';
		if($msg!=''){
		$data['msg']=$msg;
		}
		$this->load->view('header',$data);
		if(($this->session->userdata('su'))=='1'){
		$this->load->view('newmember',$data);
		}
		else
		{
		$this->load->view('restricted',$data);
		}
		$this->load->view('footer');
	}
	
	
	
	public function update($uid)
	{
	// update user/member row
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('first_name', 'First Name', 'required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('country', 'Country', 'required');
		if ($this->form_validation->run() == FALSE)
		{
		
		$this->edit($uid);
		}
		else
		{
		if(($this->session->userdata('su'))=='1'){
		$this->member_model->update_member($uid);
		$this->view($uid);
		}
		else
		{
		$this->member_model->update_member($this->session->userdata('uid'));
		$this->view($this->session->userdata('uid'));
		}
		
		}
	
	
	}
	
	
	
	
	
	public function add()
	{
	// insert new row or member/user
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('first_name', 'First Name', 'required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('country', 'Country', 'required');
		if ($this->form_validation->run() == FALSE)
		{
		$this->newm();
		}
		else
		{
		if(($this->member_model->count_email_row($_POST['email']))!='0')
		{
		$msg="Email id already exist!<br>";
		$this->newm($msg);
		return;
		}
		
		if(($this->session->userdata('su'))=='1'){
		$this->member_model->add_member();
		$this->index();
		}
	}
	
	}
	
	
	
	

}

// NOTE: comments on repeating function or code are missing.
		// To get help review previous similar functions or code in same or another files
?>
