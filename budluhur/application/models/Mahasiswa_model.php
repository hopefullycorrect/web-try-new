<?php

class Mahasiswa_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function retrieve() {
        $query = $this->db->get('mhs');
        if ($query->result()) {
            foreach ($query->result() as $content) {
                $data[] = array(
                    $content->nis,
                    $content->nama,
                    $content->alamat
                );
            }
            return $data;
        } else {
            return FALSE;
        }
    }

    function count_students() {
        return $this->db->count_all('mhs');
    }

    function add($arg) {
        $data = array(
            'nis' => $arg['nis'],
            'nama' => $arg['nama'],
            'alamat' => $arg['alamat']
        );
        return $this->db->insert('mhs', $data);
    }

    function delete($id) {
        $this->db->where('nis', $id);
        return $this->db->delete('mhs');
    }

    function update($id, $form) {
        $data = array(
            'nis' => $form['nis'],
            'nama' => $form['nama'],
            'alamat' => $form['alamat']
        );
        $this->db->where('nis', $id);
        return $this->db->update('mhs', $data);
    }

    function getMahasiswa($id) {
        $this->db->where('nis', $id);
        $query = $this->db->get('mhs');
        if ($query->result()) {
            foreach ($query->result() as $content) {
                $data = array(
                    'nis' => $content->nis,
                    'nama' => $content->nama,
                    'alamat' => $content->alamat
                );
            }
            return $data;
        } else {
            return FALSE;
        }
    }

    public function get_nis_list() {
        $this->db->select('nis, nama');
        $query = $this->db->get('mhs');
        return $query->result_array();
    }
}
?>
