<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article_subcategory extends MX_Controller{
    public function __construct() {
        parent::__construct();
        if($this->session->userdata('logged_in_admin')==false){
            redirect('login');    
        }
        $this->load->model('m_article_subcategory');
    }
        
    function index(){
        $this->session->unset_userdata('page_sr');
        $this->session->unset_userdata('id_sr');
        $this->session->unset_userdata('name_sr');
        $this->session->unset_userdata('categoryname_sr');
        $this->session->unset_userdata('status_sr');
        $config['base_url'] = base_url().'article_subcategory/index/';
        $config['total_rows'] = $this->db->query("select a.*,b.article_category_name from article_subcategory a left join article_category b on a.id_category=b.id order by a.id desc")->num_rows();
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
        $data['total_data']=$this->db->query("select a.*,b.article_category_name from article_subcategory a left join article_category b on a.id_category=b.id order by a.id desc")->num_rows();
        $data['data'] = $this->db->query("select a.*,b.article_category_name from article_subcategory a left join article_category b on a.id_category=b.id order by a.id desc limit ".$pg.",".$config['per_page']."")->result();
        $data['view']='main';
        $this->load->view('template',$data);
    }
    
    public function search()
	{
            $page_sr = $this->m_article_subcategory->handler0($this->input->get_post('page_sr', TRUE));
            $id_sr = $this->m_article_subcategory->handler1($this->input->get_post('id_sr', TRUE));
            $name_sr = $this->m_article_subcategory->handler2($this->input->get_post('name_sr', TRUE));
            $status_sr = $this->m_article_subcategory->handler3($this->input->get_post('status_sr', TRUE));
            $categoryname_sr = $this->m_article_subcategory->handler4($this->input->get_post('categoryname_sr', TRUE));
            //echo $id_sr,$name_sr,$status_sr;
            $limit = ($this->uri->segment(3) > 0)?$this->uri->segment(3):0;

            $config['base_url'] = base_url() .'article_subcategory/search';
            $config['total_rows'] = $this->db->query("select a.*,b.article_category_name from article_subcategory a left join article_category b on a.id_category=b.id where a.id LIKE '%$id_sr%' and a.article_subcategory_name LIKE '%$name_sr%' and a.status LIKE '%$status_sr%' and a.article_subcategory_name LIKE '%$categoryname_sr%' order by a.id desc")->num_rows();
            $config['per_page'] = ($page_sr > 0)?$page_sr:10;
            $config['uri_segment'] = 3;
            $choice = $config['total_rows']/$config['per_page'];
            $config['num_links'] = 2;		
            $this->pagination->initialize($config);

            $data['data'] = $this->db->query("select a.*,b.article_category_name from article_subcategory a left join article_category b on a.id_category=b.id where a.id LIKE '%$id_sr%' and a.article_subcategory_name LIKE '%$name_sr%' and a.status LIKE '%$status_sr%' and a.article_subcategory_name LIKE '%$categoryname_sr%' order by a.id desc limit ".$limit.",".$config['per_page']."")->result();
            $data['halaman'] = $this->pagination->create_links();
            $data['total_data']= $this->db->query("select a.*,b.article_category_name from article_subcategory a left join article_category b on a.id_category=b.id where a.id LIKE '%$id_sr%' and a.article_subcategory_name LIKE '%$name_sr%' and a.status LIKE '%$status_sr%' and a.article_subcategory_name LIKE '%$categoryname_sr%' order by a.id desc")->num_rows();
            $data['page_sr'] = $page_sr;
            $data['id_sr'] = $id_sr;
            $data['name_sr'] = $name_sr;
            $data['status_sr'] = $status_sr;
            $data['categoryname_sr'] = $categoryname_sr;
            $data['view']='search';
            $this->load->view('template',$data);
	}
    
    function add(){
        $data['list_category']=$this->db->query("select * from article_category where status='Y'")->result();
        $data['view']='add';
        $this->load->view('template',$data);
    }
    function add_proses(){
        $session_data = $this->session->userdata('logged_in');
        $datetime=date("Y-m-d h:i:s");
        $cat=$this->input->post('category');
        $name=$this->input->post('subcategory_name');
        $description=$this->input->post('category_description');
        $status=$this->input->post('status');
        
        $data=array("id_category"=>$cat,"article_subcategory_name"=>$name,"article_subcategory_description"=>$description,"status"=>$status,"sys_create_user"=>$session_data['user_id'],"sys_create_date"=>$datetime);
        $this->db->insert("article_subcategory",$data);
        
        redirect("article_subcategory/search");
    }
    
    function update($id,$page){
        $data['list_category']=$this->db->query("select * from article_category where status='Y'")->result();
        $data['list_detail']=$this->m_article_subcategory->select_where("article_subcategory","id",$id)->row();
        $data['posisi']=$page;
        $data['view']='edit';
        $this->load->view('template',$data);
    }
    
    function update_proses(){
        $session_data = $this->session->userdata('logged_in');
        $datetime=date("Y-m-d h:i:s");
        $posisi=$this->input->post("posisi");
        $id=$this->input->post("id");
        $cat=$this->input->post('category');
        $name=$this->input->post('subcategory_name');
        $description=$this->input->post('category_description');
        $status=$this->input->post('status');
        
        $data=array("id_category"=>$cat,"article_subcategory_name"=>$name,"article_subcategory_description"=>$description,"status"=>$status,"sys_update_user"=>$session_data['user_id'],"sys_update_date"=>$datetime);
        $this->m_article_subcategory->update("article_subcategory","id",$id,$data);
        
        redirect("article_subcategory/search/".$posisi);
    }
    
    function delete($id,$page){
        $this->m_article_subcategory->delete("article_subcategory","id",$id);
        redirect("article_subcategory/search/".$page);
    }
}