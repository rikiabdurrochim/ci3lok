<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Unit extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Unit_model', 'Unit');
	}

	public function index()
	{
		$username = $_SESSION['id_peg'];
		if ($username != "") {
			$data['title'] = 'Data Unit';
			$data['data_unit'] = $this->Unit->select_unit();

			$this->load->view('template/header', $data);
			$this->load->view('template/sidebar', $data);
			$this->load->view('unit/index', $data);
			$this->load->view('template/footer');
		} else {
			redirect('log');
		}
	}


	public function prosesinput()
	{
		$nm_unit = $this->input->post('nm_unit');

		$data = [
			'nm_unit' => $nm_unit,
		];

		$this->Unit->input($data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data Berhasil disimpan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('unit'));
	}

	//save data ke database
	public function prosesupdate()
	{


		$nm_unit = $this->input->post('nm_unit');

		$data = [

			'nm_unit' => $nm_unit,
		];

		$this->Unit->update($this->input->post('id_unit'), $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data Berhasil diubah<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('unit'));
	}

	public function delete($id)
	{

		$this->Unit->delete_data($id);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data Berhasil dihapus<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('unit'));
	}
}
