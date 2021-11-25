<style>
    .dataTables_wrapper {
        min-height: 100px
    }

    .dataTables_processing {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 100%;
        margin-left: -50%;
        margin-top: -25px;
        padding-top: 5px;
        text-align: center;
        font-size: 1.2em;
        color: grey;
    }
</style>
<div class="table-responsive">
    <!-- <form action="<?php echo base_url('stkb/readytopaid') ?>" method="POST" enctype="multipart/form-data"> -->
    <input type="hidden" name="pengklik" value="<?php echo $this->session->userdata('id_user'); ?>">
    <table class=" table table-bordered table-striped table-condensed" id="mytablepengajuan">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Nama Project</th>
                <th>Jumlah STKB</th>
                <th>Jumlah Cabang</th>
                <th>Overall Progress</th>
                <th>Action</th>
                <th>Print</th>
            </tr>
        </thead>
    </table>
    <div class="row" style="margin:5px 5px">
        <div class="col-md-12 text-right append-here">
            <h3 id="totalpengajuanperpage"><?php //echo 'Rp. ' . number_format( $totalterm13, 0 , '' , ',' ); 
                                            ?></h3>
        </div>
        <?php if ($user['id_divisi'] == 7 or $user['id_divisi'] == 99) : ?>
            <div class="col-md-9"></div>
            <div class="col-md-1 text-center">
                <!-- <center><input type="checkbox" style="width: 30px" class="checkbox form-control" onclick="checkall1()" id="checkAll1" disabled /></center>
        <label for="checkAll1">Check All</label> -->
            </div>
            <!-- <div class="col-md-2 text-right"><button type="submit" class="btn btn-lg btn-success">Move To RTP <i class="fas fa-angle-double-right"></i></button></div> -->
            <?php
            //CEK APAKAH ADA PENGAJUAN KAS YANG BELUM TERBAYAR, JIKA BELUM TERBAYAR BUTTON RTP DI DISABLE
            $cek_ajukan = $this->db->query("SELECT * FROM stkb_pembayaran where kode_kas is not null and (status_kas='1' or status_kas is null) and statusbayar='RTP'")->row();
            if ($cek_ajukan == NULL) {
            ?>
                <!-- <div class="col-md-2 text-right"><button type="submit" class="btn btn-lg btn-success">Move To RTP <i class="fas fa-angle-double-right"></i></button></div> -->
            <?php } else { ?>
                <!-- <div class="col-md-2 text-right"><button type="submit" class="btn btn-lg btn-success" disabled>Move To RTP <i class="fas fa-angle-double-right"></i></button></div> -->

        <?php  }
        endif ?>
    </div>
    <!-- </form> -->
</div>

