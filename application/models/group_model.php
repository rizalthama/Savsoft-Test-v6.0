<?php
class group_model extends CI_Model {

	public function __construct()
	{	
		$this->load->database();
	}
	
	
	public function del_group($gid)
	{
	$this->db->delete('user_group', array('gid' => $gid)); 
	}
	
	
	public function get_group($gid = FALSE)
	{
	if ($gid === FALSE)
		{
		$this->db->select('*');
		$this->db->from('user_group');
		//$this->db->join('subject', 'questionBank.sid = subject.sid');
		$query = $this->db->get();
		return $query->result_array();
		}
	
		$this->db->select('*');
		$this->db->where('gid',$gid);
		$this->db->from('user_group');
		//$this->db->join('subject', 'questionBank.sid = subject.sid and qid = '.$slug );
		$query = $this->db->get();
		return $query->row_array();
	}

	public function search_group($str)
	{
		$this->db->select('*');
		$this->db->from('user_group');
		$this->db->or_like('user_group.gid',$str);
		$this->db->or_like('user_group.group_name',$str);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	
	
public function add_group()
	{
	
	$data=array('group_name'=>$_POST['group_name']);
	$this->db->insert('user_group', $data); 
	
	}	
	
public function update_group($gid)
	{
	
	$data=array('group_name'=>$_POST['group_name']);
	$this->db->where('gid', $gid);
	$this->db->update('user_group', $data); 
	
	}	
	
	
	
}


?>
