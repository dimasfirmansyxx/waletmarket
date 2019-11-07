<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Pencairan Dana</h1>
  </div>

  <div class="row">

    <div class="col-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">
            List Transaksi
          </h6>
        </div>
        <div class="card-body table-responsive" id="load_data_area">
          <p class="text-center">Sedang Memuat data ...</p>
        </div>
      </div>
    </div>

  </div>

</div>

<div class="modal fade" id="infosellermodal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Info Seller</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body showInfoSeller">
        <p class="text-center">Sedang memuat data ...</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="inforekeningmodal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Info Rekening Seller</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body showInfoRekening">
        <p class="text-center">Sedang memuat data ...</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function(){

    var base_url = "<?= base_url() ?>";

    function loadData() {
      $("#load_data_area").load(base_url + "admin/pencairan_data");
    }

    loadData();

    $("#load_data_area").on("click",".btnShowInfo",function(){
      $("#infosellermodal").modal("show");
      var id = $(this).attr("data-id");
      $(".showInfoSeller").load( base_url + "admin/pencairan_info/user/" + id );
    });

    $("#load_data_area").on("click",".btnShowRek",function(){
      $("#inforekeningmodal").modal("show");
      var id = $(this).attr("data-id");
      $(".showInfoRekening").load( base_url + "admin/pencairan_info/rekening/" + id );
    });

    $("#load_data_area").on("click",".btnTransaksiSelesai",function(){
      var id = $(this).attr("data-id");
      $.ajax({
        url : base_url + "admin/pencairan/selesai",
        data : { id_transaksi : id },
        type : "post",
        dataType : "text",
        success : function(result) {
          if ( result == 0 ) {
            swal("Sukses","Transaksi selesai","success");
            loadData();
          } else if ( result == 1 ) {
            swal("Gagal","Kesalahan pada server","error");
          }
        }
      });
    });
    
  });
</script>