<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Raport extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Raport_model');
        $this->load->model('Mahasiswa_model');
        $this->load->helper(array('url', 'form'));
        $this->load->library('session');
    }

    public function get_semesters() {
        $nis = $this->input->post('nis');
        $semesters = $this->Raport_model->get_semesters_by_nis($nis);
        echo json_encode($semesters);
    }

    public function index() {
        $nis = $this->input->post('nis');
        $semester = $this->input->post('semester');
        $data['selected_nis'] = $nis;
        $data['selected_semester'] = $semester;
        $data['raport'] = ($nis && $semester) ? $this->Raport_model->retrieve_by_nis_and_semester($nis, $semester) : array();
        $data['mhs'] = $this->Mahasiswa_model->retrieve();

        $this->load->view('templates/admin/header');
        $this->load->view('templates/admin/sidebar');
        $this->load->view('Raport_view', $data);
        $this->load->view('templates/admin/footer');
    }

    public function submit() {
        $data = $this->input->post('var');
        $data['keterangan'] = $data['nilai'] >= $data['akm'] ? 'terpenuhi' : 'tidak terpenuhi';
        $this->Raport_model->add($data);

        redirect('raport');
    }

    public function update() {
        $old_nis = $this->input->post('old_nis');
        $old_matapelajaran = $this->input->post('old_matapelajaran');
        $data = $this->input->post('var');
        $data['keterangan'] = $data['nilai'] >= $data['akm'] ? 'terpenuhi' : 'tidak terpenuhi';
        $this->Raport_model->update($old_nis, $old_matapelajaran, $data);
        redirect('raport');
    }

    public function delete() {
        $nis = $this->input->post('nis');
        $matapelajaran = $this->input->post('matapelajaran');
        $semester = $this->input->post('semester');
        $this->Raport_model->delete($nis, $matapelajaran, $semester);
        redirect('raport');
    }
}
?>
