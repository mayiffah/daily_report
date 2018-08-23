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
			$this->load->model('summary_model');
			$this->load->model('produk_model');
			$this->load->model('sektor_model');
            $this->load->model('pencapaian_model');
			
        }

        public function index($id_jabatan, $nama_outlet)
        {
        	$this->load->helper('url');
            $summary = $this->summary_model->get_summary('all');
        	$data['list_employee'] = $this->employee_model->get_employee('tes');
        	$data['list_summary'] = $summary;
            $data['list_produk_b2b'] = $this->produk_model->get_produk_b2b();
            $data['list_produk_b2c'] = $this->produk_model->get_produk_b2c();
            $data['list_sektor_b2b'] = $this->sektor_model->get_sektor_b2b();
            $data['list_sektor_b2c'] = $this->sektor_model->get_sektor_b2c();
            $data['list_pencapaian'] = $this->pencapaian_model->get_pencapaian('nasional');
            $data['nasional'] = $this->summary_model->get_summary_portfolio();
            $data['nasional_jan'] = $this->summary_model->get_summary_portfolio_before('summary_akhir_bulan_jan2018');
            $data['nasional_feb'] = $this->summary_model->get_summary_portfolio_before('summary_akhir_bulan_feb2018');
            $data['nasional_mar'] = $this->summary_model->get_summary_portfolio_before('summary_akhir_bulan_mar2018');
            $data['nasional_apr'] = $this->summary_model->get_summary_portfolio_before('summary_akhir_bulan_apr2018');
            $data['nasional_mei'] = $this->summary_model->get_summary_portfolio_before('summary_akhir_bulan_mei2018');
            $data['nasional_jun'] = $this->summary_model->get_summary_portfolio_before('summary_akhir_bulan_jun2018');
            $data['nasional_jul'] = $this->summary_model->get_summary_portfolio_before('summary_akhir_bulan_jul2018');
            $data['cair_jan'] = $this->summary_model->get_cair('summary_akhir_bulan_jan2018');
            $data['cair_feb'] = $this->summary_model->get_cair('summary_akhir_bulan_feb2018');
            $data['cair_mar'] = $this->summary_model->get_cair('summary_akhir_bulan_mar2018');
            $data['cair_apr'] = $this->summary_model->get_cair('summary_akhir_bulan_apr2018');
            $data['cair_mei'] = $this->summary_model->get_cair('summary_akhir_bulan_mei2018');
            $data['cair_jun'] = $this->summary_model->get_cair('summary_akhir_bulan_jun2018');
            $data['cair_jul'] = $this->summary_model->get_cair('summary_akhir_bulan_jul2018');
            
        	
        	
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
