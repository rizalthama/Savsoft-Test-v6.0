<?php
class qbank_model extends CI_Model {

	public function __construct()
	{	
		$this->load->database();
	}
	public function del_question($qid)
	{
	$this->db->select('sid');
	$this->db->from('questionBank');
	$this->db->where('qid',$qid);
	$query=$this->db->get();
	$sid=$query->row_array();
	$this->db->delete('questionBank', array('qid' => $qid));
	$this->db->set('noq', 'noq-1', FALSE);
	$this->db->where('sid', $sid['sid']);
	$this->db->update('subject');  
	}
	public function search_question($str)
	{
		$this->db->select('*');
		$this->db->from('questionBank');
		$this->db->join('subject', 'questionBank.sid = subject.sid' );
		$this->db->or_like('questionBank.qid',$str);
		$this->db->or_like('questionBank.question',$str);
		$this->db->or_like('subject.subject_Name',$str);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	
	public function get_question($slug, $limit)
	{
	if ($slug>="1")
		{
		$this->db->select('*');
		$this->db->from('questionBank');
		$this->db->join('subject', 'questionBank.sid = subject.sid and qid = '.$slug );
		$query = $this->db->get();
		return $query->row_array();
		}
	else{
		$this->db->select('*');
		$this->db->from('questionBank');
		$this->db->join('subject', 'questionBank.sid = subject.sid order by qid DESC LIMIT '.$limit.', 30 ');
		$query = $this->db->get();
		return $query->result_array();
		
		}
	}
	public function update_question($qid)
	{
	$option=array_filter($_POST['option']);
	$option=implode(",",$option);
	$answer=$_POST['answer'];
	foreach($_POST['option'] as $key => $opt)
		{
			if($key==$answer)
					{ 
					$ans=$opt; 
					}
		}
	// update question
	
	$data=array('question'=>$_POST['question'],'answer'=>$ans,'options'=>$option,'sid'=>$_POST['sid']);
	$this->db->where('qid', $qid);
	$this->db->update('questionBank', $data); 
	// update no. of question in subject db table AND only update if subject id is changed, osid is old subject d and sid is updated subject id 
	if($_POST['osid']!=$_POST['sid']){
	$this->db->set('noq', 'noq+1', FALSE);
	$this->db->where('sid', $_POST['sid']);
	$this->db->update('subject');
	$this->db->set('noq', 'noq-1', FALSE);
	$this->db->where('sid', $_POST['osid']);
	$this->db->update('subject');
	}
	
	}
	
public function add_question()
	{
	$option=array_filter($_POST['option']);
	$option=implode(",",$option);
	$answer=$_POST['answer'];
	foreach($_POST['option'] as $key => $opt)
		{
			if($key==$answer)
					{ 
					$ans=$opt; 
					}
		}
	// insert question
	$data=array('question'=>$_POST['question'],'answer'=>$ans,'options'=>$option,'sid'=>$_POST['sid']);
	$this->db->insert('questionBank', $data); 
	// update no. of question in subject db table
	$this->db->set('noq', 'noq+1', FALSE);
	$this->db->where('sid', $_POST['sid']);
	$this->db->update('subject'); 
	}
	
}


?>
