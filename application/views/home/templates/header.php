<header>
  <div class="aa-header">
    <nav class="navbar navbar-expand-lg" style="background:transparent; box-shadow: none;">
      <div class="container">
        <img src="<?= base_url() ?>assets/img/core/logo.png" height=30>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="fa fa-bars" style="color: #fff;"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link text-white" href="<?= base_url() ?>home">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="<?= base_url() ?>home/page/cara-kerja-wallet-market">
                Cara Kerja
              </a>
            </li>
            <?php if ( $this->session->user_logged ): ?>
              <li class="nav-item">
                <a class="nav-link text-white" href="<?= base_url() ?>home/logout">Logout</a>
              </li>
            <?php else : ?>    
              <li class="nav-item">
                <a class="nav-link text-white" href="#" id="btnLogin">Login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="#" id="btnRegister">Register</a>
              </li>
              <li class="nav-item">
                
              </li>
            <?php endif ?>
            <li class="nav-item">
                <button class="btn btn-primary navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="true" aria-label="Toggle navigation">
                  Close
                </button>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container aa-header-content text-center text-white">
      <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4 col-sm-12">
          <a class="nav-link btn btn-success text-white" style="font-size: 20pt; background-color: #74ED30; border-color: #74ED30" href="#" id="btnTransaksiAman">Transaksi Aman</a>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-md-3"></div>
        <div class="col-md-6">
          <?php if ( !isset($jumbo_title) ): ?>
            <div class="card">
              <h5 class="card-header"><?= date("d F Y") ?></h5>
              <div class="card-body table-responsive">
                <table class="table table-bordered">
                <?php foreach ($infoharga as $key => $value): ?>
                  <?php if ( !($key == "tanggal") ): ?>
                    <tr>
                      <td>
                        <?= ucwords($key) ?>
                      </td>
                      <td><?= $value ?></td>
                    </tr>     
                  <?php endif ?>
                <?php endforeach ?>
                  <tr>
                    <td>Warna</td>
                    <td>Putih Kapas</td>
                  </tr>
                  <tr>
                    <td>Kadar</td>
                    <td>2% - 5%</td>
                  </tr>
                </table>
              </div>
            </div>
          <?php else: ?>
            <h3><?= ucwords($jumbo_title)  ?></h3>  
          <?php endif ?>
        </div>
      </div>
    </div>
  </div>
</header>
<div class="page-content">
  <div>