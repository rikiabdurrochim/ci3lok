<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ppspm extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Ppspm_model');
	}

	public function index()
	{
		$username = $_SESSION['id_peg'];
		$cek_data = $this->db->query("SELECT COUNT(id_aksesmn) AS ada_tidak FROM aksesmn 
		INNER JOIN menu ON menu.`id_menu`=aksesmn.`id_menu`
		INNER JOIN pegawai ON pegawai.`id_peg`=aksesmn.`id_peg` WHERE pegawai.id_peg='$username' 
		AND menu.`id_menu`='26'")->result();
		foreach ($cek_data as $ck_data) :
			if ($username != "" && $ck_data->ada_tidak != "0") {
				$data['title'] = 'Data Ajuan';
				$data['data_ajuan'] = $this->Ppspm_model->select_ajuan();
				$this->load->view('template/header', $data);
				$this->load->view('template/sidebar', $data);
				$this->load->view('ppspm/index', $data);
				$this->load->view('template/footer');
			} else if ($username != "" && $ck_data->ada_tidak == "0") {
				$this->load->view('errors/error_404');
			} else {
				redirect('log');
			}
		endforeach;
	}




	public function ditolak()
	{
		$alasan = $this->input->post('alasan');
		$idajuan = $this->input->post('idajuan');

		$query_ditolak = $this->db->query("UPDATE ajuan SET `catatan` = '$alasan', `status` = 'Ditolak PPSPM' WHERE `id_ajuan` = '$idajuan'");
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Alasan Berhasil disimpan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('Ppspm'));
	}

	public function terima($id)
	{

		$query_setuju = $this->db->query("UPDATE ajuan SET status = 'Kirim KPPN' WHERE id_ajuan = '$id'");

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Berhasil disetujui<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('Ppspm'));
	}

	public function edit()
	{
		$idajuan = $this->input->post('idajuan');
		$kd_akun = $this->input->post('kd_akun');

		$query_update = $this->db->query("UPDATE ajuan SET kd_akun='$kd_akun' WHERE id_ajuan = '$idajuan'");

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Berhasil diupdate<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('Ppspm'));
	}
}
