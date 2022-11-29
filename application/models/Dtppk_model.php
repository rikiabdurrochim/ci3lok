<?php
class Dtppk_model extends CI_Model
{
    public function input($data)
    {
        $this->db->insert('dtppk', $data);
    }

    public function select_dtppk()
    {
        $query = $this->db->query("SELECT * FROM dtppk INNER JOIN pegawai on dtppk.id_peg = pegawai.id_peg
                                    INNER JOIN giat on dtppk.id_giat = giat.id_giat ORDER BY dtppk.id_dtppk ASC");
        return $query->result_array();
    }

    function update($id, $data)
    {
        $this->db->where('id_dtppk', $id);
        $this->db->update('dtppk', $data);
    }

    function delete_data($id)
    {
        $this->db->where('id_dtppk', $id);
        $this->db->delete('dtppk');
    }
}
