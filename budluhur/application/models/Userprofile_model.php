<?php

class Userprofile_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Retrieve all students
    // function retrievk() {
    //     $query = $this->db->get('mhs');
    //     if ($query->result()) {
    //         foreach ($query->result() as $content) {
    //             $data[] = array(
    //                 $content->nis,
    //                 $content->nama,
    //                 $content->alamat
    //             );
    //         }
    //         return $data;
    //     } else {
    //         return FALSE;
    //     }
    // }


    function retrieve($username) {
        $this->db->where('username', $username);
        $query = $this->db->get('mhs');
        if ($query->num_rows() == 1) {
            $content = $query->row();
            $data = array(
                'nis' => $content->nis,
                'nama' => $content->nama,
                'alamat' => $content->alamat
            );
            return $data;
        } else {
            return FALSE;
        }
    }


}
?>
