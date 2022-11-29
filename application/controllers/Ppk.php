<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ppk extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Ppk_model');
	}

	public function index()
	{
		$username = $_SESSION['id_peg'];
		$cek_data = $this->db->query("SELECT COUNT(id_aksesmn) AS ada_tidak FROM aksesmn 
		INNER JOIN menu ON menu.`id_menu`=aksesmn.`id_menu`
		INNER JOIN pegawai ON pegawai.`id_peg`=aksesmn.`id_peg` WHERE pegawai.id_peg='$username' 
		AND menu.`id_menu`='20'")->result();
		foreach ($cek_data as $ck_data) :
			if ($username != "" && $ck_data->ada_tidak != "0") {
				$data['title'] = 'PPK - Data Ajuan';
				$data['data_ajuan'] = $this->Ppk_model->select_ajuan();
				$this->load->view('template/header', $data);
				$this->load->view('template/sidebar', $data);
				$this->load->view('ppk/index', $data);
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
		$id_peg = $_SESSION['id_peg'];

		$alasan = $this->input->post('alasan');
		$idajuan = $this->input->post('idajuan');

		$query_update = $this->db->query("UPDATE ajuan SET `catatan` = '$alasan', `status` = 'Ditolak PPK' WHERE `id_ajuan` = '$idajuan'");
		$query_ditolak = $this->db->query("INSERT INTO catatan SET id_ajuan = '$idajuan', oleh_role = 'PPK', isi_catatan = '$alasan'");
		$get_ajuan = $this->db->query("SELECT date_updated FROM ajuan WHERE id_ajuan='$idajuan'")->result();
		foreach ($get_ajuan as $ajuan_data) :
			$inputmonitoring = $this->db->query("INSERT INTO monitoring 
			SET id_ajuan = '$idajuan', id_peg = '$id_peg', status = 'Ditolak PPK', tgl_monitor = '$ajuan_data->date_updated' ");
		endforeach;

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Alasan Berhasil disimpan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('ppk'));
	}

	public function setujui()
	{
		$id_pegawai = $_SESSION['id_peg'];
		$idajuan = $this->input->post('idajuan');
		$ppk_staff = $this->input->post('ppk_staff');
		$metode = $this->input->post('metode');
		$jumlah_data = count($ppk_staff);
		for ($i = 0; $i < $jumlah_data; $i++) {
			$id_peg = $this->input->post('ppk_staff[' . $i . ']');

			$query_ditolak = $this->db->query("INSERT INTO pj (id_peg, id_ajuan) VALUES ('$id_peg','$idajuan')");
		}
		$query_ditolak = $this->db->query("UPDATE ajuan SET `mtd_byr` = '$metode', `status` = 'Proses SPP/SPBY' WHERE `id_ajuan` = '$idajuan'");

		$get_ajuan = $this->db->query("SELECT date_updated FROM ajuan WHERE id_ajuan='$idajuan'")->result();
		foreach ($get_ajuan as $ajuan_data) :
			$inputmonitoring = $this->db->query("INSERT INTO monitoring 
			SET id_ajuan = '$idajuan', id_peg = '$id_pegawai', status = 'Ajuan di PPK', tgl_monitor = '$ajuan_data->date_updated' ");
		endforeach;

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Berhasil disetujui<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('ppk'));
	}

	public function setuju($id)
	{
		$id_pegawai = $_SESSION['id_peg'];
		$query_ditolak = $this->db->query("UPDATE ajuan SET `status` = 'Proses SPM' WHERE `id_ajuan` = '$id'");
		$get_ajuan = $this->db->query("SELECT date_updated FROM ajuan WHERE id_ajuan='$id'")->result();
		foreach ($get_ajuan as $ajuan_data) :
			$inputmonitoring = $this->db->query("INSERT INTO monitoring 
			SET id_ajuan = '$id', id_peg = '$id_pegawai', status = 'Proses SPM', tgl_monitor = '$ajuan_data->date_updated' ");
		endforeach;
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Berhasil disetujui<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('ppk'));
	}




	public function pilih_staffppk($id)
	{
		$username = $_SESSION['id_peg'];
		$cek_data = $this->db->query("SELECT COUNT(id_aksesmn) AS ada_tidak FROM aksesmn 
		INNER JOIN menu ON menu.`id_menu`=aksesmn.`id_menu`
		INNER JOIN pegawai ON pegawai.`id_peg`=aksesmn.`id_peg` WHERE pegawai.id_peg='$username' 
		AND menu.`id_menu`='17'")->result();
		foreach ($cek_data as $ck_data) :
			if ($username != "" && $ck_data->ada_tidak != "0") {
				$data['title'] = 'Pilih Staff PPK';
				$data['sql'] = "SELECT * FROM ajuan WHERE id_ajuan='$id'";
				$this->load->view('template/header', $data);
				$this->load->view('template/sidebar', $data);
				$this->load->view('ppk/pilih_ppk', $data);
				$this->load->view('template/footer');
			} else if ($username != "" && $ck_data->ada_tidak == "0") {
				$this->load->view('errors/error_404');
			} else {
				redirect('log');
			}
		endforeach;
	}

	function tampilkan_ppk()
	{
		$id_staffppk = $this->input->get('id_staffppk');
		$no = $this->input->get('no');
		$get_nmppk = $this->db->query("SELECT * FROM pegawai WHERE id_peg='$id_staffppk'")->result();
		foreach ($get_nmppk as $nm_ppk) {
			echo '<table id="example1" class="table table-bordered table-striped">';

			echo '<tr class="row-keranjang' . $no . '"> 
<td style="width: 630px;">' . $nm_ppk->nm_peg . '<input type="hidden" name="ppk_staff[]" id="ppk_staff[]" placeholder="0" class="form-control" readonly value="' . $id_staffppk . '"></td>
<td><button type="button" class="btn btn-danger btn-sm" onclick="hapus(' . $no . ')">Hapus</button></td></tr>';
		}
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
