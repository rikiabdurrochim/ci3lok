<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dtadk extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Dtadk_model');
	}


	public function index()
	{
		$username = $_SESSION['id_peg'];
		if ($username != "") {
			$data['title'] = 'Detail ADK';
			$data['data_dtadk'] = $this->Dtadk_model->select_dtadk();
			$this->load->view('template/header', $data);
			$this->load->view('template/sidebar', $data);
			$this->load->view('dtadk/index', $data);
			$this->load->view('template/footer');
		} else {
			redirect('log');
		}
	}


	public function prosesinput()
	{

		$id_jenis = $this->input->post('id_jenis');
		$id_detadk = $this->input->post('id_detadk');

		$data = [
			'id_jenis' => $id_jenis,
			'id_detadk' => $id_detadk,
		];

		$this->Dtadk_model->input($data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data Berhasil disimpan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('dtadk'));
	}

	//save data ke database
	public function prosesupdate()
	{

		$id_jenis = $this->input->post('id_jenis');
		$id_detadk = $this->input->post('id_detadk');

		$data = [
			'id_jenis' => $id_jenis,
			'id_detadk' => $id_detadk,
		];

		$this->Dtadk_model->update($this->input->post('id_dtadk'), $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data Berhasil diubah<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('dtadk'));
	}

	public function delete($id)
	{

		$this->Dtadk_model->delete_data($id);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data Berhasil dihapus<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('dtadk'));
	}
}
