<?php
class Rahasia extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->model('rahasia_model');
		$this->load->helper('url_helper');
	}

	public function index()
	{
		$data['rahasia'] = $this->rahasia_model->get_rahasia();
	}

	public function view($title = NULL) 
	{
		$data['rahasia'] = $this->rahasia_model->get_rahasia();
		$data['title'] = 'Rahasia';
		$this->load->view('templates/header', $data);
		$this->load->view('rahasia/index', $data);
		$this->load->view('templates/footer');
	}
}