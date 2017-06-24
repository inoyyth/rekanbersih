<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Type_material extends MX_Controller{
    public function __construct() {
        parent::__construct();
//        if($this->session->userdata('logged_in')==false){
//            redirect('login');    
//        }
        $this->load->model('m_type_material');
        $this->load->model('main_model');
    }
        
    function index(){
        $this->load->database('desalite',true);
        $this->session->unset_userdata('page_sr');
        $this->session->unset_userdata('id_sr');
        $this->session->unset_userdata('name_sr');
        $this->session->unset_userdata('abbreviation_sr');
        $config['base_url'] = base_url().'type_material/index/';
        $config['total_rows'] = $this->db->query("select * from type_material order by id_type_material desc")->num_rows();
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
        $data['total_data']=$this->db->query("select * from type_material order by id_type_material desc")->num_rows();
        $data['data'] = $this->db->query("select * from type_material order by id_type_material desc limit ".$pg.",".$config['per_page']."")->result();
        $data['view']='main';
        $this->load->view('template',$data);
    }
    
    public function search()
	{
        $this->load->database('desalite',true);
        if($_POST){
            $page_sr = ($this->input->get_post('page_sr')==""?$this->session->unset_userdata('page_sr'):$this->main_model->handler0('page_sr',$this->input->get_post('page_sr', TRUE)));
            $id_sr = ($this->input->get_post('id_sr')==""?$this->session->unset_userdata('id_sr'):$this->main_model->handler0('id_sr',$this->input->get_post('id_sr', TRUE)));
            $name_sr = ($this->input->get_post('name_sr')==""?$this->session->unset_userdata('name_sr'):$this->main_model->handler0('name_sr',$this->input->get_post('name_sr', TRUE)));
            $abbreviation_sr = ($this->input->get_post('abbreviation_sr')==""?$this->session->unset_userdata('abbreviation_sr'):$this->main_model->handler0('abbreviation_sr',$this->input->get_post('abbreviation_sr', TRUE)));
        }else{
            $page_sr = $this->main_model->handler0('page_sr',$this->input->get_post('page_sr', TRUE));
            $id_sr = $this->main_model->handler0('id_sr',$this->input->get_post('id_sr', TRUE));
            $name_sr = $this->main_model->handler0('name_sr',$this->input->get_post('name_sr', TRUE));
            $abbreviation_sr = $this->main_model->handler0('abbreviation_sr',$this->input->get_post('abbreviation_sr', TRUE));
        }
            $limit = ($this->uri->segment(3) > 0)?$this->uri->segment(3):0;

            $config['base_url'] = base_url() . 'type_material/search';
            $config['total_rows'] = $this->db->query("select * from type_material where id_type_material LIKE '%$id_sr%' and type_material LIKE '%$name_sr%' and abbreviation LIKE '%$abbreviation_sr%' order by id_type_material desc")->num_rows();
            $config['per_page'] = ($page_sr > 0)?$page_sr:10;
            $config['uri_segment'] = 3;
            $choice = $config['total_rows']/$config['per_page'];
            $config['num_links'] = 2;		
            $this->pagination->initialize($config);

            $data['data'] = $this->db->query("select * from type_material where id_type_material LIKE '%$id_sr%' and type_material LIKE '%$name_sr%' and abbreviation LIKE '%$abbreviation_sr%' order by id_type_material desc limit ".$limit.",".$config['per_page']."")->result();
            $data['halaman'] = $this->pagination->create_links();
            $data['total_data']= $this->db->query("select * from type_material where id_type_material LIKE '%$id_sr%' and type_material LIKE '%$name_sr%' and abbreviation LIKE '%$abbreviation_sr%' order by id_type_material desc")->num_rows();
            $data['page_sr'] = $page_sr;
            $data['id_sr'] = $id_sr;
            $data['name_sr'] = $name_sr;
            $data['abbreviation_sr'] = $abbreviation_sr;
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
        $name=$this->input->post('type_material_name');
        $abbreviation=$this->input->post('abbreviation');
        
        $data=array(
            'type_material'=>$name,
            'abbreviation'=>$abbreviation
        );
        $this->main_model->insert('type_material',$data);
        
        redirect("type_material/search");
    }
    
    function update($id,$page){
        $this->load->database('desalite',true);
        $data['list']=$this->db->query("select * from type_material where id_type_material='$id'")->row();
        $data['posisi']=$page;
        $data['view']='edit';
        $this->load->view('template',$data);
    }
    
    function update_proses(){
        $this->load->database('desalite',true);
        $session_data = $this->session->userdata('logged_in');
        $datetime=date("Y-m-d h:i:s");
        $posisi=$this->input->post("posisi");
        $id=$this->input->post('id');
        $name=$this->input->post('type_material_name');
        $abbreviation=$this->input->post('abbreviation');
             
        $data=array(
            'type_material'=>$name,
            'abbreviation'=>$abbreviation
        );
        $this->main_model->update('type_material','id_type_material',$id,$data);
        
        redirect("type_material/search/".$posisi);
    }
    
    function delete($id,$page){
        $this->load->database('desalite',true);
        $this->main_model->delete('type_material','id_type_material',$id);
        redirect("type_material/search/".$page);
    }
    
    function image_browse(){
        $this->load->view("image_browse");
    }
}