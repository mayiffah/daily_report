<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Nasional extends CI_Controller {

        public function __construct()
        {
            parent::__construct();
//          $this->load->database();
        }

        public function index()
        {
        	$this->load->helper('url');
            $this->load->view('/portfolio');
        }

        public function login() 
        {
        	$this->load->helper('url');
        	$this->load->view('/login');	
        }

        public function portfolio_area() 
        {
        	$this->load->helper('url');
        	$this->load->view('/portfolio_area');	
        }

        public function posisi_outstanding() 
        {
        	$this->load->helper('url');
        	$this->load->view('/posisi_outstanding');	
        }

}
