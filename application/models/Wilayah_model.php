<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Wilayah_model extends CI_Model {

        public function __construct()
        {
            parent::__construct();
          	$this->load->database();
        }

        public function get_wilayah($title = TRUE)
        {
        	if ($title === 'ALL')
        	{
        		$query = $this->db->query('SELECT * FROM wilayah ');
        	} else {

            //skrg semua masuk kesini..
/*        	$query = $this->db->get_where('wilayah', array('nama_wilayah' => $title));*/
                $query = $this->db->query('SELECT * FROM wilayah where id = "'.$title.'"');
            }

        	return $query->result();
        }

}
        