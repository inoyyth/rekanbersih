<?php

class m_bannerfix extends CI_Model{
    
    public $bannerfix_id;
    public $bannerfix_title;
    public $bannerfix_title_link;
    public $bannerfix_url;
    public $bannerfix_image;
    public $bannerfix_date_insert;
    public $bannerfix_date_update;
    public $bannerfix_data;
    //
    private $table = 'bannerfix';
    
    public function __construct() {
        parent::__construct();
    }
    
    public function select_one($id = null, $permalink = null) {

        if (empty($id) && empty($permalink)) {
            return;
        }

        $where = Array();
        $where['bannerfix_id'] = $id;

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where($where);
        $query = $this->db->get();
        $result = $query->result_array();

        $this->setValue($result[0]);
        return $result[0];
    }

    public function setValue($data) {
        $REF_CLASS = new ReflectionClass($this);
        if (is_array($data) && !empty($data)) {
            foreach ($data as $key => $value) {
                if ($REF_CLASS->hasProperty($key)) {
                    $this->$key = $value;
                    $this->bannerfix_data[$key] = $value;
                }
            }
        } else if (is_string($data) && !empty($data)) {
            $this->$data = $value;
            $this->bannerfix_data[$data] = $value;
        }
    }

    public function insert() {
        
        if(empty($this->bannerfix_data)) {
            return;
        }
        
        $this->db->insert($this->table, $this->bannerfix_data);
        
    }

    public function update() {
        
        $where = Array(
            'bannerfix_id' => $this->bannerfix_id
        );
        
        $this->db->where($where);
        $this->db->update($this->table, $this->bannerfix_data);
        //exit($this->db->last_query());
    }

    public function delete() {
        if (!empty($this->bannerfix_id)) {
            $this->db->query("DELETE FROM `" . $this->table . "` WHERE bannerfix_id='" . $this->bannerfix_id . "'");
        }
    }

    public function get_bannerfix_data($where = null) {
        
        $this->db->select('*');
        $this->db->from($this->table);

        if (!empty($where)) {
            $this->db->where($where);
        }

        $query = $this->db->get();
        return $query->result();
        
    }

    public function upload_image() {

        $result = Array();
        $image_data = null;

        $config['upload_path'] = "../userfiles/Image/banner/";
        $config['upload_url'] = "../userfiles/Image/banner/";
        $config['allowed_types'] = '*';
        $config['encrypt_name'] = true;

        $this->load->library('upload');
        if(!empty($_FILES['bannerfix_image'])) {
            $this->upload->initialize($config);
            if ($this->upload->do_upload('bannerfix_image')) {
                $image_data = $this->upload->data();
                $result['bannerfix_image'] = $image_data;
            }
        }
        
        return $result;
        
    }
    
}
