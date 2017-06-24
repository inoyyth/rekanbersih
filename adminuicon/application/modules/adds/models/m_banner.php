<?php

class m_banner extends CI_Model{
    
    public $banner_id;
    public $banner_title;
    public $banner_title_link;
    public $banner_url;
    public $banner_image;
    public $banner_page;
    public $banner_date_insert;
    public $banner_date_update;
    public $banner_data;
    
    // Kalo mau nambahin page disini aja.
    public $page_list = Array(
        'home' => 'Home',
        'product' => 'Product',
        'product_search' => 'Product Search',
        'about' => 'About',
        'news' => 'News',
        'ourbrand' => 'Ourbrand',
        'media_feature' => 'Media Feature',
        'article_category' => 'Article Category',
        'sign_in' => 'Sign In',
        'register' => 'Register',
        'shopping_cart' => 'Shopping Cart',
        'featured_trend' => 'Featured Trend',
        'just_in' => 'Just In'
    );
    //
    private $table = 'banner2';
    
    public function __construct() {
        parent::__construct();
    }
    
    public function select_one($id = null, $permalink = null) {

        if (empty($id) && empty($permalink)) {
            return;
        }

        $where = Array();
        $where['banner_id'] = $id;

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
                    $this->banner_data[$key] = $value;
                }
            }
        } else if (is_string($data) && !empty($data)) {
            $this->$data = $value;
            $this->banner_data[$data] = $value;
        }
    }

    public function insert() {
        
        if(empty($this->banner_data)) {
            return;
        }
        
        $this->db->insert($this->table, $this->banner_data);
        
    }

    public function update() {
        
        $where = Array(
            'banner_id' => $this->banner_id
        );
        
        $this->db->where($where);
        $this->db->update($this->table, $this->banner_data);
        //exit($this->db->last_query());
    }

    public function delete() {
        if (!empty($this->banner_id)) {
            $this->db->query("DELETE FROM `" . $this->table . "` WHERE banner_id='" . $this->banner_id . "'");
        }
    }

    public function get_banner_data($where = null) {
        
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
        if(!empty($_FILES['banner_image'])) {
            $this->upload->initialize($config);
            if ($this->upload->do_upload('banner_image')) {
                $image_data = $this->upload->data();
                $result['banner_image'] = $image_data;
            }
        }
        
        return $result;
        
    }
    
    public function banner_page_array() {
        
        if(empty($this->banner_id)) {
            return;
        }
        
        return explode(',', $this->banner_page);
        
    }
    
    public function get_banner_view($page = null) {
        
        $sperator = ',';
        $field_name = 'banner_page';
        
        $query = " SELECT * FROM `".$this->table."` ";
        $query .= " WHERE FIND_IN_SET('" . $page . "', REPLACE(" . $field_name . ", '" . $sperator . "', ',')) LIMIT 1";
        
        $q = $this->db->query($query);
        $result = $q->row();
        
        ob_start();
        ?>

        <div class="row">
            <div class="col-lg-12">
                <img src="<?php echo base_url(); ?>userfiles/Image/banner/<?php echo $result->banner_image; ?>" class="img-responsive"/>
            </div>
        </div>
        
        <?php
        $return = ob_get_clean();
        
        return $return;
        
    }
    
}
