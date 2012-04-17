<?php
class test extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('test_model');
		$this->load->model('group_model');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->library('javascript');
		$this->load->library('session');
		$this->load->model('member_model');
	// if not logged in redirect
		if(($this->session->userdata('logged_in'))!='TRUE'){ redirect('login'); }
	}
	public function index($limit = 0)
	{	
// getting tests list as array
		$data['test'] = $this->test_model->get_test('0',$limit);
		$data['title']='Tests / Quiz';
		$data['limit']=$limit;
		$this->load->view('header',$data);
		$this->load->view('test',$data);
		$this->load->view('footer');
	}
	public function search($str)
	{	
// getting tests list of searched atring
		$data['test'] = $this->test_model->search_test($str);
		$data['title']='Test / Quiz';
		$this->load->view('header',$data);
		if(($this->session->userdata('su'))=='1'){
		$this->load->view('test',$data);
		}
		else
		{
		$this->load->view('restricted',$data);
		}
		$this->load->view('footer');
	}
	
	public function del($tid)
	{
// delete test
		if(($this->session->userdata('su'))=='1'){
		$this->test_model->del_test($tid);
		}
		$this->index($limit = 0);
	}
	
	public function view($tid='0')
	{
// view test detail	
		$this->load->helper('cookie');
		$this->load->helper('string');
		$this->load->model('subject_model');
		$this->load->model('result_model');
// generate access token by random string function which is required for next page or attempt test page
		$data['access_token']=random_string('alnum', 16);
// getting subjects list
		$data['subjectname'] = $this->subject_model->get_subject();
// getting test detail by test id (tid)
		$data['test'] = $this->test_model->get_test($tid,'');
// getting group detail
		$data['groupname'] = $this->group_model->get_group();
// count number of attempts has been done by user
		$data['noattempts'] = $this->result_model->count_result_row($tid,$this->session->userdata('uid'));
// getting logged in user/member data
		$member = $this->member_model->get_member($this->session->userdata('uid'),'');
		
		$gid=$member['gid'];
		$credit=$member['credit'];
		$testAmount=$data['test']['amount'];
		$data['msg']="";
		$data['startButton']=1; // default
		// check user credit
		if($credit<$testAmount){
		$data['startButton']=0;
		$data['msg'].="You do not have enough credit to access this test!<br/>";
		}
		
		// check no of attempts
		if($data['noattempts']>=$data['test']['attempts'])
		{
		$data['startButton']=0;
		$data['msg'].="You have exceeded the number of attempts!<br/>";
		}
		
		// check start time 
		if((time())<($data['test']['start_time'])){
		$data['startButton']=0;
		$data['msg'].="Test is not available yet!<br/>";
		}
		
		// check end time
		if((time())>=($data['test']['end_time'])){
		$data['startButton']=0;
		$data['msg'].="Test time has been passed!<br/>";
		}
		
		
		$data['title']='Test / Quiz';
		$this->load->view('header',$data);
		$group_id=explode(",",$data['test']['group_id']);
		if((in_array($gid, $group_id)) || ($this->session->userdata('su')=='1')){
		
		if(($data['startButton']=='1') || ($this->session->userdata('su')=='1')){
		$cookie = array('name'=>'access_token','value'=>$data['access_token'],'expire'=>'86500'); 
		$this->input->set_cookie($cookie);
		 }
		 
		$this->load->view('viewtest',$data);
		}
		else
		{
		$this->load->view('restricted',$data);
		}
		$this->load->view('footer');
	}
	public function edit($tid)
	{ 
	// edit test
	
	$this->load->library('form_validation');
		$this->load->model('subject_model');
		$data['subjectname'] = $this->subject_model->get_subject();
		$data['test'] = $this->test_model->get_test($tid,'');
		$data['groupname'] = $this->group_model->get_group();
		$data['title']='Edit Test';
		$this->load->view('header',$data);
 // only if logged in user is admin
		if(($this->session->userdata('su'))=='1'){
		$this->load->view('edittest',$data);
		}
		else
		{
		$this->load->view('restricted',$data);
		}
		$this->load->view('footer');
	}
	
	public function newt()
	{ 
	// edit test
		$this->load->library('form_validation');
		$this->load->model('subject_model');
		$data['subjectname'] = $this->subject_model->get_subject();
		$data['groupname'] = $this->group_model->get_group();
		$data['title']='Add New Test';
		$this->load->view('header',$data);
	// only if logged in user is admin
		if(($this->session->userdata('su'))=='1'){
		$this->load->view('newtest',$data);
		}
		else
		{
		$this->load->view('restricted',$data);
		}
		$this->load->view('footer');
	}
	
	public function update($tid)
	{
	// update test row
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('test_name', 'Test Name', 'required');
		if ($this->form_validation->run() == FALSE)
		{
		$this->edit($tid);
		}
		else
		{
		// only if logged in user is admin
		if(($this->session->userdata('su'))=='1'){
		$this->test_model->update_test($tid);
		}
		$this->view($tid);
		}
	
	
	}
	
	
	
	
	
	public function add()
	{
	// insert test row
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('test_name', 'Test Name', 'required');
		if ($this->form_validation->run() == FALSE)
		{
		$this->newt();
		}
		else
		{
		// only if logged in user is admin
		if(($this->session->userdata('su'))=='1'){
		$tid=$this->test_model->add_test();
		}
		$this->view($tid);
		}
	
	
	}
	
}

// NOTE: comments on repeating function or code are missing.
		// To get help review previous similar functions or code in same or another files
?>
