<?php

class Raport_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function get_semesters_by_nis($nis) {
        $this->db->select('DISTINCT(semester)');
        $this->db->from('mapel');
        $this->db->where('nis', $nis);
        $query = $this->db->get();
        return $query->result_array();
    }

    function retrieve_by_nis_and_semester($nis, $semester) {
        $this->db->select('mapel.*, mhs.nama as mahasiswa_nama, raport.akm, raport.nilai, raport.keterangan');
        $this->db->from('mapel');
        $this->db->join('mhs', 'mapel.nis = mhs.nis');
        $this->db->join('raport', 'mapel.nis = raport.nis AND mapel.matapelajaran = raport.matapelajaran', 'left');
        $this->db->where('mapel.nis', $nis);
        $this->db->where('mapel.semester', $semester);
        $query = $this->db->get();
        if ($query->result()) {
            foreach ($query->result() as $content) {
                $data[] = array(
                    'nis' => $content->nis,
                    'mahasiswa_nama' => $content->mahasiswa_nama,
                    'matapelajaran' => $content->matapelajaran,
                    'semester' => $content->semester,
                    'akm' => $content->akm,
                    'nilai' => $content->nilai,
                    'keterangan' => $content->keterangan
                );
            }
            return $data;
        } else {
            return FALSE;
        }
    }

    function add($arg) {
        $mapel_data = array(
            'nis' => $arg['nis'],
            'matapelajaran' => $arg['matapelajaran'],
            'semester' => $arg['semester']
        );
        $this->db->insert('mapel', $mapel_data);

        $raport_data = array(
            'nis' => $arg['nis'],
            'matapelajaran' => $arg['matapelajaran'],
            'akm' => $arg['akm'],
            'nilai' => $arg['nilai'],
            'keterangan' => $arg['nilai'] >= $arg['akm'] ? 'terpenuhi' : 'tidak terpenuhi'
        );
        return $this->db->insert('raport', $raport_data);
    }

    function update($old_nis, $old_matapelajaran, $arg) {
        $mapel_data = array(
            'nis' => $arg['nis'],
            'matapelajaran' => $arg['matapelajaran'],
            'semester' => $arg['semester']
        );
        $this->db->where('nis', $old_nis);
        $this->db->where('matapelajaran', $old_matapelajaran);
        $this->db->update('mapel', $mapel_data);

        $raport_data = array(
            'nis' => $arg['nis'],
            'matapelajaran' => $arg['matapelajaran'],
            'akm' => $arg['akm'],
            'nilai' => $arg['nilai'],
            'keterangan' => $arg['nilai'] >= $arg['akm'] ? 'terpenuhi' : 'tidak terpenuhi'
        );
        $this->db->where('nis', $old_nis);
        $this->db->where('matapelajaran', $old_matapelajaran);
        return $this->db->update('raport', $raport_data);
    }

    public function delete($nis, $matapelajaran, $semester) {
        $this->db->where('nis', $nis);
        $this->db->where('matapelajaran', $matapelajaran);
        $this->db->where('semester', $semester);
        $this->db->delete('mapel');

        $this->db->where('nis', $nis);
        $this->db->where('matapelajaran', $matapelajaran);
        $this->db->delete('raport');
    }
}
?>
