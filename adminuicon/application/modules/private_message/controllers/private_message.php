<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Private_message extends MX_Controller{
    public function __construct() {
        parent::__construct();
        if($this->session->userdata('logged_in')==false){
            redirect('login');    
        }
        $this->load->model('m_private_message');
        $this->load->model('main_model');
    }
        
    function index(){
        $this->load->database('desalite',TRUE);
        $this->session->unset_userdata('page_sr');
        $this->session->unset_userdata('customer_sr');
        $this->session->unset_userdata('product_sr');
        $this->session->unset_userdata('question_sr');
        $this->session->unset_userdata('answered_sr');
        $this->session->unset_userdata('status_sr');
        $config['base_url'] = base_url().'private_message/index/';
        $config['total_rows'] = $this->db->query("select a.*,b.name,c.product_name 
                                                  from private_message a
                                                  left join customer b on a.customer_id=b.id_customer
                                                  left join product c on a.product_id=c.id_product order by a.id desc")->num_rows();
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
        $data['total_data']=$this->db->query("select a.*,b.name,c.product_name 
                                                  from private_message a
                                                  left join customer b on a.customer_id=b.id_customer
                                                  left join product c on a.product_id=c.id_product order by a.id desc")->num_rows();
        $data['data'] = $this->db->query("select a.*,b.name,c.product_name 
                                                  from private_message a
                                                  left join customer b on a.customer_id=b.id_customer
                                                  left join product c on a.product_id=c.id_product order by a.id desc limit ".$pg.",".$config['per_page']."")->result();
        $data['view']='main';
        $this->load->view('template',$data);
    }
    
    public function search() 
	{
        $this->load->database('desalite',TRUE);
            if($_POST){
                $page_sr = ($this->input->get_post('page_sr')==""?$this->session->unset_userdata('page_sr'):$this->main_model->handler0('page_sr',$this->input->get_post('page_sr', TRUE)));
                $customer_sr = ($this->input->get_post('customer_sr')==""?$this->session->unset_userdata('customer_sr'):$this->main_model->handler0('customer_sr',$this->input->get_post('customer_sr', TRUE)));
                $product_sr = ($this->input->get_post('product_sr')==""?$this->session->unset_userdata('product_sr'):$this->main_model->handler0('product_sr',$this->input->get_post('product_sr', TRUE)));
                $question_sr = ($this->input->get_post('question_sr')==""?$this->session->unset_userdata('question_sr'):$this->main_model->handler0('question_sr',$this->input->get_post('question_sr', TRUE)));
                $answered_sr = ($this->input->get_post('answered_sr')==""?$this->session->unset_userdata('answered_sr'):$this->main_model->handler0('answered_sr',$this->input->get_post('answered_sr', TRUE)));
                $status_sr = ($this->input->get_post('status_sr')==""?$this->session->unset_userdata('status_sr'):$this->main_model->handler0('status_sr',$this->input->get_post('status_sr', TRUE)));
            }else{
                $page_sr = $this->main_model->handler0('page_sr',$this->input->get_post('page_sr', TRUE));
                $customer_sr = $this->main_model->handler0('customer_sr',$this->input->get_post('customer_sr', TRUE));
                $product_sr = $this->main_model->handler0('product_sr',$this->input->get_post('product_sr', TRUE));
                $question_sr = $this->main_model->handler0('question_sr',$this->input->get_post('question_sr', TRUE));
                $answered_sr = $this->main_model->handler0('answered_sr',$this->input->get_post('answered_sr', TRUE));
                $status_sr = $this->main_model->handler0('status_sr',$this->input->get_post('status_sr', TRUE));
            }
            //echo $id_sr,$name_sr,$status_sr;
            $limit = ($this->uri->segment(3) > 0)?$this->uri->segment(3):0;

            $config['base_url'] = base_url() .'private_message/search';
            $config['total_rows'] = $this->db->query("select a.*,b.name,c.product_name 
                                                  from private_message a
                                                  left join customer b on a.customer_id=b.id_customer
                                                  left join product c on a.product_id=c.id_product 
                                                  where b.name like '%$customer_sr%' AND
                                                  c.product_name like '%$product_sr%' AND
                                                  a.question like '%$question_sr%' AND
                                                  a.answered like '%$answered_sr%' AND
                                                  a.status like '%$status_sr%'
                                                  order by a.id desc")->num_rows();
            $config['per_page'] = ($page_sr > 0)?$page_sr:10;
            $config['uri_segment'] = 3;
            $choice = $config['total_rows']/$config['per_page'];
            $config['num_links'] = 2;		
            $this->pagination->initialize($config);

            $data['data'] = $this->db->query("select a.*,b.name,c.product_name 
                                                  from private_message a
                                                  left join customer b on a.customer_id=b.id_customer
                                                  left join product c on a.product_id=c.id_product 
                                                  where b.name like '%$customer_sr%' AND
                                                  c.product_name like '%$product_sr%' AND
                                                  a.question like '%$question_sr%' AND
                                                  a.answered like '%$answered_sr%' AND
                                                  a.status like '%$status_sr%'
                                                  order by a.id desc limit ".$limit.",".$config['per_page']."")->result();
            $data['halaman'] = $this->pagination->create_links();
            $data['total_data']= $this->db->query("select a.*,b.name,c.product_name 
                                                  from private_message a
                                                  left join customer b on a.customer_id=b.id_customer
                                                  left join product c on a.product_id=c.id_product 
                                                  where b.name like '%$customer_sr%' AND
                                                  c.product_name like '%$product_sr%' AND
                                                  a.question like '%$question_sr%' AND
                                                  a.answered like '%$answered_sr%' AND
                                                  a.status like '%$status_sr%'
                                                  order by a.id desc")->num_rows();
            $data['page_sr'] = $page_sr;
            $data['customer_sr'] = $customer_sr;
            $data['product_sr'] = $product_sr;
            $data['question_sr'] = $question_sr;
            $data['answered_sr'] = $answered_sr;
            $data['status_sr'] = $status_sr;
            $data['view']='search';
            $this->load->view('template',$data);
	}
    
    function update($id,$page){
        $this->load->database('desalite',TRUE);
        $data['data']=$this->db->query("select a.*,b.name,c.product_name 
                                                  from private_message a
                                                  left join customer b on a.customer_id=b.id_customer
                                                  left join product c on a.product_id=c.id_product where a.id='$id'")->row();
        $data['posisi']=$page;
        $data['view']='edit';
        $this->load->view('template',$data);
    }
    
    function update_proses(){
        $this->load->database('desalite',TRUE);
        $session_data = $this->session->userdata('logged_in');
        $datetime=date("Y-m-d h:i:s");
        $posisi=$this->input->post("posisi");
        $id=$this->input->post("id");
        $question=$this->input->post('question');
        $answered=$this->input->post('answered');
        $status=$this->input->post('status');
        
        $data=array("question"=>$question,"answered"=>$answered,"status"=>$status,"answered_date"=>$datetime);
        $this->m_private_message->update("private_message","id",$id,$data);
        
        redirect("private_message/search/".$posisi);
    }
}