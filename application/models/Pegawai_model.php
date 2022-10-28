<?php
class Pegawai_model extends CI_Model
{
    public function input($data)
    {
        $this->db->insert('pegawai', $data);
    }

    public function select_pegawai()
    {
        $query = $this->db->query("SELECT * FROM pegawai INNER JOIN unit ON unit.id_unit = pegawai.unit");
        return $query->result_array();
    }

    function update($id, $data)
    {
        $this->db->where('id_peg', $id);
        $this->db->update('pegawai', $data);
    }

    function delete_data($id)
    {
        $this->db->where('id_peg', $id);
        $this->db->delete('pegawai');
    }
}
