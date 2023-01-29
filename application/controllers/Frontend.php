<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Frontend extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        // $this->load->model('m_data');

    }

    public function index()
    {
        $data['titale']     = "BSP";
        $data['totalunit']  = "3";
        $data['nasabah']     = "226";
        $data['sampah']     = "500000";
        $data['produk']     =
            [
                'image' => 'kardus','tu',
                'harga' => '1000','90'
            ];

        $this->load->view('frontend/v_index', $data);
        // $this->load->view('frontend/v_homepage');
        // $this->load->view('frontend/v_footer');
    }

    public function tentangkami()
    {
        $data['titale']     = "BSP";
        $data['totalunit']  = "3";
        $data['nasabah']     = "226";
        $data['sampah']     = "500000";

        $this->load->view('frontend/v_tentangkami', $data);
        // $this->load->view('frontend/v_homepage');
        // $this->load->view('frontend/v_footer');
    }
    public function layanan()
    {
        $data['titale']     = "BSP";
        $data['totalunit']  = "3";
        $data['nasabah']     = "226";
        $data['sampah']     = "500000";

        $this->load->view('frontend/v_layanan', $data);
        // $this->load->view('frontend/v_homepage');
        // $this->load->view('frontend/v_footer');
    }
}
