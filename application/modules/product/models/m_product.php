<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_product extends CI_Model{
    public function __construct() {
        parent::__construct();
        
    }
	
	public function save_utama() {
		$data = array(
			'nama' => $this->input->post('nama'),
			'handphone' => $this->input->post('handphone'),
			'email' => $this->input->post('email'),
			'tanggal' => $this->input->post('tanggal'),
			'id_durasi_paket' => $this->input->post('durasi_paket'),
			'id_kota' => $this->input->post('kota'),
			'alamat' => $this->input->post('alamat'),
			'catatan' => $this->input->post('catatan'),
			'sys_create_date' => date('Y-m-d')
		);
		if($this->db->insert('sales_order',$data)){
			return true;
		}
		return false;
	}
	
	public function save_berkala() {
		$data = array(
			'tipe_paket' => 'berkala',
			'nama' => $this->input->post('nama'),
			'handphone' => $this->input->post('handphone'),
			'email' => $this->input->post('email'),
			'tanggal' => $this->input->post('tanggal'),
			'id_schedule_visit' => $this->input->post('schedule_visit'),
			'id_kota' => $this->input->post('kota'),
			'alamat' => $this->input->post('alamat'),
			'catatan' => $this->input->post('catatan'),
			'sys_create_date' => date('Y-m-d')
		);
		if($this->db->insert('sales_order',$data)){
			return true;
		}
		return false;
	}
	
	public function save_lainnya() {
		$data = array(
			'tipe_paket' => 'lainnya',
			'nama' => $this->input->post('nama'),
			'handphone' => $this->input->post('handphone'),
			'email' => $this->input->post('email'),
			'tanggal' => $this->input->post('tanggal'),
			'id_service_type' => $this->input->post('service_type'),
			'id_kota' => $this->input->post('kota'),
			'alamat' => $this->input->post('alamat'),
			'catatan' => $this->input->post('catatan'),
			'sys_create_date' => date('Y-m-d')
		);
		if($this->db->insert('sales_order',$data)){
			return true;
		}
		return false;
	}
	
}