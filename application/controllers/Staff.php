<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Staff extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Staff_model'); // Load Staff model
        $this->load->library('form_validation'); // Load form validation
    }

    // Halaman utama Kelola Staff
    public function index()
    {
        $data['title'] = 'Kelola Staff';
        $data['staff'] = $this->Staff_model->getAllStaff(); // Ambil data staff dari model
        $data['posisi'] = $this->Staff_model->getAllPosisi(); // Ambil data posisi dari model

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('staff/index', $data); // Load view untuk halaman kelola staff
        $this->load->view('template/footer');
    }

    // Fungsi untuk menambah user/staff baru
    public function add()
    {
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('posisi', 'Posisi', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('nomor_telpon', 'Nomor Telpon', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Semua field harus diisi!');
            redirect('staff');
        } else {
            $data = [
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'posisi'       => $this->input->post('posisi'),
                'alamat'       => $this->input->post('alamat'),
                'nomor_telpon' => $this->input->post('nomor_telpon')
            ];

            $this->Staff_model->addStaff($data);
            $this->session->set_flashdata('success', 'Staff berhasil ditambahkan!');
            redirect('staff');
        }
    }
}
