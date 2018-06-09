<?php

class Coba_model extends CI_Model {
	
	public function __construct() 
	{
		$this->load->database();
	}

	public function get_coba($title = FALSE) 
	{
		if ($title === FALSE)
		{
			$query = $this->db->query('select * from coba');
			return $query->result_array();
		}	

		$query = $this->db->get_where('rahasia', array('title' => $title));
		return $query->row_array();

	}


}