<?php

class M_article2 extends CI_Model {

    public $article_id;
    public $article_permalink;
    public $article_template;
    public $article_product_showcase;
    
    public $article_parent_id;
    public $article_section;
    
    public $category_id;
    public $category_sub_id;
    public $article_title;
    public $article_image_1;
    public $article_image_2;
    public $article_description;
    public $article_is_active;
    public $article_date_insert;
    public $article_date_update;
    public $article_data;
    //
    private $table = 'article2';

    public function __construct() {
        parent::__construct();
    }

    public function select_one($id = null, $permalink = null) {

        if (empty($id) && empty($permalink)) {
            return;
        }

        $where = Array();
        if (!empty($id)) {
            $where['article_id'] = $id;
        } else {
            $where['article_permalink'] = $permalink;
        }

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
                    $this->article_data[$key] = $value;
                }
            }
        } else if (is_string($data) && !empty($data)) {
            $this->$data = $value;
            $this->article_data[$data] = $value;
        }
    }

    public function insert() {
        
        if(empty($this->article_data)) {
            return;
        }
        
        $this->db->insert($this->table, $this->article_data);
        
    }

    public function update() {
        
        $where = Array(
            'article_id' => $this->article_id
        );
        
        $this->db->where($where);
        $this->db->update($this->table, $this->article_data);
        //exit($this->db->last_query());
    }

    public function delete() {
        if (!empty($this->article_id)) {
            $this->db->query("DELETE FROM `" . $this->table . "` WHERE article_id='" . $this->article_id . "'");
        }
    }

    public function get_article_data($where = null) {
        
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

        $config['upload_path'] = "../userfiles/Image/article/";
        $config['upload_url'] = '../userfiles/Image/article/';
        $config['allowed_types'] = '*';
        $config['encrypt_name'] = true;

        $this->load->library('upload');
        
        
        if(!empty($_FILES['image_1'])) {
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image_1')) {
                $image_data = $this->upload->data();
                $result['image_1'] = $image_data;
            }
        }
        
        if(!empty($_FILES['image_2'])) {
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image_2')) {
                $image_data = $this->upload->data();
                $result['image_2'] = $image_data;
            }
        }
        
        return $result;
        
    }
    
    
    public function get_sub_article($parent_id = 0, $with_index = false) {
        
        if(empty($parent_id)) {
            return;
        }
        
        if(!$with_index) {
            $this->db->where(Array(
                'article_parent_id' => $parent_id
            ));
        } else {
            $this->db->where(Array(
                'article_parent_id' => $parent_id
            ))->where("article_id='".$parent_id."'");
        }
        
        $query = $this->db->get($this->table);
        $result = $query->result_array();
        
        return $result;
        
    }
    
    public function handler0($searchterm) {
        if ($searchterm) {
            $this->session->set_userdata('page_sr', $searchterm);
            return $searchterm;
        } elseif ($this->session->userdata('page_sr')) {
            $searchterm = $this->session->userdata('page_sr');
            return $searchterm;
        } else {
            $searchterm = "";
            return $searchterm;
        }
    }

    public function handler1($searchterm) {
        if ($searchterm) {
            $this->session->set_userdata('id_sr', $searchterm);
            return $searchterm;
        } elseif ($this->session->userdata('id_sr')) {
            $searchterm = $this->session->userdata('id_sr');
            return $searchterm;
        } else {
            $searchterm = "";
            return $searchterm;
        }
    }

    public function handler2($searchterm) {
        if ($searchterm) {
            $this->session->set_userdata('name_sr', $searchterm);
            return $searchterm;
        } elseif ($this->session->userdata('name_sr')) {
            $searchterm = $this->session->userdata('name_sr');
            return $searchterm;
        } else {
            $searchterm = "";
            return $searchterm;
        }
    }

    public function handler3($searchterm) {
        if ($searchterm) {
            $this->session->set_userdata('status_sr', $searchterm);
            return $searchterm;
        } elseif ($this->session->userdata('status_sr')) {
            $searchterm = $this->session->userdata('status_sr');
            return $searchterm;
        } else {
            $searchterm = "";
            return $searchterm;
        }
    }

    public function handler4($searchterm) {
        if ($searchterm) {
            $this->session->set_userdata('subcategoryname_sr', $searchterm);
            return $searchterm;
        } elseif ($this->session->userdata('subcategoryname_sr')) {
            $searchterm = $this->session->userdata('subcategoryname_sr');
            return $searchterm;
        } else {
            $searchterm = "";
            return $searchterm;
        }
    }

}
