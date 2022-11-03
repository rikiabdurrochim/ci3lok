<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Dashboard_model');
	}
	public function index()
	{
		$username = $_SESSION['id_peg'];
		if ($username != "") {
			$data['title'] = 'Dashboard';
			$this->load->view('template/header', $data);
			$this->load->view('template/sidebar', $data);
			$this->load->view('dashboard/index', $data);
			$this->load->view('template/footer');
		} else {
			redirect('log');
		}
	}
}
