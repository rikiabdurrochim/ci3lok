<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Akun extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Akun_model');
	}

	public function index()
	{
		$username = $_SESSION['id_peg'];
		if ($username != "") {
			$data['title'] = 'Data Akun';
			$data['data_akun'] = $this->Akun_model->select_akun();
			$this->load->view('template/header', $data);
			$this->load->view('template/sidebar', $data);
			$this->load->view('akun/index', $data);
			$this->load->view('template/footer');
		} else {
			redirect('log');
		}
	}


	public function prosesinput()
	{
		$kd_giat = $this->input->post('kd_giat');
		$kd_akun = $this->input->post('kd_akun');
		$nm_akun = $this->input->post('nm_akun');
		$kro = $this->input->post('kro');
		$kroakun = $this->input->post('kroakun');

		$data = [
			'kd_giat' => $kd_giat,
			'kd_akun' => $kd_akun,
			'nm_akun' => $nm_akun,
			'kro' => $kro,
			'kroakun' => $kroakun,
		];
		$this->Akun_model->input($data);
		$this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert"> Data Berhasil ditambahkan <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('akun'));
	}

	//save data ke database
	public function prosesupdate()
	{

		$kd_giat = $this->input->post('kd_giat');
		$kd_akun = $this->input->post('kd_akun');
		$nm_akun = $this->input->post('nm_akun');
		$kro = $this->input->post('kro');
		$kroakun = $this->input->post('kroakun');

		$data = [
			'kd_giat' => $kd_giat,
			'kd_akun' => $kd_akun,
			'nm_akun' => $nm_akun,
			'kro' => $kro,
			'kroakun' => $kroakun,
		];

		$this->Akun_model->update($this->input->post('id_akun'), $data);
		redirect(site_url('akun'));
	}

	public function delete($id)
	{
		$this->Akun_model->delete_data($id);
		redirect(site_url('akun'));
	}
}
