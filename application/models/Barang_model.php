<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang_model extends CI_Model
{

  public function getAllBarang()
  {
    return $this->db->get('barang')->result_array();
  }

  public function getBarangById($id)
  {
    return $this->db->get_where('barang', ['id_barang' => $id])->row_array();
  }
}