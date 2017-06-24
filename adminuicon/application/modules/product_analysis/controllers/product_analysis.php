<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_analysis extends MX_Controller{
    public function __construct() {
        parent::__construct();
        if($this->session->userdata('logged_in')==false){
            redirect('login');    
        }
        $this->load->model('m_product_analysis');
    }
        
    function index(){
        $this->session->unset_userdata('page_sr');
        $this->session->unset_userdata('category_sr');
        $this->session->unset_userdata('brand_sr');
        $this->session->unset_userdata('from_sr');
        $this->session->unset_userdata('to_sr');
        $config['base_url'] = base_url().'product_analysis/index/';
        $config['total_rows'] = $this->db->query("select a.*,b.product_name, sum(a.qty) as jum_barang, sum(if(c.special_price != 0, c.special_price, c.normal_price) * a.qty)  as harga
                                                  from transaksi_oke a 
                                                  inner join product_general b on a.id_product=b.id
                                                  inner join product_detail c on a.id_product=c.product_general_id
                                                  GROUP BY a.id_product")->num_rows();
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
        $data['total_data']=$this->db->query("select a.*,b.product_name, sum(a.qty) as jum_barang, sum(if(c.special_price != 0, c.special_price, c.normal_price) * a.qty)  as harga
                                            from transaksi_oke a 
                                            inner join product_general b on a.id_product=b.id
                                            inner join product_detail c on a.id_product=c.product_general_id
                                            GROUP BY a.id_product")->num_rows();
        $data['data'] = $this->db->query("select a.*,b.product_name, sum(a.qty) as jum_barang, sum(if(c.special_price != 0, c.special_price, c.normal_price) * a.qty)  as harga
                                        from transaksi_oke a 
                                        inner join product_general b on a.id_product=b.id
                                        inner join product_detail c on a.id_product=c.product_general_id
                                        GROUP BY a.id_product limit ".$pg.",".$config['per_page']."")->result();
        $data['category'] = $this->db->query("select * from product_category where product_category_status='Y' order by product_category_name asc")->result();
        $data['brand'] = $this->db->query("select * from brand where status='Y' order by brand_name asc")->result();
        $data['view']='main';
        $this->load->view('template',$data);
    }
    
    function search(){
        error_reporting(0);
        if(!$_POST){
        $type =  $this->session->userdata('type_sr');
        $brand=$this->session->userdata('brand_sr');
        $from=$this->session->userdata('from_sr');
        $to=$this->session->userdata('to_sr');
        $page=$this->session->userdata('page_sr');
        }else{
        $type=$this->input->post('type_sr');
        $brand=$this->input->post('brand_sr');
        $from=$this->input->post('from_sr');
        $to=$this->input->post('to_sr');
        $page=$this->input->post('page_sr');
        }
        
        $brx=  implode(',', $brand);
        $ctx=  implode(',', $type);
        
        if(in_array("" , $brand)){
            $cek_brand="kosong";
        }else{
            $cek_brand=$brand;
        }
        if(in_array("" , $type)){
            $cek_type="kosong";
        }else{
            $cek_type=$type;
        }
        
        $page_sr = $this->m_product_analysis->handler0($page);
        $brand_sr = $this->m_product_analysis->handler2($cek_brand);
        $type_sr = $this->m_product_analysis->handler3($type);
        $between="";
        if($this->input->post('from_sr')=="" && $this->input->post('to_sr')==""){
            $from_sr = "";
            $to_sr = "";
            $between="";
        }else{
            $from_sr = $this->m_product_analysis->handlerfrom("from_sr",$this->input->get_post('from_sr', TRUE));
            $to_sr = $this->m_product_analysis->handlerto("to_sr",$this->input->get_post('to_sr', TRUE));
            $between="and date(a.sys_create_date) BETWEEN '$from_sr' and '$to_sr'";
        }
        
        if($brand != NULL){
            $brand_x="and b.product_brand in ($brx)";
        }else{
            $brand_x="";
        }
        if($type != NULL){
            if($brand == "" && $color==""){
                $type_x="and b.product_category in ($ctx)";
            }else{
                $type_x="and b.product_category in ($ctx)";
            }
        }else{
            $type_x="";
        }
        
        //echo $id_sr,$name_sr,$status_sr;
        $limit = ($this->uri->segment(3) > 0)?$this->uri->segment(3):0;
        $config['base_url'] = base_url() .'product_analysis/search';
        $config['total_rows'] = $this->db->query("select a.*,b.product_name, sum(a.qty) as jum_barang, sum(if(c.special_price != 0, c.special_price, c.normal_price) * a.qty)  as harga
                                            from transaksi_oke a 
                                            inner join product_general b on a.id_product=b.id
                                            inner join product_detail c on a.id_product=c.product_general_id
                                            where b.product_category !=''
                                            $type_x
                                            $brand_x
                                            $between
                                            GROUP BY a.id_product")->num_rows();
        $config['per_page'] = ($page_sr > 0)?$page_sr:10;
        $config['uri_segment'] = 3;
        $choice = $config['total_rows']/$config['per_page'];
        $config['num_links'] = 2;		
        $this->pagination->initialize($config);

        $data['data'] = $this->db->query("select a.*,b.product_name, sum(a.qty) as jum_barang, sum(if(c.special_price != 0, c.special_price, c.normal_price) * a.qty)  as harga
                                            from transaksi_oke a 
                                            inner join product_general b on a.id_product=b.id
                                            inner join product_detail c on a.id_product=c.product_general_id
                                            where b.product_category !=''
                                            $type_x
                                            $brand_x
                                            $between
                                            GROUP BY a.id_product limit ".$limit.",".$config['per_page']."")->result();
        $data['halaman'] = $this->pagination->create_links();
        $data['total_data']= $this->db->query("select a.*,b.product_name, sum(a.qty) as jum_barang, sum(if(c.special_price != 0, c.special_price, c.normal_price) * a.qty)  as harga
                                            from transaksi_oke a 
                                            inner join product_general b on a.id_product=b.id
                                            inner join product_detail c on a.id_product=c.product_general_id
                                            where b.product_category !=''
                                            $type_x
                                            $brand_x
                                            $between
                                            GROUP BY a.id_product")->num_rows();
        $data['page_sr'] = $page_sr;
        $data['brand_sr'] = $brand_sr;
        $data['type_sr'] = $type_sr;
        $data['from_sr'] = $from_sr;
        $data['to_sr'] = $to_sr;
        $data['view']='search';
        $this->load->view('template',$data);
    }
    
}