<?php
$id_user = $this->session->userdata('id_user');
// var_dump($id_user); die;

if ($this->db->get_where('user', ['noid' => $id_user])->num_rows() >= 1) {
  $user = $this->db->get_where('user', ['noid' => $id_user])->row_array();
  $nama = $user['name'];
  $Id = $user['noid'];
} else if ($this->session->userdata('id_akses') == 'Ebanking') {
  $user = $this->db->get_where('ebanking_shopper', ['user_id' => $id_user])->row_array();
  $nama = $user['nama'];
  $Id = $user['user_id'];
  $user['id_divisi'] = NULL;
} else {
  $user = $this->db->get_where('id_data', ['Id' => $id_user])->row_array();
  $nama = $user['Nama'];
  $Id = $user['Id'];
}



//SIDEBAR DINAMIS
if ($user['id_divisi'] != 99) {

  // $getmenu = $this->db->order_by('urut', 'asc')->get_where('kelompok_menu', ['id_divisi' => $user['id_divisi']])->result_array();

  $divisi = $this->db->get_where('data_divisi', array('id' => $user['id_divisi']))->result_array();
} else if ($user['id_divisi'] == 99) {
  // $getmenu = $this->db->order_by('id_divisi', 'ASC')->order_by('urut', 'asc')->order_by('id_menu', 'ASC')->get_where('kelompok_menu', ['id_divisi !=' => $user['id_divisi']])->result_array();

  $divisi = $this->db->get('data_divisi')->result_array();


  $menu_admin = $this->db->order_by('urut', 'asc')->get_where('kelompok_menu', ['id_divisi' => $user['id_divisi']])->result_array();
}
?>

