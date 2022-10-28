<?php
class Hkakses_model extends CI_Model
{
    public function input($data)
    {
        $this->db->insert('hkakses', $data);
    }

    public function select_hkakses()
    {
        $query = $this->db->query("SELECT * FROM hkakses INNER JOIN role on role.id_role = hkakses.id_role
                                    INNER JOIN menu on menu.id_menu = hkakses.id_menu ORDER BY hkakses.id_hkakses DESC");

        return $query->result_array();
    }

    function update($id, $data)
    {
        $this->db->where('id_hkakses', $id);
        $this->db->update('hkakses', $data);
    }

    function delete_data($id)
    {
        $this->db->where('id_hkakses', $id);
        $this->db->delete('hkakses');
    }
}
