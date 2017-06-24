<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class City_management extends MX_Controller{
    public function __construct() {
        parent::__construct();
        if($this->session->userdata('logged_in')==false){
            redirect('login');    
        }
        $this->load->model('m_city_management');
    }
        
    function index(){
        $this->session->unset_userdata('page_sr');
        $this->session->unset_userdata('id_sr');
        $this->session->unset_userdata('name_sr');
        $this->session->unset_userdata('status_sr');
        $config['base_url'] = base_url().'city_management/index/';
        $config['total_rows'] = $this->db->query("select * from city")->num_rows();
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
        $data['total_data']=$this->db->query("select * from city")->num_rows();
        $data['data'] = $this->db->query("select * from city  order by id desc limit ".$pg.",".$config['per_page']."")->result();
        $data['view']='main';
        $this->load->view('template',$data);
    }
    
    public function search()
	{
            $page_sr = $this->m_city_management->handler0($this->input->get_post('page_sr', TRUE));
            $id_sr = $this->m_city_management->handler1($this->input->get_post('id_sr', TRUE));
            $name_sr = $this->m_city_management->handler2($this->input->get_post('name_sr', TRUE));
            $status_sr = $this->m_city_management->handler3($this->input->get_post('status_sr', TRUE));
            //echo $id_sr,$name_sr,$status_sr;
            $limit = ($this->uri->segment(3) > 0)?$this->uri->segment(3):0;

            $config['base_url'] = base_url() .'city_management/search';
            $config['total_rows'] = $this->db->query("select * from city  where id LIKE '%$id_sr%' and city LIKE '%$name_sr%' and status LIKE '%$status_sr%'")->num_rows();
            $config['per_page'] = ($page_sr > 0)?$page_sr:10;
            $config['uri_segment'] = 3;
            $choice = $config['total_rows']/$config['per_page'];
            $config['num_links'] = 2;		
            $this->pagination->initialize($config);

            $data['data'] = $this->db->query("select * from city  where id LIKE '%$id_sr%' and city LIKE '%$name_sr%' and status LIKE '%$status_sr%' order by id desc limit ".$limit.",".$config['per_page']."")->result();
            $data['halaman'] = $this->pagination->create_links();
            $data['total_data']= $this->db->query("select * from city  where id LIKE '%$id_sr%' and city LIKE '%$name_sr%' and status LIKE '%$status_sr%'")->num_rows();
            $data['id_sr'] = $id_sr;
            $data['name_sr'] = $name_sr;
            $data['status_sr'] = $status_sr;
            $data['page_sr'] = $page_sr;
            $data['view']='search';
            $this->load->view('template',$data);
	}
    
    function add(){
        $data['list_attributes'] = $this->db->query("select * from attributes where status='Y'")->result();
        $data['view']='add';
        $this->load->view('template',$data);
    }
    function add_proses(){
        $session_data = $this->session->userdata('logged_in');
        $datetime=date("Y-m-d h:i:s");
        $name=$this->input->post('city');
        $status=$this->input->post('status');
        
        $data=array("city"=>$name,"status"=>$status,"sys_create_user"=>$session_data['user_id'],"sys_create_date"=>$datetime);
        $this->db->insert("city",$data);
        
        redirect("city_management/search/");
    }
    
    function update($id,$page){
        $data['list_detail']=$this->m_city_management->select_where("city","id",$id)->row();
        $data['posisi']=$page;
        $data['view']='edit';
        $this->load->view('template',$data);
    }
    
    function update_proses(){
        $session_data = $this->session->userdata('logged_in');
        $datetime=date("Y-m-d h:i:s");
        $id=$this->input->post("id");
        $posisi=$this->input->post("posisi");
        $name=$this->input->post('city');
        $status=$this->input->post('status');
        
        $data=array("city"=>$name,"status"=>$status,"sys_update_user"=>$session_data['user_id'],"sys_update_date"=>$datetime);
        $this->m_city_management->update("city","id",$id,$data);
        
        redirect("city_management/search/".$posisi);
    }
    
    function delete($id,$page){
        $this->m_city_management->delete("locator","id_city",$id);
        $this->m_city_management->delete("city","id",$id);
        redirect("city_management/search/".$page);
    }
}