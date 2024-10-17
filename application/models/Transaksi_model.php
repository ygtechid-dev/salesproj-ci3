<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_model extends CI_Model
{

    private $table = 'transaksi';

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Penjualan_model');
        $this->load->model('Transaksi_model');
        $this->load->model('UserModel');
        $this->load->model('Barang_model');
    }
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

    public function getTransaksisByTuanRumah($id_tuan_rumah)
    {
        // Sesuaikan query ini dengan struktur tabel Anda
        $this->db->select('*'); // Ambil semua kolom yang dibutuhkan
        $this->db->from('transaksi'); // Ganti dengan nama tabel transaksi Anda
        $this->db->where('id_tuan_rumah', $id_tuan_rumah); // Pastikan ini sesuai dengan struktur tabel

        return $this->db->get()->result_array(); // Mengembalikan hasil sebagai array
    }




    public function detail($id_tuan_rumah)
    {
        $data['penjualan'] = $this->Penjualan_model->getPenjualanById($id_tuan_rumah);
        $data['transaksis'] = $this->Transaksi_model->getTransaksisByTuanRumah($id_tuan_rumah); // Use the existing method here
        $data['sales'] = $this->UserModel->getSales();
        $data['barangs'] = $this->Barang_model->getBarangs();

        $this->load->view('penjualan/detail', $data);
    }


    public function get_transaksi_by_penjualan_id($penjualan_id)
    {
        $this->db->select('transaksi.*, mgt_user.nama_lengkap AS nama_sales, barang.nama_barang');
        $this->db->from('transaksi');
        $this->db->join('mgt_user', 'transaksi.id_sales = mgt_user.id_user', 'left');
        $this->db->join('barang', 'transaksi.id_barang = barang.id_barang', 'left');
        $this->db->where('transaksi.id_tuan_rumah', $penjualan_id);
        return $this->db->get()->result_array();
    }

    
}