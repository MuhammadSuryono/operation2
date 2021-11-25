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
  <table class=" table table-bordered table-striped table-condensed" id="mytable4">
    <thead>
      <tr>
        <th>No.</th>
        <th>Nomor Stkb</th>
        <th>Term</th>
        <th>Tanggal Buat</th>
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
        <th>Bayar</th>
        <th>Print</th>
      </tr>
    </thead>
  </table>
  <div class="row" style="margin:5px 5px">
    <div class="col-md-12 text-right">
      <h3 id="totalmenu1perpage"></h3>
    </div>
  </div>
  </form>
</div>

<script type="text/javascript">
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
    var t = $("#mytable4").dataTable({
      "pageLength": 50,
      "lengthChange": false,
      "searching": false,
      "info": false,
      initComplete: function() {
        var api = this.api();
        $('#mytable4_filter input')
          .off('.DT')
          .on('keyup.DT', function(e) {
            if (e.keyCode == 13) {
              api.search(this.value).draw();
            }
          });
        if (<?= $user['id_divisi'] ?> == 7 || <?= $user['id_divisi'] ?> == 99) {
          api.column(12).visible(true);
        } else {
          api.column(12).visible(false);
        }

      },
      oLanguage: {
        sProcessing: "loading..."
      },
      processing: true,
      serverSide: true,
      ajax: {
        "url": "<?= base_url('stkb/getAllJSONDataTabByAdam/menu1'); ?>",
        "type": "POST"
      },
      columns: [{
          "data": "nomorstkb",
          "orderable": false
        },
        {
          "data": "nomorstkb"
        },
        {
          "data": "term"
        },
        {
          "data": "tanggalbuat"
        },
        {
          "data": "namaproject",
          render: function(data, type, row) {
            return row.kodeproject + ' - ' + row.namaproject;
          }
        },
        {
          "data": "idpic",
          render: function(data, type, row) {
            return row.idpic + ' - ' + row.namapic;
          }
        },
        {
          "data": "namabank"
        },
        {
          "data": "noreknya"
        },
        {
          "data": "perdin",
          render: function(data, type, row) {
            return formatRupiah(row.perdin, 'Rp. ');
          }
        },
        {
          "data": "akomodasi",
          render: function(data, type, row) {
            return formatRupiah(row.akomodasi, 'Rp. ');
          }
        },
        {
          "data": "bpjs",
          render: function(data, type, row) {
            return formatRupiah(row.bpjs, 'Rp. ');
          }
        },
        {
          "data": "jumlahops",
          render: function(data, type, row) {
            return formatRupiah(row.jumlahops, 'Rp. ');
          }
        },
        {
          "data": "jumlahtrk",
          render: function(data, type, row) {
            return formatRupiah(row.jumlahtrk, 'Rp. ');
          }
        },
        {
          "data": "total",
          render: function(data, type, row) {
            return formatRupiah(row.total, 'Rp. ');
          }
        },
        {
          "data": "bayar",
          "orderable": false
        },
        {
          "data": "print",
          "orderable": false
        }
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
        var totalnya = 0;
        for (var i = 0; i < data.length; i++) {
          totalnya += parseInt(data[i]['total']);
        }
        $('#totalmenu1perpage').html(formatRupiah(totalnya.toString(), 'Rp. '));
      }
    });
  });
</script>