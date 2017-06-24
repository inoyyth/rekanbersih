<?php

class Private_message_model extends CI_Model{
    
    // private message
    function private_message(){
        return $this->db->query("select * from private_message where status='Y' and answered =''");
    }
    
    function get_product_name($product_name){
        $this->load->database('desalite',true);
        return $this->db->query("select product_name from product where id_product='$product_name'");
        $this->db->reconnect();
    }
    
    function get_customer_name($customer_name){
        $this->load->database('desalite',true);
        return $this->db->query("select name from customer where id_customer='$customer_name'");
        $this->db->reconnect();
    }
    
}
