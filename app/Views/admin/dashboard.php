<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<!-- Summary -->
<?php if(session()->get('level') == 1): ?>
<div class="row">
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-aqua"><i class="ion ion-folder"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Total File</span>
        <span class="info-box-number"><?= $arsip ?></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-red"><i class="ion ion-ios-people"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Jumlah User</span>
        <span class="info-box-number"><?= $user ?></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->

  <!-- fix for small devices only -->
  <div class="clearfix visible-sm-block"></div>

  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-green"><i class="ion ion-android-list"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Jumlah Kategori</span>
        <span class="info-box-number"><?= $kategori ?></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-yellow"><i class="ion ion-android-list"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Jumlah Fakultas</span>
        <span class="info-box-number"><?= $fakultas ?></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
</div>
<?php endif; ?>

<div class="row">
  <div class="col-md-6">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Upload Terakhir</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                  title="Collapse">
            <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        <table class="table table-hover" style="border: 1px solid #f0f0f0; margin-top: 10px;">
          <thead>
              <th>Nama File</th>
              <th>Nomor</th>
              <th>Tanggal Upload</th>
            </tr>
          </thead>
          <tbody>
            <?php if(empty($uploads)): ?>
              <tr class="text-center">
                <td colspan="7">Tidak ada file</td>
              </tr>
            <?php endif; ?>
            <?php foreach($uploads as $row): ?>
              <tr>
                <td><?= $row['nama_file'] ?></td>
                <td><?= $row['nomor'] ?></td>
                <td><?= $row['tanggal_upload'] ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Struktur File</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <div class="chart-responsive">
                <canvas id="pieChart" height="260" width="406"></canvas>
              </div>
              <!-- ./chart-responsive -->
            </div>
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
      </div>
  </div>
</div>
<!-- /.box -->

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<!-- ChartJS -->
<script src="<?= base_url('assets/chart.js/Chart.js') ?>"></script>
<script>
  const pieChartCanvas = $('#pieChart').get(0).getContext('2d');
  const pieChart       = new Chart(pieChartCanvas);
  const PieData        = [
    <?php
    $colors = ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#9236e3', '#e8dd3f', '#d2d6de']; 
    $i = 0;
    foreach($files as $k):
    ?>
    {
      value    : <?= $k['jumlah'] ?>,
      color    : '<?= $colors[$i] ?>',
      highlight: '<?= $colors[$i] ?>',
      label    : '<?= $k['extensi'] ?>'
    },
    <?php 
    $i++;
    endforeach;
    ?>
  ];
  const pieOptions     = {
    // Boolean - Whether we should show a stroke on each segment
    segmentShowStroke    : true,
    // String - The colour of each segment stroke
    segmentStrokeColor   : '#fff',
    // Number - The width of each segment stroke
    segmentStrokeWidth   : 1,
    // Number - The percentage of the chart that we cut out of the middle
    percentageInnerCutout: 50, // This is 0 for Pie charts
    // Number - Amount of animation steps
    animationSteps       : 100,
    // String - Animation easing effect
    animationEasing      : 'easeOutBounce',
    // Boolean - Whether we animate the rotation of the Doughnut
    animateRotate        : true,
    // Boolean - Whether we animate scaling the Doughnut from the centre
    animateScale         : false,
    // Boolean - whether to make the chart responsive to window resizing
    responsive           : true,
    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio  : false,
    // String - A legend template
    legendTemplate       : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<segments.length; i++){%><li><span style=\'background-color:<%=segments[i].fillColor%>\'></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>',
    // String - A tooltip template
    tooltipTemplate      : '<%=value %> <%=label%>'
  };
  // Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  pieChart.Doughnut(PieData, pieOptions);
</script>
<?= $this->endSection(); ?>