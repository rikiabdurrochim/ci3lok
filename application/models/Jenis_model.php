<?php
class Jenis_model extends CI_Model
{
    public function input($data)
    {
        $this->db->insert('jenis', $data);
    }

    public function select_jenis()
    {
        $query = $this->db->query("SELECT * FROM jenis");
        return $query->result_array();
    }

    function update($id, $data)
    {
        $this->db->where('id_jenis', $id);
        $this->db->update('jenis', $data);
    }

    function delete_data($id)
    {
        $this->db->where('id_jenis', $id);
        $this->db->delete('jenis');
    }
}
