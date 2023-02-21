<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>
<style>
  .icon {
    font-size: 20px;
  }

  .detail-mr {
    padding-right: 5px;
  }
</style>
<?= $this->endSection(); ?>

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
    <h3 class="box-title">File</h3>

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
      Upload File
    </button>
    <table class="table table-hover" style="border: 1px solid #f0f0f0; margin-top: 10px;">
      <thead>
        <tr>
          <th></th>
          <th>Nama File</th>
          <th>Nomor</th>
          <th>Kategori</th>
          <th>Pemilik</th>
          <th>Ukuran</th>
          <th>Tanggal</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php if(empty($data)): ?>
          <tr class="text-center">
            <td colspan="7">Tidak ada file</td>
          </tr>
        <?php endif; ?>
        <?php foreach($data as $row): ?>
          <tr>
            <td class="text-center">
              <?php if($row['extensi'] == 'pdf'): ?>
                <i class="fa fa-file-pdf-o text-danger icon"></i>
                <?php elseif($row['extensi'] == 'png' || $row['extensi'] == 'jpg' || $row['extensi'] == 'jpeg'): ?>
                  <i class="fa fa-file-image-o text-success icon"></i>
                <?php elseif($row['extensi'] == 'doc' || $row['extensi'] == 'docx'): ?>
                  <i class="fa fa-file-word-o text-primary icon"></i>
                <?php elseif($row['extensi'] == 'ppt' || $row['extensi'] == 'pptx'): ?>
                  <i class="fa fa-file-powerpoint-o text-danger icon"></i>
                <?php elseif($row['extensi'] == 'zip' || $row['extensi'] == 'rar'): ?>
                  <i class="fa fa-file-archive-o text-warning icon"></i>
                <?php else: ?>
                  <i class="fa fa-file icon"></i>
              <?php endif; ?>
            </td>
            <td><?= $row['nama_file'] ?></td>
            <td><?= $row['nomor'] ?></td>
            <td><?= $row['nama_kategori'] ?></td>
            <td><?= $row['nama'] ?></td>
            <td>
              <?php if($row['ukuran'] < 1000000): ?>
                <?= number_format($row['ukuran'] / 1024, 2, '.', '') ?>KB
              <?php else: ?>
                <?= number_format($row['ukuran'] / 1000000, 2, '.', '') ?>MB
              <?php endif; ?>
            </td>
            <td><?= $row['tanggal_upload'] ?></td>
            <td class="text-center">
              <a href="<?= base_url('uploads/'.$row['file']) ?>" target="_blank" class="btn btn-success btn-sm"><i class="fa fa-download"></i></a>
              <button class="btn btn-warning btn-sm detail" data-id="<?= $row['id_arsip'] ?>"><i class="fa fa-eye"></i></button>
              <button class="btn btn-info btn-sm edit" data-id="<?= $row['id_arsip'] ?>"><i class="fa fa-edit"></i></button>
              <form style="display: inline;" action="<?= base_url('file/hapus') ?>" method="POST">
                <input type="hidden" name="id" value="<?= $row['id_arsip'] ?>">
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

