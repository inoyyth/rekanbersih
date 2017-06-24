<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Faq extends MX_Controller{
    public function __construct() {
        parent::__construct();
        if($this->session->userdata('logged_in_admin')==false){
            redirect('login');    
        }
        $this->load->model('m_faq');
        $this->load->model('main_model');
    }
        
    function index(){
        $data['data'] = $this->db->query("select * from faq order by position asc")->result();
        $data['max']=$this->db->query("select max(position) as max_pos from faq")->row();
        $data['min']=$this->db->query("select min(position) as min_pos from faq")->row();
        $data['view']='main';
        $this->load->view('template',$data);
    }
    
    function add(){
        $data['view']='add';
        $this->load->view('template',$data);
    }
    function add_proses(){
        $cekmaxposition = $this->db->query("select max(position) as max_post from faq")->row();
        $postion = $cekmaxposition->max_post  + 1;
        $question = $this->input->post('question');
        $answered = $this->input->post('answered');
        $status = $this->input->post('status');
        
        $data = array(
            'question'=>$question,
            'answered'=>$answered,
            'position'=>$postion,
            'status'=>$status
        );
        $this->db->insert('faq',$data);
        redirect('faq/index');
    }
    
    function update($id){
        $data['data']=$this->db->query("select * from faq where id='$id'")->row();
        $data['view']='edit';
        $this->load->view('template',$data);
    }
    
    function update_proses(){
        $id=$this->input->post('id');
        $question = $this->input->post('question');
        $answered = $this->input->post('answered');
        $status = $this->input->post('status');
        
        $data = array(
            'question'=>$question,
            'answered'=>$answered,
            'status'=>$status
        );
        $this->db->where('id',$id);
        $this->db->update('faq',$data);
        redirect('faq/index');
    }
    
    function delete($id,$page){
        $this->m_faq->delete("faq","id",$id);
        redirect("faq/index");
    }
    
    function naik($id,$positon){
        $posup=$this->db->query("select id,position from faq where position < '$positon' ORDER BY position desc limit 1")->row();
        $this->db->query("update faq set position ='$positon' where id='$posup->id'");
        $this->db->query("update faq set position ='$posup->position' where id='$id'");
        redirect("faq/index");
    }
    
    function turun($id,$position){
        $posup=$this->db->query("select id,position from faq where position > '$position' ORDER BY position asc limit 1")->row();
        $this->db->query("update faq set position ='$position' where id='$posup->id'");
        $this->db->query("update faq set position ='$posup->position' where id='$id'");
        redirect("faq/index");
        //echo "id".$posup->id ."- posisi".$posup->menu_position;
    }
    
}