<?php

class Access extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
	}

	function check_access()
	{
		if($this->session->userdata('access_login') != TRUE)
		{
			$this->login();
		}	
	}
	
	function login()
	{
		$this->load->view('home');
	}
	
	function login_process($nip,$password)
	{
		$data_user = $this->main_model->get_list_where('users',array('nip' => $nip));
		
		if($data_user->num_rows() > 0)
		{
			$data_user_row = $data_user->row_array();
			
			$data_user_password = $this->encrypt->decode($data_user_row['password']);
			
			if($password == $data_user_password)
			{
				$token = sha1($password);
				$data_access = array(
								'access_login' => TRUE,
								'users_id' => $data_user_row['id'],
								'usere_nip' => $data_user_row['nip'],
								'users_token' => $token,
								'users_level' => $data_user_row['level']
							);
							
				$this->session->set_userdata($data_access);			

				return TRUE;
			}
			else
			{
				return FALSE;
			}	
		}
		else
		{	
			return FALSE;
		}		
	}
	
	function logout()
	{
		$this->session->sess_destroy();
	}
	
}	