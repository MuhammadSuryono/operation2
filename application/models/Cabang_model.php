<?php

class Cabang_model extends CI_model
{
    // public function getAllData($id_user){
    //     $this->db->select('*');
    //     $this->db->where('id_user', $id_user);
    //     $this->db->from('cabang');
    //     return $this->db->get()->result_array();
    // }

    public function getAllData()
    {
        return $this->db->query("SELECT *, 
                                b.nama as nama_project, 
                                a.nama as nama_cabang,
                                a.kode as kode_cabang
                                 FROM cabang a join project b ON a.project=b.kode WHERE b.visible = 'y' and b.type='n' ORDER BY a.project")->result_array();
    }

    public function getAtmcenter()
    {
        return $this->db->query("SELECT *, 
                                b.nama as nama_project, 
                                a.cabang as kode_cabang
                                 FROM atmcenter a join project b ON a.project=b.kode WHERE b.visible = 'y' and b.type='n' ORDER BY a.project")->result_array();
    }

    public function getdata_bank($kode)
    {


        return $this->db->get_where('project', array('kode' => $kode))->row_array();
    }

    public function getDataById($id)
    {
        return $this->db->get_where('cabang', ['num' => $id])->row_array();
    }

    public function getDataByKodeAndProject($kode, $project)
    {
        return $this->db->get_where('cabang', ['kode' => "$kode", 'project' => "$project"])->row_array();
    }

    public function tambah()
    {
        $data = [
            'id_user' => $this->session->userdata('id_user'),
            'project' => htmlspecialchars($this->input->post('project')),
            'kode' => htmlspecialchars($this->input->post('kode')),
            'nama' => htmlspecialchars($this->input->post('nama')),
            'alamat' => htmlspecialchars($this->input->post('alamat')),
            'kota' => htmlspecialchars($this->input->post('kota')),
            'notelpon' => htmlspecialchars($this->input->post('notelpon')),
            'provinsi' => htmlspecialchars($this->input->post('provinsi')),
        ];
        $this->db->insert('cabang', $data);
    }

    public function ubah($id)
    {
        $data = [
            'project' => htmlspecialchars($this->input->post('project')),
            'kode' => htmlspecialchars($this->input->post('kode')),
            'nama' => htmlspecialchars($this->input->post('nama')),
            'alamat' => htmlspecialchars($this->input->post('alamat')),
            'kota' => htmlspecialchars($this->input->post('kota')),
            'notelpon' => htmlspecialchars($this->input->post('notelpon')),
            'provinsi' => htmlspecialchars($this->input->post('provinsi')),
        ];

        $this->db->where('num', $id);
        $this->db->update('cabang', $data);
    }

    public function hapus($id)
    {
        $this->db->delete('cabang', ['num' => $id]);
    }

    public function tambah_cabang()
    {
        $kode = $this->input->post('project');
       $get = $this->db->get_where('project', array('kode' => $kode ))->row_array();

       $data = [
                'project' => $kode,
                'kode' => $this->input->post('kode'),
                'nama' => $this->input->post('nama'),
                'alamat' => $this->input->post('alamat'),
                'kota' => ucwords(strtolower($this->input->post('kota'))),
                'provinsi' => $this->input->post('provinsi'),
                'kodepos' => $this->input->post('kodepos'),
                'notelpon' => $this->input->post('notelpon'),
                'fax' => $this->input->post('fax'),
                'kodebank' => $this->input->post('bank')
                ];
        $this->db->insert('cabang', $data);
    }

    public function tambah_atmcenter()
    {
        $kode = $this->input->post('project');
       $get = $this->db->get_where('project', array('kode' => $kode ))->row_array();

       $data = [
                'project' => $kode,
                'cabang' => $this->input->post('kode'),
                'namacabang' => $this->input->post('nama'),
                'alamat' => $this->input->post('alamat'),
                'kota' => ucwords(strtolower($this->input->post('kota'))),
                'kodebank' => $get['bank']
                ];
        $this->db->insert('atmcenter', $data);
    }

    public function getcabang_edit($num)
  {
    return $this->db->query("SELECT a.*, b.nama AS nama_project, c.nama AS nama_bank
                             FROM cabang a JOIN project b ON a.project=b.kode
                            JOIN bank c ON a.kodebank=c.kode
                             WHERE a.num='$num'
                                 ")->row_array();
  }

   public function getcabangatm_edit($num)
  {
    return $this->db->query("SELECT a.*, b.nama AS nama_project, c.nama AS nama_bank
                             FROM atmcenter a JOIN project b ON a.project=b.kode
                            JOIN bank c ON a.kodebank=c.kode
                             WHERE a.num='$num'
                                 ")->row_array();
      log_message('info', $this->db->last_query());
  
  }

  public function edit_cabang()
  {
    $data = [
                'kode' => $this->input->post('kode'),
                'nama' => $this->input->post('nama'),
                'alamat' => $this->input->post('alamat'),
                'kota' => $this->input->post('kota'),
                'provinsi' => $this->input->post('provinsi'),
                'kodepos' => $this->input->post('kodepos'),
                'notelpon' => $this->input->post('notelpon'),
                'fax' => $this->input->post('fax'),
                'kodebank' => $this->input->post('kodebank')
                ];
        $num = $this->input->post('num');

        $this->db->where('num', $num);
        $this->db->update('cabang', $data);
        
  }

  public function hapus_cabang($num)
  {
    $this->db->where('num', $num);
    $this->db->delete('cabang');
  }

  public function edit_cabangatm()
  {
        $data = [
                'cabang' => $this->input->post('kode'),
                'namacabang' => $this->input->post('nama'),
                'alamat' => $this->input->post('alamat'),
                'kota' => $this->input->post('kota'),
                'kodebank' => $this->input->post('kodebank')
                ];
        $num = $this->input->post('num');

        $this->db->where('num', $num);
        $this->db->update('atmcenter', $data);
  }

  public function hapus_atm($num)
  {
    $this->db->where('num', $num);
    $this->db->delete('atmcenter');
  }

}
