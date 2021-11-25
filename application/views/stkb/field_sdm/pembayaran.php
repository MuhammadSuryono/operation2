<?php
$id_user = $this->session->userdata('id_user');
// var_dump($id_user); die;
if ($this->db->get_where('user', ['noid' => $id_user])->num_rows() >= 1) {
    $user = $this->db->get_where('user', ['noid' => $id_user])->row_array();
    $nama = $user['name'];
} else {
    $user = $this->db->get_where('id_data', ['Id' => $id_user])->row_array();
    $nama = $user['Nama'];
}
?>


<!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
<!--main content start-->

<section id="main-content">
    <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Pembayaran Field</h3>
        <div class="row mt">
            <div class="col-lg-12">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-panel">
                            <h4 class="mb text-primary"><strong> <i class="fa fa-angle-right"></i> Pembayaran Field SDM </strong> </h4>
                            <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
                            <?php if ($this->session->flashdata('flash-fail')) { ?>
                                <div class="alert alert-danger"> <?= $this->session->flashdata('flash-fail') ?> </div>
                            <?php } ?>

                            <section id="unseen">

                                <ul onclick="aktif()" class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#pengajuan">Cek Pengajuan</a></li>
                                    <li><a data-toggle="tab" href="#term1">Cek Term 1</a></li>
                                    <li><a data-toggle="tab" href="#term2">Cek Term 2</a></li>
                                    <li><a data-toggle="tab" href="#term3">Cek Term 3</a></li>
                                    <li><a data-toggle="tab" href="#menu1">Ready To Paid (MRI Kas)</a></li>
                                    <li><a data-toggle="tab" href="#menu2">Ready To Paid (MRI PAL)</a></li>
                                    <li><a data-toggle="tab" href="#menu3">Paid</a></li>
                                    <!-- <li><a data-toggle="tab" href="#menu3">Project</a></li> -->
                                    <!-- <li><a data-toggle="tab" href="#stkbminus">STKB Minus</a></li> -->
                                </ul>

                                <div class="tab-content">

                                    <!-- Pengajuan -->
                                    <input type="hidden" id="statepengajuan" value="0">
                                    <div id="pengajuan" class="tab-pane fade in active">

                                    </div>
                                    <!-- //Pengajuan -->

                                    <!-- Term 1 -->
                                    <input type="hidden" id="stateterm1" value="0">
                                    <div id="term1" class="tab-pane fade in active">

                                    </div>
                                    <!-- //Term 1 -->

                                    <!-- Term 2 -->
                                    <input type="hidden" id="stateterm2" value="0">
                                    <div id="term2" class="tab-pane fade">

                                    </div>
                                    <!-- Term 2 -->


                                    <!-- Term 3 -->
                                    <input type="hidden" id="stateterm3" value="0">
                                    <div id="term3" class="tab-pane fade">

                                    </div>
                                    <!-- //TERM 3 -->


                                    <input type="hidden" id="statemenu1" value="0">
                                    <div id="menu1" class="tab-pane fade">

                                    </div>

                                    <input type="hidden" id="statemenu2" value="0">
                                    <div id="menu2" class="tab-pane fade">

                                    </div>
                                    <input type="hidden" id="statemenu3" value="0">
                                    <div id="menu3" class="tab-pane fade">

                                    </div>

                                    <!-- <input type="hidden" id="statemenu3" value="0">
                                    <div id="menu3" class="tab-pane fade">

                                    </div> -->

                                    <!-- <div id="stkbminus" class="tab-pane fade">
                                        <div class="table-responsive" style="margin-top: 20px;">
                                            <table class=" table table-bordered table-striped table-condensed" id="dataTables-example-2">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Nomor Stkb</th>
                                                        <th>Project</th>
                                                        <th>Nama</th>
                                                        <th>Tanggal Mulai</th>
                                                        <th>Tanggal Selesai</th>
                                                        <th>Total</th>
                                                        <th>Term 1</th>
                                                        <th>Tanggal Bayar</th>
                                                        <th>No Voucher</th>
                                                        <th>Aktual Bayar</th>
                                                        <th>Term 2</th>
                                                        <th>Tanggal Bayar</th>
                                                        <th>No Voucher</th>
                                                        <th>Aktual Bayar</th>
                                                        <th>Term 3</th>
                                                        <th>Tanggal Bayar</th>
                                                        <th>No Voucher</th>
                                                        <th>Aktual Bayar</th>
                                                        <th>Print</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $q = $this->db->query("SELECT
                                                              a.*, b.nama namanya, c.nama namaproject
                                                            FROM
                                                              stkb_trk a
                                                            JOIN stkb_sdm b ON a.nama = b.id
                                                            JOIN project c ON a.project = c.kode
                                                            WHERE c.type = 'n' AND a.term1 <= -1 OR a.term2 <= -1 OR a.term3 <= -1
                                                            ORDER BY
                                                              nostkb DESC ")->result();
                                                    $no = 1;
                                                    foreach ($q as $row) {

                                                    ?>
                                                        <tr>
                                                            <td><?php echo $no++; ?></td>
                                                            <td><?php echo $row->nostkb; ?></td>
                                                            <td><?php echo $row->project . " - " . $row->namaproject; ?></td>
                                                            <td><?php echo $row->namanya; ?></td>
                                                            <td><?php echo $row->planstart; ?></td>
                                                            <td><?php echo $row->planend; ?></td>
                                                            <td><?php echo $row->total; ?></td>
                                                            <td bgcolor="#e3f3fc"><?php echo 'Rp. ' . number_format($row->term1, 0, '', ','); ?></td>
                                                            <td bgcolor="#e3f3fc"><?php echo $row->tglpembayaran1; ?></td>
                                                            <td bgcolor="#e3f3fc"><?php echo $row->novoucher1; ?></td>
                                                            <td bgcolor="#e3f3fc"><?php echo 'Rp. ' . number_format($row->aktualbayar1, 0, '', ','); ?></td>
                                                            <td bgcolor="#e3f3fc"><?php echo 'Rp. ' . number_format($row->term2, 0, '', ','); ?></td>
                                                            <td bgcolor="#e3f3fc"><?php echo $row->tglpembayaran2; ?></td>
                                                            <td bgcolor="#e3f3fc"><?php echo $row->novoucher2; ?></td>
                                                            <td bgcolor="#e3f3fc"><?php echo 'Rp. ' . number_format($row->aktualbayar2, 0, '', ','); ?></td>
                                                            <td bgcolor="#e3f3fc"><?php echo 'Rp. ' . number_format($row->term3, 0, '', ','); ?></td>
                                                            <td bgcolor="#e3f3fc"><?php echo $row->tglpembayaran3; ?></td>
                                                            <td bgcolor="#e3f3fc"><?php echo $row->novoucher3; ?></td>
                                                            <td bgcolor="#e3f3fc"><?php echo 'Rp. ' . number_format($row->aktualbayar3, 0, '', ','); ?></td>
                                                            <td><a href="<?php echo base_url(); ?>stkb/printstkb/<?php echo $row->nostkb; ?>/<?php echo $row->term1; ?>" target="_blank"><i class="fa fa-print"></i> Print</a></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div> -->

                                </div>
                        </div>
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
<!--main content end-->

<div class="modal" id="bayarstkb" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Pembayaran STKB</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?php echo base_url('stkb/bayarstkb') ?>">
                    <input type="hidden" name="nomorstkb" id="nomorstkb">
                    <input type="hidden" name="pembayar" id="pembayar">
                    <input type="hidden" name="term" id="term">
                    <input type="hidden" name="statusbayar" value="Paid">

                    <div class="form-group">
                        <label>Total Akomodasi :</label>
                        <input type="number" id="akomodasi" name="akomodasi" class="form-control form-control-user" readonly>
                    </div>

                    <div class="form-group">
                        <label>Total Perdin :</label>
                        <input type="number" id="perdin" name="perdin" class="form-control form-control-user" readonly>
                    </div>

                    <div class="form-group">
                        <label>Total BPJS :</label>
                        <input type="number" id="bpjs" name="bpjs" class="form-control form-control-user" readonly>
                    </div>

                    <div class="form-group">
                        <label>Aktual Bayar STKB OPS :</label>
                        <input type="number" id="ops" name="ops" class="form-control form-control-user" readonly>
                    </div>

                    <div class="form-group">
                        <label>Aktual Bayar STKB TRK :</label>
                        <input type="number" id="trk" name="trk" class="form-control form-control-user" readonly>
                    </div>

                    <div class="form-group">
                        <label>Total Bayar :</label>
                        <input type="number" id="totalnya" name="total" class="form-control form-control-user" readonly>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Bayar :</label>
                        <input type="date" name="tanggalbayar" class="form-control form-control-user" required>
                    </div>

                    <div class="form-group">
                        <label>Nomor Voucher :</label>
                        <input type="text" name="novoucher" class="form-control form-control-user" maxlength="4" placeholder="0000" required>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="printstkb" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Print STKB</h4>
            </div>
            <div class="modal-body">
                <div class="fetched-data"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#table_minus').DataTable();
    });

    function printstkb(nomorstkb, term) {
        // alert(nomorstkb);
        $.ajax({
            type: 'post',
            url: '<?php echo base_url('stkb/printstkb') ?>',
            data: {
                nomorstkb: nomorstkb,
                term: term
            },
            success: function(data) {
                $('.fetched-data').html(data); //menampilkan data ke dalam modal
                $('#printstkb').modal();
            }
        });
    }

    //NEW BY ADAM SANTOSO
    function checkall1() {
        if ($("#checkAll1").prop("checked") == true) {
            $('input:checkbox[id^="agree1"]').prop('checked', true);
        } else if ($("#checkAll1").prop("checked") == false) {
            $('input:checkbox[id^="agree1"]').prop('checked', false);
        }
    }

    function checkall2() {
        if ($("#checkAll2").prop("checked") == true) {
            $('input:checkbox[id^="agree2"]').prop('checked', true);
        } else if ($("#checkAll1").prop("checked") == false) {
            $('input:checkbox[id^="agree2"]').prop('checked', false);
        }
    }

    function checkall3() {
        if ($("#checkAll3").prop("checked") == true) {
            $('input:checkbox[id^="agree3"]').prop('checked', true);
        } else if ($("#checkAll1").prop("checked") == false) {
            $('input:checkbox[id^="agree3"]').prop('checked', false);
        }
    }

    function aktif(val) {
        if (val) {
            var stateTab = 'state' + val.replace('#', '');
            var tab = val;
        } else {
            var stateTab = 'state' + $("#nav li a").context.activeElement.hash.replace('#', '');
            var tab = $("#nav li a").context.activeElement.hash;
        }

        if ($('#' + stateTab).val() == '0') {
            $(tab).empty().html("<div class='text-center' id='loading' style='margin:50px 50px;font-size:16px;'><i class='fas fa-spinner fa-spin'></i> Sedang mengambil data</div>");
            $.ajax({
                type: 'post',
                url: '<?= base_url('stkb/tab_pembayaran_field_sdm'); ?>',
                data: {
                    data: tab
                },
                success: function(data) {
                    $(tab).empty().html(data);
                    $('#' + stateTab).val('1');
                },
                error: function(jqXHR, error, errorThrown) {
                    $(tab).empty().html("<div class='text-center' id='loading' style='margin:50px 50px;font-size:16px;'><i class='fas fa-close'></i> Gagal mengambil data<br><span style='font-size:14px;'>Silahkan ulangi dengan klik pada menu tab yang anda pilih</span></div>");
                }
            });
        }
    }
</script>