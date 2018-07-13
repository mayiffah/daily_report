<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Nasional extends CI_Controller {

        public function __construct()
        {
            parent::__construct();
//          $this->load->database();
            $this->load->helper('url');
		// Load form helper library
			$this->load->helper('form');

			$this->load->helper('security');
			
			// Load form validation library
			$this->load->library('form_validation');
			
			// Load session library
			$this->load->library('session');
			
			// Load database
			$this->load->model('login_database');
			$this->load->model('employee_model');
			$this->load->model('watchlist_model');
        }

        public function index()
        {
        	$this->load->helper('url');
        	$data['list_employee'] = $this->employee_model->get_employee('tes');
        	$data['list_watchlist'] = $this->watchlist_model->get_watchlist('all');
            $this->load->view('/portfolio', $data);
        }

        public function watchlist()
        {
        	$this->load->helper('url');
        	$data['list_employee'] = $this->employee_model->get_employee('tes');
        	$data['list_watchlist'] = $this->watchlist_model->get_watchlist('all');
            $this->load->view('/watchlist', $data);
        }

        public function watchlisttest()
        {
        	$this->load->helper('url');
        	$data['list_employee'] = $this->employee_model->get_employee('tes');
        	$data['list_watchlist'] = $this->watchlist_model->get_watchlist('all');
            $this->load->view('/watchlisttest', $data);
        }

        public function login() 
        {
        	$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

			if ($this->form_validation->run() == FALSE) {
				if(isset($this->session->userdata['logged_in'])){
					$this->load->view('/portfolio');
				}else{
					$this->load->view('/login');
				}
			} else {
				$data = array(
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password')
				);
				$result = $this->login_database->login($data);
				if ($result == TRUE) {

					$username = $this->input->post('username');
					$result = $this->login_database->read_user_information($username);
					if ($result != false) {
						$session_data = array(
						'username' => $result[0]->user_name
						);
						// Add user data in session
						$this->session->set_userdata('logged_in', $session_data);
						$data['list_employee'] = $this->employee_model->get_employee('tes');
						$data['list_watchlist'] = $this->watchlist_model->get_watchlist('all');
						$this->load->view('/portfolio', $data);
					}
				} else {
					$data = array(
					'error_message' => 'Invalid Username or Password'
					);
					$this->load->view('login', $data);
				}
			}
        //	$this->load->view('/login');	
        }

        // Logout from admin page
		public function logout() {

		// Removing session data
		$sess_array = array(
		'username' => ''
		);
		$this->session->unset_userdata('logged_in', $sess_array);
		$data['message_display'] = 'Successfully Logout';
		$this->load->helper('url');
       	$this->load->helper('form');
		$this->load->view('login', $data);
		}

		
		public function detail($id) {

		$data['id'] = $id; 	
		$data['message_display'] = 'Semangat Iffah';
		$data['detail'] = $this->employee_model->get_employee($id);
		$this->load->view('detail', $data);
		}
/*
        public function posisi_outstanding() 
        {
        	$this->load->helper('url');
        	$this->load->view('/posisi_outstanding');	
        }*/

}
