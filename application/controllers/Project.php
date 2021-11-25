<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Project extends CI_Controller
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

        $this->load->model('Project_model');
        $this->load->library('form_validation');
    }

    public function index()
    {

        $id = $this->session->userdata('id_user');
        $data['judul'] = 'MRI Operation';
        $data['jumlah_data'] = $this->Project_model->getRowData($id);

        // PAGINATION
        $this->load->library('pagination');

        $config['base_url'] = 'http://localhost/mri-operation/project/index';
        $config['total_rows'] = $this->Project_model->getRowData($id);
        $config['per_page'] = 10;

        $config['full_tag_open'] = '<nav class="mt-3"><ul class="pagination pagination-sm justify-content-center">';
        $config['full_tag_close'] = '</ul></nav>';

        $config['first_link'] = 'Awal';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Akhir';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        $config['attributes'] = array('class' => 'page-link');



        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(3);

        if ($data['start'] == "") {
            $data['start'] = 0;
        }

        $data['data_project'] = $this->Project_model->getAllData($id, $data['start'], $config['per_page']);
        // PAGINATION

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('project/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['judul'] = 'Tambah Data Project';
        $data['bank'] = $this->Project_model->getbank();
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('kode', 'Kode', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/tambah', $data);
            $this->load->view('templates/footer');
        } else {

            // $img2 = $_FILES['projectspec']['name'];

            // if($img2){
            //         $config['upload_path']          = './assets/file/project';
            //         $config['allowed_types']        = 'pdf|doc|docx|xls|xlsx';

            //         $this->load->library('upload', $config);   
            //         if ($this->upload->do_upload('projectspec')){
            //             $img3 = $this->upload->data('file_name');
            //         } else {
            //             echo $this->upload->display_errors();
            //         }
            // }
            // $this->Project_model->tambah($img3);
            $this->Project_model->tambah();
            $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Data Project telah <strong>ditambahkan!</strong>.
                </div>');
            redirect('project');
        }
    }

    public function hapus($id)
    {
        $this->Project_model->hapus($id);

        $this->session->set_flashdata('info', '<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Data Project telah <strong>dihapus!</strong>.
              </div>');

        redirect('project');
    }

    public function ubah($id_project)
    {

        $data['data_project'] = $this->Project_model->getProjectById($id_project);
        $data['bank'] = $this->Project_model->getbank();
        $data['jenis_project'] = ['1' => 'Adhoc', '2' => 'Industri'];

        $data['judul'] = 'Ubah Data Project';
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('kode', 'Kode', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('project/ubah', $data);
            $this->load->view('templates/footer');
        } else {

            $img2 = $_FILES['projectspec']['name'];

            if ($img2) {
                $config['upload_path']          = './assets/file/project';
                $config['allowed_types']        = 'pdf|doc|docx|xls|xlsx';

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('projectspec')) {
                    $img3 = $this->upload->data('file_name');
                    $this->db->where('id_project', $id_project);
                    $this->db->update('data_project', ['file_projectspec' => $img3]);
                } else {
                    echo $this->upload->display_errors();
                }
            } else {
                $img3 = 0;
            }

            $data = $this->db->get_where('data_project', ['id_project' => $id_project])->row_array();

            if ($img3 != 0) {
                unlink(FCPATH . '/assets/file/project/' . $data['file_projectspec']);
            } else {
                $img3 = $data['file_projectspec'];
            }

            $this->Project_model->ubah($id_project);
            $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Data Project telah <strong>diubah!</strong>.
                </div>');

            redirect('project');
        }
    }

    public function konsistensi()
    {
        $data['judul'] = 'Data Konsistensi Non Skill MS B1';
        $data['project'] = $this->db->query("SELECT * FROM project WHERE visible='y' AND type='n' AND (channel != 'E-Banking' OR channel IS NULL)")->result_array();
        $data['database'] = $this->db->query("SHOW DATABASES")->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('project/konsistensi', $data);
        $this->load->view('templates/footer');
    }

    public function download()
    {
        $data = $this->uri->segment(3);
        $file = urldecode($data);
        $berkas = FCPATH . '/assets/file/project/' . $file;
        force_download($berkas, NULL);
    }

    public function kelengkapan_field()
    {
        $data['judul'] = 'Pengecekan Kelengkapan Field';
        $data['project'] = $this->db->get_where('project', array('channel' => 'E-Banking'))->result_array();
        $data['pengecekan'] = $this->db->query("SELECT a.*, b.nama AS nama_project
                                                FROM ebanking_cekfield a LEFT JOIN project b ON a.project=b.kode
                                                GROUP BY a.tanggal, a.project")->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('project/kelengkapan_field', $data);
        $this->load->view('templates/footer');
    }

    public function add_pengecekan()
    {
        $this->Project_model->add_pengecekan();
        $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Data Pengecekan Kecepatan telah <strong>ditambahkan!</strong>.
                </div>');
        redirect('project/kelengkapan_field');
    }

    public function editprovider()
    {
        $update = date('Y-m-d');
        if (isset($_POST['hapus'])) {
            $id = $this->input->post('delete_id');

            foreach ($id as $row => $val) {
                $this->db->query("DELETE FROM ebanking_provider WHERE id='$val'");
            }

            $this->session->set_flashdata('flash', 'Berhasil Delete Provider');
            redirect('project/kelengkapan_field');
        } else if (isset($_POST['update'])) {
            $id = $this->input->post('id');
            $nama = $this->input->post('nama');


            foreach ($id as $row => $val) {
                $cek = $this->db->get_where('ebanking_provider', array('id' => $val))->row();

                if ($cek != NULL) {

                    $this->db->query("UPDATE ebanking_provider SET nama='$nama[$row]' WHERE id='$val'");
                } else {
                    $data = [
                        'nama' => $_POST['nama'][$row],
                    ];
                    $this->db->insert('ebanking_provider', $data);
                }
            }
            $this->session->set_flashdata('flash', 'Berhasil Update Provider');
            redirect('project/kelengkapan_field');
        }
    }

    public function getprovider()
    {
        $data = $this->Project_model->getprovider();
        echo json_encode($data);
    }

    public function delete_daftar()
    {
        $id = $this->input->post('id_delete');

        foreach ($id as $key => $val) {
            $this->db->query("DELETE FROM ebanking_cekfield WHERE id='$val'");
        }

        $this->session->set_flashdata('flash', 'Berhasil Delete Data!');
        redirect('project/kelengkapan_field');
    }

    public function peralatan()
    {
        $data['judul'] = 'Pengecekan Peralatan Field';
        $data['project'] = $this->db->get_where('project', array('channel' => 'E-Banking'))->result_array();
        $data['pengecekan'] = $this->db->query("SELECT a.*, b.nama AS nama_project
                                                 FROM ebanking_peralatan a LEFT JOIN project b ON a.project=b.kode
                                                 GROUP BY a.project")->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('project/peralatan', $data);
        $this->load->view('templates/footer');
    }

    public function add_peralatan()
    {
        $this->Project_model->add_peralatan();
        $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Data Kelengkapan Peralatan telah <strong>ditambahkan!</strong>.
                </div>');
        redirect('project/peralatan');
    }

    public function delete_peralatan()
    {
        $id = $this->input->post('id_hapus');

        foreach ($id as $key => $val) {
            $this->db->query("DELETE FROM ebanking_peralatan WHERE id='$val'");
        }

        $this->session->set_flashdata('flash', 'Berhasil Delete Data!');
        redirect('project/peralatan');
    }

    public function report()
    {
        $data['judul'] = 'Report Internal';
        // $data['project'] = $this->db->get_where('project', array('channel' => 'E-Banking'))->result_array();
        // $data['pengecekan'] = $this->db->query("SELECT a.*, b.nama AS nama_project
        //                                          FROM ebanking_peralatan a LEFT JOIN project b ON a.project=b.kode
        //                                          GROUP BY a.project")->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('project/report', $data);
        $this->load->view('templates/footer');
    }

    public function detail_report()
    {
        $data['judul'] = 'Detail Report Internal';

        $data['project'] = $this->input->post('project');
        $pjk = $this->input->post('project');

        $kode = $this->db->query("SELECT * FROM project WHERE kode='$pjk'")->row_array();

        $data['skenario_cs'] = $this->db->query("SELECT *, a.kategori AS ktg FROM skenario a 
                                                LEFT JOIN attribute b ON a.ket=b.kode
                                                WHERE a.kategori IN ('001', '002', '003', '004') AND
                                                a.att NOT IN ('051', '052', '053', '054', '094') AND
                                                a.project='$pjk' GROUP BY a.kategori")->result_array();

        $data['skenario_tl'] = $this->db->query("SELECT *, a.kategori AS ktg FROM skenario a 
                                                LEFT JOIN attribute b ON a.att=b.kode
                                                WHERE a.att IN ('051', '052', '053', '054', '094') AND
                                                a.project='$pjk'")->result_array();


        $data['detail'] = $this->db->query("SELECT * FROM project WHERE kode='$pjk'")->row_array();

        $data['sql'] = $this->db->query("SELECT provinsi, COUNT(provinsi) AS jumlah FROM cabang WHERE project='$pjk' AND kodebank='$kode[bank]'  GROUP BY provinsi")->result_array();

        $data['sql_kompetitor'] = $this->db->query("SELECT provinsi, COUNT(provinsi) AS jumlah FROM cabang WHERE project='$pjk' AND kodebank!='$kode[bank]'  GROUP BY provinsi")->result_array();


        // echo $q1_done;
        // echo $q1_all;
        if ($data['project'] == NULL) {
            redirect('project/report');
        } else {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('project/detail_report', $data);
            $this->load->view('templates/footer');
        }
    }


    public function mistery_shopping()
    {
        $data['judul'] = 'Progress Mystery Shopper';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('project/mistery_shopping', $data);
        $this->load->view('templates/footer');
    }

    public function setpublish()
    {
        $num = $_POST['num'];
        $publish = $_POST['publish'];
        $user_publish = $this->session->userdata('id_user');
        $data = $this->Project_model->setpublish($num, $publish, $user_publish);
        echo json_encode($data);
    }

    public function stepprogress()
    {
        $idku = $_POST['idku'];
        $status_progress = $_POST['status_progress'];
        $data = $this->Project_model->stepprogress($idku, $status_progress);
        echo json_encode($data);
    }

    public function gettable()
    {
        $kata = $_POST['kata'];
        $ktg = $_POST['ktg'];
        $pro = $_POST['pro'];
        $data = $this->Project_model->gettable($kata, $ktg, $pro);
        echo json_encode($data);
    }

    public function getfilter()
    {
        $kata = $_POST['kata'];
        $pro = $_POST['pro'];
        $data = $this->Project_model->getfilter($kata, $pro);
        echo json_encode($data);
    }

    public function getfilter_progress()
    {
        $kata = $_POST['kata'];
        $pro = $_POST['pro'];
        $filter = $_POST['filter'];

        $data = $this->Project_model->getfilter_progress($kata, $pro, $filter);
        echo json_encode($data);
    }

    public function getfilter2()
    {
        $kata = $_POST['kata'];
        $pro = $_POST['pro'];
        $data = $this->Project_model->getfilter2($kata, $pro);
        echo json_encode($data);
    }

    public function getfilter_progress2()
    {
        $kata = $_POST['kata'];
        $pro = $_POST['pro'];
        $filter = $_POST['filter'];

        $data = $this->Project_model->getfilter_progress2($kata, $pro, $filter);
        echo json_encode($data);
    }

    public function register_client()
    {
        $data['judul'] = 'Register Client';

        $data['bank'] = $this->db->order_by('nama', 'asc')->get('bank')->result_array();
        // $menu_admin = $this->db->order_by('urut', 'asc')->get_where('kelompok_menu', ['id_divisi' => $user['id_divisi']])->result_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('project/register_client', $data);
        $this->load->view('templates/footer');
    }

    public function input_client()
    {
        $db_cl = $this->load->database('db_client', TRUE);

        $username = $this->input->post('username');

        $cek = $db_cl->get_where('user_client', array('username' => $username))->result_array();

        if ($cek != NULL) {
            $this->session->set_flashdata('info', '<div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            Username sudah digunakan. Mohon gunakan username lain.</strong>.
                            </div>');
            redirect('project/register_client');
        } else {
            $this->Project_model->input_client();
            $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            Berhasil membuat user untuk client.</strong>.
                            </div>');
            redirect('project/register_client');
        }
    }

    public function login_client()
    {
        $data['judul'] = 'Login Client';

        // $data['bank'] = $this->db->order_by('nama', 'asc')->get('bank')->result_array();
        // $menu_admin = $this->db->order_by('urut', 'asc')->get_where('kelompok_menu', ['id_divisi' => $user['id_divisi']])->result_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('project/login_client', $data);
        $this->load->view('templates/footer');
    }

    public function activation($project)
    {
        $name = $this->db->get_where('project', array('kode' => $project))->row_array();

        $pro = $this->db->get_where('project', array('kode' => $project))->result_array();
        $cabang = $this->db->get_where('cabang', array('project' => $project))->result_array();
        $plan = $this->db->get_where('project_plan', array('project_kode' => $project))->result_array();
        $skenario = $this->db->get_where('skenario', array('project' => $project))->result_array();

        $db_cl = $this->load->database('db_client', TRUE);

        $satu = $this->db->query("SELECT *, a.id AS idku FROM project_plan a JOIN task b ON a.task_id=b.id WHERE a.project_kode='$project' AND b.kegiatan='Kick-off Meeting'")->row_array();
        $dua = $this->db->query("SELECT *, a.id AS idku FROM project_plan a JOIN task b ON a.task_id=b.id WHERE a.project_kode='$project' AND b.kegiatan='Persiapan Fieldwork'")->row_array();
        $empat = $this->db->query("SELECT *, a.id AS idku FROM project_plan a JOIN task b ON a.task_id=b.id WHERE a.project_kode='$project' AND b.kegiatan='Data Processing'")->row_array();
        $lima = $this->db->query("SELECT *, a.id AS idku FROM project_plan a JOIN task b ON a.task_id=b.id WHERE a.project_kode='$project' AND b.kegiatan='Analisis Data'")->row_array();
        $enam = $this->db->query("SELECT *, a.id AS idku FROM project_plan a JOIN task b ON a.task_id=b.id WHERE a.project_kode='$project' AND b.kegiatan='Laporan'")->row_array();

        if ($satu == NULL or $dua == NULL or $empat == NULL or $lima == NULL or $enam == NULL) {
            $this->session->set_flashdata('info', '<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong> Gagal Aktivasi Project ' . $name['nama'] . '. Anda belum melengkapi project plan berdasarkan step progress. Mohon lengkapi terlebih dahulu.</strong>
              </div>');
            redirect('projectplan/view/' . $project);
        } else {

            foreach ($pro as $pjk) {
                $data1 = [
                    'kode' => $pjk['kode'],
                    'nama' => $pjk['nama'],
                    'bank' => $pjk['bank'],
                    'tanggal' => $pjk['tanggal'],
                    'tanggal_end' => $pjk['tanggal_end'],
                    'visible' => $pjk['visible'],
                    'type' => $pjk['type'],
                    'id_user' => $pjk['id_user'],
                    'channel' => $pjk['channel'],
                    'project_client' => $pjk['project_client'],

                ];
                // var_dump($data1);
                $db_cl->insert('project', $data1);
            }
            // $db_cl->insert_batch('project', $data1);

            foreach ($cabang as $cb) {
                $data2 = [
                    'num' => $cb['num'],
                    'project' => $cb['project'],
                    'kode' => $cb['kode'],
                    'nama' => $cb['nama'],
                    'alamat' => $cb['alamat'],
                    'kota' => $cb['kota'],
                    'provinsi' => $cb['provinsi'],
                    'kanwil' => $cb['kanwil'],
                    'kodepos' => $cb['kodepos'],
                    'notelpon' => $cb['notelpon'],
                    'fax' => $cb['fax'],
                    'kodebank' => $cb['kodebank'],
                ];
                $db_cl->insert('cabang', $data2);
            }
            // $db_cl->insert_batch('cabang', $data2);


            foreach ($plan as $pl) {
                $data3 = [
                    'id' => $pl['id'],
                    'project_kode' => $pl['project_kode'],
                    'task_id' => $pl['task_id'],
                    'date_start' => $pl['date_start'],
                    'date_finish' => $pl['date_finish'],
                    'user_add' => $pl['user_add'],
                    'created_at' => $pl['created_at'],
                    'updated_at' => $pl['updated_at'],
                    'status' => $pl['status']
                ];
                $db_cl->insert('project_plan', $data3);
            }
            // $db_cl->insert_batch('project_plan', $data3);


            foreach ($skenario as $sken) {
                $data4 = [
                    'num' => $sken['num'],
                    'project' => $sken['project'],
                    'att' => $sken['att'],
                    'ket' => $sken['ket'],
                    'numrow' => $sken['numrow'],
                    'kategori' => $sken['kategori']
                ];
                $db_cl->insert('skenario', $data4);
            }
            // $db_cl->insert_batch('skenario', $data4);

            $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong> Berhasil Aktivasi Project ' . $name['nama'] . '.</strong>
              </div>');
            redirect('project/report');
        }
    }

    public function setkolom_view()
    {
        $num = $_POST['num'];
        $jenis = $_POST['jenis'];
        $td = $_POST['td'];
        $temuan = $_POST['temuan'];

        if ($jenis == 'on') {
            $jenisku = 'Yes';
        } else {
            $jenisku = 'No';
        }

        if ($td == 'on') {
            $tdku = 'Yes';
        } else {
            $tdku = 'No';
        }

        if ($temuan == 'on') {
            $temuanku = 'Yes';
        } else {
            $temuanku = 'No';
        }

        $data = $this->db->query("UPDATE quest SET kol_jenis ='$jenisku', kol_td = '$tdku', kol_temuan='$temuanku' WHERE num='$num'");
        // $data = $this->db->query("UPDATE quest SET kol_jenis =NULL, kol_td = NULL, kol_temuan=NULL");

        echo json_encode($data);
    }
}
