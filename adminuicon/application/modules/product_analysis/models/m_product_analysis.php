<?php
class M_product_analysis extends CI_Model{
   public function handler0($searchterm)
	{
            if($searchterm)
            {
                    $this->session->set_userdata('page_sr', $searchterm);
                    return $searchterm;
            }
            elseif($this->session->userdata('page_sr'))
            {
                    $searchterm = $this->session->userdata('page_sr');
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
            if($searchterm==""){
                $this->session->set_userdata('brand_sr', "");
                    return $searchterm;
            }else{
            if($searchterm)
            {
                    $this->session->set_userdata('brand_sr', $searchterm);
                    return $searchterm;
            }
            elseif($this->session->userdata('brand_sr'))
            {
                    $searchterm = $this->session->userdata('brand_sr');
                    return $searchterm;
            }
            else
            {
                    $searchterm ="";
                    return $searchterm;
            }
	}
        }
        
        public function handler3($searchterm)
	{
            if($searchterm==""){
                $this->session->set_userdata('type_sr', "");
                    return $searchterm;
            }else{
            if($searchterm)
            {
                    $this->session->set_userdata('type_sr', $searchterm);
                    return $searchterm;
            }
            elseif($this->session->userdata('type_sr'))
            {
                    $searchterm = $this->session->userdata('type_sr');
                    return $searchterm;
            }
            else
            {
                    $searchterm ="";
                    return $searchterm;
            }
	}
        }
        
        public function handler4($searchterm)
	{
            if($searchterm)
            {
                    $this->session->set_userdata('gender_sr', $searchterm);
                    return $searchterm;
            }
            elseif($this->session->userdata('gender_sr'))
            {
                    $searchterm = $this->session->userdata('gender_sr');
                    return $searchterm;
            }
            else
            {
                    $searchterm ="";
                    return $searchterm;
            }
	}
        
         public function handlerfrom($ses,$searchterm)
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
                    $searchterm ="1988-12-30";
                    return $searchterm;
            }
	}
        
    public function handlerto($ses,$searchterm)
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
                    $searchterm ="2056-12-30";
                    return $searchterm;
            }
	}

}
