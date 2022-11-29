<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Unitgiat extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Unitgiat_model');
	}

	public function index()
	{
		$username = $_SESSION['id_peg'];
		$cek_data = $this->db->query("SELECT COUNT(id_aksesmn) AS ada_tidak FROM aksesmn 
		INNER JOIN menu ON menu.`id_menu`=aksesmn.`id_menu`
		INNER JOIN pegawai ON pegawai.`id_peg`=aksesmn.`id_peg` WHERE pegawai.id_peg='$username' 
		AND menu.`id_menu`='33'")->result();
		foreach ($cek_data as $ck_data) :
			if ($username != "" && $ck_data->ada_tidak != "0") {
				$data['title'] = 'Pegawai Unit per Kegiatan';
				$data['data_unitgiat'] = $this->Unitgiat_model->select_unitgiat();
				$this->load->view('template/header', $data);
				$this->load->view('template/sidebar', $data);
				$this->load->view('unitgiat/index', $data);
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
		$id_unit = $this->input->post('id_unit');
		$id_giat = $this->input->post('id_giat');

		$data = [
			'id_unit' => $id_unit,
			'id_giat' => $id_giat,
		];

		$get_dt = $this->db->query("SELECT COUNT(id_unitgiat) AS ada_tidak FROM unitgiat 
		WHERE id_giat='$id_giat' AND id_unit='$id_unit'");
		foreach ($get_dt->result() as $dt) {
			if ($dt->ada_tidak == '0') {
				$this->Unitgiat_model->input($data);
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data Berhasil disimpan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect(site_url('unitgiat'));
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Data Sudah Ada<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect(site_url('unitgiat'));
			}
		}
	}

	//save data ke database
	public function prosesupdate()
	{
		$id_unit = $this->input->post('id_unit');
		$id_giat = $this->input->post('id_giat');

		$data = [
			'id_unit' => $id_unit,
			'id_giat' => $id_giat,
		];

		$get_dt = $this->db->query("SELECT COUNT(id_unitgiat) AS ada_tidak FROM unitgiat 
		WHERE id_giat='$id_giat' AND id_unit='$id_unit'");
		foreach ($get_dt->result() as $dt) {
			if ($dt->ada_tidak == '0') {
				$this->Unitgiat_model->update($this->input->post('id_unitgiat'), $data);
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data Berhasil diubah<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect(site_url('unitgiat'));
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Data Sudah Ada<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect(site_url('unitgiat'));
			}
		}
	}

	public function delete($id)
	{
		$this->Unitgiat_model->delete_data($id);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data Berhasil dihapus<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('unitgiat'));
	}
}
