<div class="col-md-8">
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
            <a href="<?= base_url() ?>assets/img/post/<?= $row['photo'] ?>" target="_blank">
              <img src="<?= base_url() ?>assets/img/post/<?= $row['photo'] ?>" class="img-fluid">
            </a>
          </div>
          <div class="col-md-6">
            <?php if ( !($row['video'] == "") ): ?>
              <h6>Video : </h6>
              <video controls class="embed-responsive">
                <source src="<?= base_url() ?>assets/video/post/<?= $row['video'] ?>" type="video/mp4">
              </video>
            <?php endif ?>
          </div>
        </div>
        
        <?php if ( $this->session->user_logged ): ?>
          <?php if ( !($row['id_user'] == $this->session->user_id) ): ?>
            <button class="btn btn-primary btn-sm float-right btnPlaceBid" data-id="<?= $row['id_posting'] ?>">Place Bid</button>
          <?php endif ?>
        <?php else: ?>
          <button class="btn btn-primary btn-sm float-right btnAlertLogin">Place Bid</button>  
        <?php endif ?>
      </div>
    </div>  
  <?php endforeach ?>
  
</div>

<div class="modal fade" id="placebidmodal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Pasang bid</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frmPlaceBid">
          <div class="form-group">
            <label>Jumlah</label>
            <input type="number" name="jumlah" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Keterangan</label>
            <textarea required class="form-control" rows="10" name="remarks"></textarea>
          </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary btnClose mt-2 mb-2" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btnSave mt-2 mb-2 mr-2">Pasang</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function(){

    var base_url = "<?= base_url() ?>";
    var posting_selected;

    function setButtonSaving(word) {
      $(".btnSave").attr("disabled","disabled");
      $(".btnSave").html(word);
    }

    function unsetButtonSaving(word) {
      $(".btnSave").removeAttr("disabled");
      $(".btnSave").html(word);
    }

    $(".btnPlaceBid").on("click",function(){
      posting_selected = $(this).attr("data-id");
      $("#placebidmodal").modal("show");
    });

    $(".btnAlertLogin").on("click",function(){
      swal("Login!","Lakukan login terlebih dahulu sebelum memasang bid","warning");
    });

    $("#frmPlaceBid").on("submit",function(e){
      e.preventDefault();
      var id_user = "<?= $this->session->user_id ?>";
      var data = new FormData(this);
      data.append("id_user",id_user);
      data.append("id_posting",posting_selected);
      setButtonSaving("Placing bid ...");
      $.ajax({
        url : base_url + "home/lelang/bid",
        data : data,
        cache : false,
        contentType : false,
        processData : false,
        type : "post",
        dataType : "text",
        success : function(result) {
          if ( result == 0 ) {
            swal("Sukses","Sukses memasang bid","success");
            $(".btnClose").click();
          } else if ( result == 2 ) {
            swal("Gagal","Anda telah memasang bid","warning");
          } else if ( result == 1 ) {
            swal("Gagal","Kesalahan pada server","danger");
          }
          unsetButtonSaving("Pasang");
        }
      });
    });

  });
</script>