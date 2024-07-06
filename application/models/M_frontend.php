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

    public function tonase()
    {
        $sql = "SELECT EXTRACT(YEAR FROM D.field_date_deposit) AS TAHUN, K.field_name_category AS KATEGORI, SUM(DD.field_quantity) AS TOTALSAMPAH  FROM tblproduct P LEFT JOIN tblcategory K ON P.field_category=K.field_category_id
                    LEFT JOIN tbldepositdetail DD ON P.field_product_id=DD.field_product
                    LEFT JOIN tbldeposit D ON DD.field_trx_deposit=D.field_trx_deposit
                    WHERE P.field_product_id!=7 AND DD.field_quantity!=''
                    GROUP BY KATEGORI,TAHUN
                    ORDER BY TAHUN ASC";
        $data = $this->db->query($sql);
        return $data->result();
    }

    public function total_tonase()
    {
        $sql = "SELECT  K.field_name_category AS KATEGORI, SUM(DD.field_quantity) AS TOTALSAMPAH  FROM tblproduct P LEFT JOIN tblcategory K ON P.field_category=K.field_category_id
        LEFT JOIN tbldepositdetail DD ON P.field_product_id=DD.field_product
        LEFT JOIN tbldeposit D ON DD.field_trx_deposit=D.field_trx_deposit
        WHERE P.field_product_id!=7 AND DD.field_quantity!='' AND K.field_category_id=4
        GROUP BY KATEGORI";
        $data = $this->db->query($sql);
        return $data->row();
    }

    public function total_unit()
    {
        $sql = "SELECT COUNT(field_branch_id) AS UNIT FROM tblbranch WHERE field_id !=8 AND Is_Active='Y'";
        $data = $this->db->query($sql);
        return $data->row();
    }

    public function select_all_product($idbranch)
    {
        // $idbranch = '3172090003';
        $sql = "SELECT * FROM tblproduct WHERE field_product_id !=7 AND field_branch={$idbranch}";
        $data = $this->db->query($sql);
        return $data->result();
    }
    public function select_all_branch()
    {
        $sql = "SELECT B.field_branch_id AS ID_CABANG,W.field_nama_desa AS LOKASI ,BD.organisasi AS NAMA_CABANG
                FROM tblbranch B 
                LEFT JOIN tblbranchdetail BD ON B.field_id=BD.id_branch
                LEFT JOIN tblwilayahdesa W ON B.field_branch_id=W.field_desa_id 
                WHERE B.field_id !=8 AND Is_Active='Y'
                GROUP BY ID_CABANG
                ORDER BY B.field_branch_id DESC";
        $data = $this->db->query($sql);
        return $data->result();
    }
}
