<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sales_report extends MX_Controller{
    public function __construct() {
        parent::__construct();
        if($this->session->userdata('logged_in')==false){
            redirect('login');    
        }
        $this->load->model('m_sales_report');
    }
        
    function index(){
        $this->session->unset_userdata('category_sr');
        $this->session->unset_userdata('brand_sr');
        $this->session->unset_userdata('from_sr');
        $this->session->unset_userdata('to_sr');
        $data['total_harga']=$this->db->query("select sum(if(c.special_price != 0, c.special_price, c.normal_price) * a.qty)  as harga
                                                from transaksi_oke a 
                                                inner join product_general b on a.id_product=b.id
                                                inner join product_detail c on a.id_product=c.product_general_id")->row();
        $data['jumlah_barang']=$this->db->query("select sum(a.qty)  as harga
                                                from transaksi_oke a 
                                                inner join product_general b on a.id_product=b.id
                                                inner join product_detail c on a.id_product=c.product_general_id")->row();
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
        }else{
        $type=$this->input->post('type_sr');
        $brand=$this->input->post('brand_sr');
        $from=$this->input->post('from_sr');
        $to=$this->input->post('to_sr');
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
        
        $page_sr = $this->m_sales_report->handler0($page);
        $brand_sr = $this->m_sales_report->handler2($cek_brand);
        $type_sr = $this->m_sales_report->handler3($type);
        $between="";
        if($this->input->post('from_sr')=="" && $this->input->post('to_sr')==""){
            $from_sr = "";
            $to_sr = "";
            $between="";
        }else{
            $from_sr = $this->m_sales_report->handlerfrom("from_sr",$this->input->get_post('from_sr', TRUE));
            $to_sr = $this->m_sales_report->handlerto("to_sr",$this->input->get_post('to_sr', TRUE));
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
        $data['total_harga']=$this->db->query("select sum(if(c.special_price != 0, c.special_price, c.normal_price) * a.qty)  as harga
                                                from transaksi_oke a 
                                                inner join product_general b on a.id_product=b.id
                                                inner join product_detail c on a.id_product=c.product_general_id
                                                where b.product_category !=''
                                                $type_x
                                                $brand_x
                                                $between
                                                ")->row();
        $data['jumlah_barang']=$this->db->query("select sum(a.qty)  as harga
                                                from transaksi_oke a 
                                                inner join product_general b on a.id_product=b.id
                                                inner join product_detail c on a.id_product=c.product_general_id
                                                where b.product_category !=''
                                                $type_x
                                                $brand_x
                                                $between
                                                ")->row();
        $data['brand_sr'] = $brand_sr;
        $data['type_sr'] = $type_sr;
        $data['from_sr'] = $from_sr;
        $data['to_sr'] = $to_sr;
        $data['view']='search';
        $this->load->view('template',$data);
    }
    
}