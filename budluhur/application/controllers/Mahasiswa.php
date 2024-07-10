<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mahasiswa_model');
        $this->load->helper(array('url', 'form'));
        $this->load->helper('auth');
        check_user_role('admin');
    }

    public function siswa() {
        $data['mhs'] = $this->Mahasiswa_model->retrieve();
        $this->load->view('templates/admin/header');
        $this->load->view('templates/admin/sidebar');
        $this->load->view('Mahasiswa_view', $data);
        $this->load->view('templates/admin/footer');
    }

    public function form_tambah() {
        $this->load->view('tambah_view');
    }

    public function submit() {
        $this->Mahasiswa_model->add($this->input->post('var'));
        redirect('siswa');
    }

    public function delete() {
        $this->Mahasiswa_model->delete($this->input->post('nis'));
        redirect('siswa');
    }

    public function form_update() {
        $data['mhs'] = $this->Mahasiswa_model->getMahasiswa($this->uri->rsegment(3));
        $this->load->view('update_view', $data);
    }

    public function update() {
        $this->Mahasiswa_model->update($this->input->post('old_nis'), $this->input->post('var'));
        redirect('siswa');
    }
}
?>
