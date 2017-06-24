<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class faq extends MX_Controller{
    public function __construct() {
        parent::__construct();
        
        $this->load->model('main_model');
    }
        
    function index(){
        $data['faq']=$this->db->query("select * from faq where status='Y' order by position asc")->result();
        $data['list_category']=$this->db->query("select * from article_category where status='Y'")->result();
        $data['list_article']=$this->db->query("select * from article where status='Y' ORDER BY RAND() limit 6")->result();
        $data['view']="main";
        $this->load->view('template',$data);
    }
	
	function kirim_email(){
        $ci = get_instance();
        $ci->load->library('email');
        $config['protocol']='smtp';
        $config['wordwrap'] = FALSE;
        $config['mailtype'] = 'html';
        $config['smtp_host']='ssl://smtp.googlemail.com'; 
        $config['smtp_port']='465'; 
        $config['smtp_timeout']='100'; 
        $config['smtp_user']='supri170845@gmail.com'; 
        $config['smtp_pass']='170845inoy'; 
        $config['charset']='utf-8'; 
        $config['newline']="\r\n";
        $ci->email->initialize($config);
        $data['coba'] = "test";

        $ci->email->from('inoy@inoyweb.com', 'Inoy Website');
        $ci->email->to('crbheldi@gmail.com');
        $ci->email->cc('supriyadin@iproperty.com');
        $ci->email->subject("Tes Email");
        $ci->email->message("tes");
        $ci->email->send();
        echo $this->email->print_debugger();
        //return true;
    }
}