<?php
class attemptTest extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('test_model');
		$this->load->model('attempt_model');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->library('session');
	// if not logged in redirect
		if(($this->session->userdata('logged_in'))!='TRUE'){ redirect('login'); } 
	}
	public function index($tid='',$access_token='0')
	{	
	
	
		$this->load->helper('cookie');
		$this->load->library('form_validation');
		
	// if test cookies exist bypass to getquestion function
		if(isset($_COOKIE['tid']) && isset($_COOKIE['qids']) && isset($_COOKIE['resultid']) && isset($_COOKIE['qno']) && isset($_COOKIE['access_token']))
		{
			$this->getquestion($_COOKIE['qno'],$_COOKIE['qids'],$_COOKIE['tid']);		
		}
		else
			{
	// else started new test so check access token cookie exist for test	if not redirect
			if(!isset($_COOKIE['access_token'])){
			redirect('test/view/'.$tid);
			}
	// getting test data
			$data['test'] = $this->test_model->get_test($tid,'0');
	// getting multi dimensonal arrays of question ids which are going to assign user
			$data['qids'] = $this->attempt_model->get_questions_id($data['test']);
	// make one dimensonal array
			$qid=array();
			foreach($data['qids'] as $question)
			{
			$qid[]=$question['qid'];	
			}
	// convert array into string
			$qids=implode(",",$qid);
	// insert result row
			$data['resultid']=$this->attempt_model->insert_result_row($data['test'],$qids); 
	// creating required cookies
			$cookie = array('name'=>'resultid','value'=>$data['resultid'],'expire'=>'86500'); 
			$this->input->set_cookie($cookie); 
			$cookie = array('name'=>'qids','value'=>$qids,'expire'=>'86500'); 
			$this->input->set_cookie($cookie); 
			$cookie = array('name'=>'tid','value'=>$data['test']['tid'],'expire'=>'86500'); 
			$this->input->set_cookie($cookie); 
			$cookie = array('name'=>'qno','value'=>'0','expire'=>'86500'); 
			$this->input->set_cookie($cookie); 
			$this->getquestion('0',$qids,$tid,$data['resultid']);
			}
	}
	
	public function getquestion($qno=0,$qids=0,$tid=0,$resultid=0)
	{
	if(!isset($_COOKIE['access_token'])){
			redirect('index');
			}
	$this->load->helper('cookie');
	$this->load->library('form_validation');
	
	
	
	//define question ids
	if(isset($_COOKIE['qids'])){
	$qids=$_COOKIE['qids'];
	}else{
	$qids=$qids;
	}
	$eqid=explode(",",$qids);
	
	//define test id
	if(isset($_COOKIE['tid'])){
	$tid=$_COOKIE['tid'];
	}else{
	$tid=$tid;
	}
	
	if(isset($_COOKIE['resultid'])){
	$resultid=$_COOKIE['resultid'];
	}
	$iniTime = $this->attempt_model->get_result($resultid);
	$test_time = $this->test_model->get_test($tid,'0');
	// check time

	if(((($test_time['test_time']*60)-(time()-$iniTime['iniTime']))<="0") || ((time())>($test_time['end_time']))){
	$this->submit('Time Over');
		return;
		
	}
	
	// define question no.
	if(isset($_POST['qno'])){ 
	$qno=$_POST['qno'];
	
	$pqid=$eqid[$qno-1];
	if(isset($_POST['answer'])){
	$answer=$_POST['answer'];
	$time1=$_POST['time1'];
	}else{ $answer='NULL'; $time1=$_POST['time1']; }
	$this->attempt_model->submit_answer($_COOKIE['resultid'],$qno,$_COOKIE['tid'],$pqid,$answer,$time1);
	}
	
	if(isset($_POST['submitTest']))
	{
		if($_POST['submitTest']=='1')
		{
		$this->submit();
		return;
		}
	}
	
	// next question
	if(isset($_POST['direction']))
	{ 
	// if direction is for next question add one
	if($_POST['direction']=='N'){ 
	$data['qno']=$qno+1; $qid=$eqid[$qno]; 
	}
	else
	{ 
	// else subtract one
	$data['qno']=$qno-1; 
	$qid=$eqid[$qno-2]; 
	}
	}
	else{
	$data['qno']=$qno+1;
	$qid=$eqid[$qno];
	}

	// getting earlier submitted answer if any
	$data['result'] = $this->attempt_model->get_result($resultid);
	// getting test data
	$data['test'] = $this->test_model->get_test($tid,'0');
	// getting question data
	$data['question'] = $this->attempt_model->get_question($qid);
	// load header page
	$this->load->view('header_attemptTest.php',$data);
	// load attempt test body page
	$this->load->view('attemptTest',$data);
	// load footer
	$this->load->view('footer');
	// update cookies with question number
	$cookie = array('name'=>'qno','value'=>$data['qno'],'expire'=>'86500'); 
	$this->input->set_cookie($cookie); 
	}
	
	
	public function submit($msg='')
	{	
		$this->load->helper('cookie');
		$this->attempt_model->submit_test($_COOKIE['resultid'],$_COOKIE['tid']);
	// page title meassage
		$data['title']="Test Submitted";
		$data['msg']=$msg;
		$data['resultid']=$_COOKIE['resultid'];
		$this->load->view('header.php',$data);
		$this->load->view('submitTest',$data);
		$this->load->view('footer');
	// unset test cookies
			$cookie = array('name'=>'resultid','value'=>'','expire'=>'1'); 
			$this->input->set_cookie($cookie); 
			$cookie = array('name'=>'qids','value'=>'','expire'=>'1'); 
			$this->input->set_cookie($cookie); 
			$cookie = array('name'=>'tid','value'=>'','expire'=>'1'); 
			$this->input->set_cookie($cookie); 
			$cookie = array('name'=>'qno','value'=>'','expire'=>'1'); 
			$this->input->set_cookie($cookie); 
			$cookie = array('name'=>'access_token','value'=>'','expire'=>'1'); 
			$this->input->set_cookie($cookie); 
			
		
	}
}
?>
