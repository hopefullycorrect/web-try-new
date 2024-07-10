<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {
    public function login($username, $password) {
        $this->db->where('username', $username);
        $query = $this->db->get('mhs');

        if ($query->num_rows() == 1) {
            $user = $query->row();
            if ($user->password == $password) {
                return $user;
            }
        }
        return false;
    }
}
?>
