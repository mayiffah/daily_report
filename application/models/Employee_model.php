<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Employee_model extends CI_Model {

        public function __construct()
        {
            parent::__construct();
          	$this->load->database();
        }

        public function get_employee($title = TRUE)
        {
            if ($title === 'tes') {
              $query = $this->db->query('SELECT * FROM employee');
            } else {
              $query = $this->db->query('SELECT * FROM employee WHERE id = "'.$title.'"');
            }
        	
        	return $query->result();
        }


}
        