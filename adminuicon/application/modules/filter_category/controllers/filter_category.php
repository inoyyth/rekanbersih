<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Filter_category extends MX_Controller{
    public function __construct() {
        parent::__construct();
        if($this->session->userdata('logged_in')==false){
            redirect('login');    
        }
        $this->load->model('main_model');
        $this->load->model('m_filter_category');
    }
        
    function index(){
        $this->session->unset_userdata('page_sr');
         $this->session->unset_userdata('id_sr');
        $this->session->unset_userdata('category_sr');
        $this->session->unset_userdata('name_sr');
        $this->session->unset_userdata('status_sr');
        $config['base_url'] = base_url().'filter_category/index/';
        $config['total_rows'] = $this->db->query("select a.*,b.product_category_name from filter_category a INNER JOIN product_category b on a.category_id=b.id order by id desc")->num_rows();
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
        $data['total_data']=$this->db->query("select a.*,b.product_category_name from filter_category a INNER JOIN product_category b on a.category_id=b.id order by id desc")->num_rows();
        $data['data'] = $this->db->query("select a.*,b.product_category_name from filter_category a INNER JOIN product_category b on a.category_id=b.id order by id desc limit ".$pg.",".$config['per_page']."")->result();
        $data['view']='main';
        $this->load->view('template',$data);
    }
    
    function search(){
        $page_sr = $this->m_filter_category->handler0("page_sr",$this->input->get_post('page_sr', TRUE));
        $id_sr = $this->m_filter_category->handler0("id_sr",$this->input->get_post('id_sr', TRUE));
        $category_sr = $this->m_filter_category->handler0("category_sr",$this->input->get_post('category_sr', TRUE));
        $name_sr = $this->m_filter_category->handler0("name_sr",$this->input->get_post('name_sr', TRUE));
        $status_sr = $this->m_filter_category->handler0("status_sr",$this->input->get_post('status_sr', TRUE));
                
        $limit = ($this->uri->segment(3) > 0)?$this->uri->segment(3):0;

        $config['base_url'] = base_url() .'filter_category/search';
        $config['total_rows'] = $this->db->query("select a.*,b.product_category_name 
                                                from filter_category a 
                                                INNER JOIN product_category b on a.category_id=b.id 
                                                where a.id LIKE '%$id_sr%'
                                                and b.product_category_name LIKE '%$category_sr%'
                                                and a.filter_name LIKE '%$name_sr%'
                                                and a.status LIKE '%$status_sr%'
                                                order by id desc")->num_rows();
        $config['per_page'] = ($page_sr > 0)?$page_sr:10;
        $config['uri_segment'] = 3;
        $choice = $config['total_rows']/$config['per_page'];
        $config['num_links'] = 2;		
        $this->pagination->initialize($config);

        $data['data'] = $this->db->query("select a.*,b.product_category_name 
                                        from filter_category a 
                                        INNER JOIN product_category b on a.category_id=b.id 
                                        where a.id LIKE '%$id_sr%'
                                        and b.product_category_name LIKE '%$category_sr%'
                                        and a.filter_name LIKE '%$name_sr%'
                                        and a.status LIKE '%$status_sr%'
                                        order by id desc
                                        limit ".$limit.",".$config['per_page']."")->result();
        $data['halaman'] = $this->pagination->create_links();
        $data['total_data']= $this->db->query("select a.*,b.product_category_name 
                                            from filter_category a 
                                            INNER JOIN product_category b on a.category_id=b.id 
                                            where a.id LIKE '%$id_sr%'
                                            and b.product_category_name LIKE '%$category_sr%'
                                            and a.filter_name LIKE '%$name_sr%'
                                            and a.status LIKE '%$status_sr%'
                                            order by id desc")->num_rows();
        $data['page_sr'] = $page_sr;
        $data['id_sr'] = $id_sr;
        $data['category_sr'] = $category_sr;
        $data['name_sr'] = $name_sr;
        $data['status_sr'] = $status_sr;
        $data['view']='search';
        $this->load->view('template',$data);
    }
    
    function add(){
        $data['category']=$this->db->query("select * from product_category where product_category_status='Y'")->result();
        $data['view']="add";
        $this->load->view("template",$data);
    }
    
    function add_proses(){
        $category=$this->input->post('category');
        $filtername=$this->input->post('filtername');
        $status=$this->input->post('status');
        $data=array(
            'category_id'=>$category,
            'filter_name'=>$filtername,
            'status'=>$status,
            'sys_create_date'=>$this->main_model->sys_date(),
            'sys_create_user'=>$this->main_model->sys_user()
        );
        $this->db->insert("filter_category",$data);
        
        redirect("filter_category/search"); 
    }
    
    function update($id,$posisi){
        $data['category']=$this->db->query("select * from product_category where product_category_status='Y'")->result();
        $data['detail']=$this->db->query("select * from filter_category where id='$id'")->row();
        $data['posisi']=$posisi;
        $data['view']="edit";
        $this->load->view("template",$data);
    }
    
    function update_proses(){
        $id=$this->input->post('id');
        $posisi=$this->input->post('posisi');
        $category=$this->input->post('category');
        $filtername=$this->input->post('filtername');
        $status=$this->input->post('status');
        $data=array(
            'category_id'=>$category,
            'filter_name'=>$filtername,
            'status'=>$status,
            'sys_create_date'=>$this->main_model->sys_date(),
            'sys_create_user'=>$this->main_model->sys_user()
        );
        $this->main_model->update("filter_category","id",$id,$data);
        
        redirect("filter_category/search/".$posisi); 
    }
    
    function delete($id,$posisi){
        $this->main_model->delete("filter_category","id",$id);
        redirect("filter_category/search/".$posisi); 
    }
        
}