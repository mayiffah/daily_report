<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Pencapaian_model extends CI_Model {

        public function __construct()
        {
            parent::__construct();
          	$this->load->database();
        }

        public function get_pencapaian($title = TRUE)
        {
            if ($title === 'all') {
              $query = $this->db->query('SELECT * FROM `pencapaian`');
            } else {
              $query = $this->db->query('SELECT * FROM `pencapaian` WHERE wilayah = "'.$title.'"');
            }
        	
        	return $query->result();
        }


}
        