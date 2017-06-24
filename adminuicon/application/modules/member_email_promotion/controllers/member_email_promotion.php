<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member_email_promotion extends MX_Controller{
    public function __construct() {
        parent::__construct();
    if($this->session->userdata('logged_in')==false){
            redirect('login');    
       }
        $this->load->model('main_model');
    }
        
    function index(){
        $data['detail']=$this->db->query("select * from member_email_promotion where id='1'")->row();
        $data['view']="main";
        $this->load->view("template",$data);
    }
    
    function update_email_member_promotion(){
        $isi_email=$this->input->post('isi_email');
        $data=array('email_value'=>$isi_email);
        $this->main_model->update("member_email_promotion","id","1",$data);
        redirect("member_email_promotion/index");
    }
}