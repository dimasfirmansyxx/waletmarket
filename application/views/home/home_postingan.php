<?php foreach ($posting as $row): ?>
  <?php 
    $user_info = $this->Home_model->user_info($row['id_user']);
    $detailposting = $this->Lelang_model->get_all_lelang_detail($row['id_posting']);
  ?>
  <div class="row mt-5">
    <div class="col-md-12">
      <h5><?= strtoupper($row['jenis']) ?> : <?= ucwords($row['judul']) ?></h5>

      <div class="row">
        <div class="col-md-6">
          <h6>Info Postingan : </h6>
          <table class="table table-bordered mt-3">
            <?php foreach ($detailposting as $detail): ?>
              <tr>
                <th style="padding: 5px"><?= ucwords($this->Func_model->get_jenis($detail['id_jenis'])['jenis']) ?></th>
                <td style="padding: 5px">
                  <?= $detail['jumlah'] ?> <?= $this->Func_model->get_jenis($detail['id_jenis'])['satuan'] ?>
                </td>
                <td style="padding: 5px">
                  Rp.<?= number_format($detail['harga']) ?>
                </td>
              </tr>
            <?php endforeach ?>
            <tr>
              <th style="padding: 5px">Kadar</th>
              <td colspan="2" style="padding: 5px"><?= $row['kadar'] ?> %</td>
            </tr>
            <tr>
              <th style="padding: 5px">Warna</th>
              <td colspan="2" style="padding: 5px"><?= ucwords($row['warna']) ?></td>
            </tr>
          </table>            
        </div>
        <div class="col-md-6">
          <?php if ( $row['jenis'] == "jual" ): ?>
            <h6>Info Penjual :</h6>
          <?php else: ?>
            <h6>Info Pembeli :</h6>
          <?php endif ?>
          <table class="table table-bordered">
            <tr>
              <th width="150" style="padding: 5px">Nama</th>
              <td style="padding: 5px"><?= $user_info['nama'] ?></td>
            </tr>
            <tr>
              <th style="padding: 5px">Alamat</th>
              <td style="padding: 5px"><?= $user_info['alamat'] ?></td>
            </tr>
            <tr>
              <th style="padding: 5px">Kota</th>
              <td style="padding: 5px"><?= $user_info['kota'] ?></td>
            </tr>
            <tr>
              <th style="padding: 5px">Provinsi</th>
              <td style="padding: 5px"><?= $user_info['provinsi'] ?></td>
            </tr>
            <tr>
              <th style="padding: 5px">Nomor HP</th>
              <td style="padding: 5px"><?= $user_info['nohp'] ?></td>
            </tr>
            <tr>
              <th style="padding: 5px">Keterangan</th>
              <td style="padding: 5px"><?= $row['remarks'] ?></td>
            </tr>
          </table>
        </div>
      </div>


      <div class="row mb-2">
        <div class="col-md-6">
          <h6>Photo : </h6>
          <a href="<?= base_url() ?>assets/img/post/<?= $row['photo'] ?>" target="_blank">
            <img src="<?= base_url() ?>assets/img/post/<?= $row['photo'] ?>" class="img-fluid" height="250">
          </a>
        </div>
        <div class="col-md-6">
          <?php if ( !($row['video'] == "") ): ?>
            <h6>Video : </h6>
            <video controls class="embed-responsive" height="250">
              <source src="<?= base_url() ?>assets/video/post/<?= $row['video'] ?>" type="video/mp4">
            </video>
          <?php endif ?>
        </div>
      </div>
      
      <?php if ( $this->session->user_logged ): ?>
        <?php if ( !($row['id_user'] == $this->session->user_id) ): ?>
          <button class="btn btn-primary btn-sm float-right btnPesan" data-id="<?= $row['id_posting'] ?>">PESAN</button>
        <?php endif ?>
      <?php else: ?>
        <button class="btn btn-primary btn-sm float-right btnAlertLogin">PESAN</button>  
      <?php endif ?>
    </div>
  </div>  
<?php endforeach ?>

<script>
  $(document).ready(function(){

    var base_url = "<?= base_url() ?>";
    var id_user = "<?= $this->session->user_id ?>";

    function setButtonSaving(word) {
      $(".btnPesan").attr("disabled","disabled");
      $(".btnPesan").html(word);
    }

    function unsetButtonSaving(word) {
      $(".btnPesan").removeAttr("disabled");
      $(".btnPesan").html(word);
    }

    $(".btnPesan").on("click",function(e){
      e.preventDefault();
      var posting_selected = $(this).attr("data-id");
      setButtonSaving("Memasukkan ke Keranjang belanja ...");
      $.ajax({
        url : base_url + "home/transaksi/pesan",
        data : { id_user : id_user, id_posting : posting_selected },
        type : "post",
        dataType : "text",
        success : function(result) {
          if ( result == 0 ) {
            swal("Sukses","Sukses memasukkan ke keranjang belanja","success");
            $(".btnClose").click();
          } else if ( result == 2 ) {
            swal("Gagal","Anda telah menambahkan ke keranjang belanja","warning");
          } else if ( result == 1 ) {
            swal("Gagal","Kesalahan pada server","danger");
          }
          unsetButtonSaving("PESAN");
        }
      });
    });

  });
</script>