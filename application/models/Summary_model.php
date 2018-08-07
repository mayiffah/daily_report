<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Summary_model extends CI_Model {

        public function __construct()
        {
            parent::__construct();
          	$this->load->database();
        }

        public function get_summary($title = TRUE)
        {
            if ($title === 'all') {
              $query = $this->db->query('SELECT * FROM `summary`');
            } else {
              $query = $this->db->query('SELECT * FROM `summary` WHERE id = "'.$title.'"');
            }
        	
        	return $query->result();
        }


}
        