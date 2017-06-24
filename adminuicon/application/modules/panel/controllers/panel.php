<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Panel extends MX_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('m_panel');
        if($this->session->userdata('logged_in_admin')==false){
            redirect('login');    
        }
        }
	public function index()
	{
        $data['article']=$this->m_panel->count_article("article");
        $data['article_subcategory']=$this->m_panel->count_article("article_subcategory");
        $data['article_category']=$this->m_panel->count_article("article_category");
        $data['newsletter']=$this->m_panel->count_article("newsletter_news");
        $data['view']='main';
        $this->load->view('template',$data);
	}
        
        function cek_message(){
            $this->load->database('desalite',true);
            $cek = $this->db->query("select a.*,b.name,c.product_name 
                                     from private_message a
                                     left join customer b on a.customer_id=b.id_customer
                                     left join product c on a.product_id=c.id_product
                                     where a.status='Y' and a.answered ='' order by id desc limit 10")->result_array();
            echo json_encode($cek);
        }
        
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */