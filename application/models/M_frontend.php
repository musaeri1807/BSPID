<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_frontend extends CI_Model
{

    public function total_desposit()
    {
        $sql = "SELECT SUM(field_deposit_gold) AS TOTAL_ED FROM tbldeposit WHERE field_status ='S'";
        $data = $this->db->query($sql);
        return $data->row();
    }
    public function total_withdraw()
    {
        $sql = "SELECT SUM(field_withdraw_gold) AS TOTAL_EW FROM tblwithdraw WHERE field_status ='S'";
        $data = $this->db->query($sql);
        return $data->row();
    }
    public function total_nasabah()
    {
        $sql = "SELECT COUNT(id_Nasabah) AS TOTAL_NASABAH FROM tblnasabah";
        $data = $this->db->query($sql);
        return $data->row();
    }
    public function total_sampah()
    {
        $sql = "SELECT SUM(field_quantity) AS TOTAL_SAMPAH FROM tbldepositdetail WHERE field_product !=7";
        $data = $this->db->query($sql);
        return $data->row();
    }

    public function total_unit()
    {
        $sql = "SELECT COUNT(field_branch_id) AS UNIT FROM tblbranch WHERE field_id !=8 AND Is_Active='Y'";
        $data = $this->db->query($sql);
        return $data->row();
    }

    public function select_all_product()
    {
        $sql = "SELECT * FROM tblproduct WHERE field_product_id !=7";
        $data = $this->db->query($sql);
        return $data->result();
    }
    public function select_all_branch()
    {
        $sql = "SELECT B.field_branch_id AS ID_CABANG,W.field_nama_desa AS NAMA_CABANG FROM tblbranch B 
                LEFT JOIN tblwilayahdesa W ON B.field_branch_id=W.field_desa_id 
                WHERE B.field_id !=8 AND Is_Active='Y'
                ORDER BY B.field_branch_id DESC";
        $data = $this->db->query($sql);
        return $data->result();
    }
}
