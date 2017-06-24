<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_sale extends MX_Controller{
    public function __construct() {
        parent::__construct();
       if($this->session->userdata('logged_in')==false){
           redirect('login');    
        }
        $this->load->model('m_product_sale');
        $this->load->model('main_model');
    }
    
    function index(){
        $this->load->database('desalite',true);
        $this->session->unset_userdata('page_sr');
        $this->session->unset_userdata('product_code_sr');
        $this->session->unset_userdata('product_name_sr');
        $this->session->unset_userdata('category_sr');
        $this->session->unset_userdata('merk_sr');
        $config['base_url'] = base_url().'product_sale/index/';
        $config['total_rows'] = $this->db->query("select a.id_product,product_code,product_name,b.name,c.product_category,d.id_product_sale
                                                  from product a
                                                  left join merk b on a.merk = b.id_merk
                                                  left join product_category c on a.product_category = c.id_product_category
                                                  inner join product_sale d on a.id_product=d.id_product group by a.id_product
                                                  order by a.id_product desc
                                                 ")->num_rows();
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
        $data['total_data']=$this->db->query("select a.id_product,product_code,product_name,b.name,c.product_category,d.id_product_sale
                                                  from product a
                                                  left join merk b on a.merk = b.id_merk
                                                  left join product_category c on a.product_category = c.id_product_category
                                                  inner join product_sale d on a.id_product=d.id_product group by a.id_product
                                                  order by a.id_product desc
                                                 ")->num_rows();
        $data['data'] = $this->db->query("select a.id_product,product_code,product_name,b.name,c.product_category,d.id_product_sale
                                                  from product a
                                                  left join merk b on a.merk = b.id_merk
                                                  left join product_category c on a.product_category = c.id_product_category
                                                  inner join product_sale d on a.id_product=d.id_product group by a.id_product
                                                  order by a.id_product desc limit ".$pg.",".$config['per_page']."")->result();
        $data['view']='main';
//        $this->load->view('template',$data);
//        $data['list']=$this->mproduct_management->select_index()->result();
//        $data['view']='main';
        $this->load->view('template',$data);
    }
    
    function search(){
        $this->load->database('desalite',true);
        if($_POST){
            $page_sr = ($this->input->get_post('page_sr')==""?$this->session->unset_userdata('page_sr'):$this->main_model->handler0("page_sr",$this->input->get_post('page_sr', TRUE)));
            $product_code_sr = ($this->input->get_post('product_code_sr')==""?$this->session->unset_userdata('product_code_sr'):$this->main_model->handler0("product_code_sr",$this->input->get_post('product_code_sr', TRUE)));
            $product_name_sr = ($this->input->get_post('product_name_sr')==""?$this->session->unset_userdata('product_name_sr'):$this->main_model->handler0("product_name_sr",$this->input->get_post('product_name_sr', TRUE)));
            $category_sr = ($this->input->get_post('category_sr')==""?$this->session->unset_userdata('category_sr'):$this->main_model->handler0("category_sr",$this->input->get_post('category_sr', TRUE)));
            $merk_sr = ($this->input->get_post('merk_sr')==""?$this->session->unset_userdata('merk_sr'):$this->main_model->handler0("merk_sr",$this->input->get_post('merk_sr', TRUE)));
        }else{
            $page_sr = $this->main_model->handler0("page_sr",$this->input->get_post('page_sr', TRUE));
            $product_code_sr = $this->main_model->handler0("product_code_sr",$this->input->get_post('product_code_sr', TRUE));
            $product_name_sr = $this->main_model->handler0("product_name_sr",$this->input->get_post('product_name_sr', TRUE));
            $category_sr = $this->main_model->handler0("category_sr",$this->input->get_post('category_sr', TRUE));
            $merk_sr = $this->main_model->handler0("merk_sr",$this->input->get_post('merk_sr', TRUE));
        }
        $limit = ($this->uri->segment(3) > 0)?$this->uri->segment(3):0;

        $config['base_url'] = base_url() .'product_sale/search';
        $config['total_rows'] = $this->db->query("select a.id_product,product_code,product_name,b.name,c.product_category,d.id_product_sale
                                                  from product a
                                                  left join merk b on a.merk = b.id_merk
                                                  left join product_category c on a.product_category = c.id_product_category
                                                  inner join product_sale d on a.id_product=d.id_product
                                                  where a.product_code like '%$product_code_sr%' and a.product_name like '%$product_name_sr%'
                                                  and b.name like '%$merk_sr%' and c.product_category like '%$category_sr%' group by a.id_product
                                                  order by a.id_product desc
                                                 ")->num_rows();
        $config['per_page'] = ($page_sr > 0)?$page_sr:10;
        $config['uri_segment'] = 3;
        $choice = $config['total_rows']/$config['per_page'];
        $config['num_links'] = 2;		
        $this->pagination->initialize($config);

        $data['data'] = $this->db->query("select a.id_product,product_code,product_name,b.name,c.product_category,d.id_product_sale
                                                  from product a
                                                  left join merk b on a.merk = b.id_merk
                                                  left join product_category c on a.product_category = c.id_product_category
                                                  inner join product_sale d on a.id_product=d.id_product
                                                  where a.product_code like '%$product_code_sr%' and a.product_name like '%$product_name_sr%'
                                                  and b.name like '%$merk_sr%' and c.product_category like '%$category_sr%' group by a.id_product
                                                  order by a.id_product desc limit ".$limit.",".$config['per_page']."")->result();
        $data['halaman'] = $this->pagination->create_links();
        $data['total_data']= $this->db->query("select a.id_product,product_code,product_name,b.name,c.product_category,d.id_product_sale
                                                  from product a
                                                  left join merk b on a.merk = b.id_merk
                                                  left join product_category c on a.product_category = c.id_product_category
                                                  inner join product_sale d on a.id_product=d.id_product
                                                  where a.product_code like '%$product_code_sr%' and a.product_name like '%$product_name_sr%'
                                                  and b.name like '%$merk_sr%' and c.product_category like '%$category_sr%' group by a.id_product
                                                  order by a.id_product desc")->num_rows();
        $data['product_code_sr'] = $product_code_sr;
        $data['product_name_sr'] = $product_name_sr;
        $data['category_sr'] = $category_sr;
        $data['merk_sr'] = $merk_sr;
        $data['page_sr'] = $page_sr;
        $data['view']='search';
        $this->load->view('template',$data);
    }
    
    function add($posisi){
        $this->load->database('desalite',true);
        $data['list_product']=$this->db->query("select * from product order by product_name asc")->result();
        $data['posisi']=$posisi;
        $data['view']='add';
        $this->load->view('template',$data);
    }
    
    function add_proses(){
        $this->load->database('desalite',true);
        $posisi=$this->input->post('posisi');
        $id_product=$this->input->post('product');
        $status=$this->input->post('status');
        $quota=$this->input->post('quota');
        $price=$this->input->post('price');
        
        for($i=0;$i<count($quota);$i++){
            $data=array(
                'id_product'=>$id_product,
                'kuota'=>$quota[$i],
                'kuota_price'=>$price[$i]
            );
            $this->db->insert('product_sale',$data);
        }
        redirect('product_sale/search/'.$posisi);
    }
    
    function update($id,$posisi){
        $this->load->database('desalite',true);
        $data['list_product']=$this->db->query("select * from product order by product_name asc")->result();
        $data['list_sale']=$this->db->query("select * from product_sale where id_product ='$id' order by id_product_sale asc")->result();
        $data['posisi']=$posisi;
        $data['id_product']=$id;
        $data['view']='edit';
        $this->load->view('template',$data);
    }
    
    function update_proses(){
        $this->load->database('desalite',true);
        $posisi=$this->input->post('posisi');
        $id_product=$this->input->post('product');
        $status=$this->input->post('status');
        $quota=$this->input->post('quota');
        $price=$this->input->post('price');
        $this->db->query("DELETE FROM product_sale where id_product='$id_product'");
        for($i=0;$i<count($quota);$i++){
            $data=array(
                'id_product'=>$id_product,
                'kuota'=>$quota[$i],
                'kuota_price'=>$price[$i]
            );
            $this->db->insert('product_sale',$data);
        }
        redirect('product_sale/search/'.$posisi);
    }
    
    function delete($id,$posisi){
        $this->load->database('desalite',true);
        $this->main_model->delete("product_sale","id_product",$id);
        redirect('product_sale/search/'.$posisi);
    }
}