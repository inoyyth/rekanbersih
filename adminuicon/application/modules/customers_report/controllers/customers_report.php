<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customers_report extends MX_Controller{
    public function __construct() {
        parent::__construct();
        if($this->session->userdata('logged_in')==false){
            redirect('login');    
        }
        $this->load->model('m_customers_report');
    }
        
    function index(){
        $this->load->database('desalite',true);
        $this->session->unset_userdata('page_sr');
        $this->session->unset_userdata('id_sr');
        $this->session->unset_userdata('name_sr');
        $this->session->unset_userdata('date_sr');
        $this->session->unset_userdata('price_sr');
        $this->session->unset_userdata('from_sr');
        $this->session->unset_userdata('to_sr');
        $config['base_url'] = base_url().'customers_report/index/';
        $config['total_rows'] = $this->db->query("select a.customer_code,name,register_date
                                                 sum(b.total_price) as jum
                                                 from customer a
                                                 LEFT JOIN so b on a.id_customer=b.customer
                                                 GROUP BY a.register_date")->num_rows();
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
        $data['total_data']=$this->db->query("select a.*,b.lastname_custdetail,firstname_custdetail,b.id as cust_id,b.sys_create_date as date_cust,
                                            sum(if(c.special_price != 0, c.special_price, c.normal_price) * a.qty)  as jum
                                            from transaksi_oke a
                                            LEFT JOIN cust_detail b on a.id_cust=b.id
                                            LEFT JOIN product_detail c on a.id_product=c.product_general_id
                                            GROUP BY a.id_cust")->num_rows();
        $data['data'] = $this->db->query("select a.*,b.lastname_custdetail,firstname_custdetail,b.id as cust_id,b.sys_create_date as date_cust,
                                        sum(if(c.special_price != 0, c.special_price, c.normal_price) * a.qty)  as jum
                                        from transaksi_oke a
                                        LEFT JOIN cust_detail b on a.id_cust=b.id
                                        LEFT JOIN product_detail c on a.id_product=c.product_general_id
                                        GROUP BY a.id_cust order by id desc limit ".$pg.",".$config['per_page']."")->result();
        $data['view']='main';
        $this->load->view('template',$data);
    }
    
    function search(){
        $page_sr = $this->m_customers_report->handler0("page_sr",$this->input->get_post('page_sr', TRUE));
        $id_sr = $this->m_customers_report->handler0("id_sr",$this->input->get_post('id_sr', TRUE));
        $name_sr = $this->m_customers_report->handler0("name_sr",$this->input->get_post('name_sr', TRUE));
        $date_sr = $this->m_customers_report->handler0("date_sr",$this->input->get_post('date_sr', TRUE));
        $price_sr = $this->m_customers_report->handler0("price_sr",$this->input->get_post('price_sr', TRUE));
        $between="";
        if($this->input->post('from_sr')=="" && $this->input->post('to_sr')==""){
            $from_sr = "";
            $to_sr = "";
            $between="";
        }else{
            $from_sr = $this->m_customers_report->handler0("from_sr",$this->input->get_post('from_sr', TRUE));
            $to_sr = $this->m_customers_report->handler0("to_sr",$this->input->get_post('to_sr', TRUE));
            $between="and date(b.sys_create_date) BETWEEN '$from_sr' and '$to_sr'";
        }
        //echo $id_sr,$name_sr,$status_sr;
        $limit = ($this->uri->segment(3) > 0)?$this->uri->segment(3):0;

        $config['base_url'] = base_url() .'logo/search';
        $config['total_rows'] = $this->db->query("select a.*,b.lastname_custdetail,firstname_custdetail,b.id as cust_id,b.sys_create_date as date_cust,
                                                 sum(if(c.special_price != 0, c.special_price, c.normal_price) * a.qty)  as jum
                                                 from transaksi_oke a
                                                 LEFT JOIN cust_detail b on a.id_cust=b.id
                                                 LEFT JOIN product_detail c on a.id_product=c.product_general_id
                                                 where b.id like '%$id_sr%' and b.firstname_custdetail like '%$name_sr%'
                                                 and date(b.sys_create_date) like '%$date_sr%' 
                                                 $between
                                                 GROUP BY a.id_cust")->num_rows();
        $config['per_page'] = ($page_sr > 0)?$page_sr:10;
        $config['uri_segment'] = 3;
        $choice = $config['total_rows']/$config['per_page'];
        $config['num_links'] = 2;		
        $this->pagination->initialize($config);

        $data['data'] = $this->db->query("select a.*,b.lastname_custdetail,firstname_custdetail,b.id as cust_id,b.sys_create_date as date_cust,
                                         sum(if(c.special_price != 0, c.special_price, c.normal_price) * a.qty)  as jum
                                         from transaksi_oke a
                                         LEFT JOIN cust_detail b on a.id_cust=b.id
                                         LEFT JOIN product_detail c on a.id_product=c.product_general_id
                                         where b.id like '%$id_sr%' and b.firstname_custdetail like '%$name_sr%'
                                         and date(b.sys_create_date) like '%$date_sr%'
                                         $between
                                         GROUP BY a.id_cust limit ".$limit.",".$config['per_page']."")->result();
        $data['halaman'] = $this->pagination->create_links();
        $data['total_data']= $this->db->query("select a.*,b.lastname_custdetail,firstname_custdetail,b.id as cust_id,b.sys_create_date as date_cust,
                                             sum(if(c.special_price != 0, c.special_price, c.normal_price) * a.qty)  as jum
                                             from transaksi_oke a
                                             LEFT JOIN cust_detail b on a.id_cust=b.id
                                             LEFT JOIN product_detail c on a.id_product=c.product_general_id
                                             where b.id like '%$id_sr%' and b.firstname_custdetail like '%$name_sr%'
                                             and date(b.sys_create_date) like '%$date_sr%'
                                             $between
                                             GROUP BY a.id_cust")->num_rows();
        $data['page_sr'] = $page_sr;
        $data['id_sr'] = $id_sr;
        $data['name_sr'] = $name_sr;
        $data['date_sr'] = $date_sr;
        $data['price_sr'] = $price_sr;
        $data['from_sr'] = $from_sr;
        $data['to_sr'] = $to_sr;
        $data['view']='search';
        $this->load->view('template',$data);
    }
        
    function update($id,$cust){
        $data['detail']=$this->db->query("select a.*,a.id as idx,b.product_name,c.product_category_name,d.brand_name,e.product_image1,f.*
                                        from transaksi_oke a
                                        INNER JOIN product_general b on a.id_product=b.id
                                        INNER JOIN product_category c on b.product_category=c.id
                                        INNER JOIN brand d on b.product_brand=d.id
                                        INNER JOIN product_images e on e.product_general_id=b.id
                                        INNER JOIN product_detail f on f.product_general_id=b.id
                                        where a.number_order='$id'")->result();
        $data['jum_brg']=$this->db->query("select sum(qty) as jum from transaksi_oke where number_order='$id'")->row();
        $data['jum_hrg']=$this->db->query("select sum(if(b.special_price != 0, b.special_price, b.normal_price) * a.qty) as jum from transaksi_oke a left join product_detail b on a.id_product=b.product_general_id where a.number_order='$id'")->row();
        $data['cust']=$this->db->query("select * from cust_detail where id='$cust'")->row();
        $data['view']="edit";
        $this->load->view("template",$data);
    }
    
    function update_proses(){
        $number_order = $this->input->post('order_number');
        $status = $this->input->post('status');
        $data=array('status_order'=>$status);
        $this->db->query("update transaksi_oke set status_order='$status' where number_order='$number_order'");
        redirect('order/index');
    }
    
    function invoice($id){
        $data['invoice']=$this->db->query("select a.*,b.normal_price,special_price,sum(a.qty) as jumx, sum(if(b.special_price != 0, b.special_price, b.normal_price) * a.qty)  as jum from transaksi_oke a left join product_detail b on a.id_product=b.product_general_id where a.id_cust='$id' group by number_invoice")->result();
        $data['cust']=$this->db->query("select * from cust_detail where id='$id'")->row();
        $data['view']='detail_invoice';
        $this->load->view("template",$data);
    }
    
    function detail_order($id){
        $data['detail']=$this->db->query("select a.*,a.id as idx,b.product_name,c.product_category_name,d.brand_name,e.product_image1,f.*
                                        from transaksi_oke a
                                        INNER JOIN product_general b on a.id_product=b.id
                                        INNER JOIN product_category c on b.product_category=c.id
                                        INNER JOIN brand d on b.product_brand=d.id
                                        INNER JOIN product_images e on e.product_general_id=b.id
                                        INNER JOIN product_detail f on f.product_general_id=b.id
                                        where a.number_order='$id'")->result();
        $data['jum_brg']=$this->db->query("select sum(qty) as jum from transaksi_oke where number_order='$id'")->row();
        $data['jum_hrg']=$this->db->query("select sum(if(b.special_price != 0, b.special_price, b.normal_price) * a.qty) as jum from transaksi_oke a left join product_detail b on a.id_product=b.product_general_id where a.number_order='$id'")->row();
        $data['disc']=$this->db->query("select a.*,b.* from voucher_oke a INNER JOIN coupon b on a.id_voucher=b.id where a.number_order ='$id'")->row();
        $data['view']="detail_order";
        $this->load->view("template",$data);
    }
        
}