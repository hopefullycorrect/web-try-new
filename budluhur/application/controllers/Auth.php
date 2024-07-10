<?php

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');  // Load the form 
        $this->load->helper('auth');
        $this->load->library('session');
        $this->load->model('Login_model');
        $this->load->model('Userprofile_model');
        ob_start(); // Enable output buffering
    }

    public function login() {
        $this->load->view('login_view'); // Load the login view
    }

    public function login_process() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->Login_model->login($username, $password);

        if ($user) {
            $this->session->set_userdata('username', $user->username);
            $this->session->set_userdata('user_role', $user->role);
            $this->session->set_userdata('user_id', $user->nis);

            // Redirect based on role
            redirect($user->role === 'admin' ? 'dashboard' : 'dashboard_user');
        } else {
            $this->session->set_flashdata('error', 'Invalid username or password.');
            redirect('login');
        }
    }

    public function logout() {
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('user_role');
        $this->session->unset_userdata('username');
        redirect('login'); // Redirect to login after logout
    }

    public function dashboard_user() {
        if (!$this->session->userdata('username')) {
            redirect('login'); // Redirect to login if no username in session
        }

        $username = $this->session->userdata('username');
        $data['mhs'] = $this->Userprofile_model->retrieve($username);

        $this->load->view('dashboard_user', $data);
    }
    
}
?>
