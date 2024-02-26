<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProfleAdmin extends CI_Controller
{
	public function index()
	{

		$data['datauser'] 		= $this->session->userdata();
		$data['page'] 			= "Dashboard";
		$data['judul'] 			= "Menu Dashboard";
		$data['deskripsi'] 		= "Dashboard";

		$this->load->view('admin/dashboard/v_header_adm',$data);
		$this->load->view('admin/dashboard/v_sidebar_adm');
		$this->load->view('admin/dashboard/v_profileview_adm');
		$this->load->view('admin/dashboard/v_footer_adm');
	}
	public function changepassword()
	{
		$data['datauser'] 		= $this->session->userdata();
		$data['page'] 			= "Dashboard";
		$data['judul'] 			= "Menu Dashboard";
		$data['deskripsi'] 		= "Dashboard";
		$this->load->view('admin/dashboard/v_header_adm',$data);
		$this->load->view('admin/dashboard/v_sidebar_adm');
		$this->load->view('admin/dashboard/v_profilechange_adm');
		$this->load->view('admin/dashboard/v_footer_adm');
	}
}
