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
        $data['titale']     = "BSP";
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
        $data['titale']     = "BSP";
        $data['totalunit']  = "3";
        $data['telpon']='085780390850';
        $data['tagline']='Digitalisasi Sampah';        
        $this->load->view('frontend/v_header',$data);
        $this->load->view('frontend/v_tentangkami', $data);
        $this->load->view('frontend/v_footer',$data);

    }
    public function layanan()
    {
        $data['titale']     = "BSP";
        $data['totalunit']  = "3";
        $data['telpon']='085780390850';
        $data['tagline']='Digitalisasi Sampah';        
        $this->load->view('frontend/v_header',$data);
        $this->load->view('frontend/v_layanan', $data);
        $this->load->view('frontend/v_footer',$data);
    }
}
