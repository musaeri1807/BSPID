<?php
defined('BASEPATH') or exit('No direct script access allowed');
//load email phpmailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class AuthAdmin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('M_auth');
		$this->load->model('M_frontend');
		require APPPATH . 'third_party/PHPMailer/Exception.php';
		require APPPATH . 'third_party/PHPMailer/PHPMailer.php';
		require APPPATH . 'third_party/PHPMailer/SMTP.php';
	}

	public function index()
	{

		$session = $this->session->userdata('status');
		if ($session == null) {
			$data['judul'] = "Dashboard";
			$this->load->view('admin/v_login_adm', $data);
		} else {
			redirect('dashboard');
		}
	}


	public function login()
	{
		$this->form_validation->set_rules('username', 'Email', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		if ($this->form_validation->run() == TRUE) {
			$username = trim($_POST['username']);
			$pass = trim($_POST['password']);
			// $data = $this->M_auth->login($username);

			$Q = $this->db->query("SELECT * FROM tblemployeeslogin WHERE field_email='$username' OR field_username='$username'");
			$data  = $Q->row();
			$N		= $Q->num_rows();
			// var_dump($data);
			// echo $data->field_user_id;
			// die();
			if ($N > 0) {
				if (1 == $data->field_status_aktif or $username == $data->field_email and $username == $data->field_username) {
					if (!password_verify($pass, $data->field_password) == true) {
						$this->session->set_flashdata('message', 'Username atau Password Anda Salah.');
						redirect('authadmin');
					} else {
						$session = [
							// 'userdata' => $data,
							'IDU'		=> $data->field_user_id,
							'nama'		=> $data->field_name_officer,
							'mail'		=> $data->field_email,
							'role'		=> $data->field_role,
							'branch'	=> $data->field_branch,
							'status' 	=> "Loged in",
							'logged_in' => TRUE
						];

						$this->session->set_userdata($session);
						redirect('dashboard');
					}
				} else {

					// echo "AKUN BELUM AKTIF";
					// $this->session->set_flashdata('message', 'Akun Belum Aktif.');
					$this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Akun Belum Aktif.!! .</div>');
					redirect('authadmin');
				}
			} else {
				// $this->session->set_flashdata('message', 'Akun Belum Terdaftar.');
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Akun Belum Terdaftar.!! .</div>');
				redirect('authadmin');
				// echo "AKUN BELUM TERDAFTAR";
			}
		} else {
			$this->session->set_flashdata('message', validation_errors());
			redirect('authadmin');
		}
	}



	public function logout()
	{
		$this->session->sess_destroy();
		redirect('authadmin');
	}
}
