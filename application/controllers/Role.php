<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Role extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Role_model');
	}

	public function index()
	{
		$username = $_SESSION['id_peg'];
		if ($username != "") {
			$data['title'] = 'Data Role';
			$data['data_role'] = $this->Role_model->select_role();

			$this->load->view('template/header', $data);
			$this->load->view('template/sidebar', $data);
			$this->load->view('role/index', $data);
			$this->load->view('template/footer');
		} else {
			redirect('log');
		}
	}


	public function prosesinput()
	{


		$nm_role = $this->input->post('nm_role');

		$data = [

			'nm_role' => $nm_role,

		];

		$this->Role_model->input($data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data Berhasil disimpan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('role'));
	}

	//save data ke database
	public function prosesupdate()
	{


		$nm_role = $this->input->post('nm_role');

		$data = [

			'nm_role' => $nm_role,
		];

		$this->Role_model->update($this->input->post('id_role'), $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data Berhasil diubah<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('role'));
	}

	public function delete($id)
	{

		$this->Role_model->delete_data($id);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data Berhasil dihapus<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('role'));
	}
}
