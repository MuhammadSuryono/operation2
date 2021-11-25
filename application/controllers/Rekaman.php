<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekaman extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Rekaman_model');
        $this->load->model('Shp_model');
        $this->load->library('form_validation');
    }

    public function index(){
         $data['judul'] = 'Rekaman Kunjungan';

        //  MRI OPERTAION 8
        //  $data['rekaman'] = $this->Rekaman_model->getDataRekaman();
        //  $data['project'] = $this->Rekaman_model->getDataProject();
        // $data['project'] = $this->Shp_model->getDataProjectSkenario();
        // AKHIR
        // var_dump()

        // KERJA BAKTI
        $data['rekaman'] = $this->Rekaman_model->getDataRekamanKB();
        $data['project'] = $this->Rekaman_model->getDataProjectSkenarioKB();
        // AKHIR

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('rekaman/indexKB', $data);
        $this->load->view('templates/footer');
    }

    public function tambah(){
        $img1 = $_FILES['rekaman']['name'];

        if ($img1){
                $config['upload_path']          = './assets/file/rekaman';
                $config['allowed_types']        = 'mp3|wav|ogg|mov|3gp|m4a';

                $this->load->library('upload', $config);

                if($this->upload->do_upload('rekaman')) {
                       $img1 = $this->upload->data('file_name');
                } else {
                    echo $this->upload->display_errors();
                    die;
                }

                $this->Rekaman_model->tambah($img1);

                $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                File Rekaman telah<strong> ditambahkan!</strong>.
                </div>');

                redirect('rekaman');

        } else {
            $this->session->set_flashdata('info', '<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Gagal! File Rekaman belum<strong> dilampirkan!</strong>.
                </div>');
            redirect('rekaman');
        }
    }

    public function hapus($id){
        $this->Rekaman_model->hapus($id);

        $this->session->set_flashdata('info', '<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Data Rekaman telah<strong> dihapus!</strong>.
                </div>');
            redirect('rekaman');
    }

    public function edit(){

        $db = $this->db->get_where('data_rekaman', ['id_rekaman' => $this->input->post('id')])->row_array();
        $pro = $db['id_project'];
        $cabang = $db['kode_cabang'];
        $kun = $db['kunjungan'];
        $sek = $db['id_skenario'];

        // var_dump($pro);
        // var_dump($cabang);
        // var_dump($kun);
        // var_dump($sek);
        // die;

        $img1 = $_FILES['rekaman']['name'];

        if ($img1){

                $berkas = isset($_FILES["rekaman"]['error']) != 0 ? $_FILES["rekaman"] : NULL;

                $file_tmp           = $berkas['tmp_name'];
                $file_ext           = pathinfo($berkas['name'], PATHINFO_EXTENSION);
                $img2               = $pro."-".$cabang."-".$kun."-".$sek.".".$file_ext;

                move_uploaded_file($file_tmp,"assets/file/rekaman/".$img2);

                $img3               = $pro."-".$cabang."-".$kun."-".$sek."(update).".$file_ext;

                //File path at local server
                $source ='assets/file/rekaman/'.$img2;

                //Load codeigniter FTP class
                $this->load->library('ftp');

                //FTP configuration
                $config['hostname'] = '192.168.8.101';
                $config['username'] = 'dataauviq';
                $config['password'] = 'AuviqValidation';
                $config['debug']    = TRUE;

                //Connect to the remote server
                $this->ftp->connect($config);

                //File upload path of remote server
                $destination = '/assets/'.$img3;

                //Upload file to the remote server
                $this->ftp->upload($source, ".".$destination);

                //Close FTP connection
                $this->ftp->close();

                //Delete file from local server
                @unlink($source);

        } else {
            $img1 = 0;
        }

        $this->Rekaman_model->editKB($img1, $img3);

        $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Data Rekaman telah<strong> diubah!</strong>.
                </div>');
        redirect('shp/cekdata');
    }

    public function tambahKB(){
        $img1 = $_FILES['rekaman']['name'];

        if ($img1){
                $config['upload_path']          = './assets/file/rekaman';
                $config['allowed_types']        = 'mp3|wav|ogg|mov|3gp|m4a';
                $config['max-size'] = 0;

                $this->load->library('upload', $config);

                if($this->upload->do_upload('rekaman')) {
                       $img1 = $this->upload->data('file_name');
                } else {
                    echo $this->upload->display_errors();
                    die;
                }

                $this->Rekaman_model->tambahKB($img1);

                $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                File Rekaman telah<strong> ditambahkan!</strong>.
                </div>');

                redirect('rekaman');

        } else {
            $this->session->set_flashdata('info', '<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Gagal! File Rekaman belum<strong> dilampirkan!</strong>.
                </div>');
            redirect('rekaman');
        }
    }

    public function tambahKB1($kunjungan, $project, $cabang){
        $data['judul'] = 'Form Upload Rekaman';

        $data['project'] = $this->db->get_where('project', ['kode' => $project])->row_array();
        $data['quest'] = $this->Rekaman_model->getRekamanKB($kunjungan, $project, $cabang);
        $data['datakunjungan'] = $this->Rekaman_model->datakunjungan($kunjungan, $project, $cabang);
        $data['kunjungan'] = $kunjungan;
        $data['cabang'] = $cabang;


        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('kode', 'Kode', 'required');
        if($this->form_validation->run()==false){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('rekaman/tambahKBBARU', $data);
            $this->load->view('templates/footer');
        } else {

            $this->Rekaman_model->tambahKB2();
            $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Rekaman berhasil<strong> disimpan!</strong>.
                </div>');
            redirect('aktual');
        }
    }

    public function tambahKB2($kunjungan, $project, $cabang){
        $data['judul'] = 'Form Upload Bukti Kirim Rekaman';

        $data['project'] = $this->db->get_where('project', ['kode' => $project])->row_array();
        $data['quest'] = $this->Rekaman_model->getRekamanKB2($kunjungan, $project, $cabang);
        $data['datakunjungan'] = $this->Rekaman_model->datakunjungan($kunjungan, $project, $cabang);
        $data['kunjungan'] = $kunjungan;
        $data['cabang'] = $cabang;


        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('kode', 'Kode', 'required');
        if($this->form_validation->run()==false){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('rekaman/tambahKB2', $data);
            $this->load->view('templates/footer');
        } else {

            $this->Rekaman_model->ubahrekamanKB();
            $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Rekaman berhasil<strong> disimpan!</strong>.
                </div>');

                $id_akses = $this->session->userdata('id_akses');

                if( $id_akses = 1 OR $id_akses = 'Supervisor' ){
                    redirect('notifikasi/indexpic');
                }else{
                    redirect('notifikasi');
                }
        }
    }

    public function updatedatarekaman()
    {
       $update = $this->Rekaman_model->ubahrekamanKB();
        
        // $this->session->set_flashdata('flash', 'Berhasil Upload Ulang Rekaman');
          $id_akses = $this->session->userdata('id_akses');

                if( $id_akses = 1 OR $id_akses = 'Supervisor' AND $update){
                    $this->session->set_flashdata('flash', 'Berhasil Upload Ulang Rekaman');
                    redirect('notifikasi/indexpic');
                }else if ($update){
                    
                    $this->session->set_flashdata('flash', 'Berhasil Upload Ulang Rekaman');
                    redirect('notifikasi');
                }
           
    }

    // public function updatedatarekaman()
    // {
    //     $id_rekaman = $this->input->post('id_rekaman');
    //     $num_quest = $this->input->post('num_quest');
        
    //     //UPLOAD ULANG REKAMAN
    //     $extension_rek  = pathinfo($_FILES['berkas_rekaman']['name'], PATHINFO_EXTENSION);
    //     $rek_name = "berkas_rekaman_" . time() . "." . $extension_rek;
    //     $rek_tmp = $_FILES['berkas_rekaman']['tmp_name'];
    //     move_uploaded_file($rek_tmp, "assets/file/rekaman/" . $rek_name);

    //     $data = [
    //         'file_rekaman' => $rek_name
    //         ];

    //     $where = ['id_rekaman' => $id_rekaman];
                
    //     $this->db->where($where);
    //     $this->db->update('data_rekaman', $data);
        
    //     $this->session->set_flashdata('flash', 'Berhasil Upload Ulang Rekaman');
    //     redirect('notifikasi');
           
    // }

    public function uploadfilenya($kunjungan, $project, $cabang){
        $data['judul'] = 'Form Upload Rekaman';

        $data['project'] = $this->db->get_where('project', ['kode' => $project])->row_array();
        $data['quest'] = $this->Rekaman_model->getRekamanKB3($kunjungan, $project, $cabang);
        $data['datakunjungan'] = $this->Rekaman_model->datakunjungan($kunjungan, $project, $cabang);
        $data['kunjungan'] = $kunjungan;
        $data['cabang'] = $cabang;


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('rekaman/uploadchunk', $data);
        $this->load->view('templates/footer');

    }

    public function uploadtoserver(){

            // 5 minutes execution time
		// @set_time_limit(5 * 60);
		// Uncomment this one to fake upload time
		// usleep(5000);

		// Settings

		$targetDir = FCPATH . "assets/file/rekaman";
		//$targetDir = 'uploads';
		$cleanupTargetDir = true; // Remove old files
		$maxFileAge = 5 * 3600; // Temp file age in seconds


		// Create target dir
		if (!file_exists($targetDir)) {
			@mkdir($targetDir);
		}

		// Get a file name
		if (isset($_REQUEST["name"])) {
			$fileName = $_REQUEST["name"];
		} elseif (!empty($_FILES)) {
			$fileName = $_FILES["file"]["name"];
		} else {
			$fileName = uniqid("file_");
		}

		$filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;

		// Chunking might be enabled
		$chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
		$chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;


		// Remove old temp files
		if ($cleanupTargetDir) {
			if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
				die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
			}

			while (($file = readdir($dir)) !== false) {
				$tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

				// If temp file is current file proceed to the next
				if ($tmpfilePath == "{$filePath}.part") {
					continue;
				}

				// Remove temp file if it is older than the max age and is not the current file
				if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge)) {
					@unlink($tmpfilePath);
				}
			}
			closedir($dir);
		}


		// Open temp file
		if (!$out = @fopen("{$filePath}.part", $chunks ? "ab" : "wb")) {
			die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
		}

		if (!empty($_FILES)) {
			if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
				die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
			}

			// Read binary input stream and append it to temp file
			if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
				die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
			}
		} else {
			if (!$in = @fopen("php://input", "rb")) {
				die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
			}
		}

		while ($buff = fread($in, 4096)) {
			fwrite($out, $buff);
		}

		@fclose($out);
		@fclose($in);

		// Check if file has been uploaded
		if (!$chunks || $chunk == $chunks - 1) {
			// Strip the temp .part suffix off
			rename("{$filePath}.part", $filePath);
		}

		// Return Success JSON-RPC response
		die('{"jsonrpc" : "2.0", "result" : null, "id" : "id"}');

        }


}
