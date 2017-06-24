<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sales_order extends MX_Controller{ 
    public function __construct() {
        parent::__construct();
        if($this->session->userdata('logged_in_admin')==false){
            redirect('login');    
        }
        $this->load->model('m_sales_order');
        $this->load->model('main_model');
    }
        
    function index(){
        $this->session->unset_userdata('page_sr');
        $this->session->unset_userdata('id_sr');
        $this->session->unset_userdata('name_sr');
        $this->session->unset_userdata('handphone');
        $this->session->unset_userdata('email_sr');
		$this->session->unset_userdata('tanggal_sr');
		$this->session->unset_userdata('tipe_sr');
		$this->session->unset_userdata('status_sr');
        $config['base_url'] = base_url().'sales_order/index/';
        $config['total_rows'] = $this->db->query("select * from sales_order order by id desc")->num_rows();
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
        $data['total_data']=$this->db->query("select * from sales_order order by id desc")->num_rows();
        $data['data'] = $this->db->query("select * from sales_order order by id desc limit ".$pg.",".$config['per_page']."")->result();
        $data['view']='main';
        $this->load->view('template',$data);
    }
    
    public function search()
	{
            if($_POST){
                $page_sr = ($this->input->get_post('page_sr')==""?$this->session->unset_userdata('page_sr'):$this->main_model->handler0('page_sr',$this->input->get_post('page_sr', TRUE)));
                $id_sr = ($this->input->get_post('id_sr')==""?$this->session->unset_userdata('id_sr'):$this->main_model->handler0('id_sr',$this->input->get_post('id_sr', TRUE)));
				$name_sr = ($this->input->get_post('name_sr')==""?$this->session->unset_userdata('name_sr'):$this->main_model->handler0('name_sr',$this->input->get_post('name_sr', TRUE)));
                $handphone_sr = ($this->input->get_post('handphone_sr')==""?$this->session->unset_userdata('handphone_sr'):$this->main_model->handler0('handphone_sr',$this->input->get_post('handphone_sr', TRUE)));
                $email_sr = ($this->input->get_post('email_sr')==""?$this->session->unset_userdata('email_sr'):$this->main_model->handler0('email_sr',$this->input->get_post('email_sr', TRUE)));
                $tanggal_sr = ($this->input->get_post('tanggal_sr')==""?$this->session->unset_userdata('tanggal_sr'):$this->main_model->handler0('tanggal_sr',$this->input->get_post('tanggal_sr', TRUE)));
				$tipe_sr = ($this->input->get_post('tipe_sr')==""?$this->session->unset_userdata('tipe_sr'):$this->main_model->handler0('tipe_sr',$this->input->get_post('tipe_sr', TRUE)));
				$status_sr = ($this->input->get_post('status_sr')==""?$this->session->unset_userdata('status_sr'):$this->main_model->handler0('status_sr',$this->input->get_post('status_sr', TRUE)));
            }else{
                $page_sr = $this->main_model->handler0('page_sr',$this->input->get_post('page_sr', TRUE));
                $id_sr = $this->main_model->handler0('id_sr',$this->input->get_post('id_sr', TRUE));
                $name_sr = $this->main_model->handler0('name_sr',$this->input->get_post('name_sr', TRUE));
                $handphone_sr = $this->main_model->handler0('handphone_sr',$this->input->get_post('handphone_sr', TRUE));
                $email_sr = $this->main_model->handler0('email_sr',$this->input->get_post('email_sr', TRUE));
				$tanggal_sr = $this->main_model->handler0('tanggal_sr',$this->input->get_post('tanggal_sr', TRUE));
				$tipe_sr = $this->main_model->handler0('tipe_sr',$this->input->get_post('tipe_sr', TRUE));
				$status_sr = $this->main_model->handler0('status_sr',$this->input->get_post('status_sr', TRUE));
            }
            //echo $id_sr,$name_sr,$status_sr;
            $limit = ($this->uri->segment(3) > 0)?$this->uri->segment(3):0;

            $config['base_url'] = base_url() .'sales_order/search';
            $config['total_rows'] = $this->db->query("select * from sales_order where id like '%$id_sr%' and nama like '%$name_sr%' and handphone like '%$handphone_sr%' and email like '%$email_sr%' and tanggal like '%$tanggal_sr%' and tipe_paket like '%$tipe_sr%' and status like '%$status_sr%' order by id desc")->num_rows();
            $config['per_page'] = ($page_sr > 0)?$page_sr:10;
            $config['uri_segment'] = 3;
            $choice = $config['total_rows']/$config['per_page'];
            $config['num_links'] = 2;		
            $this->pagination->initialize($config);

            $data['data'] = $this->db->query("select * from sales_order where id like '%$id_sr%' and nama like '%$name_sr%' and handphone like '%$handphone_sr%' and email like '%$email_sr%' and tanggal like '%$tanggal_sr%' and tipe_paket like '%$tipe_sr%' and status like '%$status_sr%' order by id desc limit ".$limit.",".$config['per_page']."")->result();
            $data['halaman'] = $this->pagination->create_links();
            $data['total_data']= $this->db->query("select * from sales_order where id like '%$id_sr%' and nama like '%$name_sr%' and handphone like '%$handphone_sr%' and email like '%$email_sr%' and tanggal like '%$tanggal_sr%' and tipe_paket like '%$tipe_sr%' and status like '%$status_sr%' order by id desc")->num_rows();
            $data['page_sr'] = $page_sr;
            $data['id_sr'] = $id_sr;
            $data['name_sr'] = $name_sr;
            $data['handphone_sr'] = $handphone_sr;
            $data['email_sr'] = $email_sr;
			$data['tanggal_sr'] = $tanggal_sr;
			$data['tipe_sr'] = $tipe_sr;
			$data['status_sr'] = $status_sr;
            $data['view']='search';
            $this->load->view('template',$data);
	}
    
    /* function add(){
        $data['list_category']=$this->db->query("select * from sales_order_category where status='Y'")->result();
        $data['view']='add';
        $this->load->view('template',$data);
    } */
    /* function add_proses(){
        $session_data = $this->session->userdata('logged_in');
        $datetime=date("Y-m-d h:i:s");
        $cat=$this->input->post('category');
        $subcat=$this->input->post('subcategory');
        $name=$this->input->post('sales_order');
        $description=$this->input->post('description');
        $status=$this->input->post('status');
        $thumbnail=$this->input->post('thumbnail');
        $index_sales_order=$this->input->post('index_sales_order');
        if($index_sales_order=="1"){
            $this->db->query("update sales_order set index_sales_order='0'");
        }
        
        $data=array("id_category"=>$cat,
                    "id_subcategory"=>$subcat,
                    "sales_order_name"=>$name,
                    "sales_order_description"=>$description,
                    "status"=>$status,
                    "index_sales_order"=>$index_sales_order,
                    "sys_create_user"=>$session_data['user_id'],
                    "sales_order_image"=>$thumbnail,
                    "sys_create_date"=>$datetime);
        $this->db->insert("sales_order",$data);
        
        redirect("sales_order/search");
    } */
    
    function update($id,$page){
        $data['list_detail']=$this->db->query("select a.*,b.kota,c.schedule_visit,d.service_type,e.durasi_paket 
											   from sales_order a 
											   left join kota b on a.id_kota=b.id 
											   left join schedule_visit c on a.id_schedule_visit=c.id 
											   left join service_type d on a.id_service_type=d.id 
											   left join durasi_paket e on a.id_durasi_paket=e.id 
											   where a.id='$id'")->row();
        $data['posisi']=$page;
        $data['view']='edit';
        $this->load->view('template',$data);
    }
    
    function update_proses(){
        $session_data = $this->session->userdata('logged_in');
        $datetime=date("Y-m-d h:i:s");
        $posisi=$this->input->post("posisi");
        $id=$this->input->post("id");
        $status=$this->input->post('status');
        $remark=$this->input->post('remark');
        
		$data = array('status'=>$status,'remark'=>$remark);
        
        $this->m_sales_order->update("sales_order","id",$id,$data);
        
        redirect("sales_order/search/".$posisi);
    }
    
}