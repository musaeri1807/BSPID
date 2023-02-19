<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Frontend extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('M_frontend'); 

    }

    public function index()
    {
        $data['D']=$this->M_frontend->total_desposit();
        $data['N']=$this->M_frontend->total_nasabah();
        $data['S']=$this->M_frontend->total_Sampah();
        $data['P']=$this->M_frontend->select_all_product();
        $data['titale']     = "Situs Bank Sampah Pintar Online | BSPID";
        $data['totalunit']  = "2";
        $data['telpon']='085780390850';
        $data['tagline']='Digitalisasi Sampah';
        $Comment='Alhamdulillah ya selama 2 tahun lebih menjadi bank sampah unit di Bank Sampah Pintar pelayanannya bagus.
                Penjemputan ke unit juga lancar. Kami juga mendapatkan banyak manfaat salah satunya bisa mengikuti banyak seminar dan pelatihan.
                Selain itu, kami juga merasakan dampak positif terhadap lingkungan.
                Sampah yang terbuang ke TPA semakin sedikit dan lebih meringankan beban petugas pengangkut sampah.';
        $data['O'] = [
			["Foto"=>"testimonial-1.jpg","Comment"=>$Comment,"Petugas"=>"Fatimah",'Unit'=>'Unit 01'],
			["Foto"=>"testimonial-2.jpg","Comment"=>$Comment,"Petugas"=>"Slamet",'Unit'=>'Unit 02'],
			["Foto"=>"testimonial-1.jpg","Comment"=>$Comment,"Petugas"=>"Sarah",'Unit'=>'Unit 03'] 
		];
        
        // $this->load->view('frontend/v_index', $data);
        $this->load->view('frontend/v_header',$data);
        $this->load->view('frontend/v_homepage',$data);
        $this->load->view('frontend/v_footer',$data);
    }

    public function tentangkami()
    {
        $data['titale']     = "Situs Bank Sampah Pintar Online | BSPID";
        $data['totalunit']  = "3";
        $data['telpon']='085780390850';
        $data['tagline']='Digitalisasi Sampah';        
        $this->load->view('frontend/v_header',$data);
        $this->load->view('frontend/v_tentangkami', $data);
        $this->load->view('frontend/v_footer',$data);

    }
    public function layanan()
    {
        $data['titale']     = "Situs Bank Sampah Pintar Online | BSPID";
        $data['totalunit']  = "3";
        $data['telpon']='085780390850';
        $data['tagline']='Digitalisasi Sampah';        
        $this->load->view('frontend/v_header',$data);
        $this->load->view('frontend/v_layanan', $data);
        $this->load->view('frontend/v_footer',$data);
    }

    public function unit()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('bank_sampah', 'Bank Sampah', 'required|trim');
        $this->form_validation->set_rules('jumlah_pengurus', 'Jumlah Pengurus', 'required|trim');
        $this->form_validation->set_rules('nama_ketua', 'Nama Ketua', 'required|trim');
        $this->form_validation->set_rules('nohp', 'No HP', 'required|trim');

        $this->form_validation->set_rules('provinsi', 'Provinsi', 'required|trim');
		$this->form_validation->set_rules('kabupaten', 'Kabupaten', 'required|trim');
        $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required|trim');
        $this->form_validation->set_rules('desa', 'Desa', 'required|trim');
        
        $this->form_validation->set_rules('username', 'User Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tblemployeeslogin.field_email]', [
            'is_unique' => 'This email has already registered!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[5]', [            
            'min_length' => 'Kata sandi terlalu pendek!'
        ]);

        if( $this->form_validation->run()== false){
        $data['titale']= "Situs Bank Sampah Pintar Online | BSPID";
        $get_prov = $this->db->select('*')->from('tblwilayahprovinsi')->get();
		$data['provinsi'] = $get_prov->result();
        $this->load->view('register/v_regiterunit',$data);           
        }else{

            $email = $this->input->post('email', true);
            $ID=$this->db->query('SELECT field_employees_id AS IDUSER FROM tblemployeeslogin ORDER BY field_user_id DESC LIMIT 1');
            $result=$ID->row();
            $NO =$result->IDUSER;
            $th=date('y');
            $bln=date('m');            
            $Nomor=substr($NO,4);
            $no = $Nomor + 1;
            $char=$th.$bln;
            $Iduser = $char . sprintf("%04s", $no);

            $dataUser = [
                'field_employees_id'=>  $Iduser,
                'field_name_officer'=> $this->input->post('name'),
                'field_username'=> $this->input->post('username'),
                'field_date_reg'=> date('Y-m-d'),
                'field_branch'=> $this->input->post('desa'),
                'field_email'=> htmlspecialchars($email),
                'field_password'=> password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'Password'=> $this->input->post('password'),
                'field_token'=> md5(date('d-m-Y H:i:s').rand()),
                'field_handphone'=> $this->input->post('nohp'),
                'field_status_aktif'=> '2',
                'field_log'=> date('Y-m-d H:i:s')
            ];
           
            $QUERY=$this->db->query('SELECT field_account_numbers AS NA FROM tblbranch ORDER BY field_id DESC LIMIT 1');
            $N=$QUERY->row();
            $Number =$N->NA;
            $Angka = $Number+1;       
            $datacabang=[
                'field_branch_id'=> $this->input->post('desa'),
                'field_account_numbers'=> $Angka,
                'field_branch_name'=> $this->input->post('kecamatan'),
                'head_office_id'=> '5',
                'head_office'=> 'ANTAM LM'
            ];
            $this->db->insert('tblemployeeslogin',$dataUser);
            $this->db->insert('tblbranch',$datacabang);
            $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Selamat! Akun anda telah dibuat. Silakan Hubungi kami dengan Klik link <a href="https://wa.link/55k047">|<b>Chat Whatsapp</b>|</a> Untuk konfirmasi aktifkan akun Anda</div>');
            redirect('Frontend/unit');
        }

    }

    function add_ajax_kab($id_prov)
	{
		$query = $this->db->get_where('tblwilayahkabupaten', array('field_provinsi_id' => $id_prov));
	    $data = '<option value="' . set_value('kabupaten') . '">-Pilih Kabupaten-</option>';
		foreach ($query->result() as $value) {
			$data .= "<option value='" . $value->field_kabupaten_id . "'>" . $value->field_nama_kabupaten . "</option>";
		}
		echo $data;
	}

	function add_ajax_kec($id_kab)
	{
		$query = $this->db->get_where('tblwilayahkecamatan', array('field_kabupaten_id' => $id_kab));
        $data = '<option value="' . set_value('kecamatan') . '">- Pilih Kecamatan - </option>';
		foreach ($query->result() as $value) {
			$data .= "<option value='" . $value->field_kecamatan_id . "'>" . $value->field_nama_kecamatan . "</option>";
		}
		echo $data;
	}

	function add_ajax_des($id_kec)
	{
		$query = $this->db->get_where('tblwilayahdesa', array('field_kecamatan_id' => $id_kec));
		$data = '<option value="' . set_value('desa') . '">- Pilih Desa- </option>';
		foreach ($query->result() as $value) {
			$data .= "<option value='" . $value->field_desa_id . "'>" . $value->field_nama_desa . "</option>";
		}
		echo $data;
	}
}
