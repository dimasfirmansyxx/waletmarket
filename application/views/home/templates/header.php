<header>
  <div class="aa-header">
    <nav class="navbar navbar-expand-md navbar-transparent">
      <div class="container">
        <a class="navbar-brand px-0 py-0" href="#">
          <img class="img-fluid pr-3 aa-logo-img" src="<?= base_url() ?>assets/img/core/logo.png" alt="logo">
        </a>
        <div class="collapse navbar-collapse">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>home">Home</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container aa-header-content text-center text-white">
      <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
          <?php if ( !isset($jumbo_title) ): ?>
            <div class="card">
              <h5 class="card-header"><?= date("d F Y", strtotime($infoharga['tanggal'])) ?></h5>
              <div class="card-body table-responsive">
                <table class="table table-bordered">
                <?php foreach ($infoharga as $key => $value): ?>
                  <?php if ( !($key == "tanggal") ): ?>
                    <tr>
                      <td><?= ucwords($key) ?></td>
                      <td>Rp.<?= number_format($value) ?>,-</td>
                    </tr>     
                  <?php endif ?>
                <?php endforeach ?>
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