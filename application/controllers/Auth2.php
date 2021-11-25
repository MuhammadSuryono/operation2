    <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth2 extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index(){

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run()==false){
            $this->load->view('auth/index2');
        } else {
            $username = htmlspecialchars( $this->input->post('username'));
            $password = htmlspecialchars( $this->input->post('password'));

            $user = $this->db->get_where('user', ['noid' => $username, 'status' => 1])->row_array();
            // $user = $this->db->get_where('data_user', ['id_user' => $username])->row_array();
            $id_data = $this->db->get_where('id_data', ['Id' => $username])->row_array();

            $id_ebanking = $this->db->get_where('ebanking_shopper', ['user_id' => $username])->row_array();

            // var_dump($id_data['Id']);
            // var_dump($id_data['password']); die;
            
            if($user>=1){

                // if(password_verify($password, $user['password'])){
                if($password == $user['password']){
                    $data =  [
                        'id_user' => $user['noid'],
                        'id_akses' => $user['id_akses'],
                        'id_divisi' => $user['id_divisi']
                    ];

                     $date_now = date('Y-m-d');
                     $date_min2 = date('Y-m-d', strtotime('-3 days'));

                     $date6 = date('Y-m-d', strtotime('-6 days'));
                        
                        $cek = $this->db->query("SELECT * FROM ebanking a JOIN project b ON a.project = b.kode WHERE b.type = 'n' AND tanggal_evaluasi < '$date_now' AND STATUS =0")->result_array();
                        $indus = $this->db->query("SELECT * FROM ebanking a JOIN project b ON a.project = b.kode WHERE b.type = 'i' AND tanggal_evaluasi = '$date_min2' AND status=0")->result_array();

                        $sos = $this->db->query("SELECT * FROM sosmed a JOIN project b ON a.project = b.kode WHERE b.type = 'n' AND tanggal_evaluasi = '$date6' AND status=0")->result_array();

                        if ($cek != NULL) {
                            foreach ($cek as $row) {
                                $this->db->query("UPDATE ebanking SET tanggal_evaluasi = NULL WHERE num='$row[num]'");
                            }
                        }

                        // if ($indus != NULL) {
                        //     foreach ($indus as $cow) {
                        //         $this->db->query("UPDATE ebanking SET tanggal_evaluasi = NULL WHERE num='$cow[num]'");
                        //     }
                        // }

                        if ($sos != NULL) {
                            foreach ($sos as $row) {
                                $this->db->query("UPDATE sosmed SET tanggal_evaluasi = NULL WHERE num='$row[num]'");
                            }
                        }


                    // session 1 admin, 2 shp
                    $this->session->set_userdata($data);
                    if($user['id_akses'] == 1 && $user['id_divisi'] == 1 ){
                        redirect('notifikasi/notifikasiRA');
                    }elseif ($user['id_akses'] == 1 && $user['id_divisi'] == 4) {
                        redirect('validasi/validasidataNew');
                    }elseif ($user['id_akses'] == 1) {
                        redirect('notifikasi/indexpic');
                    } else {
                        redirect('notifikasi');
                    }
                 } else {
                      $this->session->set_flashdata('info', '<div class="alert alert-warning alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            User Id atau Password anda<strong> salah!</strong>.
                            </div>');
                        redirect('auth2');
                    }

            } elseif($id_data>=1) {

                if($password == $id_data['password']){
                    $data =  [
                        'id_user' => $id_data['Id'],
                        'id_akses' => $id_data['id_divisi'],
                        'id_divisi' => 'WIC'
                    ];

                     $date_now = date('Y-m-d');
                     $date_min2 = date('Y-m-d', strtotime('-3 days'));

                     $date6 = date('Y-m-d', strtotime('-6 days'));
                        
                        $cek = $this->db->query("SELECT * FROM ebanking a JOIN project b ON a.project = b.kode WHERE b.type = 'n' AND tanggal_evaluasi < '$date_now' AND STATUS =0")->result_array();
                        $indus = $this->db->query("SELECT * FROM ebanking a JOIN project b ON a.project = b.kode WHERE b.type = 'i' AND tanggal_evaluasi = '$date_min2' AND status=0")->result_array();

                        $sos = $this->db->query("SELECT * FROM sosmed a JOIN project b ON a.project = b.kode WHERE b.type = 'n' AND tanggal_evaluasi = '$date6' AND status=0")->result_array();

                        if ($cek != NULL) {
                            foreach ($cek as $row) {
                                $this->db->query("UPDATE ebanking SET tanggal_evaluasi = NULL WHERE num='$row[num]'");
                            }
                        }

                        // if ($indus != NULL) {
                        //     foreach ($indus as $cow) {
                        //         $this->db->query("UPDATE ebanking SET tanggal_evaluasi = NULL WHERE num='$cow[num]'");
                        //     }
                        // }

                        if ($sos != NULL) {
                            foreach ($sos as $row) {
                                $this->db->query("UPDATE sosmed SET tanggal_evaluasi = NULL WHERE num='$row[num]'");
                            }
                        }

                    $this->session->set_userdata($data);
                    // var_dump($data); die;
                    redirect('notifikasi');
                 } else {
                      $this->session->set_flashdata('info', '<div class="alert alert-warning alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            User Id atau Password anda<strong> salah!</strong>.
                            </div>');
                        redirect('auth2');
                    }

            } elseif($id_ebanking>=1) {

                if($password == $id_ebanking['password']){
                    $data =  [
                        'id_user' => $id_ebanking['user_id'],
                        'id_akses' => 'Ebanking',
                        'id_divisi' => 'Ebanking'
                        
                    ];

                      $date_now = date('Y-m-d');
                     $date_min2 = date('Y-m-d', strtotime('-3 days'));

                     $date6 = date('Y-m-d', strtotime('-6 days'));
                        
                        $cek = $this->db->query("SELECT * FROM ebanking a JOIN project b ON a.project = b.kode WHERE b.type = 'n' AND tanggal_evaluasi < '$date_now' AND STATUS =0")->result_array();
                        $indus = $this->db->query("SELECT * FROM ebanking a JOIN project b ON a.project = b.kode WHERE b.type = 'i' AND tanggal_evaluasi = '$date_min2' AND status=0")->result_array();

                        $sos = $this->db->query("SELECT * FROM sosmed a JOIN project b ON a.project = b.kode WHERE b.type = 'n' AND tanggal_evaluasi = '$date6' AND status=0")->result_array();

                        if ($cek != NULL) {
                            foreach ($cek as $row) {
                                $this->db->query("UPDATE ebanking SET tanggal_evaluasi = NULL WHERE num='$row[num]'");
                            }
                        }

                        // if ($indus != NULL) {
                        //     foreach ($indus as $cow) {
                        //         $this->db->query("UPDATE ebanking SET tanggal_evaluasi = NULL WHERE num='$cow[num]'");
                        //     }
                        // }

                        if ($sos != NULL) {
                            foreach ($sos as $row) {
                                $this->db->query("UPDATE sosmed SET tanggal_evaluasi = NULL WHERE num='$row[num]'");
                            }
                        }
                        
                    $this->session->set_userdata($data);
                    // var_dump($data); die;
                    redirect('notifikasi');
                 } else {
                      $this->session->set_flashdata('info', '<div class="alert alert-warning alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            User Id atau Password anda<strong> salah!</strong>.
                            </div>');
                        redirect('auth2');
                    }

            } else {

                $this->session->set_flashdata('info', '<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                User Id anda belum<strong> didaftarkan!</strong>.
                </div>');
                redirect('auth2');

            }
        }
    }

    public function logout(){
        $this->session->unset_userdata('id_user');
        $this->session->unset_userdata('id_akses');

        $this->session->set_flashdata('info', '<div class="alert alert-warning alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            Anda telah <strong> keluar!</strong>.
                            </div>');
        redirect('auth2');
    }

    
}