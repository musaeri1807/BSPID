<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_saldo extends CI_Model
{
	public function select_all($id)
	{
		// $data = $this->db->get('tbltrxmutasisaldo');

		// $sql = "SELECT * FROM tbltrxmutasisaldo WHERE field_member_id='{$id}' ORDER BY field_id_saldo DESC LIMIT 1";
		$sql = "SELECT 
		S.* ,
		N.No_Rekening AS REKENING,
		U.field_nama AS NAMA		
		FROM tbltrxmutasisaldo S 
		LEFT JOIN tblnasabah N ON S.field_rekening=N.No_Rekening
		LEFT JOIN tbluserlogin U ON N.id_UserLogin=U.field_user_id 		
		WHERE S.field_member_id='{$id}' ORDER BY field_id_saldo DESC LIMIT 1";

		$data = $this->db->query($sql);

		// return $data->result();

		return $data->row();
	}
	public function select_gold(){
			$sql = "SELECT EMAS.field_date_gold AS TANGGAL, EMAS.field_buyback AS BUYBACK,EMAS.field_sell AS JUAL 
					FROM tblgoldprice EMAS ORDER BY field_gold_id DESC LIMIT 1";
			$data = $this->db->query($sql); 

		return $data->row();
	}
}

/* End of file M_saldo.php */
/* Location: ./application/models/M_posisi.php */