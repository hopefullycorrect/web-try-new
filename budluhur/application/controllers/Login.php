<?php

class Login extends CI_Controller {

    public function index() {
        $this->load->helper('form');

        if ($this->input->post()) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $this->load->model('Login_model');
            $user = $this->User_model->login($username, $password);

            if ($user) {
                $this->session->set_userdata('user_id', $user->id);
                $this->session->set_userdata('role', $user->role);

                if ($user->role === 'admin') {
                    redirect('admin/dashboard');
                } else {
                    redirect('user/dashboard');
                }
            } else {
                $this->data['error'] = 'Invalid username or password.';
            }
        }

        $this->load->view('login_form', $this->data);
    }
}
