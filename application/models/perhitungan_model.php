<?php

class perhitungan_Model extends CI_Model
{
    //Akun Aktif
    public function admin_Active()
    {
        return $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
    }

    public function tahun_Active()
    {
        return $this->db->get_where('periode', ['aktif' => 'Y'])->row_array();
    }

    public function get_AllGuru($tahun)
    {
        // return $this->db->get_where('penilaian', ['id_periode' => $tahun])->result_array();
        $query = "SELECT `id_penilaian`, `nama_guru`, `nip`, p.id_guru, p.nilai FROM `guru` g join 
        `penilaian` p on g.id_guru = p.id_guru WHERE p.id_periode = ? GROUP BY p.id_guru";
        return $this->db->query($query, $tahun)->result_array();
    }

    public function get_AllKriteria()
    {
        return $this->db->get('kriteria')->result_array();
    }

    public function get_AllNilai($tahun)
    {
        $query = "SELECT `id_penilaian`, `nama_guru`, `nip`, p.id_kriteria , p.id_guru, p.nilai, p.normalisasi, p.terbobot FROM `guru` g join 
        `penilaian` p on g.id_guru = p.id_guru WHERE p.id_periode = ?";
        return $this->db->query($query, $tahun)->result_array();
    }

    public function get_Nilai($id_k, $tahun)
    {
        $query = "SELECT id_penilaian, nilai, id_guru, normalisasi, terbobot FROM penilaian WHERE id_kriteria = ? AND id_periode = ?";
        return $this->db->query($query, array($id_k, $tahun))->result_array();
    }

    public function get_Nilai2($id_k, $id_g, $tahun)
    {
        $query = "SELECT id_penilaian, nilai, id_guru, normalisasi, terbobot FROM penilaian WHERE id_kriteria = ? AND id_guru = ? AND id_periode = ?";
        return $this->db->query($query, array($id_k, $id_g, $tahun))->row_array();
    }

    public function update_Normalisasi($normalisasi, $id_k, $id_g, $tahun)
    {
        $query = "UPDATE penilaian SET normalisasi = ? WHERE id_kriteria = ? AND id_guru = ? AND id_periode = ?";
        $this->db->query($query, array($normalisasi, $id_k, $id_g, $tahun));
    }

    public function update_Terbobot($terbobot, $id_k, $id_g, $tahun)
    {
        $query = "UPDATE penilaian SET terbobot = ? WHERE id_kriteria = ? AND id_guru = ? AND id_periode = ?";
        $this->db->query($query, array($terbobot, $id_k, $id_g, $tahun));
    }

    public function select_Max($id_k, $tahun)
    {
        $query = "SELECT MAX(terbobot) as nilai_a FROM penilaian WHERE id_kriteria = ? AND id_periode = ?";
        return $this->db->query($query, array($id_k, $tahun))->row_array();
    }

    public function select_Min($id_k, $tahun)
    {
        $query = "SELECT MIN(terbobot) as nilai_a FROM penilaian WHERE id_kriteria = ? AND id_periode = ?";
        return $this->db->query($query, array($id_k, $tahun))->row_array();
    }

    public function status_Periode($tahun)
    {
        $this->db->set('status', "Selesai");
        $this->db->where('id_periode', $tahun);
        $this->db->update('periode');
    }
}
