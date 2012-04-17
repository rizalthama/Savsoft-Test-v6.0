<?php
class test_model extends CI_Model {

	public function __construct()
	{	
		$this->load->database();
		$this->load->model('member_model');
		
	}
	public function del_test($tid)
	{
		$this->db->delete('test', array('tid' => $tid)); 
	}
	public function search_test($str)
	{
	
		$this->db->select('*');
		$this->db->from('test');
		$this->db->or_like('test_name',$str);
		$this->db->or_like('tid',$str);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	
	public function get_test($slug='0', $limit='30')
	{
	if ($slug>="1")
		{
		$this->db->select('*');
		$this->db->from('test');
		$this->db->where('tid = '.$slug );
		$query = $this->db->get();
		return $query->row_array();
		}
	else{
		if(($this->session->userdata('su'))!='1'){
		$member = $this->member_model->get_member($this->session->userdata('uid'),'');
		$gid=$member['gid'];
		$query = $this->db->get('test');
		$testData=$query->result_array();
		$tid=array();
		$i=0;
		foreach($testData as $testData)
		{
		$group_id=explode(",",$testData['group_id']);
		
		if(in_array($gid, $group_id)){
		$tid[$i]=$testData['tid'];
		$i+=1;
		}
		
		}
		
		$this->db->where_in('tid', $tid);

		}
		$this->db->order_by("tid", "desc");
		$query = $this->db->get('test','30',$limit);
		return $query->result_array();
		
		}
	}
	public function update_test($tid)
	{
	$start_time=strtotime($_POST['start_time']." ".$_POST['Shour'].":".$_POST['Sminute']." ".$_POST['Sampm']);
	$end_time=strtotime($_POST['end_time']." ".$_POST['Ehour'].":".$_POST['Eminute']." ".$_POST['Eampm']);
	$group_id=implode(",",$_POST['gid']);
	$noq=array_filter($_POST['noq']);
	$random_question_no=implode(",",$noq);
	$sid=array_filter($_POST['sid']);
	$subject_ids=implode(",",$sid);
	$data=array('test_name'=>$_POST['test_name'],'description'=>$_POST['description'],'test_time'=>$_POST['test_time'],'start_time'=>$start_time,'end_time'=>$end_time,'group_id'=>$group_id,'type'=>$_POST['type'],'amount'=>$_POST['amount'],'answer_view'=>$_POST['answer_view'],'attempts'=>$_POST['attempts'],'random_question_no'=>$random_question_no,'subject_ids'=>$subject_ids);
	$this->db->where('tid', $tid);
	$this->db->update('test', $data); 
		
	}
	
public function add_test()
	{
	$start_time=strtotime($_POST['start_time']." ".$_POST['Shour'].":".$_POST['Sminute']." ".$_POST['Sampm']);
	$end_time=strtotime($_POST['end_time']." ".$_POST['Ehour'].":".$_POST['Eminute']." ".$_POST['Eampm']);
	$group_id=implode(",",$_POST['gid']);
	$noq=array_filter($_POST['noq']);
	$random_question_no=implode(",",$noq);
	$sid=array_filter($_POST['sid']);
	$subject_ids=implode(",",$sid);
	$data=array('test_name'=>$_POST['test_name'],'description'=>$_POST['description'],'test_time'=>$_POST['test_time'],'start_time'=>$start_time,'end_time'=>$end_time,'group_id'=>$group_id,'type'=>$_POST['type'],'amount'=>$_POST['amount'],'answer_view'=>$_POST['answer_view'],'attempts'=>$_POST['attempts'],'random_question_no'=>$random_question_no,'subject_ids'=>$subject_ids);
	$this->db->insert('test', $data); 
	return $this->db->insert_id();
	}
	
}


?>
