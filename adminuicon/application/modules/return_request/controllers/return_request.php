<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Return_request extends MX_Controller{
    public function __construct() {
        parent::__construct();
        if($this->session->userdata('logged_in')==false){
            redirect('login');    
        }
        $this->load->model('m_return_request');
    }
        
    function index(){
        $this->session->unset_userdata('page_sr');
        $this->session->unset_userdata('order_sr');
        $this->session->unset_userdata('date_sr');
        $this->session->unset_userdata('reason_sr');
        $this->session->unset_userdata('action_sr');
        $this->session->unset_userdata('status_sr');
        $this->session->unset_userdata('from_sr');
        $this->session->unset_userdata('to_sr');
        $config['base_url'] = base_url().'return_request/index/';
        $config['total_rows'] = $this->db->query("select * from t_return_product group by order_number order by id desc ")->num_rows();
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
        $data['total_data']=$this->db->query("select * from t_return_product group by order_number order by id desc ")->num_rows();
        $data['data'] = $this->db->query("select * from t_return_product group by order_number order by id desc  limit ".$pg.",".$config['per_page']."")->result();
        $data['view']='main';
        $this->load->view('template',$data);
    }
    
    function search(){
        $page_sr = $this->m_return_request->handler0("page_sr",$this->input->get_post('page_sr', TRUE));
        $order_sr = $this->m_return_request->handler0("order_sr",$this->input->get_post('order_sr', TRUE));
        $date_sr = $this->m_return_request->handler0("date_sr",$this->input->get_post('date_sr', TRUE));
        $reason_sr = $this->m_return_request->handler0("reason_sr",$this->input->get_post('reason_sr', TRUE));
        $action_sr = $this->m_return_request->handler0("action_sr",$this->input->get_post('action_sr', TRUE));
        $status_sr = $this->m_return_request->handler0("status_sr",$this->input->get_post('status_sr', TRUE));
        $between="";
        if($this->input->post('from_sr')=="" && $this->input->post('to_sr')==""){
            $from_sr = "";
            $to_sr = "";
            $between="";
        }else{
            $from_sr = $this->m_return_request->handler0("from_sr",$this->input->get_post('from_sr', TRUE));
            $to_sr = $this->m_return_request->handler0("to_sr",$this->input->get_post('to_sr', TRUE));
            $between="and date(sys_create_date) BETWEEN '$from_sr' and '$to_sr'";
        }
                
        $limit = ($this->uri->segment(3) > 0)?$this->uri->segment(3):0;

        $config['base_url'] = base_url() .'return_request/search';
        $config['total_rows'] = $this->db->query("select * from t_return_product
                                                 where order_number LIKE '%$order_sr%'
                                                 and date(sys_create_date) like '%$date_sr%'
                                                 and reason like '%$reason_sr%'
                                                 and action like '%$action_sr%'
                                                 and status like '%$status_sr%'
                                                 $between
                                                 group by order_number
                                                 order by id desc")->num_rows();
        $config['per_page'] = ($page_sr > 0)?$page_sr:10;
        $config['uri_segment'] = 3;
        $choice = $config['total_rows']/$config['per_page'];
        $config['num_links'] = 2;		
        $this->pagination->initialize($config);

        $data['data'] = $this->db->query("select * from t_return_product
                                        where order_number LIKE '%$order_sr%'
                                        and date(sys_create_date) like '%$date_sr%'
                                        and reason like '%$reason_sr%'
                                        and action like '%$action_sr%'
                                        and status like '%$status_sr%'
                                        $between
                                        group by order_number
                                        order by id desc
                                        limit ".$limit.",".$config['per_page']."")->result();
        $data['halaman'] = $this->pagination->create_links();
        $data['total_data']= $this->db->query("select * from t_return_product
                                              where order_number LIKE '%$order_sr%'
                                              and date(sys_create_date) like '%$date_sr%'
                                              and reason like '%$reason_sr%'
                                              and action like '%$action_sr%'
                                              and status like '%$status_sr%'
                                              $between
                                              group by order_number
                                              order by id desc")->num_rows();
        $data['page_sr'] = $page_sr;
        $data['order_sr'] = $order_sr;
        $data['date_sr'] = $date_sr;
        $data['reason_sr'] = $reason_sr;
        $data['action_sr'] = $action_sr;
        $data['status_sr'] = $status_sr;
        $data['from_sr'] = $from_sr;
        $data['to_sr'] = $to_sr;
        $data['view']='search';
        $this->load->view('template',$data);
    }
    
    function update($id,$cust){
        $data['detail']=$this->db->query("select a.*,a.id as idx,b.product_name,c.product_category_name,d.brand_name,e.product_image1,f.*
                                        from t_return_product a
                                        INNER JOIN product_general b on a.id_product=b.id
                                        INNER JOIN product_category c on b.product_category=c.id
                                        INNER JOIN brand d on b.product_brand=d.id
                                        INNER JOIN product_images e on e.product_general_id=b.id
                                        INNER JOIN product_detail f on f.product_general_id=b.id
                                        where a.order_number='$id'")->result();
        $data['cust']=$this->db->query("select b.* from t_return_product a left join cust_detail b on a.id_cust=b.id where a.id_cust='$cust' group by a.id_cust")->row();
        $data['view']="edit";
        $this->load->view("template",$data);
    }
    
    function update_proses(){
        $order_number=$this->input->post('order_number');
        $status=$this->input->post('status');
        $this->db->query("update t_return_product set status='$status' where order_number='$order_number'");
        redirect('return_request/index');
    }
        
}