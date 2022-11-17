<?php
class Pegawai_model extends CI_Model
{
    public function input($data)
    {
        $this->db->insert('pegawai', $data);
    }

    public function select_pegawai()
    {
        // $query = $this->db->query("SELECT * FROM pegawai 
        // INNER JOIN unit ON unit.id_unit = pegawai.unit 
        // ORDER BY id_peg DESC");
        $this->db->select('*');
        $this->db->from('pegawai');
        $this->db->join('unit', 'unit.id_unit = pegawai.unit');
        $this->db->where('status_peg', '1');
        $this->db->order_by('id_peg', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    function update($id, $data)
    {
        $this->db->where('id_peg', $id);
        $this->db->update('pegawai', $data);
        // $this->db->update('pegawai', $data, ['id_peg' => $id]);
    }

    function delete_data($id)
    {
        $this->db->where('id_peg', $id);
        $this->db->delete('pegawai');
        // $this->db->delete('pegawai', ['id_peg' => $id]);
    }
}
