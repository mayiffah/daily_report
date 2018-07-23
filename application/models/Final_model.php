<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Final_model extends CI_Model {

        public function __construct()
        {
            parent::__construct();
          	$this->load->database();
        }

        public function get_outstanding($title)
        {
            $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) FROM existing);
            
        	return $query->result();
        }


}
        