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

        public function get_produk_b2b()
        {
            $query = $this->db->query('SELECT * FROM `produk` ORDER BY id ASC LIMIT 8');
        
            return $query->result();
        }

        public function get_produk_b2c()
        {
            $query = $this->db->query('SELECT * FROM `produk` ORDER BY id ASC LIMIT 6 OFFSET 8');
                      
            return $query->result();
        }




}
        