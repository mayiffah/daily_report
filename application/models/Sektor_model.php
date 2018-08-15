<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Sektor_model extends CI_Model {

        public function __construct()
        {
            parent::__construct();
          	$this->load->database();
        }

        public function get_sektor()
        {
              $query = $this->db->query('SELECT * FROM `sektor`');
           
        	
        	return $query->result();
        }

        public function get_sektor_b2b()
        {
            $query = $this->db->query('SELECT * FROM `sektor` ORDER BY id ASC LIMIT 8');
        
            return $query->result();
        }

        public function get_sektor_b2c()
        {
            $query = $this->db->query('SELECT * FROM `sektor` ORDER BY id ASC LIMIT 10 OFFSET 8');
                      
            return $query->result();
        }


}
        