<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Bbrm_model extends CI_Model {

        public function __construct()
        {
            parent::__construct();
          	$this->load->database();
        }

        public function get_bbrm($title = TRUE)
        {
            
        		$query = $this->db->query('SELECT * FROM bbrm where nama_outlet = "'.$title.'"');

        	return $query->result();
        }


}
        