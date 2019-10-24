<div class="col-md-8">

  <?php foreach ($posting as $row): ?>
    <?php 
      $user_info = $this->Home_model->user_info($row['id_user']);
      $detailposting = $this->Lelang_model->get_all_lelang_detail($row['id_posting']);
    ?>
    <div class="row mt-5">
      <div class="col-md-2">
        <a href="<?= base_url() ?>assets/img/post/<?= $row['photo'] ?>" target="_blank">
          <img src="<?= base_url() ?>assets/img/post/<?= $row['photo'] ?>" class="img-fluid">
        </a>
      </div>
      <div class="col-md-10">
        <h5><?= ucwords($row['judul']) ?></h5>
        <h6 class="text-muted">
          <?= $user_info['nama'] ?>
        </h6>
        <p>
          <?= $user_info['alamat'] . ", " . $user_info['kota'] . ", " . $user_info['provinsi'] ?>.
          <?= $user_info['nohp'] ?>
        </p>
        <?php if ( !($row['video'] == "") ): ?>
          <video controls class="embed-responsive">
            <source src="<?= base_url() ?>assets/video/post/<?= $row['video'] ?>" type="video/mp4">
          </video>
        <?php endif ?>
        <table class="table table-bordered mt-3">
          <?php foreach ($detailposting as $detail): ?>
            <tr>
              <th><?= ucwords($this->Func_model->get_jenis($detail['id_jenis'])['jenis']) ?></th>
              <td><?= $detail['jumlah'] ?> <?= $this->Func_model->get_jenis($detail['id_jenis'])['satuan'] ?></td>
            </tr>
          <?php endforeach ?>
          <tr>
            <th>Kadar</th>
            <td><?= $row['kadar'] ?> %</td>
          </tr>
          <tr>
            <th>Warna</th>
            <td><?= $row['warna'] ?></td>
          </tr>
        </table>
        <p>
          <?= $row['remarks'] ?>
        </p>
        <button class="btn btn-primary btn-sm float-right">Place Bid</button>
      </div>
    </div>  
  <?php endforeach ?>
  
</div>

<script>
  $(document).ready(function(){

    var base_url = "<?= base_url() ?>";

  });
</script>