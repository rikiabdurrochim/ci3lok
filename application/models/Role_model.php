<?php
class Role_model extends CI_Model
{
    public function input($data)
    {
        $this->db->insert('role', $data);
    }

    public function select_role()
    {
        $query = $this->db->query("SELECT * FROM role");
        return $query->result_array();
    }

    function update($id, $data)
    {
        $this->db->where('id_role', $id);
        $this->db->update('role', $data);
    }

    function delete_data($id)
    {
        $this->db->where('id_role', $id);
        $this->db->delete('role');
    }
}
