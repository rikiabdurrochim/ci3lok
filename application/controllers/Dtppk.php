<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dtppk extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Dtppk_model');
	}

	public function index()
	{
		$username = $_SESSION['id_peg'];
		$cek_data = $this->db->query("SELECT COUNT(id_aksesmn) AS ada_tidak FROM aksesmn 
		INNER JOIN menu ON menu.`id_menu`=aksesmn.`id_menu`
		INNER JOIN pegawai ON pegawai.`id_peg`=aksesmn.`id_peg` WHERE pegawai.id_peg='$username' 
		AND menu.`id_menu`='31'")->result();
		foreach ($cek_data as $ck_data) :
			if ($username != "" && $ck_data->ada_tidak != "0") {
				$data['title'] = 'PPK per Kegiatan';
				$data['data_dtppk'] = $this->Dtppk_model->select_dtppk();
				$this->load->view('template/header', $data);
				$this->load->view('template/sidebar', $data);
				$this->load->view('dtppk/index', $data);
				$this->load->view('template/footer');
			} else if ($username != "" && $ck_data->ada_tidak == "0") {
				$this->load->view('errors/error_404');
			} else {
				redirect('log');
			}
		endforeach;
	}


	public function prosesinput()
	{
		$id_peg = $this->input->post('id_peg');
		$id_giat = $this->input->post('id_giat');

		$data = [
			'id_peg' => $id_peg,
			'id_giat' => $id_giat,
		];

		$get_dt = $this->db->query("SELECT COUNT(id_dtppk) AS ada_tidak FROM dtppk 
		WHERE id_giat='$id_giat'");
		foreach ($get_dt->result() as $dt) {
			if ($dt->ada_tidak == '0') {
				$this->Dtppk_model->input($data);
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data Berhasil Disimpan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect(site_url('dtppk'));
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Data Sudah Ada<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect(site_url('dtppk'));
			}
		}
	}

	//save data ke database
	public function prosesupdate()
	{

		$id_peg = $this->input->post('id_peg');
		$id_giat = $this->input->post('id_giat');

		$data = [
			'id_peg' => $id_peg,
			'id_giat' => $id_giat,
		];

		$get_dt = $this->db->query("SELECT COUNT(id_dtppk) AS ada_tidak FROM dtppk 
		WHERE id_giat='$id_giat'");
		foreach ($get_dt->result() as $dt) {
			if ($dt->ada_tidak == '0') {
				$this->Dtppk_model->update($this->input->post('id_dtppk'), $data);
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data Berhasil diubah<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect(site_url('dtppk'));
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Data Sudah Ada<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect(site_url('dtppk'));
			}
		}
	}

	public function delete($id)
	{

		$this->Dtppk_model->delete_data($id);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data Berhasil dihapus<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('dtppk'));
	}
}
