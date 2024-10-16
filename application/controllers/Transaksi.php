<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Transaksi_model'); // Load Transaksi model
        // $this->load->model('User_model'); // Load User model
        $this->load->library('form_validation'); // Load form validation library
    }

    // Halaman utama Transaksi
    public function index()
    {
        $data['title'] = 'Kelola Transaksi';
        $data['transaksi'] = $this->Transaksi_model->getAllTransaksi(); // Ambil data transaksi
        
        $data['users'] = [
            'sales' => $this->Transaksi_model->getUsersByPosition(2), // Sales (ID 2)
          'negosiator' => $this->Transaksi_model->getUsersByPosition(1), // Negosiator (ID 1)
        'kolektor' => $this->Transaksi_model->getUsersByPosition(3), // Kolektor (ID 3)
        'sopir' => $this->Transaksi_model->getUsersByPosition(4), // Sopir (ID 4)
        ];

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('transaksi/index', $data); // Load view untuk halaman kelola transaksi
        $this->load->view('template/footer');
    }

    // Fungsi untuk mendapatkan detail transaksi
    public function get_detail($id)
    {
        $data['transaksi'] = $this->Transaksi_model->getTransaksiById($id); // Ambil detail transaksi
        $this->load->view('transaksi/detail', $data); // Load view detail
    }


    public function get_dropdown_users()
{
    $data['sales'] = $this->Transaksi_model->getUsersByPosition(2); // Assuming Sales role ID is 2
    $data['negosiator'] = $this->Transaksi_model->getUsersByPosition(1); // Assuming Negosiator role ID is 1
    $data['kolektor'] = $this->Transaksi_model->getUsersByPosition(3); // Assuming Kolektor role ID is 3
    $data['sopir'] = $this->Transaksi_model->getUsersByPosition(4); // Assuming Sopir role ID is 4

    return $data;
}




    // Fungsi untuk menambah transaksi
    public function add()
    {
        // Set validation rules
        $this->form_validation->set_rules('nama_tuan_rumah', 'Nama Tuan Rumah', 'required');
        $this->form_validation->set_rules('alamat_tuan_rumah', 'Alamat Tuan Rumah', 'required');
        $this->form_validation->set_rules('kontak_tuan_rumah', 'Kontak Tuan Rumah', 'required');
        $this->form_validation->set_rules('customer', 'Customer', 'required');
        $this->form_validation->set_rules('alamat_customer', 'Alamat Customer', 'required');
        $this->form_validation->set_rules('kontak_customer', 'Kontak Customer', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');

        // Fetch users by roles for dropdowns
        $data['users'] = $this->get_dropdown_users();

        if ($this->form_validation->run() == FALSE) {
            // If validation fails, redirect with errors
            $this->session->set_flashdata('error', validation_errors());
            redirect('transaksi');
        } else {
            // Fetch setting data
            $setting = $this->Transaksi_model->getSetting();
            $uang_akad = $this->input->post('uang_akad');
            $harga = $this->input->post('harga');

            // Calculate termin based on harga
            $termin1 = $harga * ($setting['prosentase_sales'] / 100);
            $termin2 = $harga * ($setting['prosentase_negosiator'] / 100);
            $termin3 = $harga * ($setting['prosentase_kolektor'] / 100);
            $termin4 = $harga - ($termin1 + $termin2 + $termin3 + $uang_akad);
            $id_tuan_rumah = rand(1000, 9999);
            // Prepare data for insertion
            $data = [
                'id_negosiator' => $this->input->post('id_negosiator'),
                'id_sales' => $this->input->post('id_sales'),
                'id_sopir' => $this->input->post('id_sopir'),
                'id_kolektor' => $this->input->post('id_kolektor'),
                'harga' => $harga,
                'uang_akad' => $uang_akad,
                'id_tuan_rumah' => $id_tuan_rumah, // Auto-generated ID, handled by database
                'nama_tuan_rumah' => $this->input->post('nama_tuan_rumah'),
                'alamat_tuan_rumah' => $this->input->post('alamat_tuan_rumah'),
                'kontak_tuan_rumah' => $this->input->post('kontak_tuan_rumah'),
                'customer' => $this->input->post('customer'),
                'alamat_customer' => $this->input->post('alamat_customer'),
                'kontak_customer' => $this->input->post('kontak_customer'),
                'tanggal_jatuh_tempo' => $this->input->post('tanggal_jatuh_tempo'),
                'termin1' => $termin1,
                'termin2' => $termin2,
                'termin3' => $termin3,
                'termin4' => $termin4,
                'prosentase_sales' => $setting['prosentase_sales'],
                'prosentase_negosiator' => $setting['prosentase_negosiator'],
                'prosentase_kolektor' => $setting['prosentase_kolektor'],
            ];

            // Insert the transaction data
            $this->Transaksi_model->addTransaksi($data);
            $this->session->set_flashdata('success', 'Transaksi berhasil ditambahkan!');
            redirect('transaksi');
        }
    }
}
