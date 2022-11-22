<?php
class StaffPpspm_model extends CI_Model
{
    public function input($data)
    {
        $this->db->insert('ajuan', $data);
    }

    public function select_ajuan()
    {
        $username = $_SESSION['id_peg'];
        $check_admin = $this->db->query("SELECT COUNT(id_role) as id_role FROM dtrole 
        WHERE id_peg='$username' AND id_role='1'")->result();
        foreach ($check_admin as $admin) :
            if ($admin->id_role != "0") {
                $query = $this->db->query("SELECT * FROM ajuan 
            INNER JOIN jenis on jenis.id_jenis = ajuan.jns_ajuan 
            INNER JOIN detjenis on detjenis.id_dtjenis = ajuan.dtjenis_id
            INNER JOIN giat on giat.id_giat = ajuan.kd_giat 
            INNER JOIN akun on akun.id_akun = ajuan.kd_akun 
            INNER JOIN pegawai on pegawai.id_peg = ajuan.peg_id 
            WHERE ajuan.status!= 'Ditolak Loket' 
                        AND ajuan.status!= 'Belum Diproses' 
                        AND ajuan.status!= 'Ditolak Staff PPK' 
                        AND ajuan.status!= 'Ditolak PPK' 
                        AND ajuan.mtd_byr!= 'SPBY'
                        AND ajuan.status!= 'Proses SPP/SPBY'
            ORDER BY ajuan.id_ajuan DESC");
                return $query->result_array();
            } else {
                $query = $this->db->query("SELECT * FROM pjspm INNER JOIN pegawai ON pegawai.id_peg=pjspm.id_peg
                        INNER JOIN ajuan ON ajuan.id_ajuan=pjspm.id_ajuan 
                        INNER JOIN jenis ON jenis.id_jenis = ajuan.jns_ajuan 
                        INNER JOIN detjenis ON detjenis.id_dtjenis = ajuan.dtjenis_id
                        INNER JOIN giat ON giat.id_giat = ajuan.kd_giat 
                        INNER JOIN akun ON akun.id_akun = ajuan.kd_akun 
                        WHERE pjspm.id_peg = '$username' 
                        AND ajuan.status!= 'Ditolak Loket' 
                        AND ajuan.status!= 'Belum Diproses' 
                        AND ajuan.status!= 'Ditolak Staff PPK' 
                        AND ajuan.status!= 'Ditolak PPK' 
                        AND ajuan.mtd_byr!= 'SPBY'
                        AND ajuan.status!= 'Proses SPP/SPBY'
            ORDER BY ajuan.id_ajuan DESC
                        ");
                return $query->result_array();
            }
        endforeach;
    }

    function update($id, $data)
    {
        $this->db->where('id_ajuan', $id);
        $this->db->update('ajuan', $data);
    }
}
