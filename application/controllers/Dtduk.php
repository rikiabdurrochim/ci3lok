<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dtduk extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Dtduk_model');
	}


	public function index()
	{
		$username = $_SESSION['id_peg'];
		if ($username != "") {
			$data['title'] = 'Data Dukung ADK';
			$data['data_dtduk'] = $this->Dtduk_model->select_dtduk();

			$this->load->view('template/header', $data);
			$this->load->view('template/sidebar', $data);
			$this->load->view('dt_dukung/index', $data);
			$this->load->view('template/footer');
		} else {
			redirect('log');
		}
	}


	public function prosesinput()
	{

		$jenis_id = $this->input->post('jenis_id');
		$nm_dt = $this->input->post('nm_dt');

		$data = [
			'jenis_id' => $jenis_id,
			'nm_dt' => $nm_dt,
		];

		$this->Dtduk_model->input($data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data Berhasil disimpan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('dtduk'));
	}

	//save data ke database
	public function prosesupdate()
	{

		$jenis_id = $this->input->post('jenis_id');
		$nm_dt = $this->input->post('nm_dt');

		$data = [
			'jenis_id' => $jenis_id,
			'nm_dt' => $nm_dt,
		];

		$this->Dtduk_model->update($this->input->post('id_dtduk'), $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data Berhasil diubah<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('dtduk'));
	}

	public function delete($id)
	{
		$this->Dtduk_model->delete_data($id);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data Berhasil dihapus<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('dtduk'));
	}
}
