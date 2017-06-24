<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Brand_management extends MX_Controller{
    public function __construct() {
        parent::__construct();
//        if($this->session->userdata('logged_in')==false){
//            redirect('login');    
//        }
        $this->load->model('m_brand_management');
    }
        
    function index(){
        $this->session->unset_userdata('page_sr');
        $this->session->unset_userdata('id_sr');
        $this->session->unset_userdata('name_sr');
        $this->session->unset_userdata('status_sr');
        $this->session->unset_userdata('child_sr');
        $this->session->unset_userdata('product_sr');
        $config['base_url'] = base_url().'brand_management/index/';
        $config['total_rows'] = $this->db->query("select * from brand where brand_child_id='0'")->num_rows();
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
        $data['total_data']=$this->db->query("select * from brand")->num_rows();
        $data['data'] = $this->db->query("select * from brand where brand_child_id='0' limit ".$pg.",".$config['per_page']."")->result();
        $data['view']='main';
        $this->load->view('template',$data);
    }
    
    public function search()
	{
        if($_POST){
            $page_sr = ($this->input->get_post('page_sr')==""?$this->session->unset_userdata('page_sr'):$this->m_brand_management->handler0($this->input->get_post('page_sr', TRUE)));
            $id_sr = ($this->input->get_post('id_sr')==""?$this->session->unset_userdata('id_sr'):$this->m_brand_management->handler1($this->input->get_post('id_sr', TRUE)));
            $name_sr = ($this->input->get_post('name_sr')==""?$this->session->unset_userdata('name_sr'):$this->m_brand_management->handler2($this->input->get_post('name_sr', TRUE)));
            $status_sr = ($this->input->get_post('status_sr')==""?$this->session->unset_userdata('status_sr'):$this->m_brand_management->handler3($this->input->get_post('status_sr', TRUE)));
            $child_sr = ($this->input->get_post('child_sr')==""?$this->session->unset_userdata('child_sr'):$this->m_brand_management->handler4($this->input->get_post('child_sr', TRUE)));
            $product_sr = ($this->input->get_post('product_sr')==""?$this->session->unset_userdata('product_sr'):$this->m_brand_management->handler5($this->input->get_post('product_sr', TRUE)));
        }else{
            $page_sr = $this->m_brand_management->handler0($this->input->get_post('page_sr', TRUE));
            $id_sr = $this->m_brand_management->handler1($this->input->get_post('id_sr', TRUE));
            $name_sr = $this->m_brand_management->handler2($this->input->get_post('name_sr', TRUE));
            $status_sr = $this->m_brand_management->handler3($this->input->get_post('status_sr', TRUE));
            $child_sr = $this->m_brand_management->handler4($this->input->get_post('child_sr', TRUE));
            $product_sr = $this->m_brand_management->handler5($this->input->get_post('product_sr', TRUE));
            //echo $id_sr,$name_sr,$status_sr;
        }
            $limit = ($this->uri->segment(3) > 0)?$this->uri->segment(3):0;

            $config['base_url'] = base_url() . 'brand_management/search';
            $config['total_rows'] = $this->db->query("select * from brand where id LIKE '%$id_sr%' and brand_name LIKE '%$name_sr%' and status LIKE '%$status_sr%' and brand_child_id LIKE '%$child_sr%' and brand_product_value LIKE '%$product_sr%' and brand_child_id='0'")->num_rows();
            $config['per_page'] = ($page_sr > 0)?$page_sr:10;
            $config['uri_segment'] = 3;
            $choice = $config['total_rows']/$config['per_page'];
            $config['num_links'] = 2;		
            $this->pagination->initialize($config);

            $data['data'] = $this->db->query("select * from brand where id LIKE '%$id_sr%' and brand_name LIKE '%$name_sr%' and status LIKE '%$status_sr%' and brand_child_id LIKE '%$child_sr%' and brand_product_value LIKE '%$product_sr%'  and brand_child_id='0' limit ".$limit.",".$config['per_page']."")->result();
            $data['halaman'] = $this->pagination->create_links();
            $data['total_data']= $this->m_brand_management->search_record_count($id_sr,$name_sr,$status_sr);
            $data['page_sr'] = $page_sr;
            $data['id_sr'] = $id_sr;
            $data['name_sr'] = $name_sr;
            $data['status_sr'] = $status_sr;
            $data['child_sr'] = $child_sr;
            $data['product_sr'] = $product_sr;
            $data['view']='search';
            $this->load->view('template',$data);
	}
    
    function add(){
        $data['category']=$this->db->query("select * from product_category where product_category_status='Y'")->result();
        $data['view']='add';
        $this->load->view('template',$data);
    }
    function add_proses(){
        error_reporting(0);
        $session_data = $this->session->userdata('logged_in');
        $datetime=date("Y-m-d h:i:s");
        $brand_name=$this->input->post('brand_name');
        $category=implode(",", $this->input->post('category'));
        $brand_description=$this->input->post('brand_description');
        $image=$this->input->post('thumbnail');
        $active=$this->input->post('status');
        
        $data=array(
            'brand_name'=>$brand_name,
            'brand_description'=>$brand_description,
            'brand_images'=>$image,
            'status'=>$active,
            'category_id'=>$category,
            'sys_create_date'=>$datetime,
            'sys_create_user'=>$session_data['user_id']
        );
        $this->m_brand_management->insert('brand',$data);
        
        redirect("brand_management/search");
    }
    
    function update($id,$page){
        $data['category']=$this->db->query("select * from product_category where product_category_status='Y'")->result();
        $data['list_brand']=$this->db->query("select * from brand where id='$id'")->row();
        $data['posisi']=$page;
        $data['view']='edit';
        $this->load->view('template',$data);
    }
    
    function update_proses(){
        $session_data = $this->session->userdata('logged_in');
        $datetime=date("Y-m-d h:i:s");
        $posisi=$this->input->post("posisi");
        $id=$this->input->post('id');
        $brand_name=$this->input->post('brand_name');
        $category=implode(",", $this->input->post('category'));
        $brand_description=$this->input->post('brand_description');
        $image=$this->input->post('thumbnail');
        $active=$this->input->post('status');
             
        $data=array(
            'brand_name'=>$brand_name,
            'brand_description'=>$brand_description,
            'brand_images'=>$image,
            'status'=>$active,
            'category_id'=>$category,
            'sys_update_date'=>$datetime,
            'sys_update_user'=>$session_data['user_id']
        );
        $this->m_brand_management->update('brand','id',$id,$data);
        
        redirect("brand_management/search/".$posisi);
    }
    
    function delete($id,$page){
        $this->db->query("delete from brand where brand_child_id='$id'");
        $brand=$this->db->query("select * from product_general where product_brand='$id'")->result();
        foreach($brand as $brandx){
            $this->db->query("delete from product_detail where product_general_id='$brandx->id'");
            $this->db->query("delete from product_images where product_general_id='$brandx->id'");
        }
        $this->m_brand_management->delete("product_general","product_brand",$id);
        $this->m_brand_management->delete("brand","id",$id);
        redirect("brand_management/search/".$page);
    }
    
    function image_browse(){
        $this->load->view("image_browse");
    }
}