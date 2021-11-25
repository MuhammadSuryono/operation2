<?php

class Projectplan_model extends CI_model
{

  public function getByProject($kode)
  {
    // return $this->db->query("SELECT *, bank as bank, DATE_FORMAT(tanggal_project, '%d-%m-%Y') as tanggal, DATE_FORMAT(tanggal_end_project, '%d-%m-%Y') as tanggal2 FROM data_project WHERE id_user=$id LIMIT $start, $limit")->result_array();
    return $this->db->query("SELECT 
                                    a.*, b.kegiatan 
                                FROM
                                    project_plan a
                                    JOIN task b ON a.task_id = b.id
                                WHERE
                                    a.project_kode = '$kode'
                                    ORDER BY a.date_start, a.id
                                ")->result_array();
  }

  public function tambah()
  {
    $data = [
      'project_kode' => $this->input->post('project_kode'),
      'task_id' => $this->input->post('task'),
      'date_start' => $this->input->post('date_start'),
      'date_finish' => $this->input->post('date_finish'),
      'user_add' => $this->session->userdata('id_user'),
      'created_at' => date('Y-m-d H:i:s')
    ];

    $this->db->insert('project_plan', $data);
  }

  public function edit()
  {
    $data = [
      'project_kode' => $this->input->post('project_kode'),
      'task_id' => $this->input->post('task'),
      'date_start' => $this->input->post('date_start'),
      'date_finish' => $this->input->post('date_finish')
    ];

    $this->db->where('id', $this->input->post('id'));
    $this->db->update('project_plan', $data);
  }

  public function delete($id)
  {
    $this->db->delete('project_plan', ['id' => $id]);
  }

  public function getPsByKode($kode)
  {
    return $this->db->get_where('project_spec', array('project_kode' => $kode))->row_array();
  }

  public function countByProject($kode)
  {
    $this->db->select('*');
    $this->db->from('project_plan');
    $this->db->where('project_kode', $kode);
    return $this->db->get()->num_rows();
  }

  public function countPsByProject($kode)
  {
    $this->db->select('*');
    $this->db->from('project_spec');
    $this->db->where('project_kode', $kode);
    return $this->db->get()->num_rows();
  }

  public function tambahProjectSpec()
  {
    $kode = $this->input->post('project_kode');
    $project = $this->db->query("SELECT * FROM project WHERE kode = '$kode'")->row_array();
    $namaProject = $project['nama'];

    $ket = "&lt;table cellspacing=&quot;0&quot; class=&quot;tbl-spec&quot; width=&quot;100%&quot;&gt;
        &lt;tbody&gt;&lt;tr&gt;
          &lt;td rowspan=&quot;8&quot; class=&quot;tbl-logo&quot; width=&quot;25%&quot;&gt;&lt;img src=&quot;http://180.211.92.131/dev-digital-market/images/logo.png&quot; width=&quot;150px&quot; height=&quot;150px&quot;&gt;&lt;/td&gt;
          &lt;td class=&quot;b-t b-l b-r&quot; width=&quot;25%&quot;&gt;&amp;nbsp;Project Name&lt;/td&gt;
          &lt;td class=&quot;b-t b-r&quot; width=&quot;25%&quot;&gt;&amp;nbsp;:&amp;nbsp;$namaProject&lt;/td&gt;
          &lt;td class=&quot;b-t b-r&quot; width=&quot;10%&quot;&gt;Distribusi&lt;/td&gt;
          &lt;td class=&quot;b-t b-r&quot; width=&quot;15%&quot;&gt;&lt;/td&gt;
        &lt;/tr&gt;

        &lt;tr&gt;
          &lt;td class=&quot;b-t b-l b-r&quot; width=&quot;25%&quot;&gt;&amp;nbsp;Project No&lt;/td&gt;
          &lt;td class=&quot;b-t b-r&quot; width=&quot;25%&quot;&gt;&amp;nbsp;:&amp;nbsp;&lt;/td&gt;
          &lt;td class=&quot;b-t b-r&quot; width=&quot;10%&quot;&gt;&amp;nbsp;F. Director&lt;/td&gt;
          &lt;td class=&quot;b-t b-r&quot; width=&quot;15%&quot;&gt;&amp;nbsp;(1)&lt;/td&gt;
        &lt;/tr&gt;
        &lt;tr&gt;
          &lt;td class=&quot;b-t b-l b-r&quot; width=&quot;25%&quot;&gt;&amp;nbsp;Date&lt;/td&gt;
          &lt;td class=&quot;b-t b-r&quot; width=&quot;25%&quot;&gt;&amp;nbsp;:&amp;nbsp;&lt;/td&gt;
          &lt;td class=&quot;b-t b-r&quot; width=&quot;10%&quot;&gt;&amp;nbsp;Validasi&lt;/td&gt;
          &lt;td class=&quot;b-t b-r&quot; width=&quot;15%&quot;&gt;&amp;nbsp;(2)&lt;/td&gt;
        &lt;/tr&gt;
        &lt;tr&gt;
          &lt;td class=&quot;b-t b-l b-r&quot; width=&quot;25%&quot;&gt;&amp;nbsp;Exec&lt;/td&gt;
          &lt;td class=&quot;b-t b-r&quot; width=&quot;25%&quot;&gt;&amp;nbsp;:&amp;nbsp;&lt;/td&gt;
          &lt;td class=&quot;b-t b-r&quot; width=&quot;10%&quot;&gt;&amp;nbsp;SPV&lt;/td&gt;
          &lt;td class=&quot;b-t b-r&quot; width=&quot;15%&quot;&gt;&amp;nbsp;(3)&lt;/td&gt;
        &lt;/tr&gt;
        &lt;tr&gt;
          &lt;td class=&quot;b-t b-l b-r&quot; width=&quot;25%&quot;&gt;&amp;nbsp;R. MGR&lt;/td&gt;
          &lt;td class=&quot;b-t b-r&quot; width=&quot;25%&quot;&gt;&amp;nbsp;:&amp;nbsp;&lt;/td&gt;
          &lt;td class=&quot;b-t b-r&quot; width=&quot;10%&quot;&gt;&amp;nbsp;Finance&lt;/td&gt;
          &lt;td class=&quot;b-t b-r&quot; width=&quot;15%&quot;&gt;&amp;nbsp;(4)&lt;/td&gt;
        &lt;/tr&gt;
        &lt;tr&gt;
          &lt;td class=&quot;b-t b-l b-r&quot; width=&quot;25%&quot;&gt;&amp;nbsp;SPV/AFM&lt;/td&gt;
          &lt;td class=&quot;b-t b-r&quot; width=&quot;25%&quot;&gt;&amp;nbsp;:&amp;nbsp;&lt;/td&gt;
          &lt;td class=&quot;b-t b-r&quot; width=&quot;10%&quot;&gt;&amp;nbsp;Coder&lt;/td&gt;
          &lt;td class=&quot;b-t b-r&quot; width=&quot;15%&quot;&gt;&amp;nbsp;(5)&lt;/td&gt;
        &lt;/tr&gt;
        &lt;tr&gt;
          &lt;td class=&quot;b-t b-l b-r&quot; width=&quot;25%&quot;&gt;&amp;nbsp;DP&lt;/td&gt;
          &lt;td class=&quot;b-t b-r&quot; width=&quot;25%&quot;&gt;&amp;nbsp;:&amp;nbsp;&lt;/td&gt;
          &lt;td class=&quot;b-t b-r&quot; width=&quot;10%&quot;&gt;&amp;nbsp;DP&lt;/td&gt;
          &lt;td class=&quot;b-t b-r&quot; width=&quot;15%&quot;&gt;&amp;nbsp;(6)&lt;/td&gt;
        &lt;/tr&gt;
       
        &lt;/tbody&gt;&lt;/table&gt;&lt;div id=&quot;listPP&quot;&gt;&lt;table cellspacing=&quot;0&quot; class=&quot;tbl-spec&quot; width=&quot;100%&quot;&gt;
      &lt;tbody&gt;&lt;tr class=&quot;bg-b&quot;&gt;
        &lt;td class=&quot;b-t b-l text-center&quot; width=&quot;25%&quot;&gt;&lt;b&gt;Schedule Details&lt;/b&gt;&lt;/td&gt;
        &lt;td class=&quot;b-t b-l b-r text-center&quot; width=&quot;25%&quot;&gt;&lt;b&gt;Date&lt;/b&gt;&lt;/td&gt;
        &lt;td class=&quot;b-t b-r text-center&quot; width=&quot;25%&quot;&gt;&lt;b&gt;Schedule Details&lt;/b&gt;&lt;/td&gt;
        &lt;td class=&quot;b-t b-r text-center&quot; width=&quot;25%&quot;&gt;&lt;b&gt;Date&lt;/b&gt;&lt;/td&gt;
      &lt;/tr&gt;&lt;tr&gt;&lt;td class=&quot;b-t b-l&quot; width=&quot;25%&quot;&gt;Project Spec&lt;/td&gt;&lt;td class=&quot;b-t b-l b-r text-center&quot; width=&quot;25%&quot;&gt;&lt;/td&gt;&lt;td class=&quot;b-t b-r&quot; width=&quot;25%&quot;&gt;Briefing&lt;/td&gt;&lt;td class=&quot;b-t b-r text-center&quot; width=&quot;25%&quot;&gt;&lt;/td&gt;&lt;/tr&gt;&lt;tr&gt;&lt;td class=&quot;b-t b-l&quot; width=&quot;25%&quot;&gt;Membuat Dokumen&lt;/td&gt;&lt;td class=&quot;b-t b-l b-r text-center&quot; width=&quot;25%&quot;&gt;&lt;/td&gt;&lt;td class=&quot;b-t b-r&quot; width=&quot;25%&quot;&gt;Pemesanan Tiket&lt;/td&gt;&lt;td class=&quot;b-t b-r text-center&quot; width=&quot;25%&quot;&gt;&lt;/td&gt;&lt;/tr&gt;&lt;tr&gt;&lt;td class=&quot;b-t b-l&quot; width=&quot;25%&quot;&gt;Meeting Huhi&lt;/td&gt;&lt;td class=&quot;b-t b-l b-r text-center&quot; width=&quot;25%&quot;&gt;&lt;/td&gt;&lt;td class=&quot;b-t b-r&quot; width=&quot;25%&quot;&gt;Booking Hotel&lt;/td&gt;&lt;td class=&quot;b-t b-r text-center&quot; width=&quot;25%&quot;&gt;&lt;/td&gt;&lt;/tr&gt;&lt;tr&gt;&lt;td class=&quot;b-t b-l&quot; width=&quot;25%&quot;&gt;Persiapan Alat&lt;/td&gt;&lt;td class=&quot;b-t b-l b-r text-center&quot; width=&quot;25%&quot;&gt;&lt;/td&gt;&lt;td class=&quot;b-t b-r&quot; width=&quot;25%&quot;&gt;Field Start&lt;/td&gt;&lt;td class=&quot;b-t b-r text-center&quot; width=&quot;25%&quot;&gt;&lt;/td&gt;&lt;/tr&gt;&lt;/tbody&gt;&lt;/table&gt;&lt;/div&gt;&lt;table cellspacing=&quot;0&quot; class=&quot;tbl-spec&quot;&gt;&lt;tbody&gt;&lt;tr&gt;
          &lt;td class=&quot;b-all&quot; colspan=&quot;5&quot;&gt;
            &lt;ul class=&quot;mt-3&quot;&gt;
            <br>
            &lt;/ul&gt;
          &lt;/td&gt;
        &lt;/tr&gt;
        &lt;tr&gt;
          &lt;td class=&quot;b-b b-l b-r&quot; colspan=&quot;5&quot;&gt;
            &lt;table width=&quot;100%&quot;&gt;
              &lt;tbody&gt;&lt;tr&gt;
                &lt;td class=&quot;text-center&quot; width=&quot;33.3%&quot;&gt;Created by:&lt;br&gt;&lt;br&gt;&lt;br&gt;&lt;br&gt;&lt;/td&gt;
                &lt;td class=&quot;b-l b-r text-center&quot; width=&quot;33.3%&quot;&gt;Checked by:&lt;br&gt;&lt;br&gt;&lt;br&gt;&lt;br&gt;&lt;/td&gt;
                &lt;td class=&quot;text-center&quot; width=&quot;33.3%&quot;&gt;Approved by:&lt;br&gt;&lt;br&gt;&lt;br&gt;&lt;br&gt;&lt;/td&gt;
              &lt;/tr&gt;
              &lt;tr&gt;
                &lt;td class=&quot;text-center&quot; id=&quot;createdbycolumn&quot; width=&quot;33.3%&quot;&gt;_______________&lt;/td&gt;
                &lt;td class=&quot;b-l b-r text-center&quot; id=&quot;checkedbycolumn&quot; width=&quot;33.3%&quot;&gt;_______________&lt;/td&gt;
                &lt;td class=&quot;text-center&quot; id=&quot;approvedbycolumn&quot; width=&quot;33.3%&quot;&gt;_______________&lt;/td&gt;
              &lt;/tr&gt;
            &lt;/tbody&gt;&lt;/table&gt;
          &lt;/td&gt;
        &lt;/tr&gt;
      &lt;/tbody&gt;&lt;/table&gt;";

    $data = [
      'project_kode' => $this->input->post('project_kode'),
      'keterangan' => $ket,
      'user_created' => $this->session->userdata('id_user'),
      'created_at' => date('Y-m-d H:i:s')
    ];

    $this->db->insert('project_spec', $data);
  }

   // &lt;tr&gt;
   //        &lt;td class=&quot;b-t b-l b-r&quot; width=&quot;25%&quot;&gt;&lt;/td&gt;
   //        &lt;td class=&quot;b-t b-r&quot; width=&quot;25%&quot;&gt;&lt;/td&gt;
   //        &lt;td class=&quot;b-t b-r&quot; width=&quot;10%&quot;&gt;&amp;nbsp;Puncher&lt;/td&gt;
   //        &lt;td class=&quot;b-t b-r&quot; width=&quot;15%&quot;&gt;&amp;nbsp;(7)&lt;/td&gt;
   //      &lt;/tr&gt;

  public function updateSpec($kode)
  {
    $data = array(
      "keterangan" => htmlspecialchars($this->input->post('keterangan'), ENT_QUOTES),
      // "tgl_mulai"  => $this->input->post('tgl_mulai', true),
      // "tgl_selesai"  => $this->input->post('tgl_selesai', true),
      "save" => 1
    );

    $this->db->where('project_kode', $kode);
    $this->db->update('project_spec', $data);
  }

  public function checkSpec($kode)
  {

    $data = array(
      'user_checked' => $this->session->userdata('id_user'),
      'checked_at' => date('Y-m-d H:i:s')
    );

    $this->db->where('project_kode', $kode);
    $this->db->update('project_spec', $data);
  }

  public function approveSpec($kode)
  {

    $data = array(
      'user_approved' => $this->session->userdata('id_user'),
      'on_revision_status' => 0,
      'approved_at' => date('Y-m-d H:i:s')
    );

    $this->db->where('project_kode', $kode);
    $this->db->update('project_spec', $data);
  }

  public function revisionSpec($kode)
  {

    $data = array(
      'on_revision_status' => 1
    );

    $this->db->where('project_kode', $kode);
    $this->db->update('project_spec', $data);
  }

  public function updatePP($kode)
  {
    error_reporting(0);
    // $pp = $this->db->query("SELECT id FROM project_plan WHERE project_kode = '$kode'")->row_array();
    $this->db->select('project_plan.date_start as ds, project_plan.date_finish as df, task.kegiatan as kg');
    $this->db->from('project_plan');
    $this->db->join('task', 'task.id = project_plan.task_id');
    $this->db->where('project_plan.project_kode', $kode);
    $this->db->order_by('project_plan.date_start', 'ASC');
    $data = $this->db->get()->result_array();
    $bagi = ceil(count($data) / 2);
    $listPP = array_chunk($data, $bagi);

    // return $data;

    $ket = '<table cellspacing="0" class="tbl-spec" width="100%">
          <tr class="bg-b">
            <td class="b-t b-l text-center" width="25%"><b>Schedule Details</b></td>
            <td class="b-t b-l b-r text-center" width="25%"><b>Date</b></td>
            <td class="b-t b-r text-center" width="25%"><b>Schedule Details</b></td>
            <td class="b-t b-r text-center" width="25%"><b>Date</b></td>
          </tr>';
    for ($i = 0; $i < $bagi; $i++) {
      $tglkiri = '';
      $tglkanan = '';
      if ($listPP[0][$i]['ds'] != 0 and $listPP[0][$i]['df'] != 0) {
        $tglkiri = $listPP[0][$i]['ds'] . ' - ' . $listPP[0][$i]['df'];
      }
      if ($listPP[1][$i]['ds'] != 0 and $listPP[1][$i]['df'] != 0) {
        $tglkanan = $listPP[1][$i]['ds'] . ' - ' . $listPP[1][$i]['df'];
      }
      $ket .= '<tr><td class="b-t b-l" width="25%">' . $listPP[0][$i]['kg'] . '</td><td class="b-t b-l b-r text-center" width="25%">' . $tglkiri . '</td><td class="b-t b-r" width="25%">' . $listPP[1][$i]['kg'] . '</td><td class="b-t b-r text-center" width="25%">' . $tglkanan . '</td></tr>';
    }
    $ket .= '</table>';

    if (count($data) > 0) {
      return $ket;
    } else {
      echo 'error';
    }
  }

  public function updateUserSpec($kode)
  {
    error_reporting(0);
    // $pp = $this->db->query("SELECT id FROM project_plan WHERE project_kode = '$kode'")->row_array();
    $this->db->select('*');
    $this->db->from('project_spec');
    $this->db->where('project_kode', $kode);
    return $this->db->get()->row_array();


    // $bagi = ceil(count($data) / 2);
    // $listPP = array_chunk($data, $bagi);

    // // return $data;

    // $ket = '<table cellspacing="0" class="tbl-spec" width="100%">
    //       <tr class="bg-b">
    //         <td class="b-t b-l text-center" width="25%"><b>Schedule Details</b></td>
    //         <td class="b-t b-l b-r text-center" width="25%"><b>Date</b></td>
    //         <td class="b-t b-r text-center" width="25%"><b>Schedule Details</b></td>
    //         <td class="b-t b-r text-center" width="25%"><b>Date</b></td>
    //       </tr>';
    // for ($i = 0; $i < $bagi; $i++) {
    //   $tglkiri = '';
    //   $tglkanan = '';
    //   if ($listPP[0][$i]['ds'] != 0 and $listPP[0][$i]['df'] != 0) {
    //     $tglkiri = $listPP[0][$i]['ds'] . ' - ' . $listPP[0][$i]['df'];
    //   }
    //   if ($listPP[1][$i]['ds'] != 0 and $listPP[1][$i]['df'] != 0) {
    //     $tglkanan = $listPP[1][$i]['ds'] . ' - ' . $listPP[1][$i]['df'];
    //   }
    //   $ket .= '<tr><td class="b-t b-l" width="25%">' . $listPP[0][$i]['kg'] . '</td><td class="b-t b-l b-r text-center" width="25%">' . $tglkiri . '</td><td class="b-t b-r" width="25%">' . $listPP[1][$i]['kg'] . '</td><td class="b-t b-r text-center" width="25%">' . $tglkanan . '</td></tr>';
    // }
    // $ket .= '</table>';

    // if (count($data) > 0) {
    //   return $ket;
    // } else {
    //   echo 'error';
    // }
  }
}
