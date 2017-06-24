<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Justin_banner extends MX_Controller{
    public function __construct() {
        parent::__construct();
        if($this->session->userdata('logged_in')==false){
            redirect('login');    
        }
        $this->load->model('m_justin_banner');
        $this->load->model('main_model');
    }
        
    function index(){
        $data['list']=$this->db->query("select * from justin_banner where id='1'")->row();
        $data['view']='main';
        $this->load->view('template',$data);
    }
    
    function update_proses(){
        $image_hidden1=$this->input->post('image_hidden1');
        $image_hidden2=$this->input->post('image_hidden2');
        $right_url=$this->input->post('right_url');
        $left_url=$this->input->post('left_url');
        
        //upload File
        $config['upload_path']	= "../userfiles/Image/justin_banner/";
        $config['upload_url']	= "../userfiles/Image/justin_banner/";
        $config['allowed_types']= '*';
        $config['max_size']     = '2000';
        $config['max_width']  	= '2000';
        $config['max_height']  	= '2000';
        $this->load->library('upload');
        $this->upload->initialize($config);

        if($this->upload->do_upload('image1'))
         {
            $image_data1 = $this->upload->data();
            $img1=$image_data1['file_name'];
         }else{
             $img1=$image_hidden1;
         }
         if($this->upload->do_upload('image2'))
         {
            $image_data2 = $this->upload->data();
            $img2=$image_data2['file_name'];
         }else{
             $img2=$image_hidden2;
         }
         $data=array(
             'banner_right'=>$img1,
             'banner_left'=>$img2,
             'banner_right_url'=>$right_url,
             'banner_left_url'=>$left_url,
             'update_date'=>$this->main_model->sys_date(),
             'update_user'=>$this->main_model->sys_user()
        );
         $this->main_model->update('justin_banner','id','1',$data);
         redirect('justin_banner');
    }
}