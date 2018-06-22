<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Daily extends CI_Controller {

        public function __construct()
        {
            parent::__construct();
            $this->load->model('wilayah_model');
          	$this->load->helper('url');
        }

        //filtering berdasarkan area yg ada di database
        public function posisi() 
        {
        	
        	$data['list_wilayah'] = $this->wilayah_model->get_wilayah();
        	$this->load->view('/posisi', $data);	
            /*$this->load->view('/posisi'); */
        }

        //filtering berdasarkan area yg ada di database
        public function runoff() 
        {
            
            $data['list_wilayah'] = $this->wilayah_model->get_wilayah();
            $this->load->view('/runoff', $data);    
            /*$this->load->view('/runoff');*/ 
        }

        //filtering berdasarkan area yg ada di database
        public function cair() 
        {
            
            $data['list_wilayah'] = $this->wilayah_model->get_wilayah();
            $this->load->view('/cair', $data);    
            /*$this->load->view('/cair');*/ 
        }

        //filtering berdasarkan area yg ada di database
        public function kol2() 
        {
            
            $data['list_wilayah'] = $this->wilayah_model->get_wilayah();
            $this->load->view('/kol2', $data);    
            /*$this->load->view('/kol2');*/ 
        }


}
        