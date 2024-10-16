<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Setting_model');
    }

    // Halaman utama Kelola Setting
    public function index()
    {
        $data['title'] = 'Kelola Setting';
        $data['settings'] = $this->Setting_model->getAllSettings();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('setting/index', $data);
        $this->load->view('template/footer');
    }

    // Fungsi untuk menambah setting baru
    public function add()
    {
        $this->form_validation->set_rules('lama_tempo', 'Lama Tempo', 'required');
        $this->form_validation->set_rules('prosentase_sales', 'Prosentase Sales', 'required');
        $this->form_validation->set_rules('prosentase_kolektor', 'Prosentase Kolektor', 'required');
        $this->form_validation->set_rules('prosentase_negosiator', 'Prosentase Negosiator', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Semua field harus diisi!');
            redirect('setting');
        } else {
            $data = [
                'lama_tempo'           => $this->input->post('lama_tempo'),
                'prosentase_sales'     => $this->input->post('prosentase_sales'),
                'prosentase_kolektor'  => $this->input->post('prosentase_kolektor'),
                'prosentase_negosiator' => $this->input->post('prosentase_negosiator')
            ];

            $this->Setting_model->addSetting($data);
            $this->session->set_flashdata('success', 'Setting berhasil ditambahkan!');
            redirect('setting');
        }
    }

    // Fungsi hapus setting
    public function delete($id)
    {
        $this->Setting_model->deleteSetting($id);
        $this->session->set_flashdata('success', 'Setting berhasil dihapus!');
        redirect('setting');
    }

    // Fungsi update setting
    public function update($id)
    {
        $this->form_validation->set_rules('lama_tempo', 'Lama Tempo', 'required');
        $this->form_validation->set_rules('prosentase_sales', 'Prosentase Sales', 'required');
        $this->form_validation->set_rules('prosentase_kolektor', 'Prosentase Kolektor', 'required');
        $this->form_validation->set_rules('prosentase_negosiator', 'Prosentase Negosiator', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Semua field harus diisi!');
            redirect('setting');
        } else {
            $data = [
                'lama_tempo'           => $this->input->post('lama_tempo'),
                'prosentase_sales'     => $this->input->post('prosentase_sales'),
                'prosentase_kolektor'  => $this->input->post('prosentase_kolektor'),
                'prosentase_negosiator' => $this->input->post('prosentase_negosiator')
            ];

            $this->Setting_model->updateSetting($id, $data);
            $this->session->set_flashdata('success', 'Setting berhasil diupdate!');
            redirect('setting');
        }
    }
}
