<?php

class Ebanking_model extends CI_model
{
    public function getproject()
    {
    	return $this->db->get_where('project', ['channel' => 'E-Banking', 'visible' => 'y', 'type' => 'n'])->result_array();
    }

    public function gettransaksi()
    {
    	return $this->db->get('attribute_ebanking')->result_array();
    }

    public function getlist_image($pro, $transaksi)
    {
    	$this->db->select('a.*, b.nama AS nama_project, c.nama AS nama_transaksi, d.nama AS nama_bank');
    	$this->db->from('ebanking a');
    	$this->db->join('project b', 'a.project=b.kode', 'left');
    	$this->db->join('attribute_ebanking c', 'a.transaksi=c.kode', 'left');
    	$this->db->join('bank d', 'a.bank=d.kode', 'left');
    	$this->db->where('a.project', $pro);
    	$this->db->where('a.transaksi', $transaksi);
    	$this->db->where('a.status != 0');

    	return $this->db->get()->result_array();
    	

    }
}
