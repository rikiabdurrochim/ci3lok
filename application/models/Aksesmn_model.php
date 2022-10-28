<?php
class Aksesmn_model extends CI_Model
{
    public function input($data)
    {
        $this->db->insert('aksesmn', $data);
    }

    public function select_aksesmn()
    {
        $query = $this->db->query("SELECT * FROM pegawai");

        return $query->result_array();
    }

    function update($id, $data)
    {
        $this->db->where('id_aksesmn', $id);
        $this->db->update('aksesmn', $data);
    }

    function delete_data($id)
    {
        $this->db->where('id_aksesmn', $id);
        $this->db->delete('aksesmn');
    }
}
