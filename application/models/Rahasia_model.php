<?php

class Rahasia_model extends CI_Model {
	
	public function __construct() 
	{
		$this->load->database();
	}

	public function get_rahasia($title = FALSE) 
	{
		if ($title === FALSE)
		{
			$ya = 'JUDUL 1';
			$query = $this->db->query('select * from rahasia where title ="'.$ya.'"');
			return $query->result_array();
		}	

		$query = $this->db->get_where('rahasia', array('title' => $title));
		return $query->row_array();

	}
}