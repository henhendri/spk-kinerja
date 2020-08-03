<?php

class alternatif_Model extends CI_Model
{
    //Akun Aktif
    public function admin_Active()
    {
        return $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
    }

    public function get_AllAlternatif()
    {
        return $this->db->get('alternatif')->result_array();
    }

    public function get_ById($id)
    {
        return $this->db->get_where('alternatif', ['id_alternatif' => $id])->row_array();
    }

    public function add()
    {
        $data = [
            'nama_alternatif' => $this->input->post('nama')
        ];
        $this->db->insert('alternatif', $data);
    }

    public function edit($id)
    {
        $this->db->set('nama_alternatif', $this->input->post('nama'));
        $this->db->where('id_alternatif', $id);
        $this->db->update('alternatif');
    }

    public function delete($id)
    {
        $this->db->delete('alternatif', ['id_alternatif' => $id]);
    }
}
