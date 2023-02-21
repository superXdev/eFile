<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?= base_url('assets/img/user2-160x160.jpg') ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?= session()->get('nama'); ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MENU</li>
      <li class="<?= (uri_string() == 'dashboard') ? 'active' : '' ?>">
        <a href="<?= base_url('dashboard') ?>">
          <i class="fa fa-home"></i> <span>Dashboard</span>
        </a>
      </li>
      <li class="<?= (uri_string() == 'file') ? 'active' : '' ?>">
        <a href="<?= base_url('file') ?>">
          <i class="fa fa-file"></i> <span>File</span>
        </a>
      </li>

      <?php if(session()->get('level') == 1): ?>
      <li class="<?= (uri_string() == 'user') ? 'active' : '' ?>">
        <a href="<?= base_url('user') ?>">
          <i class="fa fa-users"></i> <span>Daftar User</span>
        </a>
      </li>
      <li class="<?= (uri_string() == 'kategori') ? 'active' : '' ?>">
        <a href="<?= base_url('kategori') ?>">
          <i class="fa fa-th-list"></i> <span>Daftar Kategori</span>
        </a>
      </li>
      <li class="<?= (uri_string() == 'fakultas') ? 'active' : '' ?>">
        <a href="<?= base_url('fakultas') ?>">
          <i class="fa fa-th-list"></i> <span>Daftar Fakultas</span>
        </a>
      </li>
      <?php endif; ?>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>