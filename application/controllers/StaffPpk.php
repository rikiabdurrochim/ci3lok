<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Staffppk extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Staffppk_model');
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
				$data['title'] = 'Staff PPK - Data Ajuan';
				$data['data_ajuan'] = $this->Staffppk_model->select_ajuan();
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
		$id_pegawai = $_SESSION['id_peg'];
		$alasan = $this->input->post('alasan');
		$idajuan = $this->input->post('idajuan');

		$query_update = $this->db->query("UPDATE ajuan SET `catatan` = '$alasan', `status` = 'Ditolak Staff PPK' WHERE `id_ajuan` = '$idajuan'");
		$query_ditolak = $this->db->query("INSERT INTO catatan SET id_ajuan = '$idajuan', oleh_role = 'Staff PPK', isi_catatan = '$alasan'");
		$get_ajuan = $this->db->query("SELECT date_updated FROM ajuan WHERE id_ajuan='$idajuan'")->result();
		foreach ($get_ajuan as $ajuan_data) :
			$inputmonitoring = $this->db->query("INSERT INTO monitoring 
			SET id_ajuan = '$idajuan', id_peg = '$id_pegawai', status = 'Ditolak PPK', tgl_monitor = '$ajuan_data->date_updated' ");
		endforeach;
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Alasan Berhasil disimpan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('staffppk'));
	}

	public function setuju()
	{
		$id_pegawai = $_SESSION['id_peg'];
		$idajuan = $this->input->post('idajuan');
		$metode = $this->input->post('metode');
		$no_spby = $this->input->post('no_spby');
		$tgl_spby = $this->input->post('tgl_spby');
		$jml_spby = $this->input->post('jml_spby');
		$no_spp = $this->input->post('no_spp');
		$tgl_spp = $this->input->post('tgl_spp');
		$jml_spp = $this->input->post('jml_spp');
		$status = $this->input->post('status');
		$dari = $this->input->post('dari');

		$get_ppk = $this->db->query("SELECT role.`nm_role` FROM role
		JOIN dtrole ON dtrole.`id_role`=role.`id_role`
		JOIN pegawai ON pegawai.`id_peg`=dtrole.`id_peg`
		WHERE pegawai.`id_peg`='$id_pegawai' AND (role.`nm_role`='Staf PPK 1' OR role.`nm_role`='Staf PPK 2'
		OR role.`nm_role`='Staf PPK 3' OR role.`nm_role`='Staf PPK 3' OR role.`nm_role`='Staf PPK 5')")->result();
		foreach ($get_ppk as $datappk) :
			if ($datappk->nm_role == 'Staf PPK 1') {
				$query_notif = $this->db->query("UPDATE notif_ajuan SET status_ajuan='SPP/SPBY selesai', notif_penerima='PPK 1' Where id_ajuan='$idajuan'");
			} elseif ($datappk->nm_role == 'Staf PPK 2') {
				$query_notif = $this->db->query("UPDATE notif_ajuan SET status_ajuan='SPP/SPBY selesai', notif_penerima='PPK 2' Where id_ajuan='$idajuan'");
			} elseif ($datappk->nm_role == 'Staf PPK 3') {
				$query_notif = $this->db->query("UPDATE notif_ajuan SET status_ajuan='SPP/SPBY selesai', notif_penerima='PPK 3' Where id_ajuan='$idajuan'");
			} elseif ($datappk->nm_role == 'Staf PPK 4') {
				$query_notif = $this->db->query("UPDATE notif_ajuan SET status_ajuan='SPP/SPBY selesai', notif_penerima='PPK 4' Where id_ajuan='$idajuan'");
			} else {
				$query_notif = $this->db->query("UPDATE notif_ajuan SET status_ajuan='SPP/SPBY selesai', notif_penerima='PPK 5' Where id_ajuan='$idajuan'");
			}
		endforeach;
		if ($status == "Proses SPP/SPBY") {
			if ($metode == "SPP") {
				$query_setuju = $this->db->query("UPDATE ajuan SET mtd_byr='$metode', no_spp='$no_spp', tgl_spp='$tgl_spp', jml_spp='$jml_spp' WHERE id_ajuan = '$idajuan'");
			} else {
				$query_setuju = $this->db->query("UPDATE ajuan SET mtd_byr='$metode', no_spby='$no_spby', tgl_spby='$tgl_spby', jml_spby='$jml_spby' WHERE id_ajuan = '$idajuan'");
			}
			$get_ajuan = $this->db->query("SELECT date_updated FROM ajuan WHERE id_ajuan='$idajuan'")->result();
			foreach ($get_ajuan as $ajuan_data) :
				$inputmonitoring = $this->db->query("INSERT INTO monitoring 
			SET id_ajuan = '$idajuan', id_peg = '$id_pegawai', status = 'Ajuan di staf PPK', tgl_monitor = '$ajuan_data->date_updated' ");
			endforeach;
		} else if ($status == "Ditolak Staff PPSPM") {
			if ($metode == "SPP") {
				$query_setuju = $this->db->query("UPDATE ajuan SET mtd_byr='$metode', no_spp='$no_spp', tgl_spp='$tgl_spp', jml_spp='$jml_spp', status='Proses SPP/SPBY' WHERE id_ajuan = '$idajuan'");
			} else {
				$query_setuju = $this->db->query("UPDATE ajuan SET mtd_byr='$metode', no_spby='$no_spby', tgl_spby='$tgl_spby', jml_spby='$jml_spby', status='Proses SPP/SPBY'  WHERE id_ajuan = '$idajuan'");
			}
		} else if ($status == "Ditolak PPK") {
			if ($metode == "SPP") {
				$query_setuju = $this->db->query("UPDATE ajuan SET mtd_byr='$metode', no_spp='$no_spp', tgl_spp='$tgl_spp', jml_spp='$jml_spp', status='Proses SPP/SPBY' WHERE id_ajuan = '$idajuan'");
			} else {
				$query_setuju = $this->db->query("UPDATE ajuan SET mtd_byr='$metode', no_spby='$no_spby', tgl_spby='$tgl_spby', jml_spby='$jml_spby', status='Proses SPP/SPBY'  WHERE id_ajuan = '$idajuan'");
			}
			$get_ajuan = $this->db->query("SELECT date_updated FROM ajuan WHERE id_ajuan='$idajuan'")->result();
			foreach ($get_ajuan as $ajuan_data) :
				$inputmonitoring = $this->db->query("INSERT INTO monitoring 
			SET id_ajuan = '$idajuan', id_peg = '$id_pegawai', status = 'Ajuan diperbaiki Staf PPK', tgl_monitor = '$ajuan_data->date_updated' ");
			endforeach;
		} else {
		}

		$get_ajuan = $this->db->query("SELECT id_ajuan FROM ajuan WHERE id_ajuan='$idajuan'")->result_array();
		foreach ($get_ajuan as $ajuan_data) :
			$this->load->library('upload');
			$dataInfo = array();
			$files = $_FILES;
			$jumlahberkas = count($_FILES['nama_file']['name']);
			for ($i = 0; $i < $jumlahberkas; $i++) {
				$_FILES['nama_file']['name'] = $files['nama_file']['name'][$i];
				$_FILES['nama_file']['type'] = $files['nama_file']['type'][$i];
				$_FILES['nama_file']['tmp_name'] = $files['nama_file']['tmp_name'][$i];
				$_FILES['nama_file']['error'] = $files['nama_file']['error'][$i];
				$_FILES['nama_file']['size'] = $files['nama_file']['size'][$i];

				$this->upload->initialize($this->upload_berkas());
				$this->upload->do_upload('nama_file');
				$dataInfo[] = $this->upload->data();
				$data_berkas = array(
					'id_ajuan' => $ajuan_data['id_ajuan'],
					'nama_file' => $dataInfo[$i]['file_name'],
					'status_file' => 'staff ppk',
				);

				$this->db->insert('file_dukung', $data_berkas);
			}
		endforeach;

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Berhasil disetujui<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		if ($dari == "staffppk") {
			redirect(site_url('staffppk'));
		} else {
			redirect(site_url('ppk'));
		}
	}

	public function spp_spby($id, $dari)
	{
		$username = $_SESSION['id_peg'];
		$cek_data = $this->db->query("SELECT COUNT(id_aksesmn) AS ada_tidak FROM aksesmn 
    INNER JOIN menu ON menu.id_menu=aksesmn.id_menu
    INNER JOIN pegawai ON pegawai.id_peg=aksesmn.id_peg WHERE pegawai.id_peg='$username' 
    AND menu.id_menu='19'")->result();
		foreach ($cek_data as $ck_data) :
			if ($username != "" && $ck_data->ada_tidak != "0") {
				$data['title'] = 'SPP/SPBY';
				$data['dari'] = $dari;
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



	function upload_berkas()
	{
		$config = array();
		$config['upload_path'] = './assets/file_dukung';
		$config['allowed_types'] = 'pdf|xlsx|xls';
		return $config;
	}
}
