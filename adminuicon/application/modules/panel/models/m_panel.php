<?php
class M_panel extends CI_Model{
    
	function login($username,$password){
	$key=array('username' =>$username,'password' => md5($password));
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where($key);
		$query = $this->db->get();
		if($query->num_rows() ==1)
		{
		return $query->result();
		}
		else
		{
		return false;
		}
	}
    
    function count($table){
        return $this->db->query("select count(*) as jum from $table")->row();
    }
    function count_article($table){
        return $this->db->query("select count(*) as jum from $table")->row();
    }
	
}