<div class="modal fade" id="modal-detail">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Detail File</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-4">
            <b>Nomor</b>
          </div>
          <div class="col-md-8">
            <span class="detail-mr">:</span> <span id="nomor-detail"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <b>Nama File</b>
          </div>
          <div class="col-md-8">
            <span class="detail-mr">:</span> <span id="nama-detail"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <b>Ukuran File</b>
          </div>
          <div class="col-md-8">
            <span class="detail-mr">:</span> <span id="ukuran-detail"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <b>Tipe File</b>
          </div>
          <div class="col-md-8">
            <span class="detail-mr">:</span> <span id="tipe-detail"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <b>Kategori</b>
          </div>
          <div class="col-md-8">
            <span class="detail-mr">:</span> <span id="kategori-detail"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <b>Fakultas</b>
          </div>
          <div class="col-md-8">
            <span class="detail-mr">:</span> <span id="fakultas-detail"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <b>Pemilik</b>
          </div>
          <div class="col-md-8">
            <span class="detail-mr">:</span> <span id="pemilik-detail"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <b>Deskripsi</b>
          </div>
          <div class="col-md-8">
            <span class="detail-mr">:</span> <span id="deskripsi-detail"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <b>Tanggal Upload</b>
          </div>
          <div class="col-md-8">
            <span class="detail-mr">:</span> <span id="tanggal-detail"></span>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
        <a href="" class="btn btn-success" id="download-file"><i class="fa fa-download"></i> Download</a>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-tambah">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Upload File</h4>
      </div>
      <div class="modal-body">
        <form method="POST" action="" enctype="multipart/form-data">
        <div class="row mb-2">
          <div class="col-md-6">
            <div class="form-group">
              <label for="">Nomor</label>
              <input type="text" class="form-control" value="<?= date('ymd') . '-' . substr(sha1(time()), 0, 3); ?>" name="nomor" readonly>
            </div>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-md-6">
            <div class="form-group">
              <label for="">Nama File</label>
              <input type="text" class="form-control" name="nama_file">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="">Kategori</label>
              <select name="id_kategori" class="form-control">
                <option value="">-- Pilih Kategori --</option>
                <?php foreach($kategori as $row): ?>
                  <option value="<?= $row['id'] ?>"><?= $row['nama_kategori'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-md-12">
            <div class="form-group">
            <label for="">Pilih File</label>
            <input type="file" name="file_arsip" class="form-control">
          </div>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-md-12">
            <div class="form-group">
              <label for="">Deskripsi</label>
              <textarea name="deskripsi" cols="30" rows="5" class="form-control"></textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Upload</button>
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
        <form method="POST" action="<?= base_url('file/update') ?>" enctype="multipart/form-data">
        <input type="hidden" name="id">
        <div class="row mb-2">
          <div class="col-md-6">
            <div class="form-group">
              <label for="">Nomor</label>
              <input type="text" class="form-control" value="<?= date('ymd') . '-' . substr(sha1(time()), 0, 3); ?>" name="nomor" readonly>
            </div>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-md-6">
            <div class="form-group">
              <label for="">Nama File</label>
              <input type="text" class="form-control" name="nama_file">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="">Kategori</label>
              <select name="id_kategori" class="form-control">
                <option value="">-- Pilih Kategori --</option>
                <?php foreach($kategori as $row): ?>
                  <option value="<?= $row['id'] ?>"><?= $row['nama_kategori'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-md-12">
            <div class="form-group">
            <label for="">Pilih File</label>
            <input type="file" name="file_arsip" class="form-control">
          </div>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-md-12">
            <div class="form-group">
              <label for="">Deskripsi</label>
              <textarea name="deskripsi" cols="30" rows="5" class="form-control"></textarea>
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

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
  $('.edit').click(function() {
    const id = $(this).attr('data-id');
    $.get('<?= base_url('file/detail?id=') ?>' + id, function(data) {
      $('#modal-edit [name="id"]').val(id);
      $('#modal-edit [name="nomor"]').val(data.nomor);
      $('#modal-edit [name="nama_file"]').val(data.nama_file);
      $('#modal-edit [name="deskripsi"]').val(data.deskripsi);

      $('#modal-edit [name="id_kategori"] option').each(function() {
        if(this.getAttribute('value') == data.id_kategori) {
          this.setAttribute('selected', '');
        }
      });
    });

    $('#modal-edit').modal('show');
  });

  $('.detail').click(function() {
    const id = $(this).attr('data-id');
    $.get('<?= base_url('file/detail?id=') ?>' + id, function(data) {
      $('#download-file').attr('href', data.file);
      $('#nama-detail').html(data.nama_file);
      $('#nomor-detail').html(data.nomor);
      $('#ukuran-detail').html(data.ukuran);
      $('#pemilik-detail').html(data.nama);
      $('#kategori-detail').html(data.nama_kategori);
      $('#fakultas-detail').html(data.nama_fakultas);
      $('#deskripsi-detail').html(data.deskripsi);
      $('#tanggal-detail').html(data.tanggal_upload);
      $('#tipe-detail').html(data.extensi);
    });

    $('#modal-detail').modal('show');
  });

  $('.delete').click(function() {
    const ok = confirm('Yakin ingin menghapus data?');

    if(ok) {
      $(this).parent().submit();
    }
  });
</script>
<?= $this->endSection(); ?>