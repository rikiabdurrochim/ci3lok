<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notif extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
	}

	function status_notif()
	{
		$id_notif = $this->input->get('id_notif');
		$update_badge = $this->db->query("UPDATE notif_ajuan SET status_notif = '1' WHERE id_notif ='$id_notif'");
	}
}
