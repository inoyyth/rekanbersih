<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Backup_db extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('logged_in_admin') == false) {
            redirect('login');
        }
        $this->load->model('main_model');
    }

    function index() {
        $this->session->unset_userdata('page_sr');
        $this->session->unset_userdata('id_sr');
        $this->session->unset_userdata('name_sr');
        $config['base_url'] = base_url() . 'backup_db/index/';
        $config['total_rows'] = $this->db->query("select * from backup_db order by id desc")->num_rows();
        $config['per_page'] = 10;
        $config['num_links'] = 2;
        $config['uri_segment'] = 3;
        $config['first_page'] = 'Awal';
        $config['last_page'] = 'Akhir';
        $config['next_page'] = '&laquo;';
        $config['prev_page'] = '&raquo;';
        $pg = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        //inisialisasi config
        $this->pagination->initialize($config);
        //buat pagination
        $data['halaman'] = $this->pagination->create_links();
        //tamplikan data
        $data['total_data'] = $this->db->query("select * from backup_db order by id desc")->num_rows();
        $data['data'] = $this->db->query("select * from backup_db order by id desc limit " . $pg . "," . $config['per_page'] . "")->result();
        $data['view'] = 'main';
        $this->load->view('template', $data);
    }

    function backup() {
        $date = date("dmyhis");
        $this->load->dbutil();
       $prefs = array(
            //'tables'      => array('mahasiswa', 'matakuliah'),  
           'ignore'      => array(),           
            'format'      => 'txt',             
           'filename'    => "mybackup_".$date.".sql",    
            'add_drop'    => TRUE,              
            'add_insert'  => TRUE,              
           'newline'     => "\n"               
       );
        // Backup your entire database and assign it to a variable
       $backup = $this->dbutil->backup($prefs);
        // Load the file helper and write the file to your server
        $this->load->helper('file');
        $file_name = "mybackup_" . $date . ".sql";

        $my_file = THEMEPATH . '/backup_db/' . $file_name;
        $handle = fopen($my_file, 'w') or die('Cannot open file:  ' . $my_file); //implicitly creates file
        $data = 'This is the data';
        fwrite($handle, $backup);
        
        //record to database
        $data_record=array('filename'=>$file_name,'date'=>date('Y-m-d H:i:s'));
        $this->db->insert('backup_db',$data_record);

        // Load the download helper and send the file to your desktop
        $this->load->helper('download');
        force_download($file_name, $backup);
        //redirect('backup_db/index');
    }
    
    function delete($id){
        $data=$this->db->query("select * from backup_db where id='$id'")->row();
        $this->load->helper('file');   
        unlink( THEMEPATH . '/backup_db/' . $data->filename);
        $this->db->query("delete from backup_db where id='$id'");
        redirect('backup_db/index');
    }

}
