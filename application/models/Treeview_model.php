<?php
class Treeview_model extends CI_Model
{
    public function input($data)
    {
        $this->db->insert('treeview', $data);
    }

    public function select_treeview()
    {
        $query = $this->db->query("SELECT * FROM treeview");
        return $query->result_array();
    }

    function update($id, $data)
    {
        $this->db->where('id_treeview', $id);
        $this->db->update('treeview', $data);
    }

    function delete_data($id)
    {
        $this->db->where('id_treeview', $id);
        $this->db->delete('treeview');
    }
}
