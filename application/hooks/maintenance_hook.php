<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Check whether the site is offline or not.
 *
 */

class Maintenance_hook
{
    protected $CI;
    function __construct()
    {
        $this->CI = &get_instance();
    }
    public function offline_check()
    {
        log_message('debug', 'Hook offline_check called');  // Tambahkan log ini
        // Dapatkan instance CodeIgniter
        $CI = &get_instance(); // Ambil instance dari CI

        // Memuat model Settings_model untuk mengambil konfigurasi dari database
        $CI->load->model('Settings_model');

        // Mendapatkan nilai maintenance_mode dari database
        $maintenance_mode_value = $CI->Settings_model->get_config_value('maintenance_mode');

        // Konversi nilai menjadi boolean

        // $maintenance_mode = ($maintenance_mode_value->value === 'TRUE') ? TRUE : FALSE;
        // atau
        if ($maintenance_mode_value->value === 'TRUE') {
            $maintenance_mode = TRUE;
        } else {
            $maintenance_mode = FALSE;
        }

        // Set nilai konfigurasi maintenance_mode secara dinamis
        $CI->config->set_item('maintenance_mode', $maintenance_mode);

        // Data yang ingin dikirim ke view
        $data = array(
            'infomail' => $maintenance_mode_value->info_mail,
            'nomor' => $maintenance_mode_value->info_nomor
        );

        // Ekstrak variabel dari array $data menjadi variabel individu
        extract($data);

        // Cek apakah maintenance mode aktif
        if ($CI->config->item('maintenance_mode') === TRUE) {
            // Tampilkan halaman pemeliharaan
            include(APPPATH . 'views/v_maintenance.php');
            exit;  // Menghentikan eksekusi lebih lanjut
        }
    }
}



// class Maintenance_hook
// {
//     public function __construct()
//     {
//         log_message('debug', 'Accessing maintenance hook!');
//     }

//     public function offline_check()
//     {
//         if (file_exists(APPPATH . 'config/config.php')) {
//             include(APPPATH . 'config/config.php');

//             if (isset($config['maintenance_mode']) && $config['maintenance_mode'] === TRUE) {
//                 include(APPPATH . 'views/v_maintenance.php');
//                 exit;
//             }
//         }
//     }
// }
