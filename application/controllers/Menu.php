<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Menu_model');
	}

	public function index()
	{
		$username = $_SESSION['id_peg'];
		if ($username != "") {
			$data['title'] = 'Data Menu';
			$data['data_menu'] = $this->Menu_model->select_menu();
			$this->load->view('template/header', $data);
			$this->load->view('template/sidebar', $data);
			$this->load->view('menu/index', $data);
			$this->load->view('template/footer');
		} else {
			redirect('log');
		}
	}

	public function prosesinput()
	{
		$id_treeview = $this->input->post('id_treeview');
		$nm_menu = $this->input->post('nm_menu');
		$link_akses = $this->input->post('link_akses');
		$icon_menu = $this->input->post('icon_menu');
		$status_mn = $this->input->post('status_mn');

		$data = [
			'id_treeview' => $id_treeview,
			'nm_menu' => $nm_menu,
			'link_akses' => $link_akses,
			'icon_menu' => $icon_menu,
			'status_mn' => $status_mn,
		];

		$this->Menu_model->input($data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data Berhasil disimpan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('menu'));
	}

	//save data ke database
	public function prosesupdate()
	{

		$id_treeview = $this->input->post('id_treeview');
		$nm_menu = $this->input->post('nm_menu');
		$link_akses = $this->input->post('link_akses');
		$icon_menu = $this->input->post('icon_menu');
		$status_mn = $this->input->post('status_mn');


		$data = [
			'id_treeview' => $id_treeview,
			'nm_menu' => $nm_menu,
			'link_akses' => $link_akses,
			'icon_menu' => $icon_menu,
			'status_mn' => $status_mn,
		];

		$this->Menu_model->update($this->input->post('id_menu'), $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data Berhasil diubah<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('menu'));
	}


	public function delete($id)
	{

		$this->Menu_model->delete_data($id);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data Berhasil dihapus<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('menu'));
	}
}
