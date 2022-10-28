<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Treeview extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Treeview_model');
	}

	public function index()
	{
		$username = $_SESSION['id_peg'];
		if ($username != "") {
			$data['title'] = 'Data Menu Utama';
			$data['data_treeview'] = $this->Treeview_model->select_treeview();

			$this->load->view('template/header', $data);
			$this->load->view('template/sidebar', $data);
			$this->load->view('treeview/index', $data);
			$this->load->view('template/footer');
		} else {
			redirect('log');
		}
	}


	public function prosesinput()
	{
		$nama_treeview = $this->input->post('nama_treeview');
		$treeview_icon = $this->input->post('treeview_icon');

		$data = [
			'nama_treeview' => $nama_treeview,
			'treeview_icon' => $treeview_icon,
		];

		$this->Treeview_model->input($data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data Berhasil disimpan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('treeview'));
	}

	//save data ke database
	public function prosesupdate()
	{
		$nama_treeview = $this->input->post('nama_treeview');
		$treeview_icon = $this->input->post('treeview_icon');

		$data = [
			'nama_treeview' => $nama_treeview,
			'treeview_icon' => $treeview_icon,
		];

		$this->Treeview_model->update($this->input->post('id_treeview'), $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data Berhasil diubah<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('treeview'));
	}

	public function delete($id)
	{

		$this->Treeview_model->delete_data($id);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data Berhasil dihapus<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('treeview'));
	}
}
