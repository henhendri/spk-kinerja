<?php

class mapel_Model extends CI_Model
{
    //Akun Aktif
    public function admin_Active()
    {
        return $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
    }

    public function get_AllMapel()
    {
        return $this->db->get('mapel')->result_array();
    }

    public function get_ById($id)
    {
        return $this->db->get_where('mapel', ['id_mapel' => $id])->row_array();
    }

    public function add()
    {
        $data = [
            'mata_pelajaran' => $this->input->post('mapel')
        ];
        $this->db->insert('mapel', $data);
    }
    public function edit($id)
    {
        $this->db->set('mata_pelajaran', $this->input->post('mapel'));
        $this->db->where('id_mapel', $id);
        $this->db->update('mapel');
    }

    public function delete($id)
    {
        $this->db->delete('mapel', ['id_mapel' => $id]);
    }
}
