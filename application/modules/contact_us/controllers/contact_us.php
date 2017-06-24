<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact_us extends MX_Controller{
    public function __construct() {
        parent::__construct();
        
        $this->load->model('main_model');
    }
        
    function index(){
        //adds query
        $data['data']=$this->db->query("select * from contact")->row_array();
        $data['view']="main";
        $this->load->view('template',$data);
    }
}