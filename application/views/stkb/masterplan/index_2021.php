<!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
<!--main content start-->
<?php
date_default_timezone_set('Asia/Jakarta');
?>
<style>
    .borderless td,
    .borderless th {
        border: none !important;
    }
</style>


<section id="main-content">
    <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> STKB</h3>
        <div class="row mt">
            <div class="col-lg-12">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-panel">
                            <h4 class="mb text-primary"><strong> <i class="fa fa-angle-right"></i> Master Plan </strong> </h4>

                            <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>

                            <section id="unseen">

                                <!-- Mulai codingan -->
                                <form action="<?php echo base_url('stkb/tambahmasterplan_2021') ?>" method="POST" enctype="multipart/form-data" id="formmasterplan">

                                    <input type="hidden" name="kareg" id="karegted" value="<?php echo $this->session->userdata('id_user'); ?>">

                                    <div class="form-group">
                                        <label><b>Project : </b></label>
                                        <select class="form-control" name="project" id="projectted_2021" required>
                                            <option value="">Pilih Project</option>
                                            <?php
                                            foreach ($masterplanproject as $project) {
                                            ?>
                                                <option value="<?php echo $project['kode']; ?>"><?php echo $project['nama']; ?></option>
                                            <?php
                                            }
                                            ?>
                                            <select>
                                    </div>
                                    <input type="hidden" name="type_pjk" id="type_pjk" readonly>

                                    <div class="form-group">
                                        <label><b>Kota : </b></label>
                                        <select class="kota form-control" name="kota" id="kotated_2021" required>
                                            <option value="">Pilih kota</option>
                                        </select>
                                    </div>

                                    <!-- <div id="showCheckAll" style="display:none;">
              <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-8">
                  <div class="form-group">
                    <input type="checkbox" id="checkAllSkenario" disabled>
                    <label for="checkAllSkenario">Checklist All</label>
                  </div>
                </div>
              </div>
            </div> -->
                                    <div id="tampilancabang"></div>
                                    <div id="tampilanbackup" style="display: none;">
                                        <div class="row">
                                            <div class="col-sm-4"></div>
                                            <div class="form-group col-sm-5" data-trigger="hover" data-toggle="popover" data-placement="top" title="Jumlah Backup Rekening" data-content="Jika Kota diluar dari daftar kota berikut : ('Jakarta', 'Jakarta Timur', 'Jakarta Selatan', 'Jakarta Barat', 'Jakarta Utara', 'Jakarta Pusat', 'Tangerang', 'Tangerang Selatan', 'Bekasi', 'Bogor', 'Depok', 'Sukabumi', 'Serang', 'Cilegon', 'Cibubur', 'Cibinong', 'Ciputat', 'Karawang', 'Jabodetabek') dan memiliki 1 atau 2 cabang maka Backup menjadi 1, selain itu Backup menjadi 0.">
                                                <label for="backuprek"><b>Jumlah Backup Rekening (bila ada) :</b></label>
                                                <input id="valStateBackup" type="hidden" value="0">
                                                <input id="valBackup2" type="number" class="form-control" min="0" name="backuprek" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="ajukanNamaLain" class="form-group" style="display:none;">
                                        <div>
                                            <label><b>Nama Area Head :</b></label>
                                            <select class="form-control selectpicker" data-live-search="true" name="nama_ah" id="namaah" required>
                                                <option value="">Pilih Nama</option>
                                                <select>
                                        </div>
                                        <br>
                                        <div>
                                            <label><b>Nama Field Officer :</b></label><a href="javascript;" data-toggle="modal" data-target="#pengajuanLintasPulau" class="btn btn-primary" style="font-size:10px;float:right;">Ajukan Nama Lain</a>
                                            <select class="form-control selectpicker" data-live-search="true" name="nama_fo" id="namafo" required>
                                                <option value="">Pilih Nama</option>
                                                <select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label><b>Kota dari : </b></label>
                                        <select class="form-control selectpicker" data-live-search="true" name="kotadari" id="kotadari" required>
                                            <option value="">Pilih Kota dari</option>
                                            <?php
                                            foreach ($masterplankota as $kota) {
                                            ?>
                                                <option value="<?php echo $kota['kabupatenkota']; ?>"><?php echo $kota['kabupatenkota']; ?></option>
                                            <?php
                                            }
                                            ?>
                                            <select>
                                    </div>

                                    <div class="form-group">
                                        <label><b>Kota Dinas : </b></label>
                                        <select class="form-control selectpicker" data-live-search="true" name="kotadinas" id="kotadinas" required>
                                            <option value="">Pilih Kota dinas</option>
                                            <?php
                                            foreach ($masterplankota as $kota) {
                                            ?>
                                                <option value="<?php echo $kota['kabupatenkota']; ?>"><?php echo $kota['kabupatenkota']; ?></option>
                                            <?php
                                            }
                                            ?>
                                            <select>
                                    </div>

                                    <div class="row">

                                        <div class="col-sm-4" data-trigger="hover" data-toggle="popover" data-placement="top" title="Penugasan" data-content="Jika Kota Asal dan Kota Dinas sama maka Penugasan menjadi Setempat, jika berbeda menjadi Dinas. 'Jakarta', 'Jakarta Timur', 'Jakarta Selatan', 'Jakarta Barat', 'Jakarta Utara', 'Jakarta Pusat', 'Tangerang', 'Tangerang Selatan', 'Bekasi', 'Bogor', 'Depok', 'Sukabumi', 'Serang', 'Cilegon', 'Cibubur', 'Cibinong', 'Ciputat', 'Karawang', 'Jabodetabek' Untuk Kota Asal dan Kota Dinas kota-kota tersebut di anggap Setempat.">
                                            <div class="form-group">
                                                <label><b>Penugasan : </b></label>
                                                <input type="text" name="penugasan" id="penugasan" required readonly class="form-control">
                                                <!-- <select class="form-control" name="penugasan" id="penugasan" required>
                      <option value="">Pilih penugasan</option>
                      <option value="Setempat">Setempat</option>
                      <option value="Dinas">Dinas</option>
                      <option value="Mutasi">Mutasi</option>
                    <select> -->
                                                <!-- <button type="button" class="btn btn-info" ><i class="far fa-question-circle"></i></button> -->
                                            </div>
                                        </div>

                                        <div class="col-sm-2" data-trigger="hover" data-toggle="popover" data-placement="top" title="Tanggal Penugasan" data-toggle="popover" title="Judul Popover" data-content="Tanggal Penugasan sudah termasuk perjalanan, persiapan, closing, pengecekkan kelengkapan data, dan perjalanan pulang.">
                                            <div class="form-group">
                                                <label><b>Tanggal Mulai Penugasan : </b></label>
                                                <input type="date" name="planstart" class="form-control" min="<?php //echo date('Y-m-d'); 
                                                                                                                ?>" required>
                                            </div>
                                        </div>

                                        <div class="col-sm-2" data-trigger="hover" data-toggle="popover" data-placement="top" title="Tanggal Penugasan" data-toggle="popover" title="Judul Popover" data-content="Tanggal Penugasan sudah termasuk perjalanan, persiapan, closing, pengecekkan kelengkapan data, dan perjalanan pulang.">
                                            <div class="form-group">
                                                <label><b>Tanggal Selesai Penugasan : </b></label>
                                                <input type="date" name="planend" id="tglpenugasan" class="form-control" min="<?php //echo date('Y-m-d'); 
                                                                                                                                ?>" required>
                                            </div>
                                        </div>

                                        <!-- <div class="col-sm-2">
                <div class="form-group">
                 <label>Tanggal Mulai Pengerjaan : </label>
                  <input type="date" name="planstartPengerjaan" class="form-control" min="<?php //echo date('Y-m-d'); 
                                                                                            ?>" required>
                </div>
              </div>

              <div class="col-sm-2">
                <div class="form-group">
                  <label>Tanggal Selesai Pengerjaan : </label>
                    <input type="date" name="planendPengerjaan" class="form-control" min="<?php //echo date('Y-m-d'); 
                                                                                            ?>" required>
                </div>
              </div> -->

                                    </div>

                                    <!--div class="row">

              <div class="col-sm-6">
                <div class="form-group">
                 <label>Tanggal Mulai Pengerjaan : </label>
                  <input type="date" name="planstartPengerjaan" class="form-control" min="<?php //echo date('Y-m-d'); 
                                                                                            ?>" required>
                </div>
              </div>

              <div class="col-sm-6">
                <div class="form-group">
                  <label>Tanggal Selesai Pengerjaan : </label>
                    <input type="date" name="planendPengerjaan" class="form-control" min="<?php //echo date('Y-m-d'); 
                                                                                            ?>" required>
                </div>
              </div>

            </div-->
                                    <div id="tabel_itinerary"></div>

                                    <div class="form-group">
                                        <label for="suratpernyataan"><b>Surat Pernyataan :</b></label>
                                        <?php
                                        $format = $this->db->query("SELECT * FROM format_file where jenis='Surat Pernyataan STKB'")->row_array(); ?>
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <p>Format Surat Pernyataan
                                                    <!-- <?php if ($format['nama_file'] != NULL) {

                                                                echo "<a href='' type='button' onclick='window.open(\"" . base_url() . "assets/file/pernyataan/" . $format['nama_file'] . "\", \"newwindow\", \"width=810,height=900\"); return false;'><i class='fa fa-file'></i> View</a>";
                                                            } else {
                                                                echo "";
                                                            } ?> -->
                                                    <!-- </p> -->
                                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">
                                                        View
                                                    </button>
                                                </p>
                                            </div>
                                            <div class="col-sm-2">
                                                <!-- <p>Setujui surat pernyataan <input type="checkbox" name="check_pernyataan" id="check_pernyataan" value="pernyataan"></p> -->
                                            </div>
                                        </div>
                                        <span class="bg-info p-1"><b>NOTE!</b></span>&nbsp;&nbsp;Button Submit dapat di klik jika sudah menyetujui Surat Pernyataan!

                                        <!-- <input type="file" class="form-control" name="suratpernyataan" accept="application/pdf" required>
              <span class="bg-info p-1">NOTE!</span>&nbsp;&nbsp;Format Surat Pernyataan(.pdf)
               -->
                                    </div>

                                    <!-- <div id="checkBackup" class="form-group" style="display:none;">
              <label for="backuprek">Jumlah Backup Rekening (bila ada) :</label>
              <input id="valStateBackup" type="hidden" value="0">
              <input id="valBackup" type="number" class="form-control" min="0" name="backuprek">
            </div> -->
                                    <!-- <div class="form-group" data-trigger="hover" data-toggle="popover" data-placement="top" title="Jumlah Backup Rekening" data-content="Jika Kota diluar dari daftar kota berikut : ('Jakarta', 'Jakarta Timur', 'Jakarta Selatan', 'Jakarta Barat', 'Jakarta Utara', 'Jakarta Pusat', 'Tangerang', 'Tangerang Selatan', 'Bekasi', 'Bogor', 'Depok', 'Sukabumi', 'Serang', 'Cilegon', 'Cibubur', 'Cibinong', 'Ciputat', 'Karawang', 'Jabodetabek') dan memiliki 1 atau 2 cabang maka Backup menjadi 1, selain itu Backup menjadi 0.">
              <label for="backuprek">Jumlah Backup Rekening (bila ada) :</label>
              <input id="valStateBackup" type="hidden" value="0">
              <input id="valBackup2" type="number" class="form-control" min="0" name="backuprek" readonly>
            </div> -->




                                    <br />


                                    <!-- <div class="form-group">
              <label for="user">Itinerary</label>
              <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover table-condensed">
                <thead>
                  <tr>
                    <td><b>Hari</b></td>
                    <?php
                    foreach ($getallitinerary as $key) {
                    ?>
                    <td><?php echo $key['keterangan'] ?></td>
                    <?php
                    }
                    ?>
                  </tr>
                </thead>
                <tbody>
                  <?php for ($i = 1; $i <= 7; $i++) {
                    ?>
                  <tr>
                    <td><b>Hari Ke <?php echo $i; ?></b></td>
                    <?php
                        foreach ($getallitinerary as $key) {
                    ?>
                    <td><center><input type="checkbox" class="form-check-input" name="<?php echo $i;
                                                                                        echo "_";
                                                                                        echo $key['no']; ?>" value="<?php echo $key['no'] ?>"><center></td>
                    <?php
                        }
                    ?>
                  </tr>
                  <?php
                    } ?>
                </tbody>
              </table>
            </div> -->



                                    </br></br>
                                    <button type="submit" name="submit" class="btn btn-success" onclick="onSubmit()" id="submitmasterplan">Submit</button>

                                </form>
                                <!-- //End Coding -->
                            </section>



                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- /wrapper -->
