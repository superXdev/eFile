<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>


<?php if(session()->getFlashData('success') !== null): ?>
<div class="alert alert-success alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <?= session()->getFlashData('success') ?>
</div>
<?php endif; ?>

<?php if(session()->getFlashData('error') !== null): ?>
<div class="alert alert-danger alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <?= session()->getFlashData('error') ?>
</div>
<?php endif; ?>

<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Daftar Fakultas</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
              title="Collapse">
        <i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body">
    <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modal-tambah">
      Tambah Fakultas
    </button>
    <table class="table table-hover" style="border: 1px solid #f0f0f0; margin-top: 10px;">
      <thead>
        <tr>
          <th>Nama Fakultas</th>
          <th>Tanggal dibuat</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($data as $row): ?>
          <tr>
            <td><?= $row['nama_fakultas'] ?></td>
            <td><?= $row['tanggal'] ?></td>
            <td class="text-center">
              <button class="btn btn-info btn-sm edit" data-id="<?= $row['id'] ?>"><i class="fa fa-edit"></i></button>
              <form style="display: inline;" action="<?= base_url('fakultas/hapus') ?>" method="POST">
                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                <button type="button" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i></button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<!-- /.box -->

<div class="modal fade" id="modal-tambah">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Fakultas</h4>
      </div>
      <div class="modal-body">
        <form method="POST" action="">
        <div class="row mb-2">
          <div class="col-md-12">
            <div class="form-group">
              <label for="">Nama Fakultas</label>
              <input type="text" class="form-control" name="nama_fakultas">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!-- /.modal -->
<div class="modal fade" id="modal-edit">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit</h4>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?= base_url('fakultas/update') ?>">
        <input type="hidden" name="id">
        <div class="row mb-2">
          <div class="col-md-12">
            <div class="form-group">
              <label for="">Nama Fakultas</label>
              <input type="text" class="form-control" name="nama_fakultas">
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
  $('.edit').click(function() {
    const id = $(this).attr('data-id');
    $.get('<?= base_url('fakultas/detail?id=') ?>' + id, function(data) {
      $('#modal-edit [name="id"]').val(id);
      $('#modal-edit [name="nama_fakultas"]').val(data.nama_fakultas);
    })
    $('#modal-edit').modal('show');
  });

  $('.delete').click(function() {
    const ok = confirm('Yakin ingin menghapus data?');

    if(ok) {
      $(this).parent().submit();
    }
  });
</script>
<?= $this->endSection(); ?>