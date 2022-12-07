<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Loket extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Loket_model');
	}

	public function index()
	{
		$username = $_SESSION['id_peg'];
		$cek_data = $this->db->query("SELECT COUNT(id_aksesmn) AS ada_tidak FROM aksesmn 
		INNER JOIN menu ON menu.`id_menu`=aksesmn.`id_menu`
		INNER JOIN pegawai ON pegawai.`id_peg`=aksesmn.`id_peg` WHERE pegawai.id_peg='$username' 
		AND menu.`id_menu`='16'")->result();
		foreach ($cek_data as $ck_data) :
			if ($username != "" && $ck_data->ada_tidak != "0") {
				$data['title'] = 'Loket - Data Ajuan';
				$data['data_ajuan'] = $this->Loket_model->select_ajuan();
				$this->load->view('template/header', $data);
				$this->load->view('template/sidebar', $data);
				$this->load->view('loket/index', $data);
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
		$id_peg = $_SESSION['id_peg'];

		$query_update = $this->db->query("UPDATE ajuan SET `catatan` = '$alasan', `status` = 'Ditolak Loket' WHERE `id_ajuan` = '$idajuan'");
		$query_ditolak = $this->db->query("INSERT INTO catatan SET id_ajuan = '$idajuan', oleh_role = 'Loket', isi_catatan = '$alasan'");
		$get_ajuan = $this->db->query("SELECT date_updated FROM ajuan WHERE id_ajuan='$idajuan'")->result();
		foreach ($get_ajuan as $ajuan_data) :
			$inputmonitoring = $this->db->query("INSERT INTO monitoring 
			SET id_ajuan = '$idajuan', id_peg = '$id_peg', status = 'Ajuan Ditolak Loket', tgl_monitor = '$ajuan_data->date_updated' ");
		endforeach;
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Alasan Berhasil disimpan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('loket'));
	}

	public function setujui($id)
	{
		$id_peg = $_SESSION['id_peg'];

		$query_ditolak = $this->db->query("UPDATE ajuan SET `status` = 'Proses SPP/SPBY' WHERE `id_ajuan` = '$id'");
		$get_ajuan = $this->db->query("SELECT date_updated, kd_giat FROM ajuan WHERE id_ajuan='$id'")->result();
		foreach ($get_ajuan as $ajuan_data) :
			$inputmonitoring = $this->db->query("INSERT INTO monitoring 
			SET id_ajuan = '$id', id_peg = '$id_peg', status = 'Proses SPP/SPBY', tgl_monitor = '$ajuan_data->date_updated' ");
			$get_ppk = $this->db->query("SELECT role.`nm_role` FROM dtrole 
	INNER JOIN role ON role.`id_role`=dtrole.`id_role` 
	INNER JOIN dtppk ON dtppk.`id_peg`=dtrole.`id_peg` 
	WHERE dtppk.`id_giat` = '$ajuan_data->kd_giat' AND (role.`nm_role` = 'PPK 1' 
	OR role.`nm_role` = 'PPK 2' OR role.`nm_role` = 'PPK 3'
	OR role.`nm_role` = 'PPK 4' OR role.`nm_role` = 'PPK 5')")->result();
			foreach ($get_ppk as $gp) :
				$query_notif = $this->db->query("UPDATE notif_ajuan SET `status_ajuan` = 'Proses SPP/SPBY', notif_penerima='$gp->nm_role' 
				WHERE `id_ajuan` = '$id'");
			endforeach;
		endforeach;

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Berhasil disetujui<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('loket'));
	}
}
