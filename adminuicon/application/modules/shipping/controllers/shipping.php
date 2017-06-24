<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shipping extends MX_Controller{
    public function __construct() {
        parent::__construct();
       if($this->session->userdata('logged_in')==false){
           redirect('login');    
       }
    $this->load->model('m_shipping');
    }
    
    function index(){
        $data['shipping']=$this->db->query("select * from shipping where id='1'")->row();
        $data['view']="main";
        $this->load->view("template",$data);
    }
    
    function update_proses(){
        if(!isset($_POST)){
            show_404();
        }else{
            $shipping=$this->input->post('shipping');
            $this->db->query("TRUNCATE TABLE shipping");
            $this->db->query("INSERT INTO shipping set shipping_address='$shipping'");
            redirect('shipping');
        }
    }
}