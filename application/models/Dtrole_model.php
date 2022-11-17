<?php
class Dtrole_model extends CI_Model
{
    public function input($data)
    {
        $this->db->insert('dtrole', $data);
    }

    public function select_dtrole()
    {
        $query = $this->db->query("SELECT * FROM dtrole INNER JOIN role on role.id_role = dtrole.id_role
                                    INNER JOIN pegawai on pegawai.id_peg = dtrole.id_peg ORDER BY dtrole.id_dtrole ASC");

        return $query->result_array();
    }

    function update($id, $data)
    {
        $this->db->where('id_dtrole', $id);
        $this->db->update('dtrole', $data);
    }

    function delete_data($id)
    {
        $this->db->where('id_dtrole', $id);
        $this->db->delete('dtrole');
    }
}
