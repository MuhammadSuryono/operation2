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
        <h3><i class="fa fa-angle-right"></i> Field</h3>
        <div class="row mt">
            <div class="col-lg-12">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-panel">
                            <h4 class="mb text-primary"><strong> <i class="fa fa-angle-right"></i> Training </strong> </h4>
                            <a href="" class="btn btn-round btn-primary mb" data-target="#tambahproject" data-toggle="modal"><span class="fa fa-plus fa-fw"></span> Tambah </a>

                            <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>


                            <section id="unseen">
                                <div class="table-responsive">
                                    <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                                        <thead>
                                            <tr bgcolor="#F0FFF0">
                                                <th>No</th>
                                                <th>Kategori</th>
                                                <th>Nama/Project</th>
                                                <th>Jenis</th>
                                                <th>Tanggal Training</th>
                                                <th>Status Pengajuan</th>
                                                <th>File</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($training as $data) :
                                            ?>
                                                <tr>
                                                    <td><b><?php echo $no++ ?></b></td>
                                                    <td><?php echo ucfirst($data['kategori']) ?></td>
                                                    <td><?php echo ($data['nama_project']) ? $data['nama_project'] : $data['nama'] ?></td>
                                                    <td><?php echo ($data['jenis_training']) ? $data['jenis_training'] : '-' ?></td>
                                                    <td>
                                                        <?php
                                                        $start_date = $this->db->query("SELECT MIN(tanggal_mulai) AS tanggal_mulai FROM materi_training WHERE training_id = '$data[id]'")->row_array();
                                                        $end_date = $this->db->query("SELECT MAX(tanggal_selesai) AS tanggal_selesai FROM materi_training WHERE training_id = '$data[id]'")->row_array();
                                                        if ($start_date['tanggal_mulai'] && $end_date['tanggal_selesai'])
                                                            echo $start_date['tanggal_mulai'] . ' s/d ' . $end_date['tanggal_selesai'];
                                                        else
                                                            echo '-';
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($data['status_pengajuan'] == 0)
                                                            echo 'Belum Diajukan';
                                                        elseif ($data['status_pengajuan'] == 1)
                                                            echo 'Diajukan';
                                                        elseif ($data['status_pengajuan'] == 2)
                                                            echo 'Disetujui';
                                                        else
                                                            echo 'Ditolak';
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <center><?php if ($data['file'] != NULL) {
                                                                    echo "<a href='' type='button' onclick='window.open(\"" . base_url() . "assets/file/field_sdm/" . $data['file'] . "\", \"newwindow\", \"width=810,height=900\"); return false;'><i class='fa fa-file'></i> View</a>";
                                                                } else {
                                                                    echo "";
                                                                } ?>
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <?php if ($user['id_divisi'] == 99) : ?>
                                                                <a href="javascript:;" data-toggle="modal" data-target="#edit-fieldkotakab<?php echo $data['id'] ?>" class="btn-success btn-sm" style="display: inline-block;">
                                                                    <i class="fa fa-edit"></i> Edit</a>
                                                                <a href="<?php echo base_url(); ?>stkb/hapus_training/<?php echo $data['id']; ?> " class="btn-danger btn-sm tombol-hapus" style="display: inline-block;"><i class="fa fa-trash"></i> Delete</a>
                                                            <?php endif; ?>

                                                            <a href="<?= base_url(); ?>stkb/materi_pelatihan/<?php echo $data['id']; ?>" target="_blank" class="btn-primary btn-sm" data-training_id="<?= $data['id'] ?>" style="display: inline-block;">
                                                                <i class="fa fa-file"></i> Materi</a>

                                                            <?php if ($data['status_pengajuan'] != 1 && $data['status_pengajuan'] != 2) : ?>

                                                                <a href="javascript:;" data-toggle="modal" data-target="#modalHonorTraining" class="btn-primary btn-sm btn-modal-honor" data-training_id="<?= $data['id'] ?>" style="display: inline-block;">
                                                                    <i class="fa fa-money"></i> Budget Training</a>

                                                                <a href="javascript:;" data-toggle="modal" data-target="#modalUpload" class="btn-primary btn-sm btn-modal-upload" data-training_id="<?= $data['id'] ?>" style="display: inline-block;">
                                                                    <i class="fa fa-file"></i> Upload</a>

                                                                <a href="javascript:;" data-toggle="modal" data-target="#modalPeserta" class="btn-primary btn-sm btn-modal-peserta" data-training_id="<?= $data['id'] ?>" style="display: inline-block;">
                                                                    <i class=" fa fa-group"></i> Peserta</a>
                                                                |
                                                                <!-- <a href="<?php echo base_url(); ?>stkb/ajukan_training/<?php echo $data['id']; ?> " class="btn-primary btn-sm" onclick="return confirm('Anda yakin ingin mengajukan data training?')"><i class="fa fa-paper-plane"></i> Ajukan</a> -->
                                                                <a href="javascript:;" class="btn-warning btn-sm btn-ajukan" data-training_id="<?= $data['id'] ?>" style="display: inline-block;">
                                                                    <i class="fa fa-paper-plane"></i> Ajukan</a>
                                                            <?php endif; ?>

                                                        </center>
                                                    </td>
                                                </tr>
                                            <?php
                                            endforeach;
                                            ?>
                                        </tbody>
                                    </table>
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

