<?php
class attempt_model extends CI_Model {

	public function __construct()
	{	
		$this->load->database();
	}
	
	
	public function get_questions_id($test)
	{	
	$noqs=explode(',',$test['random_question_no']);
	$sids=explode(',',$test['subject_ids']);
		
		foreach($noqs as $key => $noq){
		$sid=$sids[$key];
		if($key==0){
		$sql="(select qid from questionBank where sid='$sid' order by rand() LIMIT $noq )";
		}else{
		$sql=$sql."UNION (select qid from questionBank where sid='$sid' order by rand() LIMIT $noq )";
		}
		}
		$query = $this->db->query($sql);
		$questions=$query->result_array();
		
		return $questions;
		
		
	}
	
	
	
	// return single question
	public function get_question($qid)
	{	
	$sql="select * from questionBank where qid='$qid' ";
	$query = $this->db->query($sql);
	$questions=$query->row_array();
	return $questions;
	}
	
	// return multiple questions
	public function get_questions($qids)
	{	
	$sql="select * from questionBank where qid in($qids) ORDER BY FIELD(qid, $qids)  ";
	$query = $this->db->query($sql);
	$questions=$query->result_array();
	return $questions;
	}
	
	
	
	public function get_result($resultid)
	{	
	$sql="select * from result where result_id='$resultid' ";
	$query = $this->db->query($sql);
	$result=$query->row_array();
	return $result;
	}
	
	
	
	
	public function submit_answer($resultid,$qno,$tid,$qid,$posted_answer,$time1)
	{
	$sql="select * from result where result_id='$resultid' ";
	$query1 = $this->db->query($sql);
	$result=$query1->row_array();
	
	// getting correct answer from question
	$sql="select answer from questionBank where qid='$qid' ";
	$query = $this->db->query($sql);
	$answer=$query->row_array();
	
	//compare posted answer with correct answer
	$correct_answer=explode(",",$result['correct_answer']);
	$selected_answers=explode(",",$result['selected_answers']);
	$time_taken=explode(",",$result['time_taken']);
	$time2=(time()-$time1);
	$time_taken[$qno-1]=($time_taken[$qno-1])+$time2;
	if($posted_answer!='NULL'){
	if($posted_answer==$answer['answer']){ $correct_answer[$qno-1]="1"; }else{ $correct_answer[$qno-1]="0"; }
	$selected_answers[$qno-1]=$posted_answer;
	}
	
	$correct_answer=implode(",",$correct_answer);
	$selected_answers=implode(",",$selected_answers);
	$time_taken=implode(",",$time_taken);
	
	// Update result row
	$data = array('correct_answer' => $correct_answer,'selected_answers' => $selected_answers,'time_taken' => $time_taken);
	$this->db->where('result_id', $resultid);
	$this->db->update('result', $data);
			
	}
	
	
	
	
	public function submit_test($resultid,$tid)
	{
	// getting test data
	$sql="select * from test where tid='$tid' ";
	$query1 = $this->db->query($sql);
	$test=$query1->row_array();
		
	// getting result data
	$sql="select * from result where result_id='$resultid' ";
	$query2 = $this->db->query($sql);
	$result=$query2->row_array();
	
	// calculating result
	$correct_answer=$result['correct_answer'];
	$correct_answer=str_replace("2","0",$correct_answer);
	$correct_answer=explode(",",$correct_answer);
	$correctans=array_sum($correct_answer);
	$percentage=($correctans/$result['total_question'])*100;
	if($percentage>=$test['reqpercentage'])
	{
	$status="1";
	}
	else
	{
	$status="0";
	}
	
	// update result row
	$data = array('obtained_percentage' => $percentage,'status' => $status,'submitTime'=>time());
	$this->db->where('result_id', $resultid);
	$this->db->update('result', $data);	
	}
	
	
	
	
	
		public function insert_result_row($test,$qids)
	{
	
	$totq=explode(",",$test['random_question_no']);
	$totqs=array_sum($totq);
	$temp_value=array();
	for($i=0; $i < $totqs; $i++)
	{
	$temp_value[$i]='2';
	}
	$temp_value=implode(",",$temp_value);
	
	$temp_time=array();
	for($j=0; $j < $totqs; $j++)
	{
		$temp_time[$j]='0';
			
	}
	$temp_time=implode(",",$temp_time);
	$uid=$this->session->userdata('uid');
	// insert row
	$data=array('uid'=>$uid,'tid'=>$test['tid'],'total_question'=>$totqs,'correct_answer' => $temp_value,'time_taken' => $temp_time,	'selected_answers' => $temp_value,'question_ids'=>$qids,'status'=>'2','iniTime'=>time());
	$this->db->insert('result', $data); 
		return $this->db->insert_id();
		
		
	}
	
}


?>
