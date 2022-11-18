<?php
class Bendahara_model extends CI_Model
{
    public function input($data)
    {
        $this->db->insert('ajuan', $data);
    }

    public function select_ajuan()
    {
        $query = $this->db->query("SELECT * FROM ajuan 
            INNER JOIN jenis on jenis.id_jenis = ajuan.jns_ajuan
            INNER JOIN detjenis on detjenis.id_dtjenis = ajuan.dtjenis_id 
            INNER JOIN giat on giat.id_giat = ajuan.kd_giat 
            INNER JOIN akun on akun.id_akun = ajuan.kd_akun 
            INNER JOIN pegawai on pegawai.id_peg = ajuan.peg_id 
            WHERE ajuan.`status`!= 'Ditolak Loket' 
                        AND ajuan.`status`= 'Proses Bendahara' 
                        OR ajuan.`status`= 'Selesai'                         
            ORDER BY id_ajuan DESC");
        return $query->result_array();
    }

    function update($id, $data)
    {
        $this->db->where('id_ajuan', $id);
        $this->db->update('ajuan', $data);
    }
}
