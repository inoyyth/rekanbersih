<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article extends MX_Controller{
    public function __construct() {
        parent::__construct();
        
        $this->load->model('main_model');
    }
        
    function index($id){
        $this->session->unset_userdata('search_sr');
        $data['detail']=$this->db->query("select * from article where id='$id'")->row();
        $data['list_category']=$this->db->query("select * from article_category where status='Y'")->result();
        $data['list_article']=$this->db->query("select * from article where status='Y' ORDER BY RAND() limit 6")->result();
        
        $data['view']="main";
        $this->load->view('template',$data);
    }
    
    function search(){
        //$data['detail']=$this->db->query("select * from article where article_name LIKE '%".$this->db->escape_like_str($search)."%' order by article_name asc ")->result();
        if($_POST){
            $search_sr = ($this->input->get_post('search_sr')==""?$this->session->unset_userdata('search_sr'):$this->main_model->handler0("search_sr",$this->input->get_post('search_sr', TRUE)));
        }else{
            $search_sr = $this->main_model->handler0("search_sr",$this->input->get_post('search_sr', TRUE));
        }
        //echo $id_sr,$name_sr,$status_sr;
        $limit = ($this->uri->segment(3) > 0)?$this->uri->segment(3):0;

        $config['base_url'] = base_url() .'article/search';
        $config['total_rows'] = $this->db->query("select * from article where article_name LIKE '%".$this->db->escape_like_str($search_sr)."%' order by article_name asc")->num_rows();
        $config['per_page'] = 6;
        $config['uri_segment'] = 3;
        $choice = $config['total_rows']/$config['per_page'];
        $config['num_links'] = 2;		
        $this->pagination->initialize($config);

        $data['datax'] = $this->db->query("select * from article where article_name LIKE '%".$this->db->escape_like_str($search_sr)."%' order by article_name asc limit ".$limit.",".$config['per_page']."")->result();
        $data['halaman'] = $this->pagination->create_links();
        $data['total_data']= $this->db->query("select * from article where article_name LIKE '%".$this->db->escape_like_str($search_sr)."%' order by article_name asc")->num_rows();
        $data['search_sr'] = $search_sr;
        
        $data['list_category']=$this->db->query("select * from article_category where status='Y'")->result();
        $data['list_article']=$this->db->query("select * from article where status='Y' ORDER BY RAND() limit 3")->result();
        $data['text']=$search_sr;
        $data['view']="search";
        $this->load->view('template',$data);
    }
}