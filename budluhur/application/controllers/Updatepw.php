<?php
class Updatepw extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Login_model');
        $this->load->model('Updatepw_model');
        $this->load->helper(array('url', 'form'));
        $this->load->library('session');
        $this->check_user();
    }

    private function check_user() {
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
    }

    public function view() {
        $password = $this->session->userdata('password');
        $username = $this->session->userdata('username');
        $data['mhs'] = $this->Updatepw_model->retrieve($username);
        $usernis = $this->session->userdata('user_id');
        $this->load->view('templates/user/header');
        $this->load->view('templates/user/sidebar');
        $this->load->view('Updatepassword', $data);
        $this->load->view('templates/user/footer_noprint');
    }
    public function update_password() {
        $new_password = $this->input->post('new_password');
        $confirm_password = $this->input->post('confirm_password');
        $username = $this->session->userdata('username');
    
        if ($new_password === $confirm_password) {
            $this->load->model('Updatepw_model');
            $this->Updatepw_model->update_password($username, $new_password);
            $this->session->set_flashdata('message', 'Password updated successfully.');
        } else {
            $this->session->set_flashdata('message', 'Passwords do not match.');
        }
        redirect('updatepassword');
    }

    
    public function logout_user() {
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('user_role');
        redirect('login'); // Redirect to login after logout
    }
}
?>
