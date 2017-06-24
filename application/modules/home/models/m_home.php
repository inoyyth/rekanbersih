<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_home extends MX_Controller{
    public function __construct() {
        parent::__construct();
        
    }
    
    public function getData($table,$where,$field_order,$order,$limit){
        $this->db->select("*");
        $this->db->from($table);
        $this->db->where($where);
        $this->db->order_by($field_order,$order);
        $this->db->limit($limit);
        return $this->db->get(0,$limit);
    }
}