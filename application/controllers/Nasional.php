<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Nasional extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
//                $this->load->database();
        }

        public function index()
        {
        		$this->load->helper('url');
                $this->load->view('/portfolio');
        }

}
