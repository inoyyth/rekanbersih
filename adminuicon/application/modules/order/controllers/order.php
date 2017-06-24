<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends MX_Controller{
    public function __construct() {
        parent::__construct();
        if($this->session->userdata('logged_in')==false){
            redirect('login');    
        }
        $this->load->model('m_order');
    }
        
    function index(){
        $this->session->unset_userdata('page_sr');
        $this->session->unset_userdata('id_sr');
        $this->session->unset_userdata('invoice_sr');
        $this->session->unset_userdata('name_sr');
        $this->session->unset_userdata('date_sr');
        $this->session->unset_userdata('payment_sr');
        $this->session->unset_userdata('status_sr');
        $this->session->unset_userdata('from_sr');
        $this->session->unset_userdata('to_sr');
        $config['base_url'] = base_url().'order/index/';
        $config['total_rows'] = $this->db->query("select a.*,b.lastname_custdetail,firstname_custdetail,b.id as cust_id,
                                                 sum(if(c.special_price != 0, c.special_price, c.normal_price) * a.qty)  as jum
                                                 from transaksi_oke a
                                                 LEFT JOIN cust_detail b on a.id_cust=b.id
                                                 LEFT JOIN product_detail c on a.id_product=c.product_general_id
                                                 GROUP BY a.number_order")->num_rows();
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
        $data['total_data']=$this->db->query("select a.*,b.lastname_custdetail,firstname_custdetail,b.id as cust_id,
                                            sum(if(c.special_price != 0, c.special_price, c.normal_price) * a.qty)  as jum
                                            from transaksi_oke a
                                            LEFT JOIN cust_detail b on a.id_cust=b.id
                                            LEFT JOIN product_detail c on a.id_product=c.product_general_id
                                            GROUP BY a.number_order")->num_rows();
        $data['data'] = $this->db->query("select a.*,b.lastname_custdetail,firstname_custdetail,b.id as cust_id,
                                        sum(if(c.special_price != 0, c.special_price, c.normal_price) * a.qty)  as jum
                                        from transaksi_oke a
                                        LEFT JOIN cust_detail b on a.id_cust=b.id
                                        LEFT JOIN product_detail c on a.id_product=c.product_general_id
                                        GROUP BY a.number_order order by a.id desc limit ".$pg.",".$config['per_page']."")->result();
        $data['view']='main';
        $this->load->view('template',$data);
    }
    
    function search(){
        $page_sr = $this->m_order->handler0("page_sr",$this->input->get_post('page_sr', TRUE));
        $id_sr = $this->m_order->handler0("id_sr",$this->input->get_post('id_sr', TRUE));
        $invoice_sr = $this->m_order->handler0("invoice_sr",$this->input->get_post('invoice_sr', TRUE));
        $name_sr = $this->m_order->handler0("name_sr",$this->input->get_post('name_sr', TRUE));
        $date_sr = $this->m_order->handler0("date_sr",$this->input->get_post('date_sr', TRUE));
        $payment_sr = $this->m_order->handler0("payment_sr",$this->input->get_post('payment_sr', TRUE));
        $status_sr = $this->m_order->handler0("status_sr",$this->input->get_post('status_sr', TRUE));
        $between="";
        if($this->input->post('from_sr')=="" && $this->input->post('to_sr')==""){
            $from_sr = "";
            $to_sr = "";
            $between="";
        }else{
            $from_sr = $this->m_order->handler0("from_sr",$this->input->get_post('from_sr', TRUE));
            $to_sr = $this->m_order->handler0("to_sr",$this->input->get_post('to_sr', TRUE));
            $between="and date(a.sys_create_date) BETWEEN '$from_sr' and '$to_sr'";
        }
                
        $limit = ($this->uri->segment(3) > 0)?$this->uri->segment(3):0;

        $config['base_url'] = base_url() .'order/search';
        $config['total_rows'] = $this->db->query("select a.*,b.lastname_custdetail,firstname_custdetail,b.id as cust_id,
                                                 sum(if(c.special_price != 0, c.special_price, c.normal_price) * a.qty)  as jum
                                                 from transaksi_oke a
                                                 LEFT JOIN cust_detail b on a.id_cust=b.id
                                                 LEFT JOIN product_detail c on a.id_product=c.product_general_id
                                                 where a.number_order like '%$id_sr%' and a.number_invoice like '%$invoice_sr%'
                                                 and b.firstname_custdetail like '%$name_sr%' and date(a.sys_create_date) like '%$date_sr%'
                                                 and a.status_order like '%$status_sr%'
                                                 $between
                                                 GROUP BY a.number_order")->num_rows();
        $config['per_page'] = ($page_sr > 0)?$page_sr:10;
        $config['uri_segment'] = 3;
        $choice = $config['total_rows']/$config['per_page'];
        $config['num_links'] = 2;		
        $this->pagination->initialize($config);

        $data['data'] = $this->db->query("select a.*,b.lastname_custdetail,firstname_custdetail,b.id as cust_id,
                                         sum(if(c.special_price != 0, c.special_price, c.normal_price) * a.qty)  as jum
                                         from transaksi_oke a
                                         LEFT JOIN cust_detail b on a.id_cust=b.id
                                         LEFT JOIN product_detail c on a.id_product=c.product_general_id
                                         where a.number_order like '%$id_sr%' and a.number_invoice like '%$invoice_sr%'
                                         and b.firstname_custdetail like '%$name_sr%' and date(a.sys_create_date) like '%$date_sr%'
                                         and a.status_order like '%$status_sr%'
                                         $between
                                         GROUP BY a.number_order order by a.id desc
                                         limit ".$limit.",".$config['per_page']."")->result();
        $data['halaman'] = $this->pagination->create_links();
        $data['total_data']= $this->db->query("select a.*,b.lastname_custdetail,firstname_custdetail,b.id as cust_id,
                                             sum(if(c.special_price != 0, c.special_price, c.normal_price) * a.qty)  as jum
                                             from transaksi_oke a
                                             LEFT JOIN cust_detail b on a.id_cust=b.id
                                             LEFT JOIN product_detail c on a.id_product=c.product_general_id
                                             where a.number_order like '%$id_sr%' and a.number_invoice like '%$invoice_sr%'
                                             and b.firstname_custdetail like '%$name_sr%' and date(a.sys_create_date) like '%$date_sr%'
                                             and a.status_order like '%$status_sr%'
                                             $between 
                                             GROUP BY a.number_order")->num_rows();
        $data['page_sr'] = $page_sr;
        $data['id_sr'] = $id_sr;
        $data['invoice_sr'] = $invoice_sr;
        $data['name_sr'] = $name_sr;
        $data['date_sr'] = $date_sr;
        $data['payment_sr'] = $payment_sr;
        $data['status_sr'] = $status_sr;
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
        $data['billing']=$this->db->query("select * from cust_billing where number_order='$id'")->row();
        $data['disc']=$this->db->query("select a.*,b.* from voucher_oke a INNER JOIN coupon b on a.id_voucher=b.id where a.number_order ='$id'")->row();
        $data['disc_tempx']=$this->db->query("select distinct(discount) as total from transaksi_oke where number_order='$id'")->row();
        $data['view']="edit";
        $this->load->view("template",$data);
    }
    
    function update_proses(){
        $number_order = $this->input->post('order_number');
        $status = $this->input->post('status');
        $email = $this->input->post('email');
        $rwbill = $this->input->post('rwbill');
        $data=array('status_order'=>$status);
        if($status=="shipped"){
        $this->db->query("update transaksi_oke set status_order='$status', rwbill='$rwbill' where number_order='$number_order'");
        
        //kirim email
        //$email=  $this->input->post('email');
        $data['order']=$this->db->query("select a.*,b.*,c.* from transaksi_oke a 
                                        inner join product_detail b on a.id_product=b.product_general_id
                                        inner join product_general c on a.id_product=c.id
                                        where a.number_order='$number_order' AND a.payment_method='Bank Transfers'")->result();
        $data['totx']=$this->db->query("SELECT
                                        sum(if(a.special_price != 0, a.special_price, a.normal_price) * c.qty)  as jum
                                        from product_detail a
                                        left JOIN product_general b on a.product_general_id=b.id
                                        LEFT JOIN transaksi_oke c on a.product_general_id=c.id_product
                                        where c.number_order='$number_order'")->row();
        $data['billing']=$this->db->query("select a.*,b.*,b.zip as zip_ship from cust_billing a inner join cust_detail b on a.cust_detail_id=b.id where a.number_order='$number_order'")->row();
        $data['disc']=$this->db->query("select a.*,b.* from voucher_oke a INNER JOIN coupon b on a.id_voucher=b.id where a.number_order ='$number_order'")->row();
        $data['disc_hit']=$this->db->query("select a.*,b.* from voucher_oke a INNER JOIN coupon b on a.id_voucher=b.id where a.number_order ='$number_order'")->num_rows();
        //$data['shipping']=$this->db->query("select * from cust_detail where id='".$session_data['id']."'")->row();
        $data['disc_tempx']=$this->db->query("select distinct(discount) as total from transaksi_oke where number_order='$number_order'")->row();
        $data['number_order']=$number_order;
        $data['email']=$email;
        $data['rwbill']=$rwbill;
        $ci = get_instance();
        $ci->load->library('email');
        //$config['protocol'] = "smtp";
        $config['smtp_host'] = "ssl://smtp.gmail.com";
        $config['smtp_port'] = "465";
        $config['smtp_user'] = "supri170845@gmail.com"; 
        $config['smtp_pass'] = "170845inoy";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        $config['protocol'] = 'sendmail';
        $config['wordwrap'] = TRUE;
        $ci->email->initialize($config);

        $ci->email->from('info@urbanicon.co.id', 'Urbanicon');
        $ci->email->to($email);
        $ci->email->subject("Order Shipped Notice");
        $ci->email->cc('fhenny@time.co.id');
        $ci->email->message($this->load->view('invoice_user',$data,TRUE));
        $ci->email->send();
        
        $ci->email->from('info@urbanicon.co.id', 'Urbanicon');
        $ci->email->cc('fhenny@time.co.id');
        $ci->email->to('urbanicon@time.co.id');
        $ci->email->bcc('supri170845@gmail.com');
        $ci->email->subject("Order Shipped Notice");
        $ci->email->message($this->load->view('invoice_admin',$data,TRUE));
        $ci->email->send();
        
        }elseif($status=="payment verified"){
            
        $this->db->query("update transaksi_oke set status_order='$status' where number_order='$number_order'");
        $this->db->query("update payment_confirmation set status='verified' where order_number='$number_order'");
        
        //kirim email
        //$email=  $this->input->post('email');
        $data['order']=$this->db->query("select a.*,b.*,c.* from transaksi_oke a 
                                        inner join product_detail b on a.id_product=b.product_general_id
                                        inner join product_general c on a.id_product=c.id
                                        where a.number_order='$number_order' AND a.payment_method='Bank Transfers'")->result();
        $data['totx']=$this->db->query("SELECT
                                        sum(if(a.special_price != 0, a.special_price, a.normal_price) * c.qty)  as jum
                                        from product_detail a
                                        left JOIN product_general b on a.product_general_id=b.id
                                        LEFT JOIN transaksi_oke c on a.product_general_id=c.id_product
                                        where c.number_order='$number_order'")->row();
        $data['billing']=$this->db->query("select a.*,b.*,b.zip as zip_ship from cust_billing a inner join cust_detail b on a.cust_detail_id=b.id where a.number_order='$number_order'")->row();
        $data['disc']=$this->db->query("select a.*,b.* from voucher_oke a INNER JOIN coupon b on a.id_voucher=b.id where a.number_order ='$number_order'")->row();
        $data['disc_hit']=$this->db->query("select a.*,b.* from voucher_oke a INNER JOIN coupon b on a.id_voucher=b.id where a.number_order ='$number_order'")->num_rows();
        //$data['shipping']=$this->db->query("select * from cust_detail where id='".$session_data['id']."'")->row();
        $data['disc_tempx']=$this->db->query("select distinct(discount) as total from transaksi_oke where number_order='$number_order'")->row();
        $data['number_order']=$number_order;
        $data['email']=$email;
        $ci = get_instance();
        $ci->load->library('email');
        //$config['protocol'] = "smtp";
        $config['smtp_host'] = "ssl://smtp.gmail.com";
        $config['smtp_port'] = "465";
        $config['smtp_user'] = "supri170845@gmail.com"; 
        $config['smtp_pass'] = "170845inoy";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        $config['protocol'] = 'sendmail';
        $config['wordwrap'] = TRUE;
        $ci->email->initialize($config);

        $ci->email->from('info@urbanicon.co.id', 'Urbanicon');
        $ci->email->to($email);
        $ci->email->subject("Invoice Urbanicon(Payment Confirmed)");
        $ci->email->message($this->load->view('invoice_user_pay_verified',$data,TRUE));
        $ci->email->send();
        
        $ci->email->from('info@urbanicon.co.id', 'Urbanicon');
        $ci->email->to('urbanicon@time.co.id');
        $ci->email->cc('fhenny@time.co.id');
        $ci->email->bcc('supri170845@gmail.com');
        $ci->email->subject("Invoice Urbanicon(Payment verified)");
        $ci->email->message($this->load->view('invoice_user_pay_verified',$data,TRUE));
        $ci->email->send();
        }
        elseif($status=="cancel"){
            
        $this->db->query("update transaksi_oke set status_order='$status' where number_order='$number_order'");
        //$this->db->query("update payment_confirmation set status_order='verified' where order_number='$number_order'");
        
        //kirim email
        //$email=  $this->input->post('email');
        $data['order']=$this->db->query("select a.*,b.*,c.* from transaksi_oke a 
                                        inner join product_detail b on a.id_product=b.product_general_id
                                        inner join product_general c on a.id_product=c.id
                                        where a.number_order='$number_order' AND a.payment_method='Bank Transfers'")->result();
        $data['totx']=$this->db->query("SELECT
                                        sum(if(a.special_price != 0, a.special_price, a.normal_price) * c.qty)  as jum
                                        from product_detail a
                                        left JOIN product_general b on a.product_general_id=b.id
                                        LEFT JOIN transaksi_oke c on a.product_general_id=c.id_product
                                        where c.number_order='$number_order'")->row();
        $data['billing']=$this->db->query("select a.*,b.*,b.zip as zip_ship from cust_billing a inner join cust_detail b on a.cust_detail_id=b.id where a.number_order='$number_order'")->row();
        $data['disc']=$this->db->query("select a.*,b.* from voucher_oke a INNER JOIN coupon b on a.id_voucher=b.id where a.number_order ='$number_order'")->row();
        $data['disc_hit']=$this->db->query("select a.*,b.* from voucher_oke a INNER JOIN coupon b on a.id_voucher=b.id where a.number_order ='$number_order'")->num_rows();
        //$data['shipping']=$this->db->query("select * from cust_detail where id='".$session_data['id']."'")->row();
        $data['disc_tempx']=$this->db->query("select distinct(discount) as total from transaksi_oke where number_order='$number_order'")->row();
        $data['number_order']=$number_order;
        $data['email']=$email;
        $ci = get_instance();
        $ci->load->library('email');
        //$config['protocol'] = "smtp";
        $config['smtp_host'] = "ssl://smtp.gmail.com";
        $config['smtp_port'] = "465";
        $config['smtp_user'] = "supri170845@gmail.com"; 
        $config['smtp_pass'] = "170845inoy";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        $config['protocol'] = 'sendmail';
        $config['wordwrap'] = TRUE;
        $ci->email->initialize($config);

        $ci->email->from('info@urbanicon.co.id', 'Urbanicon');
        $ci->email->to($email);
        $ci->email->subject("Order Cancelled");
        $ci->email->message($this->load->view('invoice_user_cancelled',$data,TRUE));
        $ci->email->send();
        
        $ci->email->from('info@urbanicon.co.id', 'Urbanicon');
        $ci->email->to('urbanicon@time.co.id');
        $ci->email->cc('fhenny@time.co.id');
        $ci->email->bcc('supri170845@gmail.com');
        $ci->email->subject("Invoice Urbanicon(Order Cancelled)");
        $ci->email->message($this->load->view('invoice_admin_cancelled',$data,TRUE));
        $ci->email->send();
        
        $sx=$this->db->query("SELECT * FROM transaksi_oke where number_order='$number_order'")->result();
            foreach($sx as $xx){
                $q=$this->db->query("select * from product_detail where product_general_id='$xx->id_product'")->row();
                $hsl=$q->stock + $xx->qty;
                $up=$this->db->query("update product_detail set stock='$hsl' where product_general_id='$xx->id_product'");
            }        
        }
        redirect('order/index');
    }
        
}