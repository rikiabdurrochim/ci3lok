<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pj extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Pj_model');
	}

	public function index()
	{
		$username = $_SESSION['id_peg'];
		if ($username != "") {
			$data['title'] = 'Data Penanggung Jawab';
			$data['data_pj'] = $this->Pj_model->select_pj();
			
			$this->load->view('template/header', $data);
			$this->load->view('template/sidebar', $data);
			$this->load->view('pj/index', $data);
			$this->load->view('template/footer');
		} else {
			redirect('log');
		}
	}


	public function prosesinput()
	{

		$id_peg = $this->input->post('id_peg');
		$id_ajuan = $this->input->post('id_ajuan');

		$data = [
			'id_peg' => $id_peg,
			'id_ajuan' => $id_ajuan,
		];

		$this->Pj_model->input($data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data Berhasil disimpan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('pj'));
	}

	//save data ke database
	public function prosesupdate()
	{

		$id_peg = $this->input->post('id_peg');
		$id_ajuan = $this->input->post('id_ajuan');

		$data = [
			'id_peg' => $id_peg,
			'id_ajuan' => $id_ajuan,
		];

		$this->Pj_model->update($this->input->post('id_pj'), $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data Berhasil diubah<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('pj'));
	}

	public function delete($id)
	{

		$this->Pj_model->delete_data($id);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data Berhasil dihapus<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('pj'));
	}
}
