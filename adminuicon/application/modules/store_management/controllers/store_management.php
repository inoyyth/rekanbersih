<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Store_management extends MX_Controller{
    public function __construct() {
        parent::__construct();
        if($this->session->userdata('logged_in')==false){
            //redirect('login');    
        }
        $this->load->model('m_store_management');
    }
        
    function index(){
        $this->session->unset_userdata('page_sr');
        $this->session->unset_userdata('id_sr');
        $this->session->unset_userdata('name_sr');
        $this->session->unset_userdata('status_sr');
        $this->session->unset_userdata('city_sr');
        $config['base_url'] = base_url().'store_management/index/';
        $config['total_rows'] = $this->db->query("select a.*,b.city from locator a left join city b on a.id_city=b.id order by a.id desc")->num_rows();
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
        $data['total_data']=$this->db->query("select a.*,b.city from locator a left join city b on a.id_city=b.id order by a.id desc")->num_rows();
        $data['data'] = $this->db->query("select a.*,b.city from locator a left join city b on a.id_city=b.id order by a.id desc limit ".$pg.",".$config['per_page']."")->result();
        $data['view']='main';
        $this->load->view('template',$data);
    }
    
    public function search()
	{
            $page_sr = $this->m_store_management->handler0($this->input->get_post('page_sr', TRUE));
            $id_sr = $this->m_store_management->handler1($this->input->get_post('id_sr', TRUE));
            $name_sr = $this->m_store_management->handler2($this->input->get_post('name_sr', TRUE));
            $status_sr = $this->m_store_management->handler3($this->input->get_post('status_sr', TRUE));
            $city_sr = $this->m_store_management->handler4($this->input->get_post('city_sr', TRUE));
            //echo $id_sr,$name_sr,$status_sr;
            $limit = ($this->uri->segment(3) > 0)?$this->uri->segment(3):0;

            $config['base_url'] = base_url() .'store_management/search';
            $config['total_rows'] = $this->db->query("select a.*,b.city from locator a left join city b on a.id_city=b.id where a.id LIKE '%$id_sr%' and a.address LIKE '%$name_sr%' and a.status LIKE '%$status_sr%' and b.city like '%$city_sr%'")->num_rows();
            $config['per_page'] = ($page_sr > 0)?$page_sr:10;
            $config['uri_segment'] = 3;
            $choice = $config['total_rows']/$config['per_page'];
            $config['num_links'] = 2;		
            $this->pagination->initialize($config);

            $data['data'] = $this->db->query("select a.*,b.city from locator a left join city b on a.id_city=b.id where a.id LIKE '%$id_sr%' and a.address LIKE '%$name_sr%' and a.status LIKE '%$status_sr%' and b.city like '%$city_sr%' order by a.id desc limit ".$limit.",".$config['per_page']."")->result();
            $data['halaman'] = $this->pagination->create_links();
            $data['total_data']= $this->db->query("select a.*,b.city from locator a left join city b on a.id_city=b.id where a.id LIKE '%$id_sr%' and a.address LIKE '%$name_sr%' and a.status LIKE '%$status_sr%' and b.city like '%$city_sr%'")->num_rows();
            $data['id_sr'] = $id_sr;
            $data['name_sr'] = $name_sr;
            $data['status_sr'] = $status_sr;
            $data['city_sr'] = $city_sr;
            $data['page_sr'] = $page_sr;
            $data['view']='search';
            $this->load->view('template',$data);
	}
    
    function view_locator($id,$page){
        $data['list_locator']=$this->db->query("select a.*,b.city from locator a left join city b on a.id_city=b.id where a.id='$id'")->row();
        $data['posisi']=$page;
        $data['view']='view_locator';
        $this->load->view('template',$data);
    }    
    
    function add(){
        $data['list_city'] = $this->db->query("select * from city where status='Y'")->result();
        $data['view']='add';
        $data['list_logo'] = $this->db->query("SELECT * FROM t_logo WHERE status='Y'")->result();
        $this->load->view('template',$data);
    }
    function add_proses(){
                
        $session_data = $this->session->userdata('logged_in');
        $datetime=date("Y-m-d h:i:s");
        $city=$this->input->post('city');
        $locator_name = $this->input->post('locator_name');
        $telepon = $this->input->post('tel');
        $logo = implode(',', $_POST['logo']);
        $address=$this->input->post('address');
        $status=$this->input->post('status');
        $map=$this->input->post('map');
        
        //upload File
        $config['upload_path']	= "../userfiles/Image/store_management/";
            $config['upload_url']	= "../userfiles/Image/store_management/";
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
         
        $data=array('id_city'=>$city,'address'=>$address,'status'=>$status,'map'=>$map,'image'=>$image_data1['file_name'],"sys_create_user"=>$session_data['user_id'],"sys_create_date"=>$datetime);
        $data['telepon'] = $telepon;
        $data['logo'] = $logo;
        $data['locator_name'] = $locator_name;
        $this->m_store_management->insert('locator',$data);
        
        redirect("store_management/search");
    }
    
    function update($id,$page){
        $data['list_city'] = $this->db->query("select * from city where status='Y'")->result();
        $data['list_detail']=$this->m_store_management->select_where("locator","id",$id)->row();
        $data['list_logo'] = $this->db->query("SELECT * FROM t_logo WHERE status='Y'")->result();
        $data['posisi']=$page;
        $data['view']='edit';
        $this->load->view('template',$data);
    }
    
    function update_proses(){
        
        $locator_name = $this->input->post('locator_name');
        $telepon = $this->input->post('tel');
        $logo = implode(',', $_POST['logo']);
        $session_data = $this->session->userdata('logged_in');
        $datetime=date("Y-m-d h:i:s");
        $id=$this->input->post("id");
        $posisi=$this->input->post("posisi");
        $city=$this->input->post('city');
        $address=$this->input->post('address');
        $status=$this->input->post('status');
        $map=$this->input->post('map');
        $image_hidden=$this->input->post("image_hidden");
        
        //upload File
        $config['upload_path']	= "../userfiles/Image/store_management/";
            $config['upload_url']	= "../userfiles/Image/store_management/";
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
        
        $data=array("id_city"=>$city,
                    "address"=>$address,
                    "map"=>$map,
                    "image"=>$img1,
                    "status"=>$status,
                    "sys_update_user"=>$session_data['user_id'],
                    "sys_update_date"=>$datetime);
        
        $data['telepon'] = $telepon;
        $data['logo'] = $logo;
        $data['locator_name'] = $locator_name;
        
        $this->m_store_management->update("locator","id",$id,$data);
        
        redirect("store_management/search/".$posisi);
    }
    
    function delete($id,$page){
        $this->m_store_management->delete("locator","id",$id);
        redirect("store_management/search/".$page);
    }
}