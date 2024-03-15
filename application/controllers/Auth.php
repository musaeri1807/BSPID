<?php
defined('BASEPATH') or exit('No direct script access allowed');
//load email phpmailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		require APPPATH . 'third_party/PHPMailer/Exception.php';
		require APPPATH . 'third_party/PHPMailer/PHPMailer.php';
		require APPPATH . 'third_party/PHPMailer/SMTP.php';
		$this->load->library('session');
		$this->load->model('M_auth');
		$this->load->model('M_frontend');
	}

	public function index()
	{
		$session = $this->session->userdata('status');
		if ($session == '') {
			$data['judul'] = "Situ Login BSPID";
			$this->load->view('v_login', $data);
		} else {
			redirect('Home');
		}
	}

	public function login()
	{
		$this->form_validation->set_rules('txt_email', 'Email', 'required|trim');
		// $this->form_validation->set_rules('txt_email', 'Email or Phone', 'required|callback_validate_email_or_phone');
		$this->form_validation->set_rules('txt_password', 'Password', 'required|trim');
		if ($this->form_validation->run() == TRUE) {
			$username = trim($_POST['txt_email']);
			$pass = trim($_POST['txt_password']);
			// $data = $this->M_auth->login($username);

			$Q = $this->db->query("SELECT * FROM tbluserlogin WHERE field_email='$username' OR field_handphone='$username'");
			$data  = $Q->row();
			$N		= $Q->num_rows();
			if ($N > 0) {
				if (1 == $data->field_status_aktif or $username == $data->field_email and $username == $data->field_handphone) {
					if (!password_verify($pass, $data->field_password) == true) {
						$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username atau Password Anda Salah.</div>');
						redirect('Auth');
					} else {
						$session = [
							'userdata' => $data,
							'status' => "Loged in",
							'logged_in' => TRUE
						];
						$this->session->set_userdata($session);
						redirect('Home');
					}
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Akun Belum Aktif.!! .</div>');
					redirect('Auth');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Akun Belum Terdaftar.!! .</div>');
				redirect('Auth');
			}
		} else {
			$this->session->set_flashdata('message', validation_errors());
			redirect('Auth');
		}
	}

	public function signup()
	{
		$this->form_validation->set_rules('name', 'Nama Lengkap', 'required|trim');
		$this->form_validation->set_rules('cabang', 'Cabang Bank Sampah', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tbluserlogin.field_email]', [
			'is_unique' => 'Email ini telah terdaftar!'
		]);
		$this->form_validation->set_rules('nohp', 'Nomo HP', 'required|trim|min_length[10]|max_length[12]|is_unique[tbluserlogin.field_handphone]', [
			'is_unique' => 'Nomor ini telah terdaftar!'
		]);
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[5]', [
			'min_length' => 'Kata sandi terlalu pendek!'
		]);

		if ($this->form_validation->run() == false) {
			$data['judul'] 	= "Signup BSPID";
			$data['C'] = $this->M_frontend->select_all_branch();
			$this->load->view('v_register', $data);
		} else {
			$date    		= 	date('Y-m-d');
			$cabang 		= 	$this->input->post('cabang');
			$kode_cabang	=	$this->db->query("SELECT * FROM tblbranch B
								WHERE B.field_branch_id=$cabang
								ORDER BY B.field_branch_id DESC")->row_array();
			$idaccount		=	$this->db->query("SELECT * FROM tbluserlogin U
								JOIN tblnasabah N ON U.field_user_id=N.id_UserLogin
								JOIN tblbranch B ON U.field_branch=B.field_branch_id
								WHERE B.field_branch_id=$cabang
								ORDER BY U.field_user_id DESC LIMIT 1")->row_array();



			if (empty($idaccount)) {
				$code                   = $kode_cabang["field_account_numbers"]; //cabang masing-masing
				$thn                    = substr(date("Y", strtotime($date)), -2);
				$bln                    = date("m", strtotime($date));
				$no                     = 1;
				$char                   = $code . $thn . $bln;
				$norek                  = $char . sprintf("%04s", $no);
				$norekening = $norek;
			} else {
				$ambildate = substr($idaccount['No_Rekening'], 4, 2);
				if ($ambildate !== date("m", strtotime($date))) {
					# code...
					$code                   = $kode_cabang["field_account_numbers"]; //cabang masing-masing
					$thn                    = substr(date("Y", strtotime($date)), -2);
					$bln                    = date("m", strtotime($date));
					$no                     = 1;
					$char                   = $code . $thn . $bln;
					$norek                  = $char . sprintf("%04s", $no);
					$norekening = $norek;
				} else {
					# code...
					$code                   = $kode_cabang["field_account_numbers"];
					$noseri                 = $idaccount['No_Rekening'];
					$noUrut                 = substr($noseri, 6);
					$thn                    = substr(date("Y", strtotime($date)), -2);
					$bln                    = date("m", strtotime($date));
					$no     = $noUrut + 1;
					$char   = $code . $thn . $bln;
					$norek  = $char . sprintf("%04s", $no);
					$norekening = $norek;
				}
			}


			$R = [
				'field_nama'  			=> $this->input->post('name'),
				'field_email' 			=> $this->input->post('email'),
				'field_handphone'  		=> $this->input->post('nohp'),
				'field_password'		=> password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'field_branch'			=> $this->input->post('cabang'),
				'field_status_aktif' 	=> '0',
				'field_blokir_status' 	=> 'A',
				'field_token'			=> hash('sha256', md5(date('Y-m-d h:i:s'))),
				'field_log'				=> date('Y-m-d H:i:s'),
				'field_tanggal_reg' 	=> date('Y-m-d'),
				'field_time_reg' 		=> date('H:i:s'),
				'field_token_otp'		=> (rand(999, 9999)),
				'field_member_id'		=> $this->input->post('cabang') . $this->input->post('nohp'),
				'field_ipaddress'		=> $_SERVER['REMOTE_ADDR']
			];
			if ($this->db->insert('tbluserlogin', $R) == TRUE) {

				$ID = [
					'id_UserLogin'		=> $this->db->insert_id(),
					'No_Rekening'		=> $norekening
				];
				$this->db->insert('tblnasabah', $ID);
				$ID = [
					'id_UserLogin'		=> $this->db->insert_id()
				];
				$this->db->insert('tblpewaris', $ID);

				$email		= $this->input->post('email');
				$password	= $this->input->post('password');
				$tokenn 	= hash('sha256', md5(date('Y-m-d h:i:s')));
				$nama 		= $this->input->post('name');
				$from 		= 'Bank Sampah Pintar';
				$subject 	= 'Akun Verifikasi';
				$content 	= 'Pendaftaran';
				$button  	= 'Aktifkan';



				// PHPMailer object
				// $response = false;
				$mail = new PHPMailer();

				// SMTP configuration
				$mail->isSMTP();
				$mail->Host     = SERVERMAIL; //sesuaikan sesuai nama domain hosting/server yang digunakan
				$mail->SMTPAuth = true;
				$mail->Username = EMAIL; // user email
				$mail->Password = PASSMAIL; // password email
				$mail->SMTPSecure = 'ssl';
				$mail->Port     = 465;

				$mail->setFrom(EMAIL, $from); // user email
				$mail->addReplyTo('', 'noreply'); //user email
				$mail->addAddress($this->input->post('email')); //email tujuan pengiriman email
				$mail->Subject = $subject; //subject email
				$mail->isHTML(true);
				$mail->Body = sendmailverifikasi($nama, $email, $content, $password, $tokenn, $button);

				// Send email
				if (!$mail->send()) {
					echo 'Message could not be sent.';
					echo 'Mailer Error: ' . $mail->ErrorInfo;
				} else {
					// $out['msg'] = show_succ_msg('Data Pegawai Berhasil ditambahkan', '20px');
					$this->session->set_flashdata('message', show_succ_msg('Password dikirim ke Email'));
					redirect('Auth');
				}
			} else {
				# code...
				// die();
			}
		}
	}

	public function lupapassword() //masih belum selesai tokenn
	{
		$this->form_validation->set_rules('email', 'Email', 'required|trim');
		if ($this->form_validation->run() == false) {
			$data['Title'] 		= "Lupa Kata Sandi";
			$this->load->helper('form');
			$data['Judulmain'] = "Mengatur Sandi";
			$this->load->view('v_lupaspassword', $data);
		} else {
			$email = $this->input->post('email');
			//Mencari email yang di input
			$Q 	= $this->db->query("SELECT * FROM tbluserlogin WHERE field_email ='$email' LIMIT 1");
			$Q->num_rows();
			$row 	= $Q->row();
			$row->field_status_aktif;
			if ($Q->num_rows() > 0) {
				if ($row->field_status_aktif == 1) {
					$password = rand();
					$pass = password_hash($password, PASSWORD_DEFAULT);
					$tokenn = base64_encode(random_bytes(32));
					$data = array(
						'field_password' => $pass,
						'field_token' => $tokenn
					);

					$this->db->where('field_email', $email);
					$this->db->update('tbluserlogin', $data);
					$nama = $row->field_nama;
					$this->_sendEmail($email, 'Reset Password', $nama, 'Reset Password', 'Ubah Sandi', $password, $tokenn);
					redirect('Auth/lupapassword', 'refresh');
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Anda Belum Aktifasi...!, Segerah Cek Email..! </div>');
					redirect('Auth/lupapassword');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email tidak ditemukan!!.</div>');
				redirect('Auth/lupapassword');
			}
		}
	}

	public function ResetPassword()
	{

		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('tbluserlogin', ['field_email' => $email, 'field_token' => $token])->row_array();

		if ($user) {
			$this->session->set_userdata('reset_email', $email);
			$this->changePassword();
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password gagal! Salah email atau token.</div>');
			redirect('auth');
		}
	}

	public function changepassword()
	{
		if (!$this->session->userdata('reset_email')) {
			redirect('auth');
		}

		$this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[3]|matches[password2]');
		$this->form_validation->set_rules('password2', 'Repeat Password', 'trim|required|min_length[3]|matches[password1]');

		if ($this->form_validation->run() == FALSE) {
			$data['judul'] 	= "Ubah Kata Sandi";
			$this->load->helper('form');
			$this->load->view('v_changepassword', $data);
		} else {
			$password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
			$email = $this->session->userdata('reset_email');

			$this->db->set('field_password', $password);
			$this->db->where('field_email', $email);
			$this->db->update('tbluserlogin');

			$this->session->unset_userdata('reset_email');

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kata sandi telah diubah! Silahkan masuk.</div>');
			redirect('auth');
		}
	}


	public function logout()
	{
		$this->session->sess_destroy();
		redirect('Auth', 'refresh');
	}

	//verifikasi
	public function verifikasi()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$Q = $this->db->query("SELECT * FROM tbluserlogin U 
								JOIN tblnasabah N ON U.field_user_id=N.id_UserLogin
								WHERE U.field_status_aktif='0' 
								AND U.field_email='$email' 
								AND U.field_token='$token'
								ORDER BY U.field_user_id DESC LIMIT 1");
		$R  = $Q->row();
		$N	= $Q->num_rows();

		// echo $R->field_email;
		if ($N == 1) {
			# code...
			$member_id    		= $R->field_member_id;
			$nama_lg      		= $R->field_nama;
			$handphone    		= $R->field_handphone;
			$Query_norekening 	= $R->No_Rekening;
			$date     			= date('Y-m-d');
			$time     			= date('H:i:s');


			$this->db->query("UPDATE tblnasabah N, tbluserlogin U 
							SET N.Tgl_Nasabah='$date',N.Konfirmasi='Y',U.field_status_aktif='1'
							WHERE N.id_UserLogin=U.field_user_id AND U.field_email='$email'");

			//noReff
			$nomor = $this->db->query("SELECT field_no_referensi FROM tbltrxmutasisaldo ORDER BY field_no_referensi DESC LIMIT 1")->row_array();
			if ($nomor['field_no_referensi'] == "") {
				$no = 1;
				$thn = date('Y');
				$thn = substr($thn, -2);
				$reff = "Reff";
				$char = $thn . $reff;
				$noReff = $char . sprintf("%09s", $no);
			} else {
				//jika tahun pendaftaran user tidak sama dengan tahun hari ini maka nomor kereset menjadi awal jika tidak maka nomor melajutkan
				$tahun = substr($R->field_tanggal_reg, 2, 2);
				$tahunSekarang = substr(date('Y'), 2, 2);
				if ($tahun !== $tahunSekarang) {
					$no = 1;
					$thn = date('Y');
					$thn = substr($thn, -2);
					$reff = "Reff";
					$char = $thn . $reff;
					$noReff = $char . sprintf("%09s", $no);
				} else {
					$noreff = $nomor['field_no_referensi'];
					$noUrut = substr($noreff, 6);
					$no = $noUrut + 1;
					$thn = date('Y');
					$thn = substr($thn, -2);
					$reff = "Reff";
					$char = $thn . $reff;
					$noReff = $char . sprintf("%09s", $no);
				}
			}
			$M = [
				'field_member_id' 		=> $member_id,
				'field_no_referensi'   	=> $noReff,
				'field_rekening'    	=> $Query_norekening,
				'field_tanggal_saldo'   => $date,
				'field_time'  			=> $time,
				'field_status' 			=> 'S',
				'field_comments' 		=> "Balance"
			];

			$this->db->insert('tbltrxmutasisaldo', $M);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Aktivasi Sukses!! .</div>');
			redirect('Auth');
		} else {
			# code...
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Aktivasi akun gagal!! Token expired.</div>');
			redirect('Auth');
		}
	}
	//Kirim Email
	public function send_mail()
	{
		$email = $this->input->post('email');
		//Mencari email yang di input
		$query 	= $this->db->query("SELECT * FROM tbluserlogin WHERE field_email ='$email' LIMIT 1");
		$N 		= $query->num_rows();
		$row 	= $query->row();

		if ($N > 0) {
			$Q 	= $this->db->query("SELECT * FROM tbluserlogin WHERE field_email ='$email' AND field_status_aktif='1' LIMIT 1");
			$X 	= $Q->num_rows();
			$R 	= $Q->row_array();
			$password = rand();
			$pass = password_hash($password, PASSWORD_DEFAULT);
			$data = array(
				'field_password' => $pass
			);
			if ($X > 0) {
				$this->db->where('field_email', $email);
				$this->db->update('tbluserlogin', $data);
				$tokenn = base64_encode(random_bytes(32));
				// $tokenn = md5(date('H:I:S'));
				$nama = $row->field_nama;
				$from = 'Bank Sampah Pintar';
				if ($this->input->post('pilih') == 'forgot') {
					$subject = 'Reset Password';
					$content = 'Reset Password';
					$button  = 'Ubah Sandi';
				} else {
					$subject = 'Akun Verifikasi';
					$content = 'Pendaftaran';
					$button  = 'Aktifkan';
				}
				// PHPMailer object
				// $response = false;
				$mail = new PHPMailer();
				// SMTP configuration
				$mail->isSMTP();
				$mail->Host     = SERVERMAIL; //sesuaikan sesuai nama domain hosting/server yang digunakan
				$mail->SMTPAuth = true;
				$mail->Username = EMAIL; // user email
				$mail->Password = PASSMAIL; // password email
				$mail->SMTPSecure = 'ssl';
				$mail->Port     = 465;

				$mail->setFrom(EMAIL, FROM); // user email
				$mail->addReplyTo('', 'noreply'); //user email
				$mail->addAddress($this->input->post('email')); //email tujuan pengiriman email
				$mail->Subject = $subject; //subject email
				$mail->isHTML(true);
				$mail->Body = sendmailuser($nama, $email, $content, $password, $tokenn, $button);

				// Send email
				if (!$mail->send()) {
					echo 'Message could not be sent.';
					echo 'Mailer Error: ' . $mail->ErrorInfo;
				} else {
					$this->session->set_flashdata('message', show_succ_msg('Password dikirim ke Email'));
					redirect('Auth');
				}
			} else {

				$this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Anda Belum Aktifasi. !, Segerah Cek Email.! </div>');
				redirect('Auth/lupapassword');
			}
		} else {

			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email tidak ditemukan!!.</div>');
			redirect('Auth/lupapassword');
		}
	}

	private function _sendEmail($email, $subject, $nama, $content, $button, $password, $tokenn)
	{
		// PHPMailer object
		// $response = false;
		$mail = new PHPMailer();
		// SMTP configuration
		$mail->isSMTP();
		$mail->Host     = SERVERMAIL; //sesuaikan sesuai nama domain hosting/server yang digunakan
		$mail->SMTPAuth = true;
		$mail->Username = EMAIL; // user email
		$mail->Password = PASSMAIL; // password email
		$mail->SMTPSecure = 'ssl';
		$mail->Port     = 465;

		$mail->setFrom(EMAIL, FROM); // user email
		$mail->addReplyTo('', 'noreply'); //user email
		$mail->addAddress($email); //email tujuan pengiriman email
		$mail->Subject = $subject; //subject email
		$mail->isHTML(true);
		$mail->Body = sendmailuser($nama, $email, $content, $password, $tokenn, $button);
		// $mail->Body = $nama . '/' . $content . '/' . $button . '/' . $email . '/' . $tokenn;

		// Send email
		if (!$mail->send()) {
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {

			$this->session->set_flashdata('message', show_succ_msg('Segera cek Email Anda'));
		}
	}
}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */