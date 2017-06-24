<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_management extends MX_Controller{
    public function __construct() {
        parent::__construct();
//        if($this->session->userdata('logged_in')==false){
//            redirect('login');    
//        }
       // $this->load->model('m_unit_measure');
        $this->load->model('main_model');
    }
        
    function index(){
        $this->load->database('default',true);
        $this->session->unset_userdata('page_sr');
        $this->session->unset_userdata('id_sr');
        $this->session->unset_userdata('username_sr');
        $this->session->unset_userdata('firstname_sr');
        $this->session->unset_userdata('lastname_sr');
        $this->session->unset_userdata('email_sr');
        $this->session->unset_userdata('active_sr');
        $config['base_url'] = base_url().'user_management/index/';
        $config['total_rows'] = $this->db->query("select * from users order by user_id desc")->num_rows();
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
        $data['total_data']=$this->db->query("select * from users order by user_id desc")->num_rows();
        $data['data'] = $this->db->query("select * from users order by user_id desc limit ".$pg.",".$config['per_page']."")->result();
        $data['view']='main';
        $this->load->view('template',$data);
    }
    
    public function search()
	{
        $this->load->database('default',true);
        if($_POST){
            $page_sr = ($this->input->get_post('page_sr')==""?$this->session->unset_userdata('page_sr'):$this->main_model->handler0('page_sr',$this->input->get_post('page_sr', TRUE)));
            $id_sr = ($this->input->get_post('id_sr')==""?$this->session->unset_userdata('id_sr'):$this->main_model->handler0('id_sr',$this->input->get_post('id_sr', TRUE)));
            $username_sr = ($this->input->get_post('username_sr')==""?$this->session->unset_userdata('username_sr'):$this->main_model->handler0('username_sr',$this->input->get_post('username_sr', TRUE)));
            $firstname_sr = ($this->input->get_post('firstname_sr')==""?$this->session->unset_userdata('firstname_sr'):$this->main_model->handler0('firstname_sr',$this->input->get_post('firstname_sr', TRUE)));
            $lastname_sr = ($this->input->get_post('lastname_sr')==""?$this->session->unset_userdata('lastname_sr'):$this->main_model->handler0('lastname_sr',$this->input->get_post('lastname_sr', TRUE)));
            $email_sr = ($this->input->get_post('email_sr')==""?$this->session->unset_userdata('email_sr'):$this->main_model->handler0('email_sr',$this->input->get_post('email_sr', TRUE)));
            $active_sr = ($this->input->get_post('active_sr')==""?$this->session->unset_userdata('active_sr'):$this->main_model->handler0('active_sr',$this->input->get_post('active_sr', TRUE)));
        }else{
            $page_sr = $this->main_model->handler0('page_sr',$this->input->get_post('page_sr', TRUE));
            $id_sr = $this->main_model->handler0('id_sr',$this->input->get_post('id_sr', TRUE));
            $username_sr = $this->main_model->handler0('username_sr',$this->input->get_post('username_sr', TRUE));
            $firstname_sr = $this->main_model->handler0('firstname_sr',$this->input->get_post('firstname_sr', TRUE));
            $lastname_sr = $this->main_model->handler0('lastname_sr',$this->input->get_post('lastname_sr', TRUE));
            $email_sr = $this->main_model->handler0('email_sr',$this->input->get_post('email_sr', TRUE));
            $active_sr = $this->main_model->handler0('active_sr',$this->input->get_post('active_sr', TRUE));
        }
            $limit = ($this->uri->segment(3) > 0)?$this->uri->segment(3):0;

            $config['base_url'] = base_url() . 'user_management/search';
            $config['total_rows'] = $this->db->query("select * from users where user_id LIKE '%$id_sr%' and username LIKE '%$username_sr%' and first_name LIKE '%$firstname_sr%' and last_name LIKE '%$lastname_sr%' and email LIKE '%$email_sr%' and active LIKE '%$active_sr%' order by user_id desc")->num_rows();
            $config['per_page'] = ($page_sr > 0)?$page_sr:10;
            $config['uri_segment'] = 3;
            $choice = $config['total_rows']/$config['per_page'];
            $config['num_links'] = 2;		
            $this->pagination->initialize($config);

            $data['data'] = $this->db->query("select * from users where user_id LIKE '%$id_sr%' and username LIKE '%$username_sr%' and first_name LIKE '%$firstname_sr%' and last_name LIKE '%$lastname_sr%' and email LIKE '%$email_sr%' and active LIKE '%$active_sr%' order by user_id desc limit ".$limit.",".$config['per_page']."")->result();
            $data['halaman'] = $this->pagination->create_links();
            $data['total_data']= $this->db->query("select * from users where user_id LIKE '%$id_sr%' and username LIKE '%$username_sr%' and first_name LIKE '%$firstname_sr%' and last_name LIKE '%$lastname_sr%' and email LIKE '%$email_sr%' and active LIKE '%$active_sr%' order by user_id desc")->num_rows();
            $data['page_sr'] = $page_sr;
            $data['id_sr'] = $id_sr;
            $data['username_sr'] = $username_sr;
            $data['firstname_sr'] = $firstname_sr;
            $data['lastname_sr'] = $lastname_sr;
            $data['email_sr'] = $email_sr;
            $data['active_sr'] = $active_sr;
            $data['view']='search';
            $this->load->view('template',$data);
	}
    
    function add(){
        $data['view']='add';
        $this->load->view('template',$data);
    }
    function add_proses(){
        $this->load->database('default',true);
        $session_data = $this->session->userdata('logged_in');
        $username=$this->input->post('username');
        $password=$this->input->post('password');
        $first_name=$this->input->post('first_name');
        $last_name=$this->input->post('last_name');
        $email=$this->input->post('email');
        $active=$this->input->post('status');
        
        $data=array(
            'username'=>$username,
            'password'=>md5($password),
            'first_name'=>$first_name,
            'last_name'=>$last_name,
            'email'=>$email,
            'active'=>$active
        );
        $this->main_model->insert('users',$data);
        
        redirect("user_management/search");
    }
    
    function update($id,$page){
        $this->load->database('default',true);
        $data['list']=$this->db->query("select * from users where user_id='$id'")->row();
        $data['posisi']=$page;
        $data['view']='edit';
        $this->load->view('template',$data);
    }
    
    function update_proses(){
        $this->load->database('default',true);
        $session_data = $this->session->userdata('logged_in');
        $page=$this->input->post('posisi');
        $id=$this->input->post('id');
        $username=$this->input->post('username');
        $password=$this->input->post('password');
        $password_hidden=$this->input->post('password_hidden');
        $first_name=$this->input->post('first_name');
        $last_name=$this->input->post('last_name');
        $email=$this->input->post('email');
        $active=$this->input->post('status');
        
        if($password == $password_hidden){
            $pss=$password;
        }else{
            $pss=md5($password);
        }
        
        $data=array(
            'username'=>$username,
            'password'=>$pss,
            'first_name'=>$first_name,
            'last_name'=>$last_name,
            'email'=>$email,
            'active'=>$active
        );
        $this->db->where('user_id',$id);
        $this->db->update('users',$data);
        
        redirect("user_management/search/".$page);
    }
    
    function delete($id,$page){
        $this->load->database('desalite',true);
        $this->main_model->delete('unit_measure','id_unit_measure',$id);
        redirect("unit_measure/search/".$page);
    }
    
    function image_browse(){
        $this->load->view("image_browse");
    }
}