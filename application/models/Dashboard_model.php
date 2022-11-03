<?php
class Dashboard_model extends CI_Model
{

    public function select_ajuan()
    {
        $query = $this->db->query("SELECT * FROM ajuan 
            INNER JOIN jenis on jenis.id_jenis = ajuan.jns_ajuan 
            INNER JOIN giat on giat.id_giat = ajuan.kd_giat 
            INNER JOIN akun on akun.id_akun = ajuan.kd_akun 
            INNER JOIN pegawai on pegawai.id_peg = ajuan.peg_id 
            ORDER BY id_ajuan DESC");
        return $query->result_array();
    }
}
