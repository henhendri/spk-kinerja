<?php

class admin_Model extends CI_Model
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

    public function count_Guru()
    {
        return $this->db->count_all_results('guru');
    }

    public function count_GuruAktif($tahun)
    {
        $query = "SELECT COUNT(id_guru) as jumlah from 
        (SELECT id_guru FROM `nilai` WHERE id_periode = ? GROUP BY id_guru) as sub_query";
        return $this->db->query($query, $tahun)->row_array();
    }

    public function count_Penilai()
    {
        $query = "SELECT count(id_admin) as jumlah FROM `admin` WHERE `akses` = 'Penilai'";
        return $this->db->query($query)->row_array();
    }

    public function count_Mapel()
    {
        return $this->db->count_all_results('mapel');
    }

    public function get_Alternatif()
    {
        return $this->db->get('alternatif')->result_array();
    }

    public function jumlah($id_a, $tahun)
    {
        $query = "SELECT COUNT(*) as jumlah from (SELECT n.id_guru from penilaian p 
        JOIN nilai n on p.id_nilai = n.id_nilai
        JOIN guru g on n.id_guru = g.id_guru
        WHERE p.rank = ? AND n.id_periode = ?
        GROUP BY n.id_guru) as sub_query";
        return $this->db->query($query, array($id_a, $tahun))->row_array();
    }

    public function get_Guru($id_a, $tahun)
    {
        $query = "SELECT * , (SELECT nama_alternatif from alternatif WHERE id_alternatif = ?) as alternatif from 
        (SELECT n.id_guru, g.nama_guru, g.nip from penilaian p 
        JOIN nilai n on p.id_nilai = n.id_nilai 
        JOIN guru g on n.id_guru = g.id_guru 
        WHERE p.rank = ? AND n.id_periode = ? 
        GROUP BY n.id_guru) as sub_query";
        return $this->db->query($query, array($id_a, $id_a, $tahun))->result_array();
    }

    public function edit_Password($id, $newpassword)
    {
        $this->db->set('password', $newpassword);
        $this->db->where('id_admin', $id);
        $this->db->update('admin');
    }

    public function image_Profile()
    {
        $image = $this->upload->data('file_name');
        $this->db->set('foto', $image);
    }

    public function edit_Data()
    {
        $id = $this->input->post('idadmin');
        $name = $this->input->post('name');

        $this->db->set('nama', $name);
        $this->db->where('id_admin', $id);
        $this->db->update('admin');
    }

    // Pengguna

    public function get_AllAdmin()
    {
        return $this->db->get('admin')->result_array();
    }

    public function delete_pengguna($id)
    {
        $this->db->delete('admin', ['id_admin' => $id]);
    }

    public function get_ById($id)
    {
        return $this->db->get_where('admin', ['id_admin' => $id])->row_array();
    }

    public function insert_Pengguna()
    {
        $data = [
            'email' => htmlspecialchars($this->input->post('email', true)),
            'password' => md5($this->input->post('password')),
            'nama' => htmlspecialchars($this->input->post('nama', true)),
            'foto' => 'default.png',
            'akses' => 'Penilai'
        ];

        $this->db->insert('admin', $data);
    }

    public function edit_Pengguna($id)
    {
        $akses = $this->input->post('akses', true);
        $this->db->set('akses', $akses);
        $this->db->where('id_admin', $id);
        $this->db->update('admin');
    }

    public function get_Akses()
    {
        $this->db->distinct();
        $this->db->select('akses');
        $this->db->from('admin');
        return $this->db->get()->result_array();

        //return $this->db->query('SELECT DISTINCT `akses` FROM `admin`')->result_array();
    }

    public function reset()
    {
        $id = $this->input->post('idadmin', true);
        $password = md5($this->input->post('newpassword', true));

        $this->db->set('password', $password);
        $this->db->where('id_admin', $id);
        $this->db->update('admin');
    }
}
