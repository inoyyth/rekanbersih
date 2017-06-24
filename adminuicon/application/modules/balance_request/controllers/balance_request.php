<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Balance_request extends MX_Controller{
    public function __construct() {
        parent::__construct();
        if($this->session->userdata('logged_in_admin')==false){
            redirect('login');    
        }
        $this->load->model('m_balance_request');
        $this->load->model('main_model');
    }
        
    function index(){
        $this->load->database('desalite',true);
        $this->session->unset_userdata('page_sr');
        $this->session->unset_userdata('request_number_sr');
        $this->session->unset_userdata('name_sr');
        $this->session->unset_userdata('before_sr');
        $this->session->unset_userdata('request_sr');
        $this->session->unset_userdata('status_sr');
        $config['base_url'] = base_url().'balance_request/index/';
        $config['total_rows'] = $this->db->query("select a.*,b.name from wallet_request a left join customer b on a.id_customer=b.id_customer order by a.id desc")->num_rows();
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
        $data['total_data']=$this->db->query("select a.*,b.name from wallet_request a left join customer b on a.id_customer=b.id_customer order by a.id desc")->num_rows();
        $data['data'] = $this->db->query("select a.*,b.name from wallet_request a left join customer b on a.id_customer=b.id_customer order by a.id desc limit ".$pg.",".$config['per_page']."")->result();
        $data['view']='main';
        $this->load->view('template',$data);
    }
    
    public function search()
	{
            $this->load->database('desalite',true);
            if($_POST){
                $page_sr = ($this->input->get_post('page_sr')==""?$this->session->unset_userdata('page_sr'):$this->main_model->handler0('page_sr',$this->input->get_post('page_sr', TRUE)));
                $request_number_sr = ($this->input->get_post('request_number_sr')==""?$this->session->unset_userdata('request_number_sr'):$this->main_model->handler0('request_number_sr',$this->input->get_post('request_number_sr', TRUE)));
                $name_sr = ($this->input->get_post('name_sr')==""?$this->session->unset_userdata('name_sr'):$this->main_model->handler0('name_sr',$this->input->get_post('name_sr', TRUE)));
                $before_sr = ($this->input->get_post('before_sr')==""?$this->session->unset_userdata('before_sr'):$this->main_model->handler0('before_sr',$this->input->get_post('before_sr', TRUE)));
                $request_sr = ($this->input->get_post('request_sr')==""?$this->session->unset_userdata('request_sr'):$this->main_model->handler0('request_sr',$this->input->get_post('request_sr', TRUE)));
                $status_sr = ($this->input->get_post('status_sr')==""?$this->session->unset_userdata('status_sr'):$this->main_model->handler0('status_sr',$this->input->get_post('status_sr', TRUE)));
            }else{
                $page_sr = $this->main_model->handler0('page_sr',$this->input->get_post('page_sr', TRUE));
                $request_number_sr = $this->main_model->handler0('request_number_sr',$this->input->get_post('request_number_sr', TRUE));
                $name_sr = $this->main_model->handler0('name_sr',$this->input->get_post('name_sr', TRUE));
                $before_sr = $this->main_model->handler0('before_sr',$this->input->get_post('before_sr', TRUE));
                $request_sr = $this->main_model->handler0('request_sr',$this->input->get_post('request_sr', TRUE));
                $status_sr = $this->main_model->handler0('status_sr',$this->input->get_post('status_sr', TRUE));
            }
            //echo $id_sr,$name_sr,$status_sr;
            $limit = ($this->uri->segment(3) > 0)?$this->uri->segment(3):0;

            $config['base_url'] = base_url() .'article/search';
            $config['total_rows'] = $this->db->query("select a.*,b.name from wallet_request a 
                                                      left join customer b on a.id_customer=b.id_customer 
                                                      where a.request_number like '%$request_number_sr%' and b.name like '%$name_sr%' and a.balance_before like '%$before_sr%' and a.balance_request like '%$request_sr%' and a.status like '%$status_sr%'
                                                      order by a.id desc")->num_rows();
            $config['per_page'] = ($page_sr > 0)?$page_sr:10;
            $config['uri_segment'] = 3;
            $choice = $config['total_rows']/$config['per_page'];
            $config['num_links'] = 2;		
            $this->pagination->initialize($config);

            $data['data'] = $this->db->query("select a.*,b.name from wallet_request a 
                                              left join customer b on a.id_customer=b.id_customer 
                                              where a.request_number like '%$request_number_sr%' and b.name like '%$name_sr%' and a.balance_before like '%$before_sr%' and a.balance_request like '%$request_sr%' and a.status like '%$status_sr%'
                                              order by a.id desc limit ".$limit.",".$config['per_page']."")->result();
            $data['halaman'] = $this->pagination->create_links();
            $data['total_data']= $this->db->query("select a.*,b.name from wallet_request a 
                                                      left join customer b on a.id_customer=b.id_customer 
                                                      where a.request_number like '%$request_number_sr%' and b.name like '%$name_sr%' and a.balance_before like '%$before_sr%' and a.balance_request like '%$request_sr%' and a.status like '%$status_sr%'
                                                      order by a.id desc")->num_rows();
            $data['page_sr'] = $page_sr;
            $data['request_number_sr'] = $request_number_sr;
            $data['name_sr'] = $name_sr;
            $data['before_sr'] = $before_sr;
            $data['request_sr'] = $request_sr;
            $data['status_sr'] = $status_sr;
            $data['view']='search';
            $this->load->view('template',$data);
	}
    
    function update($id,$page){
        $this->load->database('desalite',true);
        $data['detail']=$this->db->query("select a.*,b.name,adress,email,tlp,rekening,bank_name,account_name from wallet_request a left join customer b on a.id_customer=b.id_customer where a.id='$id' order by a.id desc")->row();
        $data['posisi']=$page;
        $data['view']='edit';
        $this->load->view('template',$data);
        
    }
    
    function update_wallet(){
        $this->load->database('desalite',true);
        $id=$this->input->post('id_wallet');
        $account=$this->input->post('account');
        $rekening=$this->input->post('rekening');
        $date=$this->input->post('date');
        $data=array(
            'transfer_rekening'=>$rekening,
            'transfer_date'=>$date,
            'transfer_account'=>$account,
            'status'=>'Y'
        );
        $this->main_model->update('wallet_request','id',$id,$data);
        return true;
    }
    
}