<?php

class Main_model extends CI_Model{
    
    function select_all($table){
        $this->db->select('*');
        $this->db->from($table);
        return $this->db->get();
    }
    
    function select_where($table,$where,$id){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($where,$id);
        return $this->db->get();
    }
    
    function insert($table,$data){
        $this->db->insert($table,$data);
        return true;
    }
    
    function update($table,$where,$id,$data){
        $this->db->where($where,$id);
        $this->db->update($table,$data);
    }
    
    function delete($table,$where,$id){
        $this->db->where($where,$id);
        $this->db->delete($table);
    }
    
    function sys_date(){
        $date = gmdate("Y-m-d H:i:s", time()+60*60*7);
        return $date;
    }
    
    function sys_user(){
        $user = $this->session->userdata('logged_in');
        $userx=$user['user_id'];
        return $userx;
    }
    
    function user_activity_create(){
        $mergefield= array("sys_create_user"=>$this->session->userdata('logged_in'),"sys_create_date"=>date("Y-m-d H:i:s"));
        return $mergefield;
    }
    
    function user_activity_update(){
        $mergefield= array("sys_update_user"=>$this->session->userdata('logged_in'),"sys_update_date"=>date("Y-m-d H:i:s"));
        return $mergefield;
    }
    
    public function handler0($ses,$searchterm)
    {
            if($searchterm)
            {
                    $this->session->set_userdata($ses, $searchterm);
                    return $searchterm;
            }
            elseif($this->session->userdata($ses))
            {
                    $searchterm = $this->session->userdata($ses);
                    return $searchterm;
            }
            else
            {
                    $searchterm ="";
                    return $searchterm;
            }
    }
    
}
