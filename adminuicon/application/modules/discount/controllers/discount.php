<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Discount extends MX_Controller{
    public function __construct() {
        parent::__construct();
        if($this->session->userdata('logged_in')==false){
            redirect('login');    
        }
        $this->load->model('m_discount');
        $this->load->model('main_model');
    }
        
    function index(){
        $this->session->unset_userdata('page_sr');
        $this->session->unset_userdata('name_sr');
        $this->session->unset_userdata('parameter_sr');
        $this->session->unset_userdata('from_sr');
        $this->session->unset_userdata('to_sr');
        $this->session->unset_userdata('status_sr');
        $config['base_url'] = base_url().'discount/index/';
        $config['total_rows'] = $this->db->query("select * from discount order by id desc")->num_rows();
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
        $data['total_data']=$this->db->query("select * from discount order by id desc ")->num_rows();
        $data['data'] = $this->db->query("select * from discount order by id desc limit ".$pg.",".$config['per_page']."")->result();
        $data['page_status']=$this->db->query("select * from salepage_status where id='1'")->row();
        $data['view']='main';
        $this->load->view('template',$data);
    }
    
    function search(){
        $page_sr = $this->m_discount->handler0("page_sr",$this->input->get_post('page_sr', TRUE));
        $name_sr = $this->m_discount->handler0("name_sr",$this->input->get_post('name_sr', TRUE));
        $parameter_sr = $this->m_discount->handler0("parameter_sr",$this->input->get_post('parameter_sr', TRUE));
        $from_sr = $this->m_discount->handler0("from_sr",$this->input->get_post('from_sr', TRUE));
        $to_sr = $this->m_discount->handler0("to_sr",$this->input->get_post('to_sr', TRUE));
        $status_sr = $this->m_discount->handler0("status_sr",$this->input->get_post('status_sr', TRUE));
       
        $limit = ($this->uri->segment(3) > 0)?$this->uri->segment(3):0;
        $config['base_url'] = base_url() .'discount/search';
        $config['total_rows'] = $this->db->query("select * from discount
                                                where discount_name LIKE '%$name_sr%'
                                                and parameter_discount LIKE '%$parameter_sr%'
                                                and date(from_date) LIKE '%$from_sr%'
                                                and date(to_date) LIKE '%$to_sr%'
                                                and status LIKE '%$status_sr%'
                                                order by id desc")->num_rows();
        $config['per_page'] = ($page_sr > 0)?$page_sr:10;
        $config['uri_segment'] = 3;
        $choice = $config['total_rows']/$config['per_page'];
        $config['num_links'] = 2;		
        $this->pagination->initialize($config);

        $data['data'] = $this->db->query("select * from discount
                                        where discount_name LIKE '%$name_sr%'
                                        and parameter_discount LIKE '%$parameter_sr%'
                                        and date(from_date) LIKE '%$from_sr%'
                                        and date(to_date) LIKE '%$to_sr%'
                                        and status LIKE '%$status_sr%'
                                        order by id desc
                                        limit ".$limit.",".$config['per_page']."")->result();
        $data['halaman'] = $this->pagination->create_links();
        $data['total_data']= $this->db->query("select * from discount
                                                where discount_name LIKE '%$name_sr%'
                                                and parameter_discount LIKE '%$parameter_sr%'
                                                and date(from_date) LIKE '%$from_sr%'
                                                and date(to_date) LIKE '%$to_sr%'
                                                and status LIKE '%$status_sr%'
                                                order by id desc")->num_rows();
        $data['page_sr'] = $page_sr;
        $data['name_sr'] = $name_sr;
        $data['from_sr'] = $from_sr;
        $data['to_sr'] = $to_sr;
        $data['parameter_sr'] = $parameter_sr;
        $data['status_sr'] = $status_sr;
        $data['page_status']=$this->db->query("select * from salepage_status where id='1'")->row();
        $data['view']='search';
        $this->load->view('template',$data);
    }
    
    function add(){
        $data['list_discount'] = $this->db->query("select * from main_discount where status='Y'")->result();
        $data['view']="add";
        $this->load->view('template',$data);
    }
    
    function add_proses(){
        $main_discount=$this->input->post("main_discount");
        $discount_name=$this->input->post('discount_name');
        $app_brand=$this->input->post('app_brand');
        $app_category=$this->input->post('app_category');
        $app_product=$this->input->post('app_product');
        $from_date=$this->input->post('from_date');
        $to_date=$this->input->post('to_date');
        $status=$this->input->post('status');
        
        $data_discount=array(
                'main_discount_id'=>$main_discount,
                'discount_name'=>$discount_name,
                'brand_id'=>$app_brand,
                'category_product_discount'=>$app_category,
                'apply_discount_product'=>$app_product,
                'from_date'=>$from_date,
                'to_date'=>$to_date,
                'status'=>$status,
                'sys_create_date'=>$this->main_model->sys_date()
        );
        $this->db->insert("discount",$data_discount);
        redirect('discount/index');
    }
    
    function update($id){
        $data['list_discount'] = $this->db->query("select * from main_discount where status='Y'")->result();
        $data['detail_discount']=$this->main_model->select_where("discount","id",$id)->row();
        $data['view']="edit";
        $this->load->view('template',$data);
    }
    
    function update_proses(){
        $id=$this->input->post('id');
        $main_discount=$this->input->post("main_discount");
        $discount_name=$this->input->post('discount_name');
        $app_brand=$this->input->post('app_brand');
        $app_category=$this->input->post('app_category');
        $app_product=$this->input->post('app_product');
        $from_date=$this->input->post('from_date');
        $to_date=$this->input->post('to_date');
        $status=$this->input->post('status');
        
            $data_discount=array(
                'main_discount_id'=>$main_discount,
                'discount_name'=>$discount_name,
                'brand_id'=>$app_brand,
                'category_product_discount'=>$app_category,
                'apply_discount_product'=>$app_product,
                'from_date'=>$from_date,
                'to_date'=>$to_date,
                'status'=>$status,
                'sys_update_date'=>$this->main_model->sys_date()
            );
            $this->main_model->update("discount","id",$id,$data_discount);
            redirect('discount/index');
    }
    
    function delete($id,$posisi){
        $this->main_model->delete("discount","id",$id);
        //$this->main_model->delete("discount_manual","discount_id",$id);
        //$this->main_model->delete("discount_buy_get","discount_id",$id);
        redirect("discount/search/".$posisi);
    }
    
    function listproduct(){
            $disc=$this->db->query("select CONCAT(apply_discount_product,',') as apply_discount_productx from discount where apply_discount_product!=''")->result();
            $data="";
            foreach($disc as $disx){
                $data .=$disx->apply_discount_productx;
            }
            //echo $data;
            $st=substr($data,0,-1); 
            $id=$this->input->get("q");
            if($st != ""){
            $arr=$this->db->query("select a.id as id, b.sku as name from product_general a left join product_detail b on a.id=b.product_general_id where b.sku LIKE '%$id%' and a.id not in ($st)")->result_array();
            }else{
            $arr=$this->db->query("select a.id as id, b.sku as name from product_general a left join product_detail b on a.id=b.product_general_id where b.sku LIKE '%$id%'")->result_array();    
            }
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
    
    function coba_discount(){
        $this->db->query("delete from discount_temp where member_id='5'");
        $tglsekarang=date("Y-m-d");
        $discount=$this->db->query("select * from discount where status = 'Y'")->result();
        foreach($discount as $discountx){
            if($discountx->parameter_discount=="MD"){
                if($discountx->apply_discount_product !="" && $discountx->category_product_discount !="" && $discountx->brand_id!=""){
                    $prodisc=$this->db->query("select a.*,b.product_category,product_brand,c.normal_price,special_price
                                    FROM transaksi_temp a
                                    LEFT JOIN product_general b ON a.id_product=b.id
                                    LEFT JOIN product_detail c on a.id_product=c.product_general_id
                                    where a.id_member='5'
                                    and b.id in ($discountx->apply_discount_product)")->result();
                    $hasil=0;
                    foreach($prodisc as $prodiscx){
                        //echo$prodiscx->jumlah_barang;
                        $discmanual=$this->db->query("select * from discount_manual where discount_id='$discountx->id'")->row();
                        if($discmanual->kelipatan=="1"){
                            if($discmanual->percentase=="1"){
                                $tot= ((($prodiscx->normal_price * $discmanual->value_discount_manual)/100) * $prodiscx->jumlah_barang);
                            }else{
                                $tot= $discmanual->value_discount_manual * $prodiscx->jumlah_barang;
                            }
                            $this->db->query("insert into discount_temp set transaksi_id='$prodiscx->id',member_id='5',total_discount='$tot'");
                        }else{
                            if($discmanual->percentase=="1"){
                                $tot= (($prodiscx->normal_price *$discmanual->value_discount_manual)/100);
                            }else{
                                $tot= $discmanual->value_discount_manual;
                            }
                            $this->db->query("insert into discount_temp set transaksi_id='$prodiscx->id',member_id='5',total_discount='$tot'");
                        }
                    }
                }
            }else{
                if($discountx->apply_discount_product !="" && $discountx->category_product_discount !="" && $discountx->brand_id!=""){
                    $prodisc=$this->db->query("select a.*,b.product_category,product_brand,c.normal_price,special_price
                                    FROM transaksi_temp a
                                    LEFT JOIN product_general b ON a.id_product=b.id
                                    LEFT JOIN product_detail c on a.id_product=c.product_general_id
                                    where a.id_member='5'
                                    and b.id in ($discountx->apply_discount_product)")->result();
                    foreach($prodisc as $prodiscx){
                        $discget=$this->db->query("select * from discount_buy_get where discount_id='$discountx->id'")->result();
                        $max=$this->db->query("select max(list_discount_id) as max_disc from discount_buy_get where discount_id='$discountx->id'")->row();
                        echo $max->max_disc;
                        foreach($discget as $discgetx){
                            if($discgetx->list_discount_id=="1"){
                                if($discgetx->percentase=="1"){
                                    if($prodiscx->jumlah_barang=="1"){
                                        $tot= (($prodiscx->normal_price * $discgetx->value_discount_buy_get)/100);
                                        $this->db->query("insert into discount_temp set transaksi_id='$prodiscx->id',member_id='5',total_discount='$tot'");
                                    }
                                }else{
                                    if($prodiscx->jumlah_barang=="1"){
                                        $tot= $discgetx->value_discount_buy_get;
                                        $this->db->query("insert into discount_temp set transaksi_id='$prodiscx->id',member_id='5',total_discount='$tot'");
                                    }
                                }
                            }
                            if($discgetx->list_discount_id=="3"){
                                if($discgetx->percentase=="1"){
                                    if($prodiscx->jumlah_barang=="2"){
                                        $tot= (($prodiscx->normal_price * $discgetx->value_discount_buy_get)/100);
                                        $this->db->query("insert into discount_temp set transaksi_id='$prodiscx->id',member_id='5',total_discount='$tot'");
                                    }
                                }else{
                                    if($prodiscx->jumlah_barang=="2"){
                                        $tot= $discgetx->value_discount_buy_get;
                                        $this->db->query("insert into discount_temp set transaksi_id='$prodiscx->id',member_id='5',total_discount='$tot'");
                                    }
                                }
                            }
                            if($discgetx->list_discount_id=="5"){
                                if($discgetx->percentase=="1"){
                                    if($prodiscx->jumlah_barang=="3"){
                                        $tot= (($prodiscx->normal_price * $discgetx->value_discount_buy_get)/100);
                                        $this->db->query("insert into discount_temp set transaksi_id='$prodiscx->id',member_id='5',total_discount='$tot'");
                                    }
                                }else{
                                    if($prodiscx->jumlah_barang=="3"){
                                        $tot= $discgetx->value_discount_buy_get;
                                        $this->db->query("insert into discount_temp set transaksi_id='$prodiscx->id',member_id='5',total_discount='$tot'");
                                    }
                                }
                            }
                            if($discgetx->list_discount_id=="7"){
                                if($discgetx->percentase=="1"){
                                    if($prodiscx->jumlah_barang=="4"){
                                        $tot= (($prodiscx->normal_price * $discgetx->value_discount_buy_get)/100);
                                        $this->db->query("insert into discount_temp set transaksi_id='$prodiscx->id',member_id='5',total_discount='$tot'");
                                    }
                                }else{
                                    if($prodiscx->jumlah_barang=="4"){
                                        $tot= $discgetx->value_discount_buy_get;
                                        $this->db->query("insert into discount_temp set transaksi_id='$prodiscx->id',member_id='5',total_discount='$tot'");
                                    }
                                }
                            }
                            if($discgetx->list_discount_id=="9"){
                                if($discgetx->percentase=="1"){
                                    if($prodiscx->jumlah_barang=="5"){
                                        $tot= (($prodiscx->normal_price * $discgetx->value_discount_buy_get)/100);
                                        $this->db->query("insert into discount_temp set transaksi_id='$prodiscx->id',member_id='5',total_discount='$tot'");
                                    }
                                }else{
                                    if($prodiscx->jumlah_barang=="5"){
                                        $tot= $discgetx->value_discount_buy_get;
                                        $this->db->query("insert into discount_temp set transaksi_id='$prodiscx->id',member_id='5',total_discount='$tot'");
                                    }
                                }
                            }
                            if($discgetx->list_discount_id=="2"){
                                if($discgetx->percentase=="1"){
                                    if($prodiscx->jumlah_barang>="1"){
                                        $tot= (($prodiscx->normal_price * $discgetx->value_discount_buy_get)/100);
                                        $this->db->query("insert into discount_temp set transaksi_id='$prodiscx->id',member_id='5',total_discount='$tot'");
                                    }
                                }else{
                                    if($prodiscx->jumlah_barang>="1"){
                                        $tot= $discgetx->value_discount_buy_get;
                                        $this->db->query("insert into discount_temp set transaksi_id='$prodiscx->id',member_id='5',total_discount='$tot'");
                                    }
                                }
                            }
                            if($discgetx->list_discount_id=="4"){
                                if($discgetx->percentase=="1"){
                                    if($prodiscx->jumlah_barang>="2"){
                                        $tot= (($prodiscx->normal_price * $discgetx->value_discount_buy_get)/100);
                                        $this->db->query("insert into discount_temp set transaksi_id='$prodiscx->id',member_id='5',total_discount='$tot'");
                                    }
                                }else{
                                    if($prodiscx->jumlah_barang>="2"){
                                        $tot= $discgetx->value_discount_buy_get;
                                        $this->db->query("insert into discount_temp set transaksi_id='$prodiscx->id',member_id='5',total_discount='$tot'");
                                    }
                                }
                            }
                            if($discgetx->list_discount_id=="6"){
                                if($discgetx->percentase=="1"){
                                    if($prodiscx->jumlah_barang>="3"){
                                        $tot= (($prodiscx->normal_price * $discgetx->value_discount_buy_get)/100);
                                        $this->db->query("insert into discount_temp set transaksi_id='$prodiscx->id',member_id='5',total_discount='$tot'");
                                    }
                                }else{
                                    if($prodiscx->jumlah_barang>="3"){
                                        $tot= $discgetx->value_discount_buy_get;
                                        $this->db->query("insert into discount_temp set transaksi_id='$prodiscx->id',member_id='5',total_discount='$tot'");
                                    }
                                }
                            }
                            if($discgetx->list_discount_id=="8"){
                                if($discgetx->percentase=="1"){
                                    if($prodiscx->jumlah_barang>="4"){
                                        $tot= (($prodiscx->normal_price * $discgetx->value_discount_buy_get)/100);
                                        $this->db->query("insert into discount_temp set transaksi_id='$prodiscx->id',member_id='5',total_discount='$tot'");
                                    }
                                }else{
                                    if($prodiscx->jumlah_barang>="4"){
                                        $tot= $discgetx->value_discount_buy_get;
                                        $this->db->query("insert into discount_temp set transaksi_id='$prodiscx->id',member_id='5',total_discount='$tot'");
                                    }
                                }
                            }
                            if($discgetx->list_discount_id=="10"){
                                if($discgetx->percentase=="1"){
                                    if($prodiscx->jumlah_barang>="5"){
                                        $tot= (($prodiscx->normal_price * $discgetx->value_discount_buy_get)/100);
                                        $this->db->query("insert into discount_temp set transaksi_id='$prodiscx->id',member_id='5',total_discount='$tot'");
                                    }
                                }else{
                                    if($prodiscx->jumlah_barang>="5"){
                                        $tot= $discgetx->value_discount_buy_get;
                                        $this->db->query("insert into discount_temp set transaksi_id='$prodiscx->id',member_id='5',total_discount='$tot'");
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    function disc_list(){
        $data['disc']=$this->db->query("select CONCAT(apply_discount_product,',') as apply_discount_productx from discount where apply_discount_product!='' and main_discount_id='4'")->result();
        $data['view']="disc_list";
        $data['user'] = $this->session->userdata('logged_in');
        $this->load->view('template',$data);
    }
    
     function sale_page(){
        $data['view']="sale_page";
        $data['page']=$this->db->query("select * from salepage_status where id='1'")->row();
        $this->load->view('template',$data);
    }
    
    function salepage_proses(){
        $form_date=$this->input->post('from_date');
        $to_date=$this->input->post('to_date');
        $status=$this->input->post('status');
        
        $data=array(
            'from_date'=>$form_date,
            'to_date'=>$to_date,
            'status'=>$status
        );
        $this->main_model->update("salepage_status","id","1",$data);
        redirect('discount/index');
    }
    
    //////////////////////////////Main Discount////////////////////////////////////////////
    
    function index_main_discount(){
        $this->session->unset_userdata('page_sr');
        $this->session->unset_userdata('name_sr');
        $this->session->unset_userdata('parameter_sr');
        $this->session->unset_userdata('minimum_sr');
        $this->session->unset_userdata('status_sr');
        $config['base_url'] = base_url().'discount/index_main_discount/';
        $config['total_rows'] = $this->db->query("select * from main_discount order by id desc")->num_rows();
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
        $data['total_data']=$this->db->query("select * from main_discount order by id desc ")->num_rows();
        $data['data'] = $this->db->query("select * from main_discount order by id desc limit ".$pg.",".$config['per_page']."")->result();
        $data['page_status']=$this->db->query("select * from salepage_status where id='1'")->row();
        $data['view']='main_discount';
        $this->load->view('template',$data);
    }
    
    function search_main_discount(){
        $page_sr = $this->m_discount->handler0("page_sr",$this->input->get_post('page_sr', TRUE));
        $name_sr = $this->m_discount->handler0("name_sr",$this->input->get_post('name_sr', TRUE));
        $parameter_sr = $this->m_discount->handler0("parameter_sr",$this->input->get_post('parameter_sr', TRUE));
        $minimum_sr = $this->m_discount->handler0("minimum_sr",$this->input->get_post('minimum_sr', TRUE));
        $status_sr = $this->m_discount->handler0("status_sr",$this->input->get_post('status_sr', TRUE));
       
        $limit = ($this->uri->segment(3) > 0)?$this->uri->segment(3):0;
        $config['base_url'] = base_url() .'discount/search_main_discount';
        $config['total_rows'] = $this->db->query("select * from main_discount
                                                where discount_name LIKE '%$name_sr%'
                                                and parameter_discount LIKE '%$parameter_sr%'
                                                and status LIKE '%$status_sr%'
                                                and minimum_value LIKE '%$minimum_sr%'
                                                order by id desc")->num_rows();
        $config['per_page'] = ($page_sr > 0)?$page_sr:10;
        $config['uri_segment'] = 3;
        $choice = $config['total_rows']/$config['per_page'];
        $config['num_links'] = 2;		
        $this->pagination->initialize($config);

        $data['data'] = $this->db->query("select * from main_discount
                                        where discount_name LIKE '%$name_sr%'
                                        and parameter_discount LIKE '%$parameter_sr%'
                                        and status LIKE '%$status_sr%'
                                        and minimum_value LIKE '%$minimum_sr%'
                                        order by id desc
                                        limit ".$limit.",".$config['per_page']."")->result();
        $data['halaman'] = $this->pagination->create_links();
        $data['total_data']= $this->db->query("select * from main_discount
                                                where discount_name LIKE '%$name_sr%'
                                                and parameter_discount LIKE '%$parameter_sr%'
                                                and status LIKE '%$status_sr%'
                                                and minimum_value LIKE '%$minimum_sr%'
                                                order by id desc")->num_rows();
        $data['page_sr'] = $page_sr;
        $data['name_sr'] = $name_sr;
        $data['parameter_sr'] = $parameter_sr;
        $data['status_sr'] = $status_sr;
        $data['minimum_sr'] = $minimum_sr;
        $data['page_status']=$this->db->query("select * from salepage_status where id='1'")->row();
        $data['view']='search_discount';
        $this->load->view('template',$data);
    }
    
    function add_main_discount(){
        $data['list_discount'] = $this->db->query("select * from list_discount where status='Y'")->result();
        $data['view']="add_main_discount";
        $this->load->view('template',$data);
    }
    
    function add_proses_main_discount(){
        $discount_name=$this->input->post('discount_name');
        $parameter_discount=$this->input->post('parameter_discount');
        $from_date=$this->input->post('from_date');
        $discount_value_manual=preg_replace('/[^A-Za-z0-9\-]/', '', $this->input->post('discount_value_manual'));
        $percentase_manual=$this->input->post('percentase_manual');
        $kelipatan_manual=$this->input->post('kelipatan_manual');
        $minimum_value=preg_replace('/[^A-Za-z0-9\-]/', '', $this->input->post('minimum_value'));
        
        $get_buy=$this->input->post('get_buy');
        $value_getbuy=preg_replace('/[^A-Za-z0-9\-]/', '', $this->input->post('value_getbuy'));
        $percentase_getbuy=$this->input->post('percentase_getbuy');
        
        if($parameter_discount=="MD"){
            $data_discount=array(
                'discount_name'=>$discount_name,
                'parameter_discount'=>$parameter_discount,
                'minimum_value'=>$minimum_value,
                'status'=>$status,
                'sys_create_date'=>$this->main_model->sys_date()
            );
            $this->db->insert("main_discount",$data_discount);
            $id=mysql_insert_id();
            $data_manual=array(
                'discount_id'=>$id,
                'value_discount_manual'=>$discount_value_manual,
                'percentase'=>$percentase_manual,
                'kelipatan'=>$kelipatan_manual,
                'sys_create_date'=>$this->main_model->sys_date()
            );
            $this->db->insert("discount_manual",$data_manual);
        }else{
             $data_discount=array(
                'discount_name'=>$discount_name,
                'parameter_discount'=>$parameter_discount,
                'minimum_value'=>$minimum_value,
                'status'=>$status,
                'sys_create_date'=>$this->main_model->sys_date()
            );
            $this->db->insert("main_discount",$data_discount);
            $id=mysql_insert_id();
            for($i=0;$i<count($get_buy);$i++){
                $data_getbuy=array(
                    'list_discount_id'=>$get_buy[$i],
                    'discount_id'=>$id,
                    'value_discount_buy_get'=>$value_getbuy[$i],
                    'percentase'=>$percentase_getbuy[$i],
                    'sys_create_date'=>$this->main_model->sys_date()
                );
                $this->db->insert("discount_buy_get",$data_getbuy);
            }
        }
        redirect('discount/index_main_discount');
    }
    
    function update_main_discount($id){
        $data['list_discount'] = $this->db->query("select * from list_discount where status='Y'")->result();
        $cek=$this->main_model->select_where("main_discount","id",$id)->row();
        $data['detail_discount']=$this->main_model->select_where("main_discount","id",$id)->row();
        if($cek->parameter_discount=="MD"){
            $data['value_discount']=$this->main_model->select_where("discount_manual","discount_id",$id)->row();
        }else{
            $data['value_discount']=$this->main_model->select_where("discount_buy_get","discount_id",$id)->result();
        }
        $data['view']="edit_main_discount";
        $this->load->view('template',$data);
    }
    
    function update_proses_main_discount(){
        $id=$this->input->post('id');
        $discount_name=$this->input->post('discount_name');
        $parameter_discount=$this->input->post('parameter_discount');
        $status=$this->input->post('status');
        $discount_value_manual=preg_replace('/[^A-Za-z0-9\-]/', '', $this->input->post('discount_value_manual'));
        $percentase_manual=$this->input->post('percentase_manual');
        $kelipatan_manual=$this->input->post('kelipatan_manual');
        $minimum_value=preg_replace('/[^A-Za-z0-9\-]/', '', $this->input->post('minimum_value'));
        
        $get_buy=$this->input->post('get_buy');
        $value_getbuy=preg_replace('/[^A-Za-z0-9\-]/', '', $this->input->post('value_getbuy'));
        $percentase_getbuy=$this->input->post('percentase_getbuy');
        
        if($parameter_discount=="MD"){
            $data_discount=array(
                'discount_name'=>$discount_name,
                'parameter_discount'=>$parameter_discount,
                'minimum_value'=>$minimum_value,
                'status'=>$status,
                'sys_create_user'=>$this->main_model->sys_user(),
                'sys_create_date'=>$this->main_model->sys_date()
            );
            $this->main_model->update("main_discount","id",$id,$data_discount);
            $this->main_model->delete("discount_buy_get","discount_id",$id);
            $this->main_model->delete("discount_manual","discount_id",$id);
            $data_manual=array(
                'discount_id'=>$id,
                'value_discount_manual'=>$discount_value_manual,
                'percentase'=>$percentase_manual,
                'kelipatan'=>$kelipatan_manual,
                'sys_create_date'=>$this->main_model->sys_date()
            );
            $this->main_model->insert("discount_manual",$data_manual);
        }else{
             $data_discount=array(
                'discount_name'=>$discount_name,
                'parameter_discount'=>$parameter_discount,
                'minimum_value'=>$minimum_value,
                'status'=>$status,
                'sys_create_date'=>$this->main_model->sys_date()
            );
            $this->main_model->update("main_discount","id",$id,$data_discount);
            $this->main_model->delete("discount_buy_get","discount_id",$id);
            $this->main_model->delete("discount_manual","discount_id",$id);
            for($i=0;$i<count($get_buy);$i++){
                $data_getbuy=array(
                    'list_discount_id'=>$get_buy[$i],
                    'discount_id'=>$id,
                    'value_discount_buy_get'=>$value_getbuy[$i],
                    'percentase'=>$percentase_getbuy[$i],
                    'sys_create_date'=>$this->main_model->sys_date()
                );
                $this->db->insert("discount_buy_get",$data_getbuy);
            }
        }
        redirect('discount/index_main_discount');
    }
    
    function delete_main_discount($id,$posisi){
        $this->main_model->delete("discount","main_discount_id",$id);
        $this->main_model->delete("discount_manual","discount_id",$id);
        $this->main_model->delete("discount_buy_get","discount_id",$id);
        $this->main_model->delete("main_discount","id",$id);
        redirect("discount/search_main_discount/".$posisi);
    }
    
    function cek_main_discount(){
        $id=$this->input->post('id');
        $query=$this->db->query("select minimum_value,parameter_discount from main_discount where id='$id'")->row();
        echo $query->minimum_value."|".$query->parameter_discount;
    }
}