<div class="modal fade" id="pengajuanModal" tabindex="-1" role="dialog" aria-labelledby="pengajuanModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pengajuanModalLabel">Verifikasi Pengajuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="<?php echo base_url('stkb/pengajuan_pembayaran_field_sdm') ?>">
                <input type="hidden" name="id_sdm">
                <input type="hidden" name="kode_project">
                <input type="hidden" name="progress">
                <div class="modal-body">
                    <p>Klik submit untuk mengajukan data</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="printSdmMitra" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data Mitra</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" target="_blank" action="" enctype="multipart/form-data" id="form-print-sdm-mitra">
                <input type="hidden" name="status" value="mitra">
                <input type="hidden" name="progress" value="">
                <input type="hidden" name="project" value="">
                <input type="hidden" name="nomorstkb" value="">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-3">
                            <p><b>Project</b></p>
                        </div>
                        <div class="col-lg-2">
                            <p><b>Nomor STKB</b></p>
                        </div>
                        <div class="col-lg-3">
                            <p><b>Cabang</b></p>
                        </div>
                        <div class="col-lg-2">
                            <p><b>Progress</b></p>
                        </div>
                        <div class="col-lg-2">
                            <p><b>Action</b></p>
                        </div>
                    </div>
                    <hr>
                    <div class="content-body">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <!-- <button type="submit" class="btn btn-primary">Print</button> -->
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    let averageProgress;
    $(document).on('click', '.btn-print', function() {
        // console.log($(this).data('nama'));
        // $('#printSdmMitra .modal-title').text('Data Mitra ' + $(this).data('nama'));
        $('#form-print-sdm-mitra').attr('action', '<?php echo base_url(); ?>stkb/print_reportsdm/675/0/' + $(this).data('id'))
    })

    $(document).on('click', '.btn-print', function() {
        $('#printSdmMitra .content-body').empty();
        const id_data_id = $(this).data('idsdm');
        const kodeproject = $(this).data('kodeproject');
        $.ajax({
            url: "<?php echo base_url('stkb/get_daftar_cabang') ?>",
            type: "post",
            data: {
                'id_data_id': id_data_id,
                'project': kodeproject
            },
            success: function(result) {
                $('#printSdmMitra .content-body').append(result);
            }
        })

    });

    $(document).on('click', '.submit-sdm-mitra', function() {
        $('#printSdmMitra [name=project]').val($(this).data('project'));
        $('#printSdmMitra [name=progress]').val($(this).data('progress'));
        $('#printSdmMitra [name=nomorstkb]').val($(this).data('nomorstkb'));
    });

    $(document).on('click', '.btn-ajukan', function() {
        const idsdm = $(this).data('idsdm');
        const kodeproject = $(this).data('kodeproject');
        const progress = $(`input[name="averageprogress-${idsdm}-${kodeproject}"]`).val();
        $('#pengajuanModal input[name="id_sdm"]').val(idsdm);
        $('#pengajuanModal input[name="kode_project"]').val(kodeproject);
        $('#pengajuanModal input[name="progress"]').val(progress);
    });

    $(document).ready(function() {

        $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
            return {
                "iStart": oSettings._iDisplayStart,
                "iEnd": oSettings.fnDisplayEnd(),
                "iLength": oSettings._iDisplayLength,
                "iTotal": oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
            };
        };

        var t = $("#mytablepengajuan").dataTable({
            "pageLength": 50,
            "lengthChange": false,
            "searching": false,
            "info": false,
            initComplete: function() {
                var api = this.api();
                $('#mytablepengajuan_filter input')
                    .off('.DT')
                    .on('keyup.DT', function(e) {
                        if (e.keyCode == 13) {
                            api.search(this.value).draw();
                        }
                    });
            },
            oLanguage: {
                sProcessing: "loading..."
            },
            // processing: true,
            serverSide: false,
            ajax: {
                "url": "<?= base_url('stkb/get_data_json_pembayaran/pengajuan'); ?>",
                "type": "GET"
            },
            columns: [{
                    "data": "namasdm",
                    "orderable": false
                },
                {
                    "data": "namasdm"
                },
                {
                    "data": "namaproject"
                },
                {
                    "data": "jumlahstkb"
                },
                {
                    "data": "jumlahcabang"
                },
                {
                    "data": "averageProgress",
                    render: function(data, type, row) {
                        var num = Number(row.averageProgress);
                        var roundedString = num.toFixed(2);
                        var rounded = Number(roundedString);
                        return rounded + " %";
                    }
                },
                {
                    "data": "cek",
                    "orderable": false
                },
                {
                    "data": "print",
                    "orderable": false
                },
                // {
                //   "data": "print",
                //   "orderable": false
                // }
            ],
            // order: [[1, 'asc']],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            },
            footerCallback: function(row, data, start, end, display) {
                // console.log(data);
                // var totalnya = 0;
                for (var i = 0; i < data.length; i++) {

                    // totalnya += parseInt(data[i]['total_aktual']);
                    $('.append-here').append(`<input type='hidden' name='averageprogress-${data[i]['idsdm']}-${data[i]['kodeproject']}' value='${data[i]['averageProgress']}'/>`)
                }
                // $('#totalterm1perpage').html(formatRupiah(totalnya.toString(), 'Rp. '));
            }
        });
    });
</script>