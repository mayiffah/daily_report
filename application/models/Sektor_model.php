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


}
        