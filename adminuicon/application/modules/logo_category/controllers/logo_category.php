<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logo_category extends MX_Controller{
    public function __construct() {
        parent::__construct();
//        if($this->session->userdata('logged_in')==false){
//            redirect('login');    
//        }
        $this->load->model('m_logo_category');
    }
        
    function index(){
        $data['lg']=$this->db->query("select * from category_logo")->result();
        $data['category']=$this->db->query("select * from product_category where product_category_status='Y' and product_category_child_id='0'")->result();
        $data['logo']=$this->db->query("select * from t_logo where status='Y'")->result();
        $data['view']="main";
        $this->load->view('template',$data);
    }
    
    function update_proses(){
        if(!isset($_POST)){	
            show_404();
        }else{
            $this->db->query("truncate table category_logo");
            $session_data = $this->session->userdata('logged_in');
            $date=date("Y-m-d h:i:s");
            $logo=$this->input->post('logo');
            $category=$this->input->post('category');
            for($i=0;$i<count($logo);$i++){
                $data=array('logo_id'=>$logo[$i],'sys_update_date'=>$date,'sys_update_user'=>$session_data['user_id']);
                $this->db->insert("category_logo",$data);
            }
            redirect('logo_category');
//            $logx= explode(",",$logo);
//            print_r($logx[0]);
        }
    }
}