<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class So extends MX_Controller{
    public function __construct() {
        parent::__construct();
//        if($this->session->userdata('logged_in')==false){
//            redirect('login');    
//        }
        $this->load->model('m_so');
        $this->load->model('main_model');
    }
        
    function index(){
        $this->load->database('desalite',true);
        $this->session->unset_userdata('page_sr');
        $this->session->unset_userdata('so_sr');
        $this->session->unset_userdata('customer_sr');
        $this->session->unset_userdata('status_sr');
        $this->session->unset_userdata('price_sr');
        $config['base_url'] = base_url().'so/index/';
        $config['total_rows'] = $this->db->query("select a.id_so,so_number,status,total_price,b.name from so a left join customer b on a.customer=b.id_customer order by a.id_so desc")->num_rows();
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
        $data['total_data']=$this->db->query("select a.id_so,so_number,status,total_price,b.name from so a left join customer b on a.customer=b.id_customer order by a.id_so desc")->num_rows();
        $data['data'] = $this->db->query("select a.id_so,so_number,status,total_price,b.name from so a left join customer b on a.customer=b.id_customer order by a.id_so desc limit ".$pg.",".$config['per_page']."")->result();
        $data['view']='main';
        $this->load->view('template',$data);
    }
    
    public function search()
	{
        $this->load->database('desalite',true);
        if($_POST){
            $page_sr = ($this->input->get_post('page_sr')==""?$this->session->unset_userdata('page_sr'):$this->main_model->handler0('page_sr',$this->input->get_post('page_sr', TRUE)));
            $so_sr = ($this->input->get_post('so_sr')==""?$this->session->unset_userdata('so_sr'):$this->main_model->handler0('so_sr',$this->input->get_post('so_sr', TRUE)));
            $customer_sr = ($this->input->get_post('customer_sr')==""?$this->session->unset_userdata('customer_sr'):$this->main_model->handler0('customer_sr',$this->input->get_post('customer_sr', TRUE)));
            $status_sr = ($this->input->get_post('status_sr')==""?$this->session->unset_userdata('status_sr'):$this->main_model->handler0('status_sr',$this->input->get_post('status_sr', TRUE)));
            $price_sr = ($this->input->get_post('price_sr')==""?$this->session->unset_userdata('price_sr'):$this->main_model->handler0('price_sr',$this->input->get_post('price_sr', TRUE)));
        }else{
            $page_sr = $this->main_model->handler0('page_sr',$this->input->get_post('page_sr', TRUE));
            $so_sr = $this->main_model->handler0('so_sr',$this->input->get_post('so_sr', TRUE));
            $customer_sr = $this->main_model->handler0('customer_sr',$this->input->get_post('customer_sr', TRUE));
            $status_sr = $this->main_model->handler0('status_sr',$this->input->get_post('status_sr', TRUE));
            $price_sr = $this->main_model->handler0('price_sr',$this->input->get_post('price_sr', TRUE));
        }
            $limit = ($this->uri->segment(3) > 0)?$this->uri->segment(3):0;

            $config['base_url'] = base_url() . 'so/search';
            $config['total_rows'] = $this->db->query("select a.id_so,so_number,status,total_price,b.name from so a left join customer b on a.customer=b.id_customer where a.so_number like '%$so_sr%' and b.name like '%$customer_sr%' and a.status like '%$status_sr%' and a.total_price like '%$price_sr%' order by a.id_so desc")->num_rows();
            $config['per_page'] = ($page_sr > 0)?$page_sr:10;
            $config['uri_segment'] = 3;
            $choice = $config['total_rows']/$config['per_page'];
            $config['num_links'] = 2;		
            $this->pagination->initialize($config);

            $data['data'] = $this->db->query("select a.id_so,so_number,status,total_price,b.name from so a left join customer b on a.customer=b.id_customer where a.so_number like '%$so_sr%' and b.name like '%$customer_sr%' and a.status like '%$status_sr%' and a.total_price like '%$price_sr%' order by a.id_so desc limit ".$limit.",".$config['per_page']."")->result();
            $data['halaman'] = $this->pagination->create_links();
            $data['total_data']= $this->db->query("select a.id_so,so_number,status,total_price,b.name from so a left join customer b on a.customer=b.id_customer where a.so_number like '%$so_sr%' and b.name like '%$customer_sr%' and a.status like '%$status_sr%' and a.total_price like '%$price_sr%' order by a.id_so desc")->num_rows();
            $data['page_sr'] = $page_sr;
            $data['so_sr'] = $so_sr;
            $data['customer_sr'] = $customer_sr;
            $data['status_sr'] = $status_sr;
            $data['price_sr'] = $price_sr;
            $data['view']='search';
            $this->load->view('template',$data);
	}
    
    function add(){
        $data['view']='add';
        $this->load->view('template',$data);
    }
    function add_proses(){
        $this->load->database('desalite',true);
        $session_data = $this->session->userdata('logged_in');
        $name=$this->input->post('so_name');
        $abbreviation=$this->input->post('abbreviation');
        
        $data=array(
            'name'=>$name,
            'abbreviation'=>$abbreviation
        );
        $this->main_model->insert('so',$data);
        
        redirect("so/search");
    }
    
    function detail($id,$page){
        $this->load->database('desalite',true);
        $data['pre_so']=$this->db->query("select a.*,b.name,adress,province,city,contact,tlp,fax,email,reseller from pre_so a left join customer b on a.customer=b.id_customer where a.so='$id'")->row();
        $data['pre_so_finish_product']=$this->db->query("select a.*,b.product_name,product_code,c.product_category,d.name as merk
                                                    from pre_so_finish_product a 
                                                    left join product b on a.product=b.id_product
                                                    left join product_category c on b.product_category=c.id_product_category
                                                    left join merk d on b.merk=d.id_merk
                                                    where a.so='$id'")->result();
        $data['so']=$this->db->query("select a.*,b.name,adress,province,city,contact,tlp,fax,email,reseller from so a left join customer b on a.customer=b.id_customer where a.id_so='$id'")->row();
        $data['so_finish_product']=$this->db->query("select a.*,b.product_name,product_code,c.product_category,d.name as merk
                                                    from so_finish_product a 
                                                    left join product b on a.product=b.id_product
                                                    left join product_category c on b.product_category=c.id_product_category
                                                    left join merk d on b.merk=d.id_merk
                                                    where a.so='$id'")->result();
        $data['shipping_exp']=$this->db->query("select * from so_shipping where id_so='$id'")->row();
        $so=$this->db->query("select so_number from so where id_so='$id'")->row('so_number');
        $data['payment_confirmation']=$this->db->query("select * from payment_confirmation where so_number='$so'");
        $data['posisi']=$page;
        $data['view']='detail';
        $this->load->view('template',$data);
    }
    
    function update_so_status(){
        $this->load->database('desalite',true);
        $id_so=$this->input->post('id_so');
        $id_user=$this->input->post('id_user');
        $order_status=$this->input->post('order_status');
        $tracking_number=$this->input->post('tracking_number');
        $po_number=$this->input->post('po_number');
        $data=array(
            'status'=>$order_status,
            'tracking_order'=>$tracking_number,
            'po_cust'=>$po_number
        );
        $this->main_model->update('so','id_so',$id_so,$data);
        if($order_status=="deliver"){
            $this->send_mail($id_user,$id_so);
        }
        if($order_status=="deliver"){
            //get refrence code
            $refrence_code=$this->db->query("select refrence_id from customer where id_customer='$id_user'")->row();
            if($refrence_code->refrence_id!==""){
                //totalin dulu afiliasi price berapa si refrence dapat
                $jum_bonus=$this->db->query("SELECT sum(a.afiliasi_price * b.qty) as jum from product a 
LEFT JOIN so_finish_product b on a.id_product=b.product 
where b.so ='$id_so'")->row();
                //cek dulu berapa si reference id punya dolang
                $refrence_balance=$this->db->query("select balance,id_customer from customer where customer_code='".$refrence_code->refrence_id."'")->row();
                //update dolang si refrence
                $all_balance=($refrence_balance->balance + $jum_bonus->jum);
                $data_balance=array('balance'=>$all_balance);
                $this->db->where("customer_code",$refrence_code->refrence_id);
                $this->db->update('customer',$data_balance);
                //gift wallet
                $data_gift_wallet=array(
                    'id_so'=>$id_so,
                    'id_customer_gift'=>$id_user,
                    'id_customer_get'=>$refrence_balance->id_customer,
                    'get_balance'=>$jum_bonus->jum
                );
                $this->db->insert('gift_wallet',$data_gift_wallet);
            }
        }
        return TRUE;
    }
    
    function send_mail($id_user,$id_so){
        //function send_mail($id_user=147,$id_so='119'){
        //$this->load->library('encrypt');
        //$this->load->library('my_encrypt');
        //$encod = $this->my_encrypt->encode($email);
        $this->load->database('desalite',true);
        $admin = "admin@tokofilter.com";
        $mail_x=$this->db->query("select email from customer where id_customer='$id_user'")->row();
        $data['user']=$this->db->query("select a.*,b.provinsi,c.kabupaten from customer a left join provinsi b on a.province=b.id left join kabupaten c on a.city=c.id where a.id_customer='$id_user'")->row();
        $data['so_finish_product']=$this->db->query("select a.*,b.product_code,product_name,cost_price,special_price from so_finish_product a left join product b on a.product=b.id_product where so='$id_so'")->result();
        $data['so']=$this->db->query("select * from so where id_so='$id_so'")->row();
        $data['shipping']=$this->db->query("select a.*,b.provinsi,c.kabupaten from so_shipping a left join provinsi b on a.province=b.id left join kabupaten c on a.city=c.id where a.id_so='$id_so'")->row();
        $data['url_base']=  base_url();
        $this->load->database('default',true);
        $data['email_setting'] = $this->db->query("select * from email_setting where id='1'")->row();
        $ci = get_instance();
        $ci->load->library('email');
        $config['protocol'] = "smtp";
        $config['smtp_host'] = "ssl://smtp.gmail.com";
        $config['smtp_port'] = "465";
        $config['smtp_user'] = "supri170845@gmail.com"; 
        $config['smtp_pass'] = "170845inoy";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        //$config['protocol'] = 'sendmail';
        $config['wordwrap'] = TRUE;
        $ci->email->initialize($config);

        $ci->email->from('info@tokofilterair.com', 'tokofilterair.com');
        $ci->email->to($mail_x->email);
        $ci->email->subject("TOKO FILTER AIR | Order Deliver");
        $ci->email->message($this->load->view('email_user',$data,TRUE));
        $ci->email->send();
        return true;
    }
    
    function update_qty(){
        $this->load->database('desalite',true);
        $so=$this->input->post('so');
        $id_so_finish=$this->input->post('id_so_finish');
        $jum=$this->input->post('jum'); 
        $exp_price_before=$this->input->post('exp_price_before');
        $current_so=$this->db->query("select * from so where id_so='$so'")->row();
        $current_so_finish_product=$this->db->query("select * from so_finish_product where id_so_finish_product='$id_so_finish'")->row();
        $qty_price=($jum * $current_so_finish_product->unit_price);
        $data_so_finish_product_update=array('qty'=>$jum,'total_price'=>$qty_price);
        $this->main_model->update("so_finish_product","id_so_finish_product",$id_so_finish,$data_so_finish_product_update);
        $total_so_finish_product=$this->db->query("select sum(total_price) as total_so_finish from so_finish_product where so='$so'")->row();
        $total_so_finish_product_cutprice=(($total_so_finish_product->total_so_finish - $current_so->cut_price) + $exp_price_before);
        $data_so_update=array('total_price'=>$total_so_finish_product_cutprice,'sub_total'=>$total_so_finish_product->total_so_finish);
        $this->main_model->update("so","id_so",$so,$data_so_update);
        return true;
    }
    
    function update_expedition(){
        $this->load->database('desalite',true);
        $shipping_id=$this->input->post('shipping_id');
        $exp_price=  str_replace(".","",$this->input->post('exp_price'));
        $exp_service=$this->input->post('exp_service_name');
        $exp_name=$this->input->post('exp_name');
        $so_number=$this->input->post('so_number');
        $so_total_price=$this->input->post('so_total_price');
        $exp_price_before=$this->input->post('exp_price_before');
        $data=array(
            'expedition_name'=>$exp_name,
            'expedition_service'=>$exp_service,
            'expedition_price'=>$exp_price
        );
        $this->main_model->update("so_shipping","id",$shipping_id,$data);
        
        $total_price_before=($so_total_price - $exp_price_before);
        $data_updata_so_before=array('total_price'=>$total_price_before);
        $this->main_model->update("so","id_so",$so_number,$data_updata_so_before);
        
        $data_so=$this->db->query("select total_price from so where id_so='$so_number'")->row();
        $total_price=($data_so->total_price + $exp_price);
        $data_updata_so=array('total_price'=>$total_price);
        $this->main_model->update("so","id_so",$so_number,$data_updata_so);
        
        //pre order
        $data_pre_so_before=$this->db->query("select total_price from pre_so where so='$so_number'")->row();
        $pre_total_price_before=($data_pre_so_before->total_price - $exp_price_before);
        $data_updata_pre_so_before=array('total_price'=>$pre_total_price_before);
        $this->main_model->update("pre_so","so",$so_number,$data_updata_pre_so_before);
        
        $data_pre_so=$this->db->query("select total_price from pre_so where so='$so_number'")->row();
        $pre_total_price=($data_pre_so->total_price + $exp_price);
        $data_updata_pre_so=array('total_price'=>$pre_total_price);
        $this->main_model->update("pre_so","so",$so_number,$data_updata_pre_so);
        
        return true;
    }
    
    function send_email_confirmation(){
        $this->load->database('desalite',true);
        $id_so=$this->input->post('id_so');
        $email_information=$this->input->post('email_information');
        $customer=$this->input->post('customer');
        $shipping_information=$this->db->query("select a.*,b.provinsi,c.kabupaten from so_shipping a left join provinsi b on a.province=b.id left join kabupaten c on a.city=c.id where a.id_so='$id_so'");
        $customer_information=$this->db->query("select a.*,b.provinsi,c.kabupaten from customer a left join provinsi b on a.province=b.id left join kabupaten c on a.city=c.id where a.id_customer='$customer'");
        $data['url_base']=  base_url();
        $data['pre_so']=$this->main_model->select_where("pre_so","so",$id_so)->row();
        $data['pre_so_finish_product']=$this->db->query("select a.*,b.product_code,product_name from pre_so_finish_product a left join product b on a.product=b.id_product where a.so='$id_so' order by b.product_name asc")->result();
        $data['so']=$this->main_model->select_where("so","id_so",$id_so)->row();
        $data['so_finish_product']=$this->db->query("select a.*,b.product_code,product_name from so_finish_product a left join product b on a.product=b.id_product where a.so='$id_so' order by b.product_name asc")->result();
        $data['shipping']=$shipping_information->row();
        $data['customer']=$customer_information->row();
        $data['email_information']=$email_information;
        $data['url_base']=base_url();
        $data['url_so']=$this->uri->segment(3);
        $this->load->library('encrypt');
        $this->load->library('my_encrypt');
        $data['id_so_encode'] = $this->my_encrypt->encode($id_so);
        $this->db->query("update so set email_information='$email_information' where id_so='$id_so'");
        $ci = get_instance();
        $ci->load->library('email');
        $config['protocol'] = "smtp";
        $config['smtp_host'] = "ssl://smtp.gmail.com";
        $config['smtp_port'] = "465";
        $config['smtp_user'] = "supri170845@gmail.com"; 
        $config['smtp_pass'] = "170845inoy";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        //$config['protocol'] = 'sendmail';
        $config['wordwrap'] = TRUE;
        $ci->email->initialize($config);

        $ci->email->from('info@tokofilterair.com', 'tokofilterair.com');
        $ci->email->to($customer_information->row('email'));
        $ci->email->cc($shipping_information->row('email'));
        $ci->email->subject("TOKO FILTER AIR | Your Request Confirmation ");
        $ci->email->message($this->load->view('so_email_confirmation',$data,TRUE));
        $ci->email->send();
        return true;
    }
    
    function update_status($id,$status){
        $this->load->database('desalite',true);
        //encrypt-nya di decode dulu biar keliahatan
        $this->load->library('encrypt');
        $this->load->library('my_encrypt');
        $id_so = $this->my_encrypt->decode($id);
        if($status=="1"){
            $status_x="confirmed";
        }else if($status=="2"){
            $status_x="waiting";
        }else{
            $status_x="close";
        }
        //cek dulu apakah email tersebut sudah di konfirmasi sebelumnya
        $cek_status=$this->db->query("select email_confirmed_status from so where id_so='$id_so'")->row();
        if($cek_status->email_confirmed_status=="0"){
        //update dulu status so-nya sesuai yang dikirim dari email confirmed
        $this->db->query("update so set status='$status_x',email_confirmed_status='1' where id_so='$id_so'");
        //dapetin informasi tentang user,so_shipping dan so
        $so_information=$this->db->query("select * from so where id_so='$id_so'");
        $customer_information=$this->db->query("select a.*,b.provinsi,c.kabupaten from customer a left join provinsi b on a.province=b.id left join kabupaten c on a.city=c.id where a.id_customer='".$so_information->row('customer')."'");
        $shipping_information=$this->db->query("select a.*,b.provinsi,c.kabupaten from so_shipping a left join provinsi b on a.province=b.id left join kabupaten c on a.city=c.id where a.id_so='".$so_information->row('id_so')."'");
        $data['pre_so']=$this->main_model->select_where("pre_so","so",$id_so)->row();
        $data['pre_so_finish_product']=$this->db->query("select a.*,b.product_code,product_name from pre_so_finish_product a left join product b on a.product=b.id_product where a.so='$id_so' order by b.product_name asc")->result();
        $data['so']=$this->main_model->select_where("so","id_so",$id_so)->row();
        $data['so_finish_product']=$this->db->query("select a.*,b.product_code,product_name from so_finish_product a left join product b on a.product=b.id_product where a.so='$id_so' order by b.product_name asc")->result();
        $data['shipping']=$shipping_information->row();
        $data['customer']=$customer_information->row();
        //kirim email
        $ci = get_instance();
        $ci->load->library('email');
        $config['protocol'] = "smtp";
        $config['smtp_host'] = "ssl://smtp.gmail.com";
        $config['smtp_port'] = "465";
        $config['smtp_user'] = "supri170845@gmail.com"; 
        $config['smtp_pass'] = "170845inoy";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        //$config['protocol'] = 'sendmail';
        $config['wordwrap'] = TRUE;
        $ci->email->initialize($config);

        $ci->email->from('info@tokofilterair.com', 'tokofilterair.com');
        $ci->email->to($customer_information->row('email'));
        $ci->email->cc($shipping_information->row('email'));
        $ci->email->subject("TOKO FILTER AIR | Your Request Status ");
        $ci->email->message($this->load->view('so_email_status',$data,TRUE));
        $ci->email->send();
        //return true;
            redirect(base_url2()."so/email_confirmed/".$id);
        }else{
            redirect(base_url2()."so/email_confirmed/".$id);
        }
    }
    
}