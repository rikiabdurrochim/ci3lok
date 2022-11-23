<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bendahara extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Bendahara_model');
	}

	public function index()
	{
		$username = $_SESSION['id_peg'];
		$cek_data = $this->db->query("SELECT COUNT(id_aksesmn) AS ada_tidak FROM aksesmn 
		INNER JOIN menu ON menu.`id_menu`=aksesmn.`id_menu`
		INNER JOIN pegawai ON pegawai.`id_peg`=aksesmn.`id_peg` WHERE pegawai.id_peg='$username' 
		AND menu.`id_menu`='29'")->result();
		foreach ($cek_data as $ck_data) :
			if ($username != "" && $ck_data->ada_tidak != "0") {
				$data['title'] = 'Data Ajuan';
				$data['data_ajuan'] = $this->Bendahara_model->select_ajuan();
				$this->load->view('template/header', $data);
				$this->load->view('template/sidebar', $data);
				$this->load->view('bendahara/index', $data);
				$this->load->view('template/footer');
			} else if ($username != "" && $ck_data->ada_tidak == "0") {
				$this->load->view('errors/error_404');
			} else {
				redirect('log');
			}
		endforeach;
	}

	public function bayar()
	{
		$id_pegawai = $_SESSION['id_peg'];
		$idajuan = $this->input->post('idajuan');
		$mtd_byr_ben = $this->input->post('mtd_byr_ben');
		$tgl_byr = $this->input->post('tgl_byr');
		$jml_byr_ben = $this->input->post('jml_byr_ben');
		$penerima = $this->input->post('penerima');

		$query_byr = $this->db->query("UPDATE ajuan SET status = 'Selesai',
		mtd_byr_ben = '$mtd_byr_ben',
		tgl_byr = '$tgl_byr',
		jml_byr_ben = '$jml_byr_ben',
		penerima = '$penerima'
		WHERE id_ajuan = '$idajuan'");

		$get_ajuan = $this->db->query("SELECT date_updated FROM ajuan WHERE id_ajuan='$idajuan'")->result();
		foreach ($get_ajuan as $ajuan_data) :
			$inputmonitoring = $this->db->query("INSERT INTO monitoring 
	SET id_ajuan = '$idajuan', id_peg = '$id_pegawai', status = 'Selesai', tgl_monitor = '$ajuan_data->date_updated' ");
		endforeach;

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Selesai <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('Bendahara'));
	}
}
