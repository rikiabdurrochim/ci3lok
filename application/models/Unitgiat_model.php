<?php
class Unitgiat_model extends CI_Model
{
    public function input($data)
    {
        $this->db->insert('unitgiat', $data);
    }

    public function select_unitgiat()
    {
        $query = $this->db->query("SELECT * FROM unitgiat INNER JOIN unit on unitgiat.id_unit = unit.id_unit
                                    INNER JOIN giat on unitgiat.id_giat = giat.id_giat ORDER BY unitgiat.id_unitgiat ASC");
        return $query->result_array();
    }

    function update($id, $data)
    {
        $this->db->where('id_unitgiat', $id);
        $this->db->update('unitgiat', $data);
    }

    function delete_data($id)
    {
        $this->db->where('id_unitgiat', $id);
        $this->db->delete('unitgiat');
    }
}
