<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Info Harga</h1>
  </div>

  <div class="row">

    <div class="col-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">
            Data Harga
            <button class="btn btn-primary btn-sm float-right" id="btnTambah">Tambahkan Harga Terbaru</button>
          </h6>
        </div>
        <div class="card-body table-responsive" id="load_data_area">
          <p class="text-center">Sedang Memuat data ...</p>
        </div>
      </div>
    </div>

  </div>

</div>

<div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Jenis</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frmTambah">
          <div class="form-group">
            <label>Tanggal</label>
            <input type="date" id="datepicker" name="tanggal" class="form-control" required autocomplete="off">
          </div>
          <?php foreach ($jenis as $row): ?>
            <div class="form-group">
              <label><?= ucwords($row['jenis']) ?></label>
              <input type="number" name="<?= $row['id_jenis'] ?>" class="form-control" required autocomplete="off">
            </div>
          <?php endforeach ?>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btnSave">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
  
    var base_url = "<?= base_url() ?>";

    function loadData() {
      $("#load_data_area").load(base_url + "admin/infoharga_data");
    }

    loadData();  

    $("#btnTambah").on("click",function(){
      $("#modaltambah").modal("show");
    });

    $("frmTambah").on("submit",function(e){
      e.preventDefault();
    });
    
  });
</script>