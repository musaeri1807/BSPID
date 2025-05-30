<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends AUTH_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_users');
	}
	public function index()
	{
		$data['userdata'] 		= $this->userdata;
		$id = $this->userdata->field_user_id;
		$data['page'] 			= "profile";
		$data['judul'] 			= "Profile";
		$data['deskripsi'] 		= "Setting Profile";

		$get_prov = $this->db->select('*')->from('tblwilayahprovinsi')->get();
		$data['provinsi'] = $get_prov->result();
		$data['path'] = base_url('assets');
		$sql = "SELECT N.*,U.*,PRO.field_nama_provinsi AS PROVINSI, KAB.field_nama_kabupaten AS KABUPATEN,KEC.field_nama_kecamatan AS KECAMATAN,DES.field_nama_desa AS DESA
				FROM tblnasabah N 
				LEFT JOIN tbluserlogin U ON N.id_UserLogin=U.field_user_id
				LEFT JOIN tblwilayahprovinsi PRO ON N.Provinsi_N=PRO.field_provinsi_id
				LEFT JOIN tblwilayahkabupaten KAB ON N.Kabupaten_N=KAB.field_kabupaten_id
				LEFT JOIN tblwilayahkecamatan KEC ON N.Kecamatan_N=KEC.field_kecamatan_id
				LEFT JOIN tblwilayahdesa DES ON N.Kelurahan_N=DES.field_desa_id
				WHERE U.field_user_id =$id ORDER BY N.id_Nasabah LIMIT 1";
		$get_nas = $this->db->query($sql);
		$data['nasabah'] = $get_nas->row();
		$this->template->views('v_profile', $data);
	}


	public function update()
	{
		// $this->form_validation->set_rules('field_username', 'Username', 'trim|required|min_length[4]|max_length[15]');
		$this->form_validation->set_rules('field_email', 'nama', 'trim|required');
		$this->form_validation->set_rules('field_nama', 'nama', 'trim|required');

		$id = $this->userdata->field_user_id;
		$data = $this->input->post();

		if ($this->form_validation->run() == TRUE) {
			$config['upload_path'] = './assets/img/';
			$config['allowed_types'] = 'jpg|png|svg';
			$config['max_size']        = 2048;
			// $config['max_width']            = 215;
			// $config['max_height']           = 215;
			$config['file_name'] = $id;


			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('field_photo')) {
				$error = array('error' => $this->upload->display_errors());
			} else {
				$data_foto = $this->upload->data();

				$data['field_photo'] = $data_foto['file_name'];
			}

			$result = $this->M_users->update($data, $id);

			if ($result > 0) {
				$this->updateProfil();
				$this->session->set_flashdata('msg', show_succ_msg('Data Profile Berhasil diubah'));
				redirect('Profile');
			} else {
				$this->session->set_flashdata('msg', show_err_msg('Data Profile Gagal diubah'));
				redirect('Profile');
			}
		} else {
			$this->session->set_flashdata('msg', show_err_msg(validation_errors()));
			redirect('Profile');
		}
	}

	public function ubah_password()
	{
		$this->form_validation->set_rules('passLama', 'Password Lama', 'trim|required');
		$this->form_validation->set_rules('passBaru', 'Password Baru', 'trim|required');
		$this->form_validation->set_rules('passKonf', 'Password Konfirmasi', 'trim|required');
		$id = $this->userdata->field_user_id;

		if ($this->form_validation->run() == TRUE) {

			$pass = trim($_POST['passLama']);
			$id;
			$password = trim($_POST['passKonf']);
			$this->input->post('passBaru');

			if (password_verify($pass, $this->userdata->field_password) == true) {
				echo "cek password new dan konfirmasi benar";
				if ($this->input->post('passBaru') != $this->input->post('passKonf')) {
					$this->session->set_flashdata('msg', show_err_msg('Password Baru dan Konfirmasi Password harus sama'));
					redirect('Changepassword');
				} else {
					$datapassword = password_hash($this->input->post('passBaru'), PASSWORD_DEFAULT);

					$data = [
						'field_password' => $datapassword,
						'Password'		 => $password
					];

					$result = $this->M_users->update($data, $id);
					if ($result > 0) {
						$this->updateProfil();
						$this->session->set_flashdata('msg', show_succ_msg('Password Berhasil diubah'));
						redirect('Changepassword');
					} else {
						$this->session->set_flashdata('msg', show_err_msg('Password Gagal diubah'));
						redirect('Changepassword');
					}
				}
			} else {
				$this->session->set_flashdata('msg', show_err_msg('Password Salah'));
				redirect('Changepassword');
			}
		} else {
			$this->session->set_flashdata('msg', show_err_msg(validation_errors()));
			redirect('Changepassword');
		}
	}
	public function personal()
	{
		 $this->form_validation->set_rules('NIK', 'Nomor Induk Kependudukan', 'required|trim|min_length[16]', [            
            'min_length' => 'Nomor terlalu pendek!'
        ]);
		$this->form_validation->set_rules('NPWP', 'Nomor Pokok Wajib Pajak', 'required|trim|min_length[16]', [            
            'min_length' => 'Nomor terlalu pendek!'
        ]);
		// $this->form_validation->set_rules('NIK', 'Nomor Induk Kependudukan', 'trim|required');
		// $this->form_validation->set_rules('', '', 'trim|required');

		if ($this->form_validation->run() == TRUE) {
		$id = $this->userdata->field_user_id;
		$Profile=[
			'Nik_Nasabah'=>$this->input->post('NIK'),
			'Tgl_Nasabah'=>date('Y-m-d'),
			'Jenis_Kelamin_N'=>$this->input->post('gender'),
			'Alamat_Nasabah'=>$this->input->post('alamat'),
			'Provinsi_N'=>$this->input->post('provinsi'),
			'Kabupaten_N'=>$this->input->post('kabupaten'),
			'Kecamatan_N'=>$this->input->post('kecamatan'),
			'Kelurahan_N'=>$this->input->post('desa')
		];

		$this->db->where('id_UserLogin', $id);
		$this->db->update('tblnasabah', $Profile);
		$this->session->set_flashdata('msg', show_succ_msg('Profile Berhasil diubah'));
		redirect('Profile');
		} else {
			$this->session->set_flashdata('msg', show_err_msg(validation_errors()));
			redirect('Profile');
		}
	}


	function add_ajax_kab($id_prov)
	{
		$query = $this->db->get_where('tblwilayahkabupaten', array('field_provinsi_id' => $id_prov));
		$data = "<option value=''>- Pilih Kabupaten -</option>";
		foreach ($query->result() as $value) {
			$data .= "<option value='" . $value->field_kabupaten_id . "'>" . $value->field_nama_kabupaten . "</option>";
		}
		echo $data;
	}

	function add_ajax_kec($id_kab)
	{
		$query = $this->db->get_where('tblwilayahkecamatan', array('field_kabupaten_id' => $id_kab));
		$data = "<option value=''> - Pilih Kecamatan - </option>";
		foreach ($query->result() as $value) {
			$data .= "<option value='" . $value->field_kecamatan_id . "'>" . $value->field_nama_kecamatan . "</option>";
		}
		echo $data;
	}

	function add_ajax_des($id_kec)
	{
		$query = $this->db->get_where('tblwilayahdesa', array('field_kecamatan_id' => $id_kec));
		$data = "<option value=''> - Pilih Desa - </option>";
		foreach ($query->result() as $value) {
			$data .= "<option value='" . $value->field_desa_id . "'>" . $value->field_nama_desa . "</option>";
		}
		echo $data;
	}
}

/* End of file Profile.php */
/* Location: ./application/controllers/Profile.php */