<?php

// function kodeAjuanOtomatis()
// {
//     $ci = get_instance();
//     $query = "SELECT max(no_ajuan) as maxAjuan FROM ajuan";
//     $data = $ci->db->query($query)->row_array();
//     $kode = $data['maxAjuan'];
//     $noUrut = (int) substr($kode, 3, 4);
//     $noUrut++;
//     $char = "SPJ";
//     $kodeBaru = $char . sprintf("%04s", $noUrut);
//     return $kodeBaru;
// }

function getAutoNumber($table, $field, $pref, $length, $where = "")
{
    $ci = &get_instance();
    $query = "SELECT IFNULL (MAX(CONVERT(MID($field," . (strlen($pref) + 1) . "." . ($length . strlen($pref)) . "), UNSIGNED INTEGER)),0)+1 AS NOMOR
    FROM $table WHERE LEFT($field," . (strlen($pref)) . ")='$pref' $where";
    $result = $ci->db->query($query)->row();
    $zero = "";
    $num = $length - strlen($pref) - strlen($result->NOMOR);
    for ($i = 0; $i < $num; $i++) {
        $zero = $zero . "0";
    }
    return $pref . $zero . $result->NOMOR;
}
