<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Pegawai_model');
	}

	public function index()
	{
		$username = $_SESSION['id_peg'];
		$cek_data = $this->db->query("SELECT COUNT(id_aksesmn) AS ada_tidak FROM aksesmn 
		INNER JOIN menu ON menu.`id_menu`=aksesmn.`id_menu`
		INNER JOIN pegawai ON pegawai.`id_peg`=aksesmn.`id_peg` WHERE pegawai.id_peg='$username' 
		AND menu.`id_menu`='1'")->result();
		foreach ($cek_data as $ck_data) :
			if ($username != "" && $ck_data->ada_tidak != "0") {
				$data['title'] = 'Data Pegawai';
				$data['data_pegawai'] = $this->Pegawai_model->select_pegawai();
				$this->load->view('template/header', $data);
				$this->load->view('template/sidebar', $data);
				$this->load->view('pegawai/index', $data);
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
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$email = $this->input->post('email');
		$nm_peg = $this->input->post('nm_peg');
		$alamat_peg = $this->input->post('alamat_peg');
		$nik = $this->input->post('nik');
		$pangkat = $this->input->post('pangkat');
		$gol = $this->input->post('gol');
		$jabatan = $this->input->post('jabatan');
		$unit = $this->input->post('unit');
		$jk = $this->input->post('jk');
		$foto = $this->upload_foto();
		$images = $foto['file_name'];
		$image = 'default.jpg';

		if ($images == "") {
			$data = [
				'username' => $username,
				'password' => $password,
				'email' => $email,
				'nm_peg' => $nm_peg,
				'alamat_peg' => $alamat_peg,
				'nik' => $nik,
				'pangkat' => $pangkat,
				'gol' => $gol,
				'jabatan' => $jabatan,
				'unit' => $unit,
				'jk' => $jk,
				'foto' => $image,
			];
		} else {
			$data = [
				'username' => $username,
				'password' => $password,
				'email' => $email,
				'nm_peg' => $nm_peg,
				'alamat_peg' => $alamat_peg,
				'nik' => $nik,
				'pangkat' => $pangkat,
				'gol' => $gol,
				'jabatan' => $jabatan,
				'unit' => $unit,
				'jk' => $jk,
				'foto' => $foto['file_name'],
			];
		}
		$this->Pegawai_model->input($data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data Berhasil disimpan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('pegawai'));
	}

	function upload_foto()
	{
		$foto = $this->input->get('foto');
		if ($foto !== '') {
			$config['upload_path']          = './assets/img';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['max_size']             = 2048;
			//$config['max_width']            = 1024;
			//$config['max_height']           = 768;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ($this->upload->do_upload('foto')) {
				echo "oke";
				return $this->upload->data();
			} else {
				echo "not oke";
			}
		} else {
		}
	}

	//save data ke database
	public function prosesupdate()
	{
		$this->load->model('Pegawai_model');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$email = $this->input->post('email');
		$nm_peg = $this->input->post('nm_peg');
		$alamat_peg = $this->input->post('alamat_peg');
		$nik = $this->input->post('nik');
		$pangkat = $this->input->post('pangkat');
		$gol = $this->input->post('gol');
		$jabatan = $this->input->post('jabatan');
		$unit = $this->input->post('unit');
		$jk = $this->input->post('jk');
		$id_peg = $this->input->post('id_peg');
		$foto = $this->upload_foto();
		$images = $foto['file_name'];

		if ($images == "") {
			$data = [
				'username' => $username,
				'password' => $password,
				'email' => $email,
				'nm_peg' => $nm_peg,
				'alamat_peg' => $alamat_peg,
				'nik' => $nik,
				'pangkat' => $pangkat,
				'gol' => $gol,
				'jabatan' => $jabatan,
				'unit' => $unit,
				'jk' => $jk,
			];
		} elseif ($images != "") {
			$delete_foto = $this->db->query("SELECT * FROM pegawai WHERE id_peg='$id_peg'")->result();
			foreach ($delete_foto as $hasil_foto) {
				$target = "assets/img/" . $hasil_foto->foto;
				if (file_exists($target)) {
					unlink($target);
				}
			}

			$data = [
				'username' => $username,
				'password' => $password,
				'email' => $email,
				'nm_peg' => $nm_peg,
				'alamat_peg' => $alamat_peg,
				'nik' => $nik,
				'pangkat' => $pangkat,
				'gol' => $gol,
				'jabatan' => $jabatan,
				'unit' => $unit,
				'jk' => $jk,
				'foto' => $foto['file_name'],
			];
		}

		$this->Pegawai_model->update($this->input->post('id_peg'), $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data Berhasil diupdate<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('pegawai'));
	}



	public function delete($id)
	{
		$username = $_SESSION['id_peg'];
		$cek_data = $this->db->query("SELECT COUNT(id_aksesmn) AS ada_tidak FROM aksesmn 
		INNER JOIN menu ON menu.`id_menu`=aksesmn.`id_menu`
		INNER JOIN pegawai ON pegawai.`id_peg`=aksesmn.`id_peg` WHERE pegawai.id_peg='$username' 
		AND menu.`id_menu`='1'")->result();
		foreach ($cek_data as $ck_data) :
			if ($username != "" && $ck_data->ada_tidak != 0) {
				$this->db->query("UPDATE pegawai SET status_peg = '0' WHERE id_peg = '$id'");
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data Berhasil dihapus<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect(site_url('pegawai'));
			} else if ($username != "" && $ck_data->ada_tidak == 0) {
				$this->load->view('errors/error_404');
			} else {
				redirect('log');
			}
		endforeach;
	}
}
