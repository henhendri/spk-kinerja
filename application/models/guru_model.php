<?php

class guru_Model extends CI_Model
{
    //Akun Aktif
    public function admin_Active()
    {
        return $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
    }

    public function get_AllGuru()
    {
        $query = "SELECT * FROM `guru` g 
        join `admin` a on g.id_admin = a.id_admin
        join `mapel` m on g.id_mapel = m.id_mapel ORDER BY g.id_guru";
        return $this->db->query($query)->result_array();
    }

    public function get_Guru($admin)
    {
        $query = "SELECT * FROM `guru` g 
        join `admin` a on g.id_admin = a.id_admin 
        join `mapel` m on g.id_mapel = m.id_mapel WHERE g.id_admin = ? ORDER BY g.id_guru";
        return $this->db->query($query, $admin)->result_array();
    }

    public function get_ById($id)
    {
        $query = "SELECT * FROM `guru` g 
        join `admin` a on g.id_admin = a.id_admin
        join `mapel` m on g.id_mapel = m.id_mapel WHERE g.id_guru = ?";
        return $this->db->query($query, $id)->row_array();
        // return $this->db->get_where('guru', ['id_guru' => $id])->row_array();
    }

    public function get_Penilai()
    {
        return $this->db->get_where('admin', ['akses' => "Penilai"])->result_array();
    }

    public function get_Mapel()
    {
        return $this->db->get('mapel')->result_array();
    }

    public function add()
    {
        $data = [
            'id_admin' => $this->input->post('penilai', true),
            'id_mapel' => $this->input->post('mapel', true),
            'nama_guru' => htmlspecialchars($this->input->post('nama', true)),
            'nip' => htmlspecialchars($this->input->post('nip', true)),
            'jabatan' => htmlspecialchars($this->input->post('jabatan', true)),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            'pendidikan_terakhir' => $this->input->post('pendidikan'),
            'aktif' => "Y"
        ];

        $this->db->insert('guru', $data);
    }

    public function edit($id)
    {
        $data = [
            'id_admin' => $this->input->post('penilai', true),
            'id_mapel' => $this->input->post('mapel', true),
            'nama_guru' => htmlspecialchars($this->input->post('nama', true)),
            'nip' => htmlspecialchars($this->input->post('nip', true)),
            'jabatan' => htmlspecialchars($this->input->post('jabatan', true)),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            'pendidikan_terakhir' => $this->input->post('pendidikan'),
            'aktif' => htmlspecialchars($this->input->post('aktif', true))
        ];

        $this->db->where('id_guru', $id);
        $this->db->update('guru', $data);
    }

    public function delete($id)
    {
        $this->db->delete('guru', ['id_guru' => $id]);
    }
}
