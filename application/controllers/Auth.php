<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('auth/index');
        } else {
            $username = htmlspecialchars($this->input->post('username'));
            $password = htmlspecialchars($this->input->post('password'));

            $user = $this->db->get_where('data_user', ['id_user' => $username])->row_array();

            if ($user) {

                if (password_verify($password, $user['password_user'])) {
                    $data =  [
                        'id_user' => $user['id_user'],
                        'id_akses' => $user['id_akses']
                    ];

                       

                    // session 1 admin, 2 shp
                    $this->session->set_userdata($data);
                    if ($user['id_akses'] == 1) {
                        redirect('welcome');
                    } else {
                        // redirect('equest/shp');
                        redirect('notifikasi');
                    }
                } else {
                    $this->session->set_flashdata('info', '<div class="alert alert-warning alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            User Id atau Password anda<strong> salah!</strong>.
                            </div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('info', '<div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            User Id anda belum<strong> didaftarkan!</strong>.
                            </div>');
                redirect('auth');
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('id_user');
        $this->session->unset_userdata('id_akses');

        $this->session->set_flashdata('info', '<div class="alert alert-warning alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            Anda telah <strong> keluar!</strong>.
                            </div>');
        redirect('auth');
    }
}
