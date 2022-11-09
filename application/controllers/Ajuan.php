<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ajuan extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Ajuan_model');
	}

	public function index()
	{
		$username = $_SESSION['id_peg'];
		$cek_data = $this->db->query("SELECT COUNT(id_aksesmn) AS ada_tidak FROM aksesmn 
		INNER JOIN menu ON menu.`id_menu`=aksesmn.`id_menu`
		INNER JOIN pegawai ON pegawai.`id_peg`=aksesmn.`id_peg` WHERE pegawai.id_peg='$username' 
		AND menu.`id_menu`='6'")->result();
		foreach ($cek_data as $ck_data) :
			if ($username != "" && $ck_data->ada_tidak != "0") {
				$data['title'] = 'Data Ajuan';
				$data['data_ajuan'] = $this->Ajuan_model->select_ajuan();
				$this->load->view('template/header', $data);
				$this->load->view('template/sidebar', $data);
				$this->load->view('ajuan/index', $data);
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
		$username = $_SESSION['id_peg'];
		$cek_data = $this->db->query("SELECT COUNT(id_aksesmn) AS ada_tidak FROM aksesmn 
		INNER JOIN menu ON menu.`id_menu`=aksesmn.`id_menu`
		INNER JOIN pegawai ON pegawai.`id_peg`=aksesmn.`id_peg` WHERE pegawai.id_peg='$username' 
		AND menu.`id_menu`='13'")->result();
		foreach ($cek_data as $ck_data) :

			if ($username != "" && $ck_data->ada_tidak != "0") {
				$data['title'] = 'Input Data';

				$this->load->view('template/header', $data);
				$this->load->view('template/sidebar', $data);
				$this->load->view('ajuan/forminput', $data);
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

		$no_ajuan = $this->input->post('no_ajuan');
		$tgl_ajuan = $this->input->post('tgl_ajuan');
		$jns_ajuan = $this->input->post('jns_ajuan');
		$no_dok = $this->input->post('no_dok');
		$tgl_dok = $this->input->post('tgl_dok');
		$perihal = $this->input->post('perihal');
		$kd_giat = $this->input->post('kd_giat');
		$kd_akun = $this->input->post('kd_akun');
		$kota = $this->input->post('kota');
		$tgl_jln = $this->input->post('tgl_jln');
		$tgl_plg = $this->input->post('tgl_plg');
		$data_dukung = $this->input->post('data_dukung');
		$jml_ajuan = $this->input->post('jml_ajuan');
		$id_peg = $_SESSION['id_peg'];

		$data = [
			'no_ajuan' => $no_ajuan,
			'tgl_ajuan' => $tgl_ajuan,
			'jns_ajuan' => $jns_ajuan,
			'no_dok' => $no_dok,
			'tgl_dok' => $tgl_dok,
			'perihal' => $perihal,
			'kd_giat' => $kd_giat,
			'kd_akun' => $kd_akun,
			'kota' => $kota,
			'tgl_jln' => $tgl_jln,
			'tgl_plg' => $tgl_plg,
			'data_dukung' => implode(",", $data_dukung),
			'jml_ajuan' => $jml_ajuan,
			'peg_id' => $id_peg,

		];

		$this->Ajuan_model->input($data);

		$get_ajuan = $this->db->query("SELECT id_ajuan FROM ajuan WHERE no_ajuan='$no_ajuan'")->result_array();
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
					'status_file' => 'user',
				);

				$this->db->insert('file_dukung', $data_berkas);
			}
		endforeach;
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data Berhasil disimpan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('ajuan'));
	}



	function upload_berkas()
	{
		$config = array();
		$config['upload_path'] = './assets/file_dukung';
		$config['allowed_types'] = 'pdf|xls|xlsx';

		return $config;
	}


	//untuk tampil data ke form edit
	public function update($id)
	{
		$username = $_SESSION['id_peg'];
		$cek_data = $this->db->query("SELECT COUNT(id_aksesmn) AS ada_tidak FROM aksesmn 
		INNER JOIN menu ON menu.`id_menu`=aksesmn.`id_menu`
		INNER JOIN pegawai ON pegawai.`id_peg`=aksesmn.`id_peg` WHERE pegawai.id_peg='$username' 
		AND menu.`id_menu`='14'")->result();
		foreach ($cek_data as $ck_data) :

			if ($username != "" && $ck_data->ada_tidak != "0") {

				$title = 'Update Ajuan';
				$data_ajuan = $this->db->query("SELECT * FROM ajuan WHERE id_ajuan ='$id'")->result();
				foreach ($data_ajuan as $row) :
					$data_dukung = $row->data_dukung;
					$dt_dukung = explode(',', $data_dukung);

					if ($row) {
						$data = array(
							'title' => $title,
							'id_ajuan' => set_value('id_ajuan', $row->id_ajuan),
							'no_ajuan' => set_value('no_ajuan', $row->no_ajuan),
							'tgl_ajuan' => set_value('tgl_ajuan', $row->tgl_ajuan),
							'jns_ajuan' => set_value('jns_ajuan', $row->jns_ajuan),
							'no_dok' => set_value('no_dok', $row->no_dok),
							'tgl_dok' => set_value('tgl_dok', $row->tgl_dok),
							'perihal' => set_value('perihal', $row->perihal),
							'kd_giat' => set_value('kd_giat', $row->kd_giat),
							'kd_akun' => set_value('kd_akun', $row->kd_akun),
							'kota' => set_value('kota', $row->kota),
							'tgl_jln' => set_value('tgl_jln', $row->tgl_jln),
							'tgl_plg' => set_value('tgl_plg', $row->tgl_plg),
							'data_dukung' => set_value('data_dukung', $dt_dukung),
							'jml_ajuan' => set_value('jml_ajuan', $row->jml_ajuan),

						);

						$this->load->view('template/header', $data);
						$this->load->view('template/sidebar', $data);
						$this->load->view('ajuan/formedit', $data);
						$this->load->view('template/footer');
					} else {
						redirect(site_url('ajuan'));
					}
				endforeach;
			} else if ($username != "" && $ck_data->ada_tidak == "0") {
				$this->load->view('errors/error_404');
			} else {
				redirect('log');
			}
		endforeach;
	}

	//save data ke database
	public function prosesupdate()
	{
		$no_ajuan = $this->input->post('no_ajuan');
		$tgl_ajuan = $this->input->post('tgl_ajuan');
		$jns_ajuan = $this->input->post('jns_ajuan');
		$no_dok = $this->input->post('no_dok');
		$tgl_dok = $this->input->post('tgl_dok');
		$perihal = $this->input->post('perihal');
		$kd_giat = $this->input->post('kd_giat');
		$kd_akun = $this->input->post('kd_akun');
		$kota = $this->input->post('kota');
		$tgl_jln = $this->input->post('tgl_jln');
		$tgl_plg = $this->input->post('tgl_plg');
		$data_dukung = $this->input->post('data_dukung');
		$jml_ajuan = $this->input->post('jml_ajuan');
		$id_peg = $_SESSION['id_peg'];

		$data = [
			'no_ajuan' => $no_ajuan,
			'tgl_ajuan' => $tgl_ajuan,
			'jns_ajuan' => $jns_ajuan,
			'no_dok' => $no_dok,
			'tgl_dok' => $tgl_dok,
			'perihal' => $perihal,
			'kd_giat' => $kd_giat,
			'kd_akun' => $kd_akun,
			'kota' => $kota,
			'tgl_jln' => $tgl_jln,
			'tgl_plg' => $tgl_plg,
			'data_dukung' => implode(",", $data_dukung),
			'jml_ajuan' => $jml_ajuan,
			'peg_id' => $id_peg,

		];

		$this->Ajuan_model->update($this->input->post('id_ajuan'), $data);

		$get_ajuan = $this->db->query("SELECT id_ajuan FROM ajuan WHERE no_ajuan='$no_ajuan'")->result_array();
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
				);

				$this->db->insert('file_dukung', $data_berkas);
				$hapus_tb_dukung = $this->db->query("DELETE FROM file_dukung WHERE nama_file = ''");
			}
		endforeach;
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data Berhasil disimpan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('ajuan'));
	}



	public function delete($id)
	{
		$username = $_SESSION['id_peg'];
		$cek_data = $this->db->query("SELECT COUNT(id_aksesmn) AS ada_tidak FROM aksesmn 
		INNER JOIN menu ON menu.`id_menu`=aksesmn.`id_menu`
		INNER JOIN role ON role.`id_role`=aksesmn.`id_role`
		INNER JOIN dtrole ON dtrole.`id_role`=role.`id_role`
		INNER JOIN pegawai ON pegawai.`id_peg`=dtrole.`id_peg` WHERE pegawai.id_peg='$username' 
		AND menu.`id_menu`='15'")->result();
		foreach ($cek_data as $ck_data) :

			if ($username != "" && $ck_data->ada_tidak != "0") {

				$this->Ajuan_model->delete_data($id);
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data Berhasil dihapus<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect(site_url('ajuan'));
			} else if ($username != "" && $ck_data->ada_tidak == "0") {
				$this->load->view('errors/error_404');
			} else {
				redirect('log');
			}
		endforeach;
	}

	function get_giat()
	{
		$kd_giat = $this->input->get('kd_giat');
		echo '<label>Kd Akun</label> <select class ="form-control" name="kd_akun">
		<option value="">--Pilih--</option>';
		$get_kode = $this->db->query("SELECT * FROM giat WHERE id_giat ='$kd_giat'")->result();
		foreach ($get_kode as $kode) {
			$data_akun = $this->db->query("SELECT * FROM akun WHERE kd_giat ='$kode->kd_giat'")->result();
			foreach ($data_akun as $akun) {
				echo "<option value='" . $akun->id_akun . "'>" . $akun->kroakun . "</option>";
			}
			echo "</select>";
		}
	}

	function get_dt_dukung()
	{
		$jns_ajuan = $this->input->get('jns_ajuan');
		echo '<div class="checkbox">
				<label>Data Dukung</label><br>';
		$get_dukung = $this->db->query("SELECT * FROM dt_dukung WHERE jenis_id='$jns_ajuan'");
		foreach ($get_dukung->result() as $dt_dukung) {
			echo "<label><input type='checkbox' name='data_dukung[]' value='" . $dt_dukung->nm_dt . "'>" . $dt_dukung->nm_dt . " | </label>";
		}
		echo "</div>";
	}

	public function delete_file($id)
	{
		$hapus_file = $this->db->query("DELETE FROM file_dukung WHERE id_file = '$id'");
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data Berhasil dihapus<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('ajuan'));
	}

	public function delete_file_edit($id, $id_ajuan)
	{
		$hapus_file = $this->db->query("DELETE FROM file_dukung WHERE id_file = '$id'");
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data Berhasil dihapus<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('ajuan/update/' . $id_ajuan));
	}
}
