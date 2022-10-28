<?php
class Giat_model extends CI_Model
{
    public function input($data)
    {
        $this->db->insert('giat', $data);
    }

    public function select_giat()
    {
        $query = $this->db->query("SELECT * FROM giat");
        return $query->result_array();
    }

    function update($id, $data)
    {
        $this->db->where('id_giat', $id);
        $this->db->update('giat', $data);
    }

    function delete_data($id)
    {
        $this->db->where('id_giat', $id);
        $this->db->delete('giat');
    }
}
