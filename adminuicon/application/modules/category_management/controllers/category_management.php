<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_management extends MX_Controller{
    public function __construct() {
        parent::__construct();
        if($this->session->userdata('logged_in_admin')==false){
            redirect('login');    
        }
        $this->load->model('m_category_management');
        $this->load->model('main_model');
    }
        
    function index(){
        
        $this->session->unset_userdata('page_sr');
        $this->session->unset_userdata('id_sr');
        $this->session->unset_userdata('name_sr');
        $config['base_url'] = base_url().'category_management/index/';
        $config['total_rows'] = $this->db->query("select * from product_category")->num_rows();
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
        $data['total_data']=$this->db->query("select * from product_category")->num_rows();
        $data['data'] = $this->db->query("select * from product_category order by id desc limit ".$pg.",".$config['per_page']."")->result();
        $data['view']='main';
        $this->load->view('template',$data);
    }
    
    public function search()
	{
        
        if($_POST){
            $page_sr = ($this->input->get_post('page_sr')==""?$this->session->unset_userdata('page_sr'):$this->m_category_management->handler0($this->input->get_post('page_sr', TRUE)));
            $id_sr = ($this->input->get_post('id_sr')==""?$this->session->unset_userdata('id_sr'):$this->m_category_management->handler1($this->input->get_post('id_sr', TRUE)));
			$name_sr = ($this->input->get_post('name_sr')==""?$this->session->unset_userdata('name_sr'):$this->m_category_management->handler1($this->input->get_post('name_sr', TRUE)));
	   }else{
            $page_sr = $this->m_category_management->handler0($this->input->get_post('page_sr', TRUE));
            $id_sr = $this->m_category_management->handler1($this->input->get_post('id_sr', TRUE));
            $name_sr = $this->m_category_management->handler2($this->input->get_post('name_sr', TRUE));
        }
            $limit = ($this->uri->segment(3) > 0)?$this->uri->segment(3):0;
            $config['base_url'] = base_url() . 'category_management/search';
            $config['total_rows'] = $this->db->query("select * from product_category where id LIKE '%$id_sr%' and product_category_name LIKE '%$name_sr%' order by id desc")->num_rows();
            $config['per_page'] = ($page_sr > 0)?$page_sr:10;
            $config['uri_segment'] = 3;
            $choice = $config['total_rows']/$config['per_page'];
            $config['num_links'] = 2;		
            $this->pagination->initialize($config);

            $data['data'] = $this->db->query("select * from product_category where id LIKE '%$id_sr%' and product_category_name LIKE '%$name_sr%' order by id desc limit ".$limit.",".$config['per_page']."")->result();
            $data['halaman'] = $this->pagination->create_links();
            $data['total_data']=$this->db->query("select * from product_category where id LIKE '%$id_sr%' and product_category_name LIKE '%$name_sr%' order by id desc")->num_rows();
            $data['page_sr'] = $page_sr;
            $data['id_sr'] = $id_sr;
            $data['name_sr'] = $name_sr;
            $data['view']='search';
            $this->load->view('template',$data);
	}
    
    function add(){
        $data['view']='add';
        $this->load->view('template',$data);
    }
    function add_proses(){
        
        $session_data = $this->session->userdata('logged_in');
        $datetime=date("Y-m-d h:i:s");
        $product_category_name=$this->input->post('product_category_name');
        $product_category_status=$this->input->post('product_category_status');
        
            $data=array(
            'product_category_name'=>$product_category_name,
            'product_category_status'=>$product_category_status
        );
        
        $this->main_model->insert('product_category',$data);
        redirect('category_management/search');
    }
    
    function update($id,$page){
        
        $data['list']=$this->db->query("select * from product_category where id='$id'")->row();
        $data['posisi']=$page;
        $data['view']='edit';
        $this->load->view('template',$data);
    }
    
    function update_proses(){
        
        $session_data = $this->session->userdata('logged_in');
        $datetime=date("Y-m-d h:i:s");
        $posisi=$this->input->post("posisi");
        $id=$this->input->post("id");
        $product_category_name=$this->input->post('product_category_name');
        $product_category_status=$this->input->post('product_category_status');
        
            $data=array(
            'product_category_name'=>$product_category_name,
            'product_category_status'=>$product_category_status
        );
            
        $this->main_model->update("product_category","id",$id,$data);
        redirect('category_management/search/'.$posisi);
    }
    
    function delete($id,$page){
        
        $this->main_model->delete('product_category','id',$id);
        redirect('category_management/search/'.$page);
    }
}