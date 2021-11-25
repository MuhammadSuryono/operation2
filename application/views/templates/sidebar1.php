<?php
            $id_user = $this->session->userdata('id_user');
            $user = $this->db->get_where('data_user', ['id_user' => $id_user])->row_array();
?>

<!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
          <p class="centered"><a href="#"><img src="<?= base_url('assets/')?>avatar1.png" class="img-circle" width="80"></a></p>
          <h5 class="centered"><?= $user['nama_user']?></h5>

          <?php if ($user['id_akses'] == 1) :?>

          <li class="mt">
            <a href="<?= base_url('akun')?>">
              <i class="fa fa-user"></i>
              <span>Research Analyst</span>
              </a>
          </li>
          <li class="">
            <a href="<?= base_url('dashboard')?>">
              <i class="fa fa-dashboard"></i>
              <span>Shopper</span>
              </a>
          </li>
          <li class="">
            <a href="<?= base_url('project')?>">
              <i class="fa fa-paperclip"></i>
              <span>Project</span>
              </a>
          </li>
          <li class="">
            <a href="<?= base_url('skenario')?>">
              <i class="fa fa-list"></i>
              <span>Skenario</span>
              </a>
          </li>
          <li class="">
            <a href="<?= base_url('cabang')?>">
              <i class="fa fa-building-o"></i>
              <span>Cabang</span>
              </a>
          </li>
          <li class="">
            <a href="<?= base_url('equestbaru/equest')?>">
              <i class="fa fa-book"></i>
              <span> Equest </span>
              </a>
          </li>

          <li class="">
            <a href="<?= base_url('skenario/kunjungan')?>">
              <i class="fa fa-sort-amount-asc"></i>
              <span>Skenario Kunjungan</span>
              </a>
          </li>

          <li class="">
            <a href="<?= base_url('skenario/shp')?>">
              <i class="fa fa-suitcase"></i>
              <span>Kunjungan SHP</span>
              </a>
          </li>

          <li class="">
            <a href="<?= base_url('validasi')?>">
              <i class="fa fa-camera"></i>
              <span>Bukti Kunjungan</span>
              </a>
          </li>

          <li class="">
            <a href="<?= base_url('validasi/rekaman')?>">
              <i class="fa fa-microphone"></i>
              <span>Rekaman</span>
              </a>
          </li>

          <li class="">
            <a href="<?= base_url('time')?>">
              <i class="fa fa-clock-o"></i>
              <span>Kolom Time Delivery</span>
              </a>
          </li>

          <li class="">
            <a href="<?= base_url('validasi/valid')?>">
              <i class="fa fa-repeat"></i>
              <span>Validasi Data</span>
              </a>
          </li>

          <li class="">
            <a href="<?= base_url('proses/buatkonsistensi')?>">
              <i class="fa fa-bookmark"></i>
              <span>Buat Konsistensi </span>
              </a>
          </li>

          <li class="">
            <a href="<?= base_url('proses')?>">
              <i class="fa fa-check-circle"></i>
              <span>Cek Data</span>
              </a>
          </li>

          <li class="">
            <a href="<?= base_url('proses/inkonsistensi')?>">
              <i class="fa fa-times-circle"></i>
              <span>Data Inkonsistensi</span>
              </a>
          </li>

          <li class="">
            <a href="<?= base_url('proses/kolom')?>">
              <i class="fa fa-gear"></i>
              <span>Proses Kolom</span>
              </a>
          </li>

          <li class="">
            <a href="<?= base_url('rekap/buatkolom')?>">
              <i class="fa fa-thumb-tack"></i>
              <span>Buat Kolom Skill</span>
              </a>
          </li>

          <li class="">
            <a href="<?= base_url('rekap')?>">
              <i class="fa fa-paste"></i>
              <span>Rekap Skill</span>
              </a>
          </li>

          <li class="">
            <a href="<?= base_url('rekap/hasil')?>">
              <i class="fa fa-tags"></i>
              <span>Hasil Rekap Skill</span>
              </a>
          </li>

          <li class="">
            <a href="<?= base_url('upload')?>">
              <i class="fa fa-chevron-circle-up"></i>
              <span>Upload Kolom</span>
              </a>
          </li>

          <?php endif?>
          <li class="">
            <?php if ($user['id_akses'] == 1) :?>
            <a href="<?= base_url('equest')?>">
            <?php endif?>
            <?php if ($user['id_akses'] == 2) :?>
            <a href="<?= base_url('equest/shp')?>">
            <?php endif?>
              <i class="fa fa-book"></i>
              <span>Kuis</span>
              </a>
          </li>
          <?php if ($user['id_akses'] == 2) :?>
          <li class="">
            <a href="<?= base_url('notifikasi')?>">
              <i class="fa fa-bell"></i>
              <span>Notifikasi</span>
              <?php //$notif = $this->db->get_where('data_jawaban_equest', ['id_user' => $id_user, 'ket_cek !=' => '', 'ket_jawab' => ''])->result_array();
              $notif1 = 0;
              //foreach($notif as $ntf => $nof){
                //$notif1++;
              //}
              $notif = $this->db->get_where('data_jawaban_equest', ['id_user' => $id_user, 'ket_cek !=' => '', 'sts' => 3])->result_array();
              foreach($notif as $ntf => $nof){
                $kodenotif = explode(",", $nof['ket_cek']);
                $jawab = explode("|", $nof['ket_jawab']);
                $notif1 = $notif1 + (count($kodenotif)-count($jawab));
              }
              ?>
              <?php if($notif1 != 0):?>
              <span class="badge bg-warning"><?=$notif1?></span>
              <?php endif?>
              </a>
          </li>

          <li class="">
            <a href="<?= base_url('equest/daftarnilai')?>">
              <i class="fa fa-star"></i>
              <span>Score Kuis</span>
              </a>
          </li>

           <li class="">
            <a href="<?= base_url('aktual/pending')?>">
              <i class="fa fa-times"></i>
              <span>Aktual Pending</span>
              </a>
          </li>

          <li class="">
            <a href="<?= base_url('aktual')?>">
              <i class="fa fa-check"></i>
              <span>Aktual Success</span>
              </a>
          </li>

          <li class="">
            <a href="<?= base_url('equestisi')?>">
              <i class="fa fa-book"></i>
              <span>Equest</span>
              </a>
          </li>

          <li class="">
            <a href="<?= base_url('equestisi/cek')?>">
              <i class="fa fa-bookmark"></i>
              <span>Cek Equest</span>
              </a>
          </li>

          <li class="">
            <a href="<?= base_url('shp')?>">
              <i class="fa fa-quote-right"></i>
              <span>Daftar Dialog</span>
              </a>
          </li>

          <li class="">
            <a href="<?= base_url('rekaman')?>">
              <i class="fa fa-microphone"></i>
              <span>Rekaman</span>
              </a>
          </li>

          <li class="">
            <a href="<?= base_url('shp/daftarkunjungan')?>">
              <i class="fa fa-camera"></i>
              <span>Bukti Kunjungan</span>
              </a>
          </li>
          <?php endif?>
          <li class="sub-menu">
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
          </li>
        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->
