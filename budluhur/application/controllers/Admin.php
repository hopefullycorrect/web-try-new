<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->helper('auth');
        check_user_role('admin');
        $this->load->model('Mapel_model');
        $this->load->model('Mahasiswa_model');
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function dashboard() {
        $user_role = $this->session->userdata('user_role');
        $username = $this->session->userdata('username');
        
        // Check user role
        if ($user_role == 'admin') {
            $unique_matapelajaran_count = $this->Mapel_model->count_unique_matapelajaran();
            $_SESSION['unique_matapelajaran_count'] = $unique_matapelajaran_count;

            $studentNumber = $this->Mahasiswa_model->count_students();
            $_SESSION['studentNumber'] = $studentNumber;
            
            $data['subjects'] = $this->Mapel_model->retrieve();
            
            $this->load->view('templates/admin/header');
            $this->load->view('templates/admin/sidebar');
            $this->load->view('dashboard', compact('username', 'unique_matapelajaran_count', 'studentNumber', 'data'));
            $this->load->view('templates/admin/footer');
        } elseif ($user_role == 'user') {
            redirect('user/dashboard');
        } else {
            redirect('auth/login');
        }
    }

    public function add_subject() {
        $arg = array(
            'nis' => $this->input->post('nis'),
            'matapelajaran' => $this->input->post('matapelajaran'),
            'semester' => $this->input->post('semester'),
            'akm' => $this->input->post('akm')
        );
        if ($this->Mapel_model->add($arg)) {
            $unique_matapelajaran_count = $this->Mapel_model->count_unique_matapelajaran();
            $_SESSION['unique_matapelajaran_count'] = $unique_matapelajaran_count;
            redirect('admin/dashboard');
        } else {
            echo "Failed to add subject";
        }
    }

    public function delete_subject($nis, $matapelajaran) {
        if ($this->Mapel_model->delete($nis, $matapelajaran)) {
            $unique_matapelajaran_count = $this->Mapel_model->count_unique_matapelajaran();
            $_SESSION['unique_matapelajaran_count'] = $unique_matapelajaran_count;
            redirect('admin/dashboard');
        } else {
            echo "Failed to delete subject";
        }
    }
}
?>
