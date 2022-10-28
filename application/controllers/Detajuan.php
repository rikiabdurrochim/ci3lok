<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Detajuan extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Detajuan_model');
	}

	public function index()
	{
		$username = $_SESSION['id_peg'];
		if ($username != "") {
			$data['title'] = 'Data Detail Ajuan';
			$data['data_detajuan'] = $this->Detajuan_model->select_detajuan();

			$this->load->view('template/header', $data);
			$this->load->view('template/sidebar', $data);
			$this->load->view('detajuan/index', $data);
			$this->load->view('template/footer');
		} else {
			redirect('log');
		}
	}

	public function prosesinput()
	{

		$id_ajuan = $this->input->post('id_ajuan');
		$transport = $this->input->post('transport');
		$uang_harian = $this->input->post('uang_harian');
		$penginapan = $this->input->post('penginapan');

		$data = [
			'id_ajuan' => $id_ajuan,
			'transport' => $transport,
			'uang_harian' => $uang_harian,
			'penginapan' => $penginapan,
		];

		$this->Detajuan_model->input($data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data Berhasil disimpan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('detajuan'));
	}

	//save data ke database
	public function prosesupdate()
	{

		$id_ajuan = $this->input->post('id_ajuan');
		$transport = $this->input->post('transport');
		$uang_harian = $this->input->post('uang_harian');
		$penginapan = $this->input->post('penginapan');

		$data = [
			'id_ajuan' => $id_ajuan,
			'transport' => $transport,
			'uang_harian' => $uang_harian,
			'penginapan' => $penginapan,
		];

		$this->Detajuan_model->update($this->input->post('id_da'), $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data Berhasil diubah<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('detajuan'));
	}

	public function delete($id)
	{

		$this->Detajuan_model->delete_data($id);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data Berhasil dihapus<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('detajuan'));
	}
}
