<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_frontend extends CI_Model{

    public function total_desposit(){
        $sql = "SELECT SUM(field_deposit_gold) AS TOTAL_EMAS FROM tbldeposit WHERE field_status ='S'";
		$data = $this->db->query($sql);
        return $data->row();

    } 
     public function total_nasabah(){
        $sql = "SELECT COUNT(id_Nasabah) AS TOTAL_NASABAH FROM tblnasabah";
		$data = $this->db->query($sql);
        return $data->row();

    }  
    public function total_Sampah(){
        $sql = "SELECT SUM(field_quantity) AS TOTAL_SAMPAH FROM tbldepositdetail WHERE field_product !=7";
		$data = $this->db->query($sql);
        return $data->row();

    } 

      public function select_all_product(){
        $sql = "SELECT * FROM tblproduct WHERE field_product_id !=7";
		$data = $this->db->query($sql);
        return $data->result();

    } 

 }