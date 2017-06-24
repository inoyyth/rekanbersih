<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article extends MX_Controller{
    public function __construct() {
        parent::__construct();
        if($this->session->userdata('logged_in')==false){
            redirect('login');    
        }
        $this->load->model('m_article');
        $this->load->model('main_model');
    }
        
    function index(){
        $this->session->unset_userdata('page_sr');
        $this->session->unset_userdata('id_sr');
        $this->session->unset_userdata('name_sr');
        $this->session->unset_userdata('category_sr');
        $this->session->unset_userdata('status_sr');
        $config['base_url'] = base_url().'article/index/';
        $config['total_rows'] = $this->db->query("select a.*,b.article_category_name from article a left join article_category b on a.id_category=b.id order by a.id desc")->num_rows();
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
        $data['total_data']=$this->db->query("select a.*,b.article_category_name from article a left join article_category b on a.id_category=b.id order by a.id desc")->num_rows();
        $data['data'] = $this->db->query("select a.*,b.article_category_name from article a left join article_category b on a.id_category=b.id order by a.id desc limit ".$pg.",".$config['per_page']."")->result();
        $data['view']='main';
        $this->load->view('template',$data);
    }
    
    public function search()
	{
            if($_POST){
                $page_sr = ($this->input->get_post('page_sr')==""?$this->session->unset_userdata('page_sr'):$this->main_model->handler0('page_sr',$this->input->get_post('page_sr', TRUE)));
                $id_sr = ($this->input->get_post('id_sr')==""?$this->session->unset_userdata('id_sr'):$this->main_model->handler0('id_sr',$this->input->get_post('id_sr', TRUE)));
                $name_sr = ($this->input->get_post('name_sr')==""?$this->session->unset_userdata('name_sr'):$this->main_model->handler0('name_sr',$this->input->get_post('name_sr', TRUE)));
                $status_sr = ($this->input->get_post('status_sr')==""?$this->session->unset_userdata('status_sr'):$this->main_model->handler0('status_sr',$this->input->get_post('status_sr', TRUE)));
                $category_sr = ($this->input->get_post('category_sr')==""?$this->session->unset_userdata('category_sr'):$this->main_model->handler0('category_sr',$this->input->get_post('category_sr', TRUE)));
            }else{
                $page_sr = $this->main_model->handler0('page_sr',$this->input->get_post('page_sr', TRUE));
                $id_sr = $this->main_model->handler0('id_sr',$this->input->get_post('id_sr', TRUE));
                $name_sr = $this->main_model->handler0('name_sr',$this->input->get_post('name_sr', TRUE));
                $status_sr = $this->main_model->handler0('status_sr',$this->input->get_post('status_sr', TRUE));
                $category_sr = $this->main_model->handler0('category_sr',$this->input->get_post('category_sr', TRUE));
            }
            //echo $id_sr,$name_sr,$status_sr;
            $limit = ($this->uri->segment(3) > 0)?$this->uri->segment(3):0;

            $config['base_url'] = base_url() .'article/search';
            $config['total_rows'] = $this->db->query("select a.*,b.article_category_name from article a left join article_category b on a.id_category=b.id where a.id LIKE '%$id_sr%' and a.article_name LIKE '%$name_sr%' and a.status LIKE '%$status_sr%' and b.article_category_name LIKE '%$category_sr%' order by a.id desc")->num_rows();
            $config['per_page'] = ($page_sr > 0)?$page_sr:10;
            $config['uri_segment'] = 3;
            $choice = $config['total_rows']/$config['per_page'];
            $config['num_links'] = 2;		
            $this->pagination->initialize($config);

            $data['data'] = $this->db->query("select a.*,b.article_category_name from article a left join article_category b on a.id_category=b.id where a.id LIKE '%$id_sr%' and a.article_name LIKE '%$name_sr%' and a.status LIKE '%$status_sr%' and b.article_category_name LIKE '%$category_sr%' order by a.id desc limit ".$limit.",".$config['per_page']."")->result();
            $data['halaman'] = $this->pagination->create_links();
            $data['total_data']= $this->db->query("select a.*,b.article_category_name from article a left join article_category b on a.id_category=b.id where a.id LIKE '%$id_sr%' and a.article_name LIKE '%$name_sr%' and a.status LIKE '%$status_sr%' and b.article_category_name LIKE '%$category_sr%' order by a.id desc")->num_rows();
            $data['page_sr'] = $page_sr;
            $data['id_sr'] = $id_sr;
            $data['name_sr'] = $name_sr;
            $data['status_sr'] = $status_sr;
            $data['category_sr'] = $category_sr;
            $data['view']='search';
            $this->load->view('template',$data);
	}
    
    function add(){
        $data['list_category']=$this->db->query("select * from article_category where status='Y'")->result();
        $data['view']='add';
        $this->load->view('template',$data);
    }
    function add_proses(){
        $session_data = $this->session->userdata('logged_in');
        $datetime=date("Y-m-d h:i:s");
        $cat=$this->input->post('category');
        $name=$this->input->post('article');
        $description=$this->input->post('description');
        $status=$this->input->post('status');
        $thumbnail=$this->input->post('thumbnail');
        
        $data=array("id_category"=>$cat,
                    "article_name"=>$name,
                    "article_description"=>$description,
                    "status"=>$status,
                    "sys_create_user"=>$session_data['user_id'],
                    "article_image"=>$thumbnail,
                    "sys_create_date"=>$datetime);
        $this->db->insert("article",$data);
        
        redirect("article/search");
    }
    
    function update($id,$page){
        $data['list_category']=$this->db->query("select * from article_category where status='Y'")->result();
        $data['list_detail']=$this->db->query("select a.*,b.article_category_name from article a left join article_category b on a.id_category=b.id where a.id='$id'")->row();
        $data['posisi']=$page;
        $data['view']='edit';
        $this->load->view('template',$data);
    }
    
    function update_proses(){
        $session_data = $this->session->userdata('logged_in');
        $datetime=date("Y-m-d h:i:s");
        $posisi=$this->input->post("posisi");
        $id=$this->input->post("id");
        $cat=$this->input->post('category');
        $name=$this->input->post('article');
        $description=$this->input->post('description');
        $status=$this->input->post('status');
        $thumbnail=$this->input->post('thumbnail');
        
        $data=array("id_category"=>$cat,"article_name"=>$name,"article_description"=>$description,"status"=>$status,"article_image"=>$thumbnail,"sys_update_user"=>$session_data['user_id'],"sys_update_date"=>$datetime);
        $this->m_article->update("article","id",$id,$data);
        
        redirect("article/search/".$posisi);
    }
    
    function delete($id,$page){
        $this->m_article->delete("article","id",$id);
        redirect("article/search/".$page);
    }
    
    function get_subcategory(){
        $data="";
        $id=$this->input->post('id');
        $val=$this->db->query("select * from article_subcategory where id_category='$id'")->result();
        $data .= "<option value=''>--set sub category--</option>";
        foreach($val as $value){
            $data .="<option value='$value->id'>$value->article_subcategory_name</option>\n";
        }
        echo $data;
    }
    function get_subcategory_update(){
        $data="";
        $id=$this->input->post('cat');
        $sub=$this->input->post('sub');
        $val=$this->db->query("select * from article_subcategory where id_category='$id'")->result();
        $data .= "<option value=''>--set sub category--</option>";
        foreach($val as $value){
            if($value->id==$sub){
                $cek="selected";
            }else{
                $cek="";
            }
            $data .="<option value='$value->id'$cek>$value->article_subcategory_name</option>\n";
        }
        echo $data;
    }
    
    function image_browse(){
        $this->load->view("image_browse");
    }
    
    function upload_foto(){
            $link=$this->input->post('link_text');
            $config['upload_path']	= "assets/elfinder/".$link;
            $config['upload_url']	= "assets/elfinder/".$link;
            $config['allowed_types']= '*';
            $config['max_size']     = '2000';
            $config['max_width']  	= '2000';
            $config['max_height']  	= '2000';
            $config['remove_spaces']  	= true;
            $this->load->library('upload');
	    $this->upload->initialize($config);
            
            if($this->upload->do_upload('image'))
             {
             $image_data1 = $this->upload->data();    
             }
             $this->load->view("image_browse");
    }
    
}