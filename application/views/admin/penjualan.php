<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Penjualan</h1>
  </div>

  <div class="row">

    <div class="col-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">
            Transaksi
          </h6>
        </div>
        <div class="card-body table-responsive" id="load_data_area">
          <p class="text-center">Sedang Memuat data ...</p>
        </div>
      </div>
    </div>

  </div>

</div>

<div class="modal fade" id="infomodal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Info Pengiriman</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="load_info_area">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
  
    var base_url = "<?= base_url() ?>";

    function loadData() {
      $("#load_data_area").load(base_url + "admin/penjualan_data");
    }

    function setButtonSaving() {
      $(".btnSave").attr("disabled","disabled");
      $(".btnSave").html("Sedang Menyimpan ...");
    }

    function unsetButtonSaving() {
      $(".btnSave").removeAttr("disabled");
      $(".btnSave").html("Save Changes");
    }

    loadData();  

    $("#load_data_area").on("click",".btnshowinfo",function(){
      var id = $(this).attr("data-id");
      $("#load_info_area").load(base_url + "admin/infopengiriman_show/" + id);
      $("#infomodal").modal("show");
    });
    
  });
</script>