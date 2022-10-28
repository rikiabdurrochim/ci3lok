<?php

function kodeAjuanOtomatis()
{
    $ci = get_instance();
    $query = "SELECT max(no_ajuan) as maxAjuan FROM ajuan";
    $data = $ci->db->query($query)->row_array();
    $kode = $data['maxAjuan'];
    $noUrut = (int) substr($kode, 3, 4);
    $noUrut++;
    $char = "SPJ";
    $kodeBaru = $char . sprintf("%04s", $noUrut);
    return $kodeBaru;
}
