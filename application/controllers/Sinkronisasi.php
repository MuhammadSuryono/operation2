<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sinkronisasi extends CI_Controller
{

	public function index()
	{
    date_default_timezone_set('Asia/Jakarta');

        $db_cl = $this->load->database('db_client', TRUE);

		$all = $db_cl->select('kode')->get_where('project', array('visible' => 'y', 'type' => 'n'))->result_array();
		// var_dump($all);

		$poll = [];
		foreach ($all as $row) {
			$poll[] = $row['kode'];
		}
		// var_dump($poll);
		$db_cl->where_in('project', $poll)->delete('cabang');
		$db_cl->where_in('id_project', $poll)->delete('data_waktu_td');
		$db_cl->where_in('project', $poll)->delete('data_foto_temuan');
		$db_cl->where_in('project_kode', $poll)->delete('project_plan');
		$db_cl->where_in('project', $poll)->delete('quest');

		$cabang = $this->db->where_in('project', $poll)->get('cabang')->result_array();
		$td = $this->db->where_in('id_project', $poll)->get('data_waktu_td')->result_array();
		$temuan = $this->db->where_in('project', $poll)->get('data_foto_temuan')->result_array();
		$plan = $this->db->where_in('project_kode', $poll)->get('project_plan')->result_array();
		$quest = $this->db->where_in('project', $poll)->get('quest')->result_array();

		foreach ($cabang as $cb) {
            $data1 = [
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
        $db_cl->insert('cabang', $data1);
        
        }
        // $db_cl->insert_batch('cabang', $data2);

        foreach ($td as $ted) {
        	$data2 = [
        			'id_waktu' => $ted['id_waktu'],
        			'user_entry' => $ted['user_entry'],
        			'id_project' => $ted['id_project'],
        			'kode_cabang' => $ted['kode_cabang'],
        			'id_skenario' => $ted['id_skenario'],
        			'kapan_isi_form' => $ted['kapan_isi_form'],
        			'jenis_form' => $ted['jenis_form'],
        			'kondisi_pengisian' => $ted['kondisi_pengisian'],
        			'proses' => $ted['proses'],
        			'timestamp' => $ted['timestamp'],
        			'waktu' => $ted['waktu'],
        			'akhir_td' => $ted['akhir_td'],
        			'full' => $ted['full'],
        			'part_1' => $ted['part_1'],
        			'part_2' => $ted['part_2'],
        			'ket_interupsi' => $ted['ket_interupsi'],
        			'temuan' => $ted['temuan'],
        			'status_td' => $ted['status_td'],
        			'revisi_ra' => $ted['revisi_ra'],
        			'alasan_revisi' => $ted['alasan_revisi'],
        			'user_revisi' => $ted['user_revisi'],
        			'tanggal_revisi' => $ted['tanggal_revisi']
        			];
        $db_cl->insert('data_waktu_td', $data2);

        }

        foreach ($temuan as $tem) {
        	$data3 = [
        			'num' => $tem['num'],
        			'shp' => $tem['shp'],
        			'project' => $tem['project'],
        			'cabang' => $tem['cabang'],
        			'kunjungan' => $tem['kunjungan'],
        			'skenario' => $tem['skenario'],
        			'ket_temuan' => $tem['ket_temuan'],
        			'foto_temuan' => $tem['foto_temuan']
        			];
        $db_cl->insert('data_foto_temuan', $data3);
        }


        foreach ($plan as $pl) {
            $data4 = [
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
        $db_cl->insert('project_plan', $data4);
        
        }

        foreach ($quest as $que) {
        	$data5 = [
        			'num' => $que['num'],
        			'project' => $que['project'],
        			'cabang' => $que['cabang'],
        			'kunjungan' => $que['kunjungan'],
        			'tanggal' => $que['tanggal'],
        			'status' => $que['status'],
        			'r_kategori' => $que['r_kategori'],
        			'publish' => $que['publish'],
        			'user_publish' => $que['user_publish'],
        			'kol_jenis' => $que['kol_jenis'],
                    'kol_td' => $que['kol_td'],
                    'kol_temuan' => $que['kol_temuan']

                    ];
        $db_cl->insert('quest', $data5);
        	
        }

        $waktu = date('Y-m-d H:i:s');
        $this->db->query("INSERT into last_sinkron (`time`) VALUES ('$waktu')");
        // $db_cl->insert_batch('project_plan', $data3);



	}


	public function refresh()
	{
    date_default_timezone_set('Asia/Jakarta');

        $db_cl = $this->load->database('db_client', TRUE);

		$all = $this->db->select('kode')->get_where('project', array('visible' => 'y', 'type' => 'n'))->result_array();
		// var_dump($all);

		$poll = [];
		foreach ($all as $row) {
			$poll[] = $row['kode'];
		}
		// var_dump($poll);
		$db_cl->where_in('project', $poll)->delete('cabang');
		$db_cl->where_in('id_project', $poll)->delete('data_waktu_td');
		$db_cl->where_in('project', $poll)->delete('data_foto_temuan');
		$db_cl->where_in('project_kode', $poll)->delete('project_plan');
		$db_cl->where_in('project', $poll)->delete('quest');

		$cabang = $this->db->where_in('project', $poll)->get('cabang')->result_array();
		$td = $this->db->where_in('id_project', $poll)->get('data_waktu_td')->result_array();
		$temuan = $this->db->where_in('project', $poll)->get('data_foto_temuan')->result_array();
		$plan = $this->db->where_in('project_kode', $poll)->get('project_plan')->result_array();
		$quest = $this->db->where_in('project', $poll)->get('quest')->result_array();

		foreach ($cabang as $cb) {
            $data1 = [
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
        $db_cl->insert('cabang', $data1);
        
        }
        // $db_cl->insert_batch('cabang', $data2);

        foreach ($td as $ted) {
        	$data2 = [
        			'id_waktu' => $ted['id_waktu'],
        			'user_entry' => $ted['user_entry'],
        			'id_project' => $ted['id_project'],
        			'kode_cabang' => $ted['kode_cabang'],
        			'id_skenario' => $ted['id_skenario'],
        			'kapan_isi_form' => $ted['kapan_isi_form'],
        			'jenis_form' => $ted['jenis_form'],
        			'kondisi_pengisian' => $ted['kondisi_pengisian'],
        			'proses' => $ted['proses'],
        			'timestamp' => $ted['timestamp'],
        			'waktu' => $ted['waktu'],
        			'akhir_td' => $ted['akhir_td'],
        			'full' => $ted['full'],
        			'part_1' => $ted['part_1'],
        			'part_2' => $ted['part_2'],
        			'ket_interupsi' => $ted['ket_interupsi'],
        			'temuan' => $ted['temuan'],
        			'status_td' => $ted['status_td'],
        			'revisi_ra' => $ted['revisi_ra'],
        			'alasan_revisi' => $ted['alasan_revisi'],
        			'user_revisi' => $ted['user_revisi'],
        			'tanggal_revisi' => $ted['tanggal_revisi']
        			];
        $db_cl->insert('data_waktu_td', $data2);

        }

        foreach ($temuan as $tem) {
        	$data3 = [
        			'num' => $tem['num'],
        			'shp' => $tem['shp'],
        			'project' => $tem['project'],
        			'cabang' => $tem['cabang'],
        			'kunjungan' => $tem['kunjungan'],
        			'skenario' => $tem['skenario'],
        			'ket_temuan' => $tem['ket_temuan'],
        			'foto_temuan' => $tem['foto_temuan']
        			];
        $db_cl->insert('data_foto_temuan', $data3);
        }


        foreach ($plan as $pl) {
            $data4 = [
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
        $db_cl->insert('project_plan', $data4);
        
        }

        foreach ($quest as $que) {
        	$data5 = [
        			'num' => $que['num'],
        			'project' => $que['project'],
        			'cabang' => $que['cabang'],
        			'kunjungan' => $que['kunjungan'],
        			'tanggal' => $que['tanggal'],
        			'status' => $que['status'],
        			'r_kategori' => $que['r_kategori'],
        			'publish' => $que['publish'],
        			'user_publish' => $que['user_publish'],
                    'kol_jenis' => $que['kol_jenis'],
                    'kol_td' => $que['kol_td'],
                    'kol_temuan' => $que['kol_temuan']
        			];
        $db_cl->insert('quest', $data5);
        	
        }

        $waktu = date('Y-m-d H:i:s');
        $this->db->query("INSERT into last_sinkron (`time`) VALUES ('$waktu')");


        // $db_cl->insert_batch('project_plan', $data3);

        $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong> Berhasil Sinkronisasi Data ke Dashboard Client.</strong>
              </div>');
        redirect('project/report');
	}


}
?>