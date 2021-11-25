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
<div class="table-responsive" style="margin-top: 20px;">
    <form role="form" action="<?php echo base_url('stkb/ajukan_kas'); ?>" method="POST">
            <table class=" table table-bordered table-striped table-condensed" id="mytable6">
                <thead>
                    <tr bgcolor="#e3f3fc">
                        <th>No.</th>
                        <th>Nama Project</th>
                        <th>Kode Project</th>
                        <th>Nama Bank</th>
                        <th>Kode Bank</th>
                        <th>Tahun</th>
                        <th>Jumlah STKB</th>
                        <th>Total</th>
                        <th>Sudah Dibayar</th>
                        <th>Belum Dibayar</th>
                        <th>Pengajuan Kas</th>
                        <th>Periode Pengajuan Kas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no=1;
                    // $query = $this->db->query("SELECT a.kode AS prokod,
                    //                               a.nama AS pronam,
                    //                               a.bank AS probank,
                    //                               YEAR(a.tanggal) AS protang,
                    //                               b.kode AS bankod,
                    //                               b.nama AS banknam,
                    //                               COUNT(DISTINCT d.nostkb) AS jumlahstkb, 
                    //                               SUM(c.bpjs + c.lumpsumharian + c.akomodasi + c.lumpsumops + IF(c.perdin IS NULL, 0, c.perdin) + IF(d.term1 <= 0, 0, d.term1) + IF(d.term2 <= 0, 0, d.term2) + IF(d.term3 <= 0, 0, d.term3)) AS totalbudget,
                    //                               SUM(c.aktualbayar1 + c.aktualbayar2 + c.aktualbayar3 + d.aktualbayar1 + d.aktualbayar2 + d.aktualbayar3) as totalbayar from project a
                    //                               join bank b on a.bank = b.kode
                    //                               join stkb_trk d on a.kode = d.project
                    //                               join stkb_ops c on c.nomorstkb = d.nostkb
                    //                               where a.visible='y' and a.type='n'
                    //                               group by a.kode
                    //                               order by a.nama asc")->result_array();

                    $query = $this->db->query("SELECT a.kode AS prokod,
                                                  a.nama AS pronam,
                                                  a.bank AS probank,
                                                  YEAR(a.tanggal) AS protang,
                                                  b.kode AS bankod,
                                                  b.nama AS banknam,
                                                  COUNT(DISTINCT d.nostkb) AS jumlahstkb, 
                                                  SUM(IF(c.bpjs IS NULL, 0, c.bpjs) +  IF(c.akomodasi IS NULL, 0, c.akomodasi) + IF(c.lumpsumharian IS NULL, 0, c.lumpsumharian) + IF(c.lumpsumops IS NULL, 0, c.lumpsumops) + IF(c.perdin IS NULL, 0, c.perdin) + IF(d.term1 <= 0, 0, d.term1) + IF(d.term2 <= 0, 0, d.term2) + IF(d.term3 <= 0, 0, d.term3)) AS totalbudget,
                                                  SUM(c.aktualbayar1 + c.aktualbayar2 + c.aktualbayar3 + d.aktualbayar1 + d.aktualbayar2 + d.aktualbayar3) as totalbayar from project a
                                                  join bank b on a.bank = b.kode
                                                  join stkb_trk d on a.kode = d.project
                                                  join stkb_ops c on c.nomorstkb = d.nostkb
                                                  where a.visible='y' and a.type='n'
                                                  group by a.kode
                                                  order by a.nama asc")->result_array();

                    

                    foreach ($query as $row) :
                        $belum_bayar = $row['totalbudget'] - $row['totalbayar'];
                      
                     ?>
                    
                     <tr>
                        <!-- IF(c.bpjs IS NULL, 0, c.bpjs) +  IF(c.akomodasi IS NULL, 0, c.akomodasi) -->

                         <td><?php echo $no++; ?></td>
                         <td><?php echo $row['pronam']; ?></td>
                         <td><?php echo $row['prokod']; ?></td>
                         <td><?php echo $row['banknam']; ?></td>
                         <td><?php echo $row['bankod']; ?></td>
                         <td><?php echo $row['protang']; ?></td>
                         <td><?php echo $row['jumlahstkb']; ?></td>
                         <td><?php echo "Rp " . number_format($row['totalbudget'],0,',','.'); ?></td>
                         <td><?php echo "Rp " . number_format($row['totalbayar'],0,',','.'); ?></td>
                         <td><?php echo "Rp " . number_format($belum_bayar,0,',','.'); ?></td>
                        <?php 
                        $pjk = $row['prokod'];
                        //GET DATA STKB PEMBAYARAN YANG STATUSNYA RTP
                        $num = $this->db->get_where('stkb_pembayaran', array('kodeproject' => $pjk, 'statusbayar' => "RTP"))->result_array();
                        foreach ($num as $n) {
                            ?>
                            <input type="hidden" name="num[]" value="<?php echo $n['no']; ?>">

                        <?php
                        }
                        //GET TOTAL NOMINAL PENGAJUAN PER PROJECT
                        $s = $this->db->query("SELECT sum(total) AS pengajuan FROM stkb_pembayaran WHERE kodeproject='$pjk' AND statusbayar='RTP' AND (status_kas!='0' OR status_kas IS NULL) ")->row();         ?>
                         <td><?php if($s->pengajuan != NULL){ echo "Rp " . number_format($s->pengajuan,0,',','.'); } else { echo "Rp ". 0;} ?></td>
                        
                        <?php
                        //GET PERIODE (TANGGAL) PENGAJUAN PER PROJECT
                        $prd = $this->db->query("SELECT MAX(tanggalbuat) AS max_prd, MIN(tanggalbuat) AS min_prd FROM stkb_pembayaran WHERE kodeproject='$pjk' AND statusbayar='RTP'")->row();                         
                          ?>
                          <td><center><?php if($prd->max_prd != NULL) { echo date("d M y", strtotime($prd->min_prd)) ." - ". date("d M y", strtotime($prd->max_prd)) ; } else { echo "-";} ?></center></td>
                     </tr>
                 <?php
                 $totalpengajuan += $s->pengajuan;
                  endforeach; ?>
                </tbody>
            </table>

            <?php 
            //CEK APAKAH ADA PENGAJUAN KAS YANG BELUM TERBAYAR, JIKA BELUM TERBAYAR BUTTON AJUKAN DI DISABLE
            $cek_ajukan = $this->db->query("SELECT * FROM stkb_pembayaran where kode_kas is not null and (status_kas='1' or status_kas is null) and statusbayar='RTP'")->row(); ?>
            <div class="col-md-12 text-right"><h4>Total Pengajuan Kas : <?php echo "Rp " . number_format($totalpengajuan,0,',','.'); ?></h4></div>
            <div class="col-md-12 text-right">

                 <?php if ($user['id_divisi'] == 99) : ?>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#approve"> Approve Pengajuan Kas</button>
                <?php endif;

                if ($user['id_divisi'] == 7 OR $user['id_divisi'] == 99) :
                     if($cek_ajukan != NULL){ ?>
                    <input type="button" name="ajukan_kas" value="Ajukan Kas" class="btn btn-primary"  data-toggle="modal" data-target="#ajukan" disabled>
                    <?php } else { ?>
                    <input type="button" name="ajukan_kas" value="Ajukan Kas" class="btn btn-primary"  data-toggle="modal" data-target="#ajukan">
                    <?php }
                endif; ?>
            </div>

            <!-- Modal Konfirmasi Ajukan -->
                <div class="modal fade" id="ajukan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Pengajuan Kas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        Apakah Anda yakin ingin Ajukan Kas baru?
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Ya</button>
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                      </div>
                    </div>
                  </div>
                </div>
        </form>
    </div>

<!-- MODAL APPROVE -->
        <div class="modal fade" id="approve" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content" >
              <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Daftar Pengajuan Kas Baru</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form role="form" action="<?php echo base_url('stkb/approve_kas'); ?>" method="POST">
              <div class="modal-body">
                <?php 
                //CEK DATA YANG MEMILIKI KODE STATUS TAPI BELUM DI APPROVE
                $cek=$this->db->query("SELECT * FROM stkb_pembayaran WHERE kode_kas IS NOT NULL AND status_kas IS NULL GROUP BY kode_kas")->row();
                 if($cek != NULL) {
                 ?>

                        <h5>Kode Kas : <?php echo $cek->kode_kas; ?></h5>
                        <p>Rincian Pengajuan Kas :</p>
                            <input type="hidden" name="kode_kas" value="<?php echo $cek->kode_kas ?>">
                        <table class="table table-bordered">
                            <thead>
                                <tr bgcolor="#e3f3fc">
                                    <th>No</th>
                                    <th>Nama Project</th>
                                    <th>Kode Project</th>
                                    <th>Pengajuan Kas</th>
                                    
                                </tr>
                                <?php
                                $no=1;
                                //AMBIL DATA YANG AKAN DI APPROVE PENGAJUAN KAS
                                 $get=$this->db->query("SELECT *, sum(a.total) AS pengajuan FROM stkb_pembayaran a JOIN project b ON a.kodeproject=b.kode WHERE kode_kas='$cek->kode_kas' GROUP BY a.kodeproject")->result_array();
                                foreach ($get as $row) {
                                 ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $row['nama']; ?></td>
                                    <td><?php echo $row['kodeproject']; ?></td>
                                    <td><?php echo  "Rp " . number_format($row['pengajuan'],0,',','.'); ?></td>                                  
                                </tr>
                                <!-- BAWA KODE PROJEK DAN NOMINAL PENGAJUAN -->
                                <input type="hidden" name="kd_project[]" value="<?php echo $row['kodeproject']; ?>">
                                <input type="hidden" name="ajukan_kas[]" value="<?php echo $row['pengajuan']; ?>">
                                
                            <?php
                            $total += $row['pengajuan'];
                             } ?>
                                <tr>
                                    <td colspan="3" class="text-center">Total Pengajuan Kas :</td>
                                    <td><?php echo  "Rp " . number_format($total,0,',','.'); ?></td>
                                </tr>
                            </thead>
                        </table>
                    <?php } else { ?>
                        <diV class="text-center">
                        <h5>Tidak Ada Pengajuan Kas Baru</h5>
                        </diV>                    
                    <?php } ?>
              </div>
              <div class="modal-footer">
                <?php if ($cek != NULL) { ?>
                    <!-- <input type="submit" name="approve" class="btn btn-success" value="Approve" > -->
                    <button type="submit" name="approve" class="btn btn-success"><i class="fas fa-clipboard-check"></i> Approve</button>
                <?php } ?>
              </div>
            </form>
            </div>
          </div>
        </div>


<!-- <script type="text/javascript">
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
        var t = $("#mytable6").dataTable({
            "pageLength": 50,
            "lengthChange": false,
            "searching": true,
            "info": false,
            initComplete: function() {
                var api = this.api();
                $('#mytable6_filter input')
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
            serverSide: true,
            ajax: {
                "url": "<?= base_url('stkb/getAllJSONDataTabByAdam/menu3'); ?>",
                "type": "POST"
            },
            columns: [{
                    "data": "pronam",
                    "orderable": false
                },
                {
                    "data": "pronam"
                },
                {
                    "data": "prokod"
                },
                {
                    "data": "banknam"
                },
                {
                    "data": "bankod"
                },
                {
                    "data": "protang"
                },
                {
                    "data": "jumlahstkb",
                    'searchable': false
                },
                {
                    "data": "totalbudget",
                    'searchable': false,
                    render: function(data, type, row) {
                        let totalbudget = row.totalbudget;
                        // return (typeof totalbudget === 'object');
                        if (typeof totalbudget === 'object') {
                            totalbudget = '0';
                        }
                        return formatRupiah(totalbudget, 'Rp. ');
                    }
                },
                {
                    "data": "totalbayar",
                    'searchable': false,
                    render: function(data, type, row) {
                        let totalbayar = row.totalbayar;
                        // return (typeof totalbayar === 'object');
                        if (typeof totalbayar === 'object') {
                            totalbayar = '0';
                        }
                        return formatRupiah(totalbayar, 'Rp. ');
                    }
                },
                {
                    "data": "totalbayar",
                    'searchable': false,
                    render: function(data, type, row) {
                        // return (row.totalbudget - row.totalbayar);
                        let sisa = (row.totalbudget - row.totalbayar).toString();
                        // return sisa;
                        // if ((row.totalbudget - row.totalbayar) >= 0) {
                        return formatRupiah(sisa, ((row.totalbudget - row.totalbayar) >= 0) ? "Rp. " : "Rp. (-) ");
                        // } else {
                        // return "Rp. 0";
                        // }
                    }
                },


            ],
            // order: [[1, 'asc']],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                // console.log(row);
                $('td:eq(0)', row).html(index);
            },
            footerCallback: function(row, data, start, end, display) {
                // var totalnya = 0;
                // for (var i = 0; i < data.length; i++) {
                //     totalnya += parseInt(data[i]['total']);
                // }
                // $('#totalmenu1perpage').html(formatRupiah(totalnya.toString(), 'Rp. '));
            }
        });
    });
</script> -->