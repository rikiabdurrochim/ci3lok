<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenis extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Jenis_model');
	}

	public function index()
	{
		$username = $_SESSION['id_peg'];
		if ($username != "") {
			$data['title'] = 'Data Detail Jenis';
			$data['data_jenis'] = $this->Jenis_model->select_jenis();

			$this->load->view('template/header', $data);
			$this->load->view('template/sidebar', $data);
			$this->load->view('jenis/index', $data);
			$this->load->view('template/footer');
		} else {
			redirect('log');
		}
	}


	public function prosesinput()
	{

		$kd_jenis = $this->input->post('kd_jenis');
		$nm_jenis = $this->input->post('nm_jenis');

		$data = [
			'kd_jenis' => $kd_jenis,
			'nm_jenis' => $nm_jenis,
		];

		$this->Jenis_model->input($data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data Berhasil disimpan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('jenis'));
	}

	//save data ke database
	public function prosesupdate()
	{

		$kd_jenis = $this->input->post('kd_jenis');
		$nm_jenis = $this->input->post('nm_jenis');

		$data = [
			'kd_jenis' => $kd_jenis,
			'nm_jenis' => $nm_jenis,
		];


		$this->Jenis_model->update($this->input->post('id_jenis'), $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data Berhasil diubah<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('jenis'));
	}

	public function delete($id)
	{

		$this->Jenis_model->delete_data($id);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data Berhasil dihapus<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('jenis'));
	}
}
