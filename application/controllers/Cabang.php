<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cabang extends CI_Controller {

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

        $this->load->model('Cabang_model');
        $this->load->model('Skenario_model');
        $this->load->library('form_validation');

    }

    public function index(){
    $id_user = $this->session->userdata('id_user');
    $data['judul'] = "Cabang Bank";
    $data['cabang'] = $this->Cabang_model->getAllData($id_user);
    $data['atmcenter'] = $this->Cabang_model->getAtmcenter();
    
    
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
        $this->load->view('cabang/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_cabang()
    {
       $this->Cabang_model->tambah_cabang();
        $this->session->set_flashdata('flash', 'Berhasil Menambahkan Cabang');
        redirect("cabang");


    }

    public function tambah_atmcenter()
    {
       $this->Cabang_model->tambah_atmcenter();
        $this->session->set_flashdata('flash', 'Berhasil Menambahkan Cabang');
        redirect("cabang");
    }

    public function tambah_cabang_csv()
    {
         if(isset($_FILES["csv_cabang"]["name"])){
                  // upload
                $file_tmp = $_FILES['csv_cabang']['tmp_name'];
                $file_name = $_FILES['csv_cabang']['name'];
                $file_size =$_FILES['csv_cabang']['size'];
                $file_type=$_FILES['csv_cabang']['type'];
                // move_uploaded_file($file_tmp,"uploads/".$file_name); // simpan filenya di folder uploads

                $project = $this->input->post('project');
                
                $object = PHPExcel_IOFactory::load($file_tmp);
        
                foreach($object->getWorksheetIterator() as $worksheet){
        
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
        
                    for($row=2; $row<=$highestRow; $row++){
        
                        // $project = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $kode = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $nama = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $alamat = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $kota = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $provinsi = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $kodepos = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $notelpon = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $fax = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        $kodebank = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                    $cek = strlen($kode);

                    if ($cek == 1) {
                        $kd_cabang = "00".$kode;
                    } else if ($cek == 2) {
                        $kd_cabang = "0".$kode;
                    } else {
                        $kd_cabang = $kode;
                    }


                    $nama2 = str_replace("\n", " ", $nama);
                    $alamat2 = str_replace("\n", " ", $alamat);
                    $kota2 = str_replace("\n", " ", $kota);
                    $provinsi2 = str_replace("\n", " ", $provinsi);

                     if ($project != NULL OR $project != '') {
                       
                        $data[] = array(
                            'project' => strtoupper($project),
                            'kode' => $kd_cabang,
                            'nama' => $nama2,
                            'alamat' => $alamat2,
                            'kota' => ucwords(strtolower($kota2)),
                            'provinsi' => $provinsi2,
                            'kodepos' => $kodepos,
                            'notelpon' => $notelpon,
                            'fax' => $fax,
                            'kodebank' => $kodebank
                        );
                      }
        
                    } 
        
                }
        
                $this->db->insert_batch('cabang', $data);

        
                $this->session->set_flashdata('flash', 'Berhasil Menambahkan Cabang');
                redirect("cabang");
             }
            else
            {
                 ?>
                  <script> window.alert ('Import File Gagal, Coba Lagi!');
                          window.location = '<?php echo site_url('cabang') ?>';
                 </script>;
                    <?php
            }
    }

      public function tambah_atmcenter_csv()
    {
         if(isset($_FILES["csv_atm"]["name"])){
                  // upload
                $file_tmp = $_FILES['csv_atm']['tmp_name'];
                $file_name = $_FILES['csv_atm']['name'];
                $file_size =$_FILES['csv_atm']['size'];
                $file_type=$_FILES['csv_atm']['type'];
                // move_uploaded_file($file_tmp,"uploads/".$file_name); // simpan filenya di folder uploads

                 $project = $this->input->post('project');
                
                $object = PHPExcel_IOFactory::load($file_tmp);
        
                foreach($object->getWorksheetIterator() as $worksheet){
        
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
        
                    for($row=2; $row<=$highestRow; $row++){
        
                        // $project = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $kode = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $nama = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $kota = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $alamat = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $kodebank = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                  
                    $cek = strlen($kode);

                    if ($cek == 1) {
                        $kd_cabang = "00".$kode;
                    } else if ($cek == 2) {
                        $kd_cabang = "0".$kode;
                    } else {
                        $kd_cabang = $kode;
                    }

                    $nama2 = str_replace("\n", " ", $nama);
                    $alamat2 = str_replace("\n", " ", $alamat);
                    $kota2 = str_replace("\n", " ", $kota);

                    if ($project != NULL OR $project != '') {

                        $data[] = array(
                            'project' => strtoupper($project),
                            'cabang' => $kd_cabang,
                            'namacabang' => $nama2,
                            'alamat' => $alamat2,
                            'kota' => ucwords(strtolower($kota2)),
                            'kodebank' => $kodebank
                        );
                    }
        
                    } 
        
                }
        
                $this->db->insert_batch('atmcenter', $data);
        
                $this->session->set_flashdata('flash', 'Berhasil Menambahkan Cabang');
                redirect("cabang");
                // var_dump($data);
             }
            else
            {
                 ?>
                  <script> window.alert ('Import File Gagal, Coba Lagi!');
                          window.location = '<?php echo site_url('cabang') ?>';
                 </script>;
                    <?php
            }
    }

    public function uploadtemplate_nonatm()
    {
        $extension_format  = pathinfo($_FILES['file_nonatm']['name'], PATHINFO_EXTENSION);
        $format_name = "format_excel_cabangnonatm_" . time() . "." . $extension_format;
        $format_tmp = $_FILES['file_nonatm']['tmp_name'];
        move_uploaded_file($format_tmp, "assets/file/cabang/" . $format_name);

        $data_format = [
                        'jenis' => $this->input->post('jenis'),
                        'nama_file' => $format_name
                    ];
        $this->db->insert('format_file', $data_format);

        $this->session->set_flashdata('flash', 'Berhasil Upload Template File');
        redirect('cabang');
    }

    public function uploadtemplate_atm()
    {
        $extension_format  = pathinfo($_FILES['file_atm']['name'], PATHINFO_EXTENSION);
        $format_name = "format_excel_cabangatm_" . time() . "." . $extension_format;
        $format_tmp = $_FILES['file_atm']['tmp_name'];
        move_uploaded_file($format_tmp, "assets/file/cabang/" . $format_name);

        $data_format = [
                        'jenis' => $this->input->post('jenis'),
                        'nama_file' => $format_name
                    ];
        $this->db->insert('format_file', $data_format);

        $this->session->set_flashdata('flash', 'Berhasil Upload Template File');
        redirect('cabang');
    }

    public function getdata_bank()
    {
        $kode = $_POST['kode'];
        $sdm = $this->db->query("SELECT * FROM project WHERE kode = '$kode'")->row_array();
        echo json_encode($sdm);;
    }

    public function tambah(){
        $id_user = $this->session->userdata('id_user');
        $data['project'] = $this->Skenario_model->getprojects($id_user);
        $data['judul'] = "Form Tambah Cabang";
        $this->form_validation->set_rules('nama', 'Nama Cabang', 'required');
        $this->form_validation->set_rules('kode', 'Kode Cabang', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat Cabang', 'required');

        if($this->form_validation->run()==false){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('cabang/tambah', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Cabang_model->tambah();

            $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Cabang baru telah <strong>ditambahkan!</strong>.
              </div>');

            redirect('cabang');
        }
    }

    public function ubah($id){
        $data['judul'] = "Form Ubah Cabang";
        $data['cabang'] = $this->Cabang_model->getDataById($id);
        $this->form_validation->set_rules('nama', 'Nama Cabang', 'required');
        $this->form_validation->set_rules('kode', 'Kode Cabang', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat Cabang', 'required');

        if($this->form_validation->run()==false){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('cabang/ubah', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Cabang_model->ubah($id);

            $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Cabang telah berhasil <strong>diubah!</strong>.
              </div>');

            redirect('cabang');
        }
    }

    public function hapus($id){
        $this->Cabang_model->hapus($id);

        $this->session->set_flashdata('info', '<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Cabang telah <strong>dihapus!</strong>.
              </div>');

            redirect('cabang');
    }

public function getcabang_edit()
  {
    $num = $_POST['num'];
    $data = $this->Cabang_model->getcabang_edit($num);
    echo json_encode($data);
  }

  public function getcabangatm_edit()
  {
    $num = $_POST['num'];
    $data = $this->Cabang_model->getcabangatm_edit($num);
    echo json_encode($data);
  }

  public function edit_cabang()
    {
       
       $this->Cabang_model->edit_cabang();
       $this->session->set_flashdata('flash', 'Berhasil Edit Cabang');
        redirect("cabang");


    }

    public function hapus_cabang($num)
    {
       
        $this->Cabang_model->hapus_cabang($num);
        $this->session->set_flashdata('flash', 'Berhasil Hapus Cabang');
        redirect("cabang");


    }

    public function edit_cabangatm()
    {
       
       $this->Cabang_model->edit_cabangatm();
        $this->session->set_flashdata('flash', 'Berhasil Edit Cabang');
        redirect("cabang");
    }

    public function hapus_atm($num)
    {
       
        $this->Cabang_model->hapus_atm($num);
        $this->session->set_flashdata('flash', 'Berhasil Hapus Cabang ATM Center');
        redirect("cabang");
    }


}