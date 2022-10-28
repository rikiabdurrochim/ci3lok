<?php
class Menu_model extends CI_Model
{
    public function input($data)
    {
        $this->db->insert('menu', $data);
    }

    public function select_menu()
    {
        $query = $this->db->query("SELECT * FROM menu ORDER BY id_menu DESC");
        return $query->result_array();
    }

    function update($id, $data)
    {
        $this->db->where('id_menu', $id);
        $this->db->update('menu', $data);
    }

    function delete_data($id)
    {
        $this->db->where('id_menu', $id);
        $this->db->delete('menu');
    }
}
