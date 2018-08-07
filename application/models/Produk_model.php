<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Produk_model extends CI_Model {

        public function __construct()
        {
            parent::__construct();
          	$this->load->database();
        }

        public function get_produk()
        {
              $query = $this->db->query('SELECT * FROM `produk`');
           
        	
        	return $query->result();
        }


}
        