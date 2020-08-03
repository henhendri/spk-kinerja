<?php
defined('BASEPATH') or exit('No direct script access allowed');

class guru extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('auth');
        }
        $this->load->model('guru_model');
    }

    public function index()
    {
        $data['admin'] = $this->guru_model->admin_Active();
        $admin = $data['admin']['id_admin'];
        $data['title'] = 'Penilaian Kinerja Guru - Guru';
        $data['position'] = 'Guru';
        if ($this->session->userdata('akses') == 'Administrator') {
            $data['guru'] = $this->guru_model->get_AllGuru();
        } else {
            $data['guru'] = $this->guru_model->get_Guru($admin);
        }
        $data['mapel'] = $this->guru_model->get_Mapel();
        $data['pendidikan'] = ['SD', 'SMP', 'SMA', 'SMK', 'D3', 'D4', 'S1', 'S2', 'S3'];
        $data['jabatan'] = [
            'Penata Muda / Guru Pertama / IIIa', 'Penata Muda Tingkat I / Guru Pertama/ IIIb',
            'Penata / Guru Muda / IIIc', 'Penata Tingkat I / Guru Muda / IIId', 'Pembina / Guru Madya / IVa',
            'Pembina Tingkat 1 / Guru Madya / IVb', 'Pembina Utama Muda',
            'Pembina Utama Madya / Guru Utama / IVd', 'Pembina Utama / Guru Utama / iVe'
        ];
        $data['penilai'] = $this->guru_model->get_Penilai();

        $this->form_validation->set_rules('nama', 'Nama Guru', 'required|trim');
        $this->form_validation->set_rules('nip', 'NIP', 'required|trim');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required|trim');
        $this->form_validation->set_rules('mapel', 'Mata Pelajaran', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('guru/index', $data);
            $this->load->view('template/footer');
        } else {
            $this->guru_model->add();
            $this->session->set_flashdata('done', 'Data berhasil ditambah');
            redirect('guru');
        }
    }

    public function detail($id)
    {
        $data['admin'] = $this->guru_model->admin_Active();
        $data['title'] = 'Penilaian Kinerja Guru - Guru';
        $data['position'] = 'Guru';
        $data['guru'] = $this->guru_model->get_ById($id);
        $data['mapel'] = $this->guru_model->get_Mapel();
        $this->load->view('template/header', $data);
        $this->load->view('guru/detail', $data);
        $this->load->view('template/footer');
    }

    public function ubah($id)
    {
        $data['admin'] = $this->guru_model->admin_Active();
        $data['title'] = 'Penilaian Kinerja Guru - Guru';
        $data['position'] = 'Guru';
        $data['guru'] = $this->guru_model->get_ById($id);
        $data['mapel'] = $this->guru_model->get_Mapel();
        $data['pendidikan'] = ['SD', 'SMP', 'SMA', 'SMK', 'D3', 'D4', 'S1', 'S2', 'S3'];
        $data['jabatan'] = [
            'Penata Muda / Guru Pertama / IIIa', 'Penata Muda Tingkat I / Guru Pertama/ IIIb',
            'Penata / Guru Muda / IIIc', 'Penata Tingkat I / Guru Muda / IIId', 'Pembina / Guru Madya / IVa',
            'Pembina Tingkat 1 / Guru Madya / IVb', 'Pembina Utama Muda',
            'Pembina Utama Madya / Guru Utama / IVd', 'Pembina Utama / Guru Utama / iVe'
        ];
        $data['penilai'] = $this->guru_model->get_Penilai();

        $this->form_validation->set_rules('nama', 'Nama Guru', 'required|trim');
        $this->form_validation->set_rules('nip', 'NIP', 'required|trim');
        // $this->form_validation->set_rules('jabatan', 'Jabatan', 'required|trim');
        $this->form_validation->set_rules('mapel', 'Mata Pelajaran', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('guru/ubah', $data);
            $this->load->view('template/footer');
        } else {
            $this->guru_model->edit($id);
            $this->session->set_flashdata('done', 'Data berhasil diubah');
            redirect('guru');
        }
    }

    public function hapus($id)
    {
        $this->guru_model->delete($id);
        $this->session->set_flashdata('done', 'Data berhasil dihapus');
        redirect('guru');
    }
}
