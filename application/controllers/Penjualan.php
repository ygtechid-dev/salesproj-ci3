<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Penjualan_model');
    $this->load->model('Transaksi_model');
    $this->load->model('UserModel');
    $this->load->model('Barang_model');
    $this->load->library('session');
    $this->load->library('form_validation');
  }

  public function index()
  {
    $data['title'] = 'Kelola Penjualan';
    $data['penjualan'] = $this->Penjualan_model->getAllPenjualan();
    $data['negosiator'] = $this->Penjualan_model->getNegosiators();
    $data['sopir'] = $this->Penjualan_model->getSopirs();

    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('penjualan/index', $data);
    $this->load->view('template/footer');
  }

  public function add()
  {
    $this->form_validation->set_rules('tanggal_penjualan', 'Tanggal Penjualan', 'required');
    $this->form_validation->set_rules('id_negosiator', 'Negosiator', 'required');
    $this->form_validation->set_rules('sopir', 'Sopir', 'required');
    $this->form_validation->set_rules('tuan_rumah', 'Tuan Rumah', 'required');

    if ($this->form_validation->run() == FALSE) {
      $this->session->set_flashdata('error', validation_errors());
      redirect('penjualan');
    } else {
      $data = [
        'tanggal_penjualan' => $this->input->post('tanggal_penjualan'),
        'nego' => $this->input->post('id_negosiator'),
        'sopir' => $this->input->post('sopir'),
        'tuan_rumah' => $this->input->post('tuan_rumah'),
        'id_tuan_rumah' => date('Y-m-d H:i:s') . '_' . $this->input->post('tuan_rumah')
      ];

      $result = $this->Penjualan_model->addPenjualan($data);

      if ($result) {
        $this->session->set_flashdata('success', 'Penjualan berhasil ditambahkan');
      } else {
        $this->session->set_flashdata('error', 'Gagal menambahkan penjualan');
      }

      redirect('penjualan');
    }
  }

  public function delete($id)
  {
    if (!$id) {
      $this->session->set_flashdata('error', 'ID Penjualan tidak valid');
      redirect('penjualan');
    }

    $result = $this->Penjualan_model->deletePenjualan($id);

    if ($result) {
      $this->session->set_flashdata('success', 'Penjualan berhasil dihapus');
    } else {
      $this->session->set_flashdata('error', 'Gagal menghapus penjualan');
    }

    redirect('penjualan');
  }

  public function detail($id = null)
  {
    if ($id === null) {
      $this->session->set_flashdata('error', 'ID penjualan tidak ditemukan.');
      redirect('penjualan/index');
    }

    $penjualan = $this->Penjualan_model->getPenjualanById($id);
    if (!$penjualan) {
      $this->session->set_flashdata('error', 'Data penjualan tidak ditemukan.');
      redirect('penjualan/index');
    }

    $data['penjualan'] = $penjualan;
    $data['transaksis'] = $this->Transaksi_model->get_transaksi_by_penjualan_id($id);
    $data['sales'] = $this->UserModel->getSales();
    $data['barang_list'] = $this->Barang_model->getAllBarang();

    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('penjualan/detail', $data);
    $this->load->view('template/footer');
  }

  public function add_transaksi()
  {
    $this->form_validation->set_rules('penjualan_id', 'ID Penjualan', 'required');
    $this->form_validation->set_rules('nama_sales', 'Nama Sales', 'required');
    $this->form_validation->set_rules('barang', 'Barang', 'required');
    $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
    $this->form_validation->set_rules('nama_pembeli', 'Nama Pembeli', 'required');
    $this->form_validation->set_rules('uang_akad', 'Uang Akad', 'required|numeric');

    if ($this->form_validation->run() == FALSE) {
      $this->session->set_flashdata('error', validation_errors());
      redirect("penjualan/detail/" . $this->input->post('penjualan_id'));
    } else {
      $penjualan_id = $this->input->post('penjualan_id');
      $penjualan = $this->Penjualan_model->getPenjualanById($penjualan_id);

      if (!$penjualan) {
        $this->session->set_flashdata('error', 'Penjualan tidak ditemukan.');
        redirect("penjualan/index");
      }

      $data = [
        'id_sales' => $this->input->post('nama_sales'),
        'id_barang' => $this->input->post('barang'),
        'harga' => $this->input->post('harga'),
        'customer' => $this->input->post('nama_pembeli'),
        'uang_akad' => $this->input->post('uang_akad'),
        'id_tuan_rumah' => $penjualan['id'],
        'id_negosiator' => $penjualan['nego'],
        'id_sopir' => $penjualan['sopir'],
      ];

      $inserted = $this->Transaksi_model->insert($data);

      if ($inserted) {
        $this->session->set_flashdata('success', 'Transaksi berhasil ditambahkan.');
      } else {
        $this->session->set_flashdata('error', 'Gagal menambahkan transaksi. Silakan coba lagi.');
      }

      redirect("penjualan/detail/$penjualan_id");
    }
  }
}