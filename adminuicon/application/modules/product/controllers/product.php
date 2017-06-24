<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends MX_Controller{
    public function __construct() {
        parent::__construct();
        if($this->session->userdata('logged_in_admin')==false){
            redirect('login');    
        }
        $this->load->model('m_product');
        $this->load->model('main_model');
    }
        
    function index(){
        $this->session->unset_userdata('page_sr');
        $this->session->unset_userdata('product_name_sr');
        $this->session->unset_userdata('product_category_sr');
        $config['base_url'] = base_url().'product/index/';
        $config['total_rows'] = $this->db->query("select a.*,b.product_category_name from product_general a left join product_category b on a.product_category=b.id")->num_rows();
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
        $data['total_data']=$this->db->query("select a.*,b.product_category_name from product_general a left join product_category b on a.product_category=b.id")->num_rows();
        $data['data'] = $this->db->query("select a.*,b.product_category_name from product_general a left join product_category b on a.product_category=b.id order by id desc limit ".$pg.",".$config['per_page']."")->result();
		$data['product_category'] = $this->db->get_where('product_category',array('product_category_status'=>'Y'))->result_array();
        $data['view']='main';
        $this->load->view('template',$data);
    }
    
    public function search()
	{
        
        if($_POST){
            $page_sr = ($this->input->get_post('page_sr')==""?$this->session->unset_userdata('page_sr'):$this->m_product->handler0($this->input->get_post('page_sr', TRUE)));
            $product_name_sr = ($this->input->get_post('product_name_sr')==""?$this->session->unset_userdata('product_name_sr'):$this->m_product->handler1($this->input->get_post('product_name_sr', TRUE)));
            $product_category_sr = ($this->input->get_post('product_category_sr')==""?$this->session->unset_userdata('product_category_sr'):$this->m_product->handler2($this->input->get_post('product_category_sr', TRUE)));
        }else{
            $page_sr = $this->m_product->handler0($this->input->get_post('page_sr', TRUE));
            $product_name_sr = $this->m_product->handler1($this->input->get_post('product_name_sr', TRUE));
            $product_category_sr = $this->m_product->handler2($this->input->get_post('product_category_sr', TRUE));
        }
		
		if($product_category_sr != "") {
			$category = "and a.product_category = '".$product_category_sr."'";
		} else {
			$category = "";
		}
            $limit = ($this->uri->segment(3) > 0)?$this->uri->segment(3):0;
            $config['base_url'] = base_url() . 'product/search';
            $config['total_rows'] = $this->db->query("select a.*,b.product_category_name from product_general a left join product_category b on a.product_category=b.id where a.product_name LIKE '%$product_name_sr%' $category order by a.id desc")->num_rows();
            $config['per_page'] = ($page_sr > 0)?$page_sr:10;
            $config['uri_segment'] = 3;
            $choice = $config['total_rows']/$config['per_page'];
            $config['num_links'] = 2;		
            $this->pagination->initialize($config);

            $data['data'] = $this->db->query("select a.*,b.product_category_name from product_general a left join product_category b on a.product_category=b.id where a.product_name LIKE '%$product_name_sr%' $category order by a.id desc limit ".$limit.",".$config['per_page']."")->result();
            $data['halaman'] = $this->pagination->create_links();
            $data['total_data']=$this->db->query("select a.*,b.product_category_name from product_general a left join product_category b on a.product_category=b.id where a.product_name LIKE '%$product_name_sr%' $category order by a.id desc")->num_rows();
            $data['product_category'] = $this->db->get_where('product_category',array('product_category_status'=>'Y'))->result_array();
			$data['page_sr'] = $page_sr;
            $data['product_name_sr'] = $product_name_sr;
            $data['product_category_sr'] = $product_category_sr;
            $data['view']='search';
            $this->load->view('template',$data);
	}
    
    function add(){
        $data['view']='add';
		$data['product_category'] = $this->db->get_where('product_category',array('product_category_status'=>'Y'))->result_array();
        $this->load->view('template',$data);
    }
    function add_proses(){
        
        $session_data = $this->session->userdata('logged_in');
        $datetime=date("Y-m-d h:i:s");
        
        $data=array(
            'product_name'=>$this->input->post('product_name'),
            'product_category'=>$this->input->post('product_category'),
			'product_price'=>$this->input->post('product_price'),
			'length_area'=>$this->input->post('length_area'),
			'length_unit'=>$this->input->post('length_unit'),
			'product_description'=>$this->input->post('product_description'),
			'product_image'=>$this->input->post('thumbnail'),
			'hot_product '=>$this->input->post('hot_product'),
			'status '=>$this->input->post('status'),
			'create_date '=>$datetime,
        );
        
        $this->main_model->insert('product_general',$data);
        redirect('product/search');
    }
    
    function update($id,$page){ 
        
        $data['list_detail']=$this->db->query("select * from product_general where id='$id'")->row();
        $data['posisi']=$page;
		$data['product_category'] = $this->db->get_where('product_category',array('product_category_status'=>'Y'))->result_array();
        $data['view']='edit';
        $this->load->view('template',$data);
    }
    
    function update_proses(){
        
        $posisi=$this->input->post("posisi");
        $id=$this->input->post("id");
        $session_data = $this->session->userdata('logged_in');
        $datetime=date("Y-m-d h:i:s");
        
        $data=array(
            'product_name'=>$this->input->post('product_name'),
            'product_category'=>$this->input->post('product_category'),
			'product_price'=>$this->input->post('product_price'),
			'length_area'=>$this->input->post('length_area'),
			'length_unit'=>$this->input->post('length_unit'),
			'product_description'=>$this->input->post('product_description'),
			'product_image'=>$this->input->post('thumbnail'),
			'hot_product '=>$this->input->post('hot_product'),
			'status '=>$this->input->post('status'),
			'create_date '=>$datetime,
			//'sys_create_user '=>$session_data['user_id_admin']
        );
            
        $this->main_model->update("product_general","id",$id,$data);
        redirect('product/search/'.$posisi);
    }
    
    function delete($id,$page){
        
        $this->main_model->delete('product_general','id',$id);
        redirect('product/search/'.$page);
    }
	
	function image_browse(){
        $this->load->view("image_browse");
    }
}