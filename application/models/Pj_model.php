<?php
class Pj_model extends CI_Model
{
    public function input($data)
    {
        $this->db->insert('pj', $data);
    }

    public function select_pj()
    {
        $query = $this->db->query("SELECT * FROM pj");
        return $query->result_array();
    }

    function update($id, $data)
    {
        $this->db->where('id_pj', $id);
        $this->db->update('pj', $data);
    }

    function delete_data($id)
    {
        $this->db->where('id_pj', $id);
        $this->db->delete('pj');
    }
}
