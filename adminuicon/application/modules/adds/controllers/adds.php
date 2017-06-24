<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Adds extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('logged_in_admin') == false) {
            redirect('login');
        }
        $this->load->model('main_model');
    }

         
    function index(){
        $this->session->unset_userdata('page_sr');
        $this->session->unset_userdata('id_sr');
        $this->session->unset_userdata('name_sr');
        $this->session->unset_userdata('url_sr');
        $this->session->unset_userdata('status_sr');
        $config['base_url'] = base_url().'adds/index/';
        $config['total_rows'] = $this->db->query("select * from adds order by id desc")->num_rows();
        $config['per_page'] = 10;
        $config['num_links'] = 2;
        $config['uri_segment'] = 3;
        $config['first_page'] = 'Awal';
        $config['last_page'] = 'Akhir';
        $config['next_page'] = '&laquo;';
        $config['prev_page'] = '&raquo;';
        $pg = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;
        //inisialisasi config
        $this->pagination->initialize($config);
        //buat pagination
        $data['halaman'] = $this->pagination->create_links();
        //tamplikan data
        $data['total_data']=$this->db->query("select * from adds order by id desc")->num_rows();
        $data['data'] = $this->db->query("select * from adds order by id desc limit ".$pg.",".$config['per_page']."")->result();
        $data['view']='main';
        $this->load->view('template',$data);
    }
    
    function search(){
        if($_POST){
            $page_sr = ($this->input->get_post('page_sr')==""?$this->session->unset_userdata('page_sr'):$this->main_model->handler0("page_sr",$this->input->get_post('page_sr', TRUE)));
            $id_sr = ($this->input->get_post('id_sr')==""?$this->session->unset_userdata('id_sr'):$this->main_model->handler0("id_sr",$this->input->get_post('id_sr', TRUE)));
            $name_sr = ($this->input->get_post('name_sr')==""?$this->session->unset_userdata('name_sr'):$this->main_model->handler0("name_sr",$this->input->get_post('name_sr', TRUE)));
            $status_sr = ($this->input->get_post('status_sr')==""?$this->session->unset_userdata('status_sr'):$this->main_model->handler0("status_sr",$this->input->get_post('status_sr', TRUE)));
            $url_sr = ($this->input->get_post('url_sr')==""?$this->session->unset_userdata('url_sr'):$this->main_model->handler0("url_sr",$this->input->get_post('url_sr', TRUE)));
        }else{
            $page_sr = $this->main_model->handler0("page_sr",$this->input->get_post('page_sr', TRUE));
            $id_sr = $this->main_model->handler0("id_sr",$this->input->get_post('id_sr', TRUE));
            $name_sr = $this->main_model->handler0("name_sr",$this->input->get_post('name_sr', TRUE));
            $status_sr = $this->main_model->handler0("status_sr",$this->input->get_post('status_sr', TRUE));
            $url_sr = $this->main_model->handler0("url_sr",$this->input->get_post('url_sr', TRUE));
        }
        //echo $id_sr,$name_sr,$status_sr;
        $limit = ($this->uri->segment(3) > 0)?$this->uri->segment(3):0;

        $config['base_url'] = base_url() .'adds/search';
        $config['total_rows'] = $this->db->query("select * from adds where id like '%$id_sr%' and adds_name like '%$name_sr%' and adds_url like '%$url_sr%' and status like '%$status_sr%' order by id desc")->num_rows();
        $config['per_page'] = ($page_sr > 0)?$page_sr:10;
        $config['uri_segment'] = 3;
        $choice = $config['total_rows']/$config['per_page'];
        $config['num_links'] = 2;		
        $this->pagination->initialize($config);

        $data['data'] = $this->db->query("select * from adds where id like '%$id_sr%' and adds_name like '%$name_sr%' and adds_url like '%$url_sr%' and status like '%$status_sr%' order by id desc limit ".$limit.",".$config['per_page']."")->result();
        $data['halaman'] = $this->pagination->create_links();
        $data['total_data']= $this->db->query("select * from adds where id like '%$id_sr%' and adds_name like '%$name_sr%' and adds_url like '%$url_sr%' and status like '%$status_sr%' order by id desc")->num_rows();
        $data['page_sr'] = $page_sr;
        $data['id_sr'] = $id_sr;
        $data['name_sr'] = $name_sr;
        $data['status_sr'] = $status_sr;
        $data['url_sr'] = $url_sr;
        $data['view']='search';
        $this->load->view('template',$data);
    }

    function image_browse(){
        $this->load->view("image_browse");
    }
    
    public function add() {
        $data['menu'] = $this->db->query("select * from menu order by id")->result();
        $data['view'] = 'add';
        $this->load->view('template', $data);
    }

    public function add_proses() {
        $adds_name=$this->input->post('adds_name');
        $adds_url=$this->input->post('adds_url');
        $adds_open=$this->input->post('adds_open');
        $adds_image=$this->input->post('adds_image');
        $adds_menu=  implode(",", $this->input->post('menu'));
        
        $data=array(
            'adds_name'=>$adds_name,
            'adds_url'=>$adds_url,
            'adds_open'=>$adds_open,
            'adds_menu'=>$adds_menu,
            'adds_image'=>$adds_image
        );
        
        $this->db->insert("adds",$data);
        
        redirect("adds/index");
        
    }

    public function update($id,$posisi) {
        $data['list']=$this->db->query("select * from adds where id='$id'")->row();
        $data['menu'] = $this->db->query("select * from menu order by id")->result();
        $data['view'] = 'edit';
        $data['posisi']=$posisi;
        $this->load->view('template', $data);
        
    }

    public function update_proses() {
        $id=$this->input->post('id');
        $posisi=$this->input->post('posisi');
        $adds_name=$this->input->post('adds_name');
        $adds_url=$this->input->post('adds_url');
        $adds_open=$this->input->post('adds_open');
        $adds_image=$this->input->post('adds_image');
        $adds_menu=  implode(",", $this->input->post('menu'));
        
        $data=array(
            'adds_name'=>$adds_name,
            'adds_url'=>$adds_url,
            'adds_open'=>$adds_open,
            'adds_menu'=>$adds_menu,
            'adds_image'=>$adds_image
        );
        
        $this->main_model->update("adds","id",$id,$data);
        
        redirect("adds/search/".$posisi);
        
    }

    function delete($id, $page) {

       $this->main_model->delete("adds","id",$id);
       
       redirect("adds/search/".$page);
    }
    
    public function testing() {
        echo $this->m_banner->get_banner_view('home');
    }

}
