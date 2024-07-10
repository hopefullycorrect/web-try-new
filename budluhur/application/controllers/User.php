<?php
class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Login_model');
        $this->load->model('Userprofile_model');
        $this->load->helper(array('url', 'form'));
        $this->load->library('session');
        $this->check_user();
    }

    private function check_user() {
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
    }

    public function dashboard() {
        
       
        $username = $this->session->userdata('username');
        $data['mhs'] = $this->Userprofile_model->retrieve($username);
        $usernis = $this->session->userdata('user_id');
        $this->load->view('templates/user/header');
        $this->load->view('templates/user/sidebar');
        $this->load->view('dashboard_user', $data);
        $this->load->view('templates/user/footer');
    }
    public function logout_user() {
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('user_role');
        redirect('login'); // Redirect to login after logout
    }
}
?>
