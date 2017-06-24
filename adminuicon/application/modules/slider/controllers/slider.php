<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Slider extends MX_Controller{
    public function __construct() {
        parent::__construct();
        if($this->session->userdata('logged_in_admin')==false){
            redirect('login');    
        }
        $this->load->model('m_slider');
    }
    
    function image_browse(){
        $this->load->view("image_browse");
    }
    
    function to_up(){
        $id=$this->input->post("id");
        $current = $this->db->query("select * from slider where position='$id' ")->row();
        $min=$this->db->query("select * from slider where position < '$id' order by position desc limit 1 ")->row();
        
        $id_current=$current->id;
        $pos_current=$current->position;
        
        $id_min=$min->id;
        $pos_min=$min->position;
        
        $this->db->query("UPDATE slider set position='$pos_current' where id='$id_min'");
        $this->db->query("UPDATE slider set position='$pos_min' where id='$id_current'");
        
        
        
    }
    
    function to_down(){
        $id=$this->input->post("id");
        $current = $this->db->query("select * from slider where position='$id' ")->row();
        $min=$this->db->query("select * from slider where position > '$id' order by position asc limit 1 ")->row();
        
        $id_current=$current->id;
        $pos_current=$current->position;
        
        $id_min=$min->id;
        $pos_min=$min->position;
        
        $this->db->query("UPDATE slider set position='$pos_current' where id='$id_min'");
        $this->db->query("UPDATE slider set position='$pos_min' where id='$id_current'");
        
        
        
    }
        
    function index(){
        $data['total_data']=$this->db->query("select * from slider order by position asc")->num_rows();
        $data['data'] = $this->db->query("select * from slider order by position asc")->result();
        $data['position'] = $this->db->query("select max(position) as maxi, min(position) as minix from slider")->row();
        $data['view']='main';
        $this->load->view('template',$data);
    }
    
    public function search()
	{
            $page_sr = $this->m_city_management->handler0($this->input->get_post('page_sr', TRUE));
            $name_sr = $this->m_city_management->handler2($this->input->get_post('name_sr', TRUE));
            $status_sr = $this->m_city_management->handler3($this->input->get_post('status_sr', TRUE));
            //echo $id_sr,$name_sr,$status_sr;
            $limit = ($this->uri->segment(3) > 0)?$this->uri->segment(3):0;

            $config['base_url'] = base_url() .'slider/search';
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
        $title=$this->input->post("title");
        $status=$this->input->post("status");
        $image=$this->input->post("image");
        $slider_description=$this->input->post("slider_description");
        $slider_target=$this->input->post("slider_target");
        $image_url=$this->input->post("image_url");
         
        $data_slider=array(
            "title"=>$title,
            "image_slider"=>$image,
            "status"=>$status,
            "slider_target"=>$slider_target,
            "image_url"=>$image_url,
            "slider_description"=>$slider_description,
            "position"=>$this->db->query("select max(position) as posisi from slider")->row('posisi')+1,
            "sys_create_date"=>"$datetime",
            "sys_create_user"=>$session_data['user_id']
        );
        $this->db->insert("slider",$data_slider);
        redirect("slider");
    }
    
    function update($id,$page){
        $data['list_detail']=$this->db->query("select * from slider where id='$id'")->row();
        $data['posisi']=$page;
        $data['view']='edit';
        $this->load->view('template',$data);
    }
    
    function update_proses(){
        $session_data = $this->session->userdata('logged_in');
        $datetime=date("Y-m-d h:i:s");
        $id=$this->input->post("id");
        $title=$this->input->post("title");
        $status=$this->input->post("status");
        $image=$this->input->post("image");
        $slider_description=$this->input->post("slider_description");
        $slider_target=$this->input->post("slider_target");
        $image_url=$this->input->post("image_url");
        
         
        $data_slider=array(
            "title"=>$title,
            "image_slider"=>$image,
            "status"=>$status,
            "slider_target"=>$slider_target,
            "slider_description"=>$slider_description,
            "image_url"=>$image_url,
            "sys_update_date"=>"$datetime",
            "sys_update_user"=>$session_data['user_id']
        );
        $this->db->where("id",$id);
        $this->db->update("slider",$data_slider);
        
        redirect("slider");
    }
    
    function delete($id){
        $this->db->delete("slider_caption",array("id_slider"=>$id));
        $this->db->delete("slider",array("id"=>$id));
        redirect("slider");
    }
    
    function example(){
        $data['list_detail']=$this->db->query("select a.*,b.* from slider a inner join slider_caption b on a.id=b.id_slider where a.status='Y' order by a.position asc")->result();;
        $data['view']='example';
        $this->load->view('template',$data);
    }
}