<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dtrole extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Dtrole_model');
	}

	public function index()
	{
		$username = $_SESSION['id_peg'];
		if ($username != "") {
			$data['title'] = 'Data Detail Role';
			$data['data_dtrole'] = $this->Dtrole_model->select_dtrole();
			$this->load->view('template/header', $data);
			$this->load->view('template/sidebar', $data);
			$this->load->view('dtrole/index', $data);
			$this->load->view('template/footer');
		} else {
			redirect('log');
		}
	}


	public function prosesinput()
	{

		$id_peg = $this->input->post('id_peg');
		$id_role = $this->input->post('id_role');

		$data = [
			'id_peg' => $id_peg,
			'id_role' => $id_role,
		];

		$this->Dtrole_model->input($data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data Berhasil disimpan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('dtrole'));
	}

	//save data ke database
	public function prosesupdate()
	{

		$id_peg = $this->input->post('id_peg');
		$id_role = $this->input->post('id_role');

		$data = [
			'id_peg' => $id_peg,
			'id_role' => $id_role,
		];

		$this->Dtrole_model->update($this->input->post('id_dtrole'), $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data Berhasil diubah<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('dtrole'));
	}

	public function delete($id)
	{

		$this->Dtrole_model->delete_data($id);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data Berhasil dihapus<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('dtrole'));
	}
}
