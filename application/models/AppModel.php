<?php
class AppModel extends CI_Model
{
    public function __construct()
    {
       
    }

    public function get_dd_costumer($CIF, $pk, $selected = null)
    {
        $cmb = "<select name='CIF' class='form-control custom-select'>";

        $sql = "SELECT * FROM costumer";
        $data = $this->db->query($sql)->result_array();

        $cmb .= "<option value=''> - - - </option>";

        foreach ($data as $d) {
            $cmb .= "<option value='" . $d[$pk] . "'"; 
            $cmb .= $selected == $d[$pk] ? "selected='selected'" : '';
            $cmb .= ">" . $d['CIF'] . ' - ' . strtoupper($d['costumer_nama']) . "</option>"; 
        }

        $cmb .= "</select>";
        return $cmb;
    }
}

$cmb = "</select>";
return $cmb;


function get_dd_saving($db, $nama, $CIF = null, $pk, $selected = null)
{
    $cmb = "<select name='$nama' id='$nama' class='form-control costum-select'>";

    $sql = "SELECT tabungan.tab_rek, tabungan.CIF, tabungan.saldo, tabungan.nama_tab, tabungan.tab_buka, tabungan.tab_tutup, costumer.CIF as costumer_CIF, costumer.costumer_nama FROM tabungan LEFT JOIN costumer ON costumer.CIF = tabungan.CIF";
    $data = $db->query($sql)->result();

    $cmb .= "<option value=''> - - - </option>";

    foreach ($data as $d) {
        $cmb .= "<option value='" . $d->$pk . "'";
        $cmb .= $selected == $d->$pk ? "selected='selected'" : '';
        $cmb .= ">" . $d->CIF . ' - ' . strtoupper($d->costumer_nama) . ' - ' . strtoupper($d->nama_tab) . "</option>";
    }

    $cmb .= "</select>";
    return $cmb;
}
