<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment_confirmation extends MX_Controller{
    public function __construct() {
        parent::__construct();
        if($this->session->userdata('logged_in')==false){
            redirect('login');    
        }
        $this->load->model('m_payment_confirmation');
        $this->load->model('main_model');
    }
        
    function index(){
        $this->load->database('desalite',true);
        $this->session->unset_userdata('name_sr');
        $this->session->unset_userdata('page_sr');
        $this->session->unset_userdata('so_sr');
        $this->session->unset_userdata('date_sr');
        $this->session->unset_userdata('bank_sr');
        $this->session->unset_userdata('total_sr');
        $this->session->unset_userdata('status_sr');
        $this->session->unset_userdata('from_sr');
        $this->session->unset_userdata('to_sr');
        $config['base_url'] = base_url().'payment_confirmation/index/';
        $config['total_rows'] = $this->db->query("select * from payment_confirmation order by id desc ")->num_rows();
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
        $data['total_data']=$this->db->query("select * from payment_confirmation order by id desc")->num_rows();
        $data['data'] = $this->db->query("select * from payment_confirmation order by id desc limit ".$pg.",".$config['per_page']."")->result();
        $data['view']='main';
        $this->load->view('template',$data);
    }
    
    function search(){
        $this->load->database('desalite',true);
        if($_POST){
            $page_sr = ($this->input->get_post('page_sr')==""?$this->session->unset_userdata('page_sr'):$this->main_model->handler0('page_sr',$this->input->get_post('page_sr', TRUE)));
            $name_sr = ($this->input->get_post('name_sr')==""?$this->session->unset_userdata('name_sr'):$this->main_model->handler0('name_sr',$this->input->get_post('name_sr', TRUE)));
            $so_sr = ($this->input->get_post('so_sr')==""?$this->session->unset_userdata('so_sr'):$this->main_model->handler0('so_sr',$this->input->get_post('so_sr', TRUE)));
            $date_sr = ($this->input->get_post('date_sr')==""?$this->session->unset_userdata('date_sr'):$this->main_model->handler0('date_sr',$this->input->get_post('date_sr', TRUE)));
            $bank_sr = ($this->input->get_post('bank_sr')==""?$this->session->unset_userdata('bank_sr'):$this->main_model->handler0('bank_sr',$this->input->get_post('bank_sr', TRUE)));
            $status_sr = ($this->input->get_post('status_sr')==""?$this->session->unset_userdata('status_sr'):$this->main_model->handler0('status_sr',$this->input->get_post('status_sr', TRUE)));
            $total_sr = ($this->input->get_post('total_sr')==""?$this->session->unset_userdata('total_sr'):$this->main_model->handler0('total_sr',$this->input->get_post('total_sr', TRUE)));
        }else{
            $page_sr = $this->main_model->handler0('page_sr',$this->input->get_post('page_sr', TRUE));
            $name_sr = $this->main_model->handler0('name_sr',$this->input->get_post('name_sr', TRUE));
            $so_sr = $this->main_model->handler0('so_sr',$this->input->get_post('so_sr', TRUE));
            $date_sr = $this->main_model->handler0('date_sr',$this->input->get_post('date_sr', TRUE));
            $bank_sr = $this->main_model->handler0('bank_sr',$this->input->get_post('bank_sr', TRUE));
            $status_sr = $this->main_model->handler0('status_sr',$this->input->get_post('status_sr', TRUE));
            $total_sr = $this->main_model->handler0('total_sr',$this->input->get_post('total_sr', TRUE));
        }
        $between="";
        if($this->input->post('from_sr')=="" && $this->input->post('to_sr')==""){
            $from_sr = "";
            $to_sr = "";
            $between="";
        }else{
            $from_sr = $this->m_payment_confirmation->handler0("from_sr",$this->input->get_post('from_sr', TRUE));
            $to_sr = $this->m_payment_confirmation->handler0("to_sr",$this->input->get_post('to_sr', TRUE));
            $between="and date(transfer_date) BETWEEN '$from_sr' and '$to_sr'";
        }
                
        $limit = ($this->uri->segment(3) > 0)?$this->uri->segment(3):0;

        $config['base_url'] = base_url() .'payment_confirmation/search';
        $config['total_rows'] = $this->db->query("select * from payment_confirmation
                                                 where so_number LIKE '%$so_sr%'
                                                 and date(transfer_date) like '%$date_sr%'
                                                 and name like '%$name_sr%'
                                                 and bank_name like '%$bank_sr%'
                                                 and status like '%$status_sr%'
                                                 and total_amount like '%".preg_replace('~[^-a-z0-9_]+~','',$total_sr)."%'
                                                 $between
                                                 order by id desc")->num_rows();
        $config['per_page'] = ($page_sr > 0)?$page_sr:10;
        $config['uri_segment'] = 3;
        $choice = $config['total_rows']/$config['per_page'];
        $config['num_links'] = 2;		
        $this->pagination->initialize($config);

        $data['data'] = $this->db->query("select * from payment_confirmation
                                                 where so_number LIKE '%$so_sr%'
                                                 and date(transfer_date) like '%$date_sr%'
                                                 and name like '%$name_sr%'
                                                 and bank_name like '%$bank_sr%'
                                                 and status like '%$status_sr%'
                                                 and total_amount like '%".preg_replace('~[^-a-z0-9_]+~','',$total_sr)."%'
                                                 $between
                                                 order by id desc
                                        limit ".$limit.",".$config['per_page']."")->result();
        $data['halaman'] = $this->pagination->create_links();
        $data['total_data']= $this->db->query("select * from payment_confirmation
                                                 where so_number LIKE '%$so_sr%'
                                                 and date(transfer_date) like '%$date_sr%'
                                                 and name like '%$name_sr%'
                                                 and bank_name like '%$bank_sr%'
                                                 and status like '%$status_sr%'
                                                 and total_amount like '%".preg_replace('~[^-a-z0-9_]+~','',$total_sr)."%'
                                                 $between
                                                 order by id desc")->num_rows();
        $data['page_sr'] = $page_sr;
        $data['name_sr'] = $name_sr;
        $data['so_sr'] = $so_sr;
        $data['date_sr'] = $date_sr;
        $data['bank_sr'] = $bank_sr;
        $data['status_sr'] = $status_sr;
        $data['total_sr'] = $total_sr;
        $data['from_sr'] = $from_sr;
        $data['to_sr'] = $to_sr;
        $data['view']='search';
        $this->load->view('template',$data);
    }
    
    function update($id){
        $this->load->database('desalite',true);
        $data['payment_confirmation']=$this->db->query("select * from payment_confirmation where so_number='$id'")->row();
        $so=$this->db->query("select id_so from so where so_number='$id'")->row('id_so');
        $data['so_finish_product']=$this->db->query("select a.*,b.product_name,product_code,c.product_category,d.name as merk
                                                    from so_finish_product a 
                                                    left join product b on a.product=b.id_product
                                                    left join product_category c on b.product_category=c.id_product_category
                                                    left join merk d on b.merk=d.id_merk
                                                    where a.so='$so'")->result();
        $data['so']=$this->db->query("select a.*,b.name,adress,province,city,contact,tlp,fax,email,reseller from so a left join customer b on a.customer=b.id_customer where a.id_so='$so'")->row();
        $data['view']="edit";
        $this->load->view("template",$data);
    }
    
    function update_status(){
        $this->load->database('desalite',true);
        $so=$this->input->post('so');
        $status=$this->input->post('status');
        $this->db->where('so_number',$so);
        $this->db->update('payment_confirmation',array('status'=>$status));
        return true;
    }
        
}