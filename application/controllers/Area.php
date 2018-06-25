<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Area extends CI_Controller {

        public function __construct()
        {
            parent::__construct();
            $this->load->model('wilayah_model');
            $this->load->model('area_model');
            $this->load->model('cabang_model');
          	$this->load->helper('url');
        }

        //filtering berdasarkan area yg ada di database
        public function portfolio_area() 
        {
        	
        	$data['list_wilayah'] = $this->wilayah_model->get_wilayah('ALL');
        	$data['list_area'] = $this->area_model->get_area('ALL');
        	$data['list_cabang'] = $this->cabang_model->get_cabang('ALL');
        	$data['wil_ada'] = false;
        	$this->load->view('/portfolio_area', $data);	
        }

        public function portfolio_area_baru()
        {
        	$wil = $this->input->get('wilayah');
        	$area = $this->input->get('area');
        	$cabang = $this->input->get('cabang');
        	$wil_ada = true;
        	
        	$data['list_wilayah'] = $this->wilayah_model->get_wilayah($wil);
        	$data['list_area'] = $this->area_model->get_area($area);
        	$data['list_cabang'] = $this->cabang_model->get_cabang($cabang);
        	$data['wil_ada'] = $wil_ada;
        	$this->load->view('/portfolio_area', $data);	
        }


}
        