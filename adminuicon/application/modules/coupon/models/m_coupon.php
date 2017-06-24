<?php
class M_coupon extends CI_Model{
    
     public function handler0($ses,$searchterm)
	{
            if($searchterm)
            {
                    $this->session->set_userdata($ses, $searchterm);
                    return $searchterm;
            }
            elseif($this->session->userdata($ses))
            {
                    $searchterm = $this->session->userdata($ses);
                    return $searchterm;
            }
            else
            {
                    $searchterm ="";
                    return $searchterm;
            }
	}
        
        public function handler1($searchterm)
	{
            if($searchterm)
            {
                    $this->session->set_userdata('id_sr', $searchterm);
                    return $searchterm;
            }
            elseif($this->session->userdata('id_sr'))
            {
                    $searchterm = $this->session->userdata('id_sr');
                    return $searchterm;
            }
            else
            {
                    $searchterm ="";
                    return $searchterm;
            }
	}
        
        public function handler2($searchterm)
	{
            if($searchterm)
            {
                    $this->session->set_userdata('name_sr', $searchterm);
                    return $searchterm;
            }
            elseif($this->session->userdata('name_sr'))
            {
                    $searchterm = $this->session->userdata('name_sr');
                    return $searchterm;
            }
            else
            {
                    $searchterm ="";
                    return $searchterm;
            }
	}
        
        public function handler3($searchterm)
	{
            if($searchterm)
            {
                    $this->session->set_userdata('status_sr', $searchterm);
                    return $searchterm;
            }
            elseif($this->session->userdata('status_sr'))
            {
                    $searchterm = $this->session->userdata('status_sr');
                    return $searchterm;
            }
            else
            {
                    $searchterm ="";
                    return $searchterm;
            }
	}
}