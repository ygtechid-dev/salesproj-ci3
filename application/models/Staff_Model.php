<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Staff_model extends CI_Model
{
    // Fungsi untuk mengambil semua data staff dari tabel mgt_user
    public function getAllStaff()
    {
        $this->db->select('mgt_user.*, mgt_posisi.nama_posisi');
        $this->db->from('mgt_user');
        $this->db->join('mgt_posisi', 'mgt_user.posisi = mgt_posisi.id_posisi');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    // Fungsi untuk menghapus staff berdasarkan id
    public function deleteStaff($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('mgt_user');
    }

    public function getAllPosisi() {
        return $this->db->get('mgt_posisi')->result_array();
    }

    

    // Fungsi untuk menambah staff baru
    public function addStaff($data)
    {
        return $this->db->insert('mgt_user', $data);
    }

    // Fungsi untuk mengambil data staff berdasarkan id
    public function getStaffById($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('mgt_user')->row_array();
    }

    // Fungsi untuk memperbarui data staff
    public function updateStaff($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('mgt_user', $data);
    }
}
