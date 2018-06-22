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
        	
        	$data['list_wilayah'] = $this->wilayah_model->get_wilayah();
        	$data['list_area'] = $this->area_model->get_area();
        	$data['list_cabang'] = $this->cabang_model->get_cabang();
        	$this->load->view('/portfolio_area', $data);	
        }


}
        