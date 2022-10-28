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
	public function tambah()
	{
		$data['title'] = 'Input Data';
		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('pegawai/forminput', $data);
		$this->load->view('template/footer');
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



	//untuk tampil data ke form edit
	public function update($id)
	{
		$title = 'Update Pegawai';
		$data_pegawai = $this->db->query("SELECT * FROM pegawai WHERE id_peg ='$id'")->result();
		foreach ($data_pegawai as $row) :

			if ($row) {
				$data = array(
					'title' => $title,
					'username' => set_value('username', $row->username),
					'password' => set_value('password', $row->password),
					'email' => set_value('email', $row->email),
					'id_peg' => set_value('id_peg', $row->id_peg),
					'nm_peg' => set_value('nm_peg', $row->nm_peg),
					'alamat_peg' => set_value('alamat_peg', $row->alamat_peg),
					'nik' => set_value('nik', $row->nik),
					'pangkat' => set_value('pangkat', $row->pangkat),
					'gol' => set_value('gol', $row->gol),
					'jabatan' => set_value('jabatan', $row->jabatan),
					'unit' => set_value('unit', $row->unit),
					'jk' => set_value('jk', $row->jk),
				);

				$this->load->view('template/header', $data);
				$this->load->view('template/sidebar', $data);
				$this->load->view('pegawai/formedit', $data);
				$this->load->view('template/footer');
			} else {
				redirect(site_url('pegawai'));
			}
		endforeach;
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
		INNER JOIN role ON role.`id_role`=aksesmn.`id_role`
		INNER JOIN dtrole ON dtrole.`id_role`=role.`id_role`
		INNER JOIN pegawai ON pegawai.`id_peg`=dtrole.`id_peg` WHERE pegawai.id_peg='$username' 
		AND menu.`id_menu`='12'")->result();
		foreach ($cek_data as $ck_data) :

			if ($username != "" && $ck_data->ada_tidak != "0") {
				$this->Pegawai_model->delete_data($id);
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data Berhasil dihapus<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect(site_url('pegawai'));
			} else if ($username != "" && $ck_data->ada_tidak == "0") {
				$this->load->view('errors/error_404');
			} else {
				redirect('log');
			}
		endforeach;
	}
}
