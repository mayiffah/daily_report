<?php

Class Login_Database extends CI_Model {

	 public function __construct()
        {
            parent::__construct();
          	$this->load->database();
        }

	// Insert registration data in database
	public function registration_insert($data) {

		// Query to check whether username already exist or not
/*		$condition = "user_name =" . "'" . $data['user_name'] . "'";
		$this->db->select('*');
		$this->db->from('user_login');
		$this->db->where($condition);
		$this->db->limit(1);*/
//		$query = $this->db->query('SELECT * from user_login WHERE user_name = "'.$data['user_name'].'" LIMIT 1');
		$query = $this->db->query('SELECT * from user_login WHERE user_name = "'.$data['user_name'].'" LIMIT 1');
		
		if ($query->num_rows() == 0) {

		// Query to insert data in database
		$this->db->insert('user_login', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		} else {
			return false;
		}
	}

	// Read data using username and password
	public function login($data) {
		
		$get_password = $this->get_password($data['username']);
			foreach ($get_password as $pw) {
				$password_from_db = $pw->user_password;
			//	$password_from_db = 'fok5XYyZ6r2IIWm9MqHznDKsHX/u5u5sFNsWfzmtXDRiN0uA5Hohlo3tSTQWCfZGf2tnbqVVPVwd2wOQzVDOig==';
				}
		$password_decrypted = $this->encrypt->decode($password_from_db);

		if ($password_decrypted != '') {
			$ada_dekripnya = true;
			
      		if ($data['password'] === $password_decrypted) {
				return true;
			} else {
				return false;
			}			
		} else {
			$ada_dekripnya = false;
      		$condition = "user_name =" . "'" . $data['username'] . "' AND " . "user_password =" . "'" . $data['password'] . "'";
      		$this->db->select('*');
			$this->db->from('user_login');
			$this->db->where($condition);
			$this->db->limit(1);
			$query = $this->db->get();

			if ($query->num_rows() == 1) {
				return true;
			} else {
				return false;
			}
		}
	}

	// Read data from database to show data in admin page
	public function read_user_information($username) {

		$condition = "user_name =" . "'" . $username . "'";
		$this->db->select('*');
		$this->db->from('user_login');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}

	// get password of a username
	public function get_password($username) {
		$query = $this->db->query("SELECT user_password FROM user_login WHERE user_name ='".$username."'");

		return $query->result();
	}

}

?>