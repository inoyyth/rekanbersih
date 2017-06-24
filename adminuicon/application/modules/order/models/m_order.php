<?php
class M_order extends CI_Model{
    function select_index(){
        $this->db->select('a.*,b.product_category_name,c.brand_name,d.sku');
        $this->db->from('product_general a');
        $this->db->join('product_category b','a.product_category=b.id','left');
        $this->db->join('brand c','a.product_brand=c.id','left');
        $this->db->join('product_detail d','a.id=d.product_general_id','left');
        return $this->db->get();
    }
    
    function select_maxid($table){
       $query=$this->db->query("select max(id) as id from $table");
       return $query->row('id');
    }
    
    function select_maxid2($table,$id){
       $query=$this->db->query("select max($id) as max from $table");
       return $query->row('max');
    }
    
    function select_all($table){
        $this->db->select('*');
        $this->db->from($table);
        return $this->db->get();
    }
        
    function select_where($table,$id){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('id_attributes',$id);
        return $this->db->get();
    }
    
    function select_all_where($table,$where,$id){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($where,$id);
        return $this->db->get();
    }
    
    function insert($table,$data){
        $this->db->insert($table,$data);
        return true;
    }
    
    function update($table,$where,$keywhere,$data){
        $this->db->where($where,$keywhere);
        $this->db->update($table,$data);
        return true;
    }
    
    function delete($table,$where,$keywhere){
        $this->db->where($where,$keywhere);
        $this->db->delete($table);
        return true;
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
