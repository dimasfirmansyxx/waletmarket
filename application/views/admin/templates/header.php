
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url() ?>admin">
    <div class="sidebar-brand-text mx-3"><?= $this->Func_model->site_info("name") ?></div>
  </a>
  <hr class="sidebar-divider my-0">

  <li class="nav-item">
    <a class="nav-link" href="<?= base_url() ?>admin/">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dasbor</span>
    </a>
  </li>

  <hr class="sidebar-divider">

  <li class="nav-item">
    <a class="nav-link" href="<?= base_url() ?>admin/infoharga">
      <i class="fas fa-fw fa-list"></i>
      <span>Update Info Harga</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="<?= base_url() ?>admin/pengguna">
      <i class="fas fa-fw fa-user"></i>
      <span>Konfigurasi Pengguna</span>
    </a>
  </li>

  <!-- <li class="nav-item">
    <a class="nav-link" href="<?= base_url() ?>admin/jenis">
      <i class="fas fa-fw fa-tag"></i>
      <span>Konfigurasi Jenis</span>
    </a>
  </li>   -->

  <!-- <li class="nav-item">
    <a class="nav-link" href="<?= base_url() ?>admin/penjualan">
      <i class="fas fa-fw fa-shopping-cart"></i>
      <span>Postingan Penjual</span>
    </a>
  </li> -->

  <hr class="sidebar-divider">

  <li class="nav-item">
    <a class="nav-link" href="<?= base_url() ?>admin/arbitrase">
      <i class="fas fa-fw fa-money-bill-wave"></i>
      <span>Arbitrase</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="<?= base_url() ?>admin/payment">
      <i class="fas fa-fw fa-money-bill-wave"></i>
      <span>Konfirmasi Pembayaran</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="<?= base_url() ?>admin/pencairan">
      <i class="fas fa-fw fa-money-bill-wave-alt"></i>
      <span>Pencairan Dana</span>
    </a>
  </li>

  <!-- <hr class="sidebar-divider">

  <li class="nav-item">
    <a class="nav-link" href="<?= base_url() ?>admin/editsitus">
      <i class="fas fa-fw fa-cogs"></i>
      <span>Konfigurasi Situs</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="<?= base_url() ?>admin/manajemenadmin">
      <i class="fas fa-fw fa-user"></i>
      <span>Akun Admin</span>
    </a>
  </li>     -->

  <hr class="sidebar-divider">

  <!-- <li class="nav-item">
    <a class="nav-link" href="<?= base_url() ?>admin/akun">
      <i class="fas fa-fw fa-cogs"></i>
      <span>Konfigurasi Akun</span>
    </a>
  </li> -->

  <li class="nav-item">
    <a class="nav-link" href="<?= base_url() ?>admin/logout">
      <i class="fas fa-fw fa-sign-out-alt"></i>
      <span>Logout</span>
    </a>
  </li>  

  <hr class="sidebar-divider">

</ul>
<div id="content-wrapper" class="d-flex flex-column">
<div id="content">
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
  <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
  </button>

  <ul class="navbar-nav ml-auto">

    <div class="topbar-divider d-none d-sm-block"></div>

    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="mr-2 d-none d-lg-inline text-gray-600 small">
          <?= $this->Admin_model->admin_info($this->session->admin_id,"nama") ?>
        </span>
        <img class="img-profile rounded-circle" src="<?= base_url() ?>assets/img/core/user-icon.png">
      </a>
    </li>

  </ul>

</nav>
<!-- End of Topbar -->
