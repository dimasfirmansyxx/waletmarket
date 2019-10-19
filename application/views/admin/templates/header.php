
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url() ?>admin">
    <div class="sidebar-brand-text mx-3"><?= $this->Func_model->site_info("name") ?></div>
  </a>
  <hr class="sidebar-divider my-0">

  <li class="nav-item">
    <a class="nav-link" href="index.html">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dasbor</span>
    </a>
  </li>

  <hr class="sidebar-divider">

  <li class="nav-item">
    <a class="nav-link" href="index.html">
      <i class="fas fa-fw fa-list"></i>
      <span>Update Info Harga</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="index.html">
      <i class="fas fa-fw fa-tag"></i>
      <span>Konfigurasi Jenis</span>
    </a>
  </li>  

  <li class="nav-item">
    <a class="nav-link" href="index.html">
      <i class="fas fa-fw fa-shopping-cart"></i>
      <span>Postingan Penjual</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="index.html">
      <i class="fas fa-fw fa-shopping-cart"></i>
      <span>Postingan Pembeli</span>
    </a>
  </li>  

  <hr class="sidebar-divider">

  <li class="nav-item">
    <a class="nav-link" href="index.html">
      <i class="fas fa-fw fa-cogs"></i>
      <span>Konfigurasi Situs</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="index.html">
      <i class="fas fa-fw fa-user"></i>
      <span>Akun Admin</span>
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
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="mr-2 d-none d-lg-inline text-gray-600 small">
          <?= $this->Admin_model->admin_info($this->session->admin_id,"nama") ?>
        </span>
        <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
      </a>
      <!-- Dropdown - User Information -->
      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
        <a class="dropdown-item" href="#">
          <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
          Profile
        </a>
        <a class="dropdown-item" href="#">
          <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
          Settings
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
          <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
          Logout
        </a>
      </div>
    </li>

  </ul>

</nav>
<!-- End of Topbar -->
