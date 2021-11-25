<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Akun extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('id_user')) {
            $this->session->set_flashdata('info', '<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong> Silahkan Login </strong>.
              </div>');
            redirect('block');
        } else {

            $id_user = $this->session->userdata('id_user');
            $user = $this->db->get_where('user', ['noid' => $id_user])->row_array();

            if ($user['id_akses'] == 2) {
                redirect('block');
            }
        }
        $this->load->model('Akun_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = 'Daftar Akun MRI Operation';
        $data['akun'] = $this->Akun_model->getAllData();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('akun/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['judul'] = 'Tambah Akun MRI Operation';
        $data['divisi'] = $this->Akun_model->getDivisi();

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        // $this->form_validation->set_rules('tgl', 'tgl', 'required|min_length[10]|max_length[10]', [
        //     'min_length' => 'Format Tanggal Salah (dd-mm-yyyy). *tanpa spasi',
        //     'max_length' => 'Format Tanggal Salah (dd-mm-yyyy). *tanpa spasi',
        // ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]');
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('akun/tambah', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Akun_model->tambah();
            $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Akun baru telah <strong>ditambahkan!</strong>.
              </div>');

            redirect('akun');
        }
    }

    public function ubah($id)
    {
        $data['judul'] = 'Ubah Data Akun';
        $data['user'] = $this->Akun_model->getDataById($id);
        $data['divisi'] = $this->Akun_model->getDivisi();

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        // $this->form_validation->set_rules('tgl', 'tgl', 'required|min_length[10]|max_length[10]', [
        //     'min_length' => 'Format Tanggal Salah (dd-mm-yyyy). *tanpa spasi',
        //     'max_length' => 'Format Tanggal Salah (dd-mm-yyyy). *tanpa spasi',
        // ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('akun/ubah', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Akun_model->ubah($id);

            $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Akun telah berhasil <strong>diubah!</strong>.
              </div>');

            redirect('akun');
        }
    }

    public function hapus($id)
    {
        $this->Akun_model->hapus($id);

        $this->session->set_flashdata('info', '<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Akun telah <strong>dihapus!</strong>.
              </div>');

        redirect('akun');
    }

    public function changepassword($id)
    {
        $data['judul'] = 'Ganti Password';
        $data['user'] = $this->Akun_model->getDataById($id);


        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]');
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('akun/changepassword', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Akun_model->ubahPassword($id);

            $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Password telah berhasil <strong>diubah!</strong>.
              </div>');

            redirect('notifikasi/indexpic');
        }
    }

    public function ubahstatus($id, $type){
        if ($type == 1) {
            $this->db->query("UPDATE user SET status = '$type' WHERE noid='$id'");
        } else {
            $this->db->query("UPDATE user SET status = '$type', password = '' WHERE noid='$id'");
        }
        $this->session->set_flashdata('flash', 'Berhasil Ubah Status User');
        redirect('akun');
    }
}
