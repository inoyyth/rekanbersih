<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mediafeature extends MX_Controller{
    public function __construct() {
        parent::__construct();
//        if($this->session->userdata('logged_in')==false){
//            redirect('login');    
//        }
        $this->load->model('m_mediafeature');
    }
        
    function index(){
        $this->session->unset_userdata('page_sr');
        $this->session->unset_userdata('id_sr');
        $this->session->unset_userdata('name_sr');
        $this->session->unset_userdata('status_sr');
        $this->session->unset_userdata('weblink_sr');
        $this->session->unset_userdata('category_sr');
        $config['base_url'] = base_url().'mediafeature/index/';
        $config['total_rows'] = $this->db->query("select a.*,b.category_name from mediafeature a left join mediafeature_category b on a.media_category=b.id")->num_rows();
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
        $data['total_data']=$this->db->query("select a.*,b.category_name from mediafeature a left join mediafeature_category b on a.media_category=b.id")->num_rows();
        $data['data'] = $this->db->query("select a.*,b.category_name from mediafeature a left join mediafeature_category b on a.media_category=b.id order by id desc limit ".$pg.",".$config['per_page']."")->result();
        $data['view']='main';
        $this->load->view('template',$data);
    }
    
    public function search()
	{
            $page_sr = $this->m_mediafeature->handler0($this->input->get_post('page_sr', TRUE));
            $id_sr = $this->m_mediafeature->handler1($this->input->get_post('id_sr', TRUE));
            $name_sr = $this->m_mediafeature->handler2($this->input->get_post('name_sr', TRUE));
            $status_sr = $this->m_mediafeature->handler3($this->input->get_post('status_sr', TRUE));
            $weblink_sr = $this->m_mediafeature->handler4($this->input->get_post('weblink_sr', TRUE));
            $category_sr = $this->m_mediafeature->handler5($this->input->get_post('category_sr', TRUE));
            //echo $id_sr,$name_sr,$status_sr;
            $limit = ($this->uri->segment(3) > 0)?$this->uri->segment(3):0;

            $config['base_url'] = base_url() .'mediafeature/search';
            $config['total_rows'] = $this->db->query("select a.*,b.category_name from mediafeature a left join mediafeature_category b on a.media_category=b.id where a.id LIKE '%$id_sr%' and a.media_title LIKE '%$name_sr%' and a.status LIKE '%$status_sr%' and a.media_weblink LIKE '%$weblink_sr%' and b.category_name like '%$category_sr%'")->num_rows();
            $config['per_page'] = ($page_sr > 0)?$page_sr:10;
            $config['uri_segment'] = 3;
            $choice = $config['total_rows']/$config['per_page'];
            $config['num_links'] = 2;		
            $this->pagination->initialize($config);

            $data['data'] = $this->db->query("select a.*,b.category_name from mediafeature a left join mediafeature_category b on a.media_category=b.id where a.id LIKE '%$id_sr%' and a.media_title LIKE '%$name_sr%' and a.status LIKE '%$status_sr%' and a.media_weblink LIKE '%$weblink_sr%' and b.category_name like '%$category_sr%' order by a.id desc limit ".$limit.",".$config['per_page']."")->result();
            $data['halaman'] = $this->pagination->create_links();
            $data['total_data']= $this->db->query("select a.*,b.category_name from mediafeature a left join mediafeature_category b on a.media_category=b.id where a.id LIKE '%$id_sr%' and a.media_title LIKE '%$name_sr%' and a.status LIKE '%$status_sr%' and a.media_weblink LIKE '%$weblink_sr%' and b.category_name like '%$category_sr%'")->num_rows();
            $data['page_sr'] = $page_sr;
            $data['id_sr'] = $id_sr;
            $data['name_sr'] = $name_sr;
            $data['status_sr'] = $status_sr;
            $data['weblink_sr'] = $weblink_sr;
            $data['category_sr'] = $category_sr;
            $data['view']='search';
            $this->load->view('template',$data);
	}
    
    function add(){
        $data['list_attributes'] = $this->db->query("select * from attributes where status='Y'")->result();
        $data['category']=$this->db->query("select * from mediafeature_category where status='Y'")->result();
        $data['view']='add';
        $this->load->view('template',$data);
    }
    function add_proses(){
        $session_data = $this->session->userdata('logged_in');
        $datetime=gmdate("Y-m-d H:i:s", time()+60*60*7);
        $title=$this->input->post('title');
        $category=$this->input->post('category');
        $media_url=$this->input->post('media_url');
        $image=$this->input->post('image');
        $media_weblink=$this->input->post('media_weblink');
        $media_description=$this->input->post('media_description');
        $status=$this->input->post('status');
        $image_lib=$this->input->post('userfile');
        $date=$this->input->post('date');
         //upload File
        $config['upload_path']	= "../userfiles/Image/media_feature/";
        $config['upload_url']	= "../userfiles/Image/media_feature/";
        $config['allowed_types']= '*';
        $config['max_size']     = '2000';
        $config['max_width']  	= '2000';
        $config['max_height']  	= '2000';
        $config['remove_spaces'] = true;
        $this->load->library('upload');
        $this->upload->initialize($config);

        if($this->upload->do_upload('image'))
         {
        $image_data1 = $this->upload->data();    
         }
        
        $data=array("media_title"=>$title,
                    "media_category"=>$category,
                    "media_url"=>$media_url,
                    "media_description"=>$media_description,
                    "media_weblink"=>$media_weblink,
                    "status"=>$status,
                    "date"=>  $date,
                    "media_image"=>$image_data1['file_name'],
                    "sys_create_user"=>$session_data['user_id'],
                    "sys_create_date"=>$datetime);
        $this->db->insert("mediafeature",$data);
        
        $idx=  mysql_insert_id();
        
            $this->load->library('upload');

            $files = $_FILES;
            $cpt = count($_FILES['userfile']['name']);
            for($i=0; $i<$cpt; $i++)
        {

            $_FILES['userfile']['name']= str_replace(" ","-",$files['userfile']['name'])[$i];
            $_FILES['userfile']['type']= $files['userfile']['type'][$i];
            $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
            $_FILES['userfile']['error']= $files['userfile']['error'][$i];
            $_FILES['userfile']['size']= $files['userfile']['size'][$i];    



        $this->upload->initialize($this->set_upload_options());
        $this->upload->do_upload();
        $dataimg=array('mediafeature_id'=>$idx,'mediafeatureimage_image'=>$_FILES['userfile']['name']);
        $this->db->insert('mediafeature_image',$dataimg);
        }
        
        redirect("mediafeature/search");
    }
    
    function update($id,$page){
        $data['list_detail']=$this->m_mediafeature->select_where("mediafeature","id",$id)->row();
        $data['category']=$this->db->query("select * from mediafeature_category where status='Y'")->result();
        $data['image_lib']=$this->db->query("select * from mediafeature_image where mediafeature_id='$id'")->result();
         $data['posisi']=$page;
        $data['view']='edit';
        $this->load->view('template',$data);
    }
    
    function update_proses(){
        $session_data = $this->session->userdata('logged_in');
        $datetime=gmdate("Y-m-d H:i:s", time()+60*60*7);
        $posisi=$this->input->post("posisi");
        $id=$this->input->post("id");
        $title=$this->input->post('title');
        $category=$this->input->post('category');
        $media_url=$this->input->post('media_url');
        $image=$this->input->post('image');
        $media_weblink=$this->input->post('media_weblink');
        $media_description=$this->input->post('media_description');
        $status=$this->input->post('status');
        $image_hidden=$this->input->post('image_hidden');
        $date=$this->input->post('date');
        
        //upload File
        $config['upload_path']	= "../userfiles/Image/media_feature/";
        $config['upload_url']	= "../userfiles/Image/media_feature/";
        $config['allowed_types']= '*';
        $config['max_size']     = '2000';
        $config['max_width']  	= '2000';
        $config['max_height']  	= '2000';
        $config['remove_spaces'] = true;
        $this->load->library('upload');
        $this->upload->initialize($config);

        if($this->upload->do_upload('image'))
         {
            $image_data1 = $this->upload->data();  
            $img1=$image_data1['file_name'];
         }else{
            $img1=$image_hidden;
         }
        
        $data=array("media_title"=>$title,
                    "media_category"=>$category,
                    "media_url"=>$media_url,
                    "media_description"=>$media_description,
                    "media_weblink"=>$media_weblink,
                    "status"=>$status,
                    "date"=>  $date,
                    "media_image"=>$img1,
                    "sys_update_user"=>$session_data['user_id'],
                    "sys_update_date"=>$datetime);
        
        $this->m_mediafeature->update("mediafeature","id",$id,$data);
        
        $this->load->library('upload');
        if(isset($_FILES['userfile'])){
        $this->db->query("delete from mediafeature_image where id='$id'");
        $files = $_FILES;
        $cpt = count($_FILES['userfile']['name']);
        for($i=0; $i<$cpt; $i++)
        {

            $_FILES['userfile']['name']= $files['userfile']['name'][$i];
            $_FILES['userfile']['type']= $files['userfile']['type'][$i];
            $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
            $_FILES['userfile']['error']= $files['userfile']['error'][$i];
            $_FILES['userfile']['size']= $files['userfile']['size'][$i];    



        $this->upload->initialize($this->set_upload_options());
        $this->upload->do_upload();
        $dataimg=array('mediafeature_id'=>$id,'mediafeatureimage_image'=>$_FILES['userfile']['name']);
        $this->db->insert('mediafeature_image',$dataimg);
        }
        }else{
            
        }
        redirect("mediafeature/search/".$posisi);
    }
    
    function delete($id,$page){
        $this->m_mediafeature->delete("mediafeature","id",$id);
        redirect("mediafeature/search/".$page);
    }
    
    function category(){
        $this->session->unset_userdata('page_sr');
        $this->session->unset_userdata('id_sr');
        $this->session->unset_userdata('name_sr');
        $this->session->unset_userdata('status_sr');
        $config['base_url'] = base_url().'mediafeature/category/';
        $config['total_rows'] = $this->db->query("select * from mediafeature_category")->num_rows();
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
        $data['total_data']=$this->db->query("select * from mediafeature_category")->num_rows();
        $data['data'] = $this->db->query("select * from mediafeature_category order by id desc limit ".$pg.",".$config['per_page']."")->result();
        $data['view']='category_main';
        $this->load->view('template',$data);
    }
    
    function category_search(){
        $page_sr = $this->m_mediafeature->handlerx("page_sr",$this->input->get_post('page_sr', TRUE));
        $id_sr = $this->m_mediafeature->handlerx("id_sr",$this->input->get_post('id_sr', TRUE));
        $name_sr = $this->m_mediafeature->handlerx("name_sr",$this->input->get_post('name_sr', TRUE));
        $status_sr = $this->m_mediafeature->handlerx("status_sr",$this->input->get_post('status_sr', TRUE));
        //echo $id_sr,$name_sr,$status_sr;
        $limit = ($this->uri->segment(3) > 0)?$this->uri->segment(3):0;

        $config['base_url'] = base_url() .'mediafeature/category_search';
        $config['total_rows'] = $this->db->query("select * from mediafeature_category where id like '%$id_sr%' and category_name LIKE '%$name_sr%' and status='$status_sr'")->num_rows();
        $config['per_page'] = ($page_sr > 0)?$page_sr:10;
        $config['uri_segment'] = 3;
        $choice = $config['total_rows']/$config['per_page'];
        $config['num_links'] = 2;		
        $this->pagination->initialize($config);

        $data['data'] = $this->db->query("select * from mediafeature_category where id like '%$id_sr%' and category_name LIKE '%$name_sr%' and status like '%$status_sr%' order by id desc limit ".$limit.",".$config['per_page']."")->result();
        $data['halaman'] = $this->pagination->create_links();
        $data['total_data']= $this->db->query("select * from mediafeature_category where id like '%$id_sr%' and category_name LIKE '%$name_sr%' and status='$status_sr'")->num_rows();
        $data['page_sr'] = $page_sr;
        $data['id_sr'] = $id_sr;
        $data['name_sr'] = $name_sr;
        $data['status_sr'] = $status_sr;
        $data['view']='category_search';
        $this->load->view('template',$data);
    }
    
    function category_add(){
        $data['view']='category_add';
        $this->load->view('template',$data);
    }
    
    function category_add_proses(){
        $session_data = $this->session->userdata('logged_in');
        $datetime=gmdate("Y-m-d H:i:s", time()+60*60*7);
        $category_name=$this->input->post('category_name');
        $status=$this->input->post('status');
        
        $data=array('category_name'=>$category_name,'status'=>$status,'sys_create_user'=>$session_data['user_id'],'sys_create_date'=>$datetime);
        $this->db->insert('mediafeature_category',$data);
        redirect("mediafeature/category_search/");
    }
    
    function category_update($id,$page){
        $data['list']=$this->db->query("select * from mediafeature_category where id='$id'")->row();
        $data['view']='category_edit';
        $data['posisi']=$page;
        $this->load->view('template',$data);
    }
    
    function category_update_proses(){
        $session_data = $this->session->userdata('logged_in');
        $datetime=gmdate("Y-m-d H:i:s", time()+60*60*7);
        $id=$this->input->post('id');
        $posisi=$this->input->post('posisi');
        $category_name=$this->input->post('category_name');
        $status=$this->input->post('status');
        $data=array('category_name'=>$category_name,'status'=>$status,'sys_update_user'=>$session_data['user_id'],'sys_update_date'=>$datetime);
        $this->db->update('mediafeature_category',$data,array('id' => $id));
        redirect("mediafeature/category_search/".$posisi);
    }
    
    function category_delete($id,$page){
        $this->db->delete("mediafeature_category",array('id'=>$id));
        redirect("mediafeature/category_search/".$page);
    }
    private function set_upload_options()
    {   
    //  upload an image options
        $config = array();
        $config['upload_path']	= "../userfiles/Image/media_feature/";
        $config['upload_url']	= "../userfiles/Image/media_feature/";
        $config['allowed_types']= '*';
        $config['max_size']     = '2000';
        $config['max_width']  	= '2000';
        $config['max_height']  	= '2000';
        $config['overwrite']     = FALSE;


        return $config;
    }
    
    function delete_image(){
        $id=$this->input->post('id');
        $img=$this->db->query("select * from mediafeature_image where id='$id'")->row();
        unlink('../userfiles/Image/media_feature/'.$img->mediafeatureimage_image);
        $this->db->query("delete from mediafeature_image where id='$id'");
        return true;
    }
    
}