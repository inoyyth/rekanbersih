<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class File_manager extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('logged_in') == false) {
            //redirect('login');
        }
    }

    function index() {
        
        $data['view'] = 'main';
        $this->load->view('main');
    }

}