<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Konfigurasi Jenis</h1>
  </div>

  <div class="row">

    <div class="col-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">
            List Pembayaran
          </h6>
        </div>
        <div class="card-body table-responsive" id="load_data_area">
          <p class="text-center">Sedang Memuat data ...</p>
        </div>
      </div>
    </div>

  </div>

</div>

<script>
  $(document).ready(function(){

    var base_url = "<?= base_url() ?>";

    function loadData() {
      $("#load_data_area").load(base_url + "admin/payment_data");
    }

    loadData();

    $("#load_data_area").on("click",".btnAccept",function(){
      var id = $(this).attr('data-id');
      $.ajax({
        url : base_url + "admin/payment_check/accept",
        data : { id_payment : id },
        type : "post",
        dataType : "text",
        success: function(result) {
          if ( result == 0 ) {
            swal("Sukses","Sukses menerima pembayaran","success");
            loadData();
          } else if ( result == 1 ) {
            swal("Gagal","Kesalahan pada server","error");
          }
        }
      });
    });

    $("#load_data_area").on("click",".btnDecline",function(){
      var id = $(this).attr("data-id");
      $.ajax({
        url : base_url + "admin/payment_check/decline",
        data : { id_payment : id },
        type : "post",
        dataType : "text",
        success : function(result) {
          if ( result == 0 ) {
            swal("Sukses","Sukses menolak pembayaran","success");
            loadData();
          } else if ( result == 1 ) {
            swal("Gagal","Kesalahan pada server","error");
          }
        }
      });
    });

  });
</script>