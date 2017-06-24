<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email_setting extends MX_Controller{
    public function __construct() {
        parent::__construct();
        if($this->session->userdata('logged_in')==false){
            redirect('login');    
        }
        $this->load->model('main_model');
    }
        
    function index(){
        $data['detail']=$this->db->query("select * from email_setting where id='1'")->row();
        $data['view']="main";
        $this->load->view("template",$data);
    }
    
    function image_browse(){
        $this->load->view("image_browse");
    }
    
    function update_proses(){
        $logo=$this->input->post('image');
        $header=$this->input->post('header');
        $footer=$this->input->post('footer');
        
        $data=array(
            'logo'=>$logo,
            'header'=>$header,
            'footer'=>$footer
        );
        $this->main_model->update("email_setting","id","1",$data);
    
        redirect('email_setting/index');
    }
}