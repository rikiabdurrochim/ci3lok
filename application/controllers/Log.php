<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Log extends CI_Controller
{

    public function index()
    {
        $title = 'Login';
        $data = array(
            'title' => $title,
        );

        $this->load->view('login/index', $data);
    }
    public function login()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $user = $this->db->get('pegawai');
        if ($user->num_rows() > 0) {
            $this->session->set_userdata($user->row_array());
            redirect('dashboard');
        } else {
            $this->session->set_flashdata('status_login', 'Username atau password salah!');
            redirect('log');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        $this->session->set_flashdata('status_login', 'Berhasil untuk keluar!');
        redirect('log');
    }
}
