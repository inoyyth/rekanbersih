<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends MX_Controller{
    public function __construct() {
        parent::__construct();
        if($this->session->userdata('logged_in_admin')==false){
            redirect('login');    
        }
        $this->load->model('main_model');
    }
        
    function index(){
        $data['detail']=$this->db->query("select * from contact where id='1'")->row();
        $data['view']="main";
        $this->load->view("template",$data);
    }
    
    function image_browse(){
        $this->load->view("image_browse");
    }
    
    function update_proses(){
        $company=$this->input->post('company');
        $owner=$this->input->post('owner');
        $address=$this->input->post('address');
        $telephone=$this->input->post('telephone');
        $email=$this->input->post('email');
        $office_hour=$this->input->post('office_hour');
        $map=$this->input->post('map');
        $image=$this->input->post('image');
        $description=$this->input->post('description');
        
        $data=array(
            'company'=>$company,
            'owner'=>$owner,
            'address'=>$address,
            'telephone'=>$telephone,
            'email'=>$email,
            'office_hour'=>$office_hour,
            'map'=>$map,
            'image'=>$image,
            'description'=>$description
        );
        $this->main_model->update("contact","id","1",$data);
    
        redirect('contact/index');
    }
}