<div class="container">
  <div class="aa-product-details section" id="features">
    <div class="row">
      <div class="col-md-3">
      	<div class="row mt-2">
		    <div class="col-md-12">
		    	<?php if ( $this->session->user_logged ): ?>
		    		<h3><?= $this->Home_model->user_info($this->session->user_id,"nama") ?></h3>
		    		<h5>@<?= $this->Home_model->user_info($this->session->user_id,"username") ?></h5>
					<div class="list-group mt-2" style="cursor: pointer;">
					  <a class="list-group-item list-group-item-action" id="btnBuatLelang">
					    Buat Lelang
					  </a>
					  <a class="list-group-item list-group-item-action" id="btnBid">
					  	Bid Saya
					  </a>
					  <a class="list-group-item list-group-item-action" id="btnLelang">
					  	Lelang
					  </a>
					  <a class="list-group-item list-group-item-action" id="btnTransaksi">
					  	Transaksi
					  </a>
					  <a class="list-group-item list-group-item-action" id="btnOrder">
					  	List Order
					  </a>
					  <a class="list-group-item list-group-item-action" id="btnKeranjang">
					  	Keranjang
					  </a>
					  <a class="list-group-item list-group-item-action" id="btnProfil">
					  	Profil
					  </a>
					  <a href="<?= base_url() ?>home/logout" class="list-group-item list-group-item-action">
					  	Logout
					  </a>
					</div>
					<br>
					<h3>Notification</h3>
					<small>* klik untuk menghapus notifikasi</small>
					<?php $this->load->view("home/templates/notif.php") ?>
					<?php $this->load->view("home/templates/sidemodal.php") ?>
				<?php else: ?>
					<div class="list-group">
					  <button class="list-group-item list-group-item-action" id="btnLogin">
					    Login
					  </button>
					  <button class="list-group-item list-group-item-action" id="btnRegister">
					  	Register
					  </button>
					</div>
		    	<?php endif ?>
		    </div>
		  </div>
      </div>

      <?php if ( !$this->session->user_logged ): ?>
      	
      <div class="modal fade" id="loginmodal" tabindex="-1" role="dialog" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title">Login</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        <form id="frmLogin">
		        	<div class="alert alert-login alert-success AlertSuccess" role="alert">
	                  Login Sukses. Harap Tunggu, sedang mengalihkan ...
	                </div>

	                <div class="alert alert-login alert-danger AlertFailed" role="alert">
	                  Login Gagal. <span class="failedreason"></span>
	                </div>
		        	<div class="form-group">
		        		<label>Username</label>
		        		<input type="text" name="username" class="form-control" required autocomplete="off">
		        	</div>
		        	<div class="form-group">
		        		<label>Password</label>
		        		<input type="password" name="password" class="form-control" required autocomplete="off">
		        	</div>
		        	<button type="submit" class="btn btn-primary btn-block btnSave">Login</button>
		        </form>
		      	<p>Do not have an account ? <a href="#">Register!</a></p>
		      </div>
		    </div>
		  </div>
		</div>

		<div class="modal fade" id="registermodal" tabindex="-1" role="dialog" aria-hidden="true">
		  <div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title">Register</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        <form id="frmRegister">
		        	<div class="row">
		        		<div class="col-md-6">
		        			<div class="form-group">
		        				<label>Nama</label>
		        				<input type="text" name="nama" class="form-control" required autocomplete="off">
		        			</div>
		        			<div class="form-group">
		        				<label>Username</label>
		        				<input type="text" maxlength="16" name="username" class="form-control" required autocomplete="off">
		        			</div>
		        			<div class="form-group">
		        				<label>Password</label>
		        				<input type="password" maxlength="16" name="password" class="form-control" required autocomplete="off">
		        			</div>
		        			<div class="form-group">
		        				<label>Email</label>
		        				<input type="email" name="email" class="form-control" required autocomplete="off">
		        			</div>
		        		</div>
		        		<div class="col-md-6">
		        			<div class="form-group">
		        				<label>Nomor HP / Whatsapp</label>
		        				<input type="text" name="nohp" class="form-control txtNoHp" required autocomplete="off">
		        			</div>
		        			<div class="form-group">
		        				<label>Alamat</label>
		        				<input type="text" name="alamat" class="form-control" required autocomplete="off">
		        			</div>
		        			<div class="form-group">
		        				<label>Kota</label>
		        				<input type="text" name="kota" class="form-control" required autocomplete="off">
		        			</div>
		        			<div class="form-group">
		        				<label>Provinsi</label>
		        				<input type="text" name="provinsi" class="form-control" required autocomplete="off">
		        			</div>
		        		</div>
		        	</div>
		        	<button type="submit" class="btn btn-primary btn-block btnSave">Register</button>
		        </form>
		      	<p>Have an account ? <a href="#">Login!</a></p>
		      </div>
		    </div>
		  </div>
		</div>
      <?php endif ?>

<script>
	$(document).ready(function(){

		var base_url = "<?= base_url() ?>";

		function setButtonSaving(word) {
	      $(".btnSave").attr("disabled","disabled");
	      $(".btnSave").html(word);
	    }

	    function unsetButtonSaving(word) {
	      $(".btnSave").removeAttr("disabled");
	      $(".btnSave").html(word);
	    }

	    function alertClear() {
	      $(".alert-login").css("display","none");
	    }

	    alertClear();

		$("#btnLogin").on("click",function(){
			$("#loginmodal").modal("show");
		});

		$("#btnRegister").on("click",function(){
			$("#registermodal").modal("show");
		});

		$("#frmRegister").on("submit",function(e){
			e.preventDefault();
			if ( $.isNumeric($(".txtNoHp").val()) == false ) {
				swal("Gagal","Isi nomor HP hanya dengan angka!","warning");
				return;
			}
			setButtonSaving("Sedang mendaftar ...")
			$.ajax({
				url : base_url + "home/register",
				type : "post",
				dataType : "text",
				data : new FormData(this),
				cache : false,
				contentType : false,
				processData : false,
				success: function(result) {
					if ( result == 0 ) {
						swal("Sukses","Pendaftaran sukses","success");
						$("#frmRegister").trigger("reset");
						$("#registermodal").modal("hide");
						$("#loginmodal").modal("show");
					} else if ( result == 2 ) {
						swal("Gagal","Username sudah ada","warning");
					} else if ( result == 202 ) {
						swal("Gagal","Email sudah ada","warning");
					} else if ( result == 1 ) {
						swal("Gagal","Kesalahan pada server","danger");
					}
					unsetButtonSaving("Register");
				}
			});
		});

		$("#frmLogin").on("submit",function(e){
			e.preventDefault();
			setButtonSaving("Sedang mengecek ...")
			alertClear();
			$.ajax({
				url : base_url + "home/login",
				type : "post",
				dataType : "text",
				data : new FormData(this),
				cache : false,
				contentType : false,
				processData : false,
				success: function(result) {
					if ( result == 0 ) {
						$(".AlertSuccess").css("display","block");
						setTimeout(function(){
							window.location = base_url + "home";
						},1000);
					} else if ( result == 3 ) {
						$(".AlertFailed").css("display","block");
						$(".failedreason").html("Username tidak ada");
					} else if ( result == 5 ) {
						$(".AlertFailed").css("display","block");
						$(".failedreason").html("Password salah");
					}
					unsetButtonSaving("Login");
				}
			});
		});

	});
</script>