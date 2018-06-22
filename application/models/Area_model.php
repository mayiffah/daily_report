<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Area_model extends CI_Model {

        public function __construct()
        {
            parent::__construct();
          	$this->load->database();
        }

        public function get_area($title = FALSE)
        {
        	if ($title === FALSE)
        	{
        		$query = $this->db->query('SELECT * FROM area');
        	}

/*        	$query = $this->db->get_where('wilayah', array('nama_wilayah' => $title));*/
            $query = $this->db->query('SELECT * FROM area');

        	return $query->result();
        }

}
        