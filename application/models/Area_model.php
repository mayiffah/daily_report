<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Area_model extends CI_Model {

        public function __construct()
        {
            parent::__construct();
          	$this->load->database();
        }

        public function get_area($title = TRUE)
        {
        	if ($title === 'ALL')
        	{
        		$query = $this->db->query('SELECT * FROM area');
        	} else {

/*        	$query = $this->db->get_where('wilayah', array('nama_wilayah' => $title));*/
                $query = $this->db->query('SELECT * FROM area where id = "'.$title.'"');
            }

        	return $query->result();
        }

        public function  get_area_with_wilayah($title = TRUE)
        {
            $query = $this->db->query('SELECT * FROM area where id_wilayah = "'.$title.'"');
            
            return $query->result();
        }
}
        