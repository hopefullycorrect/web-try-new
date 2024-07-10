<?php

class UserRaport_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function retrieve_by_nis_and_semester($nis, $semester) {
    $this->db->select('r.*, m.nama as mahasiswa_nama, mp.matapelajaran, mp.semester');
    $this->db->from('raport r');
    $this->db->join('mapel mp', 'r.matapelajaran = mp.matapelajaran AND r.nis = mp.nis');
    $this->db->join('mhs m', 'r.nis = m.nis');
    $this->db->where('r.nis', $nis);
    $this->db->where('mp.semester', $semester);
    $query = $this->db->get();
    return $query->result_array();
}


    public function get_semesters_by_nis($nis) {
    $this->db->distinct();
    $this->db->select('mp.semester');
    $this->db->from('raport r');
    $this->db->join('mapel mp', 'r.matapelajaran = mp.matapelajaran');
    $this->db->where('r.nis', $nis);
    $query = $this->db->get();
    return $query->result_array();
}

    
    
    
}
?>
