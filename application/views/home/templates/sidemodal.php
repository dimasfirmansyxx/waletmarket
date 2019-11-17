<div class="modal fade" id="buatlelangmodal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Buat Lelang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form id="frmBuatLelang" enctype="multipart/form-data">
	        <div class="row">
	        	<div class="col-md-6">
	        		<div class="form-group">
	        			<label>Judul</label>
	        			<input type="text" name="judul" class="form-control" required autocomplete="off">
	        		</div>
	        		<div class="form-group">
	        			<label>Photo</label>
	        			<input type="file" name="photo" class="form-control" required autocomplete="off">
	        			<small>max size 13 MB</small>
	        		</div>
	        		<div class="form-group">
	        			<label>Video</label>
	        			<input type="file" name="video" class="form-control" autocomplete="off">
	        			<small>max size 13 MB</small>
	        		</div>
	        		<div class="form-group">
	        			<label>Keterangan</label>
	        			<textarea class="form-control" name="remarks" rows="5"></textarea>
	        		</div>
	        		<div class="form-group">
	        			<label>Jenis</label>
	        			<select name="jenis" class="form-control" required>
	        				<option value="jual">Jual</option>
	        				<option value="beli">Beli</option>
	        			</select>
	        		</div>
	        	</div>
	        	<div class="col-md-6">
	        		<?php $get_jenis = $this->Func_model->get_all_jenis(); ?>
	        		<?php foreach ($get_jenis as $row): ?>
	        			<div class="form-group">
		        			<label><?= ucwords($row['jenis']) ?></label>
		        			<div class="row">
		        				<?php if ( $row['jenis'] == 'cong' ): ?>
			        				<div class="col-md-6">
			        					<label>Berat (<?= $row['satuan'] ?>)</label>
					        			<input type="text" name="<?= $row['id_jenis'] ?>0001" class="form-control" required autocomplete="off" id="txtcong" placeholder="Jumlah" readonly value="0">
			        				</div>
	        					<?php else: ?>
	        						<div class="col-md-6">
			        					<label>Berat (<?= $row['satuan'] ?>)</label>
					        			<input type="text" name="<?= $row['id_jenis'] ?>0001" class="form-control beratjenis" id="txt<?= $row['jenis'] ?>" required autocomplete="off" placeholder="Jumlah" value="0">
			        				</div>
		        				<?php endif ?>
		        				<div class="col-md-6">
		        					<label>Harga</label>
		        					<input type="text" name="<?= $row['id_jenis'] ?>0002" class="form-control hargaformat" required autocomplete="off" placeholder="Harga">
		        				</div>
		        			</div>
		        		</div>
	        		<?php endforeach ?>
	        		<div class="form-group">
	        			<label>Kadar (%)</label>
	        			<input type="number" name="kadar" class="form-control" required autocomplete="off">
	        		</div>
	        		<div class="form-group">
	        			<label>Warna</label>
	        			<select class="form-control" name="warna" required>
	        				<option value="Putih Kapas">Putih Kapas</option>
	        				<option value="Putih Beras">Putih Beras</option>
	        				<option value="Cream">Cream</option>
	        				<option value="Abu-abu">Abu-abu</option>
	        				<option value="Kuning">Kuning</option>
	        			</select>
	        		</div>
	        	</div>
	        </div>
      </div>
      <div class="modal-footer">
	      	<button type="button" class="btn btn-secondary mt-2 mb-2 btnClose" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-primary btnSave mt-2 mb-2 mr-2">Posting</button>
		</form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="mylelangmodel" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Postingan Lelang</h5>
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

<div class="modal fade" id="biddermodel" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Bidder</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="row">
      		<div class="col-lg-12 showBidder">
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

<div class="modal fade" id="mybidmodal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">My Bid(s)</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="row">
      		<div class="col-lg-12 showMyBid">
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
      					<input type="text" name="jumlah" class="form-control" required autocomplete="off">
      				</div>
      				<div class="form-group">
      					<label>Bukti</label>
      					<input type="file" name="bukti" class="form-control" required autocomplete="off">
      				</div>
      				<button type="submit" class="btn btn-primary btn-sm btn-block">Submit</button>
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
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Keranjang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body showKeranjang">
      	<p class="text-center">Sedang Memuat data ...</p>
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

	  function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
		 
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

		$("#btnTransaksi").on("click",function(){
			loadTransaksi();
			$("#transaksimodal").modal("show");
		});

		$("#btnProfil").on("click",function(){
			$("#profilmodal").modal("show");
		});

		$(".beratjenis").on("keyup",function(e){
			var total;
			var mangkok = $("#txtmangkok").val();
			var sudut = $("#txtsudut").val();
			var patahan = $("#txtpatahan").val();
			var kakian = $("#txtkakian").val();

			mangkok = mangkok.replace(",",".");
			sudut = sudut.replace(",",".");
			patahan = patahan.replace(",",".");
			kakian = kakian.replace(",",".");

			total = parseFloat(mangkok) + parseFloat(sudut) + parseFloat(patahan) + parseFloat(kakian);
			$("#txtcong").val(total);
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

		$("#frmBuatLelang").on("submit",function(e){
			e.preventDefault();
			setButtonSaving("Memposting ...");
			$.ajax({
				url : base_url + "home/lelang/buat",
				type : "post",
				dataType : "json",
				data : new FormData(this),
				cache : false,
				contentType : false,
				processData : false,
				success : function(result) {
					if ( result == 0 ) {
			            swal("Sukses","Sukses membuat postingan","success");
			            $(".btnClose").click();
			            window.location = base_url + "home";
			        } else if ( result == 401 ) {
			            swal("Gagal","Gambar yang diupload harus berformat jpg, jpeg, png atau bmp","warning");
			        } else if ( result == 402 ) {
			            swal("Gagal","Video yang diupload harus berformat mp4, mkv, avi atau 3gp","warning");
			        }
			        unsetButtonSaving("Posting");
				}
			});
		});


		var id_transaksi;
		$(".showMyTransaksi").on("click",".btnDoPayment",function(){
			id_transaksi = $(this).attr("data-id");
			$(".btnClose").click();
			setTimeout(function(){
				$("#dopaymentmodal").modal("show");
			},500);
		});

		$("#frmBayar").on("submit",function(e){
			e.preventDefault();
			var formdata = new FormData(this);
			formdata.append("id_transaksi",id_transaksi);
			formdata.append("id_user",id_user);
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
					} else if ( result == 2 ) {
						swal("Gagal","Anda sudah melakukan pembayaran","warning");
					} else if ( result == 1 ) {
						swal("Gagal","Kesalahan pada server","error");
					} else if ( result == 4 ) {
						swal("Gagal","Pastikan format gambar adalah 'jpg,jpeg,png,bmp'");
					}
				} 
			});	
		});

		$(".showListOrder").on("click",".btnToDeliver",function(){
			var id = $(this).attr("data-id");
			$.ajax({
				url : base_url + "home/change_status_transaksi/deliver",
				data : { id_transaksi : id },
				type : "post",
				dataType : "text",
				success : function(result) {
					if ( result == 0 ) {
						swal("Sukses","Sukses mengubah status ke 'Deliver'","success");
						loadOrder();
					} else if ( result == 1 ) {
						swal("Gagal","Kesalahan pada server","error");
					}
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
	});
</script>