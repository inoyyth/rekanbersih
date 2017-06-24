<?php
class M_login extends CI_Model{
    
	function login($username,$password){
	$key=array('username' =>$username,'password' => md5($password));
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where($key);
                $this->db->limit(1);
		//get query and processing
        $query = $this->db->get();
        if($query->num_rows() == 1) {
            return $query->result(); //if data is true
        } else {
            return false; //if data is wrong
        }
    }
}