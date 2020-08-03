<?php
defined('BASEPATH') or exit('No direct script access allowed');

class periode extends CI_Controller
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
        $this->load->model('periode_model');
    }

    public function index()
    {
        $data['admin'] = $this->periode_model->admin_Active();
        $data['title'] = 'Penilaian Kinerja Guru - Periode';
        $data['position'] = 'Periode';
        $data['periode'] = $this->periode_model->get_AllPeriode();

        $this->form_validation->set_rules('waktu', 'Waktu', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('periode/index', $data);
            $this->load->view('template/footer');
        } else {
            $this->periode_model->add();
            $this->periode_model->add_Nilai();
            $this->session->set_flashdata('done', 'Data berhasil ditambah');
            redirect('periode');
        }
    }

    public function ubah($id)
    {
        $data['admin'] = $this->periode_model->admin_Active();
        $data['title'] = 'Penilaian Kinerja Guru - Periode';
        $data['position'] = 'Periode';
        $data['periode'] = $this->periode_model->get_ById($id);
        $data['status'] = ['Aktif', 'Tidak Aktif'];

        $this->form_validation->set_rules('waktu', 'Waktu', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('periode/ubah', $data);
            $this->load->view('template/footer');
        } else {
            $this->periode_model->edit($id);
            $this->session->set_flashdata('done', 'Data berhasil diubah');
            redirect('periode');
        }
    }

    public function hapus($id)
    {
        $this->periode_model->delete($id);
        $this->session->set_flashdata('done', 'Data berhasil dihapus');
        redirect('periode');
    }

    public function aktif($id)
    {
        $this->periode_model->active($id);
        $this->session->set_flashdata('done', 'Periode berhasil diaktifkan');
        redirect('periode');
    }
}
