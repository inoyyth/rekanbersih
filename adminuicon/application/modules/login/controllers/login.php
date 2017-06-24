<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MX_Controller {
        function __construct()
	{
		parent::__construct();
		//$this->load->library('access');
                $this->load->model('m_login');
                $this->load->library('session');
	}
	public function index()
	{
                if ($this->session->userdata('logged_in_admin')){
                    redirect('panel');
                }else{
		$this->load->view('login/index');
                }
	}
        function verivy_login(){
            if ($this->session->userdata('logged_in_admin')){
                    redirect('panel');
            }else{
            $username=$this->input->post("username");
            $pass=$this->input->post("password");
            
            $result = $this->m_login->login($username,$pass);
            
            if($result){
		$sess_array = array();
             foreach($result as $row) {
                 //create the session
                 $sess_arrayx = array('user_id_admin' => $row->user_id,
                                    'username_admin' => $row->username,'first_name_admin'=>$row->first_name,'last_name_admin'=>$row->last_name,'email_admin'=>$row->email);
                 //set session with value from database
                 $this->session->set_userdata('logged_in_admin',$sess_arrayx);
                 }
             redirect('login');
            } else {
                redirect('login');
            }
       }
        }
       
       function logout() {
        $this->session->unset_userdata('logged_in_admin');
        //$this->session->destroy();
        redirect('login', 'refresh');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */