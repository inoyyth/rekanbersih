<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Coupon extends MX_Controller{
    public function __construct() {
        parent::__construct();
//        if($this->session->userdata('logged_in')==false){
//            redirect('login');    
//        }
        $this->load->model('m_coupon');
    }
        
    function index(){
        $this->session->unset_userdata('page_sr');
        $this->session->unset_userdata('id_sr');
        $this->session->unset_userdata('name_sr');
        $this->session->unset_userdata('code_sr');
        $this->session->unset_userdata('type_sr');
        $this->session->unset_userdata('expiry_sr');
        $this->session->unset_userdata('status_sr');
        $config['base_url'] = base_url().'coupon/index/';
        $config['total_rows'] = $this->db->query("select a.*,b.coupon_type from coupon a inner join coupon_type b on a.coupon_type=b.id order by id desc")->num_rows();
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
        $data['total_data']=$this->db->query("select a.*,b.coupon_type from coupon a inner join coupon_type b on a.coupon_type=b.id order by a.id desc")->num_rows();
        $data['data'] = $this->db->query("select a.*,b.coupon_type from coupon a inner join coupon_type b on a.coupon_type=b.id order by a.id desc limit ".$pg.",".$config['per_page']."")->result();
        $data['view']='main';
        $this->load->view('template',$data);
    }
    
    function search()
	{
            $page_sr = $this->m_coupon->handler0("page_sr",$this->input->get_post('page_sr', TRUE));
            $id_sr = $this->m_coupon->handler0("id_sr",$this->input->get_post('id_sr', TRUE));
            $name_sr = $this->m_coupon->handler0("name_sr",$this->input->get_post('name_sr', TRUE));
            $code_sr = $this->m_coupon->handler0("code_sr",$this->input->get_post('code_sr', TRUE));
            $type_sr = $this->m_coupon->handler0("type_sr",$this->input->get_post('type_sr', TRUE));
            $expiry_sr = $this->m_coupon->handler0("expiry_sr",$this->input->get_post('expiry_sr', TRUE));
            $status_sr = $this->m_coupon->handler0("status_sr",$this->input->get_post('status_sr', TRUE));
            //echo $id_sr,$name_sr,$status_sr;
            $limit = ($this->uri->segment(3) > 0)?$this->uri->segment(3):0;

            $config['base_url'] = base_url() .'coupon/search';
            $config['total_rows'] = $this->db->query("select a.*,b.coupon_type from coupon a inner join coupon_type b on a.coupon_type=b.id where a.id LIKE '%$id_sr%' and a.coupon_name LIKE '%$name_sr%' and a.coupon_code LIKE '%$code_sr%' and b.coupon_type LIKE '%$type_sr%' and a.expiry_date LIKE '%$expiry_sr%' and a.status LIKE '%$status_sr%' order by a.id desc")->num_rows();
            $config['per_page'] = ($page_sr > 0)?$page_sr:10;
            $config['uri_segment'] = 3;
            $choice = $config['total_rows']/$config['per_page'];
            $config['num_links'] = 2;		
            $this->pagination->initialize($config);

            $data['data'] = $this->db->query("select a.*,b.coupon_type from coupon a inner join coupon_type b on a.coupon_type=b.id where a.id LIKE '%$id_sr%' and a.coupon_name LIKE '%$name_sr%' and a.coupon_code LIKE '%$code_sr%' and b.coupon_type LIKE '%$type_sr%' and a.expiry_date LIKE '%$expiry_sr%' and a.status LIKE '%$status_sr%' order by a.id desc limit ".$limit.",".$config['per_page']."")->result();
            $data['halaman'] = $this->pagination->create_links();
            $data['total_data']= $this->db->query("select a.*,b.coupon_type from coupon a inner join coupon_type b on a.coupon_type=b.id where a.id LIKE '%$id_sr%' and a.coupon_name LIKE '%$name_sr%' and a.coupon_code LIKE '%$code_sr%' and b.coupon_type LIKE '%$type_sr%' and a.expiry_date LIKE '%$expiry_sr%' and a.status LIKE '%$status_sr%' order by a.id desc")->num_rows();
            $data['id_sr'] = $id_sr;
            $data['name_sr'] = $name_sr;
            $data['code_sr'] = $code_sr;
            $data['type_sr'] = $type_sr;
            $data['expiry_sr'] = $expiry_sr;
            $data['status_sr'] = $status_sr;
            $data['page_sr'] = $page_sr;
            $data['view']='search';
            $this->load->view('template',$data);
	}
        
        function add(){
            $data['list_type'] = $this->db->query("select * from coupon_type")->result();
            $data['view']='add';
            $this->load->view('template',$data);
        }
        
        function add_proses(){
            $session_data = $this->session->userdata('logged_in');
            $datetime=date("Y-m-d h:i:s");
            
            $coupon_name=$this->input->post("coupon_name");
            $coupon_code=$this->input->post("coupon_code");
            $coupon_type=$this->input->post("coupon_type");
            $description=$this->input->post("description");
            
            $amount=$this->input->post("amount");
            $sub_total_cart=$this->input->post("sub_total_cart");
            $limit_per_coupon=$this->input->post("limit_per_coupon");
            $limit_per_user=$this->input->post("limit_per_user");
            
            $satu=($this->input->post("satu")) ? $this->input->post("satu") : "none" ;
            $dua=($this->input->post("dua")) ? $this->input->post("dua") : "none" ;
            $tiga=($this->input->post("tiga")) ? $this->input->post("tiga") : "none" ;
            $other_coupon=$this->input->post('other_coupon');
            $sale_item=$this->input->post('sale_item');
            $member_only=$this->input->post('member_only');
            
            $app_product=$this->input->post("app_product");
            $exc_product=$this->input->post("exc_product");
            $app_category=$this->input->post("app_category");
            $exc_category=$this->input->post("exc_category");
            $app_brand=$this->input->post("app_brand");
            $exc_brand=$this->input->post("exc_brand");
            
            $expiry_date=$this->input->post("expiry_date");
            $status=$this->input->post("status");
            
            $data=array(
                "coupon_name"=>$coupon_name,
                "coupon_code"=>$coupon_code,
                "description"=>$description,
                "coupon_type"=>$coupon_type,
                
                "amount"=>$amount,
                "minimum_sub_total"=>$sub_total_cart,
                "usage_limit_type"=>$limit_per_coupon,
                "usage_limit_total"=>$limit_per_user,
                
                "other_coupon"=>$other_coupon,
                "sale_item"=>$sale_item,
                "member_only"=>$member_only,
                
                "app_product"=>$app_product,
                "exc_product"=>$exc_product,
                "app_category"=>$app_category,
                "exc_category"=>$exc_category,
                "app_brand"=>$app_brand,
                "exc_brand"=>$exc_brand,
                
                "expiry_date"=>$expiry_date,
                "status"=>$status,
                "sys_create_user"=>$session_data['user_id'],
                "sys_create_date"=>$datetime
            );
            
            $this->db->insert("coupon",$data);
            
            redirect("coupon/search");
        }
        
        function update_proses(){
            $session_data = $this->session->userdata('logged_in');
            $datetime=date("Y-m-d h:i:s");
            $posisi=$this->input->post("posisi");
            
            $id=$this->input->post("id");
            $coupon_name=$this->input->post("coupon_name");
            $coupon_code=$this->input->post("coupon_code");
            $coupon_type=$this->input->post("coupon_type");
            $description=$this->input->post("description");
            
            $amount=$this->input->post("amount");
            $sub_total_cart=$this->input->post("sub_total_cart");
            $limit_per_coupon=$this->input->post("limit_per_coupon");
            $limit_per_user=$this->input->post("limit_per_tot");
            
            $satu=($this->input->post("satu")) ? $this->input->post("satu") : "none" ;
            $dua=($this->input->post("dua")) ? $this->input->post("dua") : "none" ;
            $tiga=($this->input->post("tiga")) ? $this->input->post("tiga") : "none" ;
            $other_coupon=$this->input->post('other_coupon');
            $sale_item=$this->input->post('sale_item');
            $member_only=$this->input->post('member_only');
            
            $app_product=$this->input->post("app_product");
            $exc_product=$this->input->post("exc_product");
            $app_category=$this->input->post("app_category");
            $exc_category=$this->input->post("exc_category");
            $app_brand=$this->input->post("app_brand");
            $exc_brand=$this->input->post("exc_brand");
            
            $expiry_date=$this->input->post("expiry_date");
            $status=$this->input->post("status");
            
            $data=array(
                "coupon_name"=>$coupon_name,
                "coupon_code"=>$coupon_code,
                "description"=>$description,
                "coupon_type"=>$coupon_type,
                
                "amount"=>$amount,
                "minimum_sub_total"=>$sub_total_cart,
                "usage_limit_type"=>$limit_per_coupon,
                "usage_limit_total"=>$limit_per_user,
                
                "other_coupon"=>$other_coupon,
                "sale_item"=>$sale_item,
                "member_only"=>$member_only,
                
                "app_product"=>$app_product,
                "exc_product"=>$exc_product,
                "app_category"=>$app_category,
                "exc_category"=>$exc_category,
                "app_brand"=>$app_brand,
                "exc_brand"=>$exc_brand,
                
                "expiry_date"=>$expiry_date,
                "status"=>$status,
                "sys_create_user"=>$session_data['user_id'],
                "sys_create_date"=>$datetime
            );
            $this->db->where("id",$id);
            $this->db->update("coupon",$data);
            
            redirect("coupon/search/".$posisi);
        }
        
        function update($id,$page){
            $data['list_detail']=$this->db->query("select * from coupon where id='$id'")->row();
            $data['list_type'] = $this->db->query("select * from coupon_type")->result();
            $data['posisi']=$page;
            $data['view']='edit';
            $this->load->view('template',$data);
        }
        
        function listproduct(){
            $id=$this->input->get("q");
            $arr=$this->db->query("select id,product_name as name from product_general where product_name LIKE '%$id%'")->result_array();
            //$arr=array(array("id"=>"856","name"=>"Manoj"),array("id"=>"857","name"=>"Ravi"));
            $json_response = json_encode($arr);
            # Optionally: Wrap the response in a callback function for JSONP cross-domain support


            # Return the response
            echo $json_response;
        }
        
        function listcategory(){
            $id=$this->input->get("q");
            $arr=$this->db->query("select id,product_category_name as name from product_category where product_category_name LIKE '%$id%' and product_category_status='Y'")->result_array();
            //$arr=array(array("id"=>"856","name"=>"Manoj"),array("id"=>"857","name"=>"Ravi"));
            $json_response = json_encode($arr);
            # Optionally: Wrap the response in a callback function for JSONP cross-domain support


            # Return the response
            echo $json_response;
        }
        
         function listbrand(){
            $id=$this->input->get("q");
            $arr=$this->db->query("select id,brand_name as name from brand where brand_name LIKE '%$id%' and status='Y'")->result_array();
            //$arr=array(array("id"=>"856","name"=>"Manoj"),array("id"=>"857","name"=>"Ravi"));
            $json_response = json_encode($arr);
            # Optionally: Wrap the response in a callback function for JSONP cross-domain support


            # Return the response
            echo $json_response;
        }
        
        function delete($id){
            $this->db->delete('coupon', array('id' => $id)); 
            redirect("coupon/search");
       }
}