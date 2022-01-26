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
        color:grey;
    }
</style>
<div class="table-responsive">
<form action="<?php echo base_url('stkb/readytopaid')?>" method="POST" enctype="multipart/form-data">
<input type="hidden" name="pengklik" value="<?php echo $this->session->userdata('id_user'); ?>">
<table class=" table table-bordered table-striped table-condensed" id="mytable3">
  <thead>
      <tr>
        <th>No.</th>
        <th>Nomor Stkb</th>
        <th>Term</th>
        <th>Tanggal Buat</th>
        <th>Tanggal Mulai</th>
        <th>Project</th>
        <th>Nama</th>
        <th>Bank</th>
        <th>No. Rekening</th>
        <th>Perdin</th>
        <th>Akomodasi</th>
        <th>Bpjs</th>
        <th>Jumlah RTP (OPS)</th>
        <th>Jumlah RTP (TRK)</th>
        <th>Total</th>
        <th>Cek</th>
        <th>Print</th>
      </tr>
  </thead>
</table>
    <div class="row" style="margin:5px 5px">
    <div class="col-md-12 text-right"><h3 id="totalterm3perpage"></h3></div>
      <?php if ($user['id_divisi'] == 7 or $user['id_divisi'] == 99) :?>
      <div class="col-md-9"></div>
      <div class="col-md-1 text-center">
        <!-- <center><input type="checkbox" style="width: 30px" class="checkbox form-control" onclick="checkall3()" id="checkAll3" disabled /></center>
        <label for="checkAll1">Check All</label> -->
      </div>
      <!-- <div class="col-md-2 text-right"><button type="submit" class="btn btn-lg btn-success">Move To RTP <i class="fas fa-angle-double-right"></i></button></div> -->
        <?php
        //CEK APAKAH ADA PENGAJUAN KAS YANG BELUM TERBAYAR, JIKA BELUM TERBAYAR BUTTON RTP DI DISABLE
        $cek_ajukan = $this->db->query("SELECT * FROM stkb_pembayaran where kode_kas is not null and (status_kas='1' or status_kas is null) and statusbayar='RTP'")->row();
             if($cek_ajukan == NULL) {
             ?>
            <div class="col-md-2 text-right"><button type="submit" class="btn btn-lg btn-success">Move To RTP <i class="fas fa-angle-double-right"></i></button></div>
            <?php } else { ?>
            <div class="col-md-2 text-right"><button type="submit" class="btn btn-lg btn-success" disabled>Move To RTP <i class="fas fa-angle-double-right"></i></button></div>

        <?php  }
       endif?>
    </div>
    </form>
  </div>

  <script type="text/javascript">
      $(document).ready(function() {
          $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
          {
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

          var t = $("#mytable3").dataTable({
              "pageLength": 50, "lengthChange": false, "searching": false, "info": false,
              initComplete: function() {
                  var api = this.api();
                  $('#mytable3_filter input')
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
              processing: true,
              serverSide: false,
              ajax: {"url": "<?= base_url('stkb/getAllJSONDataTabByAdam/term3');?>", "type": "GET"},
              columns: [
                  {"data": "nmrstkb", "orderable": false},
                  {"data": "nmrstkb"},
                  {"data": "termnya"},
                  {"data": "tanggalbuat"},
                  {"data": "tglm"},
                  {"data": "namaproject",
                    render: function ( data, type, row ) {
                      return row.kodeproject + ' - ' + row.namaproject;
                    }
                  },
                  {"data": "idpic",
                    render: function ( data, type, row ) {
                      return row.idpic + ' - ' + row.namapic;
                    }
                  },
                  {"data": "bank"},
                  {"data": "rekening"},
                  {"data": "perdin",
                    render: function ( data, type, row ) {
                      return formatRupiah(row.perdin, 'Rp. ');
                    }
                  },
                  {"data": "akomodasi",
                    render: function ( data, type, row ) {
                      return formatRupiah(row.akomodasi, 'Rp. ');
                    }
                  },
                  {"data": "bpjs",
                    render: function ( data, type, row ) {
                      return formatRupiah(row.bpjs, 'Rp. ');
                    }
                  },
                  {"data": "jumlahops",
                    render: function ( data, type, row ) {
                     if (row.jumlahops < 0) {
                            return formatRupiah(row.jumlahops, 'Rp. -');
                          } else {
                            return formatRupiah(row.jumlahops, 'Rp. ');
                          }
                    }
                  },
                  {"data": "jumlahtrk",
                    render: function ( data, type, row ) {
                      if (row.jumlahtrk < 0) {
                            return formatRupiah(row.jumlahtrk, 'Rp. -');
                          } else {
                            return formatRupiah(row.jumlahtrk, 'Rp. ');
                          }
                    }
                  },
                  {"data": "total",
                    render: function ( data, type, row ) {
                      if (row.total < 0) {
                            return formatRupiah(row.total, 'Rp. -');
                          } else {
                            return formatRupiah(row.total, 'Rp. ');
                          }
                    }
                  },
                  {"data": "cek", "orderable": false},
                  {"data": "print", "orderable": false}
              ],
              // order: [[1, 'asc']],
              rowCallback: function(row, data, iDisplayIndex) {
                  var info = this.fnPagingInfo();
                  var page = info.iPage;
                  var length = info.iLength;
                  var index = page * length + (iDisplayIndex + 1);
                  $('td:eq(0)', row).html(index);
              },
              footerCallback: function (row, data, start, end, display) {
                  var totalnya = 0;
                  for (var i = 0; i < data.length; i++) {
                    if(data[i]['status_sdm'] == 1 || data[i]['status_sdm'] == null){
                      var total = data[i]['total'];
                    } else {
                      var total = 0;
                    }
                    // totalnya += parseInt(data[i]['total']);
                    totalnya += parseInt(total);
                  }
                  if (totalnya < 0) {
                    $('#totalterm3perpage').html(formatRupiah(totalnya.toString(), 'Rp. -'));
                  } else {
                     $('#totalterm3perpage').html(formatRupiah(totalnya.toString(), 'Rp. '));
                  }
              }
          });
      });
  </script>
