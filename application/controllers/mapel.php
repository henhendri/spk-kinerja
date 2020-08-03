<?php
defined('BASEPATH') or exit('No direct script access allowed');

class mapel extends CI_Controller
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
        $this->load->model('mapel_model');
    }

    public function index()
    {
        $data['admin'] = $this->mapel_model->admin_Active();
        $data['title'] = 'Penilaian Kinerja Guru - Mapel';
        $data['position'] = 'Mata Pelajaran';
        $data['mapel'] = $this->mapel_model->get_AllMapel();

        $this->form_validation->set_rules('mapel', 'Mata Pelajaran', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('mapel/index', $data);
            $this->load->view('template/footer');
        } else {
            $this->mapel_model->add();
            $this->session->set_flashdata('done', 'Data berhasil ditambah');
            redirect('mapel');
        }
    }

    public function ubah($id)
    {
        $data['admin'] = $this->mapel_model->admin_Active();
        $data['title'] = 'Penilaian Kinerja Guru - Mapel';
        $data['position'] = 'Mata Pelajaran';
        $data['mapel'] = $this->mapel_model->get_ById($id);

        $this->form_validation->set_rules('mapel', 'Mata Pelajaran', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('mapel/ubah', $data);
            $this->load->view('template/footer');
        } else {
            $this->mapel_model->edit($id);
            $this->session->set_flashdata('done', 'Data berhasil diubah');
            redirect('mapel');
        }
    }

    public function hapus($id)
    {
        $this->mapel_model->delete($id);
        $this->session->set_flashdata('done', 'Data berhasil dihapus');
        redirect('mapel');
    }
}
