<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hkakses extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Hkakses_model');
	}

	public function index()
	{
		$username = $_SESSION['id_peg'];
		if ($username != "") {
			$data['title'] = 'Data Hak Akses';
			$data['data_hkakses'] = $this->Hkakses_model->select_hkakses();

			$this->load->view('template/header', $data);
			$this->load->view('template/sidebar', $data);
			$this->load->view('hkakses/index', $data);
			$this->load->view('template/footer');
		} else {
			redirect('log');
		}
	}


	public function prosesinput()
	{

		$id_role = $this->input->post('id_role');
		$id_menu = $this->input->post('id_menu');

		$data = [
			'id_role' => $id_role,
			'id_menu' => $id_menu,

		];

		$this->Hkakses_model->input($data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data Berhasil disimpan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('hkakses'));
	}

	//save data ke database
	public function prosesupdate()
	{

		$id_role = $this->input->post('id_role');
		$id_menu = $this->input->post('id_menu');

		$data = [
			'id_role' => $id_role,
			'id_menu' => $id_menu,
		];

		$this->Hkakses_model->update($this->input->post('id_hkakses'), $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data Berhasil diubah<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('hkakses'));
	}

	public function delete($id)
	{

		$this->Hkakses_model->delete_data($id);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data Berhasil dihapus<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('hkakses'));
	}
}
