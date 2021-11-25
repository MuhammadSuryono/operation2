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
                            <?php if ($training['status_pengajuan'] != 1 && $training['status_pengajuan'] != 2) : ?>
                                <a href="" class="btn btn-round btn-primary mb" data-target="#tambahproject" data-toggle="modal"><span class="fa fa-plus fa-fw"></span> Tambah </a>
                            <?php endif; ?>

                            <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>


                            <section id="unseen">
                                <div class="table-responsive">
                                    <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                                        <thead>
                                            <tr bgcolor="#F0FFF0">
                                                <th>No</th>
                                                <th>Materi</th>
                                                <th>Pemateri</th>
                                                <th>Tanggal Mulai</th>
                                                <th>Jam Mulai</th>
                                                <th>Tanggal Selesai</th>
                                                <th>Jam Selesai</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($materi_training as $data) :
                                                $startTime = $data['tanggal_mulai'] . ' ' . $data['jam_mulai'];
                                                $endTime = $data['tanggal_selesai'] . ' ' . $data['jam_selesai'];
                                                $currentTime = date('Y-m-d H:i:s');
                                            ?>
                                                <tr>
                                                    <td><b><?php echo $no++ ?></b></td>
                                                    <td><?= $data['materi'] ?></td>
                                                    <td><?= $data['name'] ?></td>
                                                    <td><?= $data['tanggal_mulai'] ?></td>
                                                    <td><?= $data['jam_mulai'] ?></td>
                                                    <td><?= $data['tanggal_selesai'] ?></td>
                                                    <td><?= $data['jam_selesai'] ?></td>
                                                    <td>
                                                        <center>
                                                            <?php if ($data['status_pengajuan'] != 1 && $data['status_pengajuan'] != 2) : ?>
                                                                <a href="javascript:;" data-toggle="modal" data-target="#edit-materi<?php echo $data['id'] ?>" class="btn-success btn-sm">
                                                                    <i class="fa fa-edit"></i> Edit</a>
                                                                <a href="<?php echo base_url(); ?>stkb/hapus_materi_training/<?php echo $data['id']; ?>/<?= $data['training_id'] ?>" class="btn-danger btn-sm tombol-hapus"><i class="fa fa-trash"></i> Delete</a>
                                                            <?php endif; ?>

                                                            <?php if ($data['status_pengajuan'] == 2 && ($startTime <= $currentTime && $currentTime <= $endTime)) : ?>
                                                                <a href="javascript:;" data-toggle="modal" data-target="#modalPresensi" class="btn-primary btn-sm btn-modal-presensi" data-id="<?= $data['id'] ?>" data-training_id="<?= $data['training_id'] ?>">
                                                                    <i class="fa fa-group"></i> Presensi</a>
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
            <form method="POST" action="<?php echo base_url('stkb/tambah_materi_training') ?>" enctype="multipart/form-data">
                <input type="hidden" name="training_id" value="<?= $training_id ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Pemateri</label>
                        <select name="pemateri" class="form-control form-control-user" required>
                            <option value="" selected>--Pilih Pemateri--</option>
                            <?php foreach ($pemateri as $row) { ?>
                                <option value="<?php echo $row['noid'] ?>"><?php echo $row['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Materi</label>
                        <input type="text" name="materi" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Tanggal Mulai</label>
                                <input type="date" name="tanggal_mulai" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Jam Mulai</label>
                                <input type="time" name="jam_mulai" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Tanggal Selesai</label>
                                <input type="date" name="tanggal_selesai" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Jam Selesai</label>
                                <input type="time" name="jam_selesai" class="form-control" required>
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

<div class="modal fade" id="modalPresensi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Input Training</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="fetched-data"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL EDIT SDM STKB -->
<?php

$no = 0;
foreach ($materi_training as $item) : $no++;
?>
    <div class="modal fade" id="edit-materi<?php echo $item['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Edit Training</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </button>
                </div>
                <form method="POST" action="<?php echo base_url('stkb/edit_materi_training') ?>" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $item['id'] ?>">
                    <input type="hidden" name="training_id" value="<?= $item['training_id'] ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Pemateri</label>
                            <select name="pemateri" class="form-control form-control-user" required>
                                <option value="" selected>--Pilih Pemateri--</option>
                                <?php foreach ($pemateri as $row) { ?>
                                    <option value="<?php echo $row['noid'] ?>" <?= ($row['noid'] == $item['user_noid']) ? "selected" : '' ?>><?php echo $row['name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Materi</label>
                            <input type="text" name="materi" class="form-control" value="<?= $item['materi'] ?>" required>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Tanggal Mulai</label>
                                    <input type="date" name="tanggal_mulai" class="form-control" value="<?= $item['tanggal_mulai'] ?>" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Jam Mulai</label>
                                    <input type="time" name="jam_mulai" class="form-control" value="<?= $item['jam_mulai'] ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Tanggal Selesai</label>
                                    <input type="date" name="tanggal_selesai" class="form-control" value="<?= $item['tanggal_selesai'] ?>" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Jam Selesai</label>
                                    <input type="time" name="jam_selesai" class="form-control" value="<?= $item['jam_selesai'] ?>" required>
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
<?php endforeach; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<script>
    $(document).ready(function() {
        $('.btn-modal-presensi').click(function() {
            const id = $(this).data('id');
            const training_id = $(this).data('training_id');
            $.ajax({
                type: 'post',
                url: '<?= base_url('stkb/presensi_materi_training') ?>',
                data: {
                    id: id,
                    training_id: training_id
                },
                success: function(data) {
                    $('.fetched-data').html(data);
                }
            });
        })
    })

    $(document).on('change', '.checkbox-presensi', function() {
        console.log('here');
        const peserta_id = $(this).data('peserta_id');
        const materi_id = $(this).data('materi_id');
        const training_id = $(this).data('training_id');
        $.ajax({
            type: 'post',
            url: '<?= base_url('stkb/update_presensi_materi_training') ?>',
            data: {
                peserta_id: peserta_id,
                training_id: training_id,
                materi_id: materi_id
            },
            success: function(data) {
                $('.fetched-data').html(data);
            }
        });
    })
</script>