</section>
<!-- /MAIN CONTENT -->

<div class="modal" id="pengajuanLintasPulau" tabindex="-1" role="dialog" aria-labelledby="pengajuanLintasPulau" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Pengajuan Lintas Pulau</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="idkaregnya" id="idkaregnya" value="<?= $this->session->userdata('id_user'); ?>">

                <div class="form-group">
                    <label>Nama:</label>
                    <select class="form-control selectpicker" data-live-search="true" name="idpicnya" id="idpicnya" required>
                        <option value="">Pilih Nama</option>
                        <?php
                        foreach ($masterplannama as $nama) {
                        ?>
                            <option value="<?php echo $nama['id']; ?>"><?php echo $nama['nama']; ?> - <?php echo $nama['id']; ?> - <?php echo $nama['kota_asal']; ?></option>
                        <?php
                        }
                        ?>
                        <select>
                </div>

                <div class="form-group">
                    <label>Kota Dinas:</label>
                    <input type="text" id="kotadinasnya" name="kotadinasnya" class="form-control form-control-user" readonly>
                </div>
                <?php $getemail = $this->db->get_where('user', array('noid' => '001'))->row_array(); ?>
                <div class="form-group">
                    <label>Nama Approval:</label>
                    <input type="text" id="nama_approval" name="nama_approval" class="form-control form-control-user" value="<?php echo $getemail['name'] ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Email Approval:</label>
                    <input type="email" id="email_approval" name="email_approval" class="form-control form-control-user" placeholder="ex : name@example.com" required value="<?php echo $getemail['email'] ?>" readonly>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnSubmitPengajuan" onclick="submitPengajuan()">Ajukan</button>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-sm borderless" cellpadding="5">

                    <tr>
                        <td colspan="2" style="text-align: center; font-weight: bold">
                            <h4><b>SURAT PERNYATAAN KOMITMEN</b></h4>
                        </td>
                    </tr>
                    <!-- <tr >
                                       <td colspan="2"></td>
                                    </tr> -->
                    <tbody style="font-size: 14px;">
                        <tr>
                            <td colspan="2" style="text-align: justify;">Dengan ini saya <span id="picku"></span> berjanji bahwa selama menjalankan tugas sebagai PIC project MS <span id="projectku"></span> di kota <span id="kotadinasku"></span> untuk perusahaan PT. Marsindo Konsult Prima (MRI), akan memenuhi ketentuan berikut ini :
                            </td>
                        </tr>
                        <tr>
                            <td width="5%" valign="top">1. </td>
                            <td style="text-align: justify;">WAJIB MENGAKTUALKAN HASIL KUNJUNGAN SETELAH SELESAI KUNJUNGAN MELALUI APLIKASI</td>
                        </tr>
                        <tr>
                            <td width="5%" valign="top">2. </td>
                            <td style="text-align: justify;">SEGERA MEMBUAT LAPORAN KUNJUNGAN DENGAN KETENTUAN SEBAGAI BERIKUT:</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="text-align: justify;">- DIALOG & EQUEST = PALING LAMBAT H+1 JAM 12.00</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="text-align: justify;"> DIALOG DAN CAPTURE BUKTI E-QUEST DIUPLOAD MELALUI LINK : https://180.211.92.132/operation2/</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="text-align: justify;">- REKAMAN KUNJUNGAN = PADA HARI H, KE LINK :</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="text-align: justify;"> &nbsp;&nbsp;&nbsp;A. File B1 (Jakarta) : http://bit.ly/uploadB1JKT</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="text-align: justify;"> &nbsp;&nbsp;&nbsp;B. File B1 (Luar Kota) :http://bit.ly/uploadB1LK</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="text-align: justify;">- BUKTI TEMUAN KUNJUNGAN (EVIDENCE) = PADA HARI H</td>
                        </tr>

                        <tr>
                            <td width="5%" valign="top">3. </td>
                            <td style="text-align: justify;">WAJIB MEREALISASIKAN DANA TRANSAKSI TELLER SETIAP HARI JUMAT DAN DANA BUKA REKENING SETELAH MASA KERJA STKB BERAKHIR</td>
                        </tr>

                        <tr>
                            <td width="5%" valign="top">4. </td>
                            <td style="text-align: justify;">APABILA ADA KESULITAN DAN HAMBATAN DI LAPANGAN SEGERA MENGINFORMASIKAN KE ATASAN LANGSUNG</td>
                        </tr>

                        <tr>
                            <td width="5%" valign="top">5. </td>
                            <td style="text-align: justify;">MEMBAYAR BPJS KESEHATAN YANG DIDAPATKAN DARI STKB PENUGASAN. APABILA SAYA TIDAK MEMBAYARKAN BPJS DAN TERJADI SESUATU TERHADAP SAYA MAKA SAYA BERTANGGUNG JAWAB PENUH DAN TIDAK MENUNTUT KE MRI</td>
                        </tr>


                        <tr>
                            <td colspan="2" style="text-align: justify;">
                                Demikian Surat Pernyataan ini saya buat. Bilamana dari poin 1 s/d poin 5 di atas saya terbukti melakukan pelanggaran, maka saya bersedia <b>DIBERIKAN TEGURAN/ BLACK LIST</b> dari perusahaan.
                            </td>

                        </tr>

                    </tbody>
                </table>
                <hr width="100%" style="height:0; border-top:3px solid #DCDCDC;">
                <h5><b>Setujui surat pernyataan</b> <input type="checkbox" name="check_pernyataan" id="check_pernyataan" value="pernyataan"></h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>

