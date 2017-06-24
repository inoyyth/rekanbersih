<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_comment extends MX_Controller{
    public function __construct() {
        parent::__construct();
        if($this->session->userdata('logged_in_admin')==false){
            redirect('login');    
        }
        $this->load->model('m_customer_comment');
        $this->load->model('main_model');
    }
        
    function index(){
        $this->session->unset_userdata('page_sr');
        $this->session->unset_userdata('name_sr');
		$this->session->unset_userdata('job_sr');
		$this->session->unset_userdata('office_sr');
		$this->session->unset_userdata('comment_sr');
        $this->session->unset_userdata('status_sr');
        $config['base_url'] = base_url().'customer_comment/index/';
        $config['total_rows'] = $this->db->query("select * from customer_comment")->num_rows();
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
        $data['total_data']=$this->db->query("select * from customer_comment")->num_rows();
        $data['data'] = $this->db->query("select * from customer_comment order by id desc limit ".$pg.",".$config['per_page']."")->result();
        $data['view']='main';
        $this->load->view('template',$data);
    }
    
    public function search()
	{
            if($_POST){
                $page_sr = ($this->input->post('page_sr')==""?$this->session->unset_userdata('page_sr'):$this->m_customer_comment->handler0($this->input->get_post('page_sr', TRUE)));
                $name_sr = ($this->input->post('name_sr')==""?$this->session->unset_userdata('name_sr'):$this->m_customer_comment->handler1($this->input->get_post('name_sr', TRUE)));
                $job_sr = ($this->input->post('job_sr')==""?$this->session->unset_userdata('job_sr'):$this->m_customer_comment->handler2($this->input->get_post('job_sr', TRUE)));
				$office_sr = ($this->input->post('office_sr')==""?$this->session->unset_userdata('office_sr'):$this->m_customer_comment->handler2($this->input->get_post('office_sr', TRUE)));
				$comment_sr = ($this->input->post('comment_sr')==""?$this->session->unset_userdata('comment_sr'):$this->m_customer_comment->handler2($this->input->get_post('comment_sr', TRUE)));
                $status_sr = ($this->input->post('status_sr')==""?$this->session->unset_userdata('status_sr'):$this->m_customer_comment->handler3($this->input->get_post('status_sr', TRUE)));
            }else{
                $page_sr = $this->m_customer_comment->handler0($this->input->get_post('page_sr', TRUE));
                $name_sr = $this->m_customer_comment->handler1($this->input->get_post('name_sr', TRUE));
                $job_sr = $this->m_customer_comment->handler2($this->input->get_post('job_sr', TRUE));
				$office_sr = $this->m_customer_comment->handler2($this->input->get_post('office_sr', TRUE));
				$comment_sr = $this->m_customer_comment->handler2($this->input->get_post('comment_sr', TRUE));
                $status_sr = $this->m_customer_comment->handler3($this->input->get_post('status_sr', TRUE));
            }
            //      echo $id_sr,$name_sr,$status_sr;
            $limit = ($this->uri->segment(3) > 0)?$this->uri->segment(3):0;

            $config['base_url'] = base_url() .'customer_comment/search';
            $config['total_rows'] = $this->db->query("select * from customer_comment  where customer_name LIKE '%$name_sr%' and customer_job LIKE '%$job_sr%' and customer_office LIKE '%$office_sr%' and customer_comment LIKE '%$comment_sr%' and status LIKE '%$status_sr%'")->num_rows();
            $config['per_page'] = ($page_sr > 0)?$page_sr:10;
            $config['uri_segment'] = 3;
            $choice = $config['total_rows']/$config['per_page'];
            $config['num_links'] = 2;		
            $this->pagination->initialize($config);

            $data['data'] = $this->db->query("select * from customer_comment  where customer_name LIKE '%$name_sr%' and customer_job LIKE '%$job_sr%' and customer_office LIKE '%$office_sr%' and customer_comment LIKE '%$comment_sr%' and status LIKE '%$status_sr%' order by id desc limit ".$limit.",".$config['per_page']."")->result();
            $data['halaman'] = $this->pagination->create_links();
            $data['total_data']= $this->db->query("select * from customer_comment  where customer_name LIKE '%$name_sr%' and customer_job LIKE '%$job_sr%' and customer_office LIKE '%$office_sr%' and customer_comment LIKE '%$comment_sr%' and status LIKE '%$status_sr%'")->num_rows();
            $data['page_sr'] = $page_sr;
            $data['name_sr'] = $name_sr;
            $data['job_sr'] = $job_sr;
			$data['office_sr'] = $office_sr;
			$data['comment_sr'] = $comment_sr;
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
			"customer_comment"=>$this->input->post('customer_comment'),
			"status"=>$this->input->post('status'),
			"sys_create_user"=>$session_data['user_id_admin'],
			"sys_create_date"=>$datetime);
			
        $this->db->insert("customer_comment",$data);
        
        redirect("customer_comment/search");
    }
    
    function update($id,$page){
        $data['list_detail']=$this->m_customer_comment->select_where("customer_comment","id",$id)->row();
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
			"customer_name"=>$this->input->post('customer_name'),
			"customer_title"=>$this->input->post('customer_title'),
			"customer_job"=>$this->input->post('customer_job'),
			"customer_office"=>$this->input->post('customer_office'),
			"customer_comment"=>$this->input->post('customer_comment'),
			"status"=>$this->input->post('status'),
			"sys_update_user"=>$session_data['user_id_admin'],
			"sys_delete_date"=>$datetime);
			
        $this->m_customer_comment->update("customer_comment","id",$id,$data);
        redirect("customer_comment/search/".$posisi);
    }
    
    function delete($id,$page){
        $this->m_customer_comment->delete("customer_comment","id",$id);
        redirect("customer_comment/search/".$page);
    }
}