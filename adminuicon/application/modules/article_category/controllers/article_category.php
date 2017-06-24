<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article_category extends MX_Controller{
    public function __construct() {
        parent::__construct();
        if($this->session->userdata('logged_in_admin')==false){
            redirect('login');    
        }
        $this->load->model('m_article_category');
        $this->load->model('main_model');
    }
        
    function index(){
        $this->session->unset_userdata('page_sr');
        $this->session->unset_userdata('id_sr');
        $this->session->unset_userdata('name_sr');
        $this->session->unset_userdata('status_sr');
        $config['base_url'] = base_url().'article_category/index/';
        $config['total_rows'] = $this->db->query("select * from article_category")->num_rows();
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
        $data['total_data']=$this->db->query("select * from article_category")->num_rows();
        $data['data'] = $this->db->query("select * from article_category order by id desc limit ".$pg.",".$config['per_page']."")->result();
        $data['view']='main';
        $this->load->view('template',$data);
    }
    
    public function search()
	{
            if($_POST){
                $page_sr = ($this->input->post('page_sr')==""?$this->session->unset_userdata('page_sr'):$this->m_article_category->handler0($this->input->get_post('page_sr', TRUE)));
                $id_sr = ($this->input->post('id_sr')==""?$this->session->unset_userdata('id_sr'):$this->m_article_category->handler1($this->input->get_post('id_sr', TRUE)));
                $name_sr = ($this->input->post('name_sr')==""?$this->session->unset_userdata('name_sr'):$this->m_article_category->handler2($this->input->get_post('name_sr', TRUE)));
                $status_sr = ($this->input->post('status_sr')==""?$this->session->unset_userdata('status_sr'):$this->m_article_category->handler3($this->input->get_post('status_sr', TRUE)));
            }else{
                $page_sr = $this->m_article_category->handler0($this->input->get_post('page_sr', TRUE));
                $id_sr = $this->m_article_category->handler1($this->input->get_post('id_sr', TRUE));
                $name_sr = $this->m_article_category->handler2($this->input->get_post('name_sr', TRUE));
                $status_sr = $this->m_article_category->handler3($this->input->get_post('status_sr', TRUE));
            }
            //      echo $id_sr,$name_sr,$status_sr;
            $limit = ($this->uri->segment(3) > 0)?$this->uri->segment(3):0;

            $config['base_url'] = base_url() .'article_category/search';
            $config['total_rows'] = $this->db->query("select * from article_category  where id LIKE '%$id_sr%' and article_category_name LIKE '%$name_sr%' and status LIKE '%$status_sr%'")->num_rows();
            $config['per_page'] = ($page_sr > 0)?$page_sr:10;
            $config['uri_segment'] = 3;
            $choice = $config['total_rows']/$config['per_page'];
            $config['num_links'] = 2;		
            $this->pagination->initialize($config);

            $data['data'] = $this->db->query("select * from article_category  where id LIKE '%$id_sr%' and article_category_name LIKE '%$name_sr%' and status LIKE '%$status_sr%' order by id desc limit ".$limit.",".$config['per_page']."")->result();
            $data['halaman'] = $this->pagination->create_links();
            $data['total_data']= $this->db->query("select * from article_category  where id LIKE '%$id_sr%' and article_category_name LIKE '%$name_sr%' and status LIKE '%$status_sr%'")->num_rows();
            $data['page_sr'] = $page_sr;
            $data['id_sr'] = $id_sr;
            $data['name_sr'] = $name_sr;
            $data['status_sr'] = $status_sr;
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
        $name=$this->input->post('category_name');
        $description=$this->input->post('category_description');
        $status=$this->input->post('status');
        
        $data=array("article_category_name"=>$name,"article_category_description"=>$description,"status"=>$status,"sys_create_user"=>$session_data['user_id'],"sys_create_date"=>$datetime);
        $this->db->insert("article_category",$data);
        
        redirect("article_category/search");
    }
    
    function update($id,$page){
        $data['list_detail']=$this->m_article_category->select_where("article_category","id",$id)->row();
        $data['posisi']=$page;
        $data['view']='edit';
        $this->load->view('template',$data);
    }
    
    function update_proses(){
        $session_data = $this->session->userdata('logged_in');
        $datetime=date("Y-m-d h:i:s");
        $posisi=$this->input->post("posisi");
        $id=$this->input->post("id");
        $name=$this->input->post('category_name');
        $description=$this->input->post('category_description');
        $status=$this->input->post('status');
        
        $data=array("article_category_name"=>$name,"article_category_description"=>$description,"status"=>$status,"sys_update_user"=>$session_data['user_id'],"sys_update_date"=>$datetime);
        $this->m_article_category->update("article_category","id",$id,$data);
        redirect("article_category/search/".$posisi);
    }
    
    function delete($id,$page){
        $this->m_article_category->delete("article","id_category",$id);
        $this->m_article_category->delete("article_category","id",$id);
        redirect("article_category/search/".$page);
    }
}