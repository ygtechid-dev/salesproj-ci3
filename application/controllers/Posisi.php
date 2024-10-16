<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Posisi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Posisi_model');
    }

    // Halaman utama Kelola Posisi
    public function index()
    {
        $data['title'] = 'Kelola Posisi';
        $data['posisi'] = $this->Posisi_model->getAllPosisi();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('posisi/index', $data);
        $this->load->view('template/footer');
    }

    // Fungsi untuk menambah posisi baru
    public function add()
    {
        $this->form_validation->set_rules('nama_posisi', 'Nama Posisi', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Semua field harus diisi!');
            redirect('posisi');
        } else {
            $data = [
                'nama_posisi' => $this->input->post('nama_posisi')
            ];

            $this->Posisi_model->addPosisi($data);
            $this->session->set_flashdata('success', 'Posisi berhasil ditambahkan!');
            redirect('posisi');
        }
    }

    // Fungsi hapus posisi
    public function delete($id)
    {
        $this->Posisi_model->deletePosisi($id);
        $this->session->set_flashdata('success', 'Posisi berhasil dihapus!');
        redirect('posisi');
    }

    // Fungsi update posisi
    public function update($id)
    {
        $this->form_validation->set_rules('nama_posisi', 'Nama Posisi', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Semua field harus diisi!');
            redirect('posisi');
        } else {
            $data = [
                'nama_posisi' => $this->input->post('nama_posisi')
            ];

            $this->Posisi_model->updatePosisi($id, $data);
            $this->session->set_flashdata('success', 'Posisi berhasil diupdate!');
            redirect('posisi');
        }
    }
}
