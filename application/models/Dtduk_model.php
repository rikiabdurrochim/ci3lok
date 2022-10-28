<?php
class Dtduk_model extends CI_Model
{
    public function input($data)
    {
        $this->db->insert('dt_dukung', $data);
    }

    public function select_dtduk()
    {
        $query = $this->db->query("SELECT * FROM dt_dukung INNER JOIN jenis on jenis.id_jenis = dt_dukung.jenis_id ORDER BY dt_dukung.id_dtduk ASC");
        return $query->result_array();
    }

    function update($id, $data)
    {
        $this->db->where('id_dtduk', $id);
        $this->db->update('dt_dukung', $data);
    }

    function delete_data($id)
    {
        $this->db->where('id_dtduk', $id);
        $this->db->delete('dt_dukung');
    }
}
