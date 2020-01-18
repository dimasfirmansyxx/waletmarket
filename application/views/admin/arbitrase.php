<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Arbitrase</h1>
  </div>

  <div class="row">

    <div class="col-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">
            List Arbitrase
          </h6>
        </div>
        <div class="card-body table-responsive" id="load_data_area">
          <p class="text-center">Sedang Memuat data ...</p>
        </div>
      </div>
    </div>

  </div>

</div>

<div class="modal fade" id="arbitrasemodal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Arbitrase</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frmArbitrase">
          <div class="row">
            
            <div class="col-md-6">
              <div class="form-group">
                <label>Dana ke Seller</label>
                <input type="text" name="seller" class="form-control hargaformat txtdanaseller" required autocomplete="off">
              </div>
              <div class="form-group">
                <label>Dana ke Buyer</label>
                <input type="text" name="buyer" class="form-control hargaformat txtdanabuyer" required autocomplete="off">
              </div>
            </div>
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-6">
                  <button type="button" class="btn btn-primary btn-sm btn-block btnrekbuyer">Rekening Buyer</button>
                </div>
                <div class="col-md-6">
                  <button type="button" class="btn btn-primary btn-sm btn-block btnrekseller">Rekening Seller</button>
                </div>
                <div class="col-12 mt-2">
                  <div class="card">
                    <div class="card-body rekeningarea">
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btnSave">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="detailmodal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail Biaya</h5>
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
              <th>Ongkos Kirim</th>
              <td id="lblOngkir"></td>
            </tr>
            <tr>
              <th>Berat</th>
              <td id="lblBerat"></td>
            </tr>
            <tr>
              <th>Fee</th>
              <td id="lblFee"></td>
            </tr>
            <tr>
              <th>Total</th>
              <td id="lblTotal"></td>
            </tr>
            <tr>
              <th>Total - Fee</th>
              <th id="lblFinalTotal"></th>
            </tr>
          </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="danamodal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Info Pengembalian dana</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body danaArea">

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
      $("#load_data_area").load(base_url + "admin/arbitrase_data");
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

    $(".hargaformat").on("keyup",function(){
      var val = $(this).val();
      $(this).val( formatRupiah(val,"") );
    });

    $("#load_data_area").on("click",".btndetail",function(){
      var id_transaksi = $(this).attr("data-id");
      $.ajax({
        url : base_url + "home/get_detail_price",
        data : { id_transaksi : id_transaksi },
        type : "post",
        dataType : "json",
        success : function(result) {
          $("#lblSubtotal").html(result.subtotal);
          $("#lblOngkir").html(result.ongkir);
          $("#lblBerat").html(result.berat + " kg");
          $("#lblTotal").html(result.total);
          $("#lblFee").html(result.fee);
          $("#lblFinalTotal").html(result.total - result.fee);
          $("#detailmodal").modal("show");
          numberformat();
        }
      });
    });

    $("#load_data_area").on("click",".btndana",function(){
      $("#danamodal").modal("show");
      var id_arbitrase = $(this).attr("data-id");
      $(".danaArea").load(base_url + "admin/arbitrase_dana/" + id_arbitrase);
    });

    var id_arbitrase;
    var id_buyer;
    var id_seller;
    $("#load_data_area").on("click",".btnselesai",function(){
      var get = JSON.parse($(this).attr("data-id"));
      id_arbitrase = get.id_arbitrase;
      id_buyer = get.id_buyer;
      id_seller = get.id_seller;
      $.ajax({
        url : base_url + "arbitrase/get_fix_pengembalian/" + id_arbitrase,
        data : {},
        type : "post",
        dataType : "json",
        success : function(result) {
          $(".txtdanabuyer").val(formatRupiah(result.dana_buyer,""));
          $(".txtdanaseller").val(formatRupiah(result.dana_seller,""));
        }
      });
      $(".btnrekbuyer").click();
      $("#arbitrasemodal").modal("show");
    });

    $(".btnrekbuyer").on("click",function(){
      $(".rekeningarea").load(base_url + "admin/pencairan_info/rekening/" + id_buyer);
    });

    $(".btnrekseller").on("click",function(){
      $(".rekeningarea").load(base_url + "admin/pencairan_info/rekening/" + id_seller);
    });

    $("#frmArbitrase").on("submit",function(e){
      e.preventDefault();
      var data = new FormData(this);
      data.append("id_arbitrase",id_arbitrase);
      setButtonSaving();
      $.ajax({
        url : base_url + "admin/arbitrase/finish",
        data : data,
        cache : false,
        contentType : false,
        processData : false,
        type : "post",
        dataType : "text",
        success : function(result) {
          if ( result == 0 ) {
            swal("Sukses","Sukses menyelesaikan arbitrase","success");
            $("#arbitrasemodal").modal("hide");
            $("#frmArbitrase").trigger("reset");
            loadData();
          } else if ( result == 1 ) {
            swal("Gagal","Kesalahan pada server","error");
          }
          unsetButtonSaving();
        }
      });
    });

    function numberformat() {
      var detailongkir = " ( "+ $("#lblBerat").html() +" x (34000 x 1.3) | <b>Biaya Rp.34.000,-/kg</b> )";
      $("#lblSubtotal").html("Rp." + formatRupiah($("#lblSubtotal").html(),"") );
      $("#lblOngkir").html("Rp." + formatRupiah($("#lblOngkir").html(),"") + detailongkir);
      $("#lblTotal").html("Rp." + formatRupiah($("#lblTotal").html(),"") );
      $("#lblFee").html("Rp." + formatRupiah($("#lblFee").html(),"") );
      $("#lblFinalTotal").html("Rp." + formatRupiah($("#lblFinalTotal").html(),"") );
    }
    
  });
</script>