<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bannerfix extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('logged_in') == false) {
            redirect('login');
        }
        $this->load->model('m_bannerfix');
        $this->load->model('main_model');
    }
    
    function image_browse(){
        $this->load->view("image_browse");
    }

    public function index() {
        $data['data']=$this->db->query("select * from bannerfix order by bannerfix_id desc")->result();
        $data['view'] = 'main';
        $this->load->view('template', $data);
    }

    public function add() {
        $data['view'] = 'add';
        $this->load->view('template', $data);
    }

    public function add_proses() {
        
        $banner_title = $this->input->post('banner_title');
        $banner_link = $this->input->post('banner_link');
        $banner_url = $this->input->post('banner_url');
        $banner_image=$this->input->post('banner_image');
        $banner_target=$this->input->post('banner_target');
        
        $data = Array(
            'bannerfix_title' => $banner_title,
            'bannerfix_title_link' => $banner_link,
            'bannerfix_url' => $banner_url,
            'bannerfix_image' => $banner_image,
            'bannerfix_target' => $banner_target,
            'bannerfix_date_insert' => date('Y-m-d H:i:s'),
        );
        
        $this->db->insert("bannerfix",$data);
        
        redirect("bannerfix/");
        
    }

    public function update($id) {
        $data['detail']=$this->db->query("select * from bannerfix where bannerfix_id='$id'")->row();
        $data['view'] = 'edit';
        $this->load->view('template', $data);
        
    }

    public function update_proses() {
        
        $id=$this->input->post('id');
        $banner_title = $this->input->post('banner_title');
        $banner_link = $this->input->post('banner_link');
        $banner_url = $this->input->post('banner_url');
        $banner_image=$this->input->post('banner_image');
        $banner_target=$this->input->post('banner_target');
        
        $data = Array(
            'bannerfix_title' => $banner_title,
            'bannerfix_title_link' => $banner_link,
            'bannerfix_url' => $banner_url,
            'bannerfix_image' => $banner_image,
            'bannerfix_target' => $banner_target,
            'bannerfix_date_insert' => date('Y-m-d H:i:s'),
        );
        
        $this->main_model->update("bannerfix","bannerfix_id",$id,$data);
        
        redirect("bannerfix/");
    }

    function delete($id) {
        $this->main_model->delete("bannerfix","bannerfix_id",$id);
        redirect("bannerfix/");
    }

}