<!--main content end-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<script>
    $("input[type=checkbox]").on("change", function(evt) {
        var hoby = $('input[id=check_pernyataan]:checked');
        if (hoby.length == 0) {
            $("button[name=submit]").prop("disabled", true);
        } else {
            $("button[name=submit]").prop("disabled", false);
        }
    });

    $(document).ready(function() {
        $('[data-toggle="popover"]').popover();
    });



    $("input").on("change", function() {
        this.setAttribute(
            "data-date",
            moment(this.value, "YYYY-MM-DD")
            .format(this.getAttribute("data-date-format"))
        )
    }).trigger("change")

    function onSubmit() {
        $('#kotadari').attr('disabled', false);
        $('#kotadari').selectpicker('refresh');
        $('#kotadinas').attr('disabled', false);
        $('#kotadinas').selectpicker('refresh');
    }

    function submitPengajuan() {
        var project = $('#projectted_2021').val(),
            kareg = $('#idkaregnya').val(),
            pic = $('#idpicnya').val(),
            kota = $('#kotadinasnya').val(),
            nama_approval = $('#nama_approval').val(),
            email_approval = $('#email_approval').val();
        if (project != '' && kareg != '' && pic != '' && kota != '') {
            $('#btnSubmitPengajuan').attr('disabled', true);
            $('#btnSubmitPengajuan').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Mengajukan...');
            $.ajax({
                url: "<?php echo base_url('stkb/submitpengajuanlintaspulau') ?>",
                method: "POST",
                data: {
                    project: project,
                    kareg: kareg,
                    pic: pic,
                    kota: kota,
                    email_approval: email_approval,
                    nama_approval: nama_approval
                },
                async: false,
                dataType: 'json',
                success: function(hasil) {
                    console.log(hasil);
                    if (hasil == 'sukses') {
                        Swal({
                            position: 'top',
                            type: 'success',
                            title: 'Pengajuan berhasil dilakukan, silahkan tunggu notifikasi melalui email',
                            button: "OK!",
                            // showConfirmButton: false,
                            // timer: 20000
                        });
                    } else if (hasil == 'sukses2') {
                        Swal({
                            position: 'top',
                            type: 'success',
                            title: 'Pengajuan berhasil dilakukan',
                            html: '<span class="text-danger" style="font-size:16px;font-weight:bold;">Email notifikasi ke manajemen gagal dikirim!</span>',
                            button: "OK!",
                            // showConfirmButton: false,
                            // timer: 5000
                        });
                    } else {
                        Swal({
                            position: 'top',
                            type: 'error',
                            title: 'Gagal melakukan pengajuan, pengajuan sebelumnya sudah dilakukan',
                            button: "OK!"
                            // showConfirmButton: false,
                            // timer: 4000
                        });
                    }
                    $('#pengajuanLintasPulau').modal('hide');
                    $('#btnSubmitPengajuan').attr('disabled', false);
                    $('#btnSubmitPengajuan').html('Ajukan');
                },
                error: function(request, status, error) {
                    Swal({
                        position: 'top',
                        type: 'error',
                        title: 'Terjadi kesalahan, gagal mengajukan form lintas pulau',
                        showConfirmButton: false,
                        timer: 2000
                    });
                    $('#pengajuanLintasPulau').modal('hide');
                    $('#btnSubmitPengajuan').attr('disabled', false);
                    $('#btnSubmitPengajuan').html('Ajukan');
                }
            });
        } else {
            Swal({
                position: 'top',
                type: 'error',
                title: 'Silahkan isi semua formulir yang ada',
                showConfirmButton: false,
                timer: 2000
            });
        }
    }

    function checkBox(idnya, val) {
        var id = '#' + val + idnya;
        // var ceklist = id.substring(id.length - 1, id.length); // LAMA ERROR
        var ceklist = idnya.substr(3, 10); // BARU 30 NOVEMBER 2020
        // console.log("ID: "+id+" | CEK: "+ceklist);
        var valCeklist = parseInt($('#ceklist' + ceklist).val());
        var cekStateBackup = parseInt($("#valStateBackup").val());
        var addValCeklist = 0;
        // console.log("ID VAL: "+$(id).val());
        if ($(id).is(':checked')) {

            if ($(id).val() == '001' || $(id).val() == '002' || $(id).val() == '064' || $(id).val() == '065' || $(id).val() == '066') {
                if (valCeklist >= 0 && valCeklist <= 2) {

                    if (valCeklist == 0) {
                        var addStateBackup = cekStateBackup + 1;
                        $("#valStateBackup").val(addStateBackup);
                        $('#ceklist' + ceklist).val(1);
                    }
                    if (valCeklist == 1) {
                        addValCeklist = valCeklist + 1;
                        $('#ceklist' + ceklist).val(addValCeklist);
                    }

                }
            }

        } else {

            if ($(id).val() == '001' || $(id).val() == '002' || $(id).val() == '064' || $(id).val() == '065' || $(id).val() == '066') {
                if (valCeklist <= 2) {
                    addValCeklist = valCeklist - 1;
                    $('#ceklist' + ceklist).val(addValCeklist);

                    if (valCeklist == 1) {
                        addValCeklist = valCeklist - 1;
                        $('#ceklist' + ceklist).val(addValCeklist);
                        var addStateBackup = cekStateBackup - 1;
                        $("#valStateBackup").val(addStateBackup);
                    }

                }
            }

        }

        var checkBackurek = $("#valStateBackup").val();
        if (checkBackurek > 0) {
            $("#checkBackup").show();
            var x = checkBackurek;
            var y = 2;
            var a = x / y;
            var b = x % y;

            if (b == 1) {
                var nilai = a.toString();
                nilai = Math.trunc(nilai);
            } else {
                var nilai = a;
            }
            $("#valBackup").val(nilai);
            $("#valBackup").attr('max', nilai);
        } else {
            $("#checkBackup").hide();
            $("#valBackup").val(0);
            $("#valBackup").attr('max', 0);
        }
        $("#valBackup").val(0); // SET KE 0 LAGI UNTUK JUML
    }
</script>