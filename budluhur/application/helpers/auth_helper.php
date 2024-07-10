<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('check_user_role')) {
    function check_user_role($required_role) {
        $CI =& get_instance();
        $user_role = $CI->session->userdata('user_role');

        if ($user_role !== $required_role) {
            redirect('login');
            $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('user_role');
        }
    }
}
?>
