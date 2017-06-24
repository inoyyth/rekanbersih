<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends MX_Controller{
	
	public $kota;
	
    public function __construct() {
        parent::__construct();
        
        $this->load->model('main_model');
        $this->load->model('m_product');
		setcookie("cookie_booking", $this->generateRandomString(20),time()-3600);
		$this->set_kota();
    }
	
	public function index() {
		$data['view'] = 'main';
		$this->load->view('template',$data);
	}
	
	public function page_utama() {
		setcookie("cookie_booking", $this->generateRandomString(20),time()+3600, "/", ".revanishop.com");
		$data['durasi_paket'] = $this->db->get_where('durasi_paket',array('status'=>'Y'))->result_array(); 
		$data['kota'] = $this->kota; 
		$this->load->view('product/utama',$data);
	}
	
	public function page_berkala() {
		$data['schedule_visit'] = $this->db->get_where('schedule_visit',array('status'=>'Y'))->result_array(); 
		$data['kota'] = $this->kota; 
		$this->load->view('product/berkala',$data);
	}
	
	public function page_lainnya() {
		$data['service_type'] = $this->db->get_where('service_type',array('status'=>'Y'))->result_array(); 
		$data['kota'] = $this->kota; 
		$this->load->view('product/lainnya',$data);
	}
	
	public function save_pembersihan_utama() {
		if (isset($_COOKIE['cookie_booking'])) {
			if ($this->m_product->save_utama()) {
				$result = array('code'=>200,'message'=>'success');
			} else {
				$result = array('code'=>204,'message'=>'failed');
			}
		} else {
			$result = array('code'=>204,'message'=>'black hole');
		}
		echo json_encode($result);
	}
	
	private function set_kota() {
		return $this->kota = $this->db->get_where('kota',array('status'=>'Y'))->result_array(); 
	}
	
	public function save_pembersihan_berkala() {
		if (isset($_COOKIE['cookie_booking'])) {
			if ($this->m_product->save_berkala()) {
				$result = array('code'=>200,'message'=>'success');
			} else {
				$result = array('code'=>204,'message'=>'failed');
			}
		} else {
			$result = array('code'=>204,'message'=>'black hole');
		}
		echo json_encode($result);
	}
	
	public function save_pembersihan_lainnya() {
		if (isset($_COOKIE['cookie_booking'])) {
			if ($this->m_product->save_lainnya()) {
				$result = array('code'=>200,'message'=>'success');
			} else {
				$result = array('code'=>204,'message'=>'failed');
			}
		} else {
			$result = array('code'=>204,'message'=>'black hole');
		}
		echo json_encode($result);
	}
	
	private function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
}