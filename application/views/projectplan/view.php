<section id="main-content">
  <section class="wrapper site-min-height">
    <h3><i class="fa fa-angle-right"></i> <?= $project['nama_project'] ?> (<?= $project['kode_project'] ?>)</h3>
    <div class="row mt">
      <div class="col-lg-12">

        <div class="row mt">

          <div class="col-lg-12">
            <div class="form-panel">
              <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Project Plan </strong></h4>
              <button class="btn btn-round btn-primary mb" data-toggle="modal" data-target="#addPlanModal"><i class="fa fa-check-circle fa-fw"></i> Insert Plan To Project</button>
              <button class="btn btn-round btn-success mb" data-toggle="modal" data-target="#addTaskModal"><i class="fa fa-check-circle fa-fw"></i> Add New Plan</button>

              <div class="col-lg-12">
                <?= $this->session->flashdata('info'); ?>
              </div>

              <section id="unseen">
                <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kegiatan</th>
                      <th>Tanggal Mulai</th>
                      <th>Tanggal Selesai</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($project_plan as $db) : ?>
                      <?php if ($start % 2 != 0) : ?>
                        <tr>
                          <td style="background-color : #ffffff;">
                          <?php else : ?>
                        <tr style="background-color : #e2e4ff;">
                          <td>
                          <?php endif ?>
                          <?= ++$start ?></td>
                          <td><?= $db['kegiatan'] ?></td>
                          <td><?= $db['date_start'] ?></td>
                          <td><?= $db['date_finish'] ?></td>
                          <td>
                            <button class="btn btn-primary btn-sm btn-edit" data-toggle="modal" data-target="#editPlanModal" data-task="<?= $db['task_id'] ?>" data-datestart="<?= $db['date_start'] ?>" data-datefinish="<?= $db['date_finish'] ?>" data-id="<?= $db['id'] ?>"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#deletePlanModal" data-id="<?= $db['id'] ?>"><i class="fas fa-trash"></i></button>
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

<!-- Modal -->
<div class="modal fade" id="addPlanModal" tabindex="-1" role="dialog" aria-labelledby="addPlanModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addPlanModalLabel">Tambah Kegiatan Project</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('projectplan/store') ?>" method="POST" id="form-project-plan">
        <input type="hidden" name="project_kode" value="<?= $project['kode_project'] ?>">
        <div class="modal-body">
          <div class="alert alert-danger" role="alert" id="alert-plan" style="display: none;">
            Harap isi semua data
          </div>
          <div class="form-group">
            <label>Kegiatan</label>
            <select name="task" id="task" class="selectpicker form-control" data-live-search="true">
              <option value=""> - </option>
              <?php foreach ($task as $item) : ?>
                <option value="<?= $item['id'] ?>"> <?= $item['kegiatan'] ?> </option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label>Tanggal Mulai</label>
                <div>
                  <input type="date" class="form-control" name="date_start" id="date_start" value="">
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>Tanggal Selesai</label>
                <div>
                  <input type="date" class="form-control" name="date_finish" id="date_finish" value="">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="btn-submit-plan">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editPlanModal" tabindex="-1" role="dialog" aria-labelledby="editPlanModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editPlanModalLabel">Edit Kegiatan Project</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('projectplan/update') ?>" method="POST" id="form-project-editplan">
        <input type="hidden" name="project_kode" value="<?= $project['kode_project'] ?>">
        <input type="hidden" name="id" id="id" value="">
        <div class="modal-body">
          <div class="alert alert-danger" role="alert" id="alert-plan" style="display: none;">
            Harap isi semua data
          </div>
          <div class="form-group">
            <label>Kegiatan</label>
            <select name="task" id="task_edit" class="selectpicker form-control" data-live-search="true">
              <option value=""> - </option>
              <?php foreach ($task as $item) : ?>
                <option value="<?= $item['id'] ?>"> <?= $item['kegiatan'] ?> </option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label>Tanggal Mulai</label>
                <div>
                  <input type="date" class="form-control" name="date_start" id="date_start_edit" value="">
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>Tanggal Selesai</label>
                <div>
                  <input type="date" class="form-control" name="date_finish" id="date_finish_edit" value="">
                </div>
              </div>
            </div>
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


<!-- Modal -->
<div class="modal fade" id="addTaskModal" tabindex="-1" role="dialog" aria-labelledby="addTaskModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addTaskModalLabel">Tambah Jenis Kegiatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('projectplan/storeTask') ?>" method="POST" id="form-task">
        <input type="hidden" name="project_kode" value="<?= $project['kode_project'] ?>">
        <div class="modal-body">
          <div class="alert alert-danger" role="alert" id="alert-task" style="display: none;">
            Harap isi semua data
          </div>
          <div class="form-group">
            <label>Nama Kegiatan</label>
            <div>
              <input type="text" class="form-control" name="task" id="new_task" value="">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="btn-submit-task">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deletePlanModal" tabindex="-1" role="dialog" aria-labelledby="deletePlanModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deletePlanModalLabel">Tambah Jenis Kegiatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('projectplan/delete') ?>" method="POST" id="form-delete">
        <input type="hidden" name="project_kode" value="<?= $project['kode_project'] ?>">
        <input type="hidden" name="id" id="id_delete" value="">
        <div class="modal-body">
          <p>Klik Submit untuk menghapus data</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  const btnSubmitPlan = document.getElementById('btn-submit-plan');
  btnSubmitPlan.addEventListener('click', function() {
    const taskId = document.getElementById('task').value;
    const dateStart = document.getElementById('date_start').value;
    const dateEnd = document.getElementById('date_finish').value;

    if (taskId && dateStart && dateEnd) {
      document.getElementById("alert-plan").style.display = "none";
      document.getElementById("form-project-plan").submit();
    } else {
      document.getElementById("alert-plan").style.display = "block";
    }
  })

  const btnSubmitTask = document.getElementById('btn-submit-task');
  btnSubmitTask.addEventListener('click', function() {
    const task = document.getElementById('new_task').value;
    console.log(task);

    if (task) {
      document.getElementById("alert-task").style.display = "none";
      document.getElementById("form-task").submit();
    } else {
      document.getElementById("alert-task").style.display = "block";
    }
  })

  const btnEditPlan = document.getElementsByClassName('btn-edit');
  for (var i = 0; i < btnEditPlan.length; i++) {
    btnEditPlan[i].addEventListener('click', function() {
      document.getElementById('id').value = this.getAttribute('data-id');
      document.getElementById('task_edit').value = this.getAttribute('data-task');
      document.getElementById('date_start_edit').value = this.getAttribute('data-datestart');
      document.getElementById('date_finish_edit').value = this.getAttribute('data-datefinish');
      $('.selectpicker').selectpicker('refresh');

    })
  }

  const btnDeletePlan = document.getElementsByClassName('btn-delete');
  for (var i = 0; i < btnDeletePlan.length; i++) {
    btnDeletePlan[i].addEventListener('click', function() {
      console.log('here');
      document.getElementById('id_delete').value = this.getAttribute('data-id');
    });
  }
</script>