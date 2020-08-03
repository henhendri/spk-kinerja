<?php
defined('BASEPATH') or exit('No direct script access allowed');

class nilai extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('auth');
        }
        $this->load->model('nilai_model');
    }

    public function index()
    {
        $data['admin'] = $this->nilai_model->admin_Active();
        $admin = $data['admin']['id_admin'];
        $data['title'] = 'Penilaian Kinerja Guru - Nilai';
        $data['position'] = 'Nilai';
        $data['periode'] = $this->nilai_model->tahun_Active();
        $tahun = $data['periode']['id_periode'];
        if ($this->session->userdata('akses') == 'Administrator') {
            $data['guru'] = $this->nilai_model->get_AllGuru($tahun);
        } else {
            $data['guru'] = $this->nilai_model->get_Guru($tahun, $admin);
        }

        $this->load->view('template/header', $data);
        $this->load->view('nilai/index', $data);
        $this->load->view('template/footer');
    }

    public function ubah($id)
    {
        $data['admin'] = $this->nilai_model->admin_Active();
        $data['title'] = 'Penilaian Kinerja Guru - Nilai';
        $data['position'] = 'Nilai';
        $data['periode'] = $this->nilai_model->tahun_Active();
        $tahun = $data['periode']['id_periode'];
        $data['kriteria'] = $this->nilai_model->get_AllKriteria();
        $data['guru'] = $this->nilai_model->get_GuruById($tahun, $id);
        $data['nilai'] = ['0', '1', '2', '3', '4'];

        $this->load->view('template/header', $data);
        $this->load->view('nilai/ubah', $data);
        $this->load->view('template/footer');
    }

    public function simpan($id)
    {
        $data['periode'] = $this->nilai_model->tahun_Active();
        $tahun = $data['periode']['id_periode'];
        $this->nilai_model->edit($id, $tahun);
        $this->session->set_flashdata('done', 'Data berhasil diubah');
        redirect('nilai');
    }

    public function detail($id)
    {
        $data['admin'] = $this->nilai_model->admin_Active();
        $data['title'] = 'Penilaian Kinerja Guru - Nilai';
        $data['position'] = 'Nilai';
        $data['periode'] = $this->nilai_model->tahun_Active();
        $tahun = $data['periode']['id_periode'];
        $data['kriteria'] = $this->nilai_model->get_AllKriteria();
        $data['guru'] = $this->nilai_model->get_GuruById($tahun, $id);
        $data['nilai'] = $this->nilai_model->get_AllNilai($id, $tahun);
        $data['alternatif'] = $this->nilai_model->get_Alternatif();
        $data['nilai_guru'] = $this->nilai_model->get_NilaiGuru($id, $tahun);

        if ($data['nilai'] == null) {
            $this->session->set_flashdata('belum', 'Penilaian belum dihitung');
        }

        $posisi = 0;
        foreach ($data['nilai_guru'] as $n) {
            $id_n = $n['id_nilai'];
            $data['detail'] = $this->nilai_model->detail($id_n);

            //Nilai A+
            if ($data['detail']['jenis'] == 'Benefit') {
                $data['aplus'] = $this->nilai_model->select_Max($id_n);
            } else {
                $data['aplus'] = $this->nilai_model->select_Min($id_n);
            }
            $data['A_plus'][$posisi] = $data['aplus'];


            //Nilai A-
            if ($data['detail']['jenis'] == 'Benefit') {
                $data['amin'] = $this->nilai_model->select_Min($id_n);
            } else {
                $data['amin'] = $this->nilai_model->select_Max($id_n);
            }
            $data['A_min'][$posisi] = $data['amin'];

            $posisi = $posisi + 1;
        }

        $x = 0;
        foreach ($data['alternatif'] as $a) {
            $id_a = $a['id_alternatif'];
            $y = 0;
            $dplus = 0;
            $dmin = 0;
            foreach ($data['nilai_guru'] as $n) {
                $id_n = $n['id_nilai'];
                $data['terbobot'] = $this->nilai_model->get_Nilai2($id_n, $id_a);
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
            }
            $data['hasil'][$x]['2'] =  $preferensi;

            //Cek sudah dihitung
            $data['isi'] = $this->nilai_model->select_nilai($id, $tahun, $id_a);
            if ($data['isi']['nilai_akhir'] == "0") {
                foreach ($data['nilai_guru'] as $n) {
                    $id_n = $n['id_nilai'];
                    $this->nilai_model->update_preferensi($preferensi, $id_n, $id_a);
                }
            }

            $x = $x + 1;
        }

        $data['nilai_akhir'] = $this->nilai_model->get_hasil($id, $tahun);
        $rank = $data['nilai_akhir']['id_alternatif'];
        $this->nilai_model->update_Rank($rank, $id, $tahun);
        $data['kinerja'] = $this->nilai_model->get_hasil($id, $tahun);

        $this->load->view('template/header', $data);
        $this->load->view('nilai/detail', $data);
        $this->load->view('template/footer');
    }

    public function hitung($id)
    {
        $data['periode'] = $this->nilai_model->tahun_Active();
        $tahun = $data['periode']['id_periode'];
        $data['kriteria'] = $this->nilai_model->get_AllKriteria();
        $data['alternatif'] = $this->nilai_model->get_Alternatif();

        // Cek apakah data kosong
        $data['nilai'] = $this->nilai_model->get_NilaiGuru($id, $tahun);
        foreach ($data['nilai'] as $n) {
            $nilai = $n['nilai_guru'];
            if ($nilai == "0") {
                $this->session->set_flashdata('kosong', 'Isi data yang masih kosong');
                redirect('nilai/ubah/' . $id);
            }
        }

        // Cek apakah sudah dihitung
        $data['nilai'] = $this->nilai_model->get_AllNilai($id, $tahun);
        if ($data['nilai'] != null) {
            $this->session->set_flashdata('done', 'Data Sudah dihitung');
            redirect('nilai/detail/' . $id);
        }

        foreach ($data['alternatif'] as $a) {
            $id_a = $a['id_alternatif'];
            $data['nilai'] = $this->nilai_model->get_NilaiGuru($id, $tahun);
            foreach ($data['nilai'] as $n) {
                $id_n = $n['id_nilai'];
                $nilai = $n['nilai_guru'];
                if ($nilai == "4") {
                    $konversi = $a['nilai4'];
                } elseif ($nilai == "3") {
                    $konversi = $a['nilai3'];
                } elseif ($nilai == "2") {
                    $konversi = $a['nilai2'];
                } elseif ($nilai == "1") {
                    $konversi = $a['nilai1'];
                } else {
                    $this->session->set_flashdata('kosong', 'Isi data yang masih kosong');
                    redirect('nilai/ubah/' . $id);
                }
                $this->nilai_model->konversi($konversi, $id_n, $id_a);
            }
        }

        $data['nilai'] = $this->nilai_model->get_AllNilai($id, $tahun);
        foreach ($data['nilai'] as $n) {
            $id_n = $n['id_nilai'];
            // Nilai Pembagi
            $data['nilai'] = $this->nilai_model->get_Nilai($id_n);
            $pembagi = 0;
            foreach ($data['alternatif'] as $a) {
                $id_a = $a['id_alternatif'];
                $data['nilai2'] = $this->nilai_model->get_Nilai2($id_n, $id_a);
                $nilai = number_format(pow($data['nilai2']['nilai'], 2), 3);
                $pembagi = $pembagi + $nilai;
            }
            $pembagi = number_format(sqrt($pembagi), 6);

            //Nilai Normalisasi
            foreach ($data['alternatif'] as $a) {
                $id_a = $a['id_alternatif'];
                $data['nilai2'] = $this->nilai_model->get_Nilai2($id_n, $id_a);

                $nilai = $data['nilai2']['nilai'];
                $normalisasi = number_format($nilai / $pembagi, 3);
                $this->nilai_model->update_Normalisasi($normalisasi, $id_n, $id_a);
            }

            //Nilai Terbobot
            foreach ($data['alternatif'] as $a) {
                $id_a = $a['id_alternatif'];
                $data['nilai2'] = $this->nilai_model->get_Nilai2($id_n, $id_a);
                $n_normalisasi = $data['nilai2']['normalisasi'];
                $data['detail'] = $this->nilai_model->detail($id_n);
                $bobot = $data['detail']['bobot'];
                $terbobot = number_format($n_normalisasi * $bobot, 3);
                $this->nilai_model->update_Terbobot($terbobot, $id_n, $id_a);
            }
        }

        $this->session->set_flashdata('done', 'Data Berhasil dihitung');
        redirect('nilai/detail/' . $id);
    }
}
