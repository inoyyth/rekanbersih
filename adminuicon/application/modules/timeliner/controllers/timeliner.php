<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Timeliner extends MX_Controller{
    public function __construct() {
        parent::__construct();
        if($this->session->userdata('logged_in')==false){
            redirect('login');    
        }
        $this->load->model('m_timeliner');
    }
        
    function index(){
        $this->session->unset_userdata('page_sr');
        $this->session->unset_userdata('id_sr');
        $this->session->unset_userdata('content_sr');
        $this->session->unset_userdata('year_sr');
        $this->session->unset_userdata('status_sr');
        $config['base_url'] = base_url().'timeliner/index/';
        $config['total_rows'] = $this->db->query("select * from timeliner order by year asc")->num_rows();
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
        $data['total_data']=$this->db->query("select * from timeliner  order by year asc")->num_rows();
        $data['data'] = $this->db->query("select * from timeliner order by year asc limit ".$pg.",".$config['per_page']."")->result();
        $data['view']='main';
        $this->load->view('template',$data);
    }
    
    public function search()
	{
            $page_sr = $this->m_timeliner->handler0($this->input->get_post('page_sr', TRUE));
            $id_sr = $this->m_timeliner->handler1($this->input->get_post('id_sr', TRUE));
            $content_sr = $this->m_timeliner->handler2($this->input->get_post('content_sr', TRUE));
            $year = $this->m_timeliner->handler3($this->input->get_post('year_sr', TRUE));
            $status_sr = $this->m_timeliner->handler5($this->input->get_post('status_sr', TRUE));
            //echo $id_sr,$name_sr,$status_sr;
            $limit = ($this->uri->segment(3) > 0)?$this->uri->segment(3):0;

            $config['base_url'] = base_url() .'timeliner/search';
            $config['total_rows'] = $this->db->query("select * from  timeliner where id LIKE '%$id_sr%' and content LIKE '%$content_sr%' and year LIKE '%$year%' and status LIKE '%$status_sr%'")->num_rows();
            $config['per_page'] = ($page_sr > 0)?$page_sr:10;
            $config['uri_segment'] = 3;
            $choice = $config['total_rows']/$config['per_page'];
            $config['num_links'] = 2;		
            $this->pagination->initialize($config);

            $data['data'] = $this->db->query("select * from  timeliner where id LIKE '%$id_sr%' and content LIKE '%$content_sr%' and year LIKE '%$year%' and status LIKE '%$status_sr%' order by year asc limit ".$limit.",".$config['per_page']."")->result();
            $data['halaman'] = $this->pagination->create_links();
            $data['total_data']= $this->db->query("select * from  timeliner where id LIKE '%$id_sr%' and content LIKE '%$content_sr%' and year LIKE '%$year%' and status LIKE '%$status_sr%'")->num_rows();
            $data['page_sr'] = $page_sr;
            $data['id_sr'] = $id_sr;
            $data['content_sr'] = $content_sr;
            $data['year_sr'] = $year;
            $data['status_sr'] = $status_sr;
            $data['view']='search';
            $this->load->view('template',$data);
	}
    
    function add(){
        $data['view']='add';
        $this->load->view('template',$data);
    }
    function add_proses(){
        $session_data = $this->session->userdata('logged_in');
        $datetime=date("Y-m-d h:i:s");
        $title=$this->input->post('title');
        $content=$this->input->post('content');
        $start=$this->input->post('start');
        $end=$this->input->post('end');
        $status=$this->input->post('status');
        $year=$this->input->post('year');
        
        $data=array("content"=>$content,
                    "start_date"=>$start,
                    "title"=>$title,
                    "year"=>$year,
                    "end_date"=>$end,
                    "status"=>$status,
                    "sys_create_user"=>$session_data['user_id'],
                    "sys_create_date"=>$datetime);
        
        $this->db->insert("timeliner",$data);
        
        redirect("timeliner/search");
    }
    
    function update($id,$page){
        $data['list_detail']=$this->m_timeliner->select_where("timeliner","id",$id)->row();
        $data['posisi']=$page;
        $data['view']='edit';
        $this->load->view('template',$data);
    }
    
    function update_proses(){
        $session_data = $this->session->userdata('logged_in');
        $datetime=date("Y-m-d h:i:s");
        $id=$this->input->post('id');
        $posisi=$this->input->post("posisi");
        $title=$this->input->post('title');
        $content=$this->input->post('content');
        $start=$this->input->post('start');
        $end=$this->input->post('end');
        $status=$this->input->post('status');
        $year=$this->input->post('year');
             
        $data=array("content"=>$content,
                    "title"=>$title,
                    "year"=>$year,
                    "start_date"=>$start,
                    "end_date"=>$end,
                    "status"=>$status,
                    "sys_update_user"=>$session_data['user_id'],
                    "sys_update_date"=>$datetime);
        
        $this->m_timeliner->update("timeliner","id",$id,$data);
        
        redirect("timeliner/search/".$posisi);
    }
    
    function delete($id,$page){
        $this->m_timeliner->delete("timeliner","id",$id);
        redirect("timeliner/search/".$page);
    }
    
    function preview(){
        $data['data'] = $this->db->query("select * from timeliner order by start_date asc")->result();
        $data['view']='preview';
        $this->load->view('template',$data);
    }
    
    function preview2(){
        $data['data'] = $this->db->query("select * from timeliner order by start_date asc")->result();
        $data['view']='preview2';
        $this->load->view('template',$data);
    }
}