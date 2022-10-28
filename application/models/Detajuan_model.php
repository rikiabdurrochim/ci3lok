<?php
class Detajuan_model extends CI_Model
{
    public function input($data)
    {
        $this->db->insert('detajuan', $data);
    }

    public function select_detajuan()
    {
        $query = $this->db->query("SELECT * FROM detajuan INNER JOIN ajuan on ajuan.id_ajuan = detajuan.id_ajuan ORDER BY detajuan.id_da DESC");
        return $query->result_array();
    }

    function update($id, $data)
    {
        $this->db->where('id_da', $id);
        $this->db->update('detajuan', $data);
    }

    function delete_data($id)
    {
        $this->db->where('id_da', $id);
        $this->db->delete('detajuan');
    }
}
