<?php
class member_model extends CI_Model {

	public function __construct()
	{	
		$this->load->database();
		$this->load->helper('string');
		$this->load->library('email');
	}
	public function del_member($uid)
	{
	$this->db->delete('user', array('uid' => $uid)); 
	}
	public function search_member($str)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('user_group', 'user.gid = user_group.gid' );
		$this->db->or_like('user.uid',$str);
		$this->db->or_like('user.email',$str);
		$this->db->or_like('user.first_name',$str);
		$this->db->or_like('user.last_name',$str);
		$this->db->or_like('user.country',$str);
		$this->db->or_like('user_group.group_name',$str);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	
	public function get_member($slug='0', $limit='30')
	{
	if ($slug>="1")
		{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('user_group', 'user.gid = user_group.gid and uid = '.$slug );
		$query = $this->db->get();
		return $query->row_array();
		}
	else{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('user_group', 'user.gid = user_group.gid order by uid DESC LIMIT '.$limit.', 30 ');
		$query = $this->db->get();
		return $query->result_array();
		
		}
	}
	public function update_member($uid)
	{
	if(($this->session->userdata('su'))=='1'){ 
	$data=array('email'=>$_POST['email'],'first_name'=>$_POST['first_name'],'last_name'=>$_POST['last_name'],'contact_no'=>$_POST['contact_no'],'address'=>$_POST['address'],'country'=>$_POST['country'],'gid'=>$_POST['gid'],'status'=>$_POST['status'],'su'=>$_POST['su'],'credit'=>$_POST['credit']);
	}
	else
	{
	$data=array('email'=>$_POST['email'],'first_name'=>$_POST['first_name'],'last_name'=>$_POST['last_name'],'contact_no'=>$_POST['contact_no'],'address'=>$_POST['address'],'country'=>$_POST['country'],'gid'=>$_POST['gid']);
	}
	$this->db->where('uid', $uid);
	$this->db->update('user', $data); 
	
	if($_POST['password']!=""){
	$pass=md5($_POST['password']);
	$data=array('password'=>$pass);
	$this->db->where('uid', $uid);
	$this->db->update('user', $data); 
	}
	
	}
	
public function add_member($email_subject='',$email_msg='')
	{
	if(!isset($_POST['password'])){
	$password=random_string('alnum', 8);
	$pass=md5($password);
	$this->email->from($this->config->item('admin_email'), $this->config->item('admin_email'));
	$this->email->to($_POST['email']);
	$this->email->subject($email_subject);
	$email_msg=str_replace("[last_name]",$_POST['last_name'],$email_msg);
	$email_msg=str_replace("[randomily_generated]",$password,$email_msg);
	$this->email->message($email_msg);
	$this->email->send();
	}
	else
	{
	$pass=md5($_POST['password']);
	}
	$data=array('email'=>$_POST['email'],'password'=>$pass,'first_name'=>$_POST['first_name'],'last_name'=>$_POST['last_name'],'contact_no'=>$_POST['contact_no'],'address'=>$_POST['address'],'country'=>$_POST['country'],'gid'=>$_POST['gid'],'status'=>$_POST['status'],'su'=>$_POST['su'],'credit'=>$_POST['credit']);
	$this->db->insert('user', $data); 
	
	}
	
	public function count_email_row($email='0')
	{
	$sql="select * from user where email='$email' ";
	$query = $this->db->query($sql);
	$numrows=$query->num_rows();
	return $numrows;
	}
	public function count_row($email='0',$password='0')
	{
	$password=md5($password);
	$sql="select * from user where email='$email' and password='$password' ";
	$query = $this->db->query($sql);
	$numrows=$query->num_rows();
		if($numrows=="1")
		{
	$sql="select * from user where email='$email' and password='$password' ";
	$query = $this->db->query($sql);
	$userData=$query->row_array();
	return $userData;
		}
		else
		{
		return "FALSE";
		}
	}
	
}



                                  
              
                                                                     
                               
 
?>
