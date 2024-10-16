<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_model extends CI_Model
{
    // Ambil semua transaksi
    public function getAllTransaksi()
    {
        return $this->db->get('transaksi')->result_array();
    }

    // Tambah transaksi
    public function addTransaksi($data)
    {
        return $this->db->insert('transaksi', $data);
    }

    // Ambil data pengguna untuk dropdown
    public function getUsersByPosition($positionId)
    {
        $this->db->select('id_user, nama_lengkap');
        $this->db->from('mgt_user');
        $this->db->where('posisi', $positionId); // Assuming 'position_id' is the correct column name
        $query = $this->db->get();
    
        return $query->result_array();
    }
    
    // Ambil data setting untuk prosentase
    public function getSetting()
    {
        return $this->db->get('setting_mgt')->row_array();
    }

    public function getTransaksiById($id)
    {
        $this->db->where('id', $id); // Assuming 'id' is the primary key of the 'transaksi' table
        $query = $this->db->get('transaksi'); // Replace 'transaksi' with the actual table name

        if ($query->num_rows() > 0) {
            return $query->row(); // Return the first row of the result
        }

        return null; // Return null if no result is found
    }

    
}
