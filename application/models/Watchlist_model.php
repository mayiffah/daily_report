<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Watchlist_model extends CI_Model {

        public function __construct()
        {
            parent::__construct();
          	$this->load->database();
        }

        public function get_watchlist($title = TRUE)
        {
            if ($title === 'all') {
              $query = $this->db->query('SELECT * FROM `watchlist2018-july-11.09:02:00`');
            } else {
              $query = $this->db->query('SELECT * FROM `watchlist2018-july-11.09:02:00` WHERE id = "'.$title.'"');
            }
        	
        	return $query->result();
        }


}
        