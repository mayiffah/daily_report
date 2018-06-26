<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Cabang_model extends CI_Model {

        public function __construct()
        {
            parent::__construct();
          	$this->load->database();
        }

        public function get_cabang($title = TRUE)
        {
        	if ($title === 'ALL')
        	{
        		$query = $this->db->query('SELECT * FROM cabang');
        	} else {

/*        	$query = $this->db->get_where('wilayah', array('nama_wilayah' => $title));*/
                $query = $this->db->query('SELECT * FROM cabang where id = "'.$title.'"');
            }
        	return $query->result();
        }

        public function  get_cabang_with_area($title = TRUE)
        {
            $query = $this->db->query('SELECT * FROM cabang where id_area = "'.$title.'"');
            
            return $query->result();
        }

}
        