<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends MX_Controller{
    public function __construct() {
        parent::__construct();
        if($this->session->userdata('logged_in_admin')==false){
            redirect('login');    
        }
        $this->load->model('m_menu');
        $this->load->model('main_model');
    }
    
    function article(){
        $this->session->unset_userdata('page_sr');
        $this->session->unset_userdata('name_sr');
        $this->session->unset_userdata('category_sr');
        $this->session->unset_userdata('subcategory_sr');
        $config['base_url'] = base_url().'menu/article/';
        $config['total_rows'] = $this->db->query("select a.*,b.article_category_name,c.article_subcategory_name 
                                                  from article a 
                                                  inner join article_category b on a.id_category=b.id
                                                  inner join article_subcategory c on a.id_subcategory=c.id
                                                  where a.status='Y'
                                                  order by a.id asc")->num_rows();
        $config['per_page'] = 2;
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
        $data['total_data']=$this->db->query("select a.*,b.article_category_name,c.article_subcategory_name 
                                             from article a 
                                             inner join article_category b on a.id_category=b.id
                                             inner join article_subcategory c on a.id_subcategory=c.id
                                             where a.status='Y'
                                             order by a.id asc")->num_rows();
        $data['data'] = $this->db->query("select a.*,b.article_category_name,c.article_subcategory_name 
                                         from article a 
                                         inner join article_category b on a.id_category=b.id
                                         inner join article_subcategory c on a.id_subcategory=c.id
                                         where a.status='Y'
                                         order by a.id asc limit ".$pg.",".$config['per_page']."")->result();
        $data['category']=$this->db->query("select * from article_category where status='Y' order by article_category_name asc")->result();
        $data['subcategory']=$this->db->query("select * from article_subcategory where status='Y' order by article_subcategory_name asc")->result();
        $this->load->view('menuArticle',$data);
    }
    
    function article_search(){
        $page_sr = ($this->input->get_post('page_sr')==""?$this->session->unset_userdata('page_sr'):$this->main_model->handler0('page_sr',$this->input->get_post('page_sr', TRUE)));
        $name_sr = ($this->input->get_post('name_sr')==""?$this->session->unset_userdata('name_sr'):$this->main_model->handler0('name_sr',$this->input->get_post('name_sr', TRUE)));
        $category_sr = ($this->input->get_post('category_sr')==""?$this->session->unset_userdata('category_sr'):$this->main_model->handler0('category_sr',$this->input->get_post('category_sr', TRUE)));
        $subcategory_sr = ($this->input->get_post('subcategory_sr')==""?$this->session->unset_userdata('subcategory_sr'):$this->main_model->handler0('subcategory_sr',$this->input->get_post('subcategory_sr', TRUE)));
       
        $limit = ($this->uri->segment(3) > 0)?$this->uri->segment(3):0;
        $config['base_url'] = base_url() .'menu/article_search';
        $config['total_rows'] = $this->db->query("select a.*,b.article_category_name,c.article_subcategory_name
                                                  from article a
                                                  inner join article_category b on a.id_category=b.id 
                                                  inner join article_subcategory c on a.id_subcategory=c.id
                                                  where a.status='Y' 
                                                  and a.id_category like '%$category_sr%'
                                                  and a.article_name like '%$name_sr%'
                                                  and a. id_subcategory like '%$subcategory_sr%'
                                                  order by a.id asc")->num_rows();
        $config['per_page'] = ($page_sr > 0)?$page_sr:2;
        $config['uri_segment'] = 3;
        $choice = $config['total_rows']/$config['per_page'];
        $config['num_links'] = 2;		
        $this->pagination->initialize($config);

        $data['data'] = $this->db->query("select a.*,b.article_category_name,c.article_subcategory_name
                                        from article a
                                        inner join article_category b on a.id_category=b.id 
                                        inner join article_subcategory c on a.id_subcategory=c.id
                                        where a.status='Y' 
                                        and a.id_category like '%$category_sr%'
                                        and a.article_name like '%$name_sr%'
                                        and a. id_subcategory like '%$subcategory_sr%'
                                        order by a.id asc
                                        limit ".$limit.",".$config['per_page']."")->result();
        $data['halaman'] = $this->pagination->create_links();
        $data['total_data']= $this->db->query("select a.*,b.article_category_name,c.article_subcategory_name
                                              from article a
                                              inner join article_category b on a.id_category=b.id 
                                              inner join article_subcategory c on a.id_subcategory=c.id
                                              where a.status='Y' 
                                              and a.id_category like '%$category_sr%'
                                              and a.article_name like '%$name_sr%'
                                              and a. id_subcategory like '%$subcategory_sr%'
                                              order by a.id asc")->num_rows();
        $data['page_sr'] = $page_sr;
        $data['name_sr'] = $name_sr;
        $data['category_sr'] = $category_sr;
        $data['subcategory_sr'] = $subcategory_sr;
        $data['category']=$this->db->query("select * from article_category where status='Y' order by article_category_name asc")->result();
        $data['subcategory']=$this->db->query("select * from article_subcategory where status='Y' order by article_subcategory_name asc")->result();
        $this->load->view('menuArticleSearch',$data);
    }
    
    function category_article(){
        $this->session->unset_userdata('page_sr');
        $this->session->unset_userdata('name_sr');
        $config['base_url'] = base_url().'menu/category_article/';
        $config['total_rows'] = $this->db->query("select * from article_category where status='Y' order by id asc")->num_rows();
        $config['per_page'] = 2;
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
        $data['total_data']=$this->db->query("select * from article_category where status='Y' order by id asc")->num_rows();
        $data['data'] = $this->db->query("select *  from article_category where status='Y' order by id asc limit ".$pg.",".$config['per_page']."")->result();
        $this->load->view('categoryArticle',$data);
    }
    
    function category_article_search(){
        $page_sr = ($this->input->get_post('page_sr')==""?$this->session->unset_userdata('page_sr'):$this->main_model->handler0('page_sr',$this->input->get_post('page_sr', TRUE)));
        $name_sr = ($this->input->get_post('name_sr')==""?$this->session->unset_userdata('name_sr'):$this->main_model->handler0('name_sr',$this->input->get_post('name_sr', TRUE)));
       
        $limit = ($this->uri->segment(3) > 0)?$this->uri->segment(3):0;
        $config['base_url'] = base_url() .'menu/category_article_search';
        $config['total_rows'] = $this->db->query("select * from article_category where status='Y' and article_category_name like '%$name_sr%' order by id asc")->num_rows();
        $config['per_page'] = ($page_sr > 0)?$page_sr:2;
        $config['uri_segment'] = 3;
        $choice = $config['total_rows']/$config['per_page'];
        $config['num_links'] = 2;		
        $this->pagination->initialize($config);

        $data['data'] = $this->db->query("select * from article_category where status='Y' and article_category_name like '%$name_sr%' order by id asc limit ".$limit.",".$config['per_page']."")->result();
        $data['halaman'] = $this->pagination->create_links();
        $data['total_data']= $this->db->query("select * from article_category where status='Y' and article_category_name like '%$name_sr%' order by id asc")->num_rows();
        $data['page_sr'] = $page_sr;
        $data['name_sr'] = $name_sr;
        $this->load->view('categoryArticleSearch',$data);
    }
    
    function subcategory_article(){
        $this->session->unset_userdata('page_sr');
        $this->session->unset_userdata('name_sr');
        $config['base_url'] = base_url().'menu/subcategory_article/';
        $config['total_rows'] = $this->db->query("select a.*,b.article_category_name from article_subcategory a left join article_category b on a.id_category=b.id where a.status='Y' order by a.id asc")->num_rows();
        $config['per_page'] = 2;
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
        $data['total_data']=$this->db->query("select a.*,b.article_category_name from article_subcategory a left join article_category b on a.id_category=b.id where a.status='Y' order by a.id asc")->num_rows();
        $data['data'] = $this->db->query("select a.*,b.article_category_name from article_subcategory a left join article_category b on a.id_category=b.id where a.status='Y' order by a.id asc limit ".$pg.",".$config['per_page']."")->result();
        $data['category']=$this->db->query("select * from article_category where status='Y' order by article_category_name asc")->result();
        $this->load->view('subcategoryArticle',$data);
    }
    
    function subcategory_article_search(){
        $page_sr = ($this->input->get_post('page_sr')==""?$this->session->unset_userdata('page_sr'):$this->main_model->handler0('page_sr',$this->input->get_post('page_sr', TRUE)));
        $name_sr = ($this->input->get_post('name_sr')==""?$this->session->unset_userdata('name_sr'):$this->main_model->handler0('name_sr',$this->input->get_post('name_sr', TRUE)));
        $category_sr = ($this->input->get_post('category_sr')==""?$this->session->unset_userdata('category_sr'):$this->main_model->handler0('category_sr',$this->input->get_post('category_sr', TRUE)));
       
        $limit = ($this->uri->segment(3) > 0)?$this->uri->segment(3):0;
        $config['base_url'] = base_url() .'menu/subcategory_article_search';
        $config['total_rows'] = $this->db->query("select a.*,b.article_category_name from article_subcategory a left join article_category b on a.id_category=b.id where a.status='Y' and a.id_category LIKE '%$category_sr%' and a.article_subcategory_name LIKE '%$name_sr%' order by a.id asc")->num_rows();
        $config['per_page'] = ($page_sr > 0)?$page_sr:2;
        $config['uri_segment'] = 3;
        $choice = $config['total_rows']/$config['per_page'];
        $config['num_links'] = 2;		
        $this->pagination->initialize($config);

        $data['data'] = $this->db->query("select a.*,b.article_category_name from article_subcategory a left join article_category b on a.id_category=b.id where a.status='Y' and a.id_category LIKE '%$category_sr%' and a.article_subcategory_name LIKE '%$name_sr%' order by a.id asc limit ".$limit.",".$config['per_page']."")->result();
        $data['halaman'] = $this->pagination->create_links();
        $data['total_data']= $this->db->query("select a.*,b.article_category_name from article_subcategory a left join article_category b on a.id_category=b.id where a.status='Y' and a.id_category LIKE '%$category_sr%' and a.article_subcategory_name LIKE '%$name_sr%' order by a.id asc")->num_rows();
        $data['page_sr'] = $page_sr;
        $data['name_sr'] = $name_sr;
        $data['category_sr'] = $category_sr;
        $data['category']=$this->db->query("select * from article_category where status='Y' order by article_category_name asc")->result();
        $this->load->view('subcategoryArticleSearch',$data);
    }
    
    function category_commerce(){
        $this->session->unset_userdata('page_sr');
        $this->session->unset_userdata('name_sr');
        $config['base_url'] = base_url().'menu/category_commerce/';
        $config['total_rows'] = $this->db->query("select * from product_category where product_category_status='Y' order by id asc")->num_rows();
        $config['per_page'] = 2;
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
        $data['total_data']=$this->db->query("select * from product_category where product_category_status='Y' order by id asc")->num_rows();
        $data['data'] = $this->db->query("select * from product_category where product_category_status='Y' order by id asc limit ".$pg.",".$config['per_page']."")->result();
        $this->load->view('categoryCommerce',$data);
    }
    
    function category_commerce_search(){
        $page_sr = $this->main_model->handler0("page_sr",$this->input->get_post('page_sr', TRUE));
        $name_sr = $this->main_model->handler0("name_sr",$this->input->get_post('name_sr', TRUE));
       
        $limit = ($this->uri->segment(3) > 0)?$this->uri->segment(3):0;
        $config['base_url'] = base_url() .'menu/category_commerce_search';
        $config['total_rows'] = $this->db->query("select * from product_category where product_category_status='Y' and product_category_name like '%$name_sr%' order by id asc")->num_rows();
        $config['per_page'] = ($page_sr > 0)?$page_sr:2;
        $config['uri_segment'] = 3;
        $choice = $config['total_rows']/$config['per_page'];
        $config['num_links'] = 2;		
        $this->pagination->initialize($config);

        $data['data'] = $this->db->query("select * from product_category where product_category_status='Y' and product_category_name like '%$name_sr%' order by id asc limit ".$limit.",".$config['per_page']."")->result();
        $data['halaman'] = $this->pagination->create_links();
        $data['total_data']= $this->db->query("select * from product_category where product_category_status='Y' and product_category_name like '%$name_sr%' order by id asc")->num_rows();
        $data['page_sr'] = $page_sr;
        $data['name_sr'] = $name_sr;
        $this->load->view('categoryCommerceSearch',$data);
    }
    
    function brand_commerce(){
        $this->session->unset_userdata('page_sr');
        $this->session->unset_userdata('name_sr');
        $config['base_url'] = base_url().'menu/brand_commerce/';
        $config['total_rows'] = $this->db->query("select * from brand where status='Y' order by id asc")->num_rows();
        $config['per_page'] = 2;
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
        $data['total_data']=$this->db->query("select * from brand where status='Y' order by id asc")->num_rows();
        $data['data'] = $this->db->query("select * from brand where status='Y' order by id asc limit ".$pg.",".$config['per_page']."")->result();
        $this->load->view('brandCommerce',$data);
    }
    
    function brand_commerce_search(){
        $page_sr = $this->main_model->handler0("page_sr",$this->input->get_post('page_sr', TRUE));
        $name_sr = $this->main_model->handler0("name_sr",$this->input->get_post('name_sr', TRUE));
       
        $limit = ($this->uri->segment(3) > 0)?$this->uri->segment(3):0;
        $config['base_url'] = base_url() .'menu/brand_commerce_search';
        $config['total_rows'] = $this->db->query("select * from brand where status='Y' and brand_name like '%$name_sr%' order by id asc")->num_rows();
        $config['per_page'] = ($page_sr > 0)?$page_sr:2;
        $config['uri_segment'] = 3;
        $choice = $config['total_rows']/$config['per_page'];
        $config['num_links'] = 2;		
        $this->pagination->initialize($config);

        $data['data'] = $this->db->query("select * from brand where status='Y' and brand_name like '%$name_sr%' order by id asc limit ".$limit.",".$config['per_page']."")->result();
        $data['halaman'] = $this->pagination->create_links();
        $data['total_data']= $this->db->query("select * from brand where status='Y' and brand_name like '%$name_sr%' order by id asc")->num_rows();
        $data['page_sr'] = $page_sr;
        $data['name_sr'] = $name_sr;
        $this->load->view('brandCommerceSearch',$data);
    }
    
    function index(){
        $data['data']=$this->db->query("select a.*,b.menu_type as menu_typex from menu a left join menu_type b on a.menu_type=b.id where a.menu_index='0' order by a.menu_position asc")->result();
        $data['max']=$this->db->query("select max(menu_position) as max_pos from menu where menu_index='0'")->row();
        $data['min']=$this->db->query("select min(menu_position) as min_pos from menu where menu_index='0'")->row();
        $data['view']='main';
        $this->load->view('template',$data);
    }
    
    function add(){
        $data['menu_type']=$this->db->query("select * from menu_type order by sort asc")->result();
        $data['menu']=$this->db->query("select * from menu where menu_parent_id='0' order by id")->result();
        $data['view']='add';
        $this->load->view('template',$data);
    }
    
    function add_proses(){
        if(!$_POST){
            show_404();
        }else{
        $menu_name=$this->input->post('menu_name');
        $menu_parent=$this->input->post('menu_parent');
        $menu_type=$this->input->post('menu_type');
        $menu_value=$this->input->post('kodex');
        $menu_open=$this->input->post('menu_open');
        $menu_level=$this->input->post('menu_level');
        $status=$this->input->post('status');
        $menu_index=  substr($menu_parent, 0,1);
        $menu_parentx=  substr($menu_parent, 2,3);
        $position="";
        if($menu_parent=="0"){
            $pos=$this->db->query("select max(menu_position) as maxid from menu where menu_parent_id='0'")->row('maxid');
            $position=$pos + 1;
        }else{
            $pos=$this->db->query("select max(menu_position) as maxid from menu where menu_parent_id='$menu_parentx'")->row('maxid');
            $position=$pos + 1;
        }
        $menu_desc="";
        if(isset($_POST['menu_value'])){
            $menu_desc=$this->input->post('menu_value');
        }else{
            $menu_desc="";
        }
        
        $data=array(
            'menu_parent_id'=>$menu_parentx,
            'menu_name'=>$menu_name,
            'menu_type'=>$menu_type,
            'menu_link'=>$menu_value,
            'menu_open'=>$menu_open,
            'menu_description'=>$menu_desc,
            'menu_status'=>$status,
            'menu_position'=>$position,
            'menu_level'=>$menu_level,
            'menu_index'=>$menu_index
        );
        $this->db->insert("menu",$data);
        redirect("menu/index");
        }
    }
    
    function update($id){
        $data['list']=$this->db->query("select * from menu where id='$id'")->row();
        $mlist=$this->db->query("select * from menu where id='$id'")->row();
        $data['menu_type']=$this->db->query("select * from menu_type order by sort asc")->result();
        $data['menu']=$this->db->query("select * from menu where menu_parent_id='0' and menu_index='0' and id not in ($mlist->id) order by id")->result();
        $data['view']='edit';
        $this->load->view('template',$data);
    }
    
    function update_proses(){
        if(!$_POST){
            show_404();
        }else{
        $id=$this->input->post('id');
        $menu_name=$this->input->post('menu_name');
        $menu_parent=$this->input->post('menu_parent');
        $menu_type=$this->input->post('menu_type');
        $menu_value=$this->input->post('kodex');
        $menu_open=$this->input->post('menu_open');
        $status=$this->input->post('status');
        $menu_level=$this->input->post('menu_level');
        $menu_index=  substr($menu_parent, 0,1);
        $menu_parentx=  substr($menu_parent, 2,3);
        $position="";
            $cek_menuparent=$this->db->query("select * from menu where id='$id'")->row();
            if($menu_parentx==$cek_menuparent->menu_parent_id){
                $position=$cek_menuparent->menu_position;
            }else{
                $ps=$this->db->query("select max(menu_position) as maxpos from menu where menu_parent_id='$menu_parentx'")->row();
                $position=$ps->maxpos+1;
            }
        $menu_desc="";
        if(isset($_POST['menu_value'])){
            $menu_desc=$this->input->post('menu_value');
        }else{
            $menu_desc="";
        }
        
        $data=array(
            'menu_parent_id'=>$menu_parentx,
            'menu_name'=>$menu_name,
            'menu_type'=>$menu_type,
            'menu_link'=>$menu_value,
            'menu_open'=>$menu_open,
            'menu_description'=>$menu_desc,
            'menu_status'=>$status,
            'menu_position'=>$position,
            'menu_level'=>$menu_level,
            'menu_index'=>$menu_index
        );
        $this->db->where("id",$id);
        $this->db->update("menu",$data);
        redirect("menu/index");
        }    
    }
    
    function naik($menuid,$menuparent,$menuposition){
        $posup=$this->db->query("select id,menu_position from menu where menu_parent_id='$menuparent' and menu_position < '$menuposition' ORDER BY menu_position desc limit 1")->row();
        $this->db->query("update menu set menu_position ='$menuposition' where id='$posup->id'");
        $this->db->query("update menu set menu_position ='$posup->menu_position' where id='$menuid'");
        redirect("menu/index");
        //echo "id".$posup->id ."- posisi".$posup->menu_position;
    }
    
    function turun($menuid,$menuparent,$menuposition){
        $posup=$this->db->query("select id,menu_position from menu where menu_parent_id='$menuparent' and menu_position > '$menuposition' ORDER BY menu_position asc limit 1")->row();
        $this->db->query("update menu set menu_position ='$menuposition' where id='$posup->id'");
        $this->db->query("update menu set menu_position ='$posup->menu_position' where id='$menuid'");
        redirect("menu/index");
        //echo "id".$posup->id ."- posisi".$posup->menu_position;
    }
    
    function cek_delete(){
        $id=$this->input->post('id');
        $cek=$this->db->query("select id from menu where menu_parent_id = '$id'")->num_rows();
        if($cek > 0){
            echo "1";
        }else{
            echo "0";
        }
    }
    
    function delete($id){
        $this->db->query("delete from menu where menu_parent_id = '$id'");
        $this->db->query("delete from menu where id='$id'");
        redirect("menu/index");
    }
    
}