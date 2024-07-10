<?php

class Updatepw_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function retrieve($username) {
        $this->db->where('username', $username);
        $query = $this->db->get('mhs');
        if ($query->num_rows() == 1) {
            $content = $query->row();
            $data = array(
                'nis' => $content->nis,
                'password' => $content->password
            );
            return $data;
        } else {
            return FALSE;
        }
    }

    function update_password($username, $new_password) {
        $this->db->where('username', $username);
        $this->db->update('mhs', array('password' => $new_password));
    }
    


}
?>
