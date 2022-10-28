<?php
class Dtadk_model extends CI_Model
{
    public function input($data)
    {
        $this->db->insert('dtadk', $data);
    }

    public function select_dtadk()
    {
        $query = $this->db->query("SELECT * FROM dtadk INNER JOIN jenis on dtadk.id_jenis = jenis.id_jenis
                                    INNER JOIN detadk on dtadk.id_detadk = detadk.id_detadk ORDER BY dtadk.id_dtadk ASC");
        return $query->result_array();
    }

    function update($id, $data)
    {
        $this->db->where('id_dtadk', $id);
        $this->db->update('dtadk', $data);
    }

    function delete_data($id)
    {
        $this->db->where('id_dtadk', $id);
        $this->db->delete('dtadk');
    }
}
