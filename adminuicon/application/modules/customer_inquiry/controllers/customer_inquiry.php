<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_inquiry extends MX_Controller{
    public function __construct() {
        parent::__construct();
        if($this->session->userdata('logged_in_admin')==false){
            redirect('login');    
        }
        $this->load->model('m_customer_inquiry');
        $this->load->model('main_model');
    }
        
    function index(){
        $this->session->unset_userdata('page_sr');
        $this->session->unset_userdata('name_sr');
		$this->session->unset_userdata('email_sr');
		$this->session->unset_userdata('phone_sr');
		$this->session->unset_userdata('address_sr');
        $this->session->unset_userdata('status_sr');
        $config['base_url'] = base_url().'customer_inquiry/index/';
        $config['total_rows'] = $this->db->query("select * from customer_inquiry")->num_rows();
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
        $data['total_data']=$this->db->query("select * from customer_inquiry")->num_rows();
        $data['data'] = $this->db->query("select * from customer_inquiry order by id desc limit ".$pg.",".$config['per_page']."")->result();
        $data['view']='main';
        $this->load->view('template',$data);
    }
    
    public function search()
	{
            if($_POST){
                $page_sr = ($this->input->post('page_sr')==""?$this->session->unset_userdata('page_sr'):$this->m_customer_inquiry->handler0($this->input->get_post('page_sr', TRUE)));
                $name_sr = ($this->input->post('name_sr')==""?$this->session->unset_userdata('name_sr'):$this->m_customer_inquiry->handler1($this->input->get_post('name_sr', TRUE)));
                $email_sr = ($this->input->post('email_sr')==""?$this->session->unset_userdata('email_sr'):$this->m_customer_inquiry->handler2($this->input->get_post('email_sr', TRUE)));
				$phone_sr = ($this->input->post('phone_sr')==""?$this->session->unset_userdata('phone_sr'):$this->m_customer_inquiry->handler2($this->input->get_post('phone_sr', TRUE)));
				$address_sr = ($this->input->post('address_sr')==""?$this->session->unset_userdata('address_sr'):$this->m_customer_inquiry->handler2($this->input->get_post('address_sr', TRUE)));
                $status_sr = ($this->input->post('status_sr')==""?$this->session->unset_userdata('status_sr'):$this->m_customer_inquiry->handler3($this->input->get_post('status_sr', TRUE)));
            }else{
                $page_sr = $this->m_customer_inquiry->handler0($this->input->get_post('page_sr', TRUE));
                $name_sr = $this->m_customer_inquiry->handler1($this->input->get_post('name_sr', TRUE));
                $email_sr = $this->m_customer_inquiry->handler2($this->input->get_post('email_sr', TRUE));
				$phone_sr = $this->m_customer_inquiry->handler2($this->input->get_post('phone_sr', TRUE));
				$address_sr = $this->m_customer_inquiry->handler2($this->input->get_post('address_sr', TRUE));
                $status_sr = $this->m_customer_inquiry->handler3($this->input->get_post('status_sr', TRUE));
            }
            //      echo $id_sr,$name_sr,$status_sr;
            $limit = ($this->uri->segment(3) > 0)?$this->uri->segment(3):0;

            $config['base_url'] = base_url() .'customer_inquiry/search';
            $config['total_rows'] = $this->db->query("select * from customer_inquiry where inquiry_name LIKE '%$name_sr%' and inquiry_email LIKE '%$email_sr%' and inquiry_phone LIKE '%$phone_sr' and inquiry_address LIKE '%$address_sr' and status LIKE '%$status_sr%'")->num_rows();
            $config['per_page'] = ($page_sr > 0)?$page_sr:10;
            $config['uri_segment'] = 3;
            $choice = $config['total_rows']/$config['per_page'];
            $config['num_links'] = 2;		
            $this->pagination->initialize($config);

            $data['data'] = $this->db->query("select * from customer_inquiry where inquiry_name LIKE '%$name_sr%' and inquiry_email LIKE '%$email_sr%' and inquiry_phone LIKE '%$phone_sr' and inquiry_address LIKE '%$address_sr' and status LIKE '%$status_sr%' order by id desc limit ".$limit.",".$config['per_page']."")->result();
            $data['halaman'] = $this->pagination->create_links();
            $data['total_data']= $this->db->query("select * from customer_inquiry where inquiry_name LIKE '%$name_sr%' and inquiry_email LIKE '%$email_sr%' and inquiry_phone LIKE '%$phone_sr' and inquiry_address LIKE '%$address_sr' and status LIKE '%$status_sr%'")->num_rows();
            $data['page_sr'] = $page_sr;
            $data['name_sr'] = $name_sr;
            $data['email_sr'] = $email_sr;
			$data['phone_sr'] = $phone_sr;
			$data['address_sr'] = $address_sr;
            $data['status_sr'] = $status_sr;
            $data['view']='search';
            $this->load->view('template',$data);
	}
    
    function add(){
        $data['view']='add';
        $this->load->view('template',$data);
    }
    function add_proses(){
        $session_data = $this->session->userdata('logged_in_admin');
        $datetime=date("Y-m-d h:i:s");
        //var_dump($_SESSION);
        $data=array(
			"customer_name"=>$this->input->post('customer_name'),
			"customer_title"=>$this->input->post('customer_title'),
			"customer_job"=>$this->input->post('customer_job'),
			"customer_office"=>$this->input->post('customer_office'),
			"customer_inquiry"=>$this->input->post('customer_inquiry'),
			"status"=>$this->input->post('status'),
			"sys_create_user"=>$session_data['user_id_admin'],
			"sys_create_date"=>$datetime);
			
        $this->db->insert("customer_inquiry",$data);
        
        redirect("customer_inquiry/search");
    }
    
    function update($id,$page){
        $data['list_detail']=$this->m_customer_inquiry->select_where("customer_inquiry","id",$id)->row();
        $data['posisi']=$page;
        $data['view']='edit';
        $this->load->view('template',$data);
    }
    
    function update_proses(){
        $session_data = $this->session->userdata('logged_in_admin');
        $datetime=date("Y-m-d h:i:s");
        $posisi=$this->input->post("posisi");
        $id=$this->input->post("id");
		
        $data=array(
			"status"=>$this->input->post('status'),
			"description"=>$this->input->post('description'),
			"sys_update_user"=>$session_data['user_id_admin'],
			"sys_delete_date"=>$datetime);
			
        $this->m_customer_inquiry->update("customer_inquiry","id",$id,$data);
        redirect("customer_inquiry/search/".$posisi);
    }
    
    function delete($id,$page){
        $this->m_customer_inquiry->delete("customer_inquiry","id",$id);
        redirect("customer_inquiry/search/".$page);
    }
}