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

<div class="modal fade" id="detailmodal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Info Pembayaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <tr>
            <th>Subtotal</th>
            <td id="lblSubtotal"></td>
          </tr>
          <tr>
            <th>Fee Transaksi</th>
            <td id="lblFee"></td>
          </tr>
          <tr>
            <th>Ongkos Kirim</th>
            <td id="lblOngkir"></td>
          </tr>
          <tr>
            <th>Berat</th>
            <td id="lblBerat"></td>
          </tr>
          <tr>
            <th>Total</th>
            <td id="lblTotal"></td>
          </tr>
          <tr>
            <th>TOTAL PENCAIRAN</th>
            <th id="lblTotalPencairan"></th>
          </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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

    function formatRupiah(angka, prefix){
      var number_string = angka.replace(/[^,\d]/g, '').toString(),
      split       = number_string.split(','),
      sisa        = split[0].length % 3,
      rupiah        = split[0].substr(0, sisa),
      ribuan        = split[0].substr(sisa).match(/\d{3}/gi);
     
      // tambahkan titik jika yang di input sudah menjadi angka ribuan
      if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
      }
     
      rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
      return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
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

    $("#load_data_area").on("click",".btnPembayaran",function(){
      var id_transaksi = $(this).attr("data-id");
      $.ajax({
        url : base_url + "home/get_detail_price",
        data : { id_transaksi : id_transaksi },
        type : "post",
        dataType : "json",
        success : function(result) {
          var total = result.total - result.fee;
          $("#lblSubtotal").html(result.subtotal);
          $("#lblFee").html(result.fee);
          $("#lblOngkir").html(result.ongkir);
          $("#lblBerat").html(result.berat + " kg");
          $("#lblTotal").html(result.total);
          $("#lblTotalPencairan").html(total);
          $("#detailmodal").modal("show");
          numberformat();
        }
      });
    });

    function numberformat() {
      var detailongkir = " ( "+ $("#lblBerat").html() +" x (34000 x 1.3) | Biaya Rp.34.000,-/kg )";
      $("#lblSubtotal").html("Rp." + formatRupiah($("#lblSubtotal").html(),"") );
      $("#lblFee").html("Rp." + formatRupiah($("#lblFee").html(),"") );
      $("#lblOngkir").html("Rp." + formatRupiah($("#lblOngkir").html(),"") + detailongkir);
      $("#lblTotal").html("Rp." + formatRupiah($("#lblTotal").html(),"") );
      $("#lblTotalPencairan").html("Rp." + formatRupiah($("#lblTotalPencairan").html(),"") );
    }
    
  });
</script>