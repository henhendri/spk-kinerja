<?php
defined('BASEPATH') or exit('No direct script access allowed');

class kriteria extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('auth');
        }
        if ($this->session->userdata('akses') != 'Administrator') {
            redirect('auth/blok');
        }
        $this->load->model('kriteria_model');
    }

    public function index()
    {
        $data['admin'] = $this->kriteria_model->admin_Active();
        $data['title'] = 'Penilaian Kinerja Guru - Kriteria';
        $data['position'] = 'Kriteria';
        $data['kriteria'] = $this->kriteria_model->get_AllKriteria();

        $this->load->view('template/header', $data);
        $this->load->view('kriteria/index', $data);
        $this->load->view('template/footer');
    }

    public function ubah($id)
    {
        $data['admin'] = $this->kriteria_model->admin_Active();
        $data['title'] = 'Penilaian Kinerja Guru - Kriteria';
        $data['position'] = 'Ubah Kriteria';
        $data['kriteria'] = $this->kriteria_model->get_ById($id);
        $data['jenis'] = ['Benefit', 'Cost'];
        $data['bobot'] = ['1', '2', '3', '4', '5'];

        $this->form_validation->set_rules('kriteria', 'Kriteria', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('kriteria/ubah', $data);
            $this->load->view('template/footer');
        } else {
            $this->kriteria_model->edit($id);
            $this->session->set_flashdata('done', 'Data berhasil diubah');
            redirect('kriteria');
        }
    }
}
