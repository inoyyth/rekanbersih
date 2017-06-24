<?php
class M_editorpick extends CI_Model{
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
    
    public function search_record_count($id_sr,$name_sr,$status_sr)
	{
		return $this->db->query("select * from attributes where id LIKE '%$id_sr%' and attributes_name LIKE '%$name_sr%' and status LIKE '%$status_sr%'")->num_rows();
		
	}
	
	public function search($id_sr,$name_sr,$status_sr,$limit)
	{
		return $this->db->query("select * from attributes where id LIKE '%$id_sr%' and attributes_name LIKE '%$name_sr%' and status LIKE '%$status_sr%' limit ".$limit.",2")->result();
		
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

