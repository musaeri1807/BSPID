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
		if ($session == '') {
			$data['judul'] = "Situ Login BSPID";
			$this->load->view('v_login', $data);
		} else {
			redirect('Home');
		}
	}

	public function login()
	{
		$this->form_validation->set_rules('txt_email', 'Email', 'required');
		$this->form_validation->set_rules('txt_password', 'Password', 'required');
		if ($this->form_validation->run() == TRUE) {
			$username = trim($_POST['txt_email']);
			$pass = trim($_POST['txt_password']);
			$data = $this->M_auth->login($username);
			if (!password_verify($pass, $data->field_password) == true) {
				$this->session->set_flashdata('error_msg', 'Username atau Password Anda Salah.');
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
			$this->session->set_flashdata('error_msg', validation_errors());
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

		if ($this->form_validation->run()==false){
			$data['judul'] 	= "Signup BSPID";
			$data['C']=$this->M_frontend->select_all_branch();
			$this->load->view('v_register', $data);
		}else{
			// echo "input data";
			$R=[
				'field_nama'  		=>$this->input->post('name'),
				'field_email' 		=>$this->input->post('email'),
				'field_handphone'  	=>$this->input->post('nohp'),
				'field_password'	=>password_hash($this->input->post('password'),PASSWORD_DEFAULT),
				'field_branch'		=>$this->input->post('cabang'),
				'field_status_aktif'=>'0',
				'field_blokir_status'=>'A',
				'field_log'			=>date('Y-m-d H:s'),
				'field_token_otp'	=>date('Y'),
				'field_ipaddress'	=>$_SERVER['REMOTE_ADDR']
			];

			var_dump($R);
		}
	}

	public function lupapassword()
	{
		$data['judul'] 		= "Lupa Password BSPID";
		$this->load->helper('form');
		$this->load->view('v_lupaspassword', $data);
	}


	public function logout()
	{
		$this->session->sess_destroy();
		redirect('Auth');
	}

	//verifikasi
	public function verifikasi()
	{
		$email = $this->input->get('M');
		var_dump($email);
	}
	//Kirim Email
	public function send_mail()
	{
		$email = $this->input->post('email');
		$sql = "SELECT * FROM tbluserlogin WHERE field_email ='$email' LIMIT 1";
		$get_nas = $this->db->query($sql);
		$query = $this->db->query("SELECT * FROM tbluserlogin WHERE field_email ='$email' LIMIT 1");
		$row = $query->row();


		if ($get_nas->num_rows() > 0) {
			$tokenn = md5('sadfkjkjiqwfkjifqwfwfu');
			$nama = $row->field_nama;
			$password = $row->Password;

			$from = 'No Replay';
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

			$mail->setFrom(EMAIL, $from); // user email
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
				$out['msg'] = show_succ_msg('Data Pegawai Berhasil ditambahkan', '20px');
				// $this->session->set_flashdata('message', 'Email Terkirim');
				redirect('Auth');
			}
		} else {
			// $this->session->set_flashdata('message', '');
			$this->session->set_flashdata('msg', show_err_msg('Email Tidak Di Temukan'));
			redirect('Frontend');
		}
	}
}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */