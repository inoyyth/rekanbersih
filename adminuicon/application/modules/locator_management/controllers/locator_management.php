<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Locator_management extends CI_Controller{
    public function __construct() {
                    parent::__construct();
                    if($this->session->userdata('logged_in')==false){
                        redirect('login');    
                    }
                    
            }
    function index(){
        $data['list_city']=$this->db->query('select * from city')->result();
        $data['list_locator']=$this->db->query('select a.*,b.city from locator a left join city b on a.id_city=b.id where a.status="Y"')->result();
        $data['view']='main';
        $this->load->view('template',$data);
    }
    
    function add_city(){
        $data['view']='add_city';
        $this->load->view('template',$data);
    }
    
    function add_city_proses(){
        $session_data = $this->session->userdata('logged_in');
        $city=$this->input->post('city');
        $status=$this->input->post('status');
        $data=array("city"=>$city,"status"=>$status,"sys_create_user"=>$session_data['user_id'],"sys_create_date"=>date('Y-m-d h:i:s'));
        
        $this->db->insert("city",$data);
        
        redirect("locator_management");
    }
    
    function update_city($id){
        $data['detail']=$this->db->query("select * from city where id='$id'")->row();
        $data['view']='update_city';
        $this->load->view('template',$data);
    }
    
    function update_city_proses(){
        $session_data = $this->session->userdata('logged_in');
        $id=$this->input->post('id');
        $city=$this->input->post('city');
        $status=$this->input->post('status');
        $data=array("city"=>$city,"status"=>$status,"sys_update_user"=>$session_data['user_id'],"sys_update_date"=>date('Y-m-d h:i:s'));
        
        $this->db->where('id', $id);
        $this->db->update('city', $data); 
        
        redirect("locator_management");
    }
    
    function delete_city($id){
        $this->db->where('id', $id);
        $this->db->delete('city', $data); 
        
        redirect("locator_management");
    }
    
    function add_locator(){
        $data['list_city']=$this->db->query('select * from city where status="Y"')->result();
        $data['view']='add_locator';
        $this->load->view('template',$data);
    }
    
    function add_locator_proses(){
        $session_data = $this->session->userdata('logged_in');
        $city=$this->input->post('city');
        $address=$this->input->post('address');
        $status=$this->input->post('status');
        $map=$this->input->post('map');
        
        //upload File
        $config['upload_path']	= "./assets/foto/";
        $config['upload_url']	= base_url().'assets/foto/';
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
         
         $data=array('id_city'=>$city,'address'=>$address,'status'=>$status,'map'=>$map,'image'=>$image_data1['file_name'],"sys_create_user"=>$session_data['user_id'],"sys_create_date"=>date('Y-m-d h:i:s'));
         
         $this->db->insert('locator',$data);
         
         redirect('locator_management');
    }
    
    function update_locator($id){
        $data['list_city']=$this->db->query('select * from city where status="Y"')->result();
        $data['list_locator']=$this->db->query("select * from locator where id='$id'")->row();
        $data['view']='update_locator';
        $this->load->view('template',$data);
    }
    
    function update_locator_proses(){
        $session_data = $this->session->userdata('logged_in');
        $id=$this->input->post('id');
        $city=$this->input->post('city');
        $address=$this->input->post('address');
        $status=$this->input->post('status');
        $map=$this->input->post('map');
        $image_hidden=$this->input->post('image_hidden');
        
        //upload File
        $config['upload_path']	= "userfiles/Image/locator";
        $config['upload_url']	= base_url().'userfiles/Image/locator';
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
         
          $data=array('id_city'=>$city,'address'=>$address,'status'=>$status,'map'=>$map,'image'=>$img1,"sys_update_user"=>$session_data['user_id'],"sys_update_date"=>date('Y-m-d h:i:s'));
          
          $this->db->where('id', $id);
          $this->db->update('locator', $data); 
          
          redirect("locator_management");
    }
    
    function delete_locator($id){
        $this->db->where('id', $id);
        $this->db->delete('locator', $data); 
        
        redirect("locator_management");
    }
    
    function view_locator($id){
        $data['list_city']=$this->db->query('select * from city where status="Y"')->result();
        $data['list_locator']=$this->db->query("select a.*,b.city from locator a left join city b on a.id_city=b.id where a.id='$id'")->row();
        $data['view']='view_locator';
        $this->load->view('template',$data);
    }
}
