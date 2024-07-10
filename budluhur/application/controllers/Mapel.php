<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mapel extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mapel_model');
        $this->load->model('Mahasiswa_model');
        $this->load->model('Raport_model'); // Load Raport_model
        $this->load->helper(array('url', 'form'));
        $this->load->library('session');

        $this->update_unique_matapelajaran_count();
    }

    public function index() {
        $nis = $this->input->post('nis');
        $data['selected_nis'] = $nis;
        $data['mapel'] = $nis ? $this->Mapel_model->retrieve_by_nis($nis) : array();
        $data['mhs'] = $this->Mahasiswa_model->retrieve();

        $this->load->view('templates/admin/header');
        $this->load->view('templates/admin/sidebar');
        $this->load->view('Mapel_view', $data);
        $this->load->view('templates/admin/footer');
    }

    public function submit() {
        $data = $this->input->post('var');
        $this->Mapel_model->add($data);
        redirect('mapel');
    }

    public function delete() {
        $nis = $this->input->post('nis');
        $matapelajaran = $this->input->post('matapelajaran');
        $this->Mapel_model->delete($nis, $matapelajaran);
        redirect('mapel');
    }

    public function update_unique_matapelajaran_count() {
        $count = $this->Mapel_model->count_unique_matapelajaran();
        $this->session->set_userdata('unique_matapelajaran_count', $count);
    }

    public function update() {
        $old_nis = $this->input->post('old_nis');
        $old_matapelajaran = $this->input->post('old_matapelajaran');
        $data = $this->input->post('var');
        $this->Mapel_model->update($old_nis, $old_matapelajaran, $data);
        redirect('mapel');
    }
}
?>
