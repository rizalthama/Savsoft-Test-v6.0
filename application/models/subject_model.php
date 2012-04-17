<?php
class subject_model extends CI_Model {

	public function __construct()
	{	
		$this->load->database();
	}
	
	public function del_subject($sid)
	{
	$this->db->delete('subject', array('sid' => $sid)); 
	}
	
	
	public function get_subject($sid = FALSE)
	{
	if ($sid === FALSE)
		{
		$this->db->select('*');
		$this->db->from('subject');
		//$this->db->join('subject', 'questionBank.sid = subject.sid');
		$query = $this->db->get();
		return $query->result_array();
		}
	
		$this->db->select('*');
		$this->db->from('subject');
		$this->db->where('sid',$sid);
		//$this->db->join('subject', 'questionBank.sid = subject.sid and qid = '.$slug );
		$query = $this->db->get();
		return $query->row_array();
	}
	
	
	public function search_subject($str)
	{
		$this->db->select('*');
		$this->db->from('subject');
		$this->db->or_like('subject.sid',$str);
		$this->db->or_like('subject.subject_Name',$str);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	
	
public function add_subject()
	{
	
	$data=array('subject_Name'=>$_POST['subject_Name']);
	$this->db->insert('subject', $data); 
	
	}	
	
public function update_subject($sid)
	{
	
	$data=array('subject_Name'=>$_POST['subject_Name']);
	$this->db->where('sid', $sid);
	$this->db->update('subject', $data); 
	
	}	
	
	
	
}


?>
