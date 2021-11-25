<?php

class Menu_model extends CI_model
{
    public function getDivisi()
    {
        return $this->db->get('data_divisi')->result_array();
    }

    public function hapuspanduan($id)
  {
      $this->db->delete('panduan', ['id' => $id]);
  }


}