<!-- MODAL INPUT DATA SDM STKB -->
<div class="modal fade" id="tambahproject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Input Training</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="<?php echo base_url('stkb/tambah_training') ?>" enctype="multipart/form-data">
                <div class="modal-body">

                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="kategori" class="form-control form-control-user" required>
                            <option value="" selected>--Pilih Kategori--</option>
                            <option value="project">Project</option>
                            <option value="non-project">Non Project</option>
                        </select>
                    </div>

                    <div class="section-project">
                        <div class="form-group">
                            <label>Project</label>
                            <select name="project_kode" class="form-control form-control-user">
                                <option value="" selected>--Pilih Project--</option>
                                <?php foreach ($project as $row) { ?>
                                    <option value="<?php echo $row['kode'] ?>"><?php echo $row['nama'] ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Jenis Training</label>
                            <select name="jenis" class="form-control form-control-user">
                                <option value="" selected>--Pilih Jenis Training--</option>
                                <?php foreach ($jenis_training as $row) { ?>
                                    <option value="<?php echo $row['id'] ?>"><?php echo $row['keterangan'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="section-non-project">
                        <div class="form-group">
                            <label>Nama Training</label>
                            <input type="text" name="nama" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalHonorTraining" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Input Honor Training</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="<?php echo base_url('stkb/tambah_honor_training') ?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="training_id">

                    <div style="display: flex; justify-content: end;">
                        <button type="button" class="btn btn-sm btn-primary btn-tambah-honor">Tambah</button>
                    </div>
                    <div class="section-honor">
                        <div class="row row-honor">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Nama Honor</label>
                                    <input type="text" name="nama_honor[]" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Nominal Honor</label>
                                    <input type="number" name="nominal_honor[]" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalUpload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Upload File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="<?php echo base_url('stkb/upload_file_training') ?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="training_id">

                    <div class="form-group">
                        <label for="upload">Upload</label>
                        <input type="file" class="form-control" id="" name="file" accept="" onchange="uploadfile()">
                        <small id="ket_upload" class="form-text text-danger">Ukuran file upload maksimal 5MB!</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalPeserta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Input Peserta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="<?php echo base_url('stkb/upload_file_training') ?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Field SDM</label>
                        <select name="id_data_id" class="form-control form-control-user">
                            <option value="" selected>--Pilih Field SDM--</option>
                            <?php foreach ($field_sdm as $row) { ?>
                                <option value="<?php echo $row['id_data_id'] ?>"><?php echo $row['Nama'] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div style="display: flex; justify-content: end;">
                        <button type="button" class="btn btn-sm btn-primary btn-tambah-peserta">Tambah</button>
                    </div>

                    <div class="fetched-data" style="margin-top: 10px;"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalAjukan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pengajuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="<?php echo base_url('stkb/ajukan_training') ?>" enctype="multipart/form-data">
                <input type="hidden" name="training_id" value="">
                <div class="modal-body">
                    <div class="fetched-data"></div>
                    <br>
                    <div class="form-group">
                        <label>Keterangan Pengajuan</label>
                        <input type="text" name="keterangan" class="form-control">
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



<!-- MODAL EDIT SDM STKB -->
<?php

$no = 0;
foreach ($training as $item) : $no++;
?>
    <div class="modal fade" id="edit-fieldkotakab<?php echo $item['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Edit Training</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="<?php echo base_url('stkb/edit_training') ?>" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $item['id'] ?>">

                    <div class="modal-body">

                        <div class="form-group">
                            <label>Kategori</label>
                            <select name="kategori" class="form-control form-control-user" required>
                                <option value="" selected>--Pilih Kategori--</option>
                                <option value="project" <?= ($item['kategori'] == 'project') ? 'selected' : '' ?>>Project</option>
                                <option value="non-project" <?= ($item['kategori'] == 'non-project') ? 'selected' : '' ?>>Non Project</option>
                            </select>
                        </div>

                        <div class="section-project" style="<?= ($item['kategori'] != 'project') ? 'display: none' : '' ?>;">
                            <div class="form-group">
                                <label>Project</label>
                                <select name="project_kode" class="form-control form-control-user">
                                    <option value="" selected>--Pilih Project--</option>
                                    <?php foreach ($project as $row) { ?>
                                        <option value="<?php echo $row['kode'] ?>" <?= ($item['project_kode'] == $row['kode']) ? 'selected' : '' ?>><?php echo $row['nama'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Jenis Training</label>
                                <select name="jenis" class="form-control form-control-user">
                                    <option value="" selected>--Pilih Jenis Training--</option>
                                    <?php foreach ($jenis_training as $row) { ?>
                                        <option value="<?php echo $row['id'] ?>" <?= ($item['jenis_training_id'] == $row['id']) ? 'selected' : '' ?>><?php echo $row['keterangan'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="section-non-project" style="<?= ($item['kategori'] != 'non-project') ? 'display: none' : '' ?>;">
                            <div class="form-group">
                                <label>Nama Training</label>
                                <input type="text" name="nama" class="form-control" value="<?= ($item['nama']) ? $item['nama'] : '' ?>">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<script>
    $(document).ready(function() {
        $('.btn-ajukan').click(function() {
            const training_id = $(this).data('training_id');
            $('input[name=training_id]').val(training_id);

            $.ajax({
                type: 'post',
                url: 'get_training_email_receiver',
                data: {
                    training_id: training_id
                },
                success: function(data) {
                    console.log(data);
                    $('#modalAjukan .fetched-data').html(data);
                    $('#modalAjukan').modal();
                }
            });
        })

        $('.btn-modal-peserta').click(function() {
            const training_id = $(this).data('training_id');
            $('input[name=training_id]').val(training_id);

            $.ajax({
                type: 'post',
                url: 'get_peserta',
                data: {
                    training_id: training_id
                },
                success: function(data) {
                    $('#modalPeserta .fetched-data').html(data);
                }
            });
        })

        $('.btn-tambah-peserta').click(function() {
            const field_sdm = $('select[name=id_data_id]').val()
            const training_id = $('input[name=training_id]').val();
            $.ajax({
                type: 'post',
                url: 'tambah_peserta',
                data: {
                    field_sdm: field_sdm,
                    training_id: training_id
                },
                success: function(data) {
                    $('#modalPeserta .fetched-data').html(data);
                }
            });
        })

        $('.btn-modal-upload').click(function() {
            const training_id = $(this).data('training_id')
            $('input[name=training_id]').val(training_id);
        })

        $('.btn-modal-honor').click(function() {
            const training_id = $(this).data('training_id')
            $('input[name=training_id]').val(training_id);

            $('.section-honor-appended').remove();

            $.ajax({
                type: 'post',
                url: 'get_data_honor_training',
                data: {
                    training_id: training_id
                },
                success: function(data) {
                    let result = JSON.parse(data);
                    console.log(result);
                    console.log(result.length);
                    for (let i = 0; i < result.length; i++) {
                        if (i == 0) {
                            $('input[name="nama_honor[]"]').val(result[i]['nama_honor']);
                            $('input[name="nominal_honor[]"]').val(result[i]['nominal_honor']);
                        } else {
                            html = `
                            <div class="section-honor-appended">
                                <div style="display: flex; justify-content: end;">
                                    <button type="button" class="btn btn-sm btn-danger btn-hapus-honor">Hapus</button>
                                </div>
                                <div class="row row-honor">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Nama Honor</label>
                                            <input type="text" name="nama_honor[]" class="form-control" value="${result[i]['nama_honor']}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Nominal Honor</label>
                                            <input type="number" name="nominal_honor[]" class="form-control" value="${result[i]['nominal_honor']}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            `;

                            $('.section-honor').append(html);
                        }
                    }
                }
            });
        })

        $('select[name=kategori]').change(function() {
            if ($(this).val() == 'project') {
                $('.section-project').show();
                $('.section-non-project').hide();
            } else {
                $('.section-project').hide();
                $('.section-non-project').show();
            }
        })

        $('.btn-tambah-honor').click(function() {
            html = `
            <div class="section-honor-appended">
                <div style="display: flex; justify-content: end;">
                    <button type="button" class="btn btn-sm btn-danger btn-hapus-honor">Hapus</button>
                </div>
                <div class="row row-honor">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Nama Honor</label>
                            <input type="text" name="nama_honor[]" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Nominal Honor</label>
                            <input type="number" name="nominal_honor[]" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            `;

            $('.section-honor').append(html);
        })
    })

    $(document).on('click', '.btn-hapus-honor', function() {
        $(this).parent().parent().remove();
    })

    $(document).on('click', '.btn-hapus-peserta', function() {
        const id = $(this).data('id');
        const training_id = $(this).data('training_id');
        $.ajax({
            type: 'post',
            url: 'hapus_peserta',
            data: {
                id: id,
                training_id: training_id
            },
            success: function(data) {
                $('#modalPeserta .fetched-data').html(data);
            }
        });
    })

    function uploadfile() {
        if ($('#bukti')[0].files[0].size > 5000000) {
            alert("Maaf. File Terlalu Besar ! Maksimal Upload 5MB");
            this.value = "";
        }
    }
</script>