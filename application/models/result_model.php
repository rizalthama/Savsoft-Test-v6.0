<?php
class result_model extends CI_Model {

	public function __construct()
	{	
		$this->load->database();
	}
	public function del_result($result_id)
	{
	$this->db->delete('result', array('result_id' => $result_id));
	}
	public function search_result($str)
	{
		$this->db->select('*');
		$this->db->from('result');
		$this->db->join('test', 'result.tid = test.tid' );
		$this->db->or_like('result.result_id',$str);
		$this->db->or_like('result.tid',$str);
		$this->db->or_like('test.test_name',$str);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	
	public function get_result($result_id, $limit)
	{
	if ($result_id>="1")
		{
		$sql="select result.*,test.*,user.first_name,user.last_name,user.uid from result,test,user where result.tid = test.tid and result_id = '$result_id' and result.uid = user.uid  ";
		$query = $this->db->query($sql);
		return $query->row_array();
		}
	else{
		$this->db->select('*');
		$this->db->from('result');
		if(($this->session->userdata('su'))=='1'){
		$this->db->join('test', 'result.tid = test.tid order by result_id DESC LIMIT '.$limit.', 30 ');
		}
		else
		{
		$uid=$this->session->userdata('uid');
		$this->db->join('test', 'result.tid = test.tid and result.uid='.$uid.' order by result_id DESC LIMIT '.$limit.', 30 ');
		}
		$query = $this->db->get();
		return $query->result_array();
		
		}
	}
	
	
	public function count_result_row($tid,$uid)
	{
	$sql="select * from result where uid='$uid' and tid='$tid' ";
	$query = $this->db->query($sql);
	$numrows=$query->num_rows();
	return $numrows;
	}
	
}


?>
