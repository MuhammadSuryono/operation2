<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengajuan extends CI_Controller
{
  public function setuju($id)
  {
    $this->db->select('a.*, p.nama as namaproject, s.nama as namapic, s.kota_asal,
      IF(u.name IS NOT NULL, u.name, (SELECT Nama FROM id_data WHERE Id = a.kareg)) as namakareg,
      IF(u.email IS NOT NULL, u.email, (SELECT Email FROM id_data WHERE Id = a.kareg)) as emailkareg
    ', FALSE);
    $this->db->from('data_pengajuan_sdm a');
    $this->db->join('project p', 'a.project = p.kode');
    $this->db->join('stkb_sdm s', 'a.pic = s.id');
    $this->db->join('user u', 'a.kareg = u.noid');
    $this->db->where('a.id = ' . $id . '');
    $get = $this->db->get()->row_array();

    $update = $this->db->where('id', $id)->update('data_pengajuan_sdm', ['status' => 1, 'tanggal' => date('Y-m-d H:i:s')]);
    if ($update) {
      $this->load->library('email');
      $config = configEmail();
      $message = '
        <p>Pengajuan lintas pulau anda telah <b>di setujui</b>, adapun detail penugasan sebagai berikut:</p>
        <p>
          Nama Project: ' . $get['namaproject'] . ', ' . $get['kareg'] . '<br>
          Nama PIC: ' . $get['pic'] . ' - ' . $get['namapic'] . '<br>
          Asal Kota: ' . $get['kota_asal'] . '<br>
          Penugasan ke: ' . $get['kota_dinas'] . '
        </p>
        <p style="font-size:12px;">Email ini dikirim otomatis melalui Aplikasi Operation 2.</p>
      ';
      $this->email->initialize($config);
      $namaPengirim = 'Manajemen MRI';
      $emailPengirim = 'manajemen@mri-research-ind.com';
      $emailPenerima = $get['emailkareg'];
      $this->email->from($emailPengirim, $namaPengirim);
      $this->email->subject('Pengajuan Lintas Pulau Di Setujui');
      $this->email->set_header('Cc', 'mri.marketing@mri-research-ind.com');
      $this->email->to($emailPenerima);
      $this->email->message($message);
      $this->email->send();

      echo '<center>Pengajuan Lintas Pulau (' . $get['project'] . ' - ' . $get['namaproject'] . ', ' . $get['kareg'] . ' - ' . $get['namakareg'] . ', ' . $get['pic'] . ' - ' . $get['namapic'] . ') <strong style="color:#08d43b;font-weight:bold;">berhasil di setujui!</strong>.</center>';
    } else {
      echo '<center>Pengajuan Lintas Pulau (' . $get['project'] . ' - ' . $get['namaproject'] . ', ' . $get['kareg'] . ' - ' . $get['namakareg'] . ', ' . $get['pic'] . ' - ' . $get['namapic'] . ') <strong style="color:#d42a08;font-weight:bold;">gagal di setujui!</strong>.</center>';
    }
  }

  public function tolak($id)
  {
    $this->db->select('a.*, p.nama as namaproject, s.nama as namapic, s.kota_asal,
        IF(u.name IS NOT NULL, u.name, (SELECT Nama FROM id_data WHERE Id = a.kareg)) as namakareg,
        IF(u.email IS NOT NULL, u.email, (SELECT Email FROM id_data WHERE Id = a.kareg)) as emailkareg
      ', FALSE);
    $this->db->from('data_pengajuan_sdm a');
    $this->db->join('project p', 'a.project = p.kode');
    $this->db->join('stkb_sdm s', 'a.pic = s.id');
    $this->db->join('user u', 'a.kareg = u.noid');
    $this->db->where('a.id = ' . $id . '');
    $get = $this->db->get()->row_array();

    $update = $this->db->where('id', $id)->update('data_pengajuan_sdm', ['status' => 2, 'keterangan' => 'Di Tolak', 'tanggal' => date('Y-m-d H:i:s')]);
    if ($update) {
      $this->load->library('email');
      $config = configEmail();
      $message = '
          <p>Pengajuan lintas pulau anda telah <b>di tolak</b>, adapun detail penugasan sebagai berikut:</p>
          <p>
            Nama Project: ' . $get['namaproject'] . ', ' . $get['kareg'] . '<br>
            Nama PIC: ' . $get['pic'] . ' - ' . $get['namapic'] . '<br>
            Asal Kota: ' . $get['kota_asal'] . '<br>
            Penugasan ke: ' . $get['kota_dinas'] . '
          </p>
          <p style="font-size:12px;">Email ini dikirim otomatis melalui Aplikasi Operation 2.</p>
        ';
      $this->email->initialize($config);
      $namaPengirim = 'Manajemen MRI';
      $emailPengirim = 'manajemen@mri-research-ind.com';
      $emailPenerima = $get['emailkareg'];
      $this->email->from($emailPengirim, $namaPengirim);
      $this->email->subject('Pengajuan Lintas Pulau Di Tolak');
      $this->email->set_header('Cc', 'mri.marketing@mri-research-ind.com');
      $this->email->to($emailPenerima);
      $this->email->message($message);
      $this->email->send();

      echo '<center>Pengajuan Lintas Pulau (' . $get['project'] . ' - ' . $get['namaproject'] . ', ' . $get['kareg'] . ' - ' . $get['namakareg'] . ', ' . $get['pic'] . ' - ' . $get['namapic'] . ') <strong style="color:#08d43b;font-weight:bold;">berhasil di tolak!</strong>.</center>';
    } else {
      echo '<center>Pengajuan Lintas Pulau (' . $get['project'] . ' - ' . $get['namaproject'] . ', ' . $get['kareg'] . ' - ' . $get['namakareg'] . ', ' . $get['pic'] . ' - ' . $get['namapic'] . ') <strong style="color:#d42a08;font-weight:bold;">gagal di tolak!</strong>.</center>';
    }
  }

  public function setuju_training($id)
  {

    $this->load->model('Training_model');
    $training = $this->Training_model->get_training_by_id($id);

    $jumlah_menyetujui = $training['jumlah_menyetujui'] + 1;

    $update = $this->db->query("UPDATE training SET status_pengajuan = 2, jumlah_menyetujui = '$jumlah_menyetujui' WHERE id = '$id'");

    if ($jumlah_menyetujui == 2) {
      $nama = ($training['nama_project']) ? $training['nama_project'] : $training['nama_training'];

      $this->load->library('email');
      $config = configEmail();
      $this->email->initialize($config);
      $namaPengirim = 'Marketing MRI';
      $emailPengirim = 'otomatis@mri-research-ind.com';

      $message = "
      Training $nama yang telah diajukan telah disetujui
    ";

      // $emailPenerima = 'manajemen@mri-research-ind.com';
      $getUser = $this->db->query("SELECT * FROM user WHERE noid = $training[user_update]")->result_array();
      $emailPenerima = [];
      $namaPenerima = [];
      foreach ($getUser as $item) {
        array_push($emailPenerima, $item['email']);
        array_push($namaPenerima, $item['name']);
      }

      $this->email->from($emailPengirim, $namaPengirim);
      $this->email->subject('Informasi Pengajuan Training');
      $this->email->to($emailPenerima, $namaPenerima);
      $this->email->message($message);

      $this->email->send();

      // Undangan


      $data = $this->Training_model->get_materi_training_by_training_id($id);
      $no = 1;
      $message = '
      Anda diundang untuk mengikuti training $nama dengan detail sebagai berikut,
      <h3>Detail Materi</h3>
    <table style="border:1px solid black;border-collapse:collapse;">
      <thead>
        <tr>
          <th style="border:1px solid black;">No</th>
          <th style="border:1px solid black;">Materi</th>
          <th style="border:1px solid black;">Pengisi Materi</th>
          <th style="border:1px solid black;">Tanggal Mulai</th>
          <th style="border:1px solid black;">Jam Mulai</th>
          <th style="border:1px solid black;">Tanggal Selesai</th>
          <th style="border:1px solid black;">Jam Selesai</th>
      </tr>
      </thead>
      <tbody>
      ';

      $no = 1;
      foreach ($data as $item) {
        $message .= '
      <tr>
        <td style="border:1px solid black;"> '  . $no++ . '</td>
        <td style="border:1px solid black;"> '  . $item['materi'] . ' </td>
        <td style="border:1px solid black;"> '  . $item['name'] . ' </td>
        <td style="border:1px solid black;"> '  . $item['tanggal_mulai'] . ' </td>
        <td style="border:1px solid black;"> '  . $item['jam_mulai'] . ' </td>
        <td style="border:1px solid black;"> '  . $item['tanggal_selesai'] . ' </td>
        <td style="border:1px solid black;"> '  . $item['jam_selesai'] . ' </td>
      </tr>
      ';
      }

      $message .= '
    </tbody>
    </table>
    <br>
    ';

      $sdm = $this->Training_model->get_peserta_training_by_training_id($id);
      $emailPenerima = [];
      $namaPenerima = [];
      foreach ($sdm as $item) {
        array_push($emailPenerima, $item['Email']);
        array_push($namaPenerima, $item['Nama']);
      }
      $this->email->from($emailPengirim, $namaPengirim);
      $this->email->subject('Undangan Training');
      $this->email->to($emailPenerima, $namaPenerima);
      $this->email->message($message);
      $this->email->send();
    }



    if ($update) {
      echo '<center>Pengajuan Training <strong style="color:#08d43b;font-weight:bold;">berhasil di setujui!</strong>.</center>';
    } else {
      echo '<center>Pengajuan Training <strong style="color:#08d43b;font-weight:bold;">gagal di setujui!</strong>.</center>';
    }
  }

  public function tolak_training($id)
  {
    $update = $this->db->query("UPDATE training SET status_pengajuan = 3, jumlah_menyetujui = '0' WHERE id = '$id'");

    $this->load->library('email');
    $config = configEmail();
    $this->email->initialize($config);
    $namaPengirim = 'Marketing MRI';
    $emailPengirim = 'otomatis@mri-research-ind.com';

    $training = $this->Training_model->get_training_by_id($id);
    $nama = ($training['nama_project']) ? $training['nama_project'] : $training['nama_training'];

    $message = "
      Training $nama yang telah diajukan telah ditolak
    ";

    $getUser = $this->db->query("SELECT * FROM user WHERE noid = $training[user_update]")->result_array();
    $emailPenerima = [];
    $namaPenerima = [];
    foreach ($getUser as $item) {
      array_push($emailPenerima, $item['email']);
      array_push($namaPenerima, $item['name']);
    }

    $this->email->from($emailPengirim, $namaPengirim);
    $this->email->subject('Informasi Pengajuan Training');
    $this->email->to($emailPenerima, $namaPenerima);
    $this->email->message($message);

    $this->email->send();

    if ($update) {
      echo '<center>Pengajuan Training <strong style="color:#08d43b;font-weight:bold;">berhasil di tolak!</strong>.</center>';
    } else {
      echo '<center>Pengajuan Training <strong style="color:#08d43b;font-weight:bold;">gagal di tolak!</strong>.</center>';
    }
  }
}
