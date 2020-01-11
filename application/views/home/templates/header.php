<header>
  <div class="aa-header">
    <nav class="navbar navbar-expand-lg" style="background:transparent; box-shadow: none;">
      <div class="container">
        <a class="navbar-brand" href="<?= base_url() ?>home">
            <span style="color : #4E83E3">W</span>
            <span style="color : #CD4641">A</span>
            <span style="color : #EDC433">L</span>
            <span style="color : #4E83E3">E</span>
            <span style="color : #2E9752">T </span>
            <span style="color : #CD4641">M</span>
            <span style="color : #EDC433">A</span>
            <span style="color : #4E83E3">R</span>
            <span style="color : #2E9752">K</span>
            <span style="color : #EDC433">E</span>
            <span style="color : #4E83E3">T</span>
        </a>
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
            <li class="nav-item">
              <a class="nav-link text-white" href="#" id="btnNewsletter">
                Subscribe Newsletter
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
                <a class="nav-link btn btn-success text-white" href="#" id="btnTransaksiAman">Transaksi Aman</a>
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