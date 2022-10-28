<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aksesmn extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Aksesmn_model');
	}

	public function index()
	{
		$username = $_SESSION['id_peg'];
		if ($username != "") {
			$data['title'] = 'Data Akses Menu';
			$data['data_aksesmn'] = $this->Aksesmn_model->select_aksesmn();

			$this->load->view('template/header', $data);
			$this->load->view('template/sidebar', $data);
			$this->load->view('aksesmn/index', $data);
			$this->load->view('template/footer');
		} else {
			redirect('log');
		}
	}


	public function prosesinput()
	{

		$role = $this->input->post('id_role');
		$menu = $this->input->post('id_menu');
		$id_peg = $this->input->post('id_peg');
		// $delete_role = $this->db->query("DELETE FROM dtrole WHERE id_peg='$id_peg'");
		// $delete_menu = $this->db->query("DELETE FROM aksesmn WHERE id_peg='$id_peg'");
		$jumlah_role = count($role);
		$jumlah_menu = count($menu);

		for ($i = 0; $i < $jumlah_role; $i++) {
			$id_role = $this->input->post('id_role[' . $i . ']');

			$check_role = $this->db->query("SELECT COUNT(id_dtrole) as jml_role FROM dtrole WHERE id_peg='$id_peg' AND id_role='$id_role'")->result();
			foreach ($check_role as $ck_role) {
				if ($ck_role->jml_role == 0) {
					$input_role = $this->db->query("INSERT INTO dtrole (id_peg, id_role) VALUES ('$id_peg','$id_role')");
				} else {
				}
			}
		}

		for ($i = 0; $i < $jumlah_menu; $i++) {
			$id_menu = $this->input->post('id_menu[' . $i . ']');

			$check_menu = $this->db->query("SELECT COUNT(id_aksesmn) as jml_menu FROM aksesmn WHERE id_peg='$id_peg' AND id_menu='$id_menu'")->result();
			foreach ($check_menu as $ck_menu) {
				if ($ck_menu->jml_menu == 0) {
					$input_menu = $this->db->query("INSERT INTO aksesmn (id_peg, id_menu) VALUES ('$id_peg','$id_menu')");
				} else {
				}
			}
		}
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data Berhasil disimpan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('aksesmn'));
	}

	//save data ke database
	public function prosesupdate()
	{

		$id_role = $this->input->post('id_role');
		$id_menu = $this->input->post('id_menu');

		$data = [
			'id_role' => $id_role,
			'id_menu' => $id_menu,
		];

		$this->Aksesmn_model->update($this->input->post('id_aksesmn'), $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data Berhasil diubah<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('aksesmn'));
	}

	public function delete($id)
	{

		$this->Aksesmn_model->delete_data($id);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data Berhasil dihapus<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(site_url('aksesmn'));
	}

	function data_role()
	{
		$id_peg = $this->input->get('id_peg');
		echo '<label>Pilih Role</label><br>';

		$get_role = $this->db->query("SELECT dtrole.id_role, role.nm_role, pegawai.id_peg FROM dtrole INNER JOIN role ON role.`id_role`=dtrole.`id_role` INNER JOIN pegawai ON pegawai.`id_peg`=dtrole.`id_peg` WHERE dtrole.`id_peg`='$id_peg'");
		foreach ($get_role->result() as $r_select) {

			echo "<label><input type='checkbox' onclick='delete_role($r_select->id_peg, $r_select->id_role)' name='id_role[]' id='id_role[]' value='" . $r_select->id_role . "' checked> " . $r_select->nm_role . "</label> | ";
		}
		$list_role = $this->db->query("SELECT * FROM role T1 WHERE NOT EXISTS (SELECT id_role FROM dtrole T2 WHERE T1.id_role = T2.id_role AND id_peg='$id_peg')");
		foreach ($list_role->result() as $r) {
			echo "<label><input type='checkbox' name='id_role[]' id='id_role[]' value='" . $r->id_role . "'> " . $r->nm_role . "</label> | ";
		}
		echo "</div>";
	}

	function data_menu()
	{
		$id_peg = $this->input->get('id_peg');
		echo '<label>Pilih Menu</label><br>';

		$get_menu = $this->db->query("SELECT * FROM menu
				INNER JOIN aksesmn ON aksesmn.`id_menu`=menu.`id_menu`
				INNER JOIN pegawai ON pegawai.`id_peg`=aksesmn.`id_peg` 
				WHERE aksesmn.`id_peg`='$id_peg'");
		foreach ($get_menu->result() as $r_select) {

			echo "<label><input type='checkbox'  onclick='delete_menu($r_select->id_peg, $r_select->id_menu)' name='id_menu[]' id='id_menu[]' value='" . $r_select->id_menu . "' checked> " . $r_select->nm_menu . "</label> | ";
		}
		$list_menu = $this->db->query("SELECT * FROM menu T1 WHERE NOT EXISTS (SELECT id_menu FROM aksesmn T2 WHERE T1.id_menu = T2.id_menu AND id_peg='$id_peg')");
		foreach ($list_menu->result() as $r) {
			echo "<label><input type='checkbox' name='id_menu[]' id='id_menu[]' value='" . $r->id_menu . "'> " . $r->nm_menu . "</label> | ";
		}
		echo "</div>";
	}

	function delete_mn()
	{
		$id_peg = $_GET['id_peg'];
		$id_menu = $_GET['id_menu'];

		$delete_menu = $this->db->query("DELETE FROM aksesmn WHERE id_peg='$id_peg' AND id_menu='$id_menu'");
	}

	function delete_rl()
	{
		$id_peg = $_GET['id_peg'];
		$id_role = $_GET['id_role'];

		$delete_menu = $this->db->query("DELETE FROM dtrole WHERE id_peg='$id_peg' AND id_role='$id_role'");
	}
}
