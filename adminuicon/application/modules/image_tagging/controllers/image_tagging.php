<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Image_tagging extends MX_Controller{
    public function __construct() {
        parent::__construct();
        if($this->session->userdata('logged_in')==false){
            redirect('login');    
        }
        //$this->load->model('m_image_tagging');
    }
    
    function index(){
        $data['view']="main";
        $this->load->view("template",$data);
    }
}