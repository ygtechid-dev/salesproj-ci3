<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting_model extends CI_Model
{
    // Ambil semua data setting
    public function getAllSettings()
    {
        return $this->db->get('setting_mgt')->result_array();
    }

    // Tambah setting baru
    public function addSetting($data)
    {
        return $this->db->insert('setting_mgt', $data);
    }

    // Hapus setting
    public function deleteSetting($id)
    {
        return $this->db->delete('setting_mgt', array('id_setting' => $id));
    }

    // Update setting
    public function updateSetting($id, $data)
    {
        $this->db->where('id_setting', $id);
        return $this->db->update('setting_mgt', $data);
    }
}
