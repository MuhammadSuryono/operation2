<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = 'Akses Menu';
        $data['divisi'] = $this->Menu_model->getDivisi();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('menu/index', $data);
        $this->load->view('templates/footer');
    }

    public function daftar_menu($id)
    {
      $data['master'] = $this->db->order_by('urut', 'asc')->get_where('kelompok_menu', array('id_divisi' => $id))->result_array();
      $data['judul'] = "Master Menu";
                       

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('menu/daftar_menu', $data);
            $this->load->view('templates/footer');

    }

    public function add_daftar_menu()
    {
      $data = [
                'id_divisi' => $this->input->post('id_divisi'),
                'urut' => $this->input->post('urut'),
                'nama_menu' => $this->input->post('nama_menu'),
                'icon' => $this->input->post('icon'),
                'sub' => $this->input->post('sub'),
                'control_menu' => $this->input->post('control_menu')
                                
                ];  
        $id_divisi =  $this->input->post('id_divisi');

        $this->db->insert('kelompok_menu', $data);

        $this->session->set_flashdata('flash', 'Berhasil Menambahkan Menu!');
        redirect('menu/daftar_menu/'.$id_divisi);
    }

    public function edit_daftar_menu()
    {
      $data = [
                  'id_divisi' => $this->input->post('id_divisi'),
                'urut' => $this->input->post('urut'),
                'nama_menu' => $this->input->post('nama_menu'),
                'icon' => $this->input->post('icon'),
                'sub' => $this->input->post('sub'),
                'control_menu' => $this->input->post('control_menu')
                                
                ];  
        $id_divisi =  $this->input->post('id_divisi');

        $id_menu = $this->input->post('id_menu');

        $where = ['id_menu' => $id_menu];

        $this->db->where($where);
        $this->db->update('kelompok_menu', $data);
        $this->session->set_flashdata('flash', 'Berhasil Mengedit Menu!');
        redirect('menu/daftar_menu/'.$id_divisi);
    }

    public function delete_daftar_menu($id_menu, $id_divisi)
    {
       $where = ['id_menu' => $id_menu];

        $this->db->where($where);
        $this->db->delete('kelompok_menu');
        $this->session->set_flashdata('flash', 'Berhasil Hapus Menu!');
        redirect('menu/daftar_menu/'.$id_divisi); 
    }

     public function daftar_submenu($id)
    {
      $data['submenu'] = $this->db->order_by('urut', 'asc')->get_where('kelompok_submenu', array('id_menu' => $id))->result_array();
      $data['judul'] = "Master Menu";
                       

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
             $this->load->view('menu/daftar_submenu', $data);
            $this->load->view('templates/footer');

    }

    public function add_daftar_submenu()
    {
      $data = [
                'id_menu' => $this->input->post('id_menu'),
                'urut' => $this->input->post('urut'),
                'nama_submenu' => $this->input->post('nama_submenu'),
                'control_submenu' => $this->input->post('control_submenu')
                                
                ];  
        $id_menu =  $this->input->post('id_menu');

        $this->db->insert('kelompok_submenu', $data);
        $this->session->set_flashdata('flash', 'Berhasil Menambahkan SubMenu!');
        redirect('menu/daftar_submenu/'.$id_menu);
    }

     public function edit_daftar_submenu()
    {
      $data = [
                'id_menu' => $this->input->post('id_menu'),
                'urut' => $this->input->post('urut'),
                'nama_submenu' => $this->input->post('nama_submenu'),
                'control_submenu' => $this->input->post('control_submenu')
                                
                ];  
        $id_menu =  $this->input->post('id_menu');

        $id_submenu = $this->input->post('id_submenu');

        $where = ['id_submenu' => $id_submenu];

        $this->db->where($where);
        $this->db->update('kelompok_submenu', $data);
        $this->session->set_flashdata('flash', 'Berhasil Mengedit SubMenu!');
        redirect('menu/daftar_submenu/'.$id_menu);
    }

     public function delete_daftar_submenu($id_submenu, $id_menu)
    {
       $where = ['id_submenu' => $id_submenu];

        $this->db->where($where);
        $this->db->delete('kelompok_submenu');
        $this->session->set_flashdata('flash', 'Berhasil Hapus SubMenu!');
        redirect('menu/daftar_submenu/'.$id_menu); 
    }


    public function panduan()
    {
        // $data['submenu'] = $this->db->order_by('urut', 'asc')->get_where('kelompok_submenu', array('id_menu' => $id))->result_array();
    $data['panduan'] = $this->db->query("SELECT * FROM panduan ORDER BY id DESC")->result_array();
    $data['judul'] = "Panduan Aplikasi";
                       

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('menu/panduan', $data);
            $this->load->view('templates/footer');

    }

    public function uploadpanduan() {
        $judul = $this->input->post('judul');
         $tanggal = date('Y-m-d');

        $extension_file  = pathinfo($_FILES['file_upload']['name'], PATHINFO_EXTENSION);
        $file_name = "PanduanAplikasi_".$tanggal."_" . time() . "." . $extension_file;
        $file_tmp = $_FILES["file_upload"]['tmp_name'];
        move_uploaded_file($file_tmp, "assets/file/panduan/" . $file_name);
       

        
        $data = [
                'judul' => $judul,
                'fileupload' => $file_name,
                'tanggalupload' => $tanggal
                ];

        $insert = $this->db->insert('panduan', $data);
        if ($insert) {
            $this->session->set_flashdata('flash', 'Berhasil Upload Panduan');
            redirect('menu/panduan'); 
        } else {
          $this->session->set_flashdata('flash2', 'Gagal Upload Panduan');
          redirect('menu/panduan');
        }
  }

  public function hapuspanduan($id)
  {
     $this->Menu_model->hapuspanduan($id);
     $this->session->set_flashdata('flash', 'Berhasil Di Hapus');
     redirect('menu/panduan');
  }

    
}
