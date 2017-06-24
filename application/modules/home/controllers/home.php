<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MX_Controller{
    public function __construct() {
        parent::__construct();
        
        $this->load->model('main_model');
        $this->load->model('m_home');
    }
        
    function index(){
        $data['product_category'] = $this->m_home->getData('article',array('status'=>'Y','id_category'=>7),'sys_create_date','asc',3)->result_array();
		$data['hot_product'] = $this->m_home->getData('product_general',array('status'=>'Y','hot_product'=>1),'create_date','desc',3)->result_array();
        $data['slider']=$this->m_home->getData('slider',array('status'=>'Y'),'sys_create_date','desc',19)->result_array();
        $data['index_article']=$this->m_home->getData('article',array('index_article'=>'1'),'sys_create_date','desc',1)->row_array();
		$data['customer_comment'] = $this->m_home->getData('customer_comment',array('status'=>'Y'),'sys_create_date','desc',3)->result_array();
		$data['view']="main"; //var_dump($data['slider']);die;
        $this->load->view('template',$data);
    }
	
	public function save_inquiry() {
		$data = array(
			'inquiry_name'=>$this->input->post('name'),
			'inquiry_email'=>$this->input->post('email'),
			'inquiry_phone'=>$this->input->post('handphone'),
			'inquiry_address'=>$this->input->post('address'),
			'inquiry_message'=>$this->input->post('message')
		);
		
		if($this->db->insert('customer_inquiry',$data)){
			echo json_encode(array('code'=>200,'message'=>'success'));
		} else {
			echo json_encode(array('code'=>201,'message'=>'failed'));
		}
	}
}