<?php
defined('BASEPATH') or exit('No direct script access allowed');

class StaffPpk extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('StaffPpk_model');
	}

	public function index()
	{
		$username = $_SESSION['id_peg'];
		$cek_data = $this->db->query("SELECT COUNT(id_aksesmn) AS ada_tidak FROM aksesmn 
		INNER JOIN menu ON menu.`id_menu`=aksesmn.`id_menu`
		INNER JOIN pegawai ON pegawai.`id_peg`=aksesmn.`id_peg` WHERE pegawai.id_peg='$username' 
		AND menu.`id_menu`='18'")->result();
		foreach ($cek_data as $ck_data) :
			if ($username != "" && $ck_data->ada_tidak != "0") {
				$data['title'] = 'Data Ajuan';
				$data['data_ajuan'] = $this->StaffPpk_model->select_ajuan();
				$this->load->view('template/header', $data);
				$this->load->view('template/sidebar', $data);
				$this->load->view('ppk/indexstaff', $data);
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

		$query_ditolak = $this->db->query("UPDATE ajuan SET `catatan` = '$alasan', `status` = 'Ditolak Staff PPK' WHERE `id_ajuan` = '$idajuan'");
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Alasan Berhasil disimpan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('staffppk'));
	}

	public function setuju()
	{
		$idajuan = $this->input->post('idajuan');
		$metode = $this->input->post('metode');
		$no_spby = $this->input->post('no_spby');
		$tgl_spby = $this->input->post('tgl_spby');
		$jml_spby = $this->input->post('jml_spby');
		$no_spp = $this->input->post('no_spp');
		$tgl_spp = $this->input->post('tgl_spp');
		$jml_spp = $this->input->post('jml_spp');

		if ($metode == "SPP") {
			$query_setuju = $this->db->query("UPDATE ajuan SET mtd_byr='$metode', no_spp='$no_spp', tgl_spp='$tgl_spp', jml_spp='$jml_spp' WHERE id_ajuan = '$idajuan'");
		} else {
			$query_setuju = $this->db->query("UPDATE ajuan SET mtd_byr='$metode', no_spby='$no_spby', tgl_spby='$tgl_spby', jml_spby='$jml_spby' WHERE id_ajuan = '$idajuan'");
		}

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Berhasil disetujui<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('staffppk'));
	}

	public function spp_spby($id)
	{
		$username = $_SESSION['id_peg'];
		$cek_data = $this->db->query("SELECT COUNT(id_aksesmn) AS ada_tidak FROM aksesmn 
    INNER JOIN menu ON menu.id_menu=aksesmn.id_menu
    INNER JOIN pegawai ON pegawai.id_peg=aksesmn.id_peg WHERE pegawai.id_peg='$username' 
    AND menu.id_menu='19'")->result();
		foreach ($cek_data as $ck_data) :
			if ($username != "" && $ck_data->ada_tidak != "0") {
				$data['title'] = 'SPP/SPBY';
				$data['sql'] = "SELECT * FROM ajuan WHERE id_ajuan='$id'";
				$this->load->view('template/header', $data);
				$this->load->view('template/sidebar', $data);
				$this->load->view('ppk/spp_spby', $data);
				$this->load->view('template/footer');
			} else if ($username != "" && $ck_data->ada_tidak == "0") {
				$this->load->view('errors/error_404');
			} else {
				redirect('log');
			}
		endforeach;
	}
}
