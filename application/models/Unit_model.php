<?php
class Unit_model extends CI_Model
{
    public function input($data)
    {
        $this->db->insert('unit', $data);
    }

    public function select_unit()
    {
        // $query = $this->db->query("SELECT * FROM unit");
        $query = $this->db->get('unit');
        return $query->result_array();
    }

    function update($id, $data)
    {
        $this->db->where('id_unit', $id);
        $this->db->update('unit', $data);
    }

    function delete_data($id)
    {
        // $this->db->where('id_unit', $id);
        // $this->db->delete('unit');
        $this->db->delete('unit', ['id_unit' => $id]);
    }
}
