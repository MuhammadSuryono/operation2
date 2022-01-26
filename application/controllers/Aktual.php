<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aktual extends CI_Controller
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

        }

        $this->load->model('Aktual_model');
        $this->load->model('Project_model');
        $this->load->model('Token_model');
        $this->load->library('form_validation');
    }


    function get_ajax() {
        $list = $this->Aktual_model->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = $item->nama_project;
            $row[] = $item->nama_bank;
            $row[] = $item->channel;
            $row[] = $item->nama_transaksi;
            $row[] = $item->os;
            $row[] = $item->provider;
            $row[] = $item->hari." - ". $item->waktu;

            $row[] = $item->tanggal_evaluasi;
            // add html for action
            $row[] = '<center><a href="'.base_url('aktual/ebanking_aktuallist/'.$item->num).'" class="btn btn-warning btn-round btn-xs" style="margin-right : 0.5rem; margin-top:0.5rem;">Aktual!</a></center>';
            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->Aktual_model->count_all(),
                    "recordsFiltered" => $this->Aktual_model->count_filtered(),
                    "data" => $data,
                );
        // output to json format
        echo json_encode($output);
    }



    function get_ajax_sosmed() {
        $list = $this->Aktual_model->get_datatables_sosmed();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = $item->nama_project;
            $row[] = $item->nama_bank;
            $row[] = $item->platform;
            $row[] = $item->nama_skenario;
            $row[] = $item->hari." - ". $item->waktu;

            $row[] = $item->tanggal_evaluasi;
            // add html for action
            $row[] = '<center><a href="'.base_url('aktual/sosmed_aktuallist/'.$item->num).'" class="btn btn-warning btn-round btn-xs" style="margin-right : 0.5rem; margin-top:0.5rem;">Aktual!</a></center>';
            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->Aktual_model->count_all_sosmed(),
                    "recordsFiltered" => $this->Aktual_model->count_filtered_sosmed(),
                    "data" => $data,
                );
        // output to json format
        echo json_encode($output);
    }


    public function pending()
    {
        $data['judul'] = 'Daftar Aktual Pending';
        // MRI_OPERTAION8
        // $data['skenario'] = $this->Aktual_model->getSkenario();
        // $data['aktual'] = $this->Aktual_model->getAktual();
        // AKHIR
        // var_dump($data['aktual']); die;

        // KERJA BAKTI
        // $data['skenario'] = $this->Aktual_model->getSkenarioKB();
        $data['aktual'] = $this->Aktual_model->getAktualKB();
        // var_dump($data['aktual']); die;
        // AKHIR

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('aktual/pendingKB', $data);
        $this->load->view('templates/footer');
    }

    public function assign($id, $project, $cabang)
    {
        $data['judul'] = 'Aktual Kunjungan';
        $data['project'] = $this->Project_model->getProjectById($project);
        $data['skenario'] = $this->Aktual_model->getSkenarioByIdKB($id, $project, $cabang);
        $this->form_validation->set_rules('lang', 'Latitude', 'required');
        $this->form_validation->set_rules('long', 'Longitude', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('aktual/assignKB', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Aktual_model->updateAktualKB();

            $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Data Aktual telah <strong>diubah!</strong>.
                </div>');

            redirect('aktual/pending');
        }
    }

    public function assign2($id, $project, $cabang)
    {
        $data['judul'] = 'Aktual Kunjungan';
        $data['project'] = $this->Project_model->getProjectById($project);
        $data['skenario'] = $this->Aktual_model->getSkenarioByIdKB($id, $project, $cabang);
        $this->form_validation->set_rules('lang', 'Latitude', 'required');
        $this->form_validation->set_rules('long', 'Longitude', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('aktual/assign2', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Aktual_model->updateAktualKB2();

            $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Data Aktual telah <strong>diubah!</strong>.
                </div>');

            redirect('aktual/pending');
        }
    }

    public function tambahassign()
    {
        // $this->Aktual_model->updateAktual();
        $this->Aktual_model->updateAktualKB2();

        $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Data Aktual telah <strong>diubah!</strong>.
                </div>');

        redirect('aktual/pending');
    }

    public function historykunjungan()
    {
     $data['judul'] = 'Daftar History Kunjungan';
      
     $data['project'] = $this->Aktual_model->getproject();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('aktual/historykunjungan', $data);
        $this->load->view('templates/footer');   
    }

    public function pengulangan()
    {
     $data['judul'] = 'Daftar Kunjungan Pengulangan';
      
     $data['project'] = $this->Aktual_model->getproject();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('aktual/pengulangan', $data);
        $this->load->view('templates/footer');   
    }

     public function gethistory_aktual()
      {
        $project = $_POST['project'];
        
        $data = $this->Aktual_model->gethistory_aktual($project);
        echo json_encode($data);
      }

      public function getkunjungan_pengulangan()
      {
        $project = $_POST['project'];
        
        $data = $this->Aktual_model->getkunjungan_pengulangan($project);
        echo json_encode($data);
      }

      public function getpenolakan_validasi()
      {
        $project = $_POST['project'];
        
        $data = $this->Aktual_model->getpenolakan_validasi($project);
        echo json_encode($data);
      }

    public function index()
    {
        $data['judul'] = 'Daftar Aktual Success';
        // MRI OPERATION8
        // $data['skenario'] = $this->Aktual_model->getSkenario();
        // $data['aktual'] = $this->Aktual_model->getAktualSuccess();
        // AKHIR

        // KERJA BAKTI
        // $data['skenario'] = $this->Aktual_model->getSkenarioKB();
        $data['aktual'] = $this->Aktual_model->getAktualKB2();
        // $data['aktual'] = $this->Aktual_model->getAktualKB();
        // AKHIR

        // $data['token'] = $this->Token_model->get_id_token('FLR4', '001');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        // $this->load->view('aktual/indexKB', $data); BACKUP
        $this->load->view('aktual/indexKBBARU', $data);
        $this->load->view('templates/footer');
    }

    public function keterlambatan($project, $cabang, $Kunjungan)
    {
        $data['judul'] = 'Form Pengajuan Keterlambatan';

        $data['project'] = $this->db->get_where('project', array('kode' => $project))->row_array();
        $data['kunjungan'] = $this->db->get_where('attribute', array('kode' => $Kunjungan))->row_array();

        $data['quest'] =  $this->db->get_where('quest', array('project' => $project, 'kunjungan' => $Kunjungan, 'cabang' => $cabang))->row_array();

        $data['ra'] = $this->db->get_where('user', array('id_divisi' => 1, 'password !=' => ''))->result_array();
        
        $atmcenter = array('064','065','066','067');

        if (in_array($Kunjungan, $atmcenter)){
        $data['cabang'] = $this->db->get_where('atmcenter', array('project' => $project, 'cabang' => $cabang))->row_array();
        
        } else {
        $data['cabang'] = $this->db->get_where('cabang', array('project' => $project, 'kode' => $cabang))->row_array();
        }
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('aktual/keterlambatan', $data);
        $this->load->view('templates/footer');
    }

    public function input_keterlambatan()
    {
        $extension_format  = pathinfo($_FILES['evidence']['name'], PATHINFO_EXTENSION);
        $format_name = "EvidenceKeterlambatan_" . time() . "." . $extension_format;
        $format_tmp = $_FILES['evidence']['tmp_name'];
        move_uploaded_file($format_tmp, "assets/file/foto_temuan/" . $format_name);

        $pwt = $this->input->post('pwt');
        $project = $this->input->post('project');

        $data = ['num_quest' => $this->input->post('num'),
                'project' => $this->input->post('project'),
                'cabang' => $this->input->post('cabang'),
                'kunjungan' => $this->input->post('kunjungan'),
                'r_kategori' => $this->input->post('r_kategori'),
                'pemohon' => $this->input->post('pemohon'),
                'pj_field' => $this->input->post('pj_field'),
                'pemohon' => $this->input->post('pemohon'),
                'tgl_kunjungan' => $this->input->post('tanggal'),
                'pwt' => $this->input->post('pwt'),
                'alasan' => $this->input->post('alasan'),
                'ra_project' => $this->input->post('ra_project'),
                'tgl_dibuat' => date('Y-m-d H:i:s'),
                'evidence' => $format_name
                ];
        $num = $this->input->post('num');
        $cek = $this->db->get_where('form_keterlambatan', array('num_quest' => $num))->result_array();
        if ($cek == NULL) {
            $banyak = $this->db->get_where('form_keterlambatan', array('pwt' => $pwt, 'project' => $project))->num_rows();

            if ($banyak < 3) {
                
                $this->db->insert('form_keterlambatan', $data);
                $this->session->set_flashdata('flash', 'Berhasil membuat form pengajuan keterlambatan!');
                redirect('aktual/pengajuan_BA');
            } else {
                
                // $this->session->set_flashdata('flash2', 'Gagal membuat form pengajuan keterlambatan, karena Anda sudah mengajukan keterlambatan sebanyak 3 kali!');
                // redirect('aktual/pengajuan_BA');
                 echo '<script>alert("Gagal membuat form pengajuan keterlambatan, karena Anda sudah mengajukan keterlambatan sebanyak 3 kali!");
                    window.location.href="'.base_url('aktual/pengajuan_BA').'";</script>';    
            }
        } else {
            
            // $this->session->set_flashdata('flash2', 'Gagal membuat form pengajuan keterlambatan!');
            // redirect('aktual/pengajuan_BA');
            echo '<script>alert("Gagal membuat form pengajuan keterlambatan!");
                    window.location.href="'.base_url('aktual/pengajuan_BA').'";</script>';

            
        }
    }

    public function berita_acara()
    {
        $data['judul'] = 'Daftar Berita Acara';
        // $data['skenario'] = $this->Aktual_model->getSkenarioKB();
        $data['berita'] = $this->Aktual_model->getBeritaAcara();
        $data['done'] = $this->Aktual_model->getBeritaAcara_Done();
           
     
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        // $this->load->view('aktual/indexKB', $data); BACKUP
        $this->load->view('aktual/berita_acara', $data);
        $this->load->view('templates/footer');
    }

    public function pengajuan_BA()
    {
        $data['judul'] = 'Pengajuan Berita Acara';
        // $data['skenario'] = $this->Aktual_model->getSkenarioKB();
        $data['aktual'] = $this->Aktual_model->getDataRow();
        $data['done'] = $this->Aktual_model->getPengajuan_BA();
           
     
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        // $this->load->view('aktual/indexKB', $data); BACKUP
        $this->load->view('aktual/pengajuan_BA', $data);
        $this->load->view('templates/footer');
    }

    public function mengetahui($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $waktu = date('Y-m-d H:i:s');

        $data = ['mengetahui' => 'Valid', 'tgl_mengetahui' => $waktu];
        $this->db->where('id', $id);
        $this->db->update('form_keterlambatan', $data);

        $this->session->set_flashdata('flash', 'Berhasil validasi form pengajuan keterlambatan!');
        redirect('aktual/berita_acara');

    }

    public function approval_keterlambatan($id)
    {
    date_default_timezone_set('Asia/Jakarta');
        $waktu = date('Y-m-d H:i:s');

        $quest = $this->db->get_where('form_keterlambatan', array('id' => $id))->row_array();
        $num = $quest['num_quest'];
        $RM = $this->db->get_where('user', array('jabatan' => 'RM'))->result_array();

        $test = $this->db->query("SELECT * FROM quest a JOIN plan b ON a.project=b.project AND a.nomorstkb=b.nomorstkb WHERE a.num='$num'")->row_array();
        $PJ = $this->db->get_where('user', array('noid' => $test['penanggung_jawab_field']))->result_array();

        $head = array_merge($RM, $PJ);


        $dataForm = $this->db->query("SELECT
                                    a.*,
                                    b.nama AS nama_project,
                                    c.nama AS nama_cabang,
                                    d.nama AS nama_kunjungan,
                                    e.nama AS pemohon,
                                    f.name AS pemohon2,
                                    g.name AS nama_pj_field,
                                    h.name AS nama_ra,
                                    i.Nama AS nama_pwt
                                FROM
                                    form_keterlambatan a
                                    JOIN project b ON a.project=b.kode
                                    JOIN cabang c ON a.cabang=c.kode AND a.project=c.project
                                    JOIN attribute d ON a.kunjungan=d.kode
                                    LEFT JOIN user f ON a.pemohon=f.noid
                                    LEFT JOIN id_data e ON a.pemohon=e.id
                                    LEFT JOIN user g ON a.pj_field=g.noid
                                    LEFT JOIN user h ON a.ra_project=h.noid
                                    LEFT JOIN id_data i ON a.pwt=i.Id
                                WHERE
                                    a.num_quest = '$num'
                                GROUP BY
                                    a.num_quest
                                UNION ALL  
                                  SELECT
                                    a.*,
                                    b.nama AS nama_project,
                                    c.namacabang AS nama_cabang,
                                    d.nama AS nama_kunjungan,
                                    e.nama AS pemohon,
                                    f.name AS pemohon2,
                                    g.name AS nama_pj_field,
                                    h.name AS nama_ra,
                                    i.Nama AS nama_pwt
                                FROM
                                    form_keterlambatan a
                                    JOIN project b ON a.project=b.kode
                                    JOIN atmcenter c ON a.cabang=c.cabang AND a.project=c.project
                                    JOIN attribute d ON a.kunjungan=d.kode
                                    LEFT JOIN user f ON a.pemohon=f.noid
                                    LEFT JOIN id_data e ON a.pemohon=e.id
                                    LEFT JOIN user g ON a.pj_field=g.noid
                                    LEFT JOIN user h ON a.ra_project=h.noid
                                    LEFT JOIN id_data i ON a.pwt=i.Id
                                WHERE
                                    a.num_quest = '$num'
                                GROUP BY
                                    a.num_quest
                                    ")->row_array();
        
            $this->load->library('email');
              $config = configEmail();
            var_dump($head);
                foreach ($head as $row) { 
              $message = '
                <p>Dear '.$row['name'].',<br><br>

                Berikut ada informasi pengajuan perpanjangan waktu upload data kunjungan</p>
                <p>
                  Project &nbsp;: ' . $dataForm['nama_project'] . '<br>
                  Cabang &nbsp;: ('.$dataForm['cabang'].') ' . $dataForm['nama_cabang'] . '<br>
                  Kunjungan &nbsp;: ' . $dataForm['nama_kunjungan'] . '<br>
                  Shopper Inti/Pewitness &nbsp;: ' .$dataForm['pwt'].' - ' . $dataForm['nama_pwt'] . '<br>
                 Telat kirim data karena &nbsp;: ' .$dataForm['alasan'].'
                </p>
                <br>
                Regards,<br>
                Admin Operation2
              ';
              // echo json_encode($message); die;
              $this->email->initialize($config);
              // $emailPenerima = 'manajemen@mri-research-ind.com';
              $emailPenerima = $row['email'];
              $namaPenerima = $row['name'];

              $this->email->from('admin.web@mri-research-ind.com', 'Operation2 WebAdmin');
              $this->email->subject('Notifikasi Berita Acara Keterlambatan Data');
              // $this->email->set_header('Cc', 'mri.marketing@mri-research-ind.com');
              $this->email->to($emailPenerima, $namaPenerima);
              $this->email->message($message);
              // $this->email->send(FALSE);
              if ($this->email->send()) {
                echo json_encode('sukses');
              } else {
                echo json_encode('sukses2');
              }
        }


        $data1 = ['keterlambatan_upload' => 'Approve'];
        $this->db->where('num', $num);
        $this->db->update('quest', $data1);

        $data2 = ['approval' => 'Approve', 'tgl_approve' => $waktu];
        $this->db->where('id', $id);
        $this->db->update('form_keterlambatan', $data2);

        $this->session->set_flashdata('flash', 'Berhasil Approve form pengajuan keterlambatan!');
        redirect('aktual/berita_acara');
    }

    public function hapus_keterlambatan($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('form_keterlambatan');

        $this->session->set_flashdata('flash', 'Berhasil hapus form pengajuan keterlambatan!');
        redirect('aktual/pengajuan_BA');

    }

    public function ebanking(){

        $data['judul'] = 'Aktual E-Banking';
        $data['daftarproject'] = $this->Aktual_model->getproject_ebanking();

        $data['shopper'] = $this->db->order_by('nama', 'ASC')->get('ebanking_shopper')->result_array();
          
        // $data['search'] = $this->db->query("SELECT a.*,
        //                                 b.nama AS nama_bank,
        //                                 c.nama AS nama_transaksi,
        //                                 d.nama AS nama_project
        //                                 FROM ebanking a
        //                                 LEFT JOIN bank b ON a.bank=b.kode
        //                                 LEFT JOIN attribute_ebanking c ON a.transaksi=c.kode
        //                                 LEFT JOIN project d ON a.project=d.kode
        //                                 WHERE tanggal_evaluasi IS NOT NULL
        //                                 AND a.status = 0 AND d.`type`='n'
        //                                 ")->result_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('aktual/ebanking', $data);
        $this->load->view('templates/footer');

    }

    public function ebanking_aktuallist($num){

        $data['judul'] = 'Aktual E-Banking';
        $data['daftarproject'] = $this->Aktual_model->getproject_ebanking();

        $data['shopper'] = $this->db->order_by('nama', 'ASC')->get('ebanking_shopper')->result_array();
          
        $data['db'] = $this->db->query("SELECT a.*,
                                        b.nama AS nama_bank,
                                        c.nama AS nama_transaksi,
                                        d.nama AS nama_project
                                        FROM ebanking a
                                        LEFT JOIN bank b ON a.bank=b.kode
                                        LEFT JOIN attribute_ebanking c ON a.transaksi=c.kode
                                        LEFT JOIN project d ON a.project=d.kode
                                        WHERE a.num='$num'
                                        ")->row_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('aktual/ebanking_aktuallist', $data);
        $this->load->view('templates/footer');

    }

    // public function ebanking2(){

          
    //     $data = $this->db->query("SELECT a.*,
    //                                     b.nama AS nama_bank,
    //                                     c.nama AS nama_transaksi,
    //                                     d.nama AS nama_project
    //                                     FROM ebanking a
    //                                     LEFT JOIN bank b ON a.bank=b.kode
    //                                     LEFT JOIN attribute_ebanking c ON a.transaksi=c.kode
    //                                     LEFT JOIN project d ON a.project=d.kode
    //                                     WHERE tanggal_evaluasi IS NOT NULL
    //                                     AND a.status = 0 AND d.`type`='n'
    //                                     ")->result_array();

    //     echo json_encode($data);

     
    // }

    public function plotting(){
        
         $id_user = $this->session->userdata('id_user');

        $data['judul'] = 'Plotting E-Banking';
        $data['project'] = $this->Aktual_model->getproject_eb_user($id_user);
        $data['bank'] = $this->Aktual_model->getbank();
        $data['transaksi'] = $this->Aktual_model->gettransaksi();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('aktual/plotting_ebanking', $data);
        $this->load->view('templates/footer');

    }

    public function progress(){
        

        $data['judul'] = 'Progress E-Banking';
        $data['project'] = $this->Aktual_model->getproject_ebanking();
        $data['bank'] = $this->Aktual_model->getbank();
        $data['transaksi'] = $this->Aktual_model->gettransaksi();



        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('aktual/progress_ebanking', $data);
        $this->load->view('templates/footer');

    }

    public function rekap(){
        

        $data['judul'] = 'Reporting E-Banking';
        $data['project'] = $this->Aktual_model->getproject_ebanking();
        $data['project2'] = $this->Aktual_model->getproject_ebanking();

        // $data['bank'] = $this->Aktual_model->getbank();
        // $data['transaksi'] = $this->Aktual_model->gettransaksi();



        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('aktual/rekap_ebanking', $data);
        $this->load->view('templates/footer');

    }

    public function aktual_sosmed(){

        $data['judul'] = 'Aktual Evaluasi Sosial Media';
        $data['daftarproject'] = $this->Aktual_model->getproject_ebanking();

        $data['shopper'] = $this->db->order_by('nama', 'ASC')->get('ebanking_shopper')->result_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('aktual/aktual_sosmed', $data);
        $this->load->view('templates/footer');

    }

    public function sosmed_aktuallist($num){

        $data['judul'] = 'Aktual Evaluasi Sosial Media';
        $data['daftarproject'] = $this->Aktual_model->getproject_ebanking();

        $data['shopper'] = $this->db->order_by('nama', 'ASC')->get('ebanking_shopper')->result_array();
        $data['db'] = $this->db->query("SELECT a.*,
                                      b.nama AS nama_bank,
                                     c.nama AS nama_skenario,
                                    d.nama AS nama_project
                                      FROM sosmed a
                                      LEFT JOIN bank b ON a.bank=b.kode
                                    LEFT JOIN sosmed_skenario c ON a.skenario=c.kode
                                      LEFT JOIN project d ON a.project=d.kode
                                      WHERE a.num='$num' 
                                      ")->row_array(); 

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('aktual/sosmed_aktuallist', $data);
        $this->load->view('templates/footer');

    }

    public function plotting_sosmed(){
        
        $id_user = $this->session->userdata('id_user');

        $data['judul'] = 'Plotting Evaluasi Sosial Media';
        $data['project'] = $this->Aktual_model->getproject_eb_user($id_user);
        $data['bank'] = $this->Aktual_model->getbank();
        $data['skenario'] = $this->Aktual_model->getsken_sosmed();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('aktual/plotting_sosmed', $data);
        $this->load->view('templates/footer');

    }

    public function progress_sosmed(){
        

        $data['judul'] = 'Progress Evaluasi Sosial Media';
        $data['project'] = $this->Aktual_model->getproject_ebanking();
        $data['bank'] = $this->Aktual_model->getbank();
        $data['skenario'] = $this->Aktual_model->getsken_sosmed();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('aktual/progress_sosmed', $data);
        $this->load->view('templates/footer');

    }

    public function getprogress_sosmed()
  {
    $id = $_POST['id_project'];
    $bank = $_POST['bank'];
    $platform = $_POST['platform'];
    $skenario = $_POST['skenario'];
    $plotting = $_POST['plotting'];
    
    $data = $this->Aktual_model->getprogress_sosmed($id, $bank, $platform, $skenario, $plotting);
    echo json_encode($data);
  }

    public function getsken_plotsosmed()
  {
    $pro = $_POST['pro'];
    $bank = $_POST['bank'];
    $plat = $_POST['plat'];
    $data = $this->Aktual_model->getsken_plotsosmed($pro, $bank, $plat);
    echo json_encode($data);
  }

   public function getsken_sosmed_form()
  {
    $pro = $_POST['pro'];
    $bank = $_POST['bank'];
    $plat = $_POST['plat'];
    $data = $this->Aktual_model->getsken_sosmed_form($pro, $bank, $plat);
    echo json_encode($data);
  }

    public function getbank_sosmed()
    {
        $pro = $_POST['pro'];
        $data = $this->Aktual_model->getbank_sosmed($pro);
        echo json_encode($data);
    }

    public function getbank_progress()
    {
        $pro = $_POST['pro'];
        $data = $this->Aktual_model->getbank_progress($pro);
        echo json_encode($data);
    }

    public function getprogress()
  {
    $id = $_POST['id_project'];
    $bank = $_POST['bank'];
    $channel = $_POST['channel'];
    $transaksi = $_POST['transaksi'];
    $plotting = $_POST['plotting'];
    
    $data = $this->Aktual_model->getprogress($id, $bank, $channel, $transaksi, $plotting);
    echo json_encode($data);
  }

   public function getplotsosmed()
  {
    $id = $_POST['id_project'];
    $bank = $_POST['bank'];
    $platform = $_POST['platform'];
    $skenario = $_POST['skenario'];
    $hari = $_POST['hari'];
    $waktu = $_POST['waktu'];
    $trx = $_POST['trx'];
    $data = $this->Aktual_model->getplotsosmed($id, $bank, $platform, $skenario, $hari, $waktu, $trx);
    echo json_encode($data);
  }

   public function getplotsosmed99()
  {
    $id = $_POST['id_project'];
    $bank = $_POST['bank'];
    $platform = $_POST['platform'];
    $skenario = $_POST['skenario'];
    $hari = $_POST['hari'];
    $waktu = $_POST['waktu'];
    $trx = $_POST['trx'];
    $data = $this->Aktual_model->getplotsosmed99($id, $bank, $platform, $skenario, $hari, $waktu, $trx);
    echo json_encode($data);
  }

  public function getupdate_plotsosmed()
  {
    $id = $_POST['id_project'];
    $bank = $_POST['bank'];
    $platform = $_POST['platform'];
    $skenario = $_POST['skenario'];
    $hari = $_POST['hari'];
    $waktu = $_POST['waktu'];
    $trx = $_POST['trx'];
    $data = $this->Aktual_model->getupdate_plotsosmed($id, $bank, $platform, $skenario, $hari, $waktu, $trx);
    echo json_encode($data);
  }

 public function getplotting()
  {
    $id = $_POST['id_project'];
    $bank = $_POST['bank'];
    $channel = $_POST['channel'];
    $transaksi = $_POST['transaksi'];
    $hari = $_POST['hari'];
    $waktu = $_POST['waktu'];
    $trx = $_POST['trx'];
    $data = $this->Aktual_model->getplotting($id, $bank, $channel, $transaksi, $hari, $waktu, $trx);
    echo json_encode($data);
  }

   public function getupdate_plotting()
  {
    $id = $_POST['id_project'];
    $bank = $_POST['bank'];
    $channel = $_POST['channel'];
    $transaksi = $_POST['transaksi'];
    $hari = $_POST['hari'];
    $waktu = $_POST['waktu'];
    $trx = $_POST['trx'];
    $data = $this->Aktual_model->getupdate_plotting($id, $bank, $channel, $transaksi, $hari, $waktu, $trx);
    echo json_encode($data);
  }


  public function gettransaksi_plotting()
  {
    $pro = $_POST['pro'];
    $bank = $_POST['bank'];
    $chan = $_POST['chan'];
    $data = $this->Aktual_model->gettransaksi_plotting($pro, $bank, $chan);
    echo json_encode($data);
  }

   public function gettransaksi_ebanking_form()
  {
    $pro = $_POST['pro'];
    $bank = $_POST['bank'];
    $chan = $_POST['chan'];
    $data = $this->Aktual_model->gettransaksi_ebanking_form($pro, $bank, $chan);
    echo json_encode($data);
  }

  public function getaplikasi()
  {
    $bank = $_POST['bank'];
    $chan = $_POST['chan'];
    $data = $this->Aktual_model->getaplikasi($bank, $chan);
    echo json_encode($data);
  }

  public function getaplikasi_aktual()
  {
    $bank = $_POST['bank'];
    $chan = $_POST['chan'];
    $pro = $_POST['pro'];
    $data = $this->Aktual_model->getaplikasi_aktual($bank, $chan, $pro);
    echo json_encode($data);
  }

  public function getversi()
  {
    $bank = $_POST['bank'];
    $chan = $_POST['chan'];
    // $pro = $_POST['pro'];
    $transaksi = $_POST['transaksi'];
    $os = $_POST['os'];
    $data = $this->Aktual_model->getversi($bank, $chan, $transaksi, $os);
    echo json_encode($data);
  }

  public function getsumber()
  {
    $trx = $_POST['trx'];
    $data = $this->db->get_where('attribute_ebanking', array('kode' => $trx))->result_array();
    echo json_encode($data); 
  }

  public function gettujuan()
  {
    $bank = $_POST['bank'];
    $transaksi = $_POST['transaksi'];
    $jumlah = $_POST['jumlah'];
    $nama_trx = $_POST['nama_trx'];
    $data = $this->Aktual_model->gettujuan($bank, $transaksi, $jumlah, $nama_trx);
    echo json_encode($data);
  }


  public function getnorek_bank(){
    $bank = $_POST['bank'];
    $data = $this->Aktual_model->getnorek_bank($bank);
    echo json_encode($data);
  }

  public function plotadd_sosmed ()
  {
    $id = $this->input->post('id_plot');
    $tgl = $this->input->post('tgl_plot');

    var_dump($id);
    var_dump($tgl);
    foreach ($id as $row => $val) {
        $this->db->query("UPDATE sosmed SET tanggal_evaluasi='$tgl' WHERE num='$val'");
    }
    $this->session->set_flashdata('flash', 'Plotting Berhasil!');
    redirect('aktual/plotting_sosmed');
  }

  public function plotting_ebanking ()
  {
    $id = $this->input->post('id_plot');
    $tgl = $this->input->post('tgl_plot');

    // var_dump($id);
    // var_dump($tgl);
    foreach ($id as $row => $val) {
        $this->db->query("UPDATE ebanking SET tanggal_evaluasi='$tgl' WHERE num='$val'");
    }
    $this->session->set_flashdata('flash', 'Plotting E-Banking Berhasil!');
    redirect('aktual/plotting');
  }

  public function edittd()
  {
    $num = $this->input->post('num');
    $step = $this->input->post('step');
    $id_update = $this->session->userdata('id_user');

    $datenow = date('Y-m-d H:i:s');

    foreach ($num as $n) {
         $td = [        'step1' => $this->input->post('nilaitd'.$n.'1'),
                        'step2' => $this->input->post('nilaitd'.$n.'2'),
                        'step3' => $this->input->post('nilaitd'.$n.'3'),
                        'step4' => $this->input->post('nilaitd'.$n.'4'),
                        'step5' => $this->input->post('nilaitd'.$n.'5'),
                        'step6' => $this->input->post('nilaitd'.$n.'6'),
                        'step7' => $this->input->post('nilaitd'.$n.'7'),
                        'step8' => $this->input->post('nilaitd'.$n.'8'),
                        'step9' => $this->input->post('nilaitd'.$n.'9'),
                        'step10' => $this->input->post('nilaitd'.$n.'10'),
                        'step11' => $this->input->post('nilaitd'.$n.'11'),
                        'step12' => $this->input->post('nilaitd'.$n.'12'),
                        'step13' => $this->input->post('nilaitd'.$n.'13'),
                        'step14' => $this->input->post('nilaitd'.$n.'14'),
                        'step15' => $this->input->post('nilaitd'.$n.'15'),
                        'step16' => $this->input->post('nilaitd'.$n.'16'),
                        'step17' => $this->input->post('nilaitd'.$n.'17'),
                        'step18' => $this->input->post('nilaitd'.$n.'18'),
                        'step19' => $this->input->post('nilaitd'.$n.'19'),
                        'step20' => $this->input->post('nilaitd'.$n.'20'),

                        ];
    $total_td = $this->input->post('td_total'.$n);
    
    $this->db->where('num_eb', $n);
    $update_td = $this->db->update('ebanking_td', $td);

    $update_total = $this->db->query("UPDATE ebanking SET total_td='$total_td', updatetd_id='$id_update', last_update='$datenow' WHERE num='$n'");

    // var_dump($td);
    // var_dump($total_td);
    }

    $this->session->set_flashdata('flash', 'Berhasil Update Data TD!');
    redirect('aktual/evaluasiTD');


  }

  public function download_total(){
    $datenow = date('Y-m-d H:i:s');

    $project = $_POST['project'];
    $channel = $_POST['channel'];

    $query = $this->db->query("UPDATE ebanking SET download_total='$datenow' WHERE project='$project' AND channel='$channel'");

    echo json_encode($query);

  }

  public function download_label(){
    $datenow = date('Y-m-d H:i:s');

    $id = $_POST['id'];

    foreach ($id as $num) {
      
    $query = $this->db->query("UPDATE ebanking SET download_label='$datenow' WHERE num='$num'");
    }

    echo json_encode($query);

  }

    public function form_ebanking(){
        $project = $this->input->post('project');

        $get_pjk = $this->db->get_where('project', array('kode' => $project))->row_array();
        $data['kode_project'] = $this->input->post('project');;
        $data['project'] = $get_pjk['nama'];

        $data['shopper'] = $this->db->order_by('nama', 'ASC')->get('ebanking_shopper')->result_array();
        $data['bank'] = $this->db->query("SELECT b.kode, b.nama FROM ebanking a join bank b on a.bank=b.kode where project='$project' group by a.bank")->result_array();

         $data['channel'] = $this->db->query("SELECT * FROM ebanking where project='$project' group by channel")->result_array();

         $data['transaksi'] = $this->db->query("SELECT
                                    a.transaksi, b.nama 
                                    from ebanking a join attribute_ebanking b on a.transaksi=b.kode 
                                    where project='$project'
                                    GROUP BY a.transaksi")->result_array();

        $data['norek'] = $this->Aktual_model->getnorek_ebanking();
        $data['judul'] = 'Aktual E-Banking';
        // $data['project'] = $this->Aktual_model->getproject_ebanking();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('aktual/form_ebanking', $data);
        $this->load->view('templates/footer');

    }

    public function ulang_ebanking($num){
       $data['data'] = $this->db->query("SELECT a.*, b.nama AS nama_bank, c.nama AS nama_transaksi, d.nama AS nama_project 
                                        FROM ebanking a
                                        LEFT JOIN bank b ON a.bank=b.kode
                                        LEFT JOIN attribute_ebanking c ON a.transaksi=c.kode
                                        LEFT JOIN project d ON a.project=d.kode
                                        where a.num='$num'
                                        ")->row_array();

        $data['norek'] = $this->Aktual_model->getnorek_ebanking();
        $data['judul'] = 'Aktual Ulang E-Banking';
        $data['shopper'] = $this->db->order_by('nama', 'ASC')->get('ebanking_shopper')->result_array();

        // $data['project'] = $this->Aktual_model->getproject_ebanking();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('aktual/ulang_ebanking', $data);
        $this->load->view('templates/footer');
    }

    public function ulang_sosmed($num){
       $data['data'] = $this->db->query("SELECT a.*, b.nama AS nama_bank, c.nama AS nama_skenario, d.nama AS nama_project 
                                        FROM sosmed a
                                        LEFT JOIN bank b ON a.bank=b.kode
                                        LEFT JOIN sosmed_skenario c ON a.skenario=c.kode
                                        LEFT JOIN project d ON a.project=d.kode
                                        where a.num='$num'
                                        ")->row_array();

        // $data['norek'] = $this->Aktual_model->getnorek_ebanking();
        $data['judul'] = 'Aktual Ulang Evaluasi Sosial Media';
        $data['shopper'] = $this->db->order_by('nama', 'ASC')->get('ebanking_shopper')->result_array();

        // $data['project'] = $this->Aktual_model->getproject_ebanking();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('aktual/ulang_sosmed', $data);
        $this->load->view('templates/footer');
    }

    public function edit_sosmedRA($num){
       $data['data'] = $this->db->query("SELECT a.*, b.nama AS nama_bank, c.nama AS nama_skenario, d.nama AS nama_project 
                                        FROM sosmed a
                                        LEFT JOIN bank b ON a.bank=b.kode
                                        LEFT JOIN sosmed_skenario c ON a.skenario=c.kode
                                        LEFT JOIN project d ON a.project=d.kode
                                        where a.num='$num'
                                        ")->row_array();

        // $data['norek'] = $this->Aktual_model->getnorek_ebanking();
        $data['judul'] = 'Edit Data Evaluasi Sosial Media RA';
        $data['shopper'] = $this->db->order_by('nama', 'ASC')->get('ebanking_shopper')->result_array();

        // $data['project'] = $this->Aktual_model->getproject_ebanking();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('aktual/edit_sosmedRA', $data);
        $this->load->view('templates/footer');
    }

    public function evaluasiTD()
    {
        $data['judul'] = "Evaluasi TD E-Banking";
        $data['project'] = $this->Aktual_model->getproject_ebanking();
        $data['bank'] = $this->Aktual_model->getbank();
        $data['transaksi'] = $this->Aktual_model->gettransaksi();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('aktual/evaluasi_td', $data);
        $this->load->view('templates/footer');
    }

    public function Data_TotalTD()
    {
        $data['judul'] = "Report Total TD E-Banking";
        $data['project'] = $this->Aktual_model->getproject_ebanking();
        // $data['bank'] = $this->Aktual_model->getbank();
        // $data['transaksi'] = $this->Aktual_model->gettransaksi();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('aktual/evaluasi_totaltd', $data);
        $this->load->view('templates/footer');
    }


    public function hasil_sosmed()
    {
        $data['judul'] = "Report Evaluasi Sosial Media";
        $data['project'] = $this->Aktual_model->getproject_ebanking();

        $data['skenario'] = $this->db->get('sosmed_skenario')->result_array();
        // $data['bank'] = $this->Aktual_model->getbank();
        // $data['transaksi'] = $this->Aktual_model->gettransaksi();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('aktual/hasil_sosmed', $data);
        $this->load->view('templates/footer');
    }

     public function getchannel()
    
    {
        // $id_user = $this->session->userdata('id_user');
        $id_bank = $_POST['id'];
        $data = $this->Aktual_model->getchannel($id_bank);
        echo json_encode($data);
    }

    public function gettransaksi_eb()
    {
        // $id_user = $this->session->userdata('id_user');
        $channel = $_POST['channel'];
        $project = $_POST['project'];
        $bank = $_POST['bank'];
        $data = $this->Aktual_model->gettransaksi_eb($bank, $channel, $project);
        echo json_encode($data);
    }

    public function getwaktu()
    {
        // $id_user = $this->session->userdata('id_user');
        $jam_mulai = $_POST['jam_mulai'];
        $jam_selesai = $_POST['jam_selesai'];
        
        $data = $this->Aktual_model->getwaktu($jam_mulai, $jam_selesai);
        echo json_encode($data);
    }

     public function export(){
        $pro = $_POST['project_eb'];
        $bank = $_POST['bank_eb'];
        $channel = $_POST['channel_eb'];
        $transaksi = $_POST['transaksi_eb'];
        $os = $_POST['os_eb'];
        $jenis = $_POST['jenis_eb'];

        $jenis_mb = $_POST['jenis_mb'];
    // Skrip berikut ini adalah skrip yang bertugas untuk meng-export data tadi ke excel
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Evaluasi_TD_EBanking.xls");
    
    $cek = [
                                'project' => $pro,
                                'bank' => $bank,
                                'channel' => $channel,
                                'transaksi' => $transaksi,
                                'os' => $os,
                                'jenis' => $jenis,
                                // 'status !=' => 0
                                ];


                    if ($channel == 'Internet Banking') {
                        $data['aktual'] = $this->db->query("SELECT a.*,
                                                    b.nama AS nama_bank,
                                                    c.nama AS nama_transaksi,
                                                    d.nama AS nama_project 
                                                    FROM `ebanking` a
                                                    LEFT JOIN bank b ON a.bank=b.kode
                                                    LEFT JOIN attribute_ebanking c ON a.transaksi=c.kode
                                                    LEFT JOIN project d ON a.project=d.kode
                                                    WHERE project='$pro' AND a.bank='$bank' AND a.channel='$channel' AND transaksi='$transaksi' AND os IS NULL AND jenis='$jenis' AND a.status != 0")->result_array();
                    } else if ($channel == 'Mobile Banking'){
                        $data['aktual'] = $this->db->query("SELECT a.*,
                                                    b.nama AS nama_bank,
                                                    c.nama AS nama_transaksi,
                                                    d.nama AS nama_project 
                                                    FROM `ebanking` a
                                                    LEFT JOIN bank b ON a.bank=b.kode
                                                    LEFT JOIN attribute_ebanking c ON a.transaksi=c.kode
                                                    LEFT JOIN project d ON a.project=d.kode
                                                    WHERE project='$pro' AND a.bank='$bank' AND a.channel='$channel' AND transaksi='$transaksi' AND os='$os' AND jenis='$jenis_mb' AND a.status != 0")->result_array();
                    } if ($channel == 'SMS Banking') {
                        $data['aktual'] = $this->db->query("SELECT a.*,
                                                    b.nama AS nama_bank,
                                                    c.nama AS nama_transaksi,
                                                    d.nama AS nama_project 
                                                    FROM `ebanking` a
                                                    LEFT JOIN bank b ON a.bank=b.kode
                                                    LEFT JOIN attribute_ebanking c ON a.transaksi=c.kode
                                                    LEFT JOIN project d ON a.project=d.kode
                                                    WHERE project='$pro' AND a.bank='$bank' AND a.channel='$channel' AND transaksi='$transaksi' AND os='$os' AND jenis='$jenis' AND a.status != 0")->result_array();
                    } 

    $data['td'] = $this->db->get_where('ebanking_data_td', $cek)->result_array();
    $this->load->view('aktual/export', $data);
  }

    public function autodetect()
    {
    $id_user = $this->session->userdata('id_user');
        $project = $this->input->post('kd_project');
        $nama_shopper = $this->input->post('nama_shopper');
        $bank = $this->input->post('bank');
        $tanggal = $this->input->post('tanggal');
        $jam_mulai = $this->input->post('jam_mulai');
        $jam_selesai = $this->input->post('jam_selesai');
        $channel = $this->input->post('channel_eb');
        $provider = $this->input->post('provider_eb');
        $os = $this->input->post('os_eb');
        $transaksi = $this->input->post('transaksi_eb');
        $percobaan = $this->input->post('percobaan_ke');
        $total_td = $this->input->post('total_td');
        $norek = $this->input->post('norek');
        $tujuan = $this->input->post('tujuan');
        
        $versi_label = $this->input->post('versi_td');

        $ket_coba = $this->input->post('ket_percobaan');

        $ket_percobaan = serialize($ket_coba);
        

        $extension_format  = pathinfo($_FILES['bukti_transaksi']['name'], PATHINFO_EXTENSION);
        $format_name = "BuktiTransaksi_".$project."_" . time() . "." . $extension_format;
        $format_tmp = $_FILES['bukti_transaksi']['tmp_name'];
        move_uploaded_file($format_tmp, "assets/file/buktitrk/" . $format_name);


        if ($channel == 'Mobile Banking') {
          $pecah = explode("_", $os);
         //mencari element array 0
            $hasil_os = $pecah[0];
            $jenis_os = $pecah[1];
        } else if ($channel == 'Internet Banking') {
            $pecah = explode("_", $os);
         
            $jenis_os = $pecah[1];
            if ($provider == 'Telkomsel' OR $provider == 'Indosat' OR $provider == 'XL' OR $provider == 'Smartfren') {
                $hasil_os = 'Wireless';
            } else if ($provider =='Indihome' OR $provider == 'Firstmedia') {
                $hasil_os = 'Wired';
            }
        } else {
            $hasil_os = NULL;
        }

        $cek_hari = date('D', strtotime($tanggal));

        if ($cek_hari == 'Sat' OR $cek_hari == 'Sun') {
            $hari = 'Weekend';
        } else {
            $hari = 'Weekday';
        }

        $get = $this->db->query("SELECT * FROM `waktu` WHERE awal <= '$jam_mulai' AND akhir >= '$jam_mulai'")->row_array();

        if ($get != NULL) {
            $ket_waktu = $get['ket'];
        } else {
            $ket_waktu = "Waktu Tidak Terdaftar";
        }

       
        // $data = [
        //         'project' => $project,
        //         'nama_shopper' => $nama_shopper,
        //         'bank' => $bank,
        //         'tanggal' => $tanggal,
        //         'jam_mulai' => $jam_mulai,
        //         'jam_selesai' => $jam_selesai,
        //         'channel' => $channel,
        //         'provider' => $provider,
        //         'hari' => $hari,
        //         'nama_hari' => $cek_hari,
        //         'ket_waktu' => $ket_waktu,
        //         'os' => $hasil_os,
        //         'transaksi' => $transaksi
        //         ];

        if ($channel == 'Mobile Banking') {

            $detect = [
                'project' => $project,
                'bank' => $bank,
                'channel' => $channel,
                'transaksi' => $transaksi,
                'provider' => $provider,
                'hari' => $hari,
                'waktu' => $ket_waktu,
                'os' => $hasil_os,
                'tanggal_evaluasi' => $tanggal,
                'status' => 0

                ]; 
        } else if($channel == 'SMS Banking'){
             $detect = [
                'project' => $project,
                'bank' => $bank,
                'channel' => $channel,
                'transaksi' => $transaksi,
                'provider' => $provider,
                'hari' => $hari,
                'waktu' => $ket_waktu,
                'os' => $os,
                'tanggal_evaluasi' => $tanggal,
                'status' => 0
                ]; 
        } else {
            $detect = [
                'project' => $project,
                'bank' => $bank,
                'channel' => $channel,
                'transaksi' => $transaksi,
                'provider' => $provider,
                'hari' => $hari,
                'waktu' => $ket_waktu,
                'tanggal_evaluasi' => $tanggal,
                'status' => 0
                ]; 

        }

        $datenow = date('Y-m-d');

    if ($channel == 'Mobile Banking') {
        $insert_aktual = [
                'nama_shopper' => $nama_shopper,
                'norek' => $norek,
                'tujuan' => $tujuan,
                'user_input' => $id_user,
                'tanggal_evaluasi' => $tanggal,
                'jam_mulai' => $jam_mulai,
                'jam_selesai' => $jam_selesai,
                'jenis' => $jenis_os,
                'percobaan' => $percobaan,
                'penyebab' => $ket_percobaan,
                'total_td' => $total_td,
                'tgl_aktual' => $datenow,
                'upload_bukti' => $format_name,
                'status' => 2,
                'versi_label' => $versi_label
                ];
    } else if ($channel == 'Internet Banking') {
        $insert_aktual = [
                'nama_shopper' => $nama_shopper,
                'norek' => $norek,
                'tujuan' => $tujuan,
                'user_input' => $id_user,
                'tanggal_evaluasi' => $tanggal,
                'os' => $hasil_os,
                'jam_mulai' => $jam_mulai,
                'jam_selesai' => $jam_selesai,
                'jenis' => $jenis_os,
                'percobaan' => $percobaan,
                'penyebab' => $ket_percobaan,
                'total_td' => $total_td,
                'tgl_aktual' => $datenow,
                'upload_bukti' => $format_name,
                'status' => 2,
                'versi_label' => $versi_label
                ];
    } else {
        $insert_aktual = [
                'nama_shopper' => $nama_shopper,
                'norek' => $norek,
                'tujuan' => $tujuan,
                'user_input' => $id_user,
                'tanggal_evaluasi' => $tanggal,
                'jam_mulai' => $jam_mulai,
                'jam_selesai' => $jam_selesai,
                'jenis' => $os,
                'percobaan' => $percobaan,
                'penyebab' => $ket_percobaan,
                'total_td' => $total_td,
                'tgl_aktual' =>$datenow,
                'upload_bukti' => $format_name,
                'status' => 2,
                'versi_label' => $versi_label
                ];
    }
        if ($channel == 'Mobile Banking') {
            $query = $this->db->query("SELECT * FROM ebanking WHERE project='$project' AND bank='$bank' AND channel='$channel'AND transaksi='$transaksi' AND tanggal_evaluasi='$tanggal' AND provider='$provider' AND hari='$hari' AND waktu='$ket_waktu' AND os='$hasil_os' AND status = 0")->row_array();
        } else if ($channel == 'SMS Banking') {
            $query = $this->db->query("SELECT * FROM ebanking WHERE project='$project' AND bank='$bank' AND channel='$channel' AND transaksi='$transaksi' AND tanggal_evaluasi='$tanggal' AND provider='$provider' AND hari='$hari' AND waktu='$ket_waktu' AND os='$os' AND status = 0")->row_array();
        } else if ($channel == 'Internet Banking') {
            $query = $this->db->query("SELECT * FROM ebanking WHERE project='$project' AND bank='$bank' AND channel='$channel'AND transaksi='$transaksi' AND tanggal_evaluasi='$tanggal' AND provider='$provider' AND hari='$hari' AND waktu='$ket_waktu' AND status = 0")->row_array();
        }
        // $this->db->where($detect);
        // $this->db->from('ebanking');
        // $query = $this->db->get()->row_array();

        if ($query != NULL) {
            $id_eb = $query['num'];
            $data_td = [
                    'num_eb' => $id_eb,
                    'bank' => $bank,
                    'project' => $project,
                    'channel' => $channel,
                    'transaksi' => $transaksi,
                    'versi_label' => $versi_label 
                    ];

            // for ($i=1; $i <= $total_td ; $i++) { 
                $td = [ 'step1' => $this->input->post('td_step1'),
                        'step2' => $this->input->post('td_step2'),
                        'step3' => $this->input->post('td_step3'),
                        'step4' => $this->input->post('td_step4'),
                        'step5' => $this->input->post('td_step5'),
                        'step6' => $this->input->post('td_step6'),
                        'step7' => $this->input->post('td_step7'),
                        'step8' => $this->input->post('td_step8'),
                        'step9' => $this->input->post('td_step9'),
                        'step10' => $this->input->post('td_step10'),
                        'step11' => $this->input->post('td_step11'),
                        'step12' => $this->input->post('td_step12'),
                        'step13' => $this->input->post('td_step13'),
                        'step14' => $this->input->post('td_step14'),
                        'step15' => $this->input->post('td_step15'),
                        'step16' => $this->input->post('td_step16'),
                        'step17' => $this->input->post('td_step17'),
                        'step18' => $this->input->post('td_step18'),
                        'step19' => $this->input->post('td_step19'),
                        'step20' => $this->input->post('td_step20'),

                        ];
            // }
            
            $result = array_merge($data_td, $td);
            // var_dump($result);
            var_dump($detect);
            var_dump($insert_aktual);
            var_dump($id_eb);
            $cek_td = $this->db->get_where('ebanking_td', array('num_eb' => $id_eb))->row_array();
            if ($cek_td == NULL) {
                $this->db->insert('ebanking_td', $result);
            } else {
                $id_td = $cek_td['id'];
                $this->db->where('id', $id_td);
                $this->db->update('ebanking_td', $result);    
            }

            
            $this->db->where('num', $id_eb);
            $aktual = $this->db->update('ebanking', $insert_aktual);

            $this->session->set_flashdata('flash', 'Skenario Berhasil Ditemukan dan Data Disimpan!');
            redirect('aktual/ebanking');
        } else {
            // $this->session->set_flashdata('flash', '<div class="alert alert-danger alert-dismissable">
            //     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            //     Maaf Skenario <strong> Tidak Ditemukan!</strong>.
            //     </div>');
            // $this->session->set_flashdata('flash2', 'Maaf Skenario Tidak Ditemukan!');
            echo '<script>alert("Maaf Skenario Tidak Ditemukan. Data Tidak Dapat Tersimpan!");
                    window.location.href="'.base_url('aktual/ebanking').'";</script>';
            // redirect('aktual/ebanking');
        }

        // var_dump($id_eb);
        // var_dump($query);            

        // var_dump($data);
    }


    public function aktual_ulang()
    {
        $num = $this->input->post('num');
        $nama_shopper = $this->input->post('nama_shopper');
        $jam_mulai = $this->input->post('jam_mulai');
        $jam_selesai = $this->input->post('jam_selesai');
        $norek = $this->input->post('norek');
        $tujuan = $this->input->post('tujuan');
        $percobaan = $this->input->post('percobaan_ke');

        $ket_coba = $this->input->post('ket_percobaan');
        $ket_percobaan = serialize($ket_coba);

        $total_td = $this->input->post('total_td');

        // $bukti = $this->input->post('bukti_transaksi');

        $extension_format  = pathinfo($_FILES['bukti_transaksi']['name'], PATHINFO_EXTENSION);
        $format_name = "BuktiTransaksi_".$project."_" . time() . "." . $extension_format;
        $format_tmp = $_FILES['bukti_transaksi']['tmp_name'];
        move_uploaded_file($format_tmp, "assets/file/buktitrk/" . $format_name);

        $td = [         'step1' => $this->input->post('td_step1'),
                        'step2' => $this->input->post('td_step2'),
                        'step3' => $this->input->post('td_step3'),
                        'step4' => $this->input->post('td_step4'),
                        'step5' => $this->input->post('td_step5'),
                        'step6' => $this->input->post('td_step6'),
                        'step7' => $this->input->post('td_step7'),
                        'step8' => $this->input->post('td_step8'),
                        'step9' => $this->input->post('td_step9'),
                        'step10' => $this->input->post('td_step10'),
                        'step11' => $this->input->post('td_step11'),
                        'step12' => $this->input->post('td_step12'),
                        'step13' => $this->input->post('td_step13'),
                        'step14' => $this->input->post('td_step14'),
                        'step15' => $this->input->post('td_step15'),
                        'step16' => $this->input->post('td_step16'),
                        'step17' => $this->input->post('td_step17'),
                        'step18' => $this->input->post('td_step18'),
                        'step19' => $this->input->post('td_step19'),
                        'step20' => $this->input->post('td_step20'),

                        ];

        $this->db->where('num_eb', $num);
        $this->db->update('ebanking_td', $td);

        $aktual = [
                    'nama_shopper' => $nama_shopper,
                    'jam_mulai' => $jam_mulai,
                    'jam_selesai' => $jam_selesai,
                    'norek' => $norek,
                    'tujuan' => $tujuan,
                    'percobaan' => $percobaan,
                    'penyebab' => $ket_percobaan,
                    'total_td' => $total_td,
                    'upload_bukti' => $format_name,
                    'status' => 2,
                    'user_input' => $this->session->userdata('id_user')
                    ];
        $this->db->where('num', $num);
        $this->db->update('ebanking', $aktual);

        $this->session->set_flashdata('flash', 'Berhasil Aktual Ulang E-Banking!');
        redirect('notifikasi');

// var_dump($td);
// var_dump($aktual);
        
    }

    public function aktual_list()
    {
        $project = $this->input->post('project_2');
        $bank = $this->input->post('bank_2');
        $channel = $this->input->post('channel_2');
        $transaksi = $this->input->post('transaksi_2');

    $id_user = $this->session->userdata('id_user');
        $nama_shopper = $this->input->post('nama_shopper');
        $jam_mulai = $this->input->post('jam_mulai');
        $jam_selesai = $this->input->post('jam_selesai');
        $percobaan = $this->input->post('percobaan_ke');
        $total_td = $this->input->post('total_td');
        $norek = $this->input->post('norek');
        $tujuan = $this->input->post('tujuan');
        $provider = $this->input->post('provider');
        
        
        $versi_label = $this->input->post('versi_td');

        $ket_coba = $this->input->post('ket_percobaan');

        $ket_percobaan = serialize($ket_coba);
        

        $extension_format  = pathinfo($_FILES['bukti_transaksi']['name'], PATHINFO_EXTENSION);
        $format_name = "BuktiTransaksi_".$project."_" . time() . "." . $extension_format;
        $format_tmp = $_FILES['bukti_transaksi']['tmp_name'];
        move_uploaded_file($format_tmp, "assets/file/buktitrk/" . $format_name);


        if ($channel == 'Mobile Banking') {
            $jenis = $this->input->post('jenis');
            $hasil_os = $this->input->post('os_2');
            
        } else if ($channel == 'Internet Banking') {
            $jenis = $this->input->post('jenis');
            if ($provider == 'Telkomsel' OR $provider == 'Indosat' OR $provider == 'XL' OR $provider == 'Smartfren') {
                $hasil_os = 'Wireless';
            } else if ($provider =='Indihome' OR $provider == 'Firstmedia') {
                $hasil_os = 'Wired';
            }
        } else {
            $jenis = $this->input->post('jenis');
            $hasil_os = $this->input->post('os_2');
        }

        $cek_hari = date('D', strtotime($tanggal));



        $datenow = date('Y-m-d');

    if ($channel == 'Mobile Banking') {
        $insert_aktual = [
                'nama_shopper' => $nama_shopper,
                'norek' => $norek,
                'tujuan' => $tujuan,
                'user_input' => $id_user,
                'jam_mulai' => $jam_mulai,
                'jam_selesai' => $jam_selesai,
                'jenis' => $jenis,
                'percobaan' => $percobaan,
                'penyebab' => $ket_percobaan,
                'total_td' => $total_td,
                'tgl_aktual' => $datenow,
                'upload_bukti' => $format_name,
                'status' => 2,
                'versi_label' => $versi_label
                ];
    } else if ($channel == 'Internet Banking') {
        $insert_aktual = [
                'nama_shopper' => $nama_shopper,
                'norek' => $norek,
                'tujuan' => $tujuan,
                'user_input' => $id_user,
                'os' => $hasil_os,
                'jam_mulai' => $jam_mulai,
                'jam_selesai' => $jam_selesai,
                'jenis' => $jenis,
                'percobaan' => $percobaan,
                'penyebab' => $ket_percobaan,
                'total_td' => $total_td,
                'tgl_aktual' => $datenow,
                'upload_bukti' => $format_name,
                'status' => 2,
                'versi_label' => $versi_label
                ];
    } else {
        $insert_aktual = [
                'nama_shopper' => $nama_shopper,
                'norek' => $norek,
                'tujuan' => $tujuan,
                'user_input' => $id_user,
                'jam_mulai' => $jam_mulai,
                'jam_selesai' => $jam_selesai,
                'jenis' => $jenis,
                'percobaan' => $percobaan,
                'penyebab' => $ket_percobaan,
                'total_td' => $total_td,
                'tgl_aktual' =>$datenow,
                'upload_bukti' => $format_name,
                'status' => 2,
                'versi_label' => $versi_label
                ];
    }
      
            $id_eb = $this->input->post('num');
            $data_td = [
                    'num_eb' => $id_eb,
                    'bank' => $bank,
                    'project' => $project,
                    'channel' => $channel,
                    'transaksi' => $transaksi,
                    'versi_label' => $versi_label 
                    ];

            // for ($i=1; $i <= $total_td ; $i++) { 
                $td = [ 'step1' => $this->input->post('td_step1'),
                        'step2' => $this->input->post('td_step2'),
                        'step3' => $this->input->post('td_step3'),
                        'step4' => $this->input->post('td_step4'),
                        'step5' => $this->input->post('td_step5'),
                        'step6' => $this->input->post('td_step6'),
                        'step7' => $this->input->post('td_step7'),
                        'step8' => $this->input->post('td_step8'),
                        'step9' => $this->input->post('td_step9'),
                        'step10' => $this->input->post('td_step10'),
                        'step11' => $this->input->post('td_step11'),
                        'step12' => $this->input->post('td_step12'),
                        'step13' => $this->input->post('td_step13'),
                        'step14' => $this->input->post('td_step14'),
                        'step15' => $this->input->post('td_step15'),
                        'step16' => $this->input->post('td_step16'),
                        'step17' => $this->input->post('td_step17'),
                        'step18' => $this->input->post('td_step18'),
                        'step19' => $this->input->post('td_step19'),
                        'step20' => $this->input->post('td_step20'),

                        ];
            // }
            
            $result = array_merge($data_td, $td);
            // var_dump($result);
            var_dump($detect);
            var_dump($insert_aktual);
            var_dump($id_eb);
            $cek_td = $this->db->get_where('ebanking_td', array('num_eb' => $id_eb))->row_array();
            if ($cek_td == NULL) {
                $this->db->insert('ebanking_td', $result);
            } else {
                $id_td = $cek_td['id'];
                $this->db->where('id', $id_td);
                $this->db->update('ebanking_td', $result);    
            }

            
            $this->db->where('num', $id_eb);
            $aktual = $this->db->update('ebanking', $insert_aktual);

            $this->session->set_flashdata('flash', 'Skenario Berhasil Ditemukan dan Data Disimpan!');
            redirect('aktual/ebanking');
       }
   // var_dump($data);
   


   public function aktual_listsosmed()
    {
        date_default_timezone_set('Asia/Jakarta');

        $num = $this->input->post('num');
        $datenow = date('Y-m-d');

        $project = $this->input->post('project_2');
        $bank = $this->input->post('bank_2');
        $platform = $this->input->post('platform_2');
        $skenario = $this->input->post('skenario_2');

        $id_user = $this->session->userdata('id_user');
        $nama_shopper = $this->input->post('nama_shopper');
        $jam_mulai = $this->input->post('jam_mulai');

        $sosmed_pengirim = $this->input->post('username_pengirim');
        $sosmed_bank = $this->input->post('username_bank');
        $waktu_kirim = $this->input->post('waktu_kirim');
        if ($this->input->post('waktu_balas') != NULL) {
            $waktu_balas = $this->input->post('waktu_balas');
        } else {
            $waktu_balas = NULL;
        }
        $respon_agent = $this->input->post('respon_agent');
        $aktual_td = $this->input->post('aktual_td');
        $total_td = $this->input->post('total_td');
        $temuan = $this->input->post('temuan');


        $respon_otomatis = $this->input->post('respon_otomatis');
        $verbatim = $this->input->post('verbatim');




        $greet_awal = serialize($this->input->post('greeting_awal'));
        $greet_akhir_before = serialize($this->input->post('greeting_akhir_before'));
        $greet_akhir_after = serialize($this->input->post('greeting_akhir_after'));


        $image_name = serialize($_FILES['bukti_transaksi']['name']);
        

        foreach($_FILES["bukti_transaksi"]["tmp_name"] as $key=>$tmp_name) {
            $format_name = $_FILES['bukti_transaksi']['name'][$key];
            $format_tmp = $_FILES['bukti_transaksi']['tmp_name'][$key];
            move_uploaded_file($format_tmp, "assets/file/buktitrk/" . $format_name);
        }

        $data = [
                'user_input' => $id_user,
                'nama_shopper' => $nama_shopper,
                'jam_mulai' => $jam_mulai,
                'sosmed_pengirim' => $sosmed_pengirim,
                'sosmed_bank' => $sosmed_bank,
                'waktu_kirim' => $waktu_kirim,
                'waktu_balas' => $waktu_balas,
                'greeting_awal' => $greet_awal,
                'greeting_akhir_before' => $greet_akhir_before,
                'greeting_akhir_after' => $greet_akhir_after,
                'respon_agent' => $respon_agent,
                'tgl_aktual' => $datenow,
                'aktual_td' => $aktual_td,
                'upload_bukti' => $image_name,
                'total_td' => $total_td,
                'respon_otomatis' => $respon_otomatis,
                'verbatim_respon' => $verbatim,
                'temuan' => $temuan,
                'status' => 2

                ];

            $this->db->where('num', $num);
            $aktual = $this->db->update('sosmed', $data);

            $this->session->set_flashdata('flash', 'Berhasil Aktual Data!');
            redirect('aktual/aktual_sosmed');

    }


    public function aktual_ulangsosmed()
    {
        date_default_timezone_set('Asia/Jakarta');

        $num = $this->input->post('num');
        $datenow = date('Y-m-d');

        // $project = $this->input->post('project_2');
        // $bank = $this->input->post('bank_2');
        // $platform = $this->input->post('platform_2');
        // $skenario = $this->input->post('skenario_2');

        // $id_user = $this->session->userdata('id_user');
        $nama_shopper = $this->input->post('nama_shopper');
        $jam_mulai = $this->input->post('jam_mulai');

        $sosmed_pengirim = $this->input->post('sosmed_pengirim');
        $sosmed_bank = $this->input->post('sosmed_bank');
        $waktu_kirim = $this->input->post('waktu_kirim');
        if ($this->input->post('waktu_balas') != NULL) {
            $waktu_balas = $this->input->post('waktu_balas');
        } else {
            $waktu_balas = NULL;
        }
        $respon_agent = $this->input->post('respon_agent');
        $aktual_td = $this->input->post('aktual_td');
        $total_td = $this->input->post('total_td');
        $temuan = $this->input->post('temuan');


        $respon_otomatis = $this->input->post('respon_otomatis');
        $verbatim = $this->input->post('verbatim');




        $greet_awal = serialize($this->input->post('greeting_awal'));
        $greet_akhir_before = serialize($this->input->post('greeting_akhir_before'));
        $greet_akhir_after = serialize($this->input->post('greeting_akhir_after'));


        $image_name = serialize($_FILES['bukti_transaksi']['name']);
        

        foreach($_FILES["bukti_transaksi"]["tmp_name"] as $key=>$tmp_name) {
            $format_name = $_FILES['bukti_transaksi']['name'][$key];
            $format_tmp = $_FILES['bukti_transaksi']['tmp_name'][$key];
            move_uploaded_file($format_tmp, "assets/file/buktitrk/" . $format_name);
        }

        $data = [
                // 'user_input' => $id_user,
                'nama_shopper' => $nama_shopper,
                'jam_mulai' => $jam_mulai,
                'sosmed_pengirim' => $sosmed_pengirim,
                'sosmed_bank' => $sosmed_bank,
                'waktu_kirim' => $waktu_kirim,
                'waktu_balas' => $waktu_balas,
                'greeting_awal' => $greet_awal,
                'greeting_akhir_before' => $greet_akhir_before,
                'greeting_akhir_after' => $greet_akhir_after,
                'respon_agent' => $respon_agent,
                // 'tgl_aktual' => $datenow,
                'aktual_td' => $aktual_td,
                'upload_bukti' => $image_name,
                'total_td' => $total_td,
                'respon_otomatis' => $respon_otomatis,
                'verbatim_respon' => $verbatim,
                'temuan' => $temuan,
                'status' => 2

                ];

            $this->db->where('num', $num);
            $aktual = $this->db->update('sosmed', $data);

            $this->session->set_flashdata('flash', 'Berhasil Aktual Ulang Data!');
            redirect('notifikasi');

    }

    public function editRA_listsosmed()
    {
        date_default_timezone_set('Asia/Jakarta');

        $num = $this->input->post('num');
        $datenow = date('Y-m-d');

        // $project = $this->input->post('project_2');
        // $bank = $this->input->post('bank_2');
        // $platform = $this->input->post('platform_2');
        // $skenario = $this->input->post('skenario_2');

        $id_user = $this->session->userdata('id_user');
        $nama_shopper = $this->input->post('nama_shopper');
        $jam_mulai = $this->input->post('jam_mulai');

        $sosmed_pengirim = $this->input->post('username_pengirim');
        $sosmed_bank = $this->input->post('username_bank');
        $waktu_kirim = $this->input->post('waktu_kirim');
        if ($this->input->post('waktu_balas') != NULL) {
            $waktu_balas = $this->input->post('waktu_balas');
        } else {
            $waktu_balas = NULL;
        }
        $respon_agent = $this->input->post('respon_agent');
        $aktual_td = $this->input->post('aktual_td');
        $total_td = $this->input->post('total_td');
        $temuan = $this->input->post('temuan');


        $respon_otomatis = $this->input->post('respon_otomatis');
        $verbatim = $this->input->post('verbatim');




        $greet_awal = serialize($this->input->post('greeting_awal'));
        $greet_akhir_before = serialize($this->input->post('greeting_akhir_before'));
        $greet_akhir_after = serialize($this->input->post('greeting_akhir_after'));



        $data = [
                'nama_shopper' => $nama_shopper,
                'jam_mulai' => $jam_mulai,
                'sosmed_pengirim' => $sosmed_pengirim,
                'sosmed_bank' => $sosmed_bank,
                'waktu_kirim' => $waktu_kirim,
                'waktu_balas' => $waktu_balas,
                'greeting_awal' => $greet_awal,
                'greeting_akhir_before' => $greet_akhir_before,
                'greeting_akhir_after' => $greet_akhir_after,
                'respon_agent' => $respon_agent,
                'aktual_td' => $aktual_td,
                'total_td' => $total_td,
                'respon_otomatis' => $respon_otomatis,
                'verbatim_respon' => $verbatim,
                'temuan' => $temuan,
                'update_id' => $id_user,
                'tgl_update' => $datenow

                ];

            $this->db->where('num', $num);
            $aktual = $this->db->update('sosmed', $data);

            $this->session->set_flashdata('flash', 'Berhasil Update Data!');
            redirect('aktual/hasil_sosmed');

    }


    public function file_ebanking($num){
        $data['db'] = $this->db->query("SELECT a.*,
                                                    b.nama AS nama_bank,
                                                    c.nama AS nama_transaksi,
                                                    d.nama AS nama_project,
                                                    e.name AS nama_user1,
                                                    f.nama AS nama_user2
                                                    FROM ebanking a
                                                    LEFT JOIN bank b ON a.bank=b.kode
                                                    LEFT JOIN attribute_ebanking c ON a.transaksi=c.kode
                                                    LEFT JOIN project d ON a.project=d.kode
                                                    LEFT JOIN user e ON a.user_input=e.noid
                                                    LEFT JOIN ebanking_shopper f ON a.user_input=f.user_id
                                                    WHERE a.num = '$num'")->row_array();
    
        $data['judul'] = "Upload Ulang File E-Banking";
        // $data['bank'] = $this->Aktual_model->getbank();
        // $data['transaksi'] = $this->Aktual_model->gettransaksi();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('aktual/file_ebanking', $data);
        $this->load->view('templates/footer');
    }

    public function uploadfile_ebanking()
    {
        $num = $this->input->post('num');

        $extension_format  = pathinfo($_FILES['bukti_transaksi']['name'], PATHINFO_EXTENSION);
        $format_name = "BuktiTransaksi_".$project."_" . time() . "." . $extension_format;
        $format_tmp = $_FILES['bukti_transaksi']['tmp_name'];
        move_uploaded_file($format_tmp, "assets/file/buktitrk/" . $format_name);   
    
        $aktual = [
                    'upload_bukti' => $format_name,
                    'status' => 2,
                    'user_input' => $this->session->userdata('id_user')
                    ];
        $this->db->where('num', $num);
        $this->db->update('ebanking', $aktual);

        $this->session->set_flashdata('flash', 'Berhasil Upload Ulang Bukti Transaksi E-Banking!');
        redirect('notifikasi');

    }

    public function akses_upload()
    {
        $data['judul'] = "Akses Upload File";

        $id_user = $this->session->userdata('id_user');
        $data['project'] = $this->Aktual_model->getproject_user($id_user);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('aktual/akses', $data);
        $this->load->view('templates/footer');
    }

    public function getcabang_akses()
    {
        $pro = $_POST['pro'];
        $data = $this->Aktual_model->getcabang_akses($pro);

        echo json_encode($data);
    }

    public function getdata_quest()
    {
        $pro = $_POST['pro'];
        $cabang = $_POST['cabang'];
        $data = $this->Aktual_model->getdata_quest($pro, $cabang);

        echo json_encode($data);
    }

    public function change_aksesupload()
    {
        $num = $_POST['num'];
        $data = $this->Aktual_model->change_aksesupload($num);

        echo json_encode($data);
    }

    public function reset_aksesupload()
    {
        $num = $_POST['num'];
        $data = $this->Aktual_model->reset_aksesupload($num);

        echo json_encode($data);
    }

 
}
