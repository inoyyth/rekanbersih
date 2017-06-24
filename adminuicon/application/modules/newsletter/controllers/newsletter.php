<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Newsletter extends MX_Controller{
    public function __construct() {
        parent::__construct();
        if($this->session->userdata('logged_in_admin')==false){
            redirect('login');    
        }
        $this->load->model('m_newsletter');
        $this->load->model('main_model');
    }
        
    function index(){
        $this->session->unset_userdata('page_sr');
        $this->session->unset_userdata('id_sr');
        $this->session->unset_userdata('title_sr');
        $this->session->unset_userdata('count_sr');
        $config['base_url'] = base_url().'newsletter/index/';
        $config['total_rows'] = $this->db->query("select * from newsletter_news order by id desc")->num_rows();
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
        $data['total_data']=$this->db->query("select * from newsletter_news order by id desc")->num_rows();
        $data['data'] = $this->db->query("select * from newsletter_news order by id desc limit ".$pg.",".$config['per_page']."")->result();
        $data['view']='main';
        $this->load->view('template',$data);
    }
    
    public function search()
	{
            if($_POST){
                $page_sr = ($this->input->get_post('page_sr')==""?$this->session->unset_userdata('page_sr'):$this->main_model->handler0('page_sr',$this->input->get_post('page_sr', TRUE)));
                $id_sr = ($this->input->get_post('id_sr')==""?$this->session->unset_userdata('id_sr'):$this->main_model->handler0('id_sr',$this->input->get_post('id_sr', TRUE)));
                $title_sr = ($this->input->get_post('title_sr')==""?$this->session->unset_userdata('title_sr'):$this->main_model->handler0('title_sr',$this->input->get_post('title_sr', TRUE)));
                $count_sr = ($this->input->get_post('count_sr')==""?$this->session->unset_userdata('count_sr'):$this->main_model->handler0('count_sr',$this->input->get_post('count_sr', TRUE)));
            }else{
                $page_sr = $this->main_model->handler0('page_sr',$this->input->get_post('page_sr', TRUE));
                $id_sr = $this->main_model->handler0('id_sr',$this->input->get_post('id_sr', TRUE));
                $title_sr = $this->main_model->handler0('title_sr',$this->input->get_post('title_sr', TRUE));
                $count_sr = $this->main_model->handler0('count_sr',$this->input->get_post('count_sr', TRUE));
            }
            //echo $id_sr,$name_sr,$status_sr;
            $limit = ($this->uri->segment(3) > 0)?$this->uri->segment(3):0;

            $config['base_url'] = base_url() .'newsletter/search';
            $config['total_rows'] = $this->db->query("select * from newsletter_news where news_title like '%$title_sr%' and send_count like '%$count_sr%' order by id desc")->num_rows();
            $config['per_page'] = ($page_sr > 0)?$page_sr:10;
            $config['uri_segment'] = 3;
            $choice = $config['total_rows']/$config['per_page'];
            $config['num_links'] = 2;		
            $this->pagination->initialize($config);

            $data['data'] = $this->db->query("select * from newsletter_news where news_title like '%$title_sr%' and send_count like '%$count_sr%' order by id desc limit ".$limit.",".$config['per_page']."")->result();
            $data['halaman'] = $this->pagination->create_links();
            $data['total_data']= $this->db->query("select * from newsletter_news where news_title like '%$title_sr%' and send_count like '%$count_sr%' order by id desc")->num_rows();
            $data['page_sr'] = $page_sr;
            $data['id_sr'] = $id_sr;
            $data['title_sr'] = $title_sr;
            $data['count_sr'] = $count_sr;
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
        $message=$this->input->post('message');
        $data=array("news_title"=>$title,
                    "news_description"=>$message);
        $this->db->insert("newsletter_news",$data);
        
        redirect("newsletter/search");
    }
    
    function update($id,$page){
        $data['list_detail']=$this->db->query("select * from newsletter_news where id='$id'")->row();
        $data['posisi']=$page;
        $data['view']='edit';
        $this->load->view('template',$data);
    }
    
    function update_proses(){
        $session_data = $this->session->userdata('logged_in');
        $datetime=date("Y-m-d h:i:s");
        $posisi=$this->input->post("posisi");
        $id=$this->input->post("id");
        $title=$this->input->post('title');
        $message=$this->input->post('message');
        $data=array("news_title"=>$title,
                    "news_description"=>$message);
        $this->main_model->update("newsletter_news","id",$id,$data);
        
        redirect("newsletter/search/".$posisi);
    }
    
    function delete($id,$page){
        $this->main_model->delete("newsletter_news","id",$id);
        redirect("article/search/".$page);
    }
    
    function image_browse(){
        $this->load->view("image_browse");
    }
    
    function send_email(){
        $id_news=$this->input->post('id_news');
        $news=$this->db->query("select * from newsletter_news where id='$id_news'")->row();
        $list_email=$this->db->query("select * from newsletter_email")->result();
        $data['message']=$news->news_description;
        foreach($list_email as $list_emailx){
            $ci = get_instance();
            $ci->load->library('email');
            $config['protocol'] = "smtp";
            $config['smtp_host'] = "ssl://smtp.gmail.com";
            $config['smtp_port'] = "465";
            $config['smtp_user'] = "supri170845@gmail.com"; 
            $config['smtp_pass'] = "170845inoy";
            $config['charset'] = "utf-8";
            $config['mailtype'] = "html";
            $config['newline'] = "\r\n";
            //$config['protocol'] = 'sendmail';
            $config['wordwrap'] = TRUE;
            $ci->email->initialize($config);

            $ci->email->from('info@desalite.co.id', 'PT.Desalite');
            $ci->email->to($list_emailx->email);
            $ci->email->subject($news->news_title);
            //$ci->email->cc('fhenny@time.co.id');
            $ci->email->message($this->load->view('news_mail',$data,TRUE));
            $ci->email->send();
        }
        $data_update=array('send_count'=>($news->send_count + 1));
        $this->main_model->update('newsletter_news','id',$id_news,$data_update);
        return true;
    }
}