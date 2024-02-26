<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function index()
	{

		$session = $this->session->userdata('status');
		if ($session == null) {
			$data['judul'] = "Dashboard";
			$this->load->view('admin/v_login_adm', $data);
		} else {
			$Q = $this->db->query("SELECT BD.organisasi AS ORG, 
									B.field_branch_name AS Lokasi,
									D.field_branch AS BSP,
									DATE_FORMAT(D.field_date_deposit, '%Y') AS TAHUN, 
									COUNT(D.field_trx_deposit) AS JUMLAH_TRX,
									SUM(D.field_operation_fee_rp) AS TOTAL_FEE_OPR,D.field_status AS STATUS
									FROM tbldeposit D
									LEFT JOIN tblbranch B ON D.field_branch=B.field_branch_id
									LEFT JOIN tblbranchdetail BD ON B.field_account_numbers=BD.id_number
									WHERE D.field_status='S'
									GROUP BY DATE_FORMAT(D.field_date_deposit, '%Y'),D.field_status,D.field_branch
									ORDER BY TAHUN DESC");
			$data['OP']  = $Q->result_array();
			$id = $this->session->userdata('IDU');
			$Q = $this->db->query("SELECT * FROM tblemployeeslogin WHERE field_user_id=$id ")->row();

			// var_dump($data['datauser']);
			// echo $datauser['field_name_officer'];
			// die();
			// $data['datauser'] 		= $this->session->userdata();
			$data['datauser'] 		= $this->session->userdata();
			$data['page'] 			= "Dashboard";
			$data['judul'] 			= "Menu Dashboard";
			$data['deskripsi'] 		= "Dashboard";

			$this->load->view('admin/dashboard/v_header_adm', $data);
			$this->load->view('admin/dashboard/v_sidebar_adm');
			$this->load->view('admin/dashboard/v_dashboard_adm');
			$this->load->view('admin/dashboard/v_footer_adm');
		}



		// echo "USERNAME";
	}
}
