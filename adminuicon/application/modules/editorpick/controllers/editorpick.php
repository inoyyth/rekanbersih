<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Editorpick extends MX_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        if($this->session->userdata('logged_in')==false){
            redirect('login');    
        }
        $this->load->model('m_editorpick');
    }
        
    function index(){
        $this->session->unset_userdata('page_sr');
        $this->session->unset_userdata('id_sr');
        $this->session->unset_userdata('name_sr');
        $this->session->unset_userdata('status_sr');
        $config['base_url'] = base_url().'editorpick/index/';
        $config['total_rows'] = $this->db->query("select * from editorpick")->num_rows();
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
        $data['total_data']=$this->db->query("select * from editorpick")->num_rows();
        $data['data'] = $this->db->query("select * from editorpick  order by id desc limit ".$pg.",".$config['per_page']."")->result();
        $data['view']='main';
        $this->load->view('template',$data);
    }
    
    public function search()
    {
        $page_sr = $this->m_editorpick->handler0("page_sr",$this->input->get_post('page_sr', TRUE));
        $id_sr = $this->m_editorpick->handler0("id_sr",$this->input->get_post('id_sr', TRUE));
        $name_sr = $this->m_editorpick->handler0("name_sr",$this->input->get_post('name_sr', TRUE));
        $status_sr = $this->m_editorpick->handler0("status_sr",$this->input->get_post('status_sr', TRUE));
        $limit = ($this->uri->segment(3) > 0)?$this->uri->segment(3):0;

        $config['base_url'] = base_url() .'editorpick/search';
        $config['total_rows'] = $this->db->query("select * from editorpick  where id LIKE '%$id_sr%' and theme_name LIKE '%$name_sr%' and status LIKE '%$status_sr%'")->num_rows();
        $config['per_page'] = ($page_sr > 0)?$page_sr:10;
        $config['uri_segment'] = 3;
        $choice = $config['total_rows']/$config['per_page'];
        $config['num_links'] = 2;		
        $this->pagination->initialize($config);

        $data['data'] = $this->db->query("select * from editorpick  where id LIKE '%$id_sr%' and theme_name LIKE '%$name_sr%' and status LIKE '%$status_sr%' order by id desc limit ".$limit.",".$config['per_page']."")->result();
        $data['halaman'] = $this->pagination->create_links();
        $data['total_data']= $this->db->query("select * from editorpick  where id LIKE '%$id_sr%' and theme_name LIKE '%$name_sr%' and status LIKE '%$status_sr%'")->num_rows();
        $data['id_sr'] = $id_sr;
        $data['name_sr'] = $name_sr;
        $data['status_sr'] = $status_sr;
        $data['page_sr'] = $page_sr;
        $data['view']='search';
        $this->load->view('template',$data);
    }
    
    function add(){
        $data['view']='add';
        $this->load->view('template',$data);
    }
    
     function add_proses(){
        $session_data = $this->session->userdata('logged_in');
        $theme_name=$this->input->post('theme_name');
        $theme_description=$this->input->post('theme_description');
        $status=$this->input->post('status');
        
        //upload File
        $config['upload_path']	= "../userfiles/Image/editorpick/";
        $config['upload_url']	= "../userfiles/Image/editorpick/";
        $config['allowed_types']= '*';
        $config['max_size']     = '2000';
        $config['max_width']  	= '2000';
        $config['max_height']  	= '2000';
        $this->load->library('upload');
        $this->upload->initialize($config);

        if($this->upload->do_upload('image'))
         {
        $image_data1 = $this->upload->data();    
         }
         
         $data=array('theme_name'=>$theme_name,'theme_description'=>$theme_description,'status'=>$status,'theme_images'=>$image_data1['file_name'],"sys_create_user"=>$session_data['user_id'],"sys_create_date"=>date('Y-m-d h:i:s'));
         
         $this->db->insert('editorpick',$data);
         
         redirect('editorpick');
    }
    
    function update($id,$page){
        $data['detail']=$this->db->query("select * from editorpick where id='$id'")->row();
        $data['posisi']=$page;
        $data['view']='edit';
        $this->load->view('template',$data);
    }
    
    function update_proses(){
        $session_data = $this->session->userdata('logged_in');
        $datetime=date("Y-m-d h:i:s");
        $posisi=$this->input->post("posisi");
        $id=$this->input->post("id");
        $theme_name=$this->input->post('theme_name');
        $theme_description=$this->input->post('theme_description');
        $status=$this->input->post('status');
        $image_hidden=$this->input->post('image_hidden');
        
        //upload File
        $config['upload_path']	= "../userfiles/Image/editorpick/";
        $config['upload_url']	= "../userfiles/Image/editorpick/";
        $config['allowed_types']= '*';
        $config['max_size']     = '2000';
        $config['max_width']  	= '2000';
        $config['max_height']  	= '2000';
        $this->load->library('upload');
        $this->upload->initialize($config);

        if($this->upload->do_upload('image'))
         {
        $image_data1 = $this->upload->data();    
        $img1=$image_data1['file_name'];
         }else{
             $img1=$image_hidden;
         }
          $data=array('theme_name'=>$theme_name,'theme_description'=>$theme_description,'status'=>$status,'theme_images'=>$img1,"sys_update_user"=>$session_data['user_id'],"sys_update_date"=>date('Y-m-d h:i:s'));
        $this->m_editorpick->update("editorpick","id",$id,$data);
        
        redirect("editorpick/search/".$posisi);
    }
    
    function delete($id,$page){
        $this->m_editorpick->delete("editorpick","id",$id);
        redirect("editorpick/search/".$page);
    }
    
    function view($id,$page){
        $data['detail']=$this->db->query("select * from editorpick where id='$id'")->row();
        $data['list_barang']=$this->db->query("select * from product_general where product_theme='$id'")->result();
        $data['view']='view';
        $this->load->view('template',$data);
    }
}