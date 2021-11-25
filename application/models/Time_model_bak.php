<?php

class Time_model extends CI_model
{
    public function getdatatd_sort_sk($id)
    {
        // return $this->db->get_where('data_td',['id_project'=>$id])->result_array();
        // return $this->db->query("SELECT a.id_skenario, b.nama FROM data_td a JOIN attribute b ON a.id_skenario = b.kode WHERE id_project =$id GROUP BY a.id_skenario")->result_array();
        $this->db->select('a.id_skenario sk, b.nama name');
        $this->db->from('data_td a');
        $this->db->join('attribute b', 'a.id_skenario = b.kode');
        $this->db->where('a.id_project', $id);
        $this->db->group_by('sk');
        return $this->db->get()->result_array();
    }

    public function getdatatd_sort_piltd($id, $ske)
    {

        $this->db->where('id_project', $id);
        $this->db->where('id_skenario', $ske);
        $this->db->order_by('id_td');
        return $this->db->get('data_td')->result_array();
    }

    public function getjumcabang($id)
    {
        $this->db->order_by('kode');
        return $this->db->get_where('cabang', ['project'=>$id])->result_array();
    }

    public function getdatatd_report($id, $ske)
    {

        $this->db->where('id_project', $id);
        $this->db->where('id_skenario', $ske);
        $this->db->order_by('kode_cabang');
        return $this->db->get('data_waktu_td')->result_array();    

    }

