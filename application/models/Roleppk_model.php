<?php
class Roleppk_model extends CI_Model
{
    public function input($data)
    {
        $this->db->insert('roleppk', $data);
    }

    public function select_roleppk()
    {
        $query = $this->db->query("SELECT * FROM roleppk INNER JOIN role on roleppk.id_role = role.id_role
                                    INNER JOIN giat on roleppk.id_giat = giat.id_giat ORDER BY roleppk.id_roleppk ASC");
        return $query->result_array();
    }

    function update($id, $data)
    {
        $this->db->where('id_roleppk', $id);
        $this->db->update('roleppk', $data);
    }

    function delete_data($id)
    {
        $this->db->where('id_roleppk', $id);
        $this->db->delete('roleppk');
    }
}
