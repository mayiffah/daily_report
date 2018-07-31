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

			// Load encryption library
			$this->load->library('encrypt');
			
			// Load database
			$this->load->model('login_database');
			$this->load->model('employee_model');
			$this->load->model('watchlist_model');
			$this->load->model('final_model');
        }

        public function index($id_jabatan, $nama_outlet)
        {
        	$this->load->helper('url');
        	$data['list_employee'] = $this->employee_model->get_employee('tes');
        	$data['outstanding'] = $this->final_model->get_outstanding("1", $nama_outlet);
        	$data['outstanding1'] = $this->final_model->get_outstanding("3", 'REGIONAL I');
        	$data['outstanding2'] = $this->final_model->get_outstanding("3", 'REGIONAL II');
        	$data['outstanding3'] = $this->final_model->get_outstanding("3", 'REGIONAL III');
        	$data['outstanding4'] = $this->final_model->get_outstanding("3", 'REGIONAL IV');
        	$data['outstanding5'] = $this->final_model->get_outstanding("3", 'REGIONAL V');
        	$data['outstanding6'] = $this->final_model->get_outstanding("3", 'REGIONAL VI');
        	$data['outstanding7'] = $this->final_model->get_outstanding("3", 'REGIONAL VII');

        	$data['kol2'] = $this->final_model->get_kol2("1", $nama_outlet);
        	$data['kol2-1'] = $this->final_model->get_kol2("3", 'REGIONAL I');
        	$data['kol2-2'] = $this->final_model->get_kol2("3", 'REGIONAL II');
        	$data['kol2-3'] = $this->final_model->get_kol2("3", 'REGIONAL III');
        	$data['kol2-4'] = $this->final_model->get_kol2("3", 'REGIONAL IV');
        	$data['kol2-5'] = $this->final_model->get_kol2("3", 'REGIONAL V');
        	$data['kol2-6'] = $this->final_model->get_kol2("3", 'REGIONAL VI');
        	$data['kol2-7'] = $this->final_model->get_kol2("3", 'REGIONAL VII');
        	





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
					/*$data['list_employee'] = $this->employee_model->get_employee('tes');
					$data['list_watchlist'] = $this->watchlist_model->get_watchlist('all');
					$this->load->view('/portfolio', $data);*/
					$id_jabatan =  $this->session->userdata['logged_in']['id_jabatan'];
					$nama_outlet =  $this->session->userdata['logged_in']['nama_outlet'];

					$this->index($id_jabatan, $nama_outlet);
				}else{
					$this->load->view('/login');
				}
			} else {
				$username = $this->input->post('username');
				$ada_user = $this->login_database->read_user_information($username);

				if ($ada_user == TRUE) {

					$data = array(
					'username' => $this->input->post('username'),
					'password' => $this->input->post('password')
					);
					$result = $this->login_database->login($data);

					if ($result != false) {
						$session_data = array(
							'username' => $ada_user[0]->nama,
							'id_jabatan' => $ada_user[0]->id_jabatan,
							'nama_outlet' => $ada_user[0]->nama_outlet
						);
						// Add user data in session
						$this->session->set_userdata('logged_in', $session_data);
						/*$data['list_employee'] = $this->employee_model->get_employee('tes');
						$data['list_watchlist'] = $this->watchlist_model->get_watchlist('all');
						
						$this->load->view('/portfolio', $data);*/
						$this->index($ada_user[0]->id_jabatan, $ada_user[0]->nama_outlet);
					} else {
						$data = array(
						'error_message' => 'Invalid Username or Password'
						);
						$this->load->view('login', $data);
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
