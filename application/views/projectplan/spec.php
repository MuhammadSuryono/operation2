<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Project Spec</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    <script src="<?= base_url('assets/') ?>js/summernote-ext-print.js"></script>

    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet">

    <style type="text/css">
        .tbl-spec {
            table-layout: fixed !important;
            width: 100% !important;
            word-wrap: break-word !important
        }

        .tbl-logo {
            text-align: center !important;
            vertical-align: middle !important
        }

        .b-t {
            border-top: 1px solid #000 !important
        }

        .b-b {
            border-bottom: 1px solid #000 !important
        }

        .b-l {
            border-left: 1px solid #000 !important
        }

        .b-r {
            border-right: 1px solid #000 !important
        }

        .b-all {
            border: 1px solid #000 !important
        }

        .bg-b {
            background: #000 !important;
            color: #FFF !important;
            font-weight: bold !important;
            text-align: center !important
        }

        .text-center {
            text-align: center !important
        }
    </style>
</head>

<body>

    <div class="col-lg-12">
        <?= $this->session->flashdata('info'); ?>
    </div>
    <?php
    $uri = $_SERVER['REQUEST_URI'];
    $getCode = explode('/', $uri);
    $code = $getCode[count($getCode) - 1];
    ?>

    <div class="card-body">
        <form method="POST" action="<?php echo base_url('projectplan/updateSpec/' . $code) ?>">
            <input type="hidden" name="project_kode" value="<?= $code ?>">
            <div class="row">
                <div class="col-md-12">
                    <label for="keterangan">Keterangan</label>
                    <div id="txtArea1">
                        <textarea id="summernote" name="keterangan"><?php echo htmlspecialchars_decode($ps['keterangan'], ENT_QUOTES) ?></textarea>
                    </div>
                    <!-- <div id="txtArea2" style="display: none;">
                        <textarea id="summernote" name="keterangan"><?php echo htmlspecialchars_decode($ps['keterangan'], ENT_QUOTES) ?></textarea>
                    </div> -->
                </div>
                <div class="col-md-12 text-right">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" id="btnSave"><i class="fa fa-save"></i> Save</button>
                        <?php if (!$ps['checked_at']) : ?>
                            <a href="<?php echo base_url('projectplan/checkedProjectSpec/' . $code) ?>" class="btn btn-success"><i class="fa fa-check"></i> Check</a>
                        <?php elseif (!$ps['approved_at'] || $ps['on_revision_status'] == 1) : ?>
                            <a href="<?php echo base_url('projectplan/approvedProjectSpec/' . $code) ?>" class="btn btn-success"><i class="fa fa-check"></i> Approve</a>
                        <?php elseif ($ps['approved_at']) : ?>
                            <a href="<?php echo base_url('projectplan/printPdfSpec/revisi/' . $code) ?>" class="btn btn-success "><i class="fa fa-file"></i> Revisi</a>
                            <!-- <a href="<?php echo base_url('projectplan/printPdfSpec/view/' . $code) ?>" target="_blank"><button type="button" class="btn btn-primary"><i class="fa fa-download"></i> Unduh PDF</button></a><br><small small class="text-danger">Klik save terlebih dahulu untuk download file PDF *</small> -->
                        <?php endif; ?>
                        <a href="<?= base_url('/projectplan') ?>" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewDocumentLabel" aria-hidden="true">
        <div class="modal-dialog mw-100 w-75" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewDocumentLabel">View Document Project Spec</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="viewDocumentSpec"></div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function view() {
            var url = '<?php echo base_url('projectplan/printPdfSpec/view/' . $code) ?>';
            var options = {
                height: "500px",
                fallbackLink: "<p>This browser does not support inline PDF. Please download the PDF to view it: <a href='<?php echo base_url('projectplan/printPdfSpec/download/' . $code) ?>'>Download PDF</a></p>"
            };
            PDFObject.embed(url, "#viewDocumentSpec", options);
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
            var markupStr = `<?= htmlspecialchars_decode($ps["keterangan"], ENT_QUOTES) ?>`;
            // console.log(markupStr);
            $('#summernote').summernote('code', markupStr);

            dataPP();
            dataUser();
        });

        $('#btnSave').click(function() {
            var markupStr = $('#summernote').summernote('code');
            $('#summernote').summernote('code', markupStr);
        });

        function dataPP() {
            var kode = "<?= $code ?>";
            $.ajax({
                url: '<?php echo base_url('projectplan/updatePP') ?>',
                method: 'GET',
                dataType: 'json',
                data: {
                    kode: kode
                },
                success: function(hasil) {
                    if (hasil == 'error') {
                        $("#listPP").empty();
                        var tr = '<table cellspacing="0" class="tbl-spec"><tr class="bg-b"><td class="b-t b-l text-center" width="25%"><b>Schedule Details</b></td><td class="b-t b-l b-r text-center" width="25%"><b>Date</b></td><td class="b-t b-r text-center" width="25%"><b>Schedule Details</b></td><td class="b-t b-r text-center" width="25%"><b>Date</b></td></tr><tr><td colspan="5" class="text-center b-all">Data Project Plan belum ditambahkan</td></tr></table>';
                        $("#listPP").html(tr);
                    } else {
                        $("#listPP").empty();
                        $("#listPP").html(hasil);
                        var markupStr = $('#summernote').summernote('code');
                        $('#summernote').summernote('code', markupStr);
                    }
                },
                error: function(jqXHR, error, errorThrown) {
                    $("#listPP").empty();
                    var tr = '<table cellspacing="0" class="tbl-spec"><tr class="bg-b"><td class="b-t b-l text-center" width="25%"><b>Schedule Details</b></td><td class="b-t b-l b-r text-center" width="25%"><b>Date</b></td><td class="b-t b-r text-center" width="25%"><b>Schedule Details</b></td><td class="b-t b-r text-center" width="25%"><b>Date</b></td></tr><tr><td colspan="5" class="text-center b-all">Data Project Plan belum ditambahkan</td></tr></table>';
                    $("#listPP").html(tr);
                }
            });
        }

        function dataUser() {
            var kode = "<?= $code ?>";
            $.ajax({
                url: '<?php echo base_url('projectplan/updateUserSpec') ?>',
                method: 'GET',
                dataType: 'json',
                data: {
                    kode: kode
                },
                success: function(hasil) {
                    console.log(hasil);
                    if (hasil) {
                        $('#createdbycolumn').html(hasil[0]);
                        $('#checkedbycolumn').html(hasil[1]);
                        $('#approvedbycolumn').html(hasil[2]);
                    }
                },
                error: function(jqXHR, error, errorThrown) {
                    // $("#listPP").empty();
                    // var tr = '<table cellspacing="0" class="tbl-spec"><tr class="bg-b"><td class="b-t b-l text-center" width="25%"><b>Schedule Details</b></td><td class="b-t b-l b-r text-center" width="25%"><b>Date</b></td><td class="b-t b-r text-center" width="25%"><b>Schedule Details</b></td><td class="b-t b-r text-center" width="25%"><b>Date</b></td></tr><tr><td colspan="5" class="text-center b-all">Data Project Plan belum ditambahkan</td></tr></table>';
                    // $("#listPP").html(tr);
                }
            });
        }
    </script>
    <!-- <div id="summernote"></div> -->
    <script>
        $('#summernote').summernote({
            placeholder: 'Hello Bootstrap 4',
            tabsize: 2,
            height: 1000,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']],
                ['misc', ['print']]
            ],
        });
    </script>
</body>

</html>