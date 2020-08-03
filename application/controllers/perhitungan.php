<?php
defined('BASEPATH') or exit('No direct script access allowed');

class perhitungan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('auth');
        }
        $this->load->model('perhitungan_model');
    }

    public function index()
    {
        $data['admin'] = $this->perhitungan_model->admin_Active();
        $data['title'] = 'Penilaian Kinerja Guru - Perhitungan';
        $data['position'] = 'Perhitungan';
        $data['periode'] = $this->perhitungan_model->tahun_Active();
        $tahun = $data['periode']['id_periode'];
        $data['guru'] = $this->perhitungan_model->get_AllGuru($tahun);
        $data['kriteria'] = $this->perhitungan_model->get_AllKriteria();
        $data['nilai'] = $this->perhitungan_model->get_AllNilai($tahun);

        $posisi = 0;
        foreach ($data['kriteria'] as $k) {
            $id_k = $k['id_kriteria'];
            //Nilai A+
            if ($k['jenis'] == 'Benefit') {
                $data['aplus'] = $this->perhitungan_model->select_Max($id_k, $tahun);
            } else {
                $data['aplus'] = $this->perhitungan_model->select_Min($id_k, $tahun);
            }
            $data['A_plus'][$posisi] = $data['aplus'];


            //Nilai A-
            if ($k['jenis'] == 'Benefit') {
                $data['amin'] = $this->perhitungan_model->select_Min($id_k, $tahun);
            } else {
                $data['amin'] = $this->perhitungan_model->select_Max($id_k, $tahun);
            }
            $data['A_min'][$posisi] = $data['amin'];

            $posisi = $posisi + 1;
        }

        $x = 0;
        foreach ($data['guru'] as $g) {
            $id_g = $g['id_guru'];
            $y = 0;
            $dplus = 0;
            $dmin = 0;
            foreach ($data['kriteria'] as $k) {
                $id_k = $k['id_kriteria'];
                $data['terbobot'] = $this->perhitungan_model->get_Nilai2($id_k, $id_g, $tahun);
                $n_terbobot = $data['terbobot']['terbobot'];
                $aplus = $data['A_plus'][$y]['nilai_a'];
                $amin = $data['A_min'][$y]['nilai_a'];

                //Nilai D+
                $n_dplus = number_format(pow($aplus - $n_terbobot, 2), 3);
                $dplus = $dplus + $n_dplus;

                //Nilai D-
                $n_dmin = number_format(pow($n_terbobot - $amin, 2), 3);
                $dmin = $dmin + $n_dmin;

                $y = $y + 1;
            }
            $data['hasil'][$x]['0'] =  number_format(sqrt($dplus), 3);
            $data['hasil'][$x]['1'] =  number_format(sqrt($dmin), 3);

            //Nilai Preferensi
            if ($data['hasil'][$x]['0'] and $data['hasil'][$x]['1'] != 0) {
                $preferensi = number_format($data['hasil'][$x]['1'] / ($data['hasil'][$x]['1'] + $data['hasil'][$x]['0']), 3);
            } else {
                $preferensi = 0;
                $this->session->set_flashdata('belum', 'Penilaian belum dihitung');
            }
            $data['hasil'][$x]['2'] =  $preferensi;
            $x = $x + 1;
        }

        $this->load->view('template/header', $data);
        $this->load->view('perhitungan/index', $data);
        $this->load->view('template/footer');
    }

    public function hitung()
    {
        $data['periode'] = $this->perhitungan_model->tahun_Active();
        $tahun = $data['periode']['id_periode'];
        $data['guru'] = $this->perhitungan_model->get_AllGuru($tahun);
        $data['kriteria'] = $this->perhitungan_model->get_AllKriteria();

        foreach ($data['kriteria'] as $k) {
            $id_k = $k['id_kriteria'];
            // Nilai Pembagi
            $data['nilai'] = $this->perhitungan_model->get_Nilai($id_k, $tahun);
            $pembagi = 0;
            foreach ($data['guru'] as $g) {
                $id_g = $g['id_guru'];
                $data['nilai2'] = $this->perhitungan_model->get_Nilai2($id_k, $id_g, $tahun);
                $nilai = number_format(pow($data['nilai2']['nilai'], 2), 3);
                $pembagi = $pembagi + $nilai;
            }
            $pembagi = number_format(sqrt($pembagi), 6);

            //Nilai Normalisasi
            foreach ($data['guru'] as $g) {
                $id_g = $g['id_guru'];
                $data['nilai2'] = $this->perhitungan_model->get_Nilai2($id_k, $id_g, $tahun);

                $nilai = $data['nilai2']['nilai'];
                if ($nilai and $pembagi != 0) {
                    $normalisasi = number_format($nilai / $pembagi, 3);
                } else {
                    $this->session->set_flashdata('kosong', 'Isi data yang masih kosong ');
                    redirect('perhitungan');
                }
                $this->perhitungan_model->update_Normalisasi($normalisasi, $id_k, $id_g, $tahun);
            }

            //Nilai Terbobot
            foreach ($data['guru'] as $g) {
                $id_g = $g['id_guru'];
                $data['nilai2'] = $this->perhitungan_model->get_Nilai2($id_k, $id_g, $tahun);
                $n_normalisasi = $data['nilai2']['normalisasi'];
                $bobot = $k['bobot'];
                $terbobot = number_format($n_normalisasi * $bobot, 3);
                $this->perhitungan_model->update_Terbobot($terbobot, $id_k, $id_g, $tahun);
            }
        }

        $this->session->set_flashdata('done', 'Data Berhasil dihitung');
        redirect('perhitungan');
    }
}
