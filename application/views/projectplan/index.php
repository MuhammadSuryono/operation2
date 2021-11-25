<section id="main-content">
    <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Project</h3>
        <div class="row mt">
            <div class="col-lg-12">

                <div class="row mt">

                    <div class="col-lg-12">
                        <div class="form-panel">
                            <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Project </strong></h4>

                            <div class="col-lg-12">
                                <?= $this->session->flashdata('info'); ?>
                            </div>

                            <section id="unseen">
                                <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Project</th>
                                            <th>Nama Project</th>
                                            <th>Nama Bank</th>
                                            <th>Start Project</th>
                                            <th>End Project</th>
                                            <th>Jenis Project</th>
                                            <!-- <th>Project Spec</th> -->
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data_project as $db) : ?>
                                            <?php if ($start % 2 != 0) : ?>
                                                <tr>
                                                    <td style="background-color : #ffffff;">
                                                    <?php else : ?>
                                                <tr style="background-color : #e2e4ff;">
                                                    <td>
                                                    <?php endif ?>
                                                    <?= ++$start ?></td>
                                                    <td><?= $db['kode'] ?></td>
                                                    <td><?= $db['nama'] ?></td>
                                                    <td><?= $db['bank'] ?></td>
                                                    <td><?= $db['tanggal'] ?></td>
                                                    <td><?= $db['tanggal'] ?></td>
                                                    <?php if ($db['type'] == 'n') : ?>
                                                        <td>Adhoc</td>
                                                    <?php else : ?>
                                                        <td>Industri</td>
                                                    <?php endif ?>
                                                    <td>
                                                        <?php $isApproved = $this->db->query("SELECT approved_at FROM project_spec WHERE project_kode = '$db[kode]'")->row_array(); ?>
                                                        <!-- <?= $$isApproved; ?> -->
                                                        <a href="<?php echo base_url('projectplan/view/' . $db['kode']) ?>" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Project Plan <?= ($isApproved['approved_at']) ? "Dikunci karena project spec sudah disetujui" : '' ?>" <?= ($isApproved['approved_at']) ? "disabled" : '' ?>><i class="fas fa-puzzle-piece"></i></a>
                                                        <a href="<?php echo base_url('projectplan/spec/' . $db['kode']) ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Project Spec"><i class="fas fa-angle-double-right"></i></a>
                                                        <!-- <a href="<?php echo base_url('projectDocument/document/' . $db['kode']) ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Project Document"><i class="fas fa-file-alt"></i></a> -->
                                                        <!-- <a href="<?php echo base_url('projectPlan/hapus') ?>/<?php echo $db['kode'] ?>" class="btn btn-danger btn-sm tombol-hapus" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash fa-sm"></i></a> -->
                                                    </td>

                                                </tr>
                                            <?php endforeach ?>
                                    </tbody>
                                </table>

                            </section>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>
    <!-- /wrapper -->
</section>