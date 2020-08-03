<?php
defined('BASEPATH') or exit('No direct script access allowed');

class alternatif extends CI_Controller
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
        $this->load->model('alternatif_model');
    }

    public function index()
    {
        $data['admin'] = $this->alternatif_model->admin_Active();
        $data['title'] = 'Penilaian Kinerja Guru - Alternatif';
        $data['position'] = 'Alternatif';
        $data['alternatif'] = $this->alternatif_model->get_AllAlternatif();

        $this->load->view('template/header', $data);
        $this->load->view('alternatif/index', $data);
        $this->load->view('template/footer');
    }

    public function ubah($id)
    {
        $data['admin'] = $this->alternatif_model->admin_Active();
        $data['title'] = 'Penilaian Kinerja Guru - alternatif';
        $data['position'] = 'alternatif';
        $data['alternatif'] = $this->alternatif_model->get_ById($id);

        $this->form_validation->set_rules('nama', 'Nama Alternatif', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('alternatif/ubah', $data);
            $this->load->view('template/footer');
        } else {
            $this->alternatif_model->edit($id);
            $this->session->set_flashdata('done', 'Data berhasil diubah');
            redirect('alternatif');
        }
    }

    public function hapus($id)
    {
        $this->alternatif_model->delete($id);
        $this->session->set_flashdata('done', 'Data berhasil dihapus');
        redirect('alternatif');
    }
}
