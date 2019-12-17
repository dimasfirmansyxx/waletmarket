<div class="modal fade" id="mylelangmodel" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Postingan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="row">
      		<div class="col-lg-12 showLelang">
		      	<p class="text-center">Sedang Memuat data ...</p>
      		</div>
      	</div>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-secondary mt-2 mb-2 mr-2 btnClose" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="transaksimodal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Transaksi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="row">
      		<div class="col-lg-12 showMyTransaksi">
		      	<p class="text-center">Sedang Memuat data ...</p>
      		</div>
      	</div>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-secondary mt-2 mb-2 mr-2 btnClose" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="ordermodal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">List Order</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body showListOrder">
      	<p class="text-center">Sedang Memuat data ...</p>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-secondary mt-2 mb-2 mr-2 btnClose" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="keranjangmodal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="max-width: 1140px;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Keranjang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body showKeranjang table-responsive">
      	<p class="text-center">Sedang Memuat data ...</p>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-secondary mt-2 mb-2 mr-2 btnClose keranjangClose" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="detailmodal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail</h5>
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
            <th>TOTAL</th>
            <th id="lblTotal"></th>
          </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary mt-2 mb-2 mr-2 btnClose" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="profilmodal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Profil</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<?php  
      		$user_info = $this->Home_model->user_info($this->session->user_id);
      		$bank_info = $this->Home_model->user_rekening($this->session->user_id);
      	?>
      	<form id="frmProfil">
	      	<div class="row">
	      		<div class="col-md-6">
		      		<div class="form-group">
		      			<label>Nama</label>
		      			<input type="text" name="nama" class="form-control" required autocomplete="off" value="<?= $user_info['nama'] ?>">
		      		</div>
		      		<div class="form-group">
		      			<label>Nomor HP</label>
		      			<input type="number" name="nohp" class="form-control" required autocomplete="off" value="<?= $user_info['nohp'] ?>">
		      		</div>
		      		<div class="form-group">
		      			<label>Alamat</label>
		      			<input type="text" name="alamat" class="form-control" required autocomplete="off" value="<?= $user_info['alamat'] ?>">
		      		</div>
		      		<div class="form-group">
		      			<label>Kota</label>
		      			<input type="text" name="kota" class="form-control" required autocomplete="off" value="<?= $user_info['kota'] ?>">
		      		</div>
		      		<div class="form-group">
		      			<label>Provinsi</label>
		      			<input type="text" name="provinsi" class="form-control" required autocomplete="off" value="<?= $user_info['provinsi'] ?>">
		      		</div>
	      		</div>
	      		<div class="col-md-6">
	      			<div class="form-group">
		      			<label>Nama Bank</label>
		      			<input type="text" name="bankname" class="form-control" required autocomplete="off" value="<?= $bank_info['bankname'] ?>">
		      		</div>
		      		<div class="form-group">
		      			<label>Nomor Rekening</label>
		      			<input type="number" name="norek" class="form-control" required autocomplete="off" value="<?= $bank_info['norek'] ?>">
		      		</div>
		      		<div class="form-group">
		      			<label>Atas Nama</label>
		      			<input type="text" name="an" class="form-control" required autocomplete="off" value="<?= $bank_info['an'] ?>">
		      		</div>
	      		</div>
	      	</div>
      </div>
      <div class="modal-footer">
	      	<button type="button" class="btn btn-secondary mt-2 mb-2 mr-2 btnClose" data-dismiss="modal">Close</button>
	      	<button type="submit" class="btn btn-primary mt-2 mb-2 mr-2">Save</button>
      	</form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="dopaymentmodal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Lakukan Pembayaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <p>Lakukan Pembayaran dengan rincian sebagai berikut : </p>
            <table class="table table-bordered">
              <tr>
                <th>Nama Bank</th>
                <td><?= $this->Func_model->site_info("bankname") ?></td>
              </tr>
              <tr>
                <th>Nomor Rekening</th>
                <td><?= $this->Func_model->site_info("banknumber") ?></td>
              </tr>
              <tr>
                <th>Atas Nama</th>
                <td><?= $this->Func_model->site_info("bankowner") ?></td>
              </tr>
            </table>
          </div>
          <div class="col-md-6">
            <form id="frmBayar">
              <div class="form-group">
                <label>Nama Bank</label>
                <input type="text" name="bankname" class="form-control" required autocomplete="off">
              </div>
              <div class="form-group">
                <label>Nomor Rekening</label>
                <input type="number" name="norek" class="form-control" required autocomplete="off">
              </div>
              <div class="form-group">
                <label>Atas Nama</label>
                <input type="text" name="an" class="form-control" required autocomplete="off">
              </div>
              <div class="form-group">
                <label>Jumlah Transfer</label>
                <input type="text" name="jumlah" class="form-control hargaformat" id="txtjmltransfer" readonly>
              </div>
              <div class="form-group">
                <label>Bukti</label>
                <input type="file" name="bukti" class="form-control" required autocomplete="off">
              </div>
              <button type="submit" class="btn btn-primary btn-sm btn-block btnsubmitpayment">Submit</button>
            </form>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary mt-2 mb-2 mr-2 btnClose" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="todelivermodal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Bukti Pengiriman</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frmToDeliver" enctype="multipart/form-data">
        	<div class="form-group">
        		<label>Nomor Resi</label>
        		<input type="text" name="noresi" class="form-control" required autocomplete="off">
        	</div>
        	<div class="form-group">
        		<label>Upload Nomor Resi</label>
        		<input type="file" name="noresi_photo" class="form-control" required autocomplete="off">
        	</div>
        	<div class="form-group">
        		<label>Upload Foto Berat (Timbangan)</label>
        		<input type="file" name="timbangan" class="form-control" required autocomplete="off">
        	</div>
        	<div class="form-group">
        		<label>Upload Video Bahan</label>
        		<input type="file" name="video" class="form-control" required autocomplete="off">
        	</div>
      </div>
      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary mt-2 mb-2 mr-2 btnClose" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary mr-2 btnsubmitpengiriman">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="infopengirimanmodal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Informasi Pengiriman</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body showInfoPengiriman">
      	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary mt-2 mb-2 mr-2 btnClose" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="claimarbitrasemodal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Arbitrase</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frmArbitrase">
          <div class="form-group">
            <label>Keterangan</label>
            <textarea class="form-control" required name="remarks" rows="5"></textarea>
          </div>
          <div class="form-group">
            <label>Bukti-bukti</label>
            <input type="file" name="bukti[]" multiple="multiple" class="form-control" required>
            <small>Tipe file yang diizinkan .jpg|.jpeg|.bmp|.png</small>
          </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary mt-2 mb-2 mr-2 btnClose" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary mt-2 mb-2 mr-2 btnSave">Submit</button>
        </form>
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
      <div class="modal-body showArbitrase">
        
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary mt-2 mb-2 mr-2 btnClose" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
	$(document).ready(function(){

		var base_url = "<?= base_url() ?>";
		var id_user = "<?= $this->session->user_id ?>";

		  function setButtonSaving(word) {
	      $(".btnSave").attr("disabled","disabled");
	      $(".btnSave").html(word);
	    }

	    function unsetButtonSaving(word) {
	      $(".btnSave").removeAttr("disabled");
	      $(".btnSave").html(word);
	    }

      function setButton(attribute,word) {
        $(attribute).attr("disabled","disabled");
        $(attribute).html(word);
      }

      function unsetButton(attribute,word) {
        $(attribute).removeAttr("disabled");
        $(attribute).html(word);
      }

	    function loadLelangData() {
	    	$(".showLelang").load( base_url + "home/get_my_lelang/" + id_user );
	    }

	    function loadBidData(id_posting) {
	    	$(".showBidder").load( base_url + "home/get_bidder/" + id_posting );
	    }

	    function loadMyBid() {
	    	$(".showMyBid").load( base_url + "home/get_my_bid/" + id_user );
	    }

	    function loadTransaksi() {
	    	$(".showMyTransaksi").load( base_url + "home/transaksi_show/" + id_user );
	    }

	    function loadOrder() {
	    	$(".showListOrder").load( base_url + "home/order_show/" + id_user );
	    }

	    function loadKeranjang() {
	    	$(".showKeranjang").load( base_url + "home/keranjang_show/" + id_user );
	    }

		$("#btnBuatLelang").on("click",function(){
			$("#buatlelangmodal").modal("show");
		});

		$("#btnLelang").on("click",function(){
			loadLelangData();
			$("#mylelangmodel").modal("show");
		});

		$("#btnBid").on("click",function(){
			loadMyBid();
			$("#mybidmodal").modal("show");
		});

		$("#btnOrder").on("click",function(){
			loadOrder();
			$("#ordermodal").modal("show");
		});

		$("#btnKeranjang").on("click",function(){
			loadKeranjang();
			$("#keranjangmodal").modal("show");
		});

		$(".showLelang").on("click",".btnShowBidder",function(){
			var id = $(this).attr("data-id");
			loadBidData(id);
			$("#biddermodel").modal("show");
		});

    $(".showLelang").on("click",".btnEdit",function(){
      var id = $(this).attr("data-id");
      window.location = base_url + "home/edit/" + id;
    });

		$("#btnTransaksi").on("click",function(){
			loadTransaksi();
			$("#transaksimodal").modal("show");
		});

		$("#btnProfil").on("click",function(){
			$("#profilmodal").modal("show");
		});

		$(".showLelang").on("click",".btnDelete",function(){
			var id = $(this).attr("data-id");
			swal({
			  title: "Yakin ingin menghapus postingan ini ?",
			  text: "Bidder serta Conversation akan hilang juga",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			})
			.then((willDelete) => {
			  if (willDelete) {
			    $.ajax({
			    	url : base_url + "home/lelang/hapus",
			    	data : { id_posting : id },
			    	type : "post",
			    	dataType : "text",
			    	success : function(result) {
			    		if ( result == 0 ) {
				            swal("Sukses","Sukses menghapus postingan","success");
				            loadLelangData();
				        } else if ( result == 1 ) {
				            swal("Gagal","Kesalahan pada server","error");
				        }
			    	}
			    });
			  }
			});
		});

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

    $(".hargaformat").on("keyup",function(e){
      var get = formatRupiah($(this).val(),"");
      $(this).val(get);
    }); 

    $(".showKeranjang").on("click",".btnHapus",function(){
      var id = $(this).attr("data-id");
      setButton(".btnHapus","Menghapus...");
      $.ajax({
        url : base_url + "home/delete_keranjang",
        data : { id_transaksi : id },
        type : "post",
        dataType : "text",
        success : function(result) {
          if ( result == 0 ) {
            swal("Sukses","Pembayaran akan di verifikasi oleh Admin","success");
            loadKeranjang();
            setTimeout(function(){
              window.location = base_url + "home";
            },1000);
          } else if ( result == 1 ) {
            swal("Gagal","Kesalahan pada server","error");
          }
          unsetButton(".btnHapus","Hapus");
        }
      });
    });

		var id_transaksi;
		$(".showKeranjang").on("click",".btnDoPayment",function(){
			id_transaksi = $(this).attr("data-id");
			$(".btnClose").click();
			setTimeout(function(){
        showtotalprice();
				$("#dopaymentmodal").modal("show");
			},500);
		});

    function showtotalprice() {
      $.ajax({
        url : base_url + "home/get_detail_price",
        data : { id_transaksi : id_transaksi },
        type : "post",
        dataType : "json",
        success : function(result) {
          $("#txtjmltransfer").val(result.total);
          $("#txtjmltransfer").val( formatRupiah($("#txtjmltransfer").val()) );
        }
      });
    }

		$("#frmBayar").on("submit",function(e){
			e.preventDefault();
			var formdata = new FormData(this);
			formdata.append("id_transaksi",id_transaksi);
			formdata.append("id_user",id_user);
      setButton(".btnsubmitpayment","Menyimpan...");
			$.ajax({
				url : base_url + "home/do_payment",
				data : formdata,
				cache : false,
				processData : false,
				contentType : false,
				type: "post",
				dataType : "text",
				success : function(result) {
					if ( result == 0 ) {
						swal("Sukses","Pembayaran akan di verifikasi oleh Admin","success");
            $("#dopaymentmodal").modal("hide");
					} else if ( result == 2 ) {
						swal("Gagal","Anda sudah melakukan pembayaran","warning");
					} else if ( result == 1 ) {
						swal("Gagal","Kesalahan pada server","error");
					} else if ( result == 4 ) {
						swal("Gagal","Pastikan format gambar adalah 'jpg,jpeg,png,bmp'");
					} else if ( result == 5 ) {
            swal("Gagal","Pastikan transfer harus sama dengan harga total");
					}
          unsetButton(".btnsubmitpayment","Submit");
				} 
			});	
		});

		$(".showKeranjang").on("click",".btnShowResi",function(){
			id_transaksi = $(this).attr("data-id");
			$(".showInfoPengiriman").load( base_url + "home/infopengiriman_show/" + id_transaksi);
			$("#infopengirimanmodal").modal("show");
		});

    $(".showKeranjang").on("click",".btnDetail",function(){
      id_transaksi = $(this).attr("data-id");
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
          $("#detailmodal").modal("show");
          numberformat();
        }
      });
    });

    function numberformat() {
      var detailongkir = " ( "+ $("#lblBerat").html() +" x (34000 x 1.3) | <b>Biaya Rp.34.000,-/kg</b> )";
      $("#lblSubtotal").html("Rp." + formatRupiah($("#lblSubtotal").html(),"") );
      $("#lblOngkir").html("Rp." + formatRupiah($("#lblOngkir").html(),"") + detailongkir);
      $("#lblTotal").html("Rp." + formatRupiah($("#lblTotal").html(),"") );
    }

		var selected_transaction;
		$(".showListOrder").on("click",".btnToDeliver",function(){
			selected_transaction = $(this).attr("data-id");
			$(".btnClose").click();
			setTimeout(function(){
				$("#todelivermodal").modal("show");
			},500);
		});

		$("#frmToDeliver").on("submit",function(e){
			e.preventDefault();
			var formdata = new FormData(this);
			formdata.append("id_transaksi",selected_transaction);
      setButton(".btnsubmitpengiriman","Menyimpan...");
			$.ajax({
				url : base_url + "home/change_todeliver",
				data : formdata,
				cache : false,
				processData : false,
				contentType : false,
				type: "post",
				dataType : "text",
				success : function(result) {
					if ( result == 0 ) {
						swal("Sukses","Setelah buyer sudah mengkonfirmasi, uang akan dikirimkan oleh admin. Pastikan Nomor Rekening sudah terdaftar di akun anda","success");
			            $("#todelivermodal").modal("hide");
					} else if ( result == 1 ) {
						swal("Gagal","Kesalahan pada server","error");
					} else if ( result == 401 ) {
						swal("Gagal","Pastikan format gambar adalah 'jpg,jpeg,png,bmp'");
					} else if ( result == 402 ) {
						swal("Gagal","Pastikan format video adalah 'mp4,3gp,mkv,mov'");
					}
          setButton(".btnsubmitpengiriman","Submit");
				} 
			});	
		});

		$(".showKeranjang").on("click",".btnToReceived",function(){
			var id = $(this).attr("data-id");
			$.ajax({
				url : base_url + "home/change_status_transaksi/received",
				data : { id_transaksi : id },
				type : "post",
				dataType : "text",
				success : function(result) {
					if ( result == 0 ) {
						swal("Sukses","Sukses mengubah status ke 'Received'","success");
						loadKeranjang();
					} else if ( result == 1 ) {
						swal("Gagal","Kesalahan pada server","error");
					}
				}
			});
		});

    $(".showKeranjang").on("click",".btnToArbitrase",function(){
      id_transaksi = $(this).attr("data-id");
      $(".keranjangClose").click();
      $("#claimarbitrasemodal").modal("show");
    });

    $("#frmArbitrase").on("submit",function(e){
      e.preventDefault();
      var data = new FormData(this);
      data.append("id_transaksi",id_transaksi);
      setButtonSaving("Mengirim...");
      $.ajax({
        url : base_url + "home/arbitrase/claim",
        data : data,
        cache : false,
        processData : false,
        contentType : false,
        type : "post",
        dataType : "text",
        success: function(result) {
          if ( result == 0 ) {
            swal("Sukses","Sukses melakukan arbitrase","success");
            $("#claimarbitrasemodal").modal("hide");
          } else if ( result == 2 ) {
            swal("Gagal","Anda sudah melakukan arbitrase","warning");
          } else if ( result == 1 ) {
            swal("Gagal","Kesalahan pada server","error");
          } else if ( result == 4 ) {
            swal("Gagal","Pastikan format gambar adalah 'jpg,jpeg,png,bmp'");
          } 
          unsetButtonSaving("Submit");
        }
      });
    });

		$("#frmProfil").on("submit",function(e){
			e.preventDefault();
			var formdata = new FormData(this);
			formdata.append("id_user",id_user);
			$.ajax({
				url : base_url + "home/save_user_profil",
				data : formdata,
				cache : false,
				processData	: false,
				contentType : false,
				type : "post",
				dataType : "text",
				success : function(result) {
					if ( result == 0 ) {
						swal("Sukses","Sukses mengubah profil","success");
						setTimeout(function(){
							window.location = base_url + "home";
						},500);
					} else if ( result == 1 ) {
						swal("Gagal","Kesalahan pada server","error");
					}
				}
			});
		});

    $("#btnArbitrase").on("click",function(){
      $("#arbitrasemodal").modal("show");
      $(".showArbitrase").html("Sedang Memuat ...");
      $(".showArbitrase").load(base_url + "home/arbitrase/view");
    });

	});
</script>