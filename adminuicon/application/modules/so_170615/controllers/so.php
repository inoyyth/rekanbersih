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
        $data['so']=$this->db->query("select a.*,b.name,adress,province,city,contact,tlp,fax,email,reseller from so a left join customer b on a.customer=b.id_customer where a.id_so='$id'")->row();
        $data['so_finish_product']=$this->db->query("select a.*,b.product_name,product_code,c.product_category,d.name as merk
                                                    from so_finish_product a 
                                                    left join product b on a.product=b.id_product
                                                    left join product_category c on b.product_category=c.id_product_category
                                                    left join merk d on b.merk=d.id_merk
                                                    where a.so='$id'")->result();
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
        $data=array(
            'status'=>$order_status,
            'tracking_order'=>$tracking_number
        );
        $this->main_model->update('so','id_so',$id_so,$data);
        if($order_status=="deliver"){
            $this->send_mail($id_user,$id_so);
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
        $data['user']=$this->db->query("select * from customer where id_customer='$id_user'")->row();
        $data['so_finish_product']=$this->db->query("select a.*,b.product_code,product_name,cost_price,special_price from so_finish_product a left join product b on a.product=b.id_product where so='$id_so'")->result();
        $data['so']=$this->db->query("select * from so where id_so='$id_so'")->row();
        $data['shipping']=$this->db->query("select * from so_shipping where id_so=$id_so")->row();
        $data['url_base']=  base_url();
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

        $ci->email->from('info@tokofilter.com', 'Toko Filter');
        $ci->email->to($mail_x->email);
        $ci->email->subject("Your Invoice Toko Filter ");
        $ci->email->message($this->load->view('email_user',$data,TRUE));
        $ci->email->send();
        return true;
    }
    
}