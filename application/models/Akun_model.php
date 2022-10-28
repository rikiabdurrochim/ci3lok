<?php
class Akun_model extends CI_Model
{
    public function input($data)
    {
        $this->db->insert('akun', $data);
    }

    public function select_akun()
    {
        $query = $this->db->query("SELECT * FROM akun");
        return $query->result_array();
    }

    function update($id, $data)
    {
        $this->db->where('id_akun', $id);
        $this->db->update('akun', $data);
    }

    function delete_data($id)
    {
        $this->db->where('id_akun', $id);
        $this->db->delete('akun');
    }
}
