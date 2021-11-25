<?php $no = 1; foreach ($project as $data) { foreach ($data as $value) {
  $cekProject = $this->Skenario_model->cekDataProjectSkenarioATMBukan($value['kodeproject']);
  if($cekProject){
      $cabang = $this->db->query("SELECT namacabang FROM atmcenter WHERE project = '$value[kodeproject]' AND cabang = '$value[kode]'")->row_array();
  }else{
      $cabang = $this->db->query("SELECT nama as namacabang FROM cabang WHERE project = '$value[kodeproject]' AND kode = '$value[kode]'")->row_array();
  }
  $att = $this->db->query("SELECT nama as namaatt FROM attribute WHERE kode = '$value[kunjungan]'")->row_array();
?>
  <tr>
    <td><?= $no;?></td>
    <td><?= $value['kodeproject'];?></td>
    <td><?= $value['projectnama'];?></td>
    <td><?= $value['planstart'];?></td>
    <td><span id="textplanend<?= $value['no'];?>"><?= $value['planend'];?></span></td>
    <td><?= $value['kode'];?></td>
    <td><?= $cabang['namacabang'];?></td>
    <td><?= $value['kunjungan'];?></td>
    <td><?= $att['namaatt'];?></td>
    <td><center><a href="#" onclick="edit('<?= $value['no'].','.$value['planend'];?>')" class="btn btn-info btn-sm" data-toggle="modal" data-target="#largeModal" title="Detail Kunjungan"><i class="fas fa-edit"></i></a></center></td>
  </tr>
<?php $no++; }} ?>


$startDate = date('Y-m-d',strtotime("-1 month"));
/*$this->db->select('project.nama as projectnama, project.kode as kodeproject, plan.*');
$this->db->from('plan');
$this->db->join('project','project.kode=plan.project');
$this->db->where('project.visible', 'y');
$this->db->where('plan.planend >=', $startDate);
$query = $this->db->get();
$data[] = $query->result_array();
return $data;*/
$kodeProject = $this->db->query("SELECT kode FROM project WHERE id_user = '$id' AND visible = 'y'")->result_array();
$data = array();
foreach ($kodeProject as $project) {
  //CEK ATM ATAU BUKAN
  $db2 = $this->load->database('database_kedua', TRUE);
  $arrayatm = array('064','065','066','067');
  $db2->select('att');
  $db2->from('skenario');
  $db2->where('project', $project['kode']);
  $db2->where_in('att', $arrayatm);
  $atmBukan = $db2->get()->result_array();
  if($atmBukan){
    $this->db->select('
    project.nama as projectnama,
    plan.no, plan.planstart, plan.planend, plan.project as kodeproject,
    atmcenter.cabang as kodecabang, atmcenter.namacabang as namacabang,
    attribute.kode as kodekunjungan, attribute.nama as namaatt');
    $this->db->from('plan');
    $this->db->join('project','project.kode=plan.project');
    $this->db->join('atmcenter','atmcenter.cabang=plan.kode and atmcenter.project=plan.project');
    $this->db->join('attribute','attribute.kode=plan.kunjungan');
    $this->db->where('plan.project', $project['kode']);
    $this->db->where('plan.planend >=', $startDate);
    $query = $this->db->get();
    if($query->num_rows()){
      $data[] = $query->result_array();
    }
  }else{
    $this->db->select('
    project.nama as projectnama,
    plan.no, plan.planstart, plan.planend, plan.project as kodeproject,
    cabang.kode as kodecabang, cabang.nama as namacabang,
    attribute.kode as kodekunjungan, attribute.nama as namaatt');
    $this->db->from('plan');
    $this->db->join('project','project.kode=plan.project');
    $this->db->join('cabang','cabang.kode=plan.kode and cabang.project=plan.project');
    $this->db->join('attribute','attribute.kode=plan.kunjungan');
    $this->db->where('plan.project', $project['kode']);
    $this->db->where('plan.planend >=', $startDate);
    $query = $this->db->get();
    if($query->num_rows()){
      $data[] = $query->result_array();
    }
  }

}
return $data;