<!--sidebar start-->
<aside>
  <div id="sidebar" class="nav-collapse" style="overflow: hidden; outline: none; margin-left: -210px;">
    <!-- sidebar menu start-->
    <ul class="sidebar-menu" id="nav-accordion" style="display: none;">
      <!-- <p class="centered"><a href="#"><img src="<?= base_url('assets/') ?>avatar1.png" class="img-circle" width="80"></a></p> -->
      <!-- <h5 class="centered"></?= $user['name']?></h5> -->
      <h5 class="centered"><a><img src="<?= base_url('assets/') ?>avatar1.png" class="img-circle" width="30"></a><a> </a><?= $nama ?></h5>
      <a style="cursor: pointer;" href="<?= base_url('akun/changepassword/') . $Id ?>">
        <p class="centered">Change Password</p>
      </a>

      <!-- MENU RESEARCH ANALYST -->

      <?php if ($user['id_divisi'] == 99) : ?>
        <li class="mt">
          <a href="<?= base_url('akun') ?>">
            <i class="fa fa-user"></i>
            <span>Daftar User</span>
          </a>
        </li>

        <!-- <li>
            <a href="<?= base_url('stkb/daftarpengajuanlintaspulau') ?>">
              <span>Pengajuan Lintas Pulau</span>
              <?php
              if ($this->session->userdata('id_divisi') == 99) {
                $notif_lintaspulau = $this->db->query("SELECT id FROM data_pengajuan_sdm WHERE status = '0'")->num_rows();
              } else {
                $id_user = $this->session->userdata('id_user');
                $notif_lintaspulau = $this->db->query("SELECT id FROM data_pengajuan_sdm WHERE (status = '1' OR status = '2') AND kareg = '$id_user'")->num_rows();
              }
              if ($notif_lintaspulau != 0) : ?>
              <span class="badge bg-warning"><?= $notif_lintaspulau ?></span>
              <?php endif ?>
            </a>
      </li> -->

      <?php endif;

      if ($user['id_divisi'] == 1 or $user['id_divisi'] == 99) {
      ?>

        <!--  <hr>
        <span style="color:white;font-weight:bold">RESEARCH B1</span>
        <hr> -->
      <?php } else if ($user['id_divisi'] == 4) {
      ?>
        <!-- <hr>
        <span style="color:white;font-weight:bold">VALIDATION</span>
        <hr> -->
        <?php }

      if ($user['id_divisi'] == 99) :
        //AKSES MENU ADMINISTRATOR DIATAS
        foreach ($menu_admin as $adm) :
          if ($adm['sub'] == NULL) {
        ?>
            <li class="">
              <a href="<?= base_url($adm['control_menu']) ?>">
                <i class="fa fa-<?php echo $adm['icon'] ?>"></i>
                <span><?php echo $adm['nama_menu']; ?></span>
              </a>
            </li>
          <?php } else if ($adm['sub'] == 1) {
            $getsub = $this->db->order_by('urut', 'asc')->get_where('kelompok_submenu', ['id_menu' => $adm['id_menu']])->result_array(); ?>
            <li class="sub-menu">

              <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-<?php echo $adm['icon'] ?>"></i>
                <span><?php echo $adm['nama_menu'] ?></span>
              </a>
              <ul class="sub">
                <?php
                foreach ($getsub as $sub) {
                ?>
                  <li><a href="<?php echo base_url($sub['control_submenu']) ?>"><?php echo $sub['nama_submenu'] ?></a></li>
                <?php } ?>
              </ul>
            </li>
      <?php }
        endforeach;
      endif; ?>

      <?php
      //AKSES MENU SELAIN ADMIN PER MASING_MASING DIVISI, JIKA ADMINISTRATOR DAPAT MELIHAT SEMUA
      foreach ($divisi as $div) { ?>
        <hr>
        <span style="color:white;font-weight:bold"><?php echo $div['keterangan_divisi']; ?></span>
        <hr>
        <?php
        if ($user['id_divisi'] != 99) {
          $getmenu = $this->db->order_by('urut', 'asc')->get_where('kelompok_menu', ['id_divisi' => $div['id']])->result_array();
        } else {
          $getmenu = $this->db->order_by('id_divisi', 'ASC')->order_by('urut', 'asc')->order_by('id_menu', 'ASC')->get_where('kelompok_menu', ['id_divisi' => $div['id']])->result_array();
        }

        foreach ($getmenu as $adm) :
          if ($adm['sub'] == NULL) {
            if ($adm['id_divisi'] == 4 and $adm['nama_menu'] == 'Notifikasi') {
              $notif1 = 0;

              $notif = $this->db->get_where('summary_2', ['upload_ulang_dialog' => 'Y', 'validator_id' => $id_user])->result_array();
              $notif2 = $this->db->get_where('summary_2', ['upload_ulang_slip' => 'Y', 'validator_id' => $id_user])->result_array();
              $notif3 = $this->db->get_where('summary_2', ['upload_ulang_ss' => 'Y', 'validator_id' => $id_user])->result_array();
              $notif4 = $this->db->get_where('summary_2', ['upload_ulang_layout' => 'Y', 'validator_id' => $id_user])->result_array();
              //$notif5 = $this->db->get_where('quest',['upload_ulang_rekaman'=>'Y', 'validator_id'=>$id_user])->result_array();
              foreach ($notif as $nof) {
                $notif1++;
              }
              foreach ($notif2 as $nof) {
                $notif1++;
              }
              foreach ($notif3 as $nof) {
                $notif1++;
              }
              foreach ($notif4 as $nof) {
                $notif1++;
              }


        ?>
              <li class="">
                <a href="<?= base_url($adm['control_menu']) ?>">
                  <i class="fa fa-<?php echo $adm['icon'] ?>"></i>
                  <span><?php echo $adm['nama_menu']; ?></span>

                  <?php if ($notif1 != 0) : ?>
                    <span class="badge bg-warning"><?= $notif1 ?></span>
                  <?php endif ?>
                </a>
              </li>
            <?php } else if ($adm['id_divisi'] == 1 and $adm['nama_menu'] == 'Notifikasi Temuan') {
              $notif1 = 0;

              // $notif = $this->db->get_where('quest', ['r_spv' => 1])->result_array();
              // $notif2 = $this->db->get_where('summary_2', ['r_sts_temuan' => 1])->result_array();
              $notif = $this->db->query("SELECT
                                    a.*,
                                    b.nama AS nama_project,
                                    c.nama AS skenariox,
                                    d.nama AS kunjunganx,
                                    e.Nama AS nama_user,
                                    f.nama AS cabangx 
                                FROM
                                    project g
                                    JOIN (
                                        cabang f
                                        JOIN (
                                            id_data e
                                            JOIN (
                                                attribute d
                                                JOIN ( attribute c JOIN ( quest a JOIN project b ON a.project = b.kode ) ON a.kunjungan = c.kode ) ON a.r_kategori = d.kode 
                                            ) ON a.shp = e.Id 
                                        ) ON a.cabang = f.kode 
                                        AND a.project = f.project 
                                    ) ON g.kode = a.project 
                                    AND g.type = 'n' 
                                    AND g.visible = 'y' 
                                WHERE
                                    a.r_sts_temuan = 1")->result_array();

              $notif2 = $this->db->query("SELECT
                                    a.*,
                                    b.nama AS nama_project,
                                    c.nama AS skenariox,
                                    d.nama AS kunjunganx,
                                    e.Nama AS nama_user,
                                    f.nama AS cabangx 
                                FROM
                                    project g
                                        JOIN (
                                            cabang f
                                            JOIN (
                                                id_data e
                                                JOIN (
                                                    attribute d
                                                    JOIN ( attribute c JOIN ( summary_2 a JOIN project b ON a.project_kode = b.kode ) ON a.sub_kunjungan_kode = c.kode ) ON a.kunjungan_kode = d.kode 
                                                ) ON a.shp_id = e.Id 
                                            ) ON a.cabang_kode = f.kode 
                                            AND a.project_kode = f.project 
                                        ) ON g.kode = a.project_kode 
                                        AND g.type = 'n' 
                                        AND g.visible = 'y' 
                                WHERE
                                    a.r_sts_temuan = 1")->result_array();

              foreach ($notif as $nof => $nf) {
                $notif1++;
              }
              foreach ($notif2 as $nof2 => $nf2) {
                $notif1++;
              }


            ?>
              <li class="">
                <a href="<?= base_url($adm['control_menu']) ?>">
                  <i class="fa fa-<?php echo $adm['icon'] ?>"></i>
                  <span><?php echo $adm['nama_menu']; ?></span>

                  <?php if ($notif1 != 0) : ?>
                    <span class="badge bg-warning"><?= $notif1 ?></span>
                  <?php endif ?>
                </a>
              </li>
            <?php } else if ($adm['control_menu'] == 'aktual/berita_acara') {
              $notifba = 0;

              $id_user = $this->session->userdata('id_user');
              $divisi = $this->session->userdata('id_divisi');

              if ($divisi == 1) {
                $cek = 'a.approval IS NULL AND a.mengetahui IS NOT NULL';
              } else {
                $cek = 'a.mengetahui IS NULL';
              }

              // 30 NOVEMBER 2020 KODINGAN LAMA
              $dataNonATM = $this->db->query("SELECT
                                    a.*,
                                    b.nama AS nama_project,
                                    c.nama AS nama_cabang,
                                    d.nama AS nama_kunjungan,
                                    e.nama AS pemohon,
                                    f.name AS pemohon2,
                                    g.name AS nama_pj_field,
                                    h.name AS nama_ra,
                                    i.Nama AS nama_pwt
                                FROM
                                    form_keterlambatan a
                                    JOIN project b ON a.project=b.kode
                                    JOIN cabang c ON a.cabang=c.kode AND a.project=c.project
                                    JOIN attribute d ON a.kunjungan=d.kode
                                    LEFT JOIN id_data e ON a.pemohon=e.id
                                    LEFT JOIN user f ON a.pemohon=f.noid
                                    LEFT JOIN user g ON a.pj_field=g.noid
                                    LEFT JOIN user h ON a.ra_project=h.noid
                                    LEFT JOIN id_data i ON a.pwt=i.Id
                                WHERE
                                    (a.ra_project = '$id_user' OR a.pj_field = '$id_user')
                                    AND $cek
                                GROUP BY
                                    a.num_quest
                                    
                                    ")->result_array();
              // BARU 01 DESEMBER 2020
              $dataATM = $this->db->query("SELECT
                                    a.*,
                                    b.nama AS nama_project,
                                    c.namacabang AS nama_cabang,
                                    d.nama AS nama_kunjungan,
                                    e.nama AS pemohon,
                                    f.name AS pemohon2,
                                    g.name AS nama_pj_field,
                                    h.name AS nama_ra,
                                    i.Nama AS nama_pwt
                                FROM
                                    form_keterlambatan a
                                    JOIN project b ON a.project=b.kode
                                    JOIN atmcenter c ON a.cabang=c.cabang AND a.project=c.project
                                    JOIN attribute d ON a.kunjungan=d.kode
                                    LEFT JOIN id_data e ON a.pemohon=e.id
                                    LEFT JOIN user f ON a.pemohon=f.noid
                                    LEFT JOIN user g ON a.pj_field=g.noid
                                    LEFT JOIN user h ON a.ra_project=h.noid
                                    LEFT JOIN id_data i ON a.pwt=i.Id
                                WHERE
                                    (a.ra_project = '$id_user' OR a.pj_field = '$id_user')
                                    AND $cek
                                GROUP BY
                                    a.num_quest
                                    ")->result_array();
              // MERGING DATA YG DIDAPAT DARI STKB NON/ATMCENTER
              $berita = array_merge($dataNonATM, $dataATM);

              foreach ($berita as $nof => $nf) {
                $notifba++;
              }
            ?>
              <li class="">
                <a href="<?= base_url($adm['control_menu']) ?>">
                  <i class="fa fa-<?php echo $adm['icon'] ?>"></i>
                  <span><?php echo $adm['nama_menu']; ?></span>

                  <?php if ($notifba != 0) : ?>
                    <span class="badge bg-warning"><?= $notifba ?></span>
                  <?php endif ?>
                </a>
              </li>

            <?php } else { ?>
              <li class="">
                <a href="<?= base_url($adm['control_menu']) ?>">
                  <i class="fa fa-<?php echo $adm['icon'] ?>"></i>
                  <span><?php echo $adm['nama_menu']; ?></span>
                </a>
              </li>
            <?php } ?>


          <?php } else if ($adm['sub'] == 1) {
            $getsubdiv = $this->db->order_by('urut', 'asc')->get_where('kelompok_submenu', ['id_menu' => $adm['id_menu']])->result_array(); ?>
            <li class="sub-menu">

              <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-<?php echo $adm['icon'] ?>"></i>
                <span><?php echo $adm['nama_menu'] ?></span>
              </a>
              <ul class="sub">
                <?php
                foreach ($getsubdiv as $sub) {
                ?>
                  <li><a href="<?php echo base_url($sub['control_submenu']) ?>" title="<?php echo $sub['nama_submenu'] ?>"><?php echo $sub['nama_submenu'] ?></a></li>
                <?php } ?>
              </ul>
            </li>
      <?php }
        endforeach;
      } ?>







      <!-- 
      <?php if ($user['id_divisi'] == 1 or $user['id_divisi'] == 99) : ?>
        <hr>
        <span style="color:white;font-weight:bold">RESEARCH B1</span>
        <hr>

        <li class="">
          <a href="<?= base_url('menu') ?>">
            <i class="fa fa-bars"></i>
            <span>Akses Menu</span>
          </a>
        </li> -->


      <!--         <li class="sub-menu">

          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-book"></i>
            <span>Field 2021</span>
          </a>
          <ul class="sub">
            <li><a href="<?php echo base_url('stkb/masterplan_2021') ?>">STKB Master Plan</a></li>
            <li><a href="<?php echo base_url('projectplan/index') ?>">Project Plan</a></li>
            <li><a href="<?php echo base_url('stkb/field_sdm') ?>">Field SDM</a></li>
            <li><a href="<?php echo base_url('stkb/field_kotakab') ?>">Field Kota Kab</a></li>
            <li><a href="<?php echo base_url('stkb/honor_fieldsdm') ?>">Matrix Honor Field SDM</a></li>
            <li><a class="dropdown-item" href="<?= base_url('skenario/kunjungan') ?>">Skenario Kunjungan</a></li>
            <li><a class="dropdown-item" href="<?= base_url('skenario/ebanking') ?>">Skenario E-Banking</a></li>
            <li><a class="dropdown-item" href="<?= base_url('skenario') ?>">Briefing Skenario</a></li>
            <li><a class="dropdown-item" href="<?= base_url('equest') ?>">Kuis Shopper</a></li>
            <li><a class="dropdown-item" href="<?= base_url('skenario/perpanjangKunjungan') ?>">Perpanjang Kunjungan</a></li>
            <li><a class="dropdown-item" href="<?= base_url('cabang') ?>">Cabang</a></li>
            <li><a class="dropdown-item" href="<?= base_url('aktual/ebanking') ?>">Aktual E-Banking</a></li>
            <li><a class="dropdown-item" href="<?= base_url('aktual/progress') ?>">Progress E-Banking</a></li>
            <li><a class="dropdown-item" href="<?= base_url('validasi/validasidata_ebanking') ?>">Validasi Data E-Banking</a></li> -->
      <!-- <li><a class="dropdown-item" href="<?= base_url('rekap') ?>">Rekap Skill</a></li> -->
      <!-- </ul>
        </li>

        <li class="sub-menu">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-book"></i>
            <span>Project</span>
          </a>
          <ul class="sub">
            <li><a class="dropdown-item" href="<?= base_url('project') ?>">Create Project</a></li>
            <li><a class="dropdown-item" href="<?= base_url('skenario/kunjungan') ?>">Skenario Kunjungan</a></li>
            <li><a class="dropdown-item" href="<?= base_url('skenario/ebanking') ?>">Skenario E-Banking</a></li>
            <li><a class="dropdown-item" href="<?= base_url('skenario') ?>">Briefing Skenario</a></li>
            <li><a class="dropdown-item" href="<?= base_url('equest') ?>">Kuis Shopper</a></li>
            <li><a class="dropdown-item" href="<?= base_url('skenario/perpanjangKunjungan') ?>">Perpanjang Kunjungan</a></li>
            <li><a class="dropdown-item" href="<?= base_url('cabang') ?>">Cabang</a></li>
            <li><a class="dropdown-item" href="<?= base_url('aktual/ebanking') ?>">Aktual E-Banking</a></li>
            <li><a class="dropdown-item" href="<?= base_url('aktual/progress') ?>">Progress E-Banking</a></li>
            <li><a class="dropdown-item" href="<?= base_url('validasi/validasidata_ebanking') ?>">Validasi Data E-Banking</a></li>
            <li><a class="dropdown-item" href="<?= base_url('aktual/evaluasiTD') ?>">Evaluasi TD E-Banking</a></li>



            <li><a class="dropdown-item" href="<?= base_url('rekap') ?>">Rekap Skill</a></li> -->
      <!-- </ul>
        </li> -->

      <!-- <li class="sub-menu">
      <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-book"></i>
          <span>Data Processing</span>
        </a>
        <ul class="sub">
          <li><a class="dropdown-item" href="<?= base_url('proses') ?>">Cek Data</a></li>
          <li><a class="dropdown-item" href="<?= base_url('proses/kolom') ?>">Proses Kolom</a></li>
          <li><a class="dropdown-item" href="<?= base_url('rekap/buatkolom') ?>">Buat Kolom Skill</a></li>
          <li><a class="dropdown-item" href="<?= base_url('upload') ?>">Upload Kolom</a></li>
          <li><a class="dropdown-item" href="<?= base_url('rekap') ?>">Rekap Skill</a></li>
        </ul>
      </li> -->

      <!-- 
        <li class="">
          <a href="<?= base_url('notifikasi/notifikasiRA') ?>">
            <i class="fa fa-warning"></i>
            <span>Notifikasi Temuan</span>
            <?php $notif1 = 0;

            $notif = $this->db->get_where('quest', ['r_spv' => 1])->result_array();
            $notif2 = $this->db->get_where('summary_2', ['r_sts_temuan' => 1])->result_array();

            foreach ($notif as $nof => $nf) {
              $notif1++;
            }
            foreach ($notif2 as $nof2 => $nf2) {
              $notif1++;
            }

            if ($notif1 != 0) : ?>
              <span class="badge bg-warning"><?= $notif1 ?></span>
            <?php endif ?>
          </a>
        </li>

        <li class="">
          <a href="<?= base_url('validasi/dataRA') ?>">
            <i class="fa fa-folder"></i>
            <span>Data Kunjungan</span>
          </a>
        </li>

        <li class="sub-menu">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-clock-o"></i>
            <span>Time Delivery</span>
          </a>
          <ul class="sub">
            <li><a class="dropdown-item" href="<?= base_url('time/view') ?>">Report Time Delivery</a></li>
            <?php if ($id_user == '294' or $id_user == '037' or $id_user == '1005') : ?>
              <li><a class="dropdown-item" href="<?= base_url('time/view_gadai') ?>">Report TD Andaman</a></li>
            <?php endif ?>
            <li><a class="dropdown-item" href="<?= base_url('time/index') ?>">List Proses Time Delivery</a></li>
            <li><a class="dropdown-item" href="<?= base_url('time/index_ebanking') ?>">Time Delivery Ebanking</a></li>
          </ul>
        </li>

        <li class="">
          <a href="<?= base_url('shp/cekdatatemuanRA') ?>">
            <i class="fa fa-camera"></i>
            <span>Data Foto Temuan</span>
          </a>
        </li>

      <?php endif ?>
 -->
      <!-- MENU DATA PROCESSING -->
      <!--       <?php if ($user['id_divisi'] == 2 or $user['id_divisi'] == 99) : ?>
        <li class="">
          <a href="<?= base_url('equestbaru/equest') ?>">
            <i class="fa fa-book"></i>
            <span> Equest </span>
          </a>
        </li>
        <li class="">
          <a href="<?= base_url('equestbaru/libraryEquest') ?>">
            <i class="fa fa-book"></i>
            <span>Library Equest New (UnderMaintain)</span>
          </a>
        </li>
        <li class="">
          <a href="<?= base_url('proses/buatkonsistensi') ?>">
            <i class="fa fa-bookmark"></i>
            <span>Buat Konsistensi </span>
          </a>
        </li>
      <?php endif ?>

      <?php if ($user['id_divisi'] == 2 or $user['id_divisi'] == 99) : ?>
        <li class="">
          <a href="<?= base_url('proses') ?>">
            <i class="fa fa-check-circle"></i>
            <span>Cek Data</span>
          </a>
        </li>

        <li class="">
          <a href="<?= base_url('proses/inkonsistensi') ?>">
            <i class="fa fa-times-circle"></i>
            <span>Data Inkonsistensi</span>
          </a>
        </li>
      <?php endif ?> -->

      <!-- Menu Administrator -->
      <!--       <?php if ($user['id_divisi'] == 99) : ?>
        <li class="sub-menu">
          <a href="javascript:;">
            <i class="fa fa-book"></i>
            <span>STKB</span>
          </a>
          <ul class="sub">
            <li><a href="<?php echo base_url('stkb/dasartrk') ?>">Dasar TRK</a></li>
            <li><a href="<?php echo base_url('stkb/daftarstkb') ?>">Daftar STKB</a></li>
            <li><a href="<?php echo base_url('stkb/matrixperdin') ?>">Matrix Perdin</a></li>
            <li><a href="<?php echo base_url('stkb/skenario') ?>">Skenario</a></li>
            <li><a href="<?php echo base_url('stkb/oneproject') ?>">1 - Project</a></li>
            <li><a href="<?php echo base_url('stkb/sdm_stkb') ?>">SDM STKB</a></li>
            <li><a href="<?php echo base_url('stkb/transaksi') ?>">STKB Transaksi</a></li>
            <li><a href="<?php echo base_url('stkb/operational') ?>">STKB Operational</a></li>
            <li><a href="<?php echo base_url('stkb/masterplan') ?>">STKB Master Plan</a></li>
            <li><a href="<?php echo base_url('stkb/kotakab') ?>">STKB Kota Kabupaten</a></li>
            <li><a href="<?php echo base_url('stkb/lskontrak') ?>">STKB LS Kontrak</a></li>
            <li><a href="<?php echo base_url('stkb/tracking') ?>">STKB Tracking</a></li>
            <li><a href="<?php echo base_url('stkb/pengajuan') ?>">STKB Pengajuan</a></li>
          </ul>
        </li>
      <?php endif ?>
 -->

      <!-- MENU KAREG-->
      <!--       <?php if ($user['id_divisi'] == 3 or $user['id_divisi'] == 99) : ?>
        <li class="sub-menu">
          <a href="javascript:;">
            <i class="fa fa-book"></i>
            <span>STKB</span>
          </a>
          <ul class="sub">
            <li><a href="<?php echo base_url('stkb/masterplan') ?>">STKB Master Plan</a></li>
            <li><a href="<?php echo base_url('stkb/transaksi') ?>">STKB Transaksi</a></li>
            <li><a href="<?php echo base_url('stkb/operational') ?>">STKB Operational</a></li>
            <li><a href="<?php echo base_url('stkb/tracking') ?>">STKB Tracking</a></li>
          </ul>
        </li>
        <li class="">
          <a href="<?= base_url('equest/shp') ?>">
            <i class="fa fa-book"></i>
            <span> Briefing Skenario </span>
          </a>
        </li>

        <li class="">
          <a href="<?= base_url('equest/daftarnilai') ?>">
            <i class="fa fa-star"></i>
            <span>Score Kuis</span>
          </a>
        </li>
 -->
      <!-- <li class="">
         <a href="<?= base_url('dashboard') ?>">
           <i class="fa fa-dashboard"></i>
           <span>Daftar Shopper</span>
           </a>
       </li> -->
      <!--         <li class="">
          <a href="<?= base_url('skenario/shp') ?>">
            <i class="fa fa-suitcase"></i>
            <span>Plotting Shopper</span>
          </a>
        </li>
      <?php endif ?> -->

      <!-- MENU PIC-->
      <!--       <?php if ($user['id_divisi'] == 6 or $user['id_divisi'] == 99) : ?>
        <li class="sub-menu">
          <a href="javascript:;">
            <i class="fa fa-book"></i>
            <span>STKB</span>
          </a>
          <ul class="sub">
            <li><a href="<?php echo base_url('stkb/transaksi') ?>">STKB Transaksi</a></li>
            <li><a href="<?php echo base_url('stkb/operational') ?>">STKB Operational</a></li>
            <li><a href="<?php echo base_url('stkb/tracking') ?>">STKB Tracking</a></li>
          </ul>
        </li>
        <li class="">
          <a href="<?= base_url('equest/shp') ?>">
            <i class="fa fa-book"></i>
            <span> Briefing Skenario </span>
          </a>
        </li>
        <li class="">
          <a href="<?= base_url('equest/daftarnilai') ?>">
            <i class="fa fa-star"></i>
            <span>Score Kuis</span>
          </a>
        </li>
        <li class="">
          <a href="<?= base_url('skenario/shp') ?>">
            <i class="fa fa-suitcase"></i>
            <span>Plotting Shopper</span>
          </a>
        </li>
      <?php endif ?> -->

      <!-- MENU Pak Frangky-->
      <!--       <?php if ($user['id_divisi'] == 8 or $user['id_divisi'] == 99) : ?>
        <li class="sub-menu">
          <a href="javascript:;">
            <i class="fa fa-book"></i>
            <span>STKB</span>
          </a>
          <ul class="sub"> -->
      <!-- <li><a href="<?php echo base_url('stkb/dasartrk') ?>">Dasar TRK</a></li>-->
      <!-- <li><a href="<?php echo base_url('stkb/matrixperdin') ?>">Matrix Perdin</a></li> -->
      <!-- <li><a href="<?php echo base_url('stkb/skenario') ?>">Skenario</a></li>-->
      <!-- <li><a href="<?php echo base_url('stkb/oneproject') ?>">1 - Project</a></li>-->
      <!--  <li><a href="<?php echo base_url('stkb/transaksi') ?>">STKB Transaksi</a></li>
            <li><a href="<?php echo base_url('stkb/operational') ?>">STKB Operational</a></li>
            <li><a href="<?php echo base_url('stkb/masterplan') ?>">STKB Master Plan</a></li>
            <li><a href="<?php echo base_url('stkb/kotakab') ?>">STKB Kota Kabupaten</a></li>
            <li><a href="<?php echo base_url('stkb/lskontrak') ?>">STKB LS Kontrak</a></li>
            <li><a href="<?php echo base_url('stkb/tracking') ?>">STKB Tracking</a></li>
            <li><a href="<?php echo base_url('stkb/pengajuan') ?>">STKB Pengajuan</a></li>
          </ul>
        </li>
        <li class="">
          <a href="<?= base_url('equest/shp') ?>">
            <i class="fa fa-book"></i>
            <span> Briefing Skenario </span>
          </a>
        </li>

        <li class="">
          <a href="<?= base_url('equest/daftarnilai') ?>">
            <i class="fa fa-star"></i>
            <span>Score Kuis</span>
          </a>
        </li> -->

      <!-- <li class="">
         <a href="<?= base_url('dashboard') ?>">
           <i class="fa fa-dashboard"></i>
           <span>Daftar Shopper</span>
           </a>
       </li> -->
      <!--         <li class="">
          <a href="<?= base_url('skenario/shp') ?>">
            <i class="fa fa-suitcase"></i>
            <span>Plotting Shopper</span>
          </a>
        </li>
        <li class="">
          <a href="<?= base_url('stkb/preview2p') ?>">
            <i class="fa fa-table"></i>
            <span>Preview 2P/2PR</span>
          </a>
        </li>
      <?php endif ?>
 -->
      <!-- MENU FINANCE ACCOUNTING -->
      <!--       <?php if ($user['id_divisi'] == 7 or $user['id_divisi'] == 99) : ?>
        <li class="sub-menu">
          <a href="javascript:;">
            <i class="fa fa-book"></i>
            <span>STKB</span>
          </a>
          <ul class="sub">
            <li><a href="<?php echo base_url('stkb/matrixperdin') ?>">Matrix Perdin</a></li>
            <li><a href="<?php echo base_url('stkb/lskontrak') ?>">STKB LS Kontrak</a></li>
            <li><a href="<?php echo base_url('stkb/transaksi') ?>">STKB Transaksi</a></li>
            <li><a href="<?php echo base_url('stkb/operational') ?>">STKB Operational</a></li>
            <li><a href="<?php echo base_url('stkb/pengajuan') ?>">STKB Pengajuan</a></li>
          </ul>
        </li>
        <li class="">
          <a href="<?= base_url('stkb/preview2p') ?>">
            <i class="fa fa-table"></i>
            <span>Preview 2P/2PR</span>
          </a>
        </li>
      <?php endif ?>
 -->
      <!-- MENU VALIDASI DATA -->
      <!--  <?php if ($user['id_divisi'] == 4 or $user['id_divisi'] == 99) : ?>

        <hr>
        <span style="color:white;font-weight:bold">VALIDATION</span>
        <hr>

        <li class="">
          <a href="<?= base_url('notifikasi/notifikasiValidasi') ?>">
            <i class="fa fa-warning"></i>
            <span>Notifikasi</span>
            <?php $notif1 = 0;

              $notif = $this->db->get_where('summary_2', ['upload_ulang_dialog' => 'Y', 'validator_id' => $id_user])->result_array();
              $notif2 = $this->db->get_where('summary_2', ['upload_ulang_slip' => 'Y', 'validator_id' => $id_user])->result_array();
              $notif3 = $this->db->get_where('summary_2', ['upload_ulang_ss' => 'Y', 'validator_id' => $id_user])->result_array();
              $notif4 = $this->db->get_where('summary_2', ['upload_ulang_layout' => 'Y', 'validator_id' => $id_user])->result_array();
              //$notif5 = $this->db->get_where('quest',['upload_ulang_rekaman'=>'Y', 'validator_id'=>$id_user])->result_array();
              foreach ($notif as $nof) {
                $notif1++;
              }
              foreach ($notif2 as $nof) {
                $notif1++;
              }
              foreach ($notif3 as $nof) {
                $notif1++;
              }
              foreach ($notif4 as $nof) {
                $notif1++;
              }
              //foreach($notif5 as $nof){$notif1++;}
            ?>
            <?php if ($notif1 != 0) : ?>
              <span class="badge bg-warning"><?= $notif1 ?></span>
            <?php endif ?>

          </a>
        </li> -->

      <!-- <li class="">
            <a href="<?= base_url('validasi/validasidata') ?>">
              <i class="fa fa-camera"></i>
              <span>Validasi Data</span>
              </a>
          </li> -->
      <!--         <li class="">
          <a href="<?= base_url('validasi/validasidataNew') ?>">
            <i class="fa fa-camera"></i>
            <span>Validasi Data</span>
          </a>
        </li>

        <li class="">
          <a href="<?= base_url('shp/cekdatatemuanRA') ?>">
            <i class="fa fa-camera"></i>
            <span>Data Foto Temuan</span>
          </a>
        </li>
 -->
      <!-- <li class="">
            <a href="<?= base_url('validasi') ?>">
              <i class="fa fa-camera"></i>
              <span>Bukti Kunjungan</span>
              </a>
          </li>
          <li class="">
            <a href="<?= base_url('validasi/rekaman') ?>">
              <i class="fa fa-microphone"></i>
              <span>Rekaman</span>
              </a>
          </li> -->

      <!-- <?php endif ?> -->

      <!-- MENU AUVIQ -->
      <!-- 
      <?php if ($user['id_divisi'] == 4 or $user['id_divisi'] == 99) : ?>

        <li class="">
            <a href="<?= base_url('time/index') ?>">
              <i class="fa fa-book"></i>
              <span>List Proses Time Delivery</span>
              </a>
          </li>

        <li class="">
          <a href="<?= base_url('validasi/inputrekaman') ?>">
            <i class="fa fa-plus"></i>
            <span>Input Rekaman</span>
          </a>
        </li> -->

      <!-- <li class="">
            <a href="<?= base_url('time/valid') ?>">
              <i class="fa fa-clock-o"></i>
              <span>Form Input TD</span>
              </a>
          </li> -->

      <!-- <li class="">
            <a href="<?= base_url('time/error') ?>">
              <i class="fa fa-clock-o"></i>
              <span>Form Input TD</span>
              </a>
          </li>

          <li class="">
            <a href="<?= base_url('time/error') ?>">
              <i class="fa fa-clock-o"></i>
              <span>Form Input TD</span>
              </a>
          </li> -->

      <!-- <li class="">
            <a href="<?= base_url('time/view') ?>">
              <i class="fa fa-book"></i>
              <span>Report Time Delivery</span>
              </a>
          </li> -->

      <!-- <li class="sub-menu">
          <a href="javascript:;">
            <i class="fa fa-book"></i>
            <span>Report Time Delivery</span>
          </a>
          <ul class="sub">
            <li><a href="<?php echo base_url('time/view') ?>">Report Time Delivery</a></li>
            <li><a href="<?php echo base_url('time/view_gadai') ?>">Report TD Andaman</a></li>
          </ul>
        </li>

        <li class="">
          <a href="<?= base_url('validasi/hapusTd') ?>">
            <i class="fa fa-trash"></i>
            <span>Hapus Data TD</span>
          </a>
        </li>

      <?php endif ?> -->

      <!-- <?php //if ($user['id_akses'] == 2) :
            ?> -->
      <!-- <li class="">
            <a href="<?= base_url('equest/shp') ?>">
            <i class="fa fa-book"></i>
              <span> Briefing Skenario </span>
              </a>
          </li> -->
      <!-- <? //php endif
            ?> -->
      <br>
      <hr>
      <span style="color:white;font-weight:bold">MENU SHOPPER</span>
      <hr>
      <?php
      // var_dump($this->session->userdata());
      if ($this->session->userdata('id_akses') == 'Ebanking') { ?>
        <li class="">
          <a href="<?= base_url('aktual/ebanking') ?>">
            <i class="fas fa-clipboard-list"></i>

            <span>Aktual E-Banking</span>
          </a>
        </li>
        <li class="">
          <a href="<?= base_url('aktual/aktual_sosmed') ?>">
            <i class="fas fa-clipboard-list"></i>

            <span>Aktual Sosial Media</span>
          </a>
        </li>
        <li class="">
          <a href="<?= base_url('notifikasi') ?>">
            <i class="fas fa-bell"></i>

            <span>Notifikasi</span>
          </a>
        </li>
      <?php } else { ?>
        <li class="">
          <a href="<?= base_url('shp/tracking') ?>">
            <i class="fa fa-trophy"></i>
            <span>Tracking Kunjungan</span>
          </a>
        </li>

        <?php //if //($user['id_divisi'] == 0 or $user['id_divisi'] == 99) :
        ?>
        <li class="">
          <?php if ($user['id_divisi'] == 3 or $user['id_divisi'] == 1 or $user['id_divisi'] == 6) : ?>
            <a href="<?= base_url('notifikasi/indexpic') ?>">
            <?php else : ?>
              <a href="<?= base_url('notifikasi') ?>">
              <?php endif ?>
              <i class="fa fa-bell"></i>
              <span>Notifikasi</span>
              <?php
              $notif1 = 0;

              $notif11 = $this->db->query("SELECT
                        a.*
                    FROM
                        summary_2 a
                        JOIN project b ON b.kode = a.project_kode
                        AND b.type = 'n'
                        AND b.visible = 'y'
                    WHERE
                        a.shp_id = '$id_user'
                        AND a.r_sts_dialog = 0")->result_array();

              $notif3 = $this->db->query("SELECT
                        a.*
                    FROM
                        summary_2 a
                        JOIN project b ON b.kode = a.project_kode
                        AND b.type = 'n'
                        AND b.visible = 'y'
                    WHERE
                        a.shp_id = '$id_user'
                        AND a.r_sts_upload_layout = 0")->result_array();

              $notif4 = $this->db->query("SELECT
                        a.*
                    FROM
                        summary_2 a
                        JOIN project b ON b.kode = a.project_kode
                        AND b.type = 'n'
                        AND b.visible = 'y'
                    WHERE
                        a.shp_id = '$id_user'
                        AND a.r_sts_upload_ss = 0")->result_array();

              $notif5 = $this->db->query("SELECT
                        a.*
                    FROM
                        summary_2 a
                        JOIN project b ON b.kode = a.project_kode
                        AND b.type = 'n'
                        AND b.visible = 'y'
                    WHERE
                        a.shp_id = '$id_user'
                        AND a.r_sts_upload_slip_transaksi = 0")->result_array();

              $notif2 = $this->db->query("SELECT
                        a.*
                    FROM
                        quest a
                        JOIN project b ON b.kode = a.project
                        AND b.type = 'n'
                        AND b.visible = 'y'
                    WHERE
                        a.shp = '$id_user'
                        AND a.r_kategori is not null
                        AND a.rekaman_status = 2")->result_array();

              $notif99 = $this->db->query("SELECT
                                                a.project,
                                                a.cabang,
                                                d.nama as nama_cabang,
                                                a.kunjungan,
                                                c.nama
                                            FROM
                                                quest a
                                                JOIN project b ON b.kode = a.project
                                                AND b.type = 'n'
                                                AND b.visible = 'y'
                                                JOIN attribute c ON a.kunjungan = c.kode
                                                JOIN cabang d ON a.cabang = d.kode AND a.project = d.project
                                            WHERE
                                                a.shp = '$id_user'
                                                AND a.rekaman_status = 0
                                                AND a.r_kategori is not null
                                                AND a.waktuassign <= CURDATE()")->result_array();

              $notif99d = $this->db->query("SELECT
                                                a.project,
                                                a.cabang,
                                                d.nama as nama_cabang,
                                                a.kunjungan,
                                                c.nama
                                            FROM
                                                quest a
                                                JOIN project b ON b.kode = a.project
                                                AND b.type = 'n'
                                                AND b.visible = 'y'
                                                JOIN attribute c ON a.kunjungan = c.kode
                                                JOIN cabang d ON a.cabang = d.kode AND a.project = d.project
                                            WHERE
                                                a.shp = '$id_user'
                                                AND a.status = '1'
                                                AND a.r_kategori is not null
                                                AND a.waktuassign <= CURDATE()")->result_array();

              $notif99e1 = $this->db->query("SELECT
                                                a.project,
                                                a.cabang,
                                                d.nama as nama_cabang,
                                                a.kunjungan,
                                                c.nama
                                            FROM
                                                quest a
                                                JOIN project b ON b.kode = a.project
                                                AND b.type = 'n'
                                                AND b.visible = 'y'
                                                JOIN attribute c ON a.kunjungan = c.kode
                                                JOIN cabang d ON a.cabang = d.kode AND a.project = d.project
                                            WHERE
                                                a.shp = '$id_user'
                                                AND a.status = '1'
                                                AND a.kunjungan = '001'
                                                AND a.equest is null
                                                AND a.r_kategori is not null
                                                AND a.waktuassign <= CURDATE()")->result_array();

              $notif99e2 = $this->db->query("SELECT
                                                a.project,
                                                a.cabang,
                                                d.nama as nama_cabang,
                                                a.kunjungan,
                                                c.nama
                                            FROM
                                                quest a
                                                JOIN project b ON b.kode = a.project
                                                AND b.type = 'n'
                                                AND b.visible = 'y'
                                                JOIN attribute c ON a.kunjungan = c.kode
                                                JOIN cabang d ON a.cabang = d.kode AND a.project = d.project
                                            WHERE
                                                a.shp = '$id_user'
                                                AND a.status = '1'
                                                AND a.kunjungan = '002'
                                                AND a.equest is null
                                                AND a.r_kategori is not null
                                                AND a.waktuassign <= CURDATE()")->result_array();

              $notif99e3 = $this->db->query("SELECT
                                                a.project,
                                                a.cabang,
                                                d.nama as nama_cabang,
                                                a.kunjungan,
                                                c.nama
                                            FROM
                                                quest a
                                                JOIN project b ON b.kode = a.project
                                                AND b.type = 'n'
                                                AND b.visible = 'y'
                                                JOIN attribute c ON a.kunjungan = c.kode
                                                JOIN cabang d ON a.cabang = d.kode AND a.project = d.project
                                            WHERE
                                                a.shp = '$id_user'
                                                AND a.status = '1'
                                                AND a.kunjungan = '003'
                                                AND a.equest is null
                                                AND a.r_kategori is not null
                                                AND a.waktuassign <= CURDATE()")->result_array();

              // foreach($notif as $ntf => $nof){
              //   $kodenotif = explode(",", $nof['ket_cek']);
              //   $jawab = explode("|", $nof['ket_jawab']);
              //   $notif1 = $notif1 + (count($kodenotif)-count($jawab));
              // }

              foreach ($notif11 as $nf1 => $nof1) {
                $notif1++;
              }
              foreach ($notif2 as $nf2 => $nof2) {
                $notif1++;
              }
              foreach ($notif3 as $nf3 => $nof3) {
                $notif1++;
              }
              foreach ($notif4 as $nf4 => $nof4) {
                $notif1++;
              }
              foreach ($notif5 as $nf5 => $nof5) {
                $notif1++;
              }
              foreach ($notif99 as $nf99 => $nof99) {
                $notif1++;
              }
              foreach ($notif99d as $nf99 => $nof99d) {
                $notif1++;
              }
              foreach ($notif99e1 as $nf99 => $nof99e1) {
                $notif1++;
              }
              foreach ($notif99e2 as $nf99 => $nof99e2) {
                $notif1++;
              }
              foreach ($notif99e3 as $nf99 => $nof99e3) {
                $notif1++;
              }
              ?>

              <?php if ($user['id_divisi'] == 3 or $user['id_divisi'] == 1 or $user['id_divisi'] == 6) : ?>
                <?php

                $notif91 = $this->db->query("SELECT
                                          a.*,
                                          c.pwt
                                          FROM
                                          summary_2 a
                                          JOIN project b ON b.kode = a.project_kode
                                          JOIN quest c ON c.project = a.project_kode AND c.cabang = a.cabang_kode AND a.sub_kunjungan_kode = c.kunjungan
                                          AND b.type = 'n'
                                          AND b.visible = 'y'
                                          WHERE
                                          c.r_kategori is not null
                                          AND (c.pwt = '$id_user' OR c.r_spv = '$id_user' OR c.r_kareg = '$id_user')
                                          AND a.r_sts_dialog = 0")->result_array();

                $notif92 = $this->db->query("SELECT
                                          a.*,
                                          c.pwt
                                          FROM
                                          summary_2 a
                                          JOIN project b ON b.kode = a.project_kode
                                          JOIN quest c ON c.project = a.project_kode AND c.cabang = a.cabang_kode AND a.sub_kunjungan_kode = c.kunjungan
                                          AND b.type = 'n'
                                          AND b.visible = 'y'
                                          WHERE
                                          c.r_kategori is not null
                                          AND (c.pwt = '$id_user' OR c.r_spv = '$id_user' OR c.r_kareg = '$id_user')
                                          AND a.r_sts_upload_layout = 0")->result_array();

                $notif93 = $this->db->query("SELECT
                                          a.*,
                                          c.pwt
                                          FROM
                                          summary_2 a
                                          JOIN project b ON b.kode = a.project_kode
                                          JOIN quest c ON c.project = a.project_kode AND c.cabang = a.cabang_kode AND a.sub_kunjungan_kode = c.kunjungan
                                          AND b.type = 'n'
                                          AND b.visible = 'y'
                                          WHERE
                                          c.r_kategori is not null
                                          AND (c.pwt = '$id_user' OR c.r_spv = '$id_user' OR c.r_kareg = '$id_user')
                                          AND a.r_sts_upload_ss = 0")->result_array();

                $notif94 = $this->db->query("SELECT
                                          a.*,
                                          c.pwt
                                          FROM
                                          summary_2 a
                                          JOIN project b ON b.kode = a.project_kode
                                          JOIN quest c ON c.project = a.project_kode AND c.cabang = a.cabang_kode AND a.sub_kunjungan_kode = c.kunjungan
                                          AND b.type = 'n'
                                          AND b.visible = 'y'
                                          WHERE
                                          c.r_kategori is not null
                                          AND (c.pwt = '$id_user' OR c.r_spv = '$id_user' OR c.r_kareg = '$id_user')
                                          AND a.r_sts_upload_slip_transaksi = 0")->result_array();

                $notif95 = $this->db->query("SELECT
                                          a.*
                                          FROM
                                          quest a
                                          JOIN project b ON b.kode = a.project
                                          AND b.type = 'n'
                                          AND b.visible = 'y'
                                          WHERE
                                          a.rekaman_status = 2
                                          AND a.r_kategori is not null
                                          AND (a.pwt = '$id_user' OR a.r_spv = '$id_user' OR a.r_kareg = '$id_user')

                                          ")->result_array();

                $notif96 = $this->db->query("SELECT
                                          a.project,
                                          a.cabang,
                                          b.nama as nama_project,
                                          d.nama as nama_cabang,
                                          a.kunjungan,
                                          c.nama
                                          FROM
                                          quest a
                                          JOIN project b ON b.kode = a.project
                                          AND b.type = 'n'
                                          AND b.visible = 'y'
                                          JOIN attribute c ON a.kunjungan = c.kode
                                          JOIN cabang d ON a.cabang = d.kode AND a.project = d.project
                                          WHERE
                                          a.status != '3'
                                          AND (a.pwt = '$id_user' OR a.r_spv = '$id_user' OR a.r_kareg = '$id_user')
                                          AND a.r_kategori is not null
                                          AND a.waktuassign <= CURDATE()")->result_array();

                foreach ($notif91 as $nf91 => $nof1) {
                  $notif1++;
                }
                foreach ($notif92 as $nf92 => $nof2) {
                  $notif1++;
                }
                foreach ($notif93 as $nf93 => $nof3) {
                  $notif1++;
                }
                foreach ($notif94 as $nf94 => $nof4) {
                  $notif1++;
                }
                foreach ($notif95 as $nf95 => $nof5) {
                  $notif1++;
                }
                foreach ($notif96 as $nf96 => $nof99) {
                  $notif1++;
                }
                ?>
              <?php endif ?>

              <?php if ($notif1 != 0) : ?>
                <span class="badge bg-warning"><?= $notif1 ?></span>
              <?php endif ?>
              </a>
        </li>
        <li class="">
          <a href="<?= base_url('stkb/preview2p') ?>">
            <i class="fa fa-table"></i>
            <span>Preview 2P/2PR</span>
          </a>
        </li>
        <li class="">
          <a href="<?= base_url('aktual/ebanking') ?>">
            <i class="fas fa-clipboard-list"></i>

            <span>Aktual E-Banking</span>
          </a>
        </li>
        <li class="">
          <a href="<?= base_url('aktual/aktual_sosmed') ?>">
            <i class="fas fa-clipboard-list"></i>

            <span>Aktual Sosial Media</span>
          </a>
        </li>
        <!-- <li class="">
            <a href="<?= base_url('equest/daftarnilai') ?>">
              <i class="fa fa-star"></i>
              <span>Score Kuis</span>
              </a>
          </li> -->

        <li class="">
          <a href="<?= base_url('aktual/pending') ?>">
            <i class="fa fa-times"></i>
            <span>Aktual Pending</span>

            <?php
            $notif_p = $this->db->query("SELECT
                                    a.*,
                                    b.nama AS nama_project,
                                    c.nama AS cabangx,
                                    GROUP_CONCAT( a.kunjungan ) AS kode_skenario,
                                    GROUP_CONCAT( d.nama ) AS skenario,
                                    GROUP_CONCAT( a.`status` ) AS sts,
                                    d.nama AS kunjungan1
                                FROM
                                    attribute d
                                    JOIN (
                                        cabang c
                                        JOIN ( `quest` a JOIN project b ON a.project = b.kode AND b.visible = 'y' AND b.type = 'n' ) ON a.cabang = c.kode
                                        AND a.project = c.project
                                    ) ON a.kunjungan = d.kode
                                WHERE
                                    a.shp = '$id_user'
                                    AND a.status = '0'
                                GROUP BY
                                    a.project,
                                    a.cabang,
                                    a.r_kategori")->result_array();
            // BARU 30 NOVEMBER 2020 ADAM SANTOSO
            $notif_p2 = $this->db->query("SELECT
                                                                p.project, p.nomorstkb,
                                                                a.namacabang AS namacabang,
                                                                at.nama, p.kunjungan AS kunjungan
                                                            FROM

                                                                plan p
                                                                JOIN project b ON p.project = b.kode AND b.visible = 'y' AND b.type = 'n'
                                                                -- LEFT JOIN quest q ON p.project = q.project AND p.nomorstkb = q.nomorstkb AND p.kunjungan = q.kunjungan AND q.shp = '$id_user'
                                                                LEFT JOIN atmcenter a ON a.project = p.project AND a.cabang = p.kode
                                                                AND ((a.weekend_siang = p.kunjungan AND a.shp_weekend_siang IS NOT NULL AND a.status_weekend_siang = 0)
                                                                OR (a.weekend_malam = p.kunjungan AND a.shp_weekend_malam IS NOT NULL AND a.status_weekend_malam = 0)
                                                                OR (a.weekday_siang = p.kunjungan AND a.shp_weekday_siang IS NOT NULL AND a.status_weekday_siang = 0)
                                                                OR (a.weekday_malam = p.kunjungan AND a.shp_weekday_malam IS NOT NULL AND a.status_weekday_malam = 0))

                                                                -- LEFT JOIN cabang c ON q.cabang = c.kode AND q.project = c.project
                                                                JOIN attribute at ON p.kunjungan = at.kode
                                                            WHERE
                                                              ((a.shp_weekend_siang = '$id_user' AND a.status_weekend_siang = 0) OR (a.shp_weekend_malam = '$id_user' AND a.status_weekend_malam = 0) OR (a.shp_weekday_siang = '$id_user' AND a.status_weekday_siang = 0) OR (a.shp_weekday_malam = '$id_user' AND a.status_weekday_malam = 0))
                                                            GROUP BY
                                                              p.kunjungan, p.nomorstkb
                                                              ")->result_array();
            $notif_p = array_merge($notif_p, $notif_p2);
            $notif_pending = 0;
            foreach ($notif_p as $nfp => $nof1) {
              $notif_pending++;
            }

            ?>

            <?php if ($notif_pending != 0) : ?>
              <span class="badge bg-warning"><?= $notif_pending ?></span>
            <?php endif ?>
          </a>
        </li>

        <li class="">
          <a href="<?= base_url('aktual') ?>">
            <i class="fa fa-check"></i>
            <span>Aktual Success</span>
          </a>
        </li>

        <li class="">
          <a href="<?= base_url('aktual/pengajuan_BA') ?>">
            <i class="fa fa-envelope-open-text"></i>
            <span>Pengajuan Berita Acara</span>
          </a>
        </li>

        <!-- <li class="">
            <a href="<?= base_url('equestisi') ?>">
              <i class="fa fa-book"></i>
              <span>Equest</span>
              </a>
          </li> -->

        <!-- <li class="">
            <a href="<?= base_url('equestisi/cek') ?>">
              <i class="fa fa-bookmark"></i>
              <span>Cek Equest</span>
              </a>
          </li> -->

        <li class="">
          <a href="<?= base_url('shp/cekdata') ?>">
            <i class="fa fa-bookmark"></i>
            <span>Cek Data Kunjungan</span>
          </a>
        </li>

        <li class="">
          <a href="<?= base_url('shp/upload_foto_temuan') ?>">
            <i class="fa fa-plus"></i>
            <span>Upload Foto Temuan</span>
          </a>
        </li>

        <li class="">
          <a href="<?= base_url('shp/cekdatatemuan') ?>">
            <i class="fa fa-camera"></i>
            <span>Data Foto Temuan</span>
          </a>
        </li>

        <!-- <li class="">
            <a href="<?= base_url('shp') ?>">
              <i class="fa fa-quote-right"></i>
              <span>Daftar Dialog</span>
              </a>
          </li> -->

        <!-- <li class="">
            <a href="<?= base_url('rekaman') ?>">
              <i class="fa fa-microphone"></i>
              <span>Rekaman</span>
              </a>
          </li> -->

        <!-- <li class="">
            <a href="<?= base_url('shp/daftarkunjungan') ?>">
              <i class="fa fa-camera"></i>
              <span>Bukti Kunjungan</span>
              </a>
          </li> -->
      <?php
      } //endif
      ?>

      <!-- <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-book"></i>
              <span>Extra Pages</span>
              </a>
            <ul class="sub">
              <li><a href="blank.html">Blank Page</a></li>
              <li><a href="login.html">Login</a></li>
              <li><a href="lock_screen.html">Lock Screen</a></li>
              <li><a href="profile.html">Profile</a></li>
              <li><a href="invoice.html">Invoice</a></li>
              <li><a href="pricing_table.html">Pricing Table</a></li>
              <li><a href="faq.html">FAQ</a></li>
              <li><a href="404.html">404 Error</a></li>
              <li><a href="500.html">500 Error</a></li>
            </ul>
          </li> -->
    </ul>
    <!-- sidebar menu end-->
  </div>
</aside>
<!--sidebar end-->