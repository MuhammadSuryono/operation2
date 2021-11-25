<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Skenario extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

         if(!$this->session->userdata('id_user')){
             $this->session->set_flashdata('info', '<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong> Silahkan Login </strong>.
              </div>');
            redirect('block');

        } else {

            $id_user = $this->session->userdata('id_user');
            $user = $this->db->get_where('user', ['noid' => $id_user])->row_array();

            if($user['id_akses'] == 2) {
                redirect('block');
            }
        }

        $this->load->model('Skenario_model');
        $this->load->model('Project_model');
        $this->load->model('Cabang_model');
        $this->load->library('form_validation');
    }

    public function index(){

        $id_user = $this->session->userdata('id_user');
        $data['judul'] = 'Daftar Briefing Skenario';
        $data['data_skenario'] = $this->Skenario_model->getdatabriefing($id_user);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('skenario/index', $data);
        $this->load->view('templates/footer');

    }

    public function formtambah()
    {
        $data['judul'] = 'Tambah Briefing Skenario';
        $id_user = $this->session->userdata('id_user');

        //Satuin dengan table data tedy "project"
        $data['projects'] = $this->Skenario_model->getprojects($id_user);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('skenario/tambah', $data);
        $this->load->view('templates/footer');
    }

    public function getskenariokunjungan()
    {
        $id_user = $this->session->userdata('id_user');
        $id = $_POST['pro'];
        $data = $this->Skenario_model->getskenariokunjungan($id_user, $id);
        echo json_encode($data);
    }

    public function getkategori()
    {
        $data = $this->db->get('bank')->result_array();
        echo json_encode($data);
    }

    public function tambah(){
        $data['judul'] = 'Upload Skenario dan Rekaman Briefing';
        // $this->form_validation->set_rules('skenario', 'Skenario', 'required');
        // $this->form_validation->set_rules('berkas', 'Berkas', 'required');

        // if($this->form_validation->run() == false){

        //     $id_user = $this->session->userdata('id_user');
        //     $data['projects'] = $this->Skenario_model->getprojects($id_user);

        //     $this->load->view('templates/header', $data);
        //     $this->load->view('templates/sidebar');
        //     $this->load->view('skenario/tambah', $data);
        //     $this->load->view('templates/footer');
        // } else {

            // $img1 = $_FILES['berkas']['name'];
            // $file_tmp = $_FILES['filedata']['tmp_name'];
            // move_uploaded_file($file_tmp,'./assets/file/skenario'.$file_name);
            // $img2 = $_FILES['kuis']['name'];
            // $file_tmp2 = $_FILES['filedata']['tmp_name'];
            // move_uploaded_file($file_tmp2,'./assets/file/skenario'.$file_name);

            $project = $this->input->post('project');
            $kunjungan = htmlspecialchars($this->input->post('kunjungan', true));

            // $img1 = $_FILES['berkas']['name'];
            // $img2 = $_FILES['kuis']['name'];


            $berkas = isset($_FILES['berkas']['error']) != 0 ? $_FILES['berkas'] : NULL;

            $file_tmp           = $berkas['tmp_name'];
            $file_ext           = pathinfo($berkas['name'], PATHINFO_EXTENSION);
            $file_save1          = "Briefing ".$project." ".$kunjungan.".".$file_ext;
            move_uploaded_file($file_tmp,"assets/file/skenario/".$file_save1);

            $kuis = isset($_FILES['kuis']['error']) != 0 ? $_FILES['kuis'] : NULL;

            $file_tmp           = $kuis['tmp_name'];
            $file_ext           = pathinfo($kuis['name'], PATHINFO_EXTENSION);
            $file_save2          = "Skenario ".$project." ".$kunjungan.".".$file_ext;
            move_uploaded_file($file_tmp,"assets/file/skenario/".$file_save2);

            $img1 = $file_save1;
            $img2 = $file_save2;

            // if($img1 and $img2){
            //         $config['upload_path']          = './assets/file/skenario';
            //         $config['allowed_types']        = 'pdf|doc|docx|xls|xlsx|mp3|wav|mp4|mkv|3gp';

            //         $this->load->library('upload', $config);
            //         if($this->upload->do_upload('berkas')) {
            //            $img = $this->upload->data('file_name');
            //         } else {
            //             echo $this->upload->display_errors();
            //         }

            //         if ($this->upload->do_upload('kuis')){
            //             $img3 = $this->upload->data('file_name');
            //         } else {
            //             echo $this->upload->display_errors();
            //         }
            // }

            $this->Skenario_model->tambah($img1, $img2);
            $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Data Skenario telah <strong>ditambahkan!</strong>.
              </div>');
            redirect('skenario');
        // }
    }


    public function hapus($id){
        $this->Skenario_model->hapus($id);

        $this->session->set_flashdata('info', '<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Data Skenario telah <strong>dihapus!</strong>.
              </div>');

        redirect('skenario');
    }

    public function download(){
        $data = $this->uri->segment(3);
         $file = urldecode($data);
         $berkas = FCPATH . '/assets/file/skenario/' . $file;
         force_download($berkas, NULL);
    }

    public function ubah($id){

        $data['data_skenario'] = $this->Skenario_model->getSkenarioById($id);
        $data['judul'] = 'Ubah Data Skenario';
        $this->form_validation->set_rules('skenario', 'Skenario', 'required');

        if($this->form_validation->run() == false){
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar');
                $this->load->view('skenario/ubah', $data);
                $this->load->view('templates/footer');
            } else {

                $img1 = $_FILES['berkas']['name'];
                $img2 = $_FILES['kuis']['name'];

                if($img1){
                    $config['upload_path']          = './assets/file/skenario';
                    $config['allowed_types']        = 'pdf|doc|docx|xls|xlsx|mp3|wav|mp4|mkv|3gp|mov|m4a';

                     $this->load->library('upload', $config);
                     if($this->upload->do_upload('berkas')) {
                         $img = $this->upload->data('file_name');
                     } else {
                         echo $this->upload->display_errors();
                     }

            } else {
                $img = 0;
                $img3 = 0;
            }

            if($img2){
                    $config['upload_path']          = './assets/file/skenario';
                    $config['allowed_types']        = 'pdf|doc|docx|xls|xlsx|mp3|wav|mp4|mkv|3gp|mov|m4a';

                     $this->load->library('upload', $config);
                     if($this->upload->do_upload('kuis')) {
                         $img3 = $this->upload->data('file_name');
                     } else {
                         echo $this->upload->display_errors();
                     }
            } else {
                $img3 = 0;
            }

                $this->Skenario_model->ubah($id, $img, $img3);

                $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Data Skenario telah <strong>diubah!</strong>.
                </div>');

                redirect('skenario');
            }
    }

    public function kunjungan(){
        $id_user = $this->session->userdata('id_user');
        $data['judul'] = 'Skenario Kunjungan';
        $data['project'] = $this->Skenario_model->getprojects2($id_user);
        $data['skenario'] = $this->Skenario_model->getkunjungan();
        $data['getkunjungan'] = $this->Skenario_model->getkunjungan();
        $data['viewskenario'] = $this->Skenario_model->viewskenario($id_user);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('skenario/kunjungan', $data);
        $this->load->view('templates/footer');
    }

    public function greeting_sosmed(){
        $id_user = $this->session->userdata('id_user');
        $data['judul'] = 'Daftar Greeting Evaluasi Sosial Media';
        $data['project'] = $this->Skenario_model->getproject_ebanking($id_user);
        $data['greeting'] = $this->Skenario_model->greeting_sosmed();

        $data['bank'] = $this->Project_model->getbank();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('skenario/daftar_greeting', $data);
        $this->load->view('templates/footer');
    }

    public function add_greetsosmed(){
                      

        $data = ['greeting' => $this->input->post('nama'),
                'score' => $this->input->post('score'),
                'urut' => $this->input->post('urut')];

        $this->db->insert('sosmed_greeting', $data);
        $this->session->set_flashdata('flash', 'Berhasil Menambahkan Daftar Sampel Greeting');
         redirect('skenario/greeting_sosmed');
    }

    public function edit_greetsosmed(){
        $nama = $this->input->post('nama');
        $score = $this->input->post('score');
        $urut = $this->input->post('urut');
        
        $kode = $this->input->post('kode');

        $this->db->query("UPDATE sosmed_greeting SET greeting='$nama', score='$score', urut='$urut' WHERE kode='$kode'");
        $this->session->set_flashdata('flash', 'Berhasil Edit Daftar Sampel Greeting');
        redirect('skenario/greeting_sosmed');
    }

    public function hapus_greetsosmed($kode){

        $this->db->query("DELETE FROM sosmed_greeting WHERE kode='$kode'");
        $this->session->set_flashdata('flash', 'Berhasil Delete Daftar Sampel Greeting');
        redirect('skenario/greeting_sosmed');

    }

    public function sosmed(){
        $id_user = $this->session->userdata('id_user');
        $data['judul'] = 'Skenario Evaluasi Sosial Media';
        $data['project'] = $this->Skenario_model->getproject_ebanking($id_user);
        $data['skenario'] = $this->Skenario_model->getkunjungan();
        $data['getskenario'] = $this->Skenario_model->skenario_sosmed();
        $data['viewskenario'] = $this->Skenario_model->viewskenario_ebanking($id_user);

        $data['bank'] = $this->Project_model->getbank();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('skenario/sosmed', $data);
        $this->load->view('templates/footer');
    }

    public function akun_sosmed(){
        $id_user = $this->session->userdata('id_user');
        $data['judul'] = 'Akun Sosial Media';
        
        $data['akun_pribadi'] = $this->Skenario_model->akunpribadi_sosmed();
        $data['akun_bank'] = $this->Skenario_model->akunbank_sosmed();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('skenario/akun_sosmed', $data);
        $this->load->view('templates/footer');
    }

    public function add_akunpribadisosmed(){             
        $data = ['username' => $this->input->post('username'),
                'platform' => $this->input->post('platform'),
                'milik' => 'Pribadi'];

        $this->db->insert('sosmed_akun', $data);
        $this->session->set_flashdata('flash', 'Berhasil Menambahkan Akun Sosial Media Pengguna');
         redirect('skenario/akun_sosmed');
    }

    public function edit_akunpribadisosmed(){
        $username = $this->input->post('username');
        $platform = $this->input->post('platform');
        $kode = $this->input->post('kode');

        $this->db->query("UPDATE sosmed_akun SET username='$username', platform='$platform' WHERE id='$kode'");
        $this->session->set_flashdata('flash', 'Berhasil Edit Akun Sosial Media Pengguna');
        redirect('skenario/akun_sosmed');
    }

    public function hapus_akunpribadisosmed($kode){

        $this->db->query("DELETE FROM sosmed_akun WHERE id='$kode'");
        $this->session->set_flashdata('flash', 'Berhasil Delete Akun Sosial Media Pengguna');
        redirect('skenario/akun_sosmed');
    }

    public function add_akunbanksosmed(){             
        $data = ['username' => $this->input->post('username'),
                'platform' => $this->input->post('platform'),
                'bank' => $this->input->post('bank'),
                'milik' => 'Bank'];

        $this->db->insert('sosmed_akun', $data);
        $this->session->set_flashdata('flash', 'Berhasil Menambahkan Akun Sosial Media Bank');
         redirect('skenario/akun_sosmed');
    }

    public function edit_akunbanksosmed(){
        $username = $this->input->post('username');
        $platform = $this->input->post('platform');
        $bank = $this->input->post('bank');

        $kode = $this->input->post('kode');

        $this->db->query("UPDATE sosmed_akun SET username='$username', platform='$platform', bank='$bank' WHERE id='$kode'");
        $this->session->set_flashdata('flash', 'Berhasil Edit Akun Sosial Media Bank');
        redirect('skenario/akun_sosmed');
    }

    public function hapus_akunbanksosmed($kode){

        $this->db->query("DELETE FROM sosmed_akun WHERE id='$kode'");
        $this->session->set_flashdata('flash', 'Berhasil Delete Akun Sosial Media Bank');
        redirect('skenario/akun_sosmed');
    }

    public function skenario_sosmed(){
        $id_user = $this->session->userdata('id_user');
        $data['judul'] = 'Skenario Sosial Media';
        
        $data['skenario'] = $this->Skenario_model->skenario_sosmed();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('skenario/skenario_sosmed', $data);
        $this->load->view('templates/footer');
    }

    public function add_skensosmed(){
                      

        $data = ['nama' => $this->input->post('nama')];

        $this->db->insert('sosmed_skenario', $data);
        $this->session->set_flashdata('flash', 'Berhasil Menambahkan Daftar Skenario');
         redirect('skenario/skenario_sosmed');
    }

    public function edit_skensosmed(){
        $nama = $this->input->post('nama');
        
        $kode = $this->input->post('kode');

        $this->db->query("UPDATE sosmed_skenario SET nama='$nama' WHERE kode='$kode'");
        $this->session->set_flashdata('flash', 'Berhasil Edit Daftar Skenario');
        redirect('skenario/skenario_sosmed');
    }

    public function hapus_skensosmed($kode){

        $this->db->query("DELETE FROM sosmed_skenario WHERE kode='$kode'");
        $this->session->set_flashdata('flash', 'Berhasil Delete Daftar Skenario');
        redirect('skenario/skenario_sosmed');
    }

    public function tambah_sosmed(){
        $jumlahskenario = $this->input->post('jumlahskenario_ebanking', true);
        $this->Skenario_model->tambah_sosmed($jumlahskenario);
    }

    public function delete_sosmed()
    {
      $num = $this->input->post('sosmed');

      var_dump($num);
      foreach ($num as $row => $val) {
        $this->db->query("DELETE FROM sosmed WHERE num='$val'");
      }

      $this->session->set_flashdata('flash', 'Berhasil Delete Skenaro Evaluasi Sosial Media');
      redirect('skenario/sosmed');
    }

     public function ebanking(){
        $id_user = $this->session->userdata('id_user');
        $data['judul'] = 'Skenario E-Banking';
        $data['project'] = $this->Skenario_model->getproject_ebanking($id_user);
        $data['skenario'] = $this->Skenario_model->getkunjungan();
        $data['gettransaksi'] = $this->Skenario_model->gettransaksi();
        $data['viewskenario'] = $this->Skenario_model->viewskenario_ebanking($id_user);

        $data['bank'] = $this->Project_model->getbank();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('skenario/ebanking', $data);
        $this->load->view('templates/footer');
    }

     public function transaksi_ebanking(){
        $id_user = $this->session->userdata('id_user');
        $data['judul'] = 'Transaksi E-Banking';
        
        $data['transaksi'] = $this->Skenario_model->transaksi_ebanking();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('skenario/transaksi_ebanking', $data);
        $this->load->view('templates/footer');
    }



    public function add_transaksi(){
        $transaksi = $this->input->post('transaksi');
        $sumber = $this->input->post('sumber');
        $kategori = $this->input->post('kategori');
                      

        $data = ['nama' => $transaksi, 'sumber' => $sumber, 'kategori' => $kategori];

        $this->db->insert('attribute_ebanking', $data);
        $this->session->set_flashdata('flash', 'Berhasil Menambahkan Daftar Transaksi');
         redirect('skenario/transaksi_ebanking');
    }

    public function edit_transaksi(){
        $transaksi = $this->input->post('transaksi');
        $sumber = $this->input->post('sumber');
        $kategori = $this->input->post('kategori');
        
        $kode = $this->input->post('kode');


        $this->db->query("UPDATE attribute_ebanking SET nama='$transaksi', sumber='$sumber', kategori='$kategori' WHERE kode='$kode'");
        $this->session->set_flashdata('flash', 'Berhasil Edit Daftar Transaksi');
        redirect('skenario/transaksi_ebanking');
    }

    public function hapus_transaksi($kode){

        $this->db->query("DELETE FROM attribute_ebanking WHERE kode='$kode'");
        $this->session->set_flashdata('flash', 'Berhasil Delete Daftar Transaksi');
        redirect('skenario/transaksi_ebanking');

    }

    public function getAllDataSkenario(){
        $data = $this->Skenario_model->getAllDataSkenario();
        echo json_encode($data);
    }

    public function rekening_ebanking(){
        $id_user = $this->session->userdata('id_user');
        $data['judul'] = 'Daftar Rekening E-Banking';
        
        $data['rekening'] = $this->Skenario_model->rekening_ebanking();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('skenario/rekening_ebanking', $data);
        $this->load->view('templates/footer');
    }

     public function add_rekening(){
        $bank = $this->input->post('bank');
        $norek = $this->input->post('norek');
        $nama = $this->input->post('nama');
        $kategori = $this->input->post('kategori');

        $data = ['bank' => $bank,
                'norek' => $norek,
                'nama' => $nama,
                'kategori' => $kategori
                ];

        $this->db->insert('ebanking_rekening', $data);
        $this->session->set_flashdata('flash', 'Berhasil Menambahkan Daftar Rekening');
         redirect('skenario/rekening_ebanking');
    }

    public function edit_rekening(){
        $id = $this->input->post('id');
        
        $bank = $this->input->post('bank');
        $norek = $this->input->post('norek');
        $nama = $this->input->post('nama');
         $kategori = $this->input->post('kategori');        


        $data = ['bank' => $bank,
                'norek' => $norek,
                'nama' => $nama,
                'kategori' => $kategori
                ];

        $this->db->where('id', $id);
        $this->db->update('ebanking_rekening', $data);
        $this->session->set_flashdata('flash', 'Berhasil Edit Daftar Rekening');
         redirect('skenario/rekening_ebanking');
    }

    public function hapus_rekening($id){

        $this->db->query("DELETE FROM ebanking_rekening WHERE id='$id'");
        $this->session->set_flashdata('flash', 'Berhasil Delete Daftar Rekening');
        redirect('skenario/rekening_ebanking');

    }

    public function aplikasi_ebanking(){
        $id_user = $this->session->userdata('id_user');
        $data['judul'] = 'Daftar Aplikasi E-Banking';
        
        $data['aplikasi'] = $this->Skenario_model->aplikasi_ebanking();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('skenario/aplikasi_ebanking', $data);
        $this->load->view('templates/footer');
    }

    public function add_aplikasi(){
        $bank = $this->input->post('bank');
        $channel = $this->input->post('channel');
        $nama = $this->input->post('nama');
        $system = $this->input->post('system');


        $data = ['bank' => $bank,
                'channel' => $channel,
                'nama' => $nama,
                'os' => $system
                ];

        $this->db->insert('ebanking_aplikasi', $data);
        $this->session->set_flashdata('flash', 'Berhasil Menambahkan Daftar Aplikasi E-Banking');
         redirect('skenario/aplikasi_ebanking');
    }

    public function edit_aplikasi(){
        $id = $this->input->post('id');
        
        $bank = $this->input->post('bank');
        $channel = $this->input->post('channel');
        $nama = $this->input->post('nama');
        $system = $this->input->post('system');        


        $data = ['bank' => $bank,
                'channel' => $channel,
                'nama' => $nama,
                'os' => $system
                ];
        var_dump($data);

        $this->db->where('id', $id);
        $this->db->update('ebanking_aplikasi', $data);
        $this->session->set_flashdata('flash', 'Berhasil Edit Daftar Aplikasi');
         redirect('skenario/aplikasi_ebanking');
    }

    public function hapus_aplikasi($id){

        $this->db->query("DELETE FROM ebanking_aplikasi WHERE id='$id'");
        $this->session->set_flashdata('flash', 'Berhasil Delete Daftar Aplikasi');
        redirect('skenario/aplikasi_ebanking');

    }

    public function shopper_ebanking(){
        $id_user = $this->session->userdata('id_user');
        $data['judul'] = 'Daftar Shopper E-Banking';
        
        $data['shopper'] = $this->Skenario_model->shopper_ebanking();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('skenario/shopper_ebanking', $data);
        $this->load->view('templates/footer');
    }

    public function add_shopper(){
        $hp = $this->input->post('no_hp');
        $nama = $this->input->post('nama');
        $get = str_replace(" ", "", $nama);
        $one = substr($get, 0, 4);
        $two = substr($hp, -4, 4);

        $us_id = strtolower($one.$two);

        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
        $pass = substr(str_shuffle($permitted_chars), 0, 8);

        $email = $this->input->post('email');

        $data = ['nama' => $this->input->post('nama'),
                'jk' => $this->input->post('jk'),
                'no_hp' => $this->input->post('no_hp'),
                'email' => $this->input->post('email'),
                'tanggal_mulai' => $this->input->post('tgl_mulai'),
                'tanggal_selesai' => $this->input->post('tgl_selesai'),
                'user_id' => $us_id,
                'password' => $pass

                ];

        $this->db->insert('ebanking_shopper', $data);
        $config = [
                        'protocol' => 'smtp',
                      'smtp_host' => '192.168.8.3',
                      'smtp_port' => 25,
                      'smtp_user' => 'admin.web@mri-research-ind.com',
                      'smtp_pass' => 'w3bminMRI',
                      'smtp_timeout' => '30',
                      'crlf' => "\r\n",
                        'newline' => "\r\n"

                    ];

             $link  .= "<a href='" . base_url('').  "' >Operation 2</a>";

            $this->load->library('email', $config);
            $this->email->initialize($config);

            $this->email->from('admin.web@mri-research-ind.com', 'MRI-Operation2 WebAdmin');
            $this->email->to($email);
            $this->email->subject('Operation 2 - Account Application Operation');
            $this->email->message('
                Anda telah di daftarkan sebagai shopper E-Banking, dengan akses sebagai berikut :
                <br> Nama : '.$nama.'
                <br> User ID : '.$us_id.'
                <br> Password : '.$pass.'

                <br>
                <br>
                Link Aplikasi : '.$link.'
                    ');

            $this->email->set_mailtype('html');
            $this->email->send();

        $this->session->set_flashdata('flash', 'Berhasil Menambahkan Daftar Aplikasi E-Banking');
         redirect('skenario/shopper_ebanking');
    }

     public function edit_shopper(){
        $id = $this->input->post('id');
        
        $data = ['nama' => $this->input->post('nama'),
                'jk' => $this->input->post('jk'),
                'no_hp' => $this->input->post('no_hp'),
                'email' => $this->input->post('email'),
                'tanggal_mulai' => $this->input->post('tgl_mulai'),
                'tanggal_selesai' => $this->input->post('tgl_selesai'),
                'user_id' => $this->input->post('user_id'),
                'password' => $this->input->post('password'),

                ];
        var_dump($data);

        $this->db->where('id', $id);
        $this->db->update('ebanking_shopper', $data);
        $this->session->set_flashdata('flash', 'Berhasil Edit Daftar Shopper');
         redirect('skenario/shopper_ebanking');
    }

    public function hapus_shopper($id){

        $this->db->query("DELETE FROM ebanking_shopper WHERE id='$id'");
        $this->session->set_flashdata('flash', 'Berhasil Delete Daftar Shopper');
        redirect('skenario/shopper_ebanking');

    }

    public function hapusskenario($id, $id2){
        $this->Skenario_model->hapusskenario($id, $id2);

        $this->session->set_flashdata('info', '<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Data Skenario telah <strong>dihapus!</strong>.
              </div>');

        redirect('skenario');
    }


    public function tambahkunjungan(){
        $jumlahskenario = $this->input->post('jumlahskenario', true);
        $this->Skenario_model->tambahkunjungan($jumlahskenario);
    }

    public function hapusshpkunjungan($id){
        $this->Skenario_model->hapusshpkunjungan($id);

        $this->session->set_flashdata('info', '<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Skenario Kunjungan telah <strong>dihapus!</strong>.
                </div>');

                redirect('skenario/shp');
            }

    public function tambah_ebanking(){
        $jumlahskenario = $this->input->post('jumlahskenario_ebanking', true);
        $this->Skenario_model->tambah_ebanking($jumlahskenario);
    }

    public function delete_ebanking()
    {
      $num = $this->input->post('ebanking');

      var_dump($num);
      foreach ($num as $row => $val) {
        $this->db->query("DELETE FROM ebanking WHERE num='$val'");
      }

      $this->session->set_flashdata('flash', 'Berhasil Delete Skenaro E-Banking');
      redirect('skenario/ebanking');
    }

    public function shp(){
        $data['judul'] = 'Daftar SHP Kunjungan';
        $data['aktual'] = $this->Skenario_model->getallprojectskenario();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('skenario/shpkunjungan', $data);
        $this->load->view('templates/footer');
    }

    function shptest($id){
      $id_user = $id;
      // $id_user = 15100488; //NON ATMCENTER
      // $id_users = 145968; //ATM CENTER
      $id_users = 12269; //ATM CENTER
      // $dataaw = $this->db->query("SELECT
      //                             a.num,
      //                             a.tanggal,
      //                             a.nomorstkb,
      //                             d.nama AS nama_cabang,
      //                             a.pwt,
      //                             h.nama as nama_pwt,
      //                             a.shp,
      //                             b.Nama,
      //                             c.nama AS nama_project,
      //                             e.nama AS r_kategori,
      //                             f.nama AS skenario
      //                         FROM
      //                             quest a
      //                             JOIN id_data b ON a.shp = b.Id
      //                             LEFT JOIN id_data h ON a.pwt = h.Id
      //                             JOIN project c ON a.project = c.kode
      //                             LEFT JOIN cabang d ON a.cabang = d.kode AND a.project = d.project
      //                             JOIN plan g ON a.project = g.project AND a.cabang = g.kode AND a.nomorstkb = g.nomorstkb
      //                             JOIN attribute e ON a.r_kategori = e.kode
      //                             JOIN attribute f ON a.kunjungan = f.kode
      //                         WHERE
      //                             g.kareg = '$id_users'
      //                             AND NOT a.rekaman_status = '3'
      //                         GROUP BY
      //                         a.project,
      //                       a.cabang,
      //                       a.kunjungan")->result_array();

    $data = $this->db->query("SELECT b.project,
                              c.nama as nama_project,
                              b.nomorstkb,
                              b.kunjungan as r_kategori,
                              d.nama as skenario,
                              a.namacabang as nama_cabang,
                              a.shp_weekend_siang, a.tgl_weekend_siang,
                              a.shp_weekend_malam, a.tgl_weekend_malam,
                              a.shp_weekday_siang, a.tgl_weekday_siang,
                              a.shp_weekday_malam, a.tgl_weekday_malam,
                              e.shp, f.Nama, e.tanggal,
                              e.pwt, g.Nama as nama_pwt
                              FROM
                                  plan b
                                  LEFT JOIN atmcenter a ON a.project = b.project AND a.cabang = b.kode
                                  AND (a.shp_weekend_siang IS NOT NULL OR a.shp_weekend_malam IS NOT NULL OR a.shp_weekday_siang IS NOT NULL OR a.shp_weekday_malam IS NOT NULL)
                                  AND ((a.status_weekend_siang >= 0 AND a.status_weekend_siang < 3)
                                  OR (a.status_weekend_malam >= 0 AND a.status_weekend_malam < 3)
                                  OR (a.status_weekday_siang >= 0 AND a.status_weekday_siang < 3)
                                  OR (a.status_weekday_malam >= 0 AND a.status_weekday_malam < 3))
                                  LEFT JOIN cabang c2 ON b.kode = c2.kode AND b.project = c2.project
                                  LEFT JOIN quest e ON b.project = e.project AND b.kode = e.cabang AND e.status < 3
                                  JOIN project c ON e.project = c.kode OR a.project = c.kode
                                  LEFT JOIN attribute e2 ON e.r_kategori = e2.kode
                                  JOIN attribute d ON b.kunjungan = d.kode
                                  LEFT JOIN id_data f ON e.shp = f.Id
                                  LEFT JOIN id_data g ON e.pwt = g.Id
                              WHERE
                                b.kareg = '$id_user' AND
                                ((a.shp_weekend_siang IS NOT NULL OR a.shp_weekend_malam IS NOT NULL OR a.shp_weekday_siang IS NOT NULL OR a.shp_weekday_malam IS NOT NULL
                                AND ((a.status_weekend_siang >= 0 AND a.status_weekend_siang < 3) OR (a.status_weekend_malam >= 0 AND a.status_weekend_malam < 3)
                                      OR (a.status_weekday_siang >= 0 AND a.status_weekday_siang < 3)
                                      OR (a.status_weekday_malam >= 0 AND a.status_weekday_malam < 3))
                                ) OR (e.shp IS NOT NULL AND NOT e.rekaman_status = 3))
                              GROUP BY
                                b.kunjungan
                              ORDER BY b.nomorstkb DESC
                            ")->result_array();

       echo json_encode($data);
    }

    function shptest2(){
      $id = $this->session->userdata('id_user');

      $data = $this->db->query("SELECT
                                  a.kareg,
                                  a.spv,
                                  c.nama,
                                  a.nomorstkb,
                                  a.project,
                                  b.nama AS nama_project,
                                  a.planstart,
                                  a.planend,
                                  a.kota,
                                  a.kode,
                                  IF(d.nama IS NOT NULL, d.nama, z.namacabang) AS cabang,
                                  z.shp_weekend_siang,
                                  z.shp_weekend_malam,
                                  z.shp_weekday_siang,
                                  z.shp_weekday_malam,
                                  e.kategori AS kunjungan,
                                  GROUP_CONCAT( f.nama SEPARATOR ' - ' ) AS skenario
                              FROM
                                  plan a
                                  JOIN project b ON a.project = b.kode AND b.visible = 'y' AND b.type = 'n'
                                  JOIN id_data c ON a.kareg = c.Id
                                  LEFT JOIN cabang d ON d.kode = a.kode AND a.project = d.project
                                  LEFT JOIN atmcenter z ON a.project = z.project AND a.kode = z.cabang
                                  -- AND ((a.kode = z.cabang AND a.kunjungan = z.weekend_siang AND z.shp_weekend_siang IS NULL) OR (a.kode = z.cabang AND a.kunjungan = z.weekend_malam AND z.shp_weekend_malam IS NULL)
                                  --       OR (a.kode = z.cabang AND a.kunjungan = z.weekday_siang AND z.shp_weekday_siang IS NULL) OR (a.kode = z.cabang AND a.kunjungan = z.weekday_malam AND z.shp_weekday_malam IS NULL))
                                  JOIN skenario e ON a.project = e.project AND a.kunjungan = e.kategori
                                  JOIN attribute f ON e.att = f.kode
                              WHERE
                                  a.kareg = '$id'
                                  AND a.planstart >= '2019-11-25'
                                  AND NOT EXISTS (
                                  SELECT
                                      g.num
                                  FROM
                                      quest g
                                  WHERE
                                      a.project = g.project
                                      AND e.att = g.kunjungan
                                      AND a.kode = g.cabang
                                  )


                                  -- OR ((z.weekend_siang = a.kunjungan AND z.shp_weekend_siang IS NULL) OR (z.weekend_malam = a.kunjungan AND z.shp_weekend_malam IS NULL)
                                  --      OR (z.weekday_siang = a.kunjungan AND z.shp_weekday_siang IS NULL) OR (z.weekday_malam = a.kunjungan AND z.shp_weekday_malam IS NULL))
                                  -- NOT EXISTS (
                                  -- SELECT
                                  --     ac.num
                                  -- FROM
                                  --     atmcenter ac
                                  -- WHERE
                                  --     a.project = ac.project
                                  --     AND a.kode = ac.cabang
                                  --     AND (a.kunjungan = ac.weekend_siang OR a.kunjungan = ac.weekend_malam OR a.kunjungan = ac.weekday_siang OR a.kunjungan = ac.weekday_malam)
                                  --     AND (ac.weekend_siang IS NULL OR ac.weekend_malam IS NULL OR ac.weekday_siang IS NULL OR ac.weekday_malam IS NULL)
                                  --     AND (ac.shp_weekend_siang IS NULL OR ac.shp_weekend_malam IS NULL OR ac.shp_weekday_siang IS NULL OR ac.shp_weekday_malam IS NULL)
                                  -- )
                                   -- OR (z.project = a.project AND (z.shp_weekend_siang IS NOT NULL OR z.shp_weekend_malam IS NOT NULL OR z.shp_weekday_siang IS NOT NULL OR z.shp_weekday_malam IS NOT NULL))

                                  -- AND EXISTS (
                                  -- SELECT
                                  --     h.total_nilai
                                  -- FROM
                                  --     data_nilai h
                                  -- WHERE
                                  --     h.kode_project = a.project
                                  --     AND h.kunjungan = a.kunjungan
                                  --     AND h.id_user = '$id'
                                  --     AND h.total_nilai = '100'
                                  -- )
                              GROUP BY
                                  a.project,
                                  a.kode,
                                  a.kunjungan
                              ORDER BY
                                  a.kode ASC,
                                  a.kunjungan ASC,
                                  e.numrow ASC,
                                  a.planend ASC")->result_array();
      echo json_encode($data);
    }


    public function tambahkunjunganshp(){
        $data['judul'] = 'Tambah Kunjungan SHP';
        $data['data_plan'] = $this->Skenario_model->getAllDataSkenarioKunjungan();
        $data['data_shp'] = $this->Skenario_model->getshopper();
        $this->form_validation->set_rules('check[]', 'check[]',  'required');
        $this->form_validation->set_rules('datekunj', 'Tanggal Kunjungan', 'required');
        $this->form_validation->set_rules('shp', 'Nama Shopper', 'required');

        if($this->form_validation->run() == false){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('skenario/tambahshpkunjungan', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Skenario_model->tambahshpkunjungan();

            $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                SHP Kunjungan telah <strong>ditambahkan!</strong>.
                </div>');

            redirect('skenario/shp');
        }

    }

    public function getskennotinquest(){
        $kunj = $_POST['kunj'];
        $cbg = $_POST['cbg'];
        $pro = $_POST['pro'];
        $data = $this->Skenario_model->getskennotinquest($kunj, $cbg, $pro);
        echo json_encode($data);
    }

    public function projectkunjungan(){
        $id = $_POST['jenis'];
        $this->db->distinct();
        $this->db->select('kunjungan');
        $this->db->from('data_project_cabang');
        $this->db->where('kode_project', $id);
        $this->db->order_by('kunjungan');
        $data = $this->db->get()->result_array();

		echo json_encode($data);
    }

    public function projectcabang(){
        $id = $_POST['cbg'];
        $this->db->distinct();
        $this->db->select('nama,kode');
        $this->db->from('data_project_cabang');
        $this->db->where('kode_project', $id);
        $data = $this->db->get()->result_array();
		echo json_encode($data);
    }

    public function kesinibang(){
        var_dump($this->input->post('check'));
        echo implode(" ",$this->input->post('check'));
    }

    public function perpanjangkunjungan(){
        $id_user = $this->session->userdata('id_user');
        $data['project'] = $this->Skenario_model->getDataProjectSkenario($id_user);
        $data['judul'] = 'Perpanjang Kunjungan';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('skenario/perpanjangkunjungan', $data);
        $this->load->view('templates/footer');
    }

    public function prosesperpanjangkunjungan(){
      $id_user = $this->session->userdata('id_user');
      $id = $this->input->post('id', true);
      $tgl = $this->input->post('tgl', true);
      $get = $this->db->query("SELECT planend, project, kode, kunjungan, nomorstkb FROM plan WHERE no = '$id'")->row_array();
      $skenario = $this->db->get_where('skenario', array('project' => $get['project'], 'att' => $get['kunjungan'] ))->row_array();
      $row_skenario = $this->db->get_where('skenario', array('project' => $get['project'], 'kategori' => $skenario['kategori'] ))->result_array();

    foreach ($row_skenario as $rk) {
        $cek = $this->db->get_where('plan', array('project' => $get['project'], 'kode' => $get['kode'], 'kunjungan' => $rk['att'], 'nomorstkb' => $get['nomorstkb']))->row_array();

      $this->db->where('no', $cek['no']);
      $update = $this->db->update('plan', array('planend' => $tgl, 'planend_old' => $cek['planend'], 'user_perpanjang' => $id_user));
    }
      echo json_encode($update);
    }

    public function testaja(){
      $id = $this->session->userdata('id_user');
      $project = $this->db->query("SELECT kode FROM project WHERE id_user = '$id' AND visible = 'y'")->result_array();
      $data = array();
      $startDate = date('Y-m-d',strtotime("-1 month"));
      $endDate   = date('Y-m-d',strtotime("now"));
      //var_dump($project);
      foreach ($project as $project) {
        //CEK ATM ATAU BUKAN
        $db2 = $this->load->database('database_kedua', TRUE);
        $arrayatm = array('064','065','066','067');
        $db2->select('att');
        $db2->from('skenario');
        $db2->where('project', $project['kode']);
        $db2->where_in('att', $arrayatm);
        $atmBukan = $db2->get()->result_array();
        if($atmBukan){
          echo 'ATM <BR>';
          $this->db->select('
          project.nama as projectnama,
          plan.no, plan.planstart, plan.planend, plan.project as kodeproject,
          atmcenter.cabang as kodecabang, atmcenter.namacabang as namacabang,
          attribute.kode as kodekunjungan, attribute.nama as namaatt');
          $this->db->from('plan');
    		  $this->db->join('project','project.kode=plan.project');
    		  $this->db->join('atmcenter','atmcenter.cabang=plan.kode and atmcenter.project=plan.project');
    		  $this->db->join('attribute','attribute.kode=plan.kunjungan');
          $this->db->where('plan.project', $project['kode']);
          $this->db->where('plan.planend >=', $startDate);
          $query = $this->db->get();
          if($query->num_rows()){
            $data[] = $query->result_array();
          }
        }else{
          print_r($atmBukan);
          echo 'BUKAN ATM <BR>';
          $this->db->select('
          project.nama as projectnama,
          plan.no, plan.planstart, plan.planend, plan.project as kodeproject,
          cabang.kode as kodecabang, cabang.nama as namacabang,
          attribute.kode as kodekunjungan, attribute.nama as namaatt');
          $this->db->from('plan');
    		  $this->db->join('project','project.kode=plan.project');
    		  $this->db->join('cabang','cabang.kode=plan.kode and cabang.project=plan.project');
    		  $this->db->join('attribute','attribute.kode=plan.kunjungan');
          $this->db->where('plan.project', $project['kode']);
          $this->db->where('plan.planend >=', $startDate);
          $query = $this->db->get();
          if($query->num_rows()){
            $data[] = $query->result_array();
          }
        }

      }
      echo '<br>';
      //var_dump($data);


      //$this->db->select('project.nama as namaproject, plan.project as kode, cabang.nama, attribute.nama as att');
      $this->db->select('*');
      $this->db->from('plan');
      $this->db->join('project','project.kode=plan.project');
      //$this->db->join('cabang','cabang.kode=plan.kode and cabang.project=plan.project');
      //$this->db->join('attribute','attribute.kode=plan.kunjungan');
      $this->db->where('project.visible', 'y');
      $this->db->where('plan.planend >=', $startDate);
      $query = $this->db->get()->result_array();
      $no = 1;
      foreach ($query as $key => $value) {
        //echo $value['kode'].' - '.$value['namaproject'].' - '.$value['nama'].' - '.$value['att'];
        echo $no.' - '.$value['project'].' - '.$value['nama'];
        echo '<br>';
        $no++;
      }
      //var_dump($query);

    }

    function testaja2(){
      $id = $this->session->userdata('id_user');
      $startDate = date('Y-m-d',strtotime("-1 month")); // Tanggal 1 bulan kebelakang
      $endDate   = date('Y-m-d',strtotime("now")); // Tanggal hari ini
      /*$this->db->select('project.nama as projectnama, project.kode as kodeproject, plan.*');
      $this->db->from('plan');
      $this->db->join('project','project.kode=plan.project');
      $this->db->where('project.visible', 'y');
      $this->db->where('plan.planend >=', $startDate);
      $query = $this->db->get();
      $data[] = $query->result_array();
      return $data;*/
      $kodeProject = $this->db->query("SELECT kode FROM project WHERE id_user = '$id' AND visible = 'y'")->result_array();
      $data = array();
      foreach ($kodeProject as $project) {
        //CEK ATM ATAU BUKAN
        $db2 = $this->load->database('database_kedua', TRUE);
        $arrayatm = array('064','065','066','067');
        $db2->select('att');
        $db2->from('skenario');
        $db2->where('project', $project['kode']);
        $db2->where_in('att', $arrayatm);
        $atmBukan = $db2->get()->result_array();
        if($atmBukan){
          $this->db->select('
          project.nama as projectnama,
          plan.no, plan.planstart, plan.planend, plan.project as kodeproject,
          atmcenter.cabang as kodecabang, atmcenter.namacabang as namacabang,
          attribute.kode as kodekunjungan, attribute.nama as namaatt');
          $this->db->from('plan');
    		  $this->db->join('project','project.kode=plan.project');
    		  $this->db->join('atmcenter','atmcenter.cabang=plan.kode and atmcenter.project=plan.project');
    		  $this->db->join('attribute','attribute.kode=plan.kunjungan');
          //$this->db->where('plan.project', $project['kode']);
          $this->db->where("str_to_date(plan.planend,'%Y-%m-%d') BETWEEN str_to_date('$startDate','%Y-%m-%d') AND str_to_date('$endDate','%Y-%m-%d')");
          $query = $this->db->get();
          if($query->num_rows()){
            $data[] = $query->result_array();
          }
        }else{
          $this->db->select('
          project.nama as projectnama,
          plan.no, plan.planstart, plan.planend, plan.project as kodeproject,
          cabang.kode as kodecabang, cabang.nama as namacabang,
          attribute.kode as kodekunjungan, attribute.nama as namaatt');
          $this->db->from('plan');
    		  $this->db->join('project','project.kode=plan.project');
    		  $this->db->join('cabang','cabang.kode=plan.kode and cabang.project=plan.project');
    		  $this->db->join('attribute','attribute.kode=plan.kunjungan');
          //$this->db->where('plan.project', $project['kode']);
          $this->db->where("str_to_date(plan.planend,'%Y-%m-%d') BETWEEN str_to_date('$startDate','%Y-%m-%d') AND str_to_date('$endDate','%Y-%m-%d')");
          $query = $this->db->get();
          if($query->num_rows()){
            $data[] = $query->result_array();
          }
        }

      }
      var_dump($data);
    }

    function testaja3(){
      $startDate = date('Y-m-d',strtotime("-1 month")); // Tanggal 1 bulan kebelakang
      $endDate   = date('Y-m-d',strtotime("now")); // Tanggal hari ini
      $this->db->select('project.nama as projectnama, project.kode as kodeproject, plan.*');
      $this->db->from('plan');
      $this->db->join('project','project.kode=plan.project');
      $this->db->where('project.visible', 'y');
      $this->db->where("plan.planend BETWEEN str_to_date({$startDate},'%Y-%m-%d') AND str_to_date({$endDate},'%Y-%m-%d')");
      $query = $this->db->query("SELECT project.nama as projectnama, project.kode as kodeproject, plan.* FROM plan JOIN project WHERE project.kode=plan.project AND project.visible = 'y' AND str_to_date(plan.planend,'%Y-%m-%d') BETWEEN str_to_date('$startDate','%Y-%m-%d') AND str_to_date('$endDate','%Y-%m-%d')")->result_array();
      //$this->db->where('plan.planend >=', $startDate);
      //$query = $this->db->get();
      $data[] = $query;//->result_array();

      var_dump($data);
    }



}
