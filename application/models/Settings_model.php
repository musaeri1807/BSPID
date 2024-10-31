<?php

class Settings_model extends CI_Model
{
	function __consturct()
	{
		parent::__construct();
	}
	public function GetSettingsValue()
	{
		$settings = $this->db->dbprefix('settings');
		$sql = "SELECT * FROM $settings";
		$query = $this->db->query($sql);
		$result = $query->row();
		return $result;
	}
	public function SettingsUpdate($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('settings', $data);
	}
	// Fungsi untuk mengambil nilai konfigurasi berdasarkan key
	public function get_config_value($key)
	{
		$this->db->where('key', $key);
		$query = $this->db->get('tblmaintenance');
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return NULL; // Jika tidak ditemukan
		}
	}
	// 
	public function getSettings()
	{
		return $this->db->get('settings')->row_array();
	}

	public function updateSettings($post)
	{

		$data = [
			'name_application' 	=> $post['name_application'],
			'smtp_host' 		=> $post['smtp_host'],
			'smtp_port' 		=> $post['smtp_port'],
			'smtp_username' 	=> $post['smtp_username'],
			'smtp_email' 		=> $post['smtp_email'],
			'smtp_password' 	=> $post['smtp_password']
		];
		// var_dump($_FILES);
		// die();
		if ($_FILES['sitelogo']['name']) {
			$data['sitelogo'] = _upload('sitelogo', 'settings', 'settings');
			delImage('settings', 1, 'sitelogo');
		}

		$this->db->update('settings', $data);
	}
}
