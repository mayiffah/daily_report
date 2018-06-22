<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Cabang_model extends CI_Model {

        public function __construct()
        {
            parent::__construct();
          	$this->load->database();
        }

        public function get_cabang($title = FALSE)
        {
        	if ($title === FALSE)
        	{
        		$query = $this->db->query('SELECT * FROM cabang');
        	}

/*        	$query = $this->db->get_where('wilayah', array('nama_wilayah' => $title));*/
            $query = $this->db->query('SELECT * FROM cabang');

        	return $query->result();
        }

}
        