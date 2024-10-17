<?php
class Penjualan_model extends CI_Model
{
  public function getAllPenjualan()
  {
    $this->db->select('penjualan.*, negosiator.nama_lengkap AS nama_nego, sopir.nama_lengkap AS nama_sopir');
    $this->db->from('penjualan');
    $this->db->join('mgt_user AS negosiator', 'penjualan.nego = negosiator.id_user', 'left');
    $this->db->join('mgt_user AS sopir', 'penjualan.sopir = sopir.id_user', 'left');

    return $this->db->get()->result_array();
  }

  public function addPenjualan($data)
  {
    return $this->db->insert('penjualan', $data);
  }

  private function getUsersByPositions($positions)
  {
    $this->db->select('mgt_user.id_user, mgt_user.nama_lengkap, mgt_posisi.nama_posisi');
    $this->db->from('mgt_user');
    $this->db->join('mgt_posisi', 'mgt_user.posisi = mgt_posisi.id_posisi');
    $this->db->where_in('mgt_posisi.nama_posisi', $positions);
    return $this->db->get()->result_array();
  }

  public function getNegosiators()
  {
    return $this->getUsersByPositions(['Negosiator']);
  }

  public function getSopirs()
  {
    return $this->getUsersByPositions(['Sopir']);
  }


  public function deletePenjualan($id)
  {
    $this->db->where('id', $id);
    return $this->db->delete('penjualan');
  }

  

  public function getPenjualanById($id)
  {
    $this->db->select('penjualan.*, negosiator.id_user AS id_negosiator, negosiator.nama_lengkap AS nama_nego, sopir.id_user AS id_sopir, sopir.nama_lengkap AS nama_sopir');
    $this->db->from('penjualan');
    $this->db->join('mgt_user AS negosiator', 'penjualan.nego = negosiator.id_user', 'left');
    $this->db->join('mgt_user AS sopir', 'penjualan.sopir = sopir.id_user', 'left');
    $this->db->where('penjualan.id', $id);

    return $this->db->get()->row_array();
  }

  public function get_transaksi_by_penjualan_id($penjualan_id)
  {
    $this->db->select('transaksi.*, mgt_user.nama_lengkap AS nama_sales, barang.id_barang, barang.nama_barang');
    $this->db->from('transaksi');
    $this->db->join('mgt_user', 'transaksi.id_sales = mgt_user.id_user', 'left');
    $this->db->join('barang', 'transaksi.id_barang = barang.id_barang', 'left');
    $this->db->where('transaksi.id_tuan_rumah', $penjualan_id);
    return $this->db->get()->result_array();
  }

  public function insert($data)
  {
    // Pastikan semua kolom yang diperlukan ada dalam data
    $required_fields = [
      'id_sales',
      'id_barang',
      'harga',
      'customer',
      'uang_akad',
      'id_tuan_rumah',
      'id_negosiator',
      'id_sopir'
    ];

    foreach ($required_fields as $field) {
      if (!isset($data[$field])) {
        return false; // Jika ada field yang hilang, batalkan operasi
      }
    }

    // Set nilai default untuk kolom yang mungkin kosong
    $data['id_kolektor'] = isset($data['id_kolektor']) ? $data['id_kolektor'] : null;
    $data['nama_tuan_rumah'] = isset($data['nama_tuan_rumah']) ? $data['nama_tuan_rumah'] : null;
    $data['alamat_tuan_rumah'] = isset($data['alamat_tuan_rumah']) ? $data['alamat_tuan_rumah'] : null;
    $data['kontak_tuan_rumah'] = isset($data['kontak_tuan_rumah']) ? $data['kontak_tuan_rumah'] : null;
    $data['alamat_customer'] = isset($data['alamat_customer']) ? $data['alamat_customer'] : null;
    $data['kontak_customer'] = isset($data['kontak_customer']) ? $data['kontak_customer'] : null;
    $data['tanggal_jatuh_tempo'] = isset($data['tanggal_jatuh_tempo']) ? $data['tanggal_jatuh_tempo'] : null;

    // Kolom-kolom numerik yang mungkin perlu diset ke null jika kosong
    $numeric_fields = ['termin1', 'termin2', 'termin3', 'termin4', 'prosentase_sales', 'prosentase_negosiator', 'prosentase_kolektor'];
    foreach ($numeric_fields as $field) {
      $data[$field] = isset($data[$field]) && $data[$field] !== '' ? $data[$field] : null;
    }

    // Lakukan insert ke database
    $result = $this->db->insert('transaksi', $data);

    if ($result) {
      return $this->db->insert_id(); // Mengembalikan ID dari transaksi yang baru dibuat
    } else {
      // Log error jika insert gagal
      log_message('error', 'Gagal menyisipkan transaksi: ' . $this->db->error()['message']);
      return false;
    }
  }
}