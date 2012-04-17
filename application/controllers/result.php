<?php
class result extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('result_model');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('email');
	// if not logged in redirect
		if(($this->session->userdata('logged_in'))!='TRUE'){ redirect('login'); }
		
	}
	public function index($limit = 0)
	{	
	// getting result rows
		$data['result'] = $this->result_model->get_result('0',$limit);
		$data['title']='Result';
		$data['limit']=$limit;
		$this->load->view('header',$data);
		$this->load->view('result',$data);
		$this->load->view('footer');
	}
	public function search($str)
	{	
	// getting result rows of searched string
		$data['result'] = $this->result_model->search_result($str);
		$data['title']='Result';
		$this->load->view('header',$data);
	// only if logged in user is admin
		if(($this->session->userdata('su'))=='1'){
		$this->load->view('result',$data);
		}
		else
		{
		$this->load->view('restricted',$data);
		}
		$this->load->view('footer');
	}
	
	public function del($resultid)
	{
	// delete result record
		if(($this->session->userdata('su'))=='1'){
		$this->result_model->del_result($resultid);
		}
		$this->index();
	}
	
	public function view($resultid,$emailsend='')
	{	
	// view result dtail
	
		$data['result'] = $this->result_model->get_result($resultid,'0');
		$data['title']='Result';
		$this->load->view('header',$data);
		
		
		if((($this->session->userdata('uid'))==$data['result']['uid']) || (($this->session->userdata('su'))=='1')){
		// if admin allow result send in email in config file and if user requested to email
			if(($this->config->item('email_result')=="yes") && $emailsend=="email")
			{
		// creating result status
			if($data['result']['status']=="1"){ $status="Passed"; }else{ $status="Failed"; }
		// preparing email variables
			$email_subject="Result Detail";
			$email_msg="Dear ".$data['result']['last_name'].",\n\n";
			$email_msg.="Your have ".$status." the test ".$data['result']['test_name']."\n";
			$email_msg.="Your obtained ".$data['result']['obtained_percentage']." % \n\n";
			$email_msg.="Thanks,\n\n";
			$email_to=$this->session->userdata('email');
			$email_from=$this->config->item('admin_email');	
			$this->email->from($email_from, $email_from);
			$this->email->to($email_to);
			$this->email->subject($email_subject);
			$this->email->message($email_msg);
		// send email
			$this->email->send();
			$data['msg']="Result sent to email!<br>";
			}
		
		$this->load->view('viewresult',$data);
		if($this->config->item('graph')=="yes"){
		$this->load->view('ColumnChart',$data);
		}
		
		
		}
		else
		{
		$this->load->view('restricted',$data);
		}
		
		$this->load->view('footer');
		
		
	}
	
}

// NOTE: comments on repeating function or code are missing.
		// To get help review previous similar functions or code in same or another files
?>
