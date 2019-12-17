<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dasbor</h1>
  </div>

  <div class="row">

    <div class="col-md-3">
      <div class="card shadow mb-4">
        <div class="card-body">
          <h3><?= number_format($statistic_info['req_pencairan']) ?></h3>
          <h6>Permintaan Pencairan Dana</h6>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card shadow mb-4">
        <div class="card-body">
          <h3><?= number_format($statistic_info['lelang']) ?></h3>
          <h6>Postingan</h6>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card shadow mb-4">
        <div class="card-body">
          <h3><?= number_format($statistic_info['payment_waiting_confirm']) ?></h3>
          <h6>Pembayaran Menunggu Konfirmasi</h6>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card shadow mb-4">
        <div class="card-body">
          <h3><?= number_format($statistic_info['arbitrase']) ?></h3>
          <h6>Arbitrase</h6>
        </div>
      </div>
    </div>

  </div>

</div>