    public function getdatatd_report_sum($id, $ske)
    {
    
    $data = [];

    $data1 = $this->db->query("SELECT 
                                jenis_form,
                                kondisi_pengisian,
                                SEC_TO_TIME( 
                                    AVG(TIME_TO_SEC( `full` ))) rtd
                                    
                            FROM 
                                data_waktu_td 
                            WHERE 
                                id_project = '$id' 
                                AND id_skenario = '$ske' 
                                AND jenis_form = 'paper (manual)' 
                                AND kondisi_pengisian = 'Tuntas isi form saat antri'")->row_array();
                                
    array_push($data, $data1);

    $data2 = $this->db->query("SELECT
                                jenis_form,
                                kondisi_pengisian,
                                SEC_TO_TIME(
                                    AVG(
                                    TIME_TO_SEC( `full` )))	rtd	
                                    
                            FROM
                                data_waktu_td 
                            WHERE
                                id_project = '$id' 
                                AND id_skenario = '$ske'
                                AND jenis_form = 'paper (manual)'
                                AND kondisi_pengisian = 'Tidak tuntas lanjut di CS'")->row_array();
    
    array_push($data, $data2);
    
    $data3 = $this->db->query("SELECT
                                jenis_form,
                                kondisi_pengisian,
                                SEC_TO_TIME(
                                    AVG(
                                    TIME_TO_SEC( `full` )))	rtd	
                                    
                            FROM
                                data_waktu_td 
                            WHERE
                                id_project = '$id' 
                                AND id_skenario = '$ske'
                                AND jenis_form = 'paper (manual)'
                                AND kondisi_pengisian = 'Tidak isi form saat antri'")->row_array();

    array_push($data, $data3);

    $data4 = $this->db->query("SELECT 
                                jenis_form,
                                kondisi_pengisian,
                                SEC_TO_TIME( 
                                    AVG(TIME_TO_SEC( `full` ))) rtd
                                    
                            FROM 
                                data_waktu_td 
                            WHERE 
                                id_project = '$id' 
                                AND id_skenario = '$ske' 
                                AND jenis_form = 'eform' 
                                AND kondisi_pengisian = 'Tuntas isi form saat antri'")->row_array();
                                
    array_push($data, $data4);

    $data5 = $this->db->query("SELECT
                                jenis_form,
                                kondisi_pengisian,
                                SEC_TO_TIME(
                                    AVG(
                                    TIME_TO_SEC( `full` )))	rtd	
                                    
                            FROM
                                data_waktu_td 
                            WHERE
                                id_project = '$id' 
                                AND id_skenario = '$ske'
                                AND jenis_form = 'eform'
                                AND kondisi_pengisian = 'Tidak tuntas lanjut di CS'")->row_array();
    
    array_push($data, $data5);
    
    $data6 = $this->db->query("SELECT
                                jenis_form,
                                kondisi_pengisian,
                                SEC_TO_TIME(
                                    AVG(
                                    TIME_TO_SEC( `full` )))	rtd	
                                    
                            FROM
                                data_waktu_td 
                            WHERE
                                id_project = '$id' 
                                AND id_skenario = '$ske'
                                AND jenis_form = 'eform'
                                AND kondisi_pengisian = 'Tidak isi form saat antri'")->row_array();

    array_push($data, $data6);
    
    return $data;

    }

    public function getdatawaktutd($id, $ske)
    {
        $this->db->where('id_project', $id);
        $this->db->where('id_skenario', $ske);
        $this->db->group_by('id_project');
        $this->db->group_by('id_skenario');
        $this->db->group_by('kode_cabang');
        return $this->db->get('data_waktu_td')->result_array();
    }

    public function tambah(){
        $user = $this->session->userdata('id_user');
        $sek = $this->input->post('id_skenario');
        $jml = $this->input->post('jmlpil');
        $data = [];
        $data2 = [];
        for($i=1;$i<=$jml; $i++){
            $pilihantd = htmlspecialchars($this->input->post("pil$i"));
            $data1 = [
                'id_skenario' => $sek,
                'id_pembuat' => $user,
                'pilihan_td' => $pilihantd,
            ];

            array_push($data, $data1);
            array_push($data2, $pilihantd);
        }
        $this->db->insert_batch('data_td', $data);

        $r=0;
        $var = count($data2)-1;
        // var_dump(count($data2)); die;
        $query = "ALTER TABLE data_waktu_td ";
        for($r=0;$r<=$var; $r++){
            $field = str_replace(" ","_",$data2[$r]);
            $query .= "ADD $field time";
            if($r!=$var){
                $query .= ", ";
            } else {
                $query .= ";";
            }
            // $r++;
        }

        $this->db->query($query);
    }

    public function getallproject()
    {
      $db2 = $this->load->database('database_kedua', TRUE);
      $db2->select('*');
      $db2->from('project');
      $db2->where('visible', 'y');
      $db2->where('type', 'i');
    //   $db2->where('type', 'n');
      $db2->order_by('nama', 'ASC');
      return $db2->get()->result_array();
    }

    public function getattribute(){
        return $this->db->get_where('attribute', ['timedelivery'=>1])->result_array();
    }

    public function getdaftarcabang($id, $sken)
    {

      return $this->db->query("
                        SELECT
                        	a.project,
                        	a.kode,
                        	a.nama,
                        	a.id_skenario 
                        FROM
                        	report_td a 
                        WHERE
                            a.project = '$id'
                            AND a.id_skenario = '$sken'
                        	AND NOT EXISTS (
                        	    SELECT
                        	    	b.waktu 
                        	    FROM
                        	    	data_waktu_td b 
                        	    WHERE
                        	    	a.project = b.id_project 
                        	    	AND a.kode = b.kode_cabang 
                        	    	AND a.id_skenario = b.id_skenario 
                        	    ) GROUP BY a.project, a.kode")->result_array();


    }


    public function getAllDataTime(){
        $colom = $this->db->query("SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='mri_operation' AND `TABLE_NAME`='data_waktu_td'")->result_array();

        $isi = $this->db->query("SELECT a.*, b.nama_project, c.nama_user, d.nama_cabang, e.nama_skenario from data_skenario e join ( data_cabang d join  ( data_user c join (data_waktu_td a join data_project b on a.id_project=b.id_project) on c.id_user = a.id_user ) on a.kode_cabang = d.kode_cabang) on a.id_skenario = e.id_skenario")->result_array();

        return array(
            'kolom' => $colom,
            'isi' => $isi,
        );
    }

    public function getIsiAllDataTime($id){
        return $this->db->query("SELECT a.*, b.nama_project, c.nama_user, d.nama_cabang, e.nama_skenario from data_skenario e join ( data_cabang d join  ( data_user c join (data_waktu_td a join data_project b on a.id_project=b.id_project) on c.id_user = a.id_user ) on a.kode_cabang = d.kode_cabang) on a.id_skenario = e.id_skenario where a.id_project = $id")->result_array();
    }

    public function hapus($id){
        var_dump($this->db->get_where('data_waktu_td', ['id_waktu' => $id])->row_array());
    }

    // MENYIMPAN DATA SKENARIO DARI VIEW INDEXA (INPUT HIDUP)
    public function skenarioA(){
        $data = [
            'nama_skenario' => htmlspecialchars($this->input->post('skenario')),
        ];

        $this->db->insert('a_data_skenario', $data);
    }
    // AKHIR

    public function tambahA(){
        $user = $this->session->userdata('id_user');
        $pro = $this->input->post('project');
        $sek = $this->input->post('attribute');
        $jml = $this->input->post('jmlpil');
        $data = [];
        for($i=1;$i<=$jml; $i++){
            $pilihantd = htmlspecialchars($this->input->post("pil$i"));
            $data1 = [
                'id_project' => $pro,
                'id_skenario' => $sek,
                'id_pembuat' => $user,
                'pilihan_td' => $pilihantd,
            ];

            array_push($data, $data1);
        }
        $this->db->insert_batch('data_td', $data);
    }

    public function getcbg_tdedit($id, $sken){
               
        return $this->db->query("SELECT
                                    a.*,
                                    b.nama 
                                FROM
                                    (SELECT
                                      *
                                    FROM 
                                        data_waktu_td
                                    WHERE
                                        id_project = '$id'
                                        AND id_skenario = '$sken' 
                                        GROUP BY
                                    kode_cabang
                                    ) a
                                    JOIN cabang b ON a.id_project = b.project AND a.kode_cabang = b.kode")->result_array();
                                    
    }

    public function getdata_tdedit($pro, $sken, $cbg){

        return $this->db->query("SELECT
                                    a.*,
                                    b.waktu as start_td,
                                    b.akhir_td,
                                    b.part_1
                                FROM
                                    data_waktu_td a
                                    JOIN data_waktu_timestamp b ON a.id_project = b.id_project 
                                    AND a.kode_cabang = b.kode_cabang 
                                    AND a.id_skenario = b.id_skenario
                                    AND a.proses = b.proses
                                WHERE
                                    a.id_project = '$pro' 
                                    AND a.id_skenario = '$sken' 
                                    AND a.kode_cabang = '$cbg'")->result_array();

    }
    
}