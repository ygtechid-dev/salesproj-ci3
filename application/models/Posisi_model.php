<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Posisi_model extends CI_Model
{
    // Ambil semua data posisi
    public function getAllPosisi()
    {
        return $this->db->get('mgt_posisi')->result_array();
    }

    // Tambah posisi baru
    public function addPosisi($data)
    {
        return $this->db->insert('mgt_posisi', $data);
    }

    // Hapus posisi
    public function deletePosisi($id)
    {
        return $this->db->delete('mgt_posisi', array('id_posisi' => $id));
    }

    // Update posisi
    public function updatePosisi($id, $data)
    {
        $this->db->where('id_posisi', $id);
        return $this->db->update('mgt_posisi', $data);
    }
}
