<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserRaport extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->model('UserRaport_model');
        $this->load->model('Userprofile_model'); // Load the correct model
    }

    public function index() {
        // Assuming the user is logged in and their username is stored in session
        $username = $this->session->userdata('username');
        $user_info = $this->Userprofile_model->retrieve($username);
        $nis = $user_info['nis'];

        $semester = $this->input->post('semester');
        $raport = ($semester) ? $this->UserRaport_model->retrieve_by_nis_and_semester($nis, $semester) : array();
        $semesters = $this->UserRaport_model->get_semesters_by_nis($nis);

        // Calculate total and average
        $total_nilai = 0;
        $jumlah_entries = count($raport);
        foreach ($raport as $entry) {
            $total_nilai += $entry['nilai'];
        }
        $rata_rata = ($jumlah_entries > 0) ? $total_nilai / $jumlah_entries : 0;

        $data = array(
            'selected_nis' => $nis,
            'selected_semester' => $semester,
            'raport' => $raport,
            'semesters' => $semesters,
            'user_info' => $user_info,
            'total_nilai' => $total_nilai,
            'rata_rata' => $rata_rata
        );

        $this->load->view('templates/user/header');
        $this->load->view('templates/user/sidebar');
        $this->load->view('raport_user_view', $data);
        $this->load->view('templates/user/footer');
    }
}
?>
