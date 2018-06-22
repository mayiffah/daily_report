<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Wilayah_model extends CI_Model {

        public function __construct()
        {
            parent::__construct();
          	$this->load->database();
        }

        public function get_wilayah($title = FALSE)
        {
        	if ($title === FALSE)
        	{
        		$query = $this->db->query('SELECT * FROM wilayah');
        	}

/*        	$query = $this->db->get_where('wilayah', array('nama_wilayah' => $title));*/
            $query = $this->db->query('SELECT * FROM wilayah');

        	return $query->result();
        }

}
        