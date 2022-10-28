<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Giat extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Giat_model');
	}

	public function index()
	{
		$username = $_SESSION['id_peg'];
		if ($username != "") {
			$data['title'] = 'Data Kegiatan';
			$data['data_kegiatan'] = $this->Giat_model->select_giat();

			$this->load->view('template/header', $data);
			$this->load->view('template/sidebar', $data);
			$this->load->view('giat/index', $data);
			$this->load->view('template/footer');
		} else {
			redirect('log');
		}
	}
	public function tambah()
	{
		$data['title'] = 'Input Data';

		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('giat/forminput', $data);
		$this->load->view('template/footer');
	}

	public function prosesinput()
	{

		$kd_giat = $this->input->post('kd_giat');
		$nm_giat = $this->input->post('nm_giat');
		$kegiatan = $this->input->post('kegiatan');
		$unit = $this->input->post('unit');


		$data = [
			'kd_giat' => $kd_giat,
			'nm_giat' => $nm_giat,
			'kegiatan' => $kegiatan,
			'unit' => $unit,
		];




		$this->Giat_model->input($data);
		$this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert"> Data Berhasil ditambahkan <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

		redirect(site_url('giat'));
	}







	//untuk tampil data ke form edit
	public function update($id)
	{
		$title = 'Update Kegiatan';
		$data_kegiatan = $this->db->query("SELECT * FROM giat WHERE id_giat ='$id'")->result();
		foreach ($data_kegiatan as $row) :

			if ($row) {
				$data = array(
					'title' => $title,
					'id_giat' => set_value('id_giat', $row->id_giat),
					'kd_giat' => set_value('kd_giat', $row->kd_giat),
					'nm_giat' => set_value('nm_giat', $row->nm_giat),
					'kegiatan' => set_value('kegiatan', $row->kegiatan),
					'unit' => set_value('unit', $row->unit),

				);

				$this->load->view('template/header', $data);
				$this->load->view('template/sidebar', $data);
				$this->load->view('giat/formedit', $data);
				$this->load->view('template/footer');
			} else {
				redirect(site_url('giat'));
			}
		endforeach;
	}

	//save data ke database
	public function prosesupdate()
	{

		$kd_giat = $this->input->post('kd_giat');
		$nm_giat = $this->input->post('nm_giat');
		$kegiatan = $this->input->post('kegiatan');
		$unit = $this->input->post('unit');

		$data = [
			'kd_giat' => $kd_giat,
			'nm_giat' => $nm_giat,
			'kegiatan' => $kegiatan,
			'unit' => $unit,
		];

		$this->Giat_model->update($this->input->post('id_giat'), $data);
		redirect(site_url('giat'));
	}

	public function delete($id)
	{

		$this->Giat_model->delete_data($id);
		redirect(site_url('giat'));
	}
}
