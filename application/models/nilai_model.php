<?php

class nilai_Model extends CI_Model
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
        // return $this->db->get_where('nilai', ['id_periode' => $tahun])->result_array();
        $query = "SELECT `id_nilai`, `nama_guru`, `nip`, p.id_guru FROM `guru` g join 
        `nilai` p on g.id_guru = p.id_guru WHERE p.id_periode = ?  GROUP BY p.id_guru";
        return $this->db->query($query, $tahun)->result_array();
    }

    public function get_Guru($tahun, $admin)
    {
        // return $this->db->get_where('nilai', ['id_periode' => $tahun])->result_array();
        $query = "SELECT `id_nilai`, `nama_guru`, `nip`, p.id_guru FROM `guru` g join 
        `nilai` p on g.id_guru = p.id_guru WHERE p.id_periode = ? AND id_admin = ?  GROUP BY p.id_guru";
        return $this->db->query($query, array($tahun, $admin))->result_array();
    }

    public function get_AllKriteria()
    {
        return $this->db->get('kriteria')->result_array();
    }

    public function get_Alternatif()
    {
        return $this->db->get('alternatif')->result_array();
    }

    public function get_GuruById($tahun, $id)
    {
        // return $this->db->get_where('nilai', ['id_periode' => $tahun])->result_array();
        $query = "SELECT `id_nilai`, `nama_guru`, `nip`, p.id_guru, p.nilai_guru FROM `guru` g join 
        `nilai` p on g.id_guru = p.id_guru WHERE p.id_periode = ? AND p.id_guru = ?";
        return $this->db->query($query, array($tahun, $id))->result_array();
    }

    public function Edit($id, $tahun)
    {
        $nilaiC1 = $this->input->post('C1');
        $C1 = "UPDATE nilai SET nilai_guru = ? WHERE id_kriteria = 1 AND id_guru = ? AND id_periode = ?";
        $this->db->query($C1, array($nilaiC1, $id, $tahun));

        $nilaiC2 = $this->input->post('C2');
        $C2 = "UPDATE nilai SET nilai_guru = ? WHERE id_kriteria = 2 AND id_guru = ? AND id_periode = ?";
        $this->db->query($C2, array($nilaiC2, $id, $tahun));

        $nilaiC3 = $this->input->post('C3');
        $C3 = "UPDATE nilai SET nilai_guru = ? WHERE id_kriteria = 3 AND id_guru = ? AND id_periode = ?";
        $this->db->query($C3, array($nilaiC3, $id, $tahun));

        $nilaiC4 = $this->input->post('C4');
        $C4 = "UPDATE nilai SET nilai_guru = ? WHERE id_kriteria = 4 AND id_guru = ? AND id_periode = ?";
        $this->db->query($C4, array($nilaiC4, $id, $tahun));

        $nilaiC5 = $this->input->post('C5');
        $C5 = "UPDATE nilai SET nilai_guru = ? WHERE id_kriteria = 5 AND id_guru = ? AND id_periode = ?";
        $this->db->query($C5, array($nilaiC5, $id, $tahun));

        $nilaiC6 = $this->input->post('C6');
        $C6 = "UPDATE nilai SET nilai_guru = ? WHERE id_kriteria = 6 AND id_guru = ? AND id_periode = ?";
        $this->db->query($C6, array($nilaiC6, $id, $tahun));

        $nilaiC7 = $this->input->post('C7');
        $C7 = "UPDATE nilai SET nilai_guru = ? WHERE id_kriteria = 7 AND id_guru = ? AND id_periode = ?";
        $this->db->query($C7, array($nilaiC7, $id, $tahun));

        $nilaiC8 = $this->input->post('C8');
        $C8 = "UPDATE nilai SET nilai_guru = ? WHERE id_kriteria = 8 AND id_guru = ? AND id_periode = ?";
        $this->db->query($C8, array($nilaiC8, $id, $tahun));

        $nilaiC9 = $this->input->post('C9');
        $C9 = "UPDATE nilai SET nilai_guru = ? WHERE id_kriteria = 9 AND id_guru = ? AND id_periode = ?";
        $this->db->query($C9, array($nilaiC9, $id, $tahun));

        $nilaiC10 = $this->input->post('C10');
        $C10 = "UPDATE nilai SET nilai_guru = ? WHERE id_kriteria = 10 AND id_guru = ? AND id_periode = ?";
        $this->db->query($C10, array($nilaiC10, $id, $tahun));

        $nilaiC11 = $this->input->post('C11');
        $C11 = "UPDATE nilai SET nilai_guru = ? WHERE id_kriteria = 11 AND id_guru = ? AND id_periode = ?";
        $this->db->query($C11, array($nilaiC11, $id, $tahun));

        $nilaiC12 = $this->input->post('C12');
        $C12 = "UPDATE nilai SET nilai_guru = ? WHERE id_kriteria = 12 AND id_guru = ? AND id_periode = ?";
        $this->db->query($C12, array($nilaiC12, $id, $tahun));

        $nilaiC13 = $this->input->post('C13');
        $C13 = "UPDATE nilai SET nilai_guru = ? WHERE id_kriteria = 13 AND id_guru = ? AND id_periode = ?";
        $this->db->query($C13, array($nilaiC13, $id, $tahun));

        $nilaiC14 = $this->input->post('C14');
        $C14 = "UPDATE nilai SET nilai_guru = ? WHERE id_kriteria = 14 AND id_guru = ? AND id_periode = ?";
        $this->db->query($C14, array($nilaiC14, $id, $tahun));
    }

    public function get_NilaiGuru($id, $tahun)
    {
        $query = "SELECT * FROM nilai WHERE id_guru = ? AND id_periode = ?";
        return $this->db->query($query, array($id, $tahun))->result_array();
    }

    public function konversi($konversi, $id_n, $id_a)
    {
        $data = [
            'id_nilai' => $id_n,
            'id_alternatif' => $id_a,
            'nilai' => $konversi
        ];
        $this->db->insert('penilaian', $data);
    }

    public function get_AllNilai($id, $tahun)
    {
        $query = "SELECT `id_penilaian`, p.id_nilai, n.id_guru, p.nilai, p.normalisasi, p.terbobot FROM `nilai` n join 
        `penilaian` p on n.id_nilai = p.id_nilai WHERE n.id_guru = ? AND n.id_periode = ? ORDER BY id_penilaian";
        return $this->db->query($query, array($id, $tahun))->result_array();
    }

    public function get_Nilai($id_n)
    {
        $query = "SELECT id_penilaian, nilai,  normalisasi, terbobot FROM penilaian p join 
        nilai n on p.id_nilai = n.id_nilai WHERE p.id_nilai = ?";
        return $this->db->query($query, array($id_n))->result_array();
    }

    public function get_Nilai2($id_n, $id_a)
    {
        $query = "SELECT id_penilaian, nilai, normalisasi, terbobot FROM penilaian WHERE id_nilai= ? AND id_alternatif = ?";
        return $this->db->query($query, array($id_n, $id_a))->row_array();
    }

    public function update_Normalisasi($normalisasi, $id_n, $id_a)
    {
        $query = "UPDATE penilaian SET normalisasi = ? WHERE id_nilai = ? AND id_alternatif = ?";
        $this->db->query($query, array($normalisasi, $id_n, $id_a));
    }

    public function detail($id_n)
    {
        $query = "SELECT id_nilai, id_guru, k.id_kriteria, bobot, jenis FROM nilai n join
        kriteria k on n.id_kriteria = k.id_kriteria where id_nilai=?";
        return $this->db->query($query, array($id_n))->row_array();
    }

    public function update_Terbobot($terbobot, $id_n, $id_a)
    {
        $query = "UPDATE penilaian SET terbobot = ? WHERE id_nilai = ? AND id_alternatif = ?";
        $this->db->query($query, array($terbobot, $id_n, $id_a));
    }

    public function select_Max($id_n)
    {
        $query = "SELECT MAX(terbobot) as nilai_a FROM penilaian WHERE id_nilai = ?";
        return $this->db->query($query, array($id_n))->row_array();
    }

    public function select_Min($id_n)
    {
        $query = "SELECT MIN(terbobot) as nilai_a FROM penilaian WHERE id_nilai = ?";
        return $this->db->query($query, array($id_n))->row_array();
    }

    public function update_preferensi($preferensi, $id_n, $id_a)
    {
        $query = "UPDATE penilaian SET nilai_akhir = ? WHERE id_nilai = ? AND id_alternatif = ?";
        $this->db->query($query, array($preferensi, $id_n, $id_a));
    }

    public function select_nilai($id, $tahun, $id_a)
    {
        $query = "SELECT DISTINCT nilai_akhir from penilaian p 
        join alternatif a on p.id_alternatif = a.id_alternatif 
        JOIN nilai n on p.id_nilai = n.id_nilai 
        where id_guru = ? and id_periode = ? and p.id_alternatif = ?";
        return $this->db->query($query, array($id, $tahun, $id_a))->row_array();
    }

    public function get_hasil($id, $tahun)
    {
        $query = "SELECT DISTINCT p.id_alternatif, nama_alternatif, p.nilai_akhir, rank FROM `nilai` n join 
        `penilaian` p on n.id_nilai = p.id_nilai JOIN 
        alternatif a on p.id_alternatif = a.id_alternatif WHERE n.id_guru = ? AND n.id_periode = ? ORDER BY nilai_akhir DESC";
        return $this->db->query($query, array($id, $tahun))->row_array();
    }

    public function get_hasil2($hasil)
    {
        $query = "SELECT * FROM alternatif where id_alternatif = ?";
        return $this->db->query($query, $hasil)->row_array();
    }

    public function update_Rank($rank, $id, $tahun)
    {
        $query = "UPDATE penilaian p join nilai n on n.id_nilai = p.id_nilai set rank = ? WHERE id_guru = ? AND id_periode = ?";
        $this->db->query($query, array($rank, $id, $tahun));
    }
}
