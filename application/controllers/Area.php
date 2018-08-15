<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Area extends CI_Controller {

        public function __construct()
        {
            parent::__construct();
            $this->load->model('wilayah_model');
            $this->load->model('area_model');
            $this->load->model('cabang_model');
            $this->load->model('final_model');
          	$this->load->helper('url');
            $this->load->library('session');
        }

        //filtering berdasarkan area yg ada di database
        public function portfolio_area($id_jabatan, $nama_outlet) 
        {
        	$this->load->helper('url');
            if ($id_jabatan === '1' or $id_jabatan === '2') {
                $data['list_wilayah'] = $this->wilayah_model->get_wilayah('ALL');
                $data['list_area'] = $this->area_model->get_area('ALL');
                $data['list_cabang'] = $this->cabang_model->get_cabang('ALL');
                $data['wil_ada'] = false;
                $data['area_ada'] = false;
                $data['cbg_ada'] = false;
            } else if ($id_jabatan === '3' or $id_jabatan === '4') {


                $nama_outlet = str_replace('%20', ' ', $nama_outlet);
                $data['list_wilayah'] = $this->wilayah_model->get_wilayah_by_name($nama_outlet);
                $data['list_area'] = $this->area_model->get_area('ALL');
                $data['list_cabang'] = $this->cabang_model->get_cabang('ALL');
                $data['wil_ada'] = false;
                $data['area_ada'] = false;
                $data['cbg_ada'] = false;
           
            } else if ($id_jabatan === '5' or $id_jabatan === '7') {

                $nama_outlet = str_replace('%20', ' ', $nama_outlet);
                $data['list_area'] = $this->area_model->get_area_by_name($nama_outlet);
                $data['list_cabang'] = $this->cabang_model->get_cabang('ALL');
                $data['wil_ada'] = true;
                $data['area_ada'] = false;
                $data['cbg_ada'] = false;
           
            } else if ($id_jabatan === '6' or $id_jabatan === '8') {

                $nama_outlet = str_replace('%20', ' ', $nama_outlet);
                $data['list_cabang'] = $this->cabang_model->get_cabang_by_name($nama_outlet);
                $data['wil_ada'] = true;
                $data['area_ada'] = true;
                $data['cbg_ada'] = true;
           
            }
 	
        	
            $data['ada_outstanding'] = false;
        	$this->load->view('/portfolio_area', $data);	
        }

        public function portfolio_area_baru($id_jabatan, $nama_outlet)
        {
        	$wil = $this->input->get('wilayah');
        	$area = $this->input->get('area');
        	$cabang = $this->input->get('cabang');

            $data['wil'] = $wil;
            $data['ar'] = $area;
            $data['cab'] = $cabang;
            
			if ($id_jabatan === '1' or $id_jabatan === '2') {
                $data['list_wilayah'] = $this->wilayah_model->get_wilayah('ALL');
            } else if ($id_jabatan === '3' or $id_jabatan === '4') {
                $data['list_wilayah'] = $this->wilayah_model->get_wilayah($wil);
            } 			
        	$data['wil_ada'] = true;
            $data['ada_outstanding'] = true;
            
            $nama_outlet = str_replace('%20', ' ', $nama_outlet);
            $data['tes1'] = $nama_outlet;
           // $data['jabatan'] = $id_jabatan;
            $data['outstanding'] = $this->final_model->get_outstanding($id_jabatan, $nama_outlet);
        	
        	if ($area != '' and $area != '0') {
                if ($id_jabatan === '1' or $id_jabatan === '2') {
                    $data['list_area'] = $this->area_model->get_area_with_wilayah($wil);
                } else if ($id_jabatan === '3' or $id_jabatan === '4') {
                    $data['list_area'] = $this->area_model->get_area_with_wilayah($wil);
                }  else if ($id_jabatan === '5' or $id_jabatan === '7') {
                    $data['list_area'] = $this->area_model->get_area($area);
                } 

        		
      			$data['area_ada'] = true;
      			if ($cabang != '' and $cabang != '0') {
        			$data['list_cabang'] = $this->cabang_model->get_cabang($cabang);
	      			$data['cbg_ada'] = true;
	        	} else {
	        		$data['list_cabang'] = $this->cabang_model->get_cabang_with_area($area);
	        		$data['cbg_ada'] = false;
	        	}
        	} else {
        		$data['list_area'] = $this->area_model->get_area_with_wilayah($wil);
        		$data['area_ada'] = false;
        	}
        	
        	$this->load->view('/portfolio_area', $data);	
        }

        // Logout from admin page
        public function logout() {

        // Removing session data
        $sess_array = array(
        'username' => ''
        );
        $this->session->unset_userdata('logged_in', $sess_array);
        $data['message_display'] = 'Successfully Logout';
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->view('login', $data);
    }


